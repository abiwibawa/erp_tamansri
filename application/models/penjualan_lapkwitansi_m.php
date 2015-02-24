<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_lapkwitansi_m extends CI_Model{
	
	function GetData($filter=null,$page=null,$per_page=null){
		if($per_page!="")
			$limit="limit $page,$per_page";	
		else	
			$limit="";
		$where_kw = "";
		$where_inv = "";
		$where_cus = "";
		if($filter == "f1"){ //no kwitansi
			$key = $this->session->userdata('key_sess');
			$where_kw = "where no_kwitansi = '$key'";
		}
		if($filter == "f2"){
			$tanggal1 = date('Y-m-d',strtotime($this->session->userdata('tanggal1_sess')));
			$tanggal2 = date('Y-m-d',strtotime($this->session->userdata('tanggal2_sess')));
			$where_kw = "where tanggal >= '$tanggal1' and tanggal <= '$tanggal2' ";
		}
		if($filter == "f3"){
			$key = $this->session->userdata('key_sess');
			$where_cus = "WHERE kode_customer = '$key'";
		}
		if($filter == "f4"){
			$key = $this->session->userdata('key_sess');
			$where_inv = "WHERE no_invoice = '$key'";
		}
		
		$q = "SELECT 
					k.id_kwitansi,
					k.tanggal,
					k.no_kwitansi,
					k.id_ttd,
					kd.id_kwitansi_det,
					kd.id_invoice,
					GetNoInvByID(kd.id_invoice) AS no_invoice,
					SUM(FTotalHargaInvByCustomer (kd.id_invoice)) AS total,
					mc.nama AS nm_customer,
					mc.kode_customer
				FROM
				(SELECT * FROM orderkwitansi $where_kw) k INNER JOIN
				(SELECT * FROM orderkwitansi_det) kd ON k.id_kwitansi=kd.id_kwitansi LEFT JOIN
				(SELECT * FROM orderinvoice $where_inv) inv ON kd.id_invoice=inv.id_invoice LEFT JOIN
				ordersuratjalan os ON inv.id_surat_jalan=os.id_surat_jalan LEFT JOIN
				`order` o ON os.id_order=o.id_order LEFT JOIN
				(SELECT * FROM mastercustomer $where_cus) mc ON o.id_customer=mc.id_customer
				WHERE mc.nama IS NOT NULL
				GROUP BY k.id_kwitansi
				ORDER BY k.tanggal DESC $limit";
		$query = $this->db->query($q);
		$data = array();
		$i=0;
		foreach($query->result() as $row){
			$data[$i]['no'] = $page+1;
			$data[$i]['id_kwitansi'] = $row->id_kwitansi;
			$data[$i]['no_kwitansi'] = $row->no_kwitansi;
			$data[$i]['kode_customer'] = $row->kode_customer." / ".$row->nm_customer;
			$data[$i]['tanggal'] = $this->periode->pisahtanggal($row->tanggal);
			$data[$i]['total'] = $this->periode->ConverMataUang($row->total);
			
			$page++;
			$i++;
		}
		
		return $data;
	}
}