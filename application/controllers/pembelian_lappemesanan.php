<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class pembelian_lappemesanan extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model(array('pembelian_lappemesanan_m','pembelian_pemesanan_m','gp_m'));
    }
	
	public function index()
	{
		
		$this->form_data->tanggal1='';
		$this->form_data->tanggal2='';
		$this->form_data->filter='';
		$this->form_data->key='';
		if($this->input->post()){
			$this->form_data->filter=$this->input->post('filter');
			if($this->input->post('filter')=='f2'){
				$this->form_data->tanggal1=$this->input->post('tanggal1');
				$this->form_data->tanggal2=$this->input->post('tanggal2');
			}else{
				$this->form_data->key=$this->input->post('key');
			}
		}
		
		$data['page'] = 'pembelian/v_pembelian_lappemesanan';
		$data['data'] = $this->pembelian_lappemesanan_m->listpemesan();
		$this->load->view('template/index',$data);
	}
	
	function listdetail(){
		$id_pemesanan_h=$this->input->post('id_pemesanan_h');
		$data=$this->pembelian_pemesanan_m->listorderdetailhistory($id_pemesanan_h);
		$data['no_pemesanan']=$this->createnosurat->convertnosurat($id_pemesanan_h,'SP');
		echo json_encode($data);
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
