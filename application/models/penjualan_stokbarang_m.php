<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class penjualan_stokbarang_m extends CI_Model{
	function data(){
		$query = $this->db->query("SELECT
													st.id_barang,
													mb.nama_barang,
													mb.kode_barang,
													st.awal,
													st.keluar,
													st.sisa
												FROM
													(
														SELECT
															a.id_barang,
															a.awal,
															k.keluar,
															(a.awal - k.keluar) AS sisa
														FROM
															(
																SELECT
																	id_barang,
																	SUM(kuantitas) AS keluar
																FROM
																	ordersuratjalan_det
																GROUP BY
																	id_barang
															) k
														JOIN (
															SELECT
																id_barang,
																SUM(jumlah) AS awal
															FROM
																stokbarangjadi
															WHERE
																jenis_barang_masuk = '1'
															GROUP BY
																id_barang
														) a ON k.id_barang = a.id_barang
													) st
												LEFT JOIN masterbarang mb ON st.id_barang = mb.id_barang");
			return $query->result();
	}
}
