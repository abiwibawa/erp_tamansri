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
		$nodok['no_dokumen'] = $getPost['no_dokumen'];
		$select = array('id_order');
		$cek = $this->getdatatabel->getbyid('order',$select,$nodok);
		$hasil = $this->penjualan_order_m->getsubtotal($cek['id_order']);
		echo json_encode($hasil+$cek);
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
		$this->simpan->SimpanMaster('order_det',$setvaldet);
	}
	function vedit(){
		$id_order = $this->session->userdata('id_order_edit_sess');
		$header = $this->penjualan_order_m->get_header($id_order);
		$this->form_data->id_order = $id_order;
		$this->form_data->no_dokumen = $header[0]->no_dokumen;
		$this->form_data->tanggal = $header[0]->tanggal;
		$this->form_data->total_harga = $header[0]->total+$header[0]->biaya_pengiriman;
		$this->form_data->subtotal = $header[0]->total;
		$this->form_data->pengiriman = $header[0]->biaya_pengiriman;
		$this->form_data->keterangan = $header[0]->keterangan;
		$this->form_data->syarat_bayar = $header[0]->syarat_bayar;
		$this->form_data->id_customer = $header[0]->id_customer;
		$this->form_data->kode_customer = $header[0]->kode_customer;
		$this->form_data->nama_customer = $header[0]->nama;
		$this->form_data->alamat_customer = $header[0]->alamat;
		$this->form_data->telp_customer = $header[0]->telpon;
		$this->form_data->kota_customer = $header[0]->kota;
		$data['action_form'] = base_url('penjualan_order_/save_hd');
		$data['page'] = 'penjualan/v_edit_hdpenjualan_order';
		$this->load->view('template/index',$data);
	}
	function save_hd(){
		$getPost = $this->input->post(null,true);
		$where = elements(array('id_order'),$getPost);
		$tanggal['tanggal'] = date('Y-m-d',strtotime($getPost['tanggal']));
		$set = elements(array('biaya_pengiriman','no_dokumen'),$getPost);
		$this->update->update2('order',$set+$tanggal,$where);
		
		$nodok['id_order'] = $getPost['id_order'];
		$select = array('no_dokumen','id_order');
		$get = $this->getdatatabel->getbyid('order',$select,$nodok);
		$set_sess = array('key_sess'=>$get['no_dokumen'],'filter_sess'=>'f1');
		$this->session->set_userdata($set_sess);
		echo json_encode(base_url('penjualan_laporder/filter'));
	}
	function vedit_detail(){
		$id_order = $this->session->userdata('id_order_edit_sess');
		$id_order_det = $this->session->userdata('id_order_det_edit_sess');
		$header = $this->penjualan_order_m->get_header($id_order);
		$this->form_data->id_order = $id_order;
		$this->form_data->no_dokumen = $header[0]->no_dokumen;
		$this->form_data->tanggal = $header[0]->tanggal;
		$this->form_data->total_harga = $header[0]->total+$header[0]->biaya_pengiriman;
		$this->form_data->subtotal = $header[0]->total;
		$this->form_data->pengiriman = $header[0]->biaya_pengiriman;
		$this->form_data->keterangan = $header[0]->keterangan;
		$this->form_data->syarat_bayar = $header[0]->syarat_bayar;
		$this->form_data->id_customer = $header[0]->id_customer;
		$this->form_data->kode_customer = $header[0]->kode_customer;
		$this->form_data->nama_customer = $header[0]->nama;
		$this->form_data->alamat_customer = $header[0]->alamat;
		$this->form_data->telp_customer = $header[0]->telpon;
		$this->form_data->kota_customer = $header[0]->kota;
		$detail = $this->penjualan_order_m->get_detail($id_order,$id_order_det);
		$this->form_data->id_order_det = $id_order_det;
		$this->form_data->kode_barang = $detail[0]->kode_barang;
		$this->form_data->nama_barang = $detail[0]->nama_barang;
		$this->form_data->satuan = $detail[0]->satuan;
		$this->form_data->kuantitas = $detail[0]->kuantitas;
		$this->form_data->harga = $detail[0]->harga;
		$this->form_data->keterangan = $detail[0]->keterangan;
		$data['ceksj']	= $this->penjualan_order_m->ceksuratjalan($id_order,$id_order_det);
		$data['action_form'] = base_url('penjualan_order_/save_detil');
		$data['page'] = 'penjualan/v_edit_penjualan_order_det';
		$this->load->view('template/index',$data);
	}
	function save_detil(){
		$getPost = $this->input->post(null,true);
		$where = elements(array('id_order','id_order_det'),$getPost);
		$set = elements(array('kuantitas','satuan','harga','keterangan'),$getPost);
		$this->update->update2('order_det',$set,$where);
		
		$nodok['id_order'] = $getPost['id_order'];
		$select = array('no_dokumen','id_order');
		$get = $this->getdatatabel->getbyid('order',$select,$nodok);
		$set_sess = array('key_sess'=>$get['no_dokumen'],'filter_sess'=>'f1');
		$this->session->set_userdata($set_sess);
		echo json_encode(base_url('penjualan_laporder/filter'));
	}
	function hapus_item(){
		$postData = $this->input->post(null,true);
		$id_order_det = $postData[0];
		$id_order = $postData[1];
		$hapus = $this->hapus->HapusMaster2(array('id_order_det'=>$id_order_det,'id_order'=>$id_order),'order_det');
		//if($hapus){
			$hasil = $this->penjualan_order_m->getsubtotal($id_order);
			$hasil = $hasil+array("status"=>"true")+array("msg"=>"")+array("id_order"=>$id_order);
		//}
		echo json_encode($hasil);
	}
	
	function aprove_order(){
		$id_order = $this->input->post('id_order');
		$nodok['id_order'] = $id_order;
		$select = array('no_dokumen','id_order');
		$get = $this->getdatatabel->getbyid('order',$select,$nodok);
		$set_sess = array('key_sess'=>$get['no_dokumen'],'filter_sess'=>'f1');
		$this->session->set_userdata($set_sess);
		echo json_encode('penjualan_laporder/filter');
	}
}
