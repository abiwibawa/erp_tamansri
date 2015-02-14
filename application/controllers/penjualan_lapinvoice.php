<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_lapinvoice extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('penjualan_lapinvoice_m');
    }
	
	public function index()
	{
		$data['page'] = 'penjualan/v_penjualan_lapinvoice';
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
