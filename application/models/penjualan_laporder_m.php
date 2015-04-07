<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class penjualan_laporder_m extends CI_Model{
	function data($filter=null,$page=null,$per_page=null){
	
		if($per_page!="")
			$limit="limit $page,$per_page";	
		else	
			$limit="";
		
		$where = "";
		$where_customer = "";
		$where_tgl = "";
		if($filter == "f1"){
			$key =  $this->session->userdata('key_sess');
			$nodok['no_dokumen'] = $key;
			$select = array('no_dokumen','id_order');
			$get = $this->getdatatabel->getbyid('order',$select,$nodok);
			$id_order = $get['id_order'];
			$where = "where id_order='$id_order'";
		}elseif($filter == 'f3'){
			$key = $this->session->userdata('key_sess');
			$where_customer = "where m.kode_customer = '$key' ";
		}elseif($filter == 'f2'){
			$tanggal1 = date('Y-m-d',strtotime($this->session->userdata('tanggal1_sess')));
			$tanggal2 = date('Y-m-d',strtotime($this->session->userdata('tanggal2_sess')));
			$where_tgl = "where tanggal >= '$tanggal1' and tanggal <= '$tanggal2' ";
		}
		
		$query_bak = $this->db->query("SELECT
													o.id_order,
													o.tanggal,
													o.no_dokumen,
													o.status_sj,
													m.kode_customer,
													m.nama
												FROM
												(select * from `order` where status_edit = '0') o LEFT JOIN
												mastercustomer m ON o.id_customer=m.id_customer $where ORDER BY o.tanggal desc");
		$q = "SELECT
					`order`.id_order,
					order_det.id_order_det,
					`order`.tanggal,
					`order`.no_dokumen,
					`order`.status_sj,
					order_det.id_barang,
					order_det.kuantitas,
					order_det.harga,
					order_det.keterangan,
					mastercustomer.nama,
					mastercustomer.kode_customer,
					masterbarang.nama_barang,
					masterbarang.kode_barang,
					total.total
				FROM
				(SELECT * FROM `order` $where $where_tgl)`order` LEFT JOIN
				(SELECT * FROM order_det $where)order_det ON
				`order`.id_order=order_det.id_order LEFT JOIN
				masterbarang ON order_det.id_barang=masterbarang.id_barang LEFT JOIN
				(select * from mastercustomer $where_customer)mastercustomer ON `order`.id_customer=mastercustomer.id_customer
				LEFT JOIN (
						SELECT
							id_order,
							SUM((kuantitas * harga)) AS total
						FROM
							order_det
						GROUP BY
							id_order
					)total ON total.id_order=`order`.id_order";
		//echo $q."<br><br><br><br>";
		$query = $this->db->query($q);
		$hasil = array();
		$a=0;
		$noid="";
		foreach($query->result() as $row){
			if($row->id_order!=$noid){
				$hasil[$a]['nomor'] = $page + 1;
				$hasil[$a]['tanggal'] = $this->periode->pisahtanggal($row->tanggal);
				$hasil[$a]['no_dokumen'] = $row->no_dokumen;
				$hasil[$a]['kode_customer'] = $row->kode_customer." / ".$row->nama;
				$hasil[$a]['nama'] = $row->nama;
				$hasil[$a]['id_order'] = $row->id_order;
				$hasil[$a]['id_order_det'] = $row->id_order_det;
				$hasil[$a]['status_sj'] = "";
				$hasil[$a]['kode_brg'] = "";
				$hasil[$a]['kuantitas'] = "";
				$hasil[$a]['harga'] = "";
				$hasil[$a]['keterangan'] = "";
				$hasil[$a]['total'] = "Rp. ".$this->periode->ConverMataUang($row->total);
				$a++;
			}
			
			$hasil[$a]['nomor'] = "";
			$hasil[$a]['tanggal'] = "";
			$hasil[$a]['no_dokumen'] = "";
			$hasil[$a]['kode_customer'] = "";
			$hasil[$a]['nama'] = "";
			$hasil[$a]['id_order'] = $row->id_order;
			$hasil[$a]['id_order_det'] = $row->id_order_det;
			$hasil[$a]['status_sj'] = $row->status_sj;
			$hasil[$a]['kode_brg'] = $row->kode_barang."/".$row->nama_barang;
			$hasil[$a]['kuantitas'] = $row->kuantitas;
			$hasil[$a]['harga'] = "&#64; ".$this->periode->ConverMataUang($row->harga);
			$hasil[$a]['keterangan'] = $row->keterangan;
			$hasil[$a]['total'] = "&nbsp";
			
			$noid=$row->id_order;
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
