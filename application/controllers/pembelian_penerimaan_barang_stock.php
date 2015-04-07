<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class pembelian_penerimaan_barang_stock extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model(array('m_stok_barang'));
		$this->form_data = new StdClass;
    }
	

	public function index(){	
		//$data['data'] = $this->m_pembelian_penerimaan_barang->getAll(0,0);
		$this->form_data->cmb_jenis = "";
		$this->form_data->cmb_suplier = "";
		$this->form_data->tanggal = "";
		$this->form_data->cmb_bulan = "";
		$this->form_data->cmb_tahun = "";
		$data['cmb_jenis_barang'] = $this->m_stok_barang->cmbjenisbarang();
		$data['cmb_suplier'] = $this->m_stok_barang->cmbsuplier();
		$data['cmb_tahun'] = $this->m_stok_barang->cmb_tahun();
		$data['cmb_bulan'] = $this->m_stok_barang->cmb_bulan();
		$data['header'] = "Stock Penerimaan Barang";
		$data['header_title'] = "Data Stock";
		$data['page']='pembelian/v_pembelian_penerimaan_barang_stock';
		/*$data['data'] = $this->m_stok_barang->get_stok();*/
		$data['data'] = $this->m_stok_barang->get_all();
		$data['url'] = base_url('pembelian_penerimaan_barang_stock/cari_data');
		$this->load->view('template/index',$data);
	}

	function detil(){
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$tabel = $this->m_stok_barang->showDetail($tahun, $bulan);
		$hasil['vtabel'] = $tabel['vtabel'];
		
		echo json_encode($hasil);
		//echo $tabel;
	}


	function filter(){
	################## Filter untuk tanggal belum diperbaiki #######################
		$tanggal = $this->input->post('tanggal');
		$suplier = $this->input->post('suplier');
		$jenis = $this->input->post('jenis');

		//Jika semua kosong
		if (empty($tanggal) && empty($suplier) && empty($jenis)) {
			$where = "";
		} 
		// Tanggal ada suplier dan jenis kosong
		else if(!empty($tanggal) && empty($suplier) && empty($jenis)) {
			$tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
			$where = "WHERE b.tanggal = '".$tanggal."'";
		} 
		// Tanggal kosong suplier ada dan jenis kosong
		else if(empty($tanggal) && (!empty($suplier)) && empty($jenis)) {
			$where = "WHERE e.id_suplier = '".$suplier."'";
		} 
		// Tanggal kosong suplier kosong dan jenis ada
		else if(empty($tanggal) && (empty($suplier)) && (!empty($jenis))) {
			$where = "WHERE c.id_jenis_barang = ".$jenis."";
		} 
		// Tanggal kosong suplier ada jenis ada
		else if(empty($tanggal) && (!empty($suplier)) && (!empty($jenis))) {
			$where = "WHERE c.id_jenis_barang = ".$jenis." AND e.id_suplier = ".$suplier."";
		} 
		// Tanggal ada suplier ada jenis kosong
		else if((!empty($tanggal)) && (!empty($suplier)) && (empty($jenis))) {
			$tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
			$where = "WHERE e.id_suplier = ".$suplier." AND b.tanggal = '".$tanggal."'";
		} 
		// Tanggal ada suplier kosong jenis ada
		else if((!empty($tanggal)) && (empty($suplier)) && (!empty($jenis))) {
			$tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
			$where = "WHERE b.tanggal = '".$tanggal."' AND c.id_jenis_barang = ".$jenis."";
		} 
		// Tanggal ada suplier ada jenis ada
		else if((!empty($tanggal)) && (!empty($suplier)) && (!empty($jenis))) {
			$tanggal = date('Y-m-d',strtotime($this->input->post('tanggal')));
			$where = "WHERE b.tanggal = '".$tanggal."' AND c.id_jenis_barang = ".$jenis." AND e.id_suplier = ".$suplier."";
		}
		
		$this->form_data->cmb_jenis = $jenis;
		$this->form_data->cmb_suplier = $suplier;
		$this->form_data->tanggal = $this->input->post('tanggal');
		$data['cmb_jenis_barang'] = $this->m_stok_barang->cmbjenisbarang();
		$data['cmb_suplier'] = $this->m_stok_barang->cmbsuplier();
		$data['header'] = "Stock Penerimaan Barang";
		$data['header_title'] = "Data Stock";
		$data['page']='pembelian/v_pembelian_penerimaan_barang_stock';
		$data['url'] = base_url('pembelian_penerimaan_barang_stock/filter');
		$data['data'] = $this->m_stok_barang->get_stok($where);
		//echo $where;
		$this->load->view('template/index',$data);
	}

	function cari_data(){
		########## no ################################
		$this->form_data->cmb_jenis = "";
		$this->form_data->cmb_suplier = "";
		$this->form_data->tanggal = $this->input->post('tanggal');
		########## no #################################
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		$this->form_data->cmb_bulan = $bulan;
		$this->form_data->cmb_tahun = $tahun;
		$where = "where bulan = '$bulan' and tahun = $tahun";
		$data['cmb_jenis_barang'] = $this->m_stok_barang->cmbjenisbarang();
		$data['cmb_suplier'] = $this->m_stok_barang->cmbsuplier();
		$data['header'] = "Stock Penerimaan Barang";
		$data['header_title'] = "Data Stock";
		$data['page']='pembelian/v_pembelian_penerimaan_barang_stock';
		$data['url'] = base_url('pembelian_penerimaan_barang_stock/cari_data');
		$data['cmb_tahun'] = $this->m_stok_barang->cmb_tahun();
		$data['cmb_bulan'] = $this->m_stok_barang->cmb_bulan();
		$data['data'] = $this->m_stok_barang->get_all($where);
		//echo $where;
		$this->load->view('template/index',$data);
	}

	function config_page($url,$total_row){
		$config['base_url']=$url;
		$config['total_rows']=$total_row;
		$config['per_page']=10;
		
		$config['full_tag_open'] = '<div align="center"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div>';
		 
		$config['first_link'] = '&laquo; Pertama';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		 
		$config['last_link'] = 'Terakhir &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>'; 
		 
		$config['next_link'] = 'Selanjutnya &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';
		 
		$config['prev_link'] = '&larr; Sebelumnya';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';
		 
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		 
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		
		$config['uri_segment'] = 3;
		$config['enable_query_strings'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
		
		return $config;
	}
}