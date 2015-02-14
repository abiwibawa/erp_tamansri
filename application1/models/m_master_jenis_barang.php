<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class m_master_jenis_barang extends CI_Model{
	function getAll($tabel){
		$query = $this->db->get($tabel);
		
		return $query->result();
	}
	
	function getById($tabel,$select,$where){
		foreach($select as $row){
			$hasil[$row]="";
		}
		
		foreach($where as $key => $value){
			$this->db->where($key,$value);
		}
		$query = $this->db->get($tabel);
		
		foreach($query->result() as $row){
			foreach($select as $row2){
				$hasil[$row2]=$row->$row2;
			}
		}
		
		return $hasil;
	}
}
