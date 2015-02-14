<?php
Class Update extends CI_Model{
	function __construc(){
	parent::__construct();
	}
	//UpdateMaster($data,array('IdPegawai',$IdPegawai),'Pegawai')
	function UpdateMaster($data,$where,$db){
		$this->db->where($where[0], $where[1]);
		$this->db->update($db, $data); 
	}
	
	function update2($tabel,$data,$where){
		$this->db->where($where);
		$this->db->update($tabel, $data);
	}	
	
	function Master($data,$tabel,$where){
		$this->db->where($where);
		$this->db->update($tabel, $data);
		return true;
	}
}