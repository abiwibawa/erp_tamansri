<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class master_popup_m extends CI_Model{
	function carikwitansi($key){
		$query = $this->db->query("SELECT 
						k.id_kwitansi,
						k.no_kwitansi,
						SUM(FTotalHargaInvByCustomer (kd.id_invoice)) AS total
					FROM
					(SELECT * FROM orderkwitansi WHERE id_kwitansi NOT IN(SELECT id_kwitansi FROM bayarpiutang_det)) k INNER JOIN
					(SELECT * FROM orderkwitansi_det) kd ON k.id_kwitansi=kd.id_kwitansi LEFT JOIN
					orderinvoice inv ON kd.id_invoice=inv.id_invoice LEFT JOIN
					ordersuratjalan os ON inv.id_surat_jalan=os.id_surat_jalan LEFT JOIN
					(SELECT * FROM mastercustomer WHERE id_customer=$key) mc ON mc.id_customer=k.id_customer
					WHERE mc.nama IS NOT NULL
					GROUP BY k.id_kwitansi");
		return $query->result();
	}
	function caricustomerpembayaran($key,$filter){
		if($filter == "kode"){
			$where = "WHERE upper(kode_customer) like upper('%$key%')";
		}elseif($filter == "nama"){
			$where = "WHERE upper(nama) like upper('%$key%')";
		}else{
			$where = "";
		}
		
		$query = $this->db->query("SELECT
													od.id_kwitansi,
													od.id_customer,
													mc.nama,
													mc.kode_customer,
													mc.inisial
												FROM
												(SELECT * FROM orderkwitansi WHERE id_kwitansi NOT IN(SELECT id_kwitansi FROM bayarpiutang_det) GROUP BY id_customer) od LEFT JOIN
												(SELECT * FROM mastercustomer $where) mc ON od.id_customer=mc.id_customer
												WHERE mc.nama IS NOT NULL");
		return $query->result();
	}
	function caricustomer($key,$filter){
		if($filter == "kode"){
			$where = "WHERE upper(kode_customer) like upper('%$key%')";
		}elseif($filter == "nama"){
			$where = "WHERE upper(nama) like upper('%$key%')";
		}else{
			$where = "";
		}
		
		$query = $this->db->query("Select * from mastercustomer $where");
		return $query->result();
	}
	
	function cariproduk($key,$filter){
		if($filter == "kode"){
			$where = "AND upper(kode_barang) like upper('%$key%')";
		}elseif($filter == "nama"){
			$where = "AND upper(nama_barang) like upper('%$key%')";
		}else{
			$where = "";
		}
		
		$query = $this->db->query("Select * from masterbarang where id_jenis_barang='1' $where");
		return $query->result();
	}
	
	function cariproduk_order($id_order){
		$query = $this->db->query("SELECT
													od.id_order_det,
													od.id_barang,
													mb.nama_barang,
													mb.kode_barang,
													od.satuan,
													od.kuantitas,
													od.harga
												FROM
												order_det od LEFT JOIN
												masterbarang mb ON od.id_barang=mb.id_barang
												WHERE od.id_order='$id_order' ");
		return $query->result();
	}
	
	function cariptempdokumen($key=null){
		if(!empty($key))
			$where = "WHERE a.no_dokumen = '$key' ";
		else
			$where = "";
		
		$query = $this->db->query("select a.id_order,a.no_dokumen,b.kode_customer,b.nama from temp_order a left join mastercustomer b on a.id_customer=b.id_customer  $where");
		return $query->result();
	}
	
	function caripreorder($key=null){
		$where = "";
		if(!empty($key)){
			$this->db->where('no_dokumen',$key);
		}
		
		$this->db->where('terkirim IS NULL',null,false);
		$query = $this->db->get('order');
		return $query->result();
	}
	
	function carisupir($key=null,$tabel){
		if(!empty($key))
			$this->db->like('UPPER(nama)',strtoupper($key));
		
		$query = $this->db->get($tabel);
		return $query->result();
	}
	
	function caricustomerinv($key=null,$filter=null){
		$where = "";
		if(!empty($key)){
			if($filter=="kode"){
				$where = "where upper(kode_customer) = upper('$key')";
			}else{
				$where = "where upper(nama) like upper('%$key%')";
			}
		}
			
		$q = "SELECT
						a.id_customer,
						b.kode_customer,
						b.nama,
						b.alamat,
						b.kota,
						b.telpon,
						b.inisial
					FROM
					(SELECT id_customer FROM orderinvoice GROUP BY id_customer)a LEFT JOIN
					(SELECT * FROM mastercustomer $where) b ON a.id_customer=b.id_customer
					WHERE b.kode_customer IS NOT NULL";
		$query = $this->db->query($q);
		return $query->result();
	}
	
	function cariinv($id=null){
		$q_bug = "SELECT
						i.id_invoice,
						i.no_invoice,
						i.total,
						i.id_customer,
						i.id_order,
						o.no_dokumen,
						m.nama
					FROM
						(
							SELECT
								*
							FROM
								orderinvoice
							WHERE
								id_customer = '$id'
							AND status_kwitansi = '0'
						) i
					LEFT JOIN `order` o ON i.id_order = o.id_order
					LEFT JOIN	mastercustomer m ON i.id_customer=m.id_customer";
					
		$q = "SELECT
					o.id_order,
					o.id_customer,
					sj.id_surat_jalan,
					inv.id_invoice,
					inv.status_kwitansi,
					inv.no_invoice,
					FNoOrderByCustomer(inv.id_invoice) AS no_dokumen,
					FTotalHargaInvByCustomer(inv.id_invoice) AS total
				FROM
				(SELECT * FROM `order` WHERE id_customer='$id') o LEFT JOIN
				ordersuratjalan sj ON o.id_order=sj.id_order LEFT JOIN
				(SELECT * FROM orderinvoice WHERE id_invoice NOT IN (SELECT id_invoice FROM orderkwitansi_det)) inv ON sj.id_surat_jalan=inv.id_surat_jalan
				WHERE inv.id_invoice IS NOT NULL";
		$query = $this->db->query($q);
		return $query->result();
	}
	
	function cariinv_edit($id_kwitansi,$id_customer){
		$q = "SELECT
					a.id_kwitansi,
					b.id_invoice,
					b.id_order,
					b.id_customer,
					b.id_surat_jalan,
					b.status_kwitansi,
					b.no_invoice,
					b.no_dokumen,
					b.total
				FROM
				(SELECT * FROM orderkwitansi_det WHERE id_kwitansi='$id_kwitansi')a RIGHT JOIN
				(SELECT
						o.id_order,
						o.id_customer,
						sj.id_surat_jalan,
						inv.id_invoice,
						inv.status_kwitansi,
						inv.no_invoice,
						FNoOrderByCustomer(inv.id_invoice) AS no_dokumen,
						FTotalHargaInvByCustomer(inv.id_invoice) AS total
					FROM
					(SELECT * FROM `order` WHERE id_customer='$id_customer') o LEFT JOIN
					ordersuratjalan sj ON o.id_order=sj.id_order LEFT JOIN
					(SELECT * FROM orderinvoice) inv ON sj.id_surat_jalan=inv.id_surat_jalan
					WHERE inv.id_invoice IS NOT NULL)b ON a.id_invoice=b.id_invoice";
		$query = $this->db->query($q);
		return $query->result();
	}
	
	function cari_surat_pemesanan(){
		$query = $this->db->query("
			SELECT
				a.id_pemesanan_h,
				a.no_surat,
				b.kode_suplier,
				b.id_suplier,
				b.nama,
				b.alamat,
				b.telpon,
				c.id_pemesanan_d
			FROM
				pembelian_pemesanan_h AS a ,
				mastersuplier AS b ,
				pembelian_pemesanan_d AS c
			WHERE
				a.id_suplier = b.id_suplier AND
				a.id_pemesanan_h = c.id_pemesanan_h
			GROUP BY
				a.id_pemesanan_h"
		);
		return $query->result();
	}
	
	function cari_barang_pemesanan($id_pem,$id_sup){		
		$query = $this->db->query("
				SELECT
					masterbarang.id_barang,
					masterbarang.kode_barang,
					masterbarang.nama_barang,
					pembelian_pemesanan_d.kuantitas,
					pembelian_pemesanan_d.id_pemesanan_d,
					pembelian_pemesanan_h.id_pemesanan_h,
					pembelian_pemesanan_h.keterangan
				FROM
					masterbarang ,
					pembelian_pemesanan_d ,
					pembelian_pemesanan_h
				WHERE
					masterbarang.id_barang = pembelian_pemesanan_d.id_barang and
					pembelian_pemesanan_d.id_pemesanan_h = '$id_pem'
		");
		/*
		$query = $this->db->query("
				SELECT
					pemesanan.id_pemesanan_h,
					pemesanan.id_barang,
					pemesanan.kuantitas,
					penerimaan.total,
					CASE
				WHEN pemesanan.kuantitas = penerimaan.total THEN
					'pass'
				WHEN pemesanan.kuantitas > penerimaan.total THEN
					'lanjut'
				END AS STATUS
				FROM
					(
						SELECT
							pembelian_pemesanan_h.id_pemesanan_h,
							pembelian_pemesanan_d.id_barang,
							pembelian_pemesanan_d.kuantitas
						FROM
							(
								SELECT
									*
								FROM
									pembelian_pemesanan_h
								WHERE
									id_suplier = 1
							) pembelian_pemesanan_h
						LEFT JOIN pembelian_pemesanan_d ON pembelian_pemesanan_h.id_pemesanan_h = pembelian_pemesanan_d.id_pemesanan_h
					) pemesanan
				RIGHT JOIN (
					SELECT
						a1.id_pemesanan_h,
						pembelian_penerimaan_d.id_barang,
						SUM(
							pembelian_penerimaan_d.kuantitas
						) AS total
					FROM
						(
							SELECT
								pembelian_penerimaan_h.id_penerimaan_h,
								pembelian_penerimaan_h.id_pemesanan_h
							FROM
								(
									SELECT
										*
									FROM
										pembelian_pemesanan_h
									WHERE
										id_suplier = $id_sup
								) pembelian_pemesanan_h
							LEFT JOIN pembelian_penerimaan_h ON pembelian_penerimaan_h.id_pemesanan_h = pembelian_pemesanan_h.id_pemesanan_h
						) a1
					LEFT JOIN pembelian_penerimaan_d ON a1.id_penerimaan_h = pembelian_penerimaan_d.id_penerimaan_h
					GROUP BY
						id_barang
				) penerimaan ON pemesanan.id_pemesanan_h = penerimaan.id_pemesanan_h
				AND pemesanan.id_barang = penerimaan.id_barang
				AND pemesanan.id_pemesanan_h = $id_pem
		");
		*/
		return $query;
	}
}
