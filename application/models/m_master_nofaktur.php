<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class m_master_nofaktur extends CI_Model{
	function getAll($tabel){
		$hasil = array();
		$this->db->order_by('status,kode_status,tahun,no_seri','ASC');
		$query = $this->db->get($tabel);
		$i=0;
		
		foreach($query->result() as $row){
			$hasil[$i]['kode_status'] = $row->kode_status;
			$hasil[$i]['tahun'] = substr($row->tahun,2,2);
			$hasil[$i]['no_seri'] = $this->convert($row->no_seri);
			$hasil[$i]['status'] = $row->status;
			$i++;
		}
		
		return $hasil;
	}
	
	function convert($no=array()){
		$no_seri="";
		if($no<10){
			$no_seri = "0000000".$no;
		}elseif($no<100){
			$no_seri = "000000".$no;
		}elseif($no<1000){
			$no_seri = "00000".$no;
		}elseif($no<10000){
			$no_seri = "0000".$no;
		}elseif($no<100000){
			$no_seri = "000".$no;
		}elseif($no<1000000){
			$no_seri = "00".$no;
		}elseif($no<10000000){
			$no_seri = "0".$no;
		}elseif($no<100000000){
			$no_seri = $no;
		}
		return $no_seri;
	}
}