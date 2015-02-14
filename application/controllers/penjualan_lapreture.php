<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_lapreture extends CI_Controller{
	function __construct() {
		parent::__construct();
    }
	
	public function index()
	{
		$data['action_form'] = base_url('penjualan_order/saveorder');
		$data['page'] = 'penjualan/v_penjualan_lapreture';
		$this->load->view('template/index',$data);
	}
}
