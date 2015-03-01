<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class master_perkiraan extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model(array('tree_model','m_master_perkiraan'));
		$this->load->library('tree');
    }
	public function index(){
		$data['menu_tree'] = $this->tree_model->kode_perkiraan();
		$data['data_master'] = $this->m_master_jenis_barang->getAll('kode_perkiraan');
		$data['page']='master/v_master_perkiran';
		$this->load->view('template/index',$data);
	}
	function addmodal(){
		$id=$this->input->post('id');
		$this->form_data->id_perkiraan=$id;
		$this->form_data->no_perkiraan="";
		$this->form_data->uraian="";	
		$this->load->view('page/master/modal/mod_master_perkiraan');
	}
	function tambah(){
		$this->form_validation->set_rules('no_perkiraan','no_perkiraan','trim|required|xss_clean');
		$this->form_validation->set_rules('uraian','uraian','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$getPost = $this->input->post(null,true);
			$simpan = elements(array("id_perkiraan","no_perkiraan","uraian"),$getPost);
			//$this->simpan->SimpanMaster('kode_perkiraan',$simpan);
			$this->m_master_perkiraan->simpan($simpan);
		}
		redirect('master_perkiraan');
	}
	function editmodal(){
		$tabel = 'kode_perkiraan';
		$select = array('id_perkiraan','no_perkiraan','uraian');
		$where = array('id_perkiraan'=>$this->input->post('id'));
		$data_edit = $this->m_master_jenis_barang->getById($tabel,$select,$where);
		$this->form_data->id_perkiraan=$data_edit['id_perkiraan'];
		$this->form_data->no_perkiraan=$data_edit['no_perkiraan'];
		$this->form_data->uraian=$data_edit['uraian'];
		$this->load->view('page/master/modal/mod_master_perkiraan');
	}
	function update(){
		$this->form_validation->set_rules('no_perkiraan','no_perkiraan','trim|required|xss_clean');
		$this->form_validation->set_rules('uraian','uraian','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$tabel = "kode_perkiraan";
			$getPost = $this->input->post(null,true);
			$data = elements(array("no_perkiraan","uraian"),$getPost);
			$where = array('id_perkiraan'=>$getPost['id_perkiraan']);
			$this->update->update2($tabel,$data,$where);
		}
		redirect('master_perkiraan');
	}
	function viewdet(){
		$tabel = 'kode_perkiraan';
		$select = array('id_perkiraan','no_perkiraan','uraian');
		$where = array('id_perkiraan'=>$this->input->post('id'));
		$data_edit = $this->m_master_jenis_barang->getById($tabel,$select,$where);	
		$this->form_data->id_perkiraan=$data_edit['id_perkiraan'];
		$this->form_data->no_perkiraan=$data_edit['no_perkiraan'];
		$this->form_data->uraian=$data_edit['uraian'];
		$this->load->view('page/master/modal/mod_master_perkiraan');
	}
}
