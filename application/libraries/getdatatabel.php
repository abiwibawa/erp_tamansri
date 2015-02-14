<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class GetDataTabel{
	private $ci;
	function __construct() {
		$this->ci =& get_instance();
    }
	
	function getonetabel($tabel,$where = array()){
		if(!empty($where)){
			foreach($where as $key => $value){
				$this->ci->db->where($key,$value);
			}
		}
		$query = $this->ci->db->get($tabel);
		return $query->result();
	}
	
	function getbyid($tabel,$select,$where){
		foreach($select as $row){
			$hasil[$row]="";
		}
		
		foreach($where as $key => $value){
			$this->ci->db->where($key,$value);
		}
		$query = $this->ci->db->get($tabel);
		
		foreach($query->result() as $row){
			foreach($select as $row2){
				$hasil[$row2]=$row->$row2;
			}
		}
		
		return $hasil;
	}
}
