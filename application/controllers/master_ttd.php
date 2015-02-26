<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class master_ttd extends CI_Controller{
	function __construct() {
		parent::__construct();
		//$this->load->model('m_master_barang');
    }
	
	public function index()
	{
		$data['data_master'] = $this->m_master_jenis_barang->getAll('mastertandatangan');
		$data['page']='master/v_master_ttd';
		$this->load->view('template/index',$data);
	}
	
	function addmodal(){
		$this->form_data->id_ttd="";
		$this->form_data->nama="";
		$this->form_data->jabatan="";
		
		$this->load->view('page/master/modal/mod_master_ttd');
	}
	
	function tambah(){
		$this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
		$this->form_validation->set_rules('jabatan','jabatan','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$simpan = array(
							'nama'=>$this->input->post('nama'),
							'jabatan'=>$this->input->post('jabatan'));
			$this->simpan->SimpanMaster('mastertandatangan',$simpan);
		}
		redirect('master_ttd');
	}
	
	function editmodal(){
		$tabel = 'mastertandatangan';
		$select = array('id_ttd','nama','jabatan');
		$where = array('id_ttd'=>$this->input->post('id'));
		$data_edit = $this->m_master_jenis_barang->getById($tabel,$select,$where);
		
		$this->form_data->id_ttd=$data_edit['id_ttd'];
		$this->form_data->nama=$data_edit['nama'];
		$this->form_data->jabatan=$data_edit['jabatan'];
		
		$this->load->view('page/master/modal/mod_master_ttd');
	}
	
	function update(){
		$this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
		$this->form_validation->set_rules('jabatan','jabatan','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$tabel = "mastertandatangan";
			$data = array(
							'nama'=>$this->input->post('nama'),
							'jabatan'=>$this->input->post('jabatan'));
			$where = array('id_ttd'=>$this->input->post('id_ttd'));
			$this->update->update2($tabel,$data,$where);
		}
		redirect('master_ttd');
	}
	
	function viewdet(){
		$tabel = 'mastertandatangan';
		$select = array('id_ttd','nama','jabatan');
		$where = array('id_ttd'=>$this->input->post('id'));
		$data_edit = $this->m_master_jenis_barang->getById($tabel,$select,$where);
		
		$this->form_data->id_ttd=$data_edit['id_ttd'];
		$this->form_data->nama=$data_edit['nama'];
		$this->form_data->jabatan=$data_edit['jabatan'];
		
		$this->load->view('page/master/modal/mod_master_ttd');
	}
}
