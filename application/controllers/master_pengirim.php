<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class master_pengirim extends CI_Controller{
	function __construct() {
		parent::__construct();
		//$this->load->model('m_master_barang');
    }
	
	public function index()
	{
		$data['data_master'] = $this->m_master_jenis_barang->getAll('masterpengirim');
		$data['page']='master/v_master_pengirim';
		$this->load->view('template/index',$data);
	}
	
	function addmodal(){
		$this->form_data->id_pengirim="";
		$this->form_data->nama="";
		$this->form_data->alamat="";
		$this->form_data->notelp="";
		
		$this->load->view('page/master/modal/mod_master_pengirim');
	}
	
	function tambah(){
		$this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$simpan = array(
							'nama'=>$this->input->post('nama'),
							'alamat'=>$this->input->post('alamat'),
							'notelp'=>$this->input->post('notelp'));
			$this->simpan->SimpanMaster('masterpengirim',$simpan);
		}
		redirect('master_pengirim');
	}
	
	function editmodal(){
		$tabel = 'masterpengirim';
		$select = array('id_pengirim','nama','alamat','notelp');
		$where = array('id_pengirim'=>$this->input->post('id'));
		$data_edit = $this->m_master_jenis_barang->getById($tabel,$select,$where);
		
		$this->form_data->id_pengirim=$data_edit['id_pengirim'];
		$this->form_data->nama=$data_edit['nama'];
		$this->form_data->alamat=$data_edit['alamat'];
		$this->form_data->notelp=$data_edit['notelp'];
		
		$this->load->view('page/master/modal/mod_master_pengirim');
	}
	
	function update(){
		$this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$tabel = "masterpengirim";
			$data = array(
							'nama'=>$this->input->post('nama'),
							'alamat'=>$this->input->post('alamat'),
							'notelp'=>$this->input->post('notelp'));
			$where = array('id_pengirim'=>$this->input->post('id_pengirim'));
			$this->update->update2($tabel,$data,$where);
		}
		redirect('master_pengirim');
	}
	
	function viewdet(){
		$tabel = 'masterpengirim';
		$select = array('id_pengirim','nama','alamat','notelp');
		$where = array('id_pengirim'=>$this->input->post('id'));
		$data_edit = $this->m_master_jenis_barang->getById($tabel,$select,$where);
		
		$this->form_data->id_pengirim=$data_edit['id_pengirim'];
		$this->form_data->nama=$data_edit['nama'];
		$this->form_data->alamat=$data_edit['alamat'];
		$this->form_data->notelp=$data_edit['notelp'];
		
		$this->load->view('page/master/modal/mod_master_pengirim');
	}
}
