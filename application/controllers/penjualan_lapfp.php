<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_lapfp extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model(array('penjualan_lapfakturpajak_m','penjualan_fp_m'));
    }
	
	public function index()
	{
		$data['action_form'] = base_url('penjualan_order/saveorder');
		$data['page'] = 'penjualan/v_penjualan_lapfpp';
		$this->load->view('template/index',$data);
	}
	
	function daftarriwayatfakturpajak(){
		//$filter = $this->uri->segment(3);
		//$key = $this->uri->segment(4);
		$filter = $this->input->post('filter');
		$key = $this->input->post('key');
		$data = $this->penjualan_lapfakturpajak_m->daftarriwayatfakturpajak($filter,$key);
		echo json_encode($data);
	}
	
	function cetak(){
		$data['perusahaan']=$this->penjualan_fp_m->tampilperusahaan(1);
		$data['data'] = $this->penjualan_fp_m->cetak($this->uri->segment(3));
		$data['detailfakturpajak'] = $this->penjualan_fp_m->detailfakturpajak2($data['data']->id_surat_jalan);
		$this->load->view('page/penjualan/v_cetak_penjualan_faktur_pajak',$data);
	}
}
