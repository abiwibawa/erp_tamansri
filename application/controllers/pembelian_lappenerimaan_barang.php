<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class pembelian_lappenerimaan_barang extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model(array('m_pembelian_penerimaan_barang'));
		$this->form_data = new StdClass;
    }
	
	public function index()
	{
		$where = '';
		$this->form_data->value = "";
		$this->form_data->cmb = "";
		$data['list'] = $this->m_pembelian_penerimaan_barang->getLapPenerimaan($where);
		$data['page'] = 'pembelian/v_pembelian_lappenerimaan_barang';
		$this->load->view('template/index',$data);
	}
	
	function filter(){
		$filter = $this->input->post('filter');
		$value = $this->input->post('value');
		$where = "and $filter = '$value'";
		$this->form_data->value = $value;
		$this->form_data->cmb = $filter;
		$data['list'] = $this->m_pembelian_penerimaan_barang->getLapPenerimaan($where);
		$data['page'] = 'pembelian/v_pembelian_lappenerimaan_barang';
		$this->load->view('template/index',$data);
	}
	
	function detail_modal(){
		$surat_jalan = $this->input->post('id_order');
		$tabel = $this->m_pembelian_penerimaan_barang->showDetail("AND d.no_surat_jalan = '$surat_jalan'");
		$hasil['vtabel'] = $tabel['vtabel'];
		
		echo json_encode($hasil);
	}
	//belum selesai
	function edit($surat_jalan){
		$data['data_master'] = $this->m_pembelian_penerimaan_barang->getLapPenerimaan("AND d.no_surat_jalans = '$surat_jalan'");
		$data['page']='pembelian/v_pembelian_penerimaan_barang';
		foreach($data['data_master'] as $row){
		echo $row->no_surat;
		}
		//$this->load->view('template/index',$data);
	}
	//belum selesai
	function hapus(){
		
	}
}
