<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_stokbarang extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model(array('penjualan_stokbarang_m'));
    }
	
	public function index()
	{
		$data['action_form'] = "";
		$data['data'] = $this->penjualan_stokbarang_m->data();
		$data['page'] = 'penjualan/v_penjualan_stokbarang';
		$this->load->view('template/index',$data);
	}
}
