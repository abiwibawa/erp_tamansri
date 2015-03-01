<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class m_master_perkiraan extends CI_Model{
	function simpan($simpan){
		$id_perkiraan['id_perkiraan'] = $this->nextID($simpan);
		$simpan = elements(array("no_perkiraan","uraian"),$simpan);
		$simpan = $simpan+$id_perkiraan;
		$this->simpan->SimpanMaster('kode_perkiraan',$simpan);
	}
	function nextID($simpan){
		$lenid = strlen($simpan['id_perkiraan']);
		$id_perkiraan = $simpan['id_perkiraan'];
		$q = "SELECT
					CAST(RIGHT(id_perkiraan,2) AS UNSIGNED INTEGER)+1 AS id_next
				FROM kode_perkiraan
				WHERE LEFT(id_perkiraan,$lenid)='$id_perkiraan'
				AND CHAR_LENGTH(id_perkiraan)=$lenid+2
				ORDER BY id_perkiraan DESC LIMIT 0,1";
		$query = $this->db->query($q);
		if($query->num_rows()>0){
			$hasil = $query->row_array();
		}else{
			$hasil['id_next'] = 1;
		}
		$next = "";
		if($hasil['id_next']<10) 
			$next = "0".$hasil['id_next'];
		else
			$next = $hasil['id_next'];
		
		$next = $simpan['id_perkiraan'].$next;
		return $next;
	}
}
