<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class penjualan_sj_m extends CI_Model{
	
	function cek_order($id_order){
		$ada = false;
		$this->db->where('id_order',$id_order);
		$query = $this->db->get('temp_ordersuratjalan');
		
		if($query->num_rows()>0){
			$ada = true;
		}
		
		return $ada;
	}
	
	function get_header_temp($id_order){
		/*$query = $this->db->query("SELECT
											sj.id_order,
													sj.id_surat_jalan,
													sj.id_customer,
													sj.tanggal,
													sj.no_surat_jalan,
													c.nama,
													c.alamat,
													c.kota,
													c.telpon
												FROM
												(SELECT * FROM temp_ordersuratjalan WHERE id_order='$id_order') sj LEFT JOIN
												`order` o ON sj.id_order=o.id_order LEFT JOIN
												mastercustomer c ON o.id_customer=c.id_customer"); */
		$q = "SELECT
					sj.id_surat_jalan,
					sj.tanggal,
					sj.id_order,
					o.no_dokumen,
					o.id_customer,
					mc.kode_customer,
					mc.nama,
					mc.alamat,
					mc.kota,
					mc.telpon,
					sj.no_surat_jalan,
					sj.id_supir,
					sj.id_pengirim,
					mp.nama AS pengirim,
					ms.nama AS supir
				FROM
				(SELECT * FROM ordersuratjalan WHERE id_surat_jalan='$id_order') sj LEFT JOIN
				`order` o ON sj.id_order=o.id_order LEFT JOIN
				mastercustomer mc ON o.id_customer=mc.id_customer LEFT JOIN
				masterpengirim mp ON sj.id_pengirim=mp.id_pengirim LEFT JOIN
				mastersupir ms ON sj.id_supir=ms.id_supir";
		$query = $this->db->query($q);
		return $query->result();
	}
	
	function get_header($id_surat_jalan = null){
		$id = intval($id_surat_jalan);
		$q = "SELECT
					sj.id_surat_jalan,
					sj.tanggal,
					sj.id_order,
					o.no_dokumen,
					o.id_customer,
					mc.kode_customer,
					mc.nama,
					mc.alamat,
					mc.kota,
					mc.telpon,
					sj.no_surat_jalan,
					sj.id_supir,
					sj.id_pengirim,
					mp.nama AS pengirim,
					ms.nama AS supir
				FROM
				(SELECT * FROM ordersuratjalan WHERE id_surat_jalan='$id') sj LEFT JOIN
				`order` o ON sj.id_order=o.id_order LEFT JOIN
				mastercustomer mc ON o.id_customer=mc.id_customer LEFT JOIN
				masterpengirim mp ON sj.id_pengirim=mp.id_pengirim LEFT JOIN
				mastersupir ms ON sj.id_supir=ms.id_supir";
		/* $query = $this->db->query("SELECT
													os.id_surat_jalan,
													os.tanggal,
													os.id_order,
													o.no_dokumen,
													os.id_customer,
													m.kode_customer,
													m.nama,
													m.alamat,
													m.kota,
													m.telpon,
													os.no_surat_jalan,
													os.id_supir,
													os.id_pengirim,
													mp.nama AS pengirim,
													ms.nama AS supir
												FROM
													(
														SELECT
															*
														FROM
															ordersuratjalan
														WHERE
															id_surat_jalan = '$id'
													) os
												LEFT JOIN mastercustomer m ON os.id_customer = m.id_customer
												LEFT JOIN `order` o ON os.id_order = o.id_order
												LEFT JOIN masterpengirim mp ON os.id_pengirim = mp.id_pengirim
												LEFT JOIN mastersupir ms ON os.id_supir = ms.id_supir"); */
		$query = $this->db->query($q);
		$data = array();
		foreach($query->result() as $row){
			$data['id_surat_jalan'] = $row->id_surat_jalan;
			$data['id_order'] = $row->id_order;
			$data['tanggal'] = $this->periode->pisahtanggal($row->tanggal);
			$data['tanggal_ori'] = $row->tanggal;
			$data['no_dokumen'] = $row->no_dokumen;
			$data['id_customer'] = $row->id_customer;
			$data['kode_customer'] = $row->kode_customer;
			$data['nama'] = $row->nama;
			$data['alamat'] = $row->alamat;
			$data['kota'] = $row->kota;
			$data['telpon'] = $row->telpon;
			$data['no_surat_jalan'] = $row->no_surat_jalan;
			$data['id_pengirim'] = $row->id_pengirim;
			$data['pengirim'] = $row->pengirim;
			$data['id_supir'] = $row->id_supir;
			$data['supir'] = $row->supir;
		}
		
		return $data;
	}
	
	function data_detail($id_surat_jalan){
		$id = intval($id_surat_jalan);
		$q = "SELECT
						sjd.id_order_det,
						sjd.id_surat_jalan,
						sjd.id_surat_jalan_det,
						sjd.kuantitas,
						od.id_barang,
						mb.nama_barang,
						od.satuan,
						sjd.keterangan
					FROM
						(
							SELECT
								*
							FROM
								ordersuratjalan_det
							WHERE
								id_surat_jalan = '$id'
						) sjd
					LEFT JOIN order_det od ON sjd.id_order_det = od.id_order_det
					LEFT JOIN masterbarang mb ON od.id_barang = mb.id_barang";
		/* $query = $this->db->query("SELECT
													os.id_surat_jalan_det,
													os.id_surat_jalan,
													os.id_order_det,
													os.id_barang,
													mb.nama_barang,
													os.kuantitas,
													os.satuan,
													os.keterangan
												FROM
													(
														SELECT
															*
														FROM
															ordersuratjalan_det
														WHERE
															id_surat_jalan = '$id'
													) os
												LEFT JOIN masterbarang mb ON os.id_barang = mb.id_barang"); */
		$query = $this->db->query($q);
		$no=0;
		$data = array();
		foreach($query->result() as $row){
			$data[$no]['id_surat_jalan_det'] = $row->id_surat_jalan_det;
			$data[$no]['id_surat_jalan'] = $row->id_surat_jalan;
			$data[$no]['id_order_det'] = $row->id_order_det;
			$data[$no]['id_barang'] = $row->id_barang;
			$data[$no]['nama_barang'] = $row->nama_barang;
			$data[$no]['kuantitas'] = $row->kuantitas;
			$data[$no]['satuan'] = $row->satuan;
			$data[$no]['keterangan'] = $row->keterangan;
			$no++;
		}
		
		return $data;
	}
	
	function data_detail_sj_temp($id_surat_jalan){
		$q = "SELECT
						sjd.id_order_det,
						sjd.id_surat_jalan,
						sjd.id_surat_jalan_det,
						sjd.kuantitas,
						od.id_barang,
						mb.nama_barang,
						od.satuan,
						sjd.keterangan
					FROM
						(
							SELECT
								*
							FROM
								temp_ordersuratjalan_det
							WHERE
								id_surat_jalan = '$id_surat_jalan'
						) sjd
					LEFT JOIN order_det od ON sjd.id_order_det = od.id_order_det
					LEFT JOIN masterbarang mb ON od.id_barang = mb.id_barang";
		/* $query = $this->db->query("SELECT
														sd.id_order_det,
														sd.id_surat_jalan,
														sd.id_surat_jalan_det,
														sd.id_barang,
														sd.keterangan,
														sd.kuantitas,
														sd.satuan,
														mb.nama_barang
													FROM
														(
															SELECT
																*
															FROM
																temp_ordersuratjalan_det
															WHERE
																id_surat_jalan = '$id_surat_jalan'
														) sd
													LEFT JOIN masterbarang mb ON sd.id_barang = mb.id_barang"); */
		$query = $this->db->query($q);
		$tabel = "";
		$no=1;
		foreach($query->result() as $row){
			$tabel .="<tr><td>".$no."</td><td>".$row->nama_barang."</td><td>".$row->kuantitas."</td><td>".$row->satuan."</td><td>".$row->keterangan."</td><td><button type=\"button\" direction=".base_url('penjualan_sj/hapus_item')." class=\"hapus_item btn btn-danger\" id=".$row->id_surat_jalan_det.".".$row->id_surat_jalan."><i class=\"icon-trash\"></i> &nbsp;hapus</button></td></tr>";
			
			$no++;
		}
		
		return array("vtabel"=>$tabel);
	}
	
	function data_detail_sj($id_surat_jalan){
		$q = "SELECT
						sjd.id_order_det,
						sjd.id_surat_jalan,
						sjd.id_surat_jalan_det,
						sjd.kuantitas,
						od.id_barang,
						mb.nama_barang,
						od.satuan,
						sjd.keterangan
					FROM
						(
							SELECT
								*
							FROM
								ordersuratjalan_det
							WHERE
								id_surat_jalan = '$id_surat_jalan'
						) sjd
					LEFT JOIN order_det od ON sjd.id_order_det = od.id_order_det
					LEFT JOIN masterbarang mb ON od.id_barang = mb.id_barang";
		/* $query = $this->db->query("SELECT
														sd.id_order_det,
														sd.id_surat_jalan,
														sd.id_surat_jalan_det,
														sd.id_barang,
														sd.keterangan,
														sd.kuantitas,
														sd.satuan,
														mb.nama_barang
													FROM
														(
															SELECT
																*
															FROM
																ordersuratjalan_det
															WHERE
																id_surat_jalan = '$id_surat_jalan'
														) sd
													LEFT JOIN masterbarang mb ON sd.id_barang = mb.id_barang"); */
		$query = $this->db->query($q);
		$tabel = "";
		$no=1;
		foreach($query->result() as $row){
			$tabel .="<tr><td>".$no."</td><td>".$row->nama_barang."</td><td>".$row->kuantitas."</td><td>".$row->satuan."</td><td>".$row->keterangan."</td><td><button type=\"button\"direction=".base_url('penjualan_sj/hapus_item_nontemp')." class=\"hapus_item btn btn-danger\" id=".$row->id_surat_jalan_det.".".$row->id_surat_jalan."><i class=\"icon-trash\"></i> &nbsp;hapus</button></td></tr>";
			
			$no++;
		}
		
		return array("vtabel"=>$tabel);
	}
	
	function simpan_detail($id_surat_jalan){
		$this->db->where('id_surat_jalan',$id_surat_jalan);
		$query = $this->db->get('temp_ordersuratjalan_det');
		
		foreach($query->result() as $row){
			$simpan = array("id_surat_jalan_det"=>$row->id_surat_jalan_det,
									"id_surat_jalan"=>$row->id_surat_jalan,
									"id_order_det"=>$row->id_order_det,
									"id_barang"=>$row->id_barang,
									"kuantitas"=>$row->kuantitas,
									"satuan"=>$row->satuan,
									"keterangan"=>$row->keterangan
									);
			$this->simpan->SimpanMaster('ordersuratjalan_det',$simpan); //simpan ke tabel order_det dari temp_order_det
		}
		
		$this->hapus->HapusMaster2(array('id_surat_jalan'=>$id_surat_jalan),'temp_ordersuratjalan_det'); //setelah disimpan ke tabel order, tabel temp_order di hapus
	}
	
	function move_to_tempdet($id_surat_jalan){
		$this->db->where('id_surat_jalan',$id_surat_jalan);
		$query = $this->db->get('ordersuratjalan_det');
		
		foreach($query->result() as $row){
			$simpan = array("id_surat_jalan_det"=>$row->id_surat_jalan_det,
									"id_surat_jalan"=>$row->id_surat_jalan,
									"id_order_det"=>$row->id_order_det,
									"id_barang"=>$row->id_barang,
									"kuantitas"=>$row->kuantitas,
									"satuan"=>$row->satuan,
									"keterangan"=>$row->keterangan
									);
			$this->simpan->SimpanMaster('temp_ordersuratjalan_det',$simpan); //simpan ke tabel order_det dari temp_order_det
		}
	}
	
	function total_allorder($id){
		$total = 0;
		$this->db->select_sum('kuantitas');
		$this->db->where('id_order',$id);
		$this->db->group_by('id_order');
		$q = $this->db->get('order_det');
		if($q->num_rows() > 0){
			$hasil = $q->row();
			$total = $hasil->kuantitas;
		}
		
		return $total;
	}
	
	function total_allsj($id){
		$total = 0;
		$query = "SELECT
							SUM(kuantitas) AS kuantitas
						FROM
							(
								SELECT
									*
								FROM
									ordersuratjalan
								WHERE
									id_order = '$id'
							) s
						LEFT JOIN ordersuratjalan_det sd ON s.id_surat_jalan = sd.id_surat_jalan";
		$q = $this->db->query($query);
		if($q->num_rows() > 0){
			$hasil = $q->row();
			$total = $hasil->kuantitas;
		}
		
		return $total;
	}
	
	function total_order($id){
		$total = 0;
		$this->db->where('id_order_det',$id);
		$query = $this->db->get('order_det');
		$hasil = $query->row();
		if($query->num_rows()>0)
			$total = $hasil->kuantitas;
		
		return $total;
	}
	
	function total_kirim($id){
		$total = 0;
		$this->db->select_sum('kuantitas');
		$this->db->where('id_order_det',$id);
		$query = $this->db->get('ordersuratjalan_det');
		$hasil = $query->row();
		if($query->num_rows()>0)
			$total = $hasil->kuantitas;
		
		return $total;
	}
}
