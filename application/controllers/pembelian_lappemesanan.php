<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class pembelian_lappemesanan extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('pembelian_lappemesanan_m');
    }
	
	public function index()
	{
		
		$this->form_data->key='';
		$this->form_data->filter='';
		$this->form_data->tanggal1='';
		$this->form_data->tanggal2='';
		$data['page'] = 'pembelian/v_pembelian_lappemesanan';
		$data['data'] = $this->pembelian_lappemesanan_m->listpemesan();
		$this->load->view('template/index',$data);
	}
	
	
	function daftarriwayatinvoice(){
		//$filter = $this->uri->segment(3);
		//$key = $this->uri->segment(4);
		$filter = $this->input->post('filter');
		$key = $this->input->post('key');
		$data = $this->penjualan_lapinvoice_m->daftarriwayatinvoice($filter,$key);
		echo json_encode($data);
	}
}
