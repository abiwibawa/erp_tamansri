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
		$data['cek_form'] = "";
		$data['list'] = $this->m_pembelian_penerimaan_barang->getLapPenerimaan($where);
		$data['page'] = 'pembelian/v_pembelian_lappenerimaan_barang';
		$this->load->view('template/index',$data);
	}
	
	function filter(){
		$filter = $this->input->post('filter');
		$value = $this->input->post('value');
		if($filter=="" || $value==""){
			$where = "";
			$this->form_data->value = "";
		}else if ($filter == "a.tanggal" || $value=="") {
			# code...
			$tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
			$where = "where $filter = '$tanggal'";
			$this->form_data->value = date('d/m/Y',strtotime($tanggal));
		}else{
			$where = "where $filter = '$value'";
			$this->form_data->value = $value;
		}
		$this->form_data->cmb = $filter;
		$data['list'] = $this->m_pembelian_penerimaan_barang->getLapPenerimaan($where);
		$data['page'] = 'pembelian/v_pembelian_lappenerimaan_barang';
		//echo $data['cek_form'];
		$this->load->view('template/index',$data);
	}
	
	function detail_modal(){
		$surat_jalan = $this->input->post('id_order');
		$tabel = $this->m_pembelian_penerimaan_barang->showDetail($surat_jalan);
		$hasil['vtabel'] = $tabel['vtabel'];
		
		echo json_encode($hasil);
	}
	//belum selesai
	function edit($where){
		$data['data_master'] = $this->m_pembelian_penerimaan_barang->getLapPenerimaan("where a.id_penerimaan_h = $where");
		foreach($data['data_master'] as $row){
			$this->form_data->surat_pemesanan = $row->no_surat;
			$this->form_data->id_pemesanan_h = $row->id_pemesanan_h;
			$this->form_data->id_pemesanan_d = $row->id_pemesanan_d;
			$this->form_data->id_suplier = $row->kode_suplier;
			$this->form_data->nama_suplier = $row->nama;
			$this->form_data->alamat_suplier = $row->alamat;
			$this->form_data->telp_suplier = $row->telpon;
			$this->form_data->tanggal = $row->tanggal;
			$this->form_data->surat_jalan = $row->no_surat_jalan;
			$this->form_data->nopol_kendaraan = $row->no_pol;
			$this->form_data->jam = $row->jam;
			$data['data'] = $this->m_pembelian_penerimaan_barang->getAll($row->id_pemesanan_h, $row->id_penerimaan_h);
			/*$data = $this->m_pembelian_penerimaan_barang->getAll($row->id_pemesanan_h);*/
		}
		$data['page']='pembelian/v_pembelian_penerimaan_barang';
		/*echo json_encode($data);*/
		$this->load->view('template/index',$data);
		//$this->load->view('template/index',$data);
	}
	//belum selesai
	function cetak($id_penerimaan_h){
		$data['data_master'] = $this->m_pembelian_penerimaan_barang->getLapPenerimaan("where a.id_penerimaan_h = $id_penerimaan_h");
		foreach ($data['data_master'] as $key ) {
			# code.
			$data['nama_suplier'] = $key->nama;
			$data['alamat_suplier'] = $key->alamat;
			$data['telp'] = $key->telpon;
			$data['no_pol'] = $key->no_pol;
			$data['jam'] = $key->jam;
			$data['listBarang'] = $this->m_pembelian_penerimaan_barang->getListBarang($id_penerimaan_h);
		}
		$this->load->view('page/pembelian/v_cetak_penerimaan_barang',$data);
	}
}
