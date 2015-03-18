<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class pembelian_penerimaan extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('m_master_barang');
    }
	
	public function index()
	{
		$data['data_master'] = $this->m_master_barang->getAll();
		$data['page']='pembelian/v_pembelian_penerimaan_barang';
		$this->load->view('template/index',$data);
	}
	
	function detail(){
		$data['page']='pembelian/v_pembelian_penerimaan_barang_det';
		$this->load->view('template/index',$data);
	}
}
