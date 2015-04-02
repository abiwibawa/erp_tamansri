<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pembelian_lappemesanan_m extends CI_Model{

	function listpemesan(){
		$where1="";
		$where2="";
		if($this->input->post()){
			if($this->input->post('filter')=='f4'){
				$key=$this->input->post('key');
				$where1=" where nama like '%$key%'";
			}else if($this->input->post('filter')=='f1'){
				$key=$this->input->post('key');
				$where1=" where kode_suplier like '%$key%'";
			}else{
				$key1=date( 'Y-m-d',strtotime($this->input->post('tanggal1')));
				$key2=date( 'Y-m-d',strtotime($this->input->post('tanggal2')));
				$where2=" where tanggal_pemesanan BETWEEN '$key1' AND '$key2'";
			}
		}
		$q = $this->db->query("select * from 
			(select id_pemesanan_h,id_suplier,DATE_FORMAT(tanggal_pemesanan,'%d-%m-%Y')tanggal_pemesanan,DATE_FORMAT(tanggal_pengiriman,'%d-%m-%Y')tanggal_pengiriman from pembelian_pemesanan_h $where2)a
			left join 
			(select id_suplier,kode_suplier,nama,alamat,kota from mastersuplier)b
			on 
			a.id_suplier=b.id_suplier $where1");
		return $q->result_array();
	}
	
}
