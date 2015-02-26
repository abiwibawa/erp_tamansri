<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_kwitansi extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->Model(array("penjualan_kwitansi_m"));
		$this->load->library(array("terbilang_lib"));
    }
	
	function index(){
		$sess_edit = array('id_kwitansi_sess'=>"");
		$this->session->set_userdata($sess_edit);
		$data['action_form'] = base_url('penjualan_kwitansi/savetemp');
		$key=md5(rand(8888,999999));
		$this->form_data->id_temp = $key;
		$data['page'] = 'penjualan/v_penjualan_kwitansi';
		$this->load->view('template/index',$data);
	}
	
	function savetemp(){
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required|xss_clean');
		$this->form_validation->set_rules('no_invoice', 'no_invoice', 'required|xss_clean');
		$this->form_validation->set_rules('kode_customer', 'kode_customer', 'required|xss_clean');
		if($this->form_validation->run()==false){
			$hasil['status']="false";
			$hasil['msg']="Kode Customer, Tanggal, No Invoice Tidak Boleh Kosong";
			$hasil['id_kwitansi'] = "";
			$hasil['total'] = "";
			$hasil['redir'] = base_url('penjualan_kwitansi');
		}else{
			$getPost = $this->input->post(null,true);
			$wherecek['no_kwitansi'] = $getPost['id_temp'];
			$id_customer['id_customer'] = $getPost['id_customer'];
			$wherecek = $wherecek+$id_customer;
			$cek=$this->penjualan_kwitansi_m->cekHdTemp($wherecek);
			if($cek['ada']==true){ //sama
				//insert ke det saja
				$hasil['id_kwitansi'] = $cek['id_kwitansi'];
				$detail = elements(array("id_invoice","no_invoice","subtotal"),$getPost);
				$detail = $hasil+$detail;
				$this->simpan->SimpanMaster('temp_orderkwitansi_det',$detail);
				$tabel = $this->penjualan_kwitansi_m->data_detail_temp($hasil['id_kwitansi']);
				$hasil = $hasil+$tabel;
			}else{
				//insert ke hd and det
				$no_kwitansi['no_kwitansi'] = $getPost['id_temp'];
				$tanggal['tanggal'] = date('Y-m-d',strtotime($getPost['tanggal']));
				$header = elements(array("id_customer","id_ttd"),$getPost);
				$header = $header+$no_kwitansi+$tanggal;
				$this->simpan->SimpanMaster('temp_orderkwitansi',$header);
				$select = array('id_kwitansi');
				$where = array("no_kwitansi"=>$getPost['id_temp']);
				$datahd = $this->getdatatabel->getbyid('temp_orderkwitansi',$select,$where);
				$hasil['id_kwitansi'] = $datahd['id_kwitansi'];
				$detail = elements(array("id_invoice","no_invoice","subtotal"),$getPost);
				$detail = $detail+$hasil;
				$this->simpan->SimpanMaster('temp_orderkwitansi_det',$detail);
				$tabel = $this->penjualan_kwitansi_m->data_detail_temp($hasil['id_kwitansi']);
				$hasil = $hasil+$tabel;
			} 
			
			$hasil['status']="true";
			$hasil['msg']="";
		}
		
		echo json_encode($hasil);
	}
	
	function aprove_order(){
		$id_kwitansi = $this->input->post('id_kwitansi');
		$cek = $this->getdatatabel->getbyid('orderkwitansi',array("id_kwitansi"),array("id_kwitansi"=>$id_kwitansi));
		if($cek['id_kwitansi']!=""){
			$this->edit();
		}else{
			$this->simpan();
		}
	}
	
	function simpan(){
		$getPost = $this->input->post(null,true);
		$selectHD = array("id_kwitansi","id_customer","tanggal","id_ttd");
		$whereHD['id_kwitansi'] = $getPost['id_kwitansi'];
		$dataHD = $this->getdatatabel->getbyid("temp_orderkwitansi",$selectHD,$whereHD);
		$total['total'] = $getPost['total'];
		$dataHD = $dataHD+$total;
		$this->simpan->SimpanMaster('orderkwitansi',$dataHD);
		$this->createnosurat->nosurat($dataHD['id_kwitansi'],$dataHD['id_customer'],'KW',$dataHD['tanggal']);
		$data['no_kwitansi'] = $this->createnosurat->convertnosurat($dataHD['id_kwitansi'],'KW');
		$this->update->update2('orderkwitansi',$data,array('id_kwitansi'=>$dataHD['id_kwitansi']));
		$this->hapus->HapusMaster2(array('id_kwitansi'=>$dataHD['id_kwitansi']),'temp_orderkwitansi');
		$this->penjualan_kwitansi_m->simpan_detail($dataHD['id_kwitansi']);
		$set = array("filter"=>"f1","key_sess"=>$data['no_kwitansi']);
		$this->session->set_userdata($set);
		$hasil = array('redir'=>base_url('penjualan_lapkwitansi/filter'));
		//$hasil = array('redir'=>base_url('penjualan_kwitansi/cetak_surat/'.$dataHD['id_kwitansi']));
		echo json_encode($hasil);
	}
	
	function edit(){
		$getPost = $this->input->post(null,true);
		$this->update_temphd();
		$tabel = "temp_orderkwitansi";
		$select = array("id_kwitansi","id_customer","tanggal","no_kwitansi","total","id_ttd");
		$where = array("id_kwitansi"=>$this->input->post('id_kwitansi'));
		$header = $this->getdatatabel->getbyid($tabel,$select,$where);
		$where_ins = array("id_kwitansi"=>$this->input->post('id_kwitansi'));
		$set = elements(array('tanggal','id_customer','id_ttd'),$header);
		$this->update->update2('orderkwitansi',$set,$where_ins);
		$this->hapus->HapusMaster2(array('id_kwitansi'=>$this->input->post('id_kwitansi')),'temp_orderkwitansi');
		$this->hapus->HapusMaster2(array('id_kwitansi'=>$this->input->post('id_kwitansi')),'orderkwitansi_det');
		$this->penjualan_kwitansi_m->simpan_detail($this->input->post('id_kwitansi'));
		$set = array("filter"=>"f1","key_sess"=>$header['no_kwitansi']);
		$this->session->set_userdata($set);
		$hasil = array('redir'=>base_url('penjualan_lapkwitansi/filter'));
		//$hasil = array('redir'=>base_url('penjualan_kwitansi/cetak_surat/'.$this->input->post('id_kwitansi')));
		echo json_encode($hasil);
	}
	
	function update_temphd(){
		//update temp_ordersuratjalan
		$header = array(
								"tanggal"=>date('Y-m-d',strtotime($this->input->post('tanggal'))),
								"id_ttd" =>$this->input->post('id_ttd')
								);
		$where_up = array("id_kwitansi"=>$this->input->post('id_kwitansi'));
		$this->update->update2('temp_orderkwitansi',$header,$where_up);
	}
	
	function hapus_item(){
		$getPost = $this->input->post(null,true);
		$id_det = $getPost[0];
		$id_hd = $getPost[1];
		
		$this->hapus->HapusMaster2(array('id_kwitansi_det'=>$id_det,'id_kwitansi'=>$id_hd),'temp_orderkwitansi_det');
		
		$hasil = $this->penjualan_kwitansi_m->data_detail_temp($id_hd);
		$hasil['status']="true";
		$hasil['msg']="";
		
		echo json_encode($hasil);
	}
	
	function vedit(){
		$id = $this->session->userdata('id_kwitansi_sess');
		$GetHeader = $this->penjualan_kwitansi_m->get_header($id);
		$this->form_data->id_customer = $GetHeader['id_customer'];
		$this->form_data->id_kwitansi = $GetHeader['id_kwitansi'];
		$this->form_data->no_kwitansi = $GetHeader['no_kwitansi'];
		$this->form_data->kode_customer = $GetHeader['kode_customer'];
		$this->form_data->tanggal = $GetHeader['tgl_nonformat'];
		$this->form_data->nama_customer = $GetHeader['nm_customer'];
		$this->form_data->alamat_customer = $GetHeader['alamat'];
		$this->form_data->telp_customer = $GetHeader['telpon'];
		$this->form_data->kota_customer = $GetHeader['kota'];
		$this->form_data->nama_ttd = $GetHeader['nama_ttd'];
		$this->form_data->id_ttd = $GetHeader['id_ttd'];
		$this->form_data->total = $GetHeader['total_nonformat'];
		$this->form_data->terbilang = $GetHeader['terbilang'];
		$this->hapus->HapusMaster2(array('id_kwitansi'=>$id),'temp_orderkwitansi'); 
		$this->hapus->HapusMaster2(array('id_kwitansi'=>$id),'temp_orderkwitansi_det'); 
		$this->move_totemphd($id);
		$this->penjualan_kwitansi_m->move_to_tempdet($id);
		
		$data['action_form'] = base_url('penjualan_kwitansi/savetemp');
		$data['page'] = 'penjualan/edit_penjualan_kwitansi';
		$this->load->view('template/index',$data);
	}
	
	function move_totemphd($id){
		$tabel_hd = "orderkwitansi";
		$select_hd = array("id_kwitansi","id_customer","tanggal","no_kwitansi","total","id_ttd");
		$where_hd = array("id_kwitansi"=>$id);
		$header = $this->getdatatabel->getbyid($tabel_hd,$select_hd,$where_hd);
		$this->simpan->SimpanMaster('temp_orderkwitansi',$header);
	}
	
	function get_item(){
		$id_kwitansi = $this->input->post('id_kwitansi');
		$hasil = $this->penjualan_kwitansi_m->data_detail_temp($id_kwitansi);
		echo json_encode($hasil);
	}
	
	function cetak_surat($id){
		$data['header'] = $this->penjualan_kwitansi_m->get_header($id);
		$data['detail'] = $this->penjualan_kwitansi_m->data_detail($id);
		
		$this->load->view('page/penjualan/kwitansi',$data);
	}
}
