<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class master_nofaktur extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('m_master_nofaktur');
    }
	
	public function index()
	{
		$data['data_nofaktur'] = $this->m_master_nofaktur->getAll('nofaktur');
		$data['page']='master/v_master_nofaktur';
		$this->load->view('template/index',$data);
	}
	
	function simpan(){
		$this->db->empty_table('temp_nofaktur'); 
		$getPost = $this->input->post(null,true);
		$tahun = elements(array("tahun"),$getPost);
		$kodestatus = intval($getPost['kode_status']);
		$no_seri_awal = intval($getPost['no_seri_awal']);
		$range = intval($getPost['range']);
		for($i=0;$i<$range;$i++){
			$noseri= $no_seri_awal + $i;
			if($noseri%100000000 != $noseri){
				$noseri = $noseri%10000000;
				$kodestatus_ = $kodestatus + 1;
			}else{
				$kodestatus_ = $kodestatus;
			}
			$simpan = array("kode_status"=>$kodestatus_,"no_seri"=>$noseri,"status"=>0)+$tahun;
			$this->simpan->SimpanMaster('temp_nofaktur',$simpan);
		}
		
		redirect('master_nofaktur/hasil_temp');
	}
	
	function hasil_temp()
	{
		$data['data_nofaktur'] = $this->m_master_nofaktur->getAll('temp_nofaktur');
		$data['page']='master/v_master_nofaktur_temp';
		$this->load->view('template/index',$data);
	}
	
	function proses(){
		$this->db->query("insert into nofaktur select * from temp_nofaktur");
		redirect('master_nofaktur');
	}
	
	function cancel(){
		$this->db->empty_table('temp_nofaktur'); 
		redirect('master_nofaktur');
	}
}
