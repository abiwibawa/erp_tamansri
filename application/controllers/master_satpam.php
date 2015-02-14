<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class master_satpam extends CI_Controller{
	function __construct() {
		parent::__construct();
		//$this->load->model('m_master_barang');
    }
	
	public function index()
	{
		$data['data_master'] = $this->m_master_jenis_barang->getAll('mastersatpam');
		$data['page']='master/v_master_satpam';
		$this->load->view('template/index',$data);
	}
	
	function addmodal(){
		$this->form_data->id_satpam="";
		$this->form_data->kode_satpam="";
		$this->form_data->nama="";
		$this->form_data->kota="";
		$this->form_data->alamat="";
		$this->form_data->telp="";
		
		$this->load->view('page/master/modal/mod_master_satpam');
	}
	
	function tambah(){
		$this->form_validation->set_rules('kode_satpam','kode_customer','trim|required|xss_clean');
		$this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$simpan = array(
							'kode_satpam'=>$this->input->post('kode_satpam'),
							'nama'=>$this->input->post('nama'),
							'kota'=>$this->input->post('kota'),
							'alamat'=>$this->input->post('alamat'),
							'telp'=>$this->input->post('telp'));
			$this->simpan->SimpanMaster('mastersatpam',$simpan);
		}
		redirect('master_satpam');
	}
	
	function editmodal(){
		$tabel = 'mastersatpam';
		$select = array('id_satpam','kode_satpam','nama','kota','alamat','telp');
		$where = array('id_satpam'=>$this->input->post('id'));
		$data_edit = $this->m_master_jenis_barang->getById($tabel,$select,$where);
		
		$this->form_data->id_satpam=$data_edit['id_satpam'];
		$this->form_data->kode_satpam=$data_edit['kode_satpam'];
		$this->form_data->nama=$data_edit['nama'];
		$this->form_data->kota=$data_edit['kota'];
		$this->form_data->alamat=$data_edit['alamat'];
		$this->form_data->telp=$data_edit['telp'];
		$this->load->view('page/master/modal/mod_master_satpam');
	}
	
	function update(){
		$this->form_validation->set_rules('kode_satpam','kode_customer','trim|required|xss_clean');
		$this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$tabel = "mastersatpam";
			$data = array(
							'kode_satpam'=>$this->input->post('kode_satpam'),
							'nama'=>$this->input->post('nama'),
							'kota'=>$this->input->post('kota'),
							'alamat'=>$this->input->post('alamat'),
							'telp'=>$this->input->post('telp'));
			$where = array('id_satpam'=>$this->input->post('id_satpam'));
			$this->update->update2($tabel,$data,$where);
		}
		redirect('master_satpam');
	}
	
	function viewdet(){
		$tabel = 'mastersatpam';
		$select = array('id_satpam','kode_satpam','nama','kota','alamat','telp');
		$where = array('id_satpam'=>$this->input->post('id'));
		$data_edit = $this->m_master_jenis_barang->getById($tabel,$select,$where);
		
		$this->form_data->id_satpam=$data_edit['id_satpam'];
		$this->form_data->kode_satpam=$data_edit['kode_satpam'];
		$this->form_data->nama=$data_edit['nama'];
		$this->form_data->kota=$data_edit['kota'];
		$this->form_data->alamat=$data_edit['alamat'];
		$this->form_data->telp=$data_edit['telp'];
		$this->load->view('page/master/modal/mod_detmaster_satpam');
	}
}
