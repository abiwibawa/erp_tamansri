<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_lapsj_m extends CI_Model{
	
	function data($filter,$page=null,$per_page=null){
		if($per_page!="")
			$limit="limit $page,$per_page";	
		else	
			$limit="";
		
		if($filter == "f4" || $filter == "f2"){
			$key = $this->session->userdata('key_sess');
			if($filter == "f4"){
				$where = "WHERE no_surat_jalan = '$key' ";
			}else{
				$tanggal1 = date('Y-m-d',strtotime($this->session->userdata('tanggal1_sess')));
				$tanggal2 = date('Y-m-d',strtotime($this->session->userdata('tanggal2_sess')));
				$where = "where tanggal >= '$tanggal1' and tanggal <= '$tanggal2' ";
			}
			$query = $this->db->query("SELECT
														os.id_surat_jalan,
														os.tanggal,
														o.no_dokumen,
														m.kode_customer,
														m.nama,
														m.alamat,
														m.kota,
														m.telpon,
														os.no_surat_jalan,
														mp.nama AS pengirim,
														ms.nama AS supir,
														os.status_inv
													FROM ( SELECT * FROM ordersuratjalan $where) os
													LEFT JOIN mastercustomer m ON os.id_customer = m.id_customer
													LEFT JOIN `order` o ON os.id_order = o.id_order
													LEFT JOIN masterpengirim mp ON os.id_pengirim = mp.id_pengirim
													LEFT JOIN mastersupir ms ON os.id_supir = ms.id_supir $limit");
		}
		
		if($filter == "f1"){
			$key = $this->session->userdata('key_sess');
			$query = $this->db->query("SELECT
														os.id_surat_jalan,
														os.tanggal,
														o.no_dokumen,
														m.kode_customer,
														m.nama,
														m.alamat,
														m.kota,
														m.telpon,
														os.no_surat_jalan,
														mp.nama AS pengirim,
														ms.nama AS supir,
														os.status_inv
													FROM (SELECT * FROM `order` WHERE no_dokumen='$key') o
													LEFT JOIN ordersuratjalan os ON os.id_order = o.id_order
													LEFT JOIN mastercustomer m ON os.id_customer = m.id_customer
													LEFT JOIN masterpengirim mp ON os.id_pengirim = mp.id_pengirim
													LEFT JOIN mastersupir ms ON os.id_supir = ms.id_supir $limit");
		}
		
		if($filter == "f3"){
			$key = $this->session->userdata('key_sess');
			$query = $this->db->query("SELECT
														os.id_surat_jalan,
														os.tanggal,
														o.no_dokumen,
														m.kode_customer,
														m.nama,
														m.alamat,
														m.kota,
														m.telpon,
														os.no_surat_jalan,
														mp.nama AS pengirim,
														ms.nama AS supir,
														os.status_inv
													FROM (SELECT * FROM mastercustomer WHERE kode_customer='$key') m
													LEFT JOIN ordersuratjalan os ON os.id_customer = m.id_customer
													LEFT JOIN `order` o ON os.id_order = o.id_order
													/*LEFT JOIN `order` o ON os.id_customer = m.id_customer*/
													LEFT JOIN masterpengirim mp ON os.id_pengirim = mp.id_pengirim
													LEFT JOIN mastersupir ms ON os.id_supir = ms.id_supir $limit");
		}
		
		$hasil = array();
		$a=0;
		foreach($query->result() as $row){
			$hasil[$a]['nomor'] = $page + 1;
			$hasil[$a]['tanggal'] = $this->periode->pisahtanggal($row->tanggal);
			$hasil[$a]['no_dokumen'] = $row->no_dokumen;
			$hasil[$a]['kode_customer'] = $row->kode_customer." / ".$row->nama;
			$hasil[$a]['nama'] = $row->nama;
			$hasil[$a]['id_surat_jalan'] = $row->id_surat_jalan;
			$hasil[$a]['alamat'] = $row->alamat;
			$hasil[$a]['kota'] = $row->kota;
			$hasil[$a]['telpon'] = $row->telpon;
			$hasil[$a]['no_surat_jalan'] = $row->no_surat_jalan;
			$hasil[$a]['pengirim'] = $row->pengirim;
			$hasil[$a]['supir'] = $row->supir;
			$hasil[$a]['status_inv'] = $row->status_inv;
			
			$page++;
			$a++;
		}
		
		return $hasil;
	}
	
	function showdetil($id_surat_jalan){
		$tabel = "";
		$tabel .="<table class=\"table table-bordered table-striped table-hover\"><thead><tr><th>No</th><th>Barang</th><th>Jumlah</th><th>Satuan</th></tr></thead><tbody>";
		$query = $this->db->query("SELECT
														od.id_surat_jalan_det,
														mb.kode_barang,
														mb.nama_barang,
														od.kuantitas,
														od.satuan
													FROM
														(select * from ordersuratjalan_det where id_surat_jalan='$id_surat_jalan') od
													LEFT JOIN masterbarang mb ON od.id_barang=mb.id_barang");
		$no=1;
		foreach($query->result() as $row){
			$tabel .= "<tr><td>".$no."</td><td>".$row->kode_barang."/".$row->nama_barang."</td><td>".$row->kuantitas."</td><td>".$row->satuan."</td></tr>";
			
			$no++;
		}
		
		$tabel .="</tbody></table>";
		
		return array('vtabel'=>$tabel);
	}
}
