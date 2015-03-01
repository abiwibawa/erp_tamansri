<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_pembayaran extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model(array('penjualan_pembayaran_m'));
    }
	
	public function index()
	{
		$key=md5(rand(8888,999999));
		$this->form_data->id_temp = $key;
		$data['action_form'] = base_url('penjualan_pembayaran/savetemp');
		$data['page'] = 'penjualan/v_penjualan_pembayaran';
		$this->load->view('template/index',$data);
	}
	
	function savetemp(){
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required|xss_clean');
		$this->form_validation->set_rules('kode_customer', 'kode_customer', 'required|xss_clean');
		if($this->form_validation->run()==false){
			$hasil['status']="false";
			$hasil['msg']="Kode Customer dan Tanggal Tidak Boleh Kosong";
			$hasil['id_piutang'] = "";
			$hasil['total'] = "";
			$hasil['redir'] = "";
		}else{
			$getPost = $this->input->post(null,true);
			$wherecek['id_dokumen'] = $getPost['id_temp'];
			$id_customer['id_customer'] = $getPost['id_customer'];
			$wherecek = $wherecek+$id_customer;
			$cek=$this->penjualan_pembayaran_m->cekHdTemp($wherecek);
			if($cek['ada']==false){
				//insert ke hd and det
				$tanggal['tanggal_bayar'] = $getPost['tanggal'];
				$id_perkiraan['id_perkiraan'] = '120.00';
				$save_h = elements(array('id_customer','jenis_bayar','bank_asal','no_account_asal','bank_tujuan','no_account_tujuan','bank_giro','no_giro'),$getPost);
				$save_h = $save_h+$tanggal+$wherecek+$id_perkiraan;
				$this->simpan->SimpanMaster('temp_bayarpiutang',$save_h);
				$select = array('id_piutang');
				$where = array("id_dokumen"=>$getPost['id_temp']);
				$datahd = $this->getdatatabel->getbyid('temp_bayarpiutang',$select,$where);
				$id_kwitansi['id_kwitansi'] = $getPost['id_kwitansi'];
				$id_kwitansi = $id_kwitansi+array('id_piutang'=>$datahd['id_piutang']);
				$this->simpan->SimpanMaster('temp_bayarpiutang_det',$id_kwitansi);
				$tabel = $this->penjualan_pembayaran_m->data_detail_temp($datahd['id_piutang']);
				$hasil['id_piutang'] = $datahd['id_piutang'];
				$hasil = $hasil+$tabel;
			}else{
				$id_kwitansi['id_kwitansi'] = $getPost['id_kwitansi'];
				$id_kwitansi = $id_kwitansi+array('id_piutang'=>$getPost['id_piutang']);
				$this->simpan->SimpanMaster('temp_bayarpiutang_det',$id_kwitansi);
				$tabel = $this->penjualan_pembayaran_m->data_detail_temp($getPost['id_piutang']);
				$hasil['id_piutang'] = $getPost['id_piutang'];
				$hasil = $hasil+$tabel;
			}
			$hasil['status']="true";
			$hasil['msg']="";
		}
		
		echo json_encode($hasil);
	}
}