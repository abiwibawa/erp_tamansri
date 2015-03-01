<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_fp extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model(array('penjualan_fp_m','penjualan_invoice_m','gp_m'));
    }
	
	public function index()
	{
		$data['perusahaan']=$this->penjualan_fp_m->tampilperusahaan(1);
		$data['faktur']=$this->penjualan_fp_m->tampilnofaktur();
		$data['action_form'] = base_url('penjualan_order/saveorder');
		$data['page'] = 'penjualan/v_penjualan_fp';
		$this->load->view('template/index',$data);
	}
	
	public function edit($id_faktur_pajak=null)
	{		

		$data['perusahaan']=$this->penjualan_fp_m->tampilperusahaan(1);
		
		$data['data']=$this->penjualan_fp_m->tampileditfp($id_faktur_pajak);
		$data['no_surat_jalan']=$this->gp_m->TampilCepat('no_surat_jalan','ordersuratjalan','id_surat_jalan',$data['data']->id_surat_jalan);
		$data['tanda_tangan_surat']=$this->gp_m->TampilCepat('nama','mastertandatangan','id_ttd',$data['data']->id_ttd);
		
		$customer=$this->gp_m->TampilCepat(array('nama','alamat','npwp','kota'),'mastercustomer','id_customer',$data['data']->id_customer);
		$data['nama_customer']=$customer->nama;
		$data['alamat_customer']=$customer->alamat;
		$data['npwp']=$customer->npwp;
		$data['kota']=$customer->kota;
		
		$data['action_form'] = base_url('penjualan_order/editorder');
		$data['page'] = 'penjualan/v_penjualan_fp_edit';
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
	
	function update(){
		$id_cetak=$this->penjualan_fp_m->updatefakturpajak();	
		
		$data=array('status'=>'sukses','id_cetak'=>$id_cetak);
	
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
	
	function carisuratjalanreload(){
		$key = $this->input->post('key');
		$this->form_data->key=$key;
		$this->form_data->filter='';
		$data['list'] = $this->penjualan_fp_m->carisuratjalan($key);
		echo $this->load->view('popup/carisuratjalan_fptable',$data);		
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