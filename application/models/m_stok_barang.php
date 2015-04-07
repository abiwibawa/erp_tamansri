<?php
Class m_stok_barang extends CI_Model{
	function __construc(){
		parent::__construct();
	}

	function showDetail($tahun, $bulan){
		$tabel = "";
		$tabel .= "<table class=\"table table-bordered table-striped table-hover\">
						<thead>
                            <tr>
                                <th>No</th>
                                <th>Suplier</th>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Jenis Barang</th>
                                <th>Kuantitas</th>
                            </tr>
                        </thead>
                        <tbody>
		";
		$query = $this->db->query(
			"
SELECT
	e.id_suplier,
	c.id_jenis_barang,
	d.tanggal,
	a.id_barang,
	b.nama_barang,
	c.nama,
	a.kuantitas,
	a.id_penerimaan_h,
	e.nama AS suplier
FROM
	pembelian_penerimaan_d a
LEFT JOIN masterbarang b ON a.id_barang = b.id_barang
LEFT JOIN masterjenisbarang c ON c.id_jenis_barang = b.id_jenis_barang
LEFT JOIN (
	SELECT
		pembelian_penerimaan_h.tanggal,
		pembelian_penerimaan_h.id_penerimaan_h,
		pembelian_penerimaan_h.id_pemesanan_h
	FROM
		pembelian_penerimaan_h
) d ON d.id_penerimaan_h = a.id_penerimaan_h
LEFT JOIN (
	SELECT
		a.id_pemesanan_h,
		b.nama,
		b.id_suplier
	FROM
		mastersuplier AS b,
		pembelian_pemesanan_h AS a
	WHERE
		b.id_suplier = a.id_suplier
) e ON e.id_pemesanan_h = d.id_pemesanan_h
WHERE
	DATE_FORMAT(tanggal, '%M') = '$bulan' AND
	DATE_FORMAT(tanggal,'%Y') = $tahun
ORDER BY
	d.tanggal ASC
			"
		);
		
		$no = 1;
		foreach($query->result() as $row){
			$tabel .= "
							<tr>
                                <td>$no</td>
                                <td>$row->suplier</td>
                                <td>$row->tanggal</td>
                                <td>$row->nama_barang</td>
                                <td>$row->nama</td>
                                <td>$row->kuantitas</td>
                            </tr>
			";
		$no++;
		}
		$tabel .="</tbody></table>";
		return array('vtabel'=>$tabel);
	}

	function get_all($where = ""){
		$query = $this->db->query("
					SELECT
					SUM(b.kuantitas) as total,
					a.bulan,
					a.tahun
					FROM
						(
							SELECT
								a.id_penerimaan_h,
								a.tanggal,
								DATE_FORMAT(a.tanggal,'%M') AS bulan,
								YEAR (a.tanggal) AS tahun
							FROM
								pembelian_penerimaan_h AS a
						) a
					LEFT JOIN pembelian_penerimaan_d b ON a.id_penerimaan_h = b.id_penerimaan_h
					$where
					GROUP BY a.bulan
					ORDER BY a.tanggal DESC
			");
		return $query->result();
	}

	function get_stok($where=""){
		$query = $this->db->query("
				SELECT
					a.id_penerimaan_d,
					a.id_penerimaan_h,
					a.id_pemesanan_d,
					f.nama,
					f.id_suplier,
					d.id_jenis_barang,
					a.id_barang,
					a.total,
					b.tanggal,
					c.nama_barang,
					d.nama AS jenis_barang,
					d.kode_jenis_barang
				FROM
					(
						SELECT
							pembelian_penerimaan_d.id_barang,
							pembelian_penerimaan_d.id_pemesanan_d,
							pembelian_penerimaan_d.id_penerimaan_d,
							max(
								pembelian_penerimaan_d.id_penerimaan_h
							) AS id_penerimaan_h,
							max(
								pembelian_penerimaan_d.id_penerimaan_d
							) AS id_penerimaan,
							SUM(
								pembelian_penerimaan_d.kuantitas
							) AS total
						FROM
							pembelian_penerimaan_d
						GROUP BY
							id_barang
					) a
				LEFT JOIN pembelian_penerimaan_h b ON a.id_penerimaan_h = b.id_penerimaan_h
				LEFT JOIN masterbarang c ON c.id_barang = a.id_barang
				LEFT JOIN masterjenisbarang d ON d.id_jenis_barang = c.id_jenis_barang
				LEFT JOIN pembelian_pemesanan_h e ON e.id_pemesanan_h = b.id_pemesanan_h
				LEFT JOIN mastersuplier f ON f.id_suplier = e.id_suplier
				$where
				ORDER BY
					tanggal DESC
			");
		return $query->result();
	}

	function cmb_tahun(){
		$cmb = array();
		for ($i=2014; $i < 2040; $i++) { 
			# code...
			$cmb[$i] = $i;
		}
		return $cmb;
	}

	function cmb_bulan(){
		$bulan = ["January","February","March","April","May","June","July","August","September","October","November","December"];
		$cmb = array();
		for ($i=0; $i < 12; $i++) { 
			# code...
			$cmb[$bulan[$i]] = $bulan[$i];
		}
		return $cmb;
	}

	function cmbjenisbarang(){
		$cmb = array(""=>"-- Semua --");
		$query = $this->db->get('masterjenisbarang');
		foreach($query->result() as $row){
			$cmb[$row->id_jenis_barang]=$row->kode_jenis_barang." - ".$row->nama;
		}
		
		return $cmb;
	}

	function cmbsuplier(){
		$cmb = array(""=>"-- Semua --");
		$query = $this->db->get('mastersuplier');
		foreach ($query->result() as $row) {
			$cmb[$row->id_suplier] = $row->nama;
		}
		return $cmb;
	}

	function get_stok2($where){
		$query = $this->db->query("
				SELECT
					e.id_suplier,
					c.id_jenis_barang,
					d.tanggal,
					a.id_barang,
					b.nama_barang,
					c.nama,
					a.kuantitas,
					a.id_penerimaan_h,
					e.nama AS suplier
				FROM
					pembelian_penerimaan_d a
				LEFT JOIN masterbarang b ON a.id_barang = b.id_barang
				LEFT JOIN masterjenisbarang c ON c.id_jenis_barang = b.id_jenis_barang
				LEFT JOIN (
					SELECT
						pembelian_penerimaan_h.tanggal,
						pembelian_penerimaan_h.id_penerimaan_h,
						pembelian_penerimaan_h.id_pemesanan_h
					FROM
						pembelian_penerimaan_h
					WHERE
						DATE_FORMAT(tanggal, '%m') = $where
				) d ON d.id_penerimaan_h = a.id_penerimaan_h
				LEFT JOIN (
					SELECT
						a.id_pemesanan_h,
						b.nama,
						b.id_suplier
					FROM
						mastersuplier AS b,
						pembelian_pemesanan_h AS a
					WHERE
						b.id_suplier = a.id_suplier
				) e ON e.id_pemesanan_h = d.id_pemesanan_h
				ORDER BY
					d.tanggal ASC
			");
		return $query;
	}
}