<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class master_barang extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('m_master_barang');
    }
	
	public function index()
	{
		$data['data_master'] = $this->m_master_barang->getAll();
		$data['page']='master/v_master_barang';
		$this->load->view('template/index',$data);
	}
	
	function addmodal(){
		$this->form_data->id_barang="";
		$this->form_data->id_jenis_barang="";
		$this->form_data->kode="";
		$this->form_data->nama="";
		$data['cmbjenisbarang'] = $this->m_master_barang->cmbjenisbarang();
		$this->load->view('page/master/modal/mod_master_barang',$data);
	}
	
	function tambah(){
		$this->form_validation->set_rules('kode','kode','trim|required|xss_clean');
		$this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$simpan = array('kode_barang'=>$this->input->post('kode'),
						'nama_barang'=>$this->input->post('nama'),
						'id_jenis_barang'=>$this->input->post('id_jenis_barang'));
			$this->simpan->SimpanMaster('masterbarang',$simpan);
		}
		redirect('master_barang');
	}
	
	function editmodal(){
		$tabel = 'masterbarang';
		$select = array('id_barang','id_jenis_barang','kode_barang','nama_barang');
		$where = array('id_barang'=>$this->input->post('id'));
		$data_edit = $this->m_master_jenis_barang->getById($tabel,$select,$where);
		
		$this->form_data->id_barang=$data_edit['id_barang'];
		$this->form_data->id_jenis_barang=$data_edit['id_jenis_barang'];
		$this->form_data->kode=$data_edit['kode_barang'];
		$this->form_data->nama=$data_edit['nama_barang'];
		$data['cmbjenisbarang'] = $this->m_master_barang->cmbjenisbarang();
		$this->load->view('page/master/modal/mod_master_barang',$data);
	}
	
	function update(){
		$this->form_validation->set_rules('kode','kode','trim|required|xss_clean');
		$this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$tabel = "masterbarang";
			$data = array('kode_barang'=>$this->input->post('kode'),
						'nama_barang'=>$this->input->post('nama'),
						'id_jenis_barang'=>$this->input->post('id_jenis_barang'));
			$where = array('id_barang'=>$this->input->post('id_barang'));
			$this->update->update2($tabel,$data,$where);
		}
		redirect('master_barang');
	}
}
