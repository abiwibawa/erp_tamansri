<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class tree_model extends CI_Model{
	function kode_perkiraan(){
		$q = "SELECT 
		concat(id_perkiraan,'-',no_perkiraan,'-',uraian) as id,
id_perkiraan,CASE WHEN CHAR_LENGTH(no_perkiraan) > 2 THEN CONCAT(no_perkiraan,' - ',uraian) ELSE uraian END AS uraian,
CASE WHEN CHAR_LENGTH(id_perkiraan)=2 THEN '10' ELSE SUBSTRING(id_perkiraan,1,CHAR_LENGTH(id_perkiraan)-2) END AS parent
FROM kode_perkiraan ORDER BY no_perkiraan ASC";
		$query = $this->db->query($q);
		return $query;
	}
}