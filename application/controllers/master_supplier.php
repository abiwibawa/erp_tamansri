<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class master_supplier extends CI_Controller{
	function __construct() {
		parent::__construct();
		//$this->load->model('m_master_barang');
    }
	
	public function index()
	{
		$data['data_master'] = $this->m_master_jenis_barang->getAll('mastersuplier');
		$data['page']='master/v_master_supplier';
		$this->load->view('template/index',$data);
	}
	
	function addmodal(){
		$this->form_data->id_suplier="";
		$this->form_data->kode_suplier="";
		$this->form_data->nama="";
		$this->form_data->alamat="";
		$this->form_data->kota="";
		$this->form_data->kodepos="";
		$this->form_data->email="";
		$this->form_data->telpon="";
		$this->form_data->fax="";
		$this->form_data->jenis="";
		$this->form_data->bank="";
		$this->form_data->account_bank="";
		
		$this->load->view('page/master/modal/mod_master_supplier');
	}
	
	function tambah(){
		$this->form_validation->set_rules('kode_suplier','kode_suplier','trim|required|xss_clean');
		$this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$simpan = array(
							'kode_suplier'=>$this->input->post('kode_suplier'),
							'nama'=>$this->input->post('nama'),
							'alamat'=>$this->input->post('alamat'),
							'kota'=>$this->input->post('kota'),
							'kodepos'=>$this->input->post('kodepos'),
							'email'=>$this->input->post('email'),
							'telpon'=>$this->input->post('telpon'),
							'fax'=>$this->input->post('fax'),
							'jenis'=>$this->input->post('jenis'),
							'bank'=>$this->input->post('bank'),
							'account_bank'=>$this->input->post('account_bank'));
			$this->simpan->SimpanMaster('mastersuplier',$simpan);
		}
		redirect('master_supplier');
	}
	
	function editmodal(){
		$tabel = 'mastersuplier';
		$select = array('id_suplier','kode_suplier','nama','alamat','kota','kodepos','telpon','email','fax','jenis','bank','account_bank');
		$where = array('id_suplier'=>$this->input->post('id'));
		$data_edit = $this->m_master_jenis_barang->getById($tabel,$select,$where);
		
		$this->form_data->id_suplier=$data_edit['id_suplier'];
		$this->form_data->kode_suplier=$data_edit['kode_suplier'];
		$this->form_data->nama=$data_edit['nama'];
		$this->form_data->alamat=$data_edit['alamat'];
		$this->form_data->kota=$data_edit['kota'];
		$this->form_data->kodepos=$data_edit['kodepos'];
		$this->form_data->telpon=$data_edit['telpon'];
		$this->form_data->email=$data_edit['email'];
		$this->form_data->fax=$data_edit['fax'];
		$this->form_data->jenis=$data_edit['jenis'];
		$this->form_data->bank=$data_edit['bank'];
		$this->form_data->account_bank=$data_edit['account_bank'];
		
		$this->load->view('page/master/modal/mod_master_supplier');
	}
	
	function update(){
		$this->form_validation->set_rules('kode_suplier','kode_suplier','trim|required|xss_clean');
		$this->form_validation->set_rules('nama','nama','trim|required|xss_clean');
		if($this->form_validation->run()==true){
			$tabel = "mastersuplier";
			$data = array(
							'kode_suplier'=>$this->input->post('kode_suplier'),
							'nama'=>$this->input->post('nama'),
							'alamat'=>$this->input->post('alamat'),
							'kota'=>$this->input->post('kota'),
							'kodepos'=>$this->input->post('kodepos'),
							'email'=>$this->input->post('email'),
							'telpon'=>$this->input->post('telpon'),
							'fax'=>$this->input->post('fax'),
							'jenis'=>$this->input->post('jenis'),
							'bank'=>$this->input->post('bank'),
							'account_bank'=>$this->input->post('account_bank'));
			$where = array('id_suplier'=>$this->input->post('id_suplier'));
			$this->update->update2($tabel,$data,$where);
		}
		redirect('master_supplier');
	}
	
	function viewdet(){
		$tabel = 'mastersuplier';
		$select = array('id_suplier','kode_suplier','nama','alamat','kota','kodepos','telpon','email','fax','jenis','bank','account_bank');
		$where = array('id_suplier'=>$this->input->post('id'));
		$data_edit = $this->m_master_jenis_barang->getById($tabel,$select,$where);
		
		$this->form_data->id_suplier=$data_edit['id_suplier'];
		$this->form_data->kode_suplier=$data_edit['kode_suplier'];
		$this->form_data->nama=$data_edit['nama'];
		$this->form_data->alamat=$data_edit['alamat'];
		$this->form_data->kota=$data_edit['kota'];
		$this->form_data->kodepos=$data_edit['kodepos'];
		$this->form_data->telpon=$data_edit['telpon'];
		$this->form_data->email=$data_edit['email'];
		$this->form_data->fax=$data_edit['fax'];
		$this->form_data->jenis=$data_edit['jenis'];
		$this->form_data->bank=$data_edit['bank'];
		$this->form_data->account_bank=$data_edit['account_bank'];
		
		$this->load->view('page/master/modal/mod_master_supplier');
	}
}
