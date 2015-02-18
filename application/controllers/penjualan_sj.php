<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_sj extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model(array('penjualan_order_m','penjualan_sj_m'));
    }
	
	public function index(){
		$data['action_form'] = base_url('penjualan_sj/saveorder');
		$data['page'] = 'penjualan/v_penjualan_sj';
		$this->load->view('template/index',$data);
	}
	
	function saveorder(){
		$this->form_validation->set_rules('no_dokumen', 'No Dokumen', 'trim|required|xss_clean');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required|xss_clean');
		$this->form_validation->set_rules('kode_barang', 'kode_barang', 'required|xss_clean');
		$this->form_validation->set_rules('kuantitas', 'kuantitas', 'trim|required|integer|xss_clean');
		
		if($this->form_validation->run()==false){
			$hasil['status']="false";
			$hasil['msg']="Kolom No Dokumen, Tanggal, Kode Barang dan Jumlah yang dikirim Tidak Boleh Kosong";
			$hasil['id_surat_jalan'] = "";
			$hasil['subtotal'] = "";
			$hasil['redir'] = base_url('penjualan_sj');
		}else{
			if($this->input->post('id_surat_jalan')==""){
				//insert ke temp_ordersuratjalan baru insert ke temp_ordersuratjalan_det
				$header = array("id_order"=>$this->input->post('id_order'),
										"id_customer"=>$this->input->post('id_customer'),
										"tanggal"=>date('Y-m-d',strtotime($this->input->post('tanggal'))),
										"no_surat_jalan"=>$this->input->post('id_temp'),
										"id_supir" =>$this->input->post('id_supir'),
										"id_pengirim" =>$this->input->post('id_pengirim')
										);
				$this->simpan->SimpanMaster('temp_ordersuratjalan',$header);
				
				$select = array('id_surat_jalan');
				$where = array("no_surat_jalan"=>$this->input->post('id_temp'));
				$cek = $this->getdatatabel->getbyid('temp_ordersuratjalan',$select,$where);
				$detail = array("id_surat_jalan"=>$cek['id_surat_jalan'],
									"id_order_det"=>$this->input->post('id_order_det'),
									"id_barang"=>$this->input->post('id_barang'),
									"kuantitas"=>$this->input->post('kuantitas'),
									"satuan"=>$this->input->post('satuan'),
									"keterangan"=>$this->input->post('keterangan')
									);
				$this->simpan->SimpanMaster('temp_ordersuratjalan_det',$detail);
				$hasil = $this->penjualan_sj_m->data_detail_sj_temp($cek['id_surat_jalan']);
				$hasil['id_surat_jalan'] = $cek['id_surat_jalan'];
			}else{
				//update temp_ordersuratjalan
				$this->update_temphd();
				//insert temp_ordersuratjalan_det saja
				$detail = array("id_surat_jalan"=>$this->input->post('id_surat_jalan'),
									"id_order_det"=>$this->input->post('id_order_det'),
									"id_barang"=>$this->input->post('id_barang'),
									"kuantitas"=>$this->input->post('kuantitas'),
									"satuan"=>$this->input->post("satuan"),
									"keterangan"=>$this->input->post('keterangan')
									);
				$this->simpan->SimpanMaster('temp_ordersuratjalan_det',$detail);
				$hasil = $this->penjualan_sj_m->data_detail_sj_temp($this->input->post('id_surat_jalan'));
				$hasil['id_surat_jalan'] = $this->input->post('id_surat_jalan');
			}
			
			$hasil['status']="true";
			$hasil['msg']="";
		}
		
		echo json_encode($hasil);
	}
	
	function get_item_order(){
		$id_surat_jalan = $this->input->post('id_order');
		$select = array('id_surat_jalan');
		$where = array("id_surat_jalan"=>$id_surat_jalan);
		$cek = $this->getdatatabel->getbyid('temp_ordersuratjalan_det',$select,$where); 
		//if($cek['id_surat_jalan']!="")
			$hasil = $this->penjualan_sj_m->data_detail_sj_temp($id_surat_jalan);
		//else
			//$hasil = $this->penjualan_sj_m->data_detail_sj($id_surat_jalan);
		echo json_encode($hasil);
	}
	
	function aprove_order(){
		$header = array();
		$id_surat_jalan = $this->input->post('id_surat_jalan');
		$cek = $this->getdatatabel->getbyid('ordersuratjalan',array("id_surat_jalan"),array("id_surat_jalan"=>$id_surat_jalan));
		$this->update_temphd();
		$tabel_hd = "temp_ordersuratjalan";
		$select_hd = array("id_surat_jalan","id_order","id_customer","tanggal","nm_penerima","id_supir","nm_satpam_penerima","jam_masuk_penerima","jam_keluar_penerima","id_satpam","jam_masuk_pengirim","jam_keluar_pengirim","id_pengirim");
		$where_hd = array("id_surat_jalan"=>$id_surat_jalan);
		$header = $this->getdatatabel->getbyid($tabel_hd,$select_hd,$where_hd);
		if($cek['id_surat_jalan']!=""){//edit
			$where = array("id_surat_jalan"=>$id_surat_jalan);
			$set = elements(array('tanggal','id_supir','id_pengirim'),$header);
			$status_inv = array("status_inv"=>0);
			$status_edit = array("status_edit"=>0);
			$set = $set+$status_inv+$status_edit;
			$this->update->update2('ordersuratjalan',$set,$where);
		}else{//awal
			$header['status_inv'] = "0";
			$header['status_edit'] = "0";
			$this->simpan->SimpanMaster('ordersuratjalan',$header); //simpan ke tabel order dari temp_order
			$this->createnosurat->nosurat($header['id_surat_jalan'],$header['id_customer'],'SJ',$header['tanggal']);
			$data['no_surat_jalan'] = $this->createnosurat->convertnosurat($id_surat_jalan,'SJ');
			$this->update->update2('ordersuratjalan',$data,array('id_surat_jalan'=>$id_surat_jalan));
		}
		$this->hapus->HapusMaster2(array('id_surat_jalan'=>$id_surat_jalan),'temp_ordersuratjalan');
		$this->hapus->HapusMaster2(array('id_surat_jalan'=>$id_surat_jalan),'ordersuratjalan_det'); 
		$this->penjualan_sj_m->simpan_detail($id_surat_jalan);
		$where_update['id_order'] = $header['id_order'];
		$set = array('status_sj'=>1);
		$this->update->update2('order',$set,$where_update);
		$total_order = $this->penjualan_sj_m->total_allorder($header['id_order']);
		$total_sj = $this->penjualan_sj_m->total_allsj($header['id_order']);
		if($total_order == $total_sj){
			$set1 = array('terkirim'=>1);
			$where1 = array('id_order'=>$header['id_order']);
			$this->update->update2('order',$set1,$where1);
		}
		$hasil = array('redir'=>base_url('penjualan_sj/cetak_surat_jalan/'.$id_surat_jalan));
		echo json_encode($hasil);
	}
	
	function hapus_item(){
		$getPost = $this->input->post(null,true);
		$id_surat_jalan_det = $getPost[0];
		$id_surat_jalan = $getPost[1];
		
		$this->hapus->HapusMaster2(array('id_surat_jalan_det'=>$id_surat_jalan_det,'id_surat_jalan'=>$id_surat_jalan),'temp_ordersuratjalan_det');
		
		$hasil = $this->penjualan_sj_m->data_detail_sj_temp($id_surat_jalan);
		$hasil['status']="true";
		$hasil['msg']="";
		
		echo json_encode($hasil);
	}
	
	function hapus_item_nontemp(){		
		$postData = $this->input->post(null,true);
		$this->hapus->HapusMaster2(array('id_surat_jalan_det'=>$postData[0],'id_surat_jalan'=>$postData[1]),'ordersuratjalan_det');
		$hasil = $this->penjualan_sj_m->data_detail_sj($postData[1]);
		$hasil['status']="true";
		$hasil['msg']="";
		$hasil['id_surat_jalan_det'] = $postData[0];
		$hasil['id_surat_jalan'] = $postData[1];
		
		echo json_encode($hasil);
	}
	
	function get_data_order(){ //get data order untuk membuat surat jalan
		$id_order = $this->input->post('id_order');
		
		$cek_kondisi_order = $this->penjualan_sj_m->cek_order($id_order);  //untuk cek posisi order sudah masuk k tabel ordersuratjalan atau masih ditemporary
		//echo $cek_kondisi_order;
		if($cek_kondisi_order){ //ada di temporary
			$header = $this->penjualan_sj_m->get_header_temp($id_order);
			$hasil = $this->penjualan_sj_m->data_detail_sj_temp($header[0]->id_surat_jalan);
			$hasil['id_surat_jalan'] = $header[0]->id_surat_jalan;
			$hasil['tanggal'] = $header[0]->tanggal;
			$hasil['id_temp'] = $header[0]->no_surat_jalan;
		}else{
			$header = $this->penjualan_order_m->get_header($id_order);
			$hasil['id_surat_jalan'] = "";
			$hasil['tanggal'] = "";
			$key=md5(rand(8888,999999));
			$hasil['id_temp'] = $key;
			$hasil['vtabel'] = "";
		}
		
		$hasil['id_order'] = $header[0]->id_order;
		$hasil['id_customer'] = $header[0]->id_customer;
		$hasil['nama_customer'] = $header[0]->nama;
		$hasil['alamat_customer'] = $header[0]->alamat;
		$hasil['telp_customer'] = $header[0]->telpon;
		$hasil['kota_customer'] = $header[0]->kota;
		
		echo json_encode($hasil);
	}
	
	function vedit(){
		$id_surat_jalan = $this->session->userdata('id_order_edit_sess');
		$header = $this->penjualan_sj_m->get_header($id_surat_jalan);
		
		$this->form_data->id_surat_jalan = $id_surat_jalan;
		$this->form_data->id_order = $header['id_order'];
		$this->form_data->no_surat_jalan = $header['no_surat_jalan'];
		$this->form_data->tanggal = $header['tanggal_ori'];
		$this->form_data->no_dokumen = $header['no_dokumen'];
		$this->form_data->id_customer = $header['id_customer'];
		$this->form_data->kode_customer = $header['kode_customer'];
		$this->form_data->nama = $header['nama'];
		$this->form_data->alamat = $header['alamat'];
		$this->form_data->kota = $header['kota'];
		$this->form_data->telpon = $header['telpon'];
		$this->form_data->id_supir = $header['id_supir'];
		$this->form_data->supir = $header['supir'];
		$this->form_data->id_pengirim = $header['id_pengirim'];
		$this->form_data->pengirim = $header['pengirim'];
		$this->hapus->HapusMaster2(array('id_surat_jalan'=>$id_surat_jalan),'temp_ordersuratjalan'); 
		$this->hapus->HapusMaster2(array('id_surat_jalan'=>$id_surat_jalan),'temp_ordersuratjalan_det'); 
		$this->move_totemphd($id_surat_jalan);
		$this->update->update2('ordersuratjalan',array('status_edit'=>'1'),array('id_surat_jalan'=>$id_surat_jalan));
		$this->penjualan_sj_m->move_to_tempdet($id_surat_jalan);
		
		$data['action_form'] = base_url('penjualan_sj/saveorder_edit');
		$data['page'] = 'penjualan/v_edit_penjualan_sj';
		$this->load->view('template/index',$data);
	}
	
	
	function saveorder_edit(){
		$this->form_validation->set_rules('no_dokumen', 'No Dokumen', 'trim|required|xss_clean');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required|xss_clean');
		$this->form_validation->set_rules('kode_barang', 'kode_barang', 'required|xss_clean');
		$this->form_validation->set_rules('kuantitas', 'kuantitas', 'trim|required|integer|xss_clean');
		
		if($this->form_validation->run()==false){
			$hasil['status']="false";
			$hasil['msg']="Kolom No Dokumen, Tanggal, Kode Barang dan Jumlah yang dikirim Tidak Boleh Kosong";
			$hasil['id_surat_jalan'] = "";
			$hasil['subtotal'] = "";
			$hasil['redir'] = base_url('penjualan_sj');
		}else{
			$id_surat_jalan = $this->input->post('id_surat_jalan');
			$select = array('id_surat_jalan','no_surat_jalan','id_customer');
			$where = array("id_surat_jalan"=>$id_surat_jalan);
			$cek = $this->getdatatabel->getbyid('temp_ordersuratjalan',$select,$where); 
			
			if(!empty($cek['id_surat_jalan'])){
				//update temp_ordersuratjalan
				$this->update_temphd();
				//$this->update->update2('temp_ordersuratjalan',$header,$where_up);
				$this->move_totempdet($cek['id_surat_jalan']);
			}else{
				//$this->move_totemphd($id_surat_jalan);
				$this->move_totempdet($id_surat_jalan);
				//$this->update->update2('ordersuratjalan',array('status_edit'=>'1'),array('id_surat_jalan'=>$id_surat_jalan));
			}
			$hasil = $this->penjualan_sj_m->data_detail_sj_temp($id_surat_jalan);
			$hasil['id_surat_jalan'] = $id_surat_jalan;
			$hasil['status']="true";
			$hasil['msg']="";
		}
		echo json_encode($hasil);
	}
	
	function update_temphd(){
		//update temp_ordersuratjalan
		$header = array(
								"tanggal"=>date('Y-m-d',strtotime($this->input->post('tanggal'))),
								"id_supir" =>$this->input->post('id_supir'),
								"id_pengirim" =>$this->input->post('id_pengirim')
								);
		$where_up = array("id_surat_jalan"=>$this->input->post('id_surat_jalan'));
		$this->update->update2('temp_ordersuratjalan',$header,$where_up);
	}
	
	function move_totempdet($id_surat_jalan){
		$detail = array("id_surat_jalan"=>$id_surat_jalan,
									"id_order_det"=>$this->input->post('id_order_det'),
									"id_barang"=>$this->input->post('id_barang'),
									"kuantitas"=>$this->input->post('kuantitas'),
									"satuan"=>$this->input->post('satuan'),
									"keterangan"=>$this->input->post('keterangan')
									);
		$this->simpan->SimpanMaster('temp_ordersuratjalan_det',$detail);
	}
	
	function move_totemphd($id_surat_jalan){
		$tabel_hd = "ordersuratjalan";
		$select_hd = array("id_surat_jalan","id_order","id_customer","tanggal","no_surat_jalan","id_supir","id_pengirim");
		$where_hd = array("id_surat_jalan"=>$id_surat_jalan);
		$header = $this->getdatatabel->getbyid($tabel_hd,$select_hd,$where_hd);
		$this->simpan->SimpanMaster('temp_ordersuratjalan',$header);
	}
	
	function hitungsisa(){
		$id_order_det = $this->input->post('id_order_det');
		$total_order = $this->penjualan_sj_m->total_order($id_order_det);
		$total_kirim = $this->penjualan_sj_m->total_kirim($id_order_det);
		
		$hasil['sisa'] = 0;
		$hasil['sisa'] = $total_order-$total_kirim;
		
		echo json_encode($hasil);
	}
	
	function cetak_surat_jalan($id){
		$data['header'] = $this->penjualan_sj_m->get_header($id);
		$data['detail'] = $this->penjualan_sj_m->data_detail($id);
		
		$this->load->view('page/penjualan/v_cetak_penjualan_sj',$data);
	}
	
}
