<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class penjualan_order_m extends CI_Model{

	function getsubtotal($idorder){
		$total =0;
		$no =1;
		$tabel = "";
		$query = $this->db->query("SELECT
														od.id_order_det,
														od.id_order,
														mb.kode_barang,
														mb.nama_barang,
														od.kuantitas,
														od.harga,
														od.satuan,
														(od.kuantitas * od.harga) AS total
													FROM
														temp_order_det od
													LEFT JOIN masterbarang mb ON od.id_barang=mb.id_barang
													WHERE
														od.id_order = '$idorder'");
		foreach($query->result() as $row){
			$tabel .= "<tr><td>".$no."</td><td>".$row->kode_barang."/".$row->nama_barang."</td><td>".$row->kuantitas."</td><td>".$row->satuan."</td><td>".$row->harga."</td><td>".$row->total."</td><td><button type=\"button\"direction=".base_url('penjualan_order/hapus_item')." class=\"hapus_item btn btn-danger\" id=".$row->id_order_det.".".$row->id_order."><i class=\"icon-trash\"></i> &nbsp;hapus</button></td></tr>";
			$no++;
			$total = $total+$row->total;
		}
		
		return array('subtotal'=>$total,'vtabel'=>$tabel);
	}
	
	function getsubtotal_edit_temp($idorder){
		$total =0;
		$no =1;
		$tabel = "";
		$query = $this->db->query("SELECT
														od.id_order_det,
														od.id_order,
														mb.kode_barang,
														mb.nama_barang,
														od.kuantitas,
														od.harga,
														od.satuan,
														(od.kuantitas * od.harga) AS total
													FROM
														temp_order_det od
													LEFT JOIN masterbarang mb ON od.id_barang=mb.id_barang
													WHERE
														od.id_order = '$idorder'");
		foreach($query->result() as $row){
			$tabel .= "<tr><td>".$no."</td><td>".$row->kode_barang."/".$row->nama_barang."</td><td>".$row->kuantitas."</td><td>".$row->satuan."</td><td>".$row->harga."</td><td>".$row->total."</td><td><button type=\"button\" direction=".base_url('penjualan_order/hapus_item')." class=\"hapus_item btn btn-danger\" id=".$row->id_order_det.".".$row->id_order."><i class=\"icon-trash\"></i> &nbsp;hapus</button></td></tr>";
			$no++;
			$total = $total+$row->total;
		}
		
		return array('subtotal'=>$total,'vtabel'=>$tabel);
	}
	
	function getsubtotal_edit_($idorder){
		$total =0;
		$no =1;
		$tabel = "";
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
														od.id_order = '$idorder'");
		foreach($query->result() as $row){
			$tabel .= "<tr><td>".$no."</td><td>".$row->kode_barang."/".$row->nama_barang."</td><td>".$row->kuantitas."</td><td>".$row->satuan."</td><td>".$row->harga."</td><td>".$row->total."</td><td><button type=\"button\"direction=".base_url('penjualan_order/hapus_item')." class=\"hapus_item btn btn-danger\" id=".$row->id_order_det."><i class=\"icon-trash\"></i> &nbsp;hapus</button></td></tr>";
			$no++;
			$total = $total+$row->total;
		}
		
		return array('subtotal'=>$total,'vtabel'=>$tabel);
	}
	
	function get_header($id_order){
		$query = $this->db->query("SELECT
													a.id_order,
													a.no_dokumen,
													a.tanggal,
													a.total_harga,
													a.subtotal,
													a.biaya_pengiriman,
													a.keterangan,
													a.syarat_bayar,
													a.id_customer,
													b.kode_customer,
													b.nama,
													b.alamat,
													b.kota,
													b.telpon
												FROM
													`order` a
												LEFT JOIN mastercustomer b ON a.id_customer = b.id_customer
												where a.id_order = '$id_order'");
			return $query->result();
	}
	
	function get_header_temp($id_order){
		$query = $this->db->query("SELECT
													a.id_order,
													a.no_dokumen,
													a.tanggal,
													a.total_harga,
													a.subtotal,
													a.keterangan,
													a.syarat_bayar,
													a.id_customer,
													b.kode_customer,
													b.nama,
													b.alamat,
													b.kota,
													b.telpon
												FROM
													temp_order a
												LEFT JOIN mastercustomer b ON a.id_customer = b.id_customer
												where a.id_order = '$id_order'");
			return $query->result();
	}
	
	function simpan_detail($id_order){
		$this->db->where('id_order',$id_order);
		$query = $this->db->get('temp_order_det');
		
		foreach($query->result() as $row){
			$simpan = array("id_order_det"=>$row->id_order_det,
									"id_order"=>$row->id_order,
									"no_dokumen"=>$row->no_dokumen,
									"id_barang"=>$row->id_barang,
									"kuantitas"=>$row->kuantitas,
									"satuan"=>$row->satuan,
									"harga"=>$row->harga,
									"keterangan"=>$row->keterangan
									);
			$this->simpan->SimpanMaster('order_det',$simpan); //simpan ke tabel order_det dari temp_order_det
		}
		
		$this->hapus->HapusMaster2(array('id_order'=>$id_order),'temp_order_det'); //setelah disimpan ke tabel order, tabel temp_order di hapus
	}
	
	function simpan_detail_ketemp($id_order){
		$this->db->where('id_order',$id_order);
		$query = $this->db->get('order_det');
		
		foreach($query->result() as $row){
			$simpan = array("id_order_det"=>$row->id_order_det,
									"id_order"=>$row->id_order,
									"no_dokumen"=>$row->no_dokumen,
									"id_barang"=>$row->id_barang,
									"kuantitas"=>$row->kuantitas,
									"satuan"=>$row->satuan,
									"harga"=>$row->harga,
									"keterangan"=>$row->keterangan
									);
			$this->simpan->SimpanMaster('temp_order_det',$simpan); //simpan ke tabel order_det dari temp_order_det
		}
	}
	
	function cek_no_dokumen($no_dokumen){
		$ada = false;
		$this->db->where('no_dokumen',$no_dokumen);
		$this->db->where('status_edit','0');
		$query = $this->db->get('order');
		
		if($query->num_rows()>0){
			$ada = true;
		}
		
		return $ada;
	}
	
	function cek_no_dokumen_temp($no_dokumen){
		$ada = false;
		$this->db->where('no_dokumen',$no_dokumen);
		$query = $this->db->get('temp_order');
		
		if($query->num_rows()>0){
			$ada = true;
		}
		
		return $ada;
	}
	
	function cek_tabel_order_byid($id_order){
		$ada = false;
		$this->db->where('id_order',$id_order);
		$query = $this->db->get('order');
		
		if($query->num_rows()>0){
			$ada = true;
		}
		
		return $ada;
	}
}
