<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_fp extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model(array('penjualan_fp_m','penjualan_invoice_m'));
    }
	
	public function index()
	{
		$data['perusahaan']=$this->penjualan_fp_m->tampilperusahaan(1);
		$data['faktur']=$this->penjualan_fp_m->tampilnofaktur();
		$data['action_form'] = base_url('penjualan_order/saveorder');
		$data['page'] = 'penjualan/v_penjualan_fp';
		$this->load->view('template/index',$data);
	}
	
	
	function simpan(){
		if($this->penjualan_fp_m->ceknofaktur($this->input->post('id_no_faktur'))){
			$id_cetak=$this->penjualan_fp_m->simpanfakturpajak();	
			
			$data=array('status'=>'sukses','id_cetak'=>$id_cetak);
		}else{
			$data=array('status'=>'gagal');
		}
		echo json_encode($data);
		//echo json_encode(array("res"=>$this->input->post()));
		//$this->simpan->SimpanMaster('temp_order_det',$order_det);
	}
	
	
	function carisuratjalan(){
		$key = $this->input->post('key');
		$this->form_data->key=$key;
		$this->form_data->filter='';
		$data['list'] = $this->penjualan_fp_m->carisuratjalan($key);
		$data['page'] = 'popup/carisuratjalan_fp';
		$this->load->view('popup/popup',$data);		
	}	
	
	function detailitem(){
		$id_surat_jalan = $this->input->post('id_surat_jalan');
		$data = $this->penjualan_fp_m->detailitem($id_surat_jalan);
		echo json_encode($data);
	}
	
	function cetak(){
		$data['perusahaan']=$this->penjualan_fp_m->tampilperusahaan(1);
		$data['data'] = $this->penjualan_fp_m->cetak($this->uri->segment(3));
		$data['detailfakturpajak'] = $this->penjualan_fp_m->detailfakturpajak2($data['data']->id_surat_jalan);
		$this->load->view('page/penjualan/v_cetak_penjualan_faktur_pajak',$data);
	}
}