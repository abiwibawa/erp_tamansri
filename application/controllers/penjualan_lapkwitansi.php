<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_lapkwitansi extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->Model(array("penjualan_lapkwitansi_m"));
		$this->load->library(array("terbilang_lib"));
    }
	
	function index(){
		$this->form_data->filter = "";
		$this->form_data->key = "";
		$this->form_data->tanggal1 = "";
		$this->form_data->tanggal2 = "";
		$data['data'] = $this->penjualan_lapkwitansi_m->GetData();
		$data['judullaporan'] = "";
		$data['page'] = 'penjualan/v_penjualan_lapkwitansi';
		$this->load->view('template/index',$data);
	}
}