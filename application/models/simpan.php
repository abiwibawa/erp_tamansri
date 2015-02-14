<?php
Class Simpan extends CI_Model{
	function __construc(){
	parent::__construct();
	}
	
	function SimpanMaster($db,$val){
		$simpan=$this->db->insert($db,$val);
		return $simpan;
	}
}