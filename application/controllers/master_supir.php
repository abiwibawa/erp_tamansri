<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class master_supir extends CI_Controller{
	function __construct() {
		parent::__construct();
		//$this->load->model('m_master_barang');
    }
	
	public function index()
	{
		$data['data_master'] = $this->m_master_jenis_barang->getAll('mastersupir');
		$data['page']='master/v_master_supir';
		$this->load->view('template/index',$data);
	}
	
	function addmodal(){
		$this->form_data->id_supir="";
		$this->form_data->kode_supir="";
		$this->form_data->nama="";
		$this->form_data->alamat="";
		$this->form_data->kota="";
		$this->form_data->notelp="";
		
		$this->load->view('page/master/modal/mod_master_supir');
	}
	
	function tambah(){
		$this->form_validation->set_rules('kode_supir','kode_supir','trim|required|xss_clean');
		$this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$simpan = array(
							'kode_supir'=>$this->input->post('kode_supir'),
							'nama'=>$this->input->post('nama'),
							'alamat'=>$this->input->post('alamat'),
							'kota'=>$this->input->post('kota'),
							'notelp'=>$this->input->post('notelp'));
			$this->simpan->SimpanMaster('mastersupir',$simpan);
		}
		redirect('master_supir');
	}
	
	function editmodal(){
		$tabel = 'mastersupir';
		$select = array('id_supir','kode_supir','nama','alamat','kota','notelp');
		$where = array('id_supir'=>$this->input->post('id'));
		$data_edit = $this->m_master_jenis_barang->getById($tabel,$select,$where);
		
		$this->form_data->id_supir=$data_edit['id_supir'];
		$this->form_data->kode_supir=$data_edit['kode_supir'];
		$this->form_data->nama=$data_edit['nama'];
		$this->form_data->alamat=$data_edit['alamat'];
		$this->form_data->kota=$data_edit['kota'];
		$this->form_data->notelp=$data_edit['notelp'];
		
		$this->load->view('page/master/modal/mod_master_supir');
	}
	
	function update(){
		$this->form_validation->set_rules('kode_supir','kode_supir','trim|required|xss_clean');
		$this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$tabel = "mastersupir";
			$data = array(
							'kode_supir'=>$this->input->post('kode_supir'),
							'nama'=>$this->input->post('nama'),
							'alamat'=>$this->input->post('alamat'),
							'kota'=>$this->input->post('kota'),
							'notelp'=>$this->input->post('notelp'));
			$where = array('id_supir'=>$this->input->post('id_supir'));
			$this->update->update2($tabel,$data,$where);
		}
		redirect('master_supir');
	}
	
	function viewdet(){
		$tabel = 'mastersupir';
		$select = array('id_supir','kode_supir','nama','alamat','kota','notelp');
		$where = array('id_supir'=>$this->input->post('id'));
		$data_edit = $this->m_master_jenis_barang->getById($tabel,$select,$where);
		
		$this->form_data->id_supir=$data_edit['id_supir'];
		$this->form_data->kode_supir=$data_edit['kode_supir'];
		$this->form_data->nama=$data_edit['nama'];
		$this->form_data->alamat=$data_edit['alamat'];
		$this->form_data->kota=$data_edit['kota'];
		$this->form_data->notelp=$data_edit['notelp'];
		
		$this->load->view('page/master/modal/mod_master_supir');
	}
}
