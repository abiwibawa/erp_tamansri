<?php
Class Hapus extends CI_Model{
	function __construc(){
	parent::__construct();
	}
	
	//misal HapusMaster(array("NIP","001001"),array("pegawai","jabatan"));
	//menghapus record di banyak tabel dengan 1 parameter
	function HapusMaster($where,$db){
		$this->db->where($where[0],$where[1]);
		$this->db->delete($db);
	}	
	
	function HapusMasterNew($jum=NULL,$where,$db){	
		if($jum==2){
			$this->db->where($where[0],$where[1]);
			$this->db->where($where[2],$where[3]);
		}else if($jum==3){
			$this->db->where($where[0],$where[1]);
			$this->db->where($where[2],$where[3]);
			$this->db->where($where[4],$where[5]);
		}else
			$this->db->where($where[2],$where[3]);
		
		$this->db->delete($db);
	}
	
	function HapusSimulasiMutasi($where,$JenisJabatan,$db){
		$this->db->where($where[0],$where[1]);
		$this->db->where('JenisJabatan',$JenisJabatan);
		$this->db->delete($db);
	}	
	
	function HapusSimulasiMutasi2($where,$JenisJabatan,$db){
		$this->db->where($where[0],$where[1]);
		$this->db->where($where[2],$where[3]);
		$this->db->where('JenisJabatan',$JenisJabatan);
		$this->db->delete($db);
	}
	
	function HapusMaster2($where,$tabel){
		$this->db->where($where);
		$this->db->delete($tabel);
	}
	
	function Master($tabel,$where){
		$this->db->where($where);
		$this->db->delete($tabel);
		return true;
	}
}