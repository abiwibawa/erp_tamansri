<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_invoice extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('penjualan_invoice_m');
    }
	
	public function index()
	{
		$data['page'] = 'penjualan/v_penjualan_invoice';
		$this->load->view('template/index',$data);
	}
	
	function simpan(){
		if($this->penjualan_invoice_m->ceksuratjalan($this->input->post('id_surat_jalan'))){
			$simpan = array(	"no_invoice"=>$this->input->post('no_invoice'),
								"id_surat_jalan"=>$this->input->post('id_surat_jalan'),
								"id_order"=>$this->input->post('id_order'),
								"tanggal"=>date('Y-m-d',strtotime($this->input->post('tanggal'))),
								"id_customer"=>$this->input->post('id_customer'),
								"subtotal"=>$this->input->post('subtotal'),
								"ppn"=>$this->input->post('ppn'),
								"total"=>$this->input->post('total'),
								"id_ttd"=>$this->input->post('id_ttd')
								);
			$id_cetak=$this->penjualan_invoice_m->simpaninvoice($simpan);	
			
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
		$data['list'] = $this->penjualan_invoice_m->carisuratjalan($key);
		$data['page'] = 'popup/carisuratjalan';
		$this->load->view('popup/popup',$data);		
	}	
	
	function carisuratjalanreload(){
		$key = $this->input->post('key');
		$this->form_data->key=$key;
		$this->form_data->filter='';
		$data['list'] = $this->penjualan_invoice_m->carisuratjalan($key);
		echo $this->load->view('popup/carisuratjalantable',$data);		
	}	
	
	function caritandatangansurat(){
		$key = $this->input->post('key');
		$this->form_data->key=$key;
		$this->form_data->filter='';
		$data['list'] = $this->penjualan_invoice_m->caritandatangansurat($key);
		$data['page'] = 'popup/caritandatangansurat';
		$this->load->view('popup/popup',$data);		
	}	
	
	function cetak(){
		$data['data'] = $this->penjualan_invoice_m->cetak($this->uri->segment(3));
		$data['detailinvoice'] = $this->penjualan_invoice_m->detailinvoice2($this->uri->segment(4));
		$this->load->view('page/penjualan/v_cetak_penjualan_invoice',$data);
	}
	
	function detailinvoice(){
		$id_surat_jalan = $this->input->post('id_surat_jalan');
		$data = $this->penjualan_invoice_m->detailinvoice($id_surat_jalan);
		echo json_encode($data);
	}
	
}
