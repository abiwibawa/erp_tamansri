<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class master_customers extends CI_Controller{
	function __construct() {
		parent::__construct();
		//$this->load->model('m_master_barang');
    }
	
	public function index()
	{
		$data['data_master'] = $this->m_master_jenis_barang->getAll('mastercustomer');
		$data['page']='master/v_master_customers';
		$this->load->view('template/index',$data);
	}
	
	function addmodal(){
		$this->form_data->id_customer="";
		$this->form_data->kode_customer="";
		$this->form_data->nama="";
		$this->form_data->inisial="";
		$this->form_data->alamat="";
		$this->form_data->kota="";
		$this->form_data->kodepos="";
		$this->form_data->telpon="";
		$this->form_data->email="";
		$this->form_data->npwp="";
		
		$this->load->view('page/master/modal/mod_master_customers');
	}
	
	function tambah(){
		$this->form_validation->set_rules('kode_customer','kode_customer','trim|required|xss_clean');
		$this->form_validation->set_rules('inisial','inisial','trim|required|xss_clean');
		$this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$simpan = array(
							'kode_customer'=>$this->input->post('kode_customer'),
							'nama'=>$this->input->post('nama'),
							'inisial'=>$this->input->post('inisial'),
							'alamat'=>$this->input->post('alamat'),
							'kota'=>$this->input->post('kota'),
							'kodepos'=>$this->input->post('kodepos'),
							'telpon'=>$this->input->post('telpon'),
							'email'=>$this->input->post('email'),
							'npwp'=>$this->input->post('npwp'));
			$this->simpan->SimpanMaster('mastercustomer',$simpan);
		}
		redirect('master_customers');
	}
	
	function editmodal(){
		$tabel = 'mastercustomer';
		$select = array('id_customer','kode_customer','nama','inisial','alamat','kota','kodepos','telpon','email','npwp');
		$where = array('id_customer'=>$this->input->post('id'));
		$data_edit = $this->m_master_jenis_barang->getById($tabel,$select,$where);
		
		$this->form_data->id_customer=$data_edit['id_customer'];
		$this->form_data->kode_customer=$data_edit['kode_customer'];
		$this->form_data->nama=$data_edit['nama'];
		$this->form_data->inisial=$data_edit['inisial'];
		$this->form_data->alamat=$data_edit['alamat'];
		$this->form_data->kota=$data_edit['kota'];
		$this->form_data->kodepos=$data_edit['kodepos'];
		$this->form_data->telpon=$data_edit['telpon'];
		$this->form_data->email=$data_edit['email'];
		$this->form_data->npwp=$data_edit['npwp'];
		$this->load->view('page/master/modal/mod_master_customers');
	}
	
	function update(){
		$this->form_validation->set_rules('inisial','inisial','trim|required|xss_clean');
		$this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$tabel = "mastercustomer";
			$data = array(
							'kode_customer'=>$this->input->post('kode_customer'),
							'nama'=>$this->input->post('nama'),
							'inisial'=>$this->input->post('inisial'),
							'alamat'=>$this->input->post('alamat'),
							'kota'=>$this->input->post('kota'),
							'kodepos'=>$this->input->post('kodepos'),
							'telpon'=>$this->input->post('telpon'),
							'email'=>$this->input->post('email'),
							'npwp'=>$this->input->post('npwp'));
			$where = array('id_customer'=>$this->input->post('id_customer'));
			$this->update->update2($tabel,$data,$where);
		}
		redirect('master_customers');
	}
	
	function viewdet(){
		$tabel = 'mastercustomer';
		$select = array('id_customer','kode_customer','nama','inisial','alamat','kota','kodepos','telpon','email','npwp');
		$where = array('id_customer'=>$this->input->post('id'));
		$data_edit = $this->m_master_jenis_barang->getById($tabel,$select,$where);
		
		$this->form_data->id_customer=$data_edit['id_customer'];
		$this->form_data->kode_customer=$data_edit['kode_customer'];
		$this->form_data->nama=$data_edit['nama'];
		$this->form_data->inisial=$data_edit['inisial'];
		$this->form_data->alamat=$data_edit['alamat'];
		$this->form_data->kota=$data_edit['kota'];
		$this->form_data->kodepos=$data_edit['kodepos'];
		$this->form_data->telpon=$data_edit['telpon'];
		$this->form_data->email=$data_edit['email'];
		$this->form_data->npwp=$data_edit['npwp'];
		$this->load->view('page/master/modal/mod_detmaster_customers');
	}
}
