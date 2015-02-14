<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class m_master_barang extends CI_Model{
	function getAll(){
		$query = $this->db->query("SELECT
									mb.id_barang,
									mb.nama_barang,
									mb.kode_barang,
									mb.id_jenis_barang,
									mj.nama AS nama_jenis_barang,
									mj.kode_jenis_barang
								FROM
									masterbarang mb
								LEFT JOIN masterjenisbarang mj ON mb.id_jenis_barang = mj.id_jenis_barang");
		return $query->result();
	}
	
	function cmbjenisbarang(){
		$cmb = array();
		$query = $this->db->get('masterjenisbarang');
		foreach($query->result() as $row){
			$cmb[$row->id_jenis_barang]=$row->kode_jenis_barang." - ".$row->nama;
		}
		
		return $cmb;
	}
}
