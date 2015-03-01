<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_pembayaran_m extends CI_Model{
	function cekHdTemp($where){
		$return['ada'] = false;
		$this->db->where($where);
		$query = $this->db->get('temp_bayarpiutang');
		if($query->num_rows()>0){
			$return['ada'] = true;
			$hasil = $query->row();
			$return['id_dokumen'] = $hasil->id_dokumen;
		}
		
		return $return;
	}
	
	function data_detail_temp($id){
		$q = "SELECT
					a.id_piutang_det,
					a.id_piutang,
					a.id_kwitansi,
					b.no_kwitansi,
					FNilaiKwitansi(a.id_kwitansi) AS nilai
				FROM
				(SELECT * FROM temp_bayarpiutang_det WHERE id_piutang=$id) a LEFT JOIN
				orderkwitansi b ON a.id_kwitansi=b.id_kwitansi";
		$query = $this->db->query($q);
		$no = 1;
		$tabel = "";
		$total = 0;
		foreach($query->result() as $row){
			$total = $total + $row->nilai;
			$tabel .="<tr><td>".$no."</td><td>".$row->no_kwitansi."</td><td>".$row->nilai."</td><td><button type=\"button\" direction=".base_url('penjualan_pembayaran/hapus_item')." class=\"hapus_item btn btn-danger\" id=".$row->id_piutang_det.".".$row->id_piutang."><i class=\"icon-trash\"></i> &nbsp;hapus</button></td></tr>";
			
			$no++;
		}
		return array("vtabel"=>$tabel,"total"=>$total);
	}
}
