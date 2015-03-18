<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class pembelian_pemesanan extends CI_Controller{
	
	function __construct() {
		parent::__construct();
		$this->load->model(array('pembelian_pemesanan_m','gp_m'));
    }
	
	public function index()
	{
		$data['action_form'] = '';
		$data['page'] = 'pembelian/v_pembelian_pemesanan';
		$this->load->view('template/index',$data);
	}
	
	
	public function edit()
	{
		$data['action_form'] = '';
		$data['page'] = 'pembelian/v_pembelian_pemesanan_edit';
		$this->load->view('template/index',$data);
	}
	
	function listorderdetailedit(){
		echo json_encode($this->pembelian_pemesanan_m->listorderdetail($this->uri->segment(3)));
	}
	
	function simpan(){
		if($this->input->post('id_pemesanan_h')==''){
			echo $this->pembelian_pemesanan_m->simpanpemesanan();
		}else{
			echo $this->pembelian_pemesanan_m->updatepemesanan();
		}
	}	
	
	function update(){
		echo $this->pembelian_pemesanan_m->updatepemesanan();
	}
	
	function update_tambah_produk(){
		echo json_encode($this->pembelian_pemesanan_m->updatetambahpemesanan());
	}
	
	function listorderdetail(){
		$id_pemesanan_h=$this->input->post('id_pemesanan_h');
		echo $this->pembelian->pembelian_pemesanan_m->listorderdetail($id_pemesanan_h);
	}
	
	function carisuplier(){
		$key = $this->input->post('key');
		$filter = $this->input->post('filter');
		$this->form_data->key=$key;
		$this->form_data->filter=$filter;
		$data['list'] = $this->pembelian_pemesanan_m->carisuplier($key,$filter);
		$data['page'] = 'popup/carisuplier';
		$this->load->view('popup/popup',$data);
	}
	
	function hapus_tambah_barang(){
		$id_pemesanan_h=$this->input->post("id_pemesanan_h");
		$id_pemesanan_d=$this->input->post("id_pemesanan_d");
		$this->hapus->Master('pembelian_pemesanan_d',array("id_pemesanan_d"=>$id_pemesanan_d));	
		echo json_encode($this->pembelian_pemesanan_m->listorderdetail($id_pemesanan_h));
	}
	
		
	function cetak(){
		$data['perusahaan']=$this->pembelian_pemesanan_m->perusahaan(1);
		$data['listpemesanancetak']=$this->pembelian_pemesanan_m->listpemesanancetak($this->uri->segment(3));
		$data['tampilpenerima']=$this->pembelian_pemesanan_m->tampilpenerima($this->uri->segment(3));
		$this->load->view('page/pembelian/v_cetak_pesanan_barang',$data);
	}
}
	 