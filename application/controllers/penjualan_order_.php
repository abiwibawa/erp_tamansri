<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_order_ extends CI_Controller{
	
	function __construct() {
		parent::__construct();
		$this->load->model('penjualan_order_m');
    }
	
	public function index(){
		$sess_edit = array('id_order_edit_sess'=>'');
		$this->session->unset_userdata($sess_edit);
		$data['action_form'] = base_url('penjualan_order_/simpan');
		$data['page'] = 'penjualan/v_penjualan_order_';
		$this->load->view('template/index',$data);
	}
	
	function simpan(){
		$getPost = $this->input->post(null,true);
		$nodok['no_dokumen'] = $getPost['no_dokumen'];
		$select = array('no_dokumen','id_order');
		$cek = $this->getdatatabel->getbyid('order',$select,$nodok);
		if($cek['no_dokumen']){
			$this->to_detail($getPost);
		}else{
			$tanggal['tanggal'] = date('Y-m-d',strtotime($getPost['tanggal']));
			$setval = elements(array('no_dokumen','id_customer','total_harga','biaya_pengiriman','syarat_bayar','keterangan'),$getPost);
			$this->simpan->SimpanMaster('order',$setval+$tanggal);
			$this->to_detail($getPost);
		}
	}
	
	function to_detail($getPost){
		$nodok['no_dokumen'] = $getPost['no_dokumen'];
		$select = array('no_dokumen','id_order');
		$get = $this->getdatatabel->getbyid('order',$select,$nodok);
		$noid['id_order'] = $get['id_order'];
		$nodok['no_dokumen'] = $get['no_dokumen'];
		$ket['keterangan'] = $getPost['ketbarang'];
		$setvaldet = elements(array('id_barang','kuantitas','satuan','harga'),$getPost);
		$setvaldet = $setvaldet+$noid+$nodok+$ket;
		$this->simpan->SimpanMaster('order_det',$setval+$tanggal);
	}
	
	function hapus_item(){
		$postData = $this->input->post(null,true);
		$id_order_det = $postData[0];
		$id_order = $postData[1];
		$this->hapus->HapusMaster2(array('id_order_det'=>$id_order_det,'id_order'=>$id_order),'temp_order_det');
		$hasil = $this->penjualan_order_m->getsubtotal($id_order);
		$hasil = $hasil+array("status"=>"true")+array("msg"=>"")+array("id_order"=>$id_order);
		echo json_encode($hasil);
	}
}
