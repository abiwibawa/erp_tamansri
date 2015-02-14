<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class penjualan_laporder_m extends CI_Model{
	function data($filter=null,$page=null,$per_page=null){
	
		if($per_page!="")
			$limit="limit $page,$per_page";	
		else	
			$limit="";
		
		$where = "";
		
		if($filter == "f1"){
			$key =  $this->session->userdata('key_sess');
			$where = "where o.no_dokumen ='$key'";
		}elseif($filter == 'f3'){
			$key = $this->session->userdata('key_sess');
			$where = "where m.kode_customer = '$key' ";
		}elseif($filter == 'f2'){
			$tanggal1 = date('Y-m-d',strtotime($this->session->userdata('tanggal1_sess')));
			$tanggal2 = date('Y-m-d',strtotime($this->session->userdata('tanggal2_sess')));
			$where = "where o.tanggal >= '$tanggal1' and o.tanggal <= '$tanggal2' ";
		}
		
		$query = $this->db->query("SELECT
													o.id_order,
													o.tanggal,
													o.no_dokumen,
													o.status_sj,
													m.kode_customer,
													m.nama
												FROM
												(select * from `order` where status_edit = '0') o LEFT JOIN
												mastercustomer m ON o.id_customer=m.id_customer $where ORDER BY o.tanggal desc");
		$hasil = array();
		$a=0;
		foreach($query->result() as $row){
			$hasil[$a]['nomor'] = $page + 1;
			$hasil[$a]['tanggal'] = $this->periode->pisahtanggal($row->tanggal);
			$hasil[$a]['no_dokumen'] = $row->no_dokumen;
			$hasil[$a]['kode_customer'] = $row->kode_customer." / ".$row->nama;
			$hasil[$a]['nama'] = $row->nama;
			$hasil[$a]['id_order'] = $row->id_order;
			$hasil[$a]['status_sj'] = $row->status_sj;
			
			$page++;
			$a++;
		}
		
		return $hasil;
	}
	
	
	function showdetil($id_order){
		$tabel = "";
		$tabel .="<table class=\"table table-bordered table-striped table-hover\"><thead><tr><th>No</th><th>Barang</th><th>Jumlah</th><th>Satuan</th><th>Harga</th><th>Total</th></tr></thead><tbody>";
		$query = $this->db->query("SELECT
														od.id_order_det,
														mb.kode_barang,
														mb.nama_barang,
														od.kuantitas,
														od.harga,
														od.satuan,
														(od.kuantitas * od.harga) AS total
													FROM
														order_det od
													LEFT JOIN masterbarang mb ON od.id_barang=mb.id_barang
													WHERE
														od.id_order = '$id_order'");
		$no=1;
		foreach($query->result() as $row){
			$tabel .= "<tr><td>".$no."</td><td>".$row->kode_barang."/".$row->nama_barang."</td><td>".$row->kuantitas."</td><td>".$row->satuan."</td><td>".$row->harga."</td><td>".$row->total."</td></tr>";
			
			$no++;
		}
		
		$tabel .="</tbody></table>";
		
		return array('vtabel'=>$tabel);
	}
	
}
