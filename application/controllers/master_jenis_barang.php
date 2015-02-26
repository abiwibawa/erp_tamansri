<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class master_jenis_barang extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->form_data = new StdClass;
    }
	
	public function index()
	{
		$data['data_master'] = $this->m_master_jenis_barang->getAll('masterjenisbarang');
		$data['page']='master/v_master_jenis_barang';
		$this->load->view('template/index',$data);
	}
	
	function addmodal(){
		$this->form_data->id_jenis_barang="";
		$this->form_data->kode="";
		$this->form_data->nama="";
		
		$this->load->view('page/master/modal/mod_master_jenis_barang');
	}
	
	function tambah(){
		$this->form_validation->set_rules('kode','kode','trim|required|xss_clean');
		$this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$simpan = array('kode_jenis_barang'=>$this->input->post('kode'),
						'nama'=>$this->input->post('nama'));
			$this->simpan->SimpanMaster('masterjenisbarang',$simpan);
		}
		redirect('master_jenis_barang');
	}
	
	function editmodal(){
		$tabel = 'masterjenisbarang';
		$select = array('id_jenis_barang','kode_jenis_barang','nama');
		$where = array('id_jenis_barang'=>$this->input->post('id'));
		$data_edit = $this->m_master_jenis_barang->getById($tabel,$select,$where);
		
		$this->form_data->id_jenis_barang=$data_edit['id_jenis_barang'];
		$this->form_data->kode=$data_edit['kode_jenis_barang'];
		$this->form_data->nama=$data_edit['nama'];
		
		$this->load->view('page/master/modal/mod_master_jenis_barang');
	}
	
	function update(){
		$this->form_validation->set_rules('kode','kode','trim|required|xss_clean');
		$this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$tabel = "masterjenisbarang";
			$data = array('kode_jenis_barang'=>$this->input->post('kode'),
						'nama'=>$this->input->post('nama'));
			$where = array('id_jenis_barang'=>$this->input->post('id_jenis_barang'));
			$this->update->update2($tabel,$data,$where);
		}
		redirect('master_jenis_barang');
	}
}
