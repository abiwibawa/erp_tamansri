<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class penjualan_kwitansi_m extends CI_Model{
	function cekHdTemp($where){
		$return['ada'] = false;
		$this->db->where($where);
		$query = $this->db->get('temp_orderkwitansi');
		if($query->num_rows()>0){
			$return['ada'] = true;
			$hasil = $query->row();
			$return['id_kwitansi'] = $hasil->id_kwitansi;
		}else{
			$id_customer['id_customer'] = $where['id_customer'];
			$select = array('id_kwitansi');
			$where = array("id_customer"=>$where['id_customer']);
			$datahd = $this->getdatatabel->getbyid('temp_orderkwitansi',$select,$where);
			$this->db->delete('temp_orderkwitansi_det', $datahd); 
			$this->db->delete('temp_orderkwitansi', $id_customer); 
			$return['ada'] = false;
		}
		
		return $return;
	}
	
	function data_detail_temp($id=null){
		$q_bug = "SELECT
					a.id_kwitansi_det,
					a.id_kwitansi,
					a.id_invoice,
					b.no_invoice,
					a.subtotal
				FROM
					(
						SELECT
							*
						FROM
							temp_orderkwitansi_det
						WHERE
							id_kwitansi = '$id'
					) a
				LEFT JOIN orderinvoice b ON a.id_invoice = b.id_invoice";
		$q = "SELECT 
						k.id_kwitansi,
						k.tanggal,
						k.no_kwitansi,
						k.id_ttd,
						kd.id_kwitansi_det,
						kd.id_invoice,
						GetNoInvByID(kd.id_invoice) AS no_invoice,
						FTotalHargaInvByCustomer (kd.id_invoice) AS subtotal
					FROM
					(SELECT * FROM temp_orderkwitansi WHERE id_kwitansi='$id') k INNER JOIN
					(SELECT * FROM temp_orderkwitansi_det WHERE id_kwitansi='$id') kd ON k.id_kwitansi=kd.id_kwitansi";
		$query = $this->db->query($q);
		$no = 1;
		$tabel = "";
		$total = 0;
		$terbilang = "";
		foreach($query->result() as $row){
			$total = $total + $row->subtotal;
			$tabel .="<tr><td>".$no."</td><td>".$row->no_invoice."</td><td>".$row->subtotal."</td><td><button type=\"button\" direction=".base_url('penjualan_kwitansi/hapus_item')." class=\"hapus_item btn btn-danger\" id=".$row->id_kwitansi_det.".".$row->id_kwitansi."><i class=\"icon-trash\"></i> &nbsp;hapus</button></td></tr>";
			
			$no++;
		}
		if($total>0)
			$terbilang = $this->terbilang_lib->Terbilang($total)." Rupiah";
		return array("vtabel"=>$tabel,"total"=>$total,"terbilang"=>$terbilang);
	}
	
	function simpan_detail($id){
		$this->db->where('id_kwitansi',$id);
		$q = $this->db->get('temp_orderkwitansi_det');
		foreach($q->result() as $row){
			$simpan = array("id_kwitansi_det"=>$row->id_kwitansi_det,
										"id_kwitansi"=>$row->id_kwitansi,
										"id_invoice"=>$row->id_invoice,
										"no_invoice"=>$row->no_invoice,
										"subtotal"=>$row->subtotal
										);
			$this->simpan->SimpanMaster('orderkwitansi_det',$simpan); //simpan ke tabel order_det dari temp_order_det
			$data['status_kwitansi'] = "1";
			$this->update->update2('orderinvoice',$data,array('id_invoice'=>$row->id_invoice));
		}
		$this->hapus->HapusMaster2(array('id_kwitansi'=>$id),'temp_orderkwitansi_det'); //setelah disimpan ke tabel order, tabel temp_order di hapus
	}
	
	function get_header($id){
		$hasil = array();
		$q_bak = "SELECT
					a.no_kwitansi,
					a.tanggal,
					a.id_ttd,
					b.nama AS nm_customer,
					c.nama AS nm_ttd,
					a.total
				FROM
				(SELECT * FROM orderkwitansi WHERE id_kwitansi='$id')a LEFT JOIN
				mastercustomer b ON a.id_customer=b.id_customer LEFT JOIN
				mastertandatangan c ON a.id_ttd=c.id_ttd";
		$q = "SELECT 
						k.id_kwitansi,
						k.tanggal,
						k.no_kwitansi,
						k.id_ttd,
						kd.id_kwitansi_det,
						kd.id_invoice,
						GetNoInvByID(kd.id_invoice) AS no_invoice,
						SUM(FTotalHargaInvByCustomer (kd.id_invoice)) AS total,
						o.id_customer,
						mc.nama AS nm_customer,
						mc.kode_customer,
						mc.alamat,
						mc.telpon,
						mc.kota,
						FGetNamaTtd(k.id_ttd) AS nama_ttd,
						FGetJabatanTtd(k.id_ttd) AS jabatan_ttd
					FROM
					(SELECT * FROM orderkwitansi WHERE id_kwitansi='$id') k INNER JOIN
					(SELECT * FROM orderkwitansi_det WHERE id_kwitansi='$id') kd ON k.id_kwitansi=kd.id_kwitansi LEFT JOIN
					orderinvoice inv ON kd.id_invoice=inv.id_invoice LEFT JOIN
					ordersuratjalan os ON inv.id_surat_jalan=os.id_surat_jalan LEFT JOIN
					`order` o ON os.id_order=o.id_order LEFT JOIN
					mastercustomer mc ON o.id_customer=mc.id_customer
					GROUP BY k.id_kwitansi";
		$query = $this->db->query($q);
		foreach($query->result() as $row){
			$hasil['id_kwitansi'] = $row->id_kwitansi;
			$hasil['no_kwitansi'] = $row->no_kwitansi;
			$hasil['tanggal'] = $this->periode->pisahtanggal($row->tanggal);
			$hasil['nm_customer'] = $row->nm_customer;
			$hasil['total'] = $this->periode->ConverMataUang($row->total);
			$hasil['terbilang'] = $this->terbilang_lib->Terbilang($row->total)." Rupiah";
			$hasil['nama_ttd'] = $row->nama_ttd;
			$hasil['jabatan_ttd'] = $row->jabatan_ttd;
			$hasil['id_customer'] = $row->id_customer;
			$hasil['kode_customer'] = $row->kode_customer;
			$hasil['alamat'] = $row->alamat;
			$hasil['telpon'] = $row->telpon;
			$hasil['kota'] = $row->kota;
			$hasil['tgl_nonformat'] = $row->tanggal;
			$hasil['id_ttd'] = $row->id_ttd;
			$hasil['total_nonformat'] = $row->total;
		}
		
		return $hasil;
	}
	
	function data_detail($id){
		$hasil = array();
		$q_bak = "SELECT
					b.no_invoice
				FROM
				(SELECT * FROM orderkwitansi_det WHERE id_kwitansi='$id')a LEFT JOIN
				orderinvoice b ON a.id_invoice=b.id_invoice";
		$q = "SELECT 
						GetNoInvByID(kd.id_invoice) AS no_invoice,
						FTotalHargaInvByCustomer (kd.id_invoice) AS total
					FROM
					(SELECT * FROM orderkwitansi WHERE id_kwitansi='$id') k INNER JOIN
					(SELECT * FROM orderkwitansi_det WHERE id_kwitansi='$id') kd ON k.id_kwitansi=kd.id_kwitansi";
		$query = $this->db->query($q);
		$a=1;
		foreach($query->result() as $row){
			$hasil[$a]['no_invoice'] = $row->no_invoice;
			$hasil[$a]['total'] = $this->periode->ConverMataUang($row->total);
			$a++;
		}
		
		return $hasil;
	}
	
	function showdetil($id){
		$tabel = "";
		$q = "SELECT 
						GetNoInvByID(kd.id_invoice) AS no_invoice,
						FTotalHargaInvByCustomer (kd.id_invoice) AS total
					FROM
					(SELECT * FROM orderkwitansi WHERE id_kwitansi='$id') k INNER JOIN
					(SELECT * FROM orderkwitansi_det WHERE id_kwitansi='$id') kd ON k.id_kwitansi=kd.id_kwitansi";
		$query = $this->db->query($q);
		$no=1;
		$tabel .="<table class=\"table table-bordered table-striped table-hover\"><thead><tr><th>No</th><th>No Invoice</th><th>Jumlah</th></tr></thead><tbody>";
		foreach($query->result() as $row){
			$tabel .= "<tr><td>".$no."</td><td>".$row->no_invoice."</td><td>".$row->total."</td></tr>";
			$no++;
		}
		
		$tabel .="</tbody></table>";
		
		return array($tabel);
	}
	
	function move_to_tempdet($id){
		$this->db->where('id_kwitansi',$id);
		$query = $this->db->get('orderkwitansi_det');
		
		foreach($query->result() as $row){
			$simpan = array("id_kwitansi_det"=>$row->id_kwitansi_det,
									"id_kwitansi"=>$row->id_kwitansi,
									"id_invoice"=>$row->id_invoice,
									"no_invoice"=>$row->no_invoice,
									"subtotal"=>$row->subtotal
									);
			$this->simpan->SimpanMaster('temp_orderkwitansi_det',$simpan); //simpan ke tabel order_det dari temp_order_det
		}
	}
}
