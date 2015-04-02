<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class m_pembelian_penerimaan_barang extends CI_Model{
	function getListBarang($penerimaan_h){
		$query = $this->db->query("SELECT
					pener_h.tanggal,
					pener_d.kuantitas,
					pener_d.id_penerimaan_h,
					pener_d.id_penerimaan_d,
					pener_d.keterangan,
					pener_h.no_surat_jalan,
					pener_h.no_pol,
					pener_h.jam,
					pener_h.id_pemesanan_h,
					barang.nama_barang
				FROM
					pembelian_penerimaan_d AS pener_d ,
					pembelian_penerimaan_h AS pener_h ,
					masterbarang AS barang
				WHERE
					pener_d.id_penerimaan_h = pener_h.id_penerimaan_h AND
					pener_d.id_barang = barang.id_barang AND
					pener_h.id_penerimaan_h = $penerimaan_h
				order by pener_h.tanggal DESC");
		return $query->result();
	}

	function getAll($id_pemesanan_h, $penerimaan_h){
		$tabel = "";
		$tabel .= "<table cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" class=\"table table-bordered table-striped\">
				<thead>
					<tr>
						<th width=\"5%\">No</th>
						<th width=\"25%\">Nama Barang</th>
						<th width=\"5%\">Kuantitas</th>
						<th width=\"10%\">Tanggal</th>
						<th width=\"5%\">Keterangan</th> 
						<th width=\"5%\">&nbsp;</th> 
					</tr>
				</thead>
				<tbody>
				";
			$query = $this->db->query("SELECT
					pener_h.tanggal,
					pener_d.kuantitas,
					pener_d.id_penerimaan_h,
					pener_d.id_penerimaan_d,
					pener_d.keterangan,
					pener_h.no_surat_jalan,
					pener_h.no_pol,
					pener_h.id_pemesanan_h,
					barang.nama_barang
				FROM
					pembelian_penerimaan_d AS pener_d ,
					pembelian_penerimaan_h AS pener_h ,
					masterbarang AS barang
				WHERE
					pener_d.id_penerimaan_h = pener_h.id_penerimaan_h AND
					pener_d.id_barang = barang.id_barang AND
					pener_h.id_penerimaan_h = $penerimaan_h
				order by pener_h.tanggal DESC");
				$no = 1;
				foreach($query->result() as $row):
				$tabel .="
					<tr>
						<td width=\"5%\">".$no."</td>
						<td width=\"25%\">".$row->nama_barang."</td>
						<td width=\"5%\">".$row->kuantitas."</td>
						<td width=\"10%\">".$row->tanggal."</td>
						<td width=\"10%\">".$row->keterangan."</td>
						<td width=\"5%\" align=\"center\">
						<a href=\"#\" data-url=\"".base_url('pembelian_penerimaan_barang/hapus/')."\" 
						id-pemesanan-h = \"".$id_pemesanan_h."\"
						id-penerimaan-h = \"".$row->id_penerimaan_h."\"
						id-penerimaan-d = \"".$row->id_penerimaan_d."\"
						class=\"btn btn-info icon-trash edit-penerimaan-barang\"
							&nbsp;
						</a>
						</td>                              
					</tr>";
				$no++; endforeach;
			$tabel .= "</tbody>
				</table>";
		return array('vtabel'=>$tabel);
	}
	
	function getById($id){
		$query = $this->db->query("SELECT
					pener_h.tanggal,
					pener_d.kuantitas,
					pener_d.id_penerimaan_d,
					pener_d.keterangan,
					pener_h.no_surat_jalan,
					pener_h.no_pol,
					barang.nama_barang
				FROM
					pembelian_penerimaan_d AS pener_d ,
					pembelian_penerimaan_h AS pener_h ,
					masterbarang AS barang
				WHERE
					pener_d.id_penerimaan_h = pener_h.id_penerimaan_h AND
					pener_d.id_barang = barang.id_barang AND
					pener_d.id_penerimaan_d = $id");
		return $query;
	}
	function get_qty($id_barang){
		$query = $this->db->query("SELECT
					SUM(pener_d.kuantitas) as kuatitas
				FROM
					pembelian_penerimaan_d AS pener_d ,
					pembelian_penerimaan_h AS pener_h ,
					masterbarang AS barang
				WHERE
					pener_d.id_penerimaan_h = pener_h.id_penerimaan_h AND
					pener_d.id_barang = barang.id_barang AND
					pener_d.id_barang = $id_barang");
		return $query;
	}
	
	function getLapPenerimaan($where){
		$query = $this->db->query(
			/*"SELECT
				c.kuantitas,
				e.nama,
				d.tanggal,
				d.no_surat_jalan,
				d.no_pol,
				d.jam,
				f.nama_barang,
				d.id_penerimaan_h,
				d.id_pemesanan_h,
				b.no_surat,
				e.kode_suplier
			FROM
				pembelian_pemesanan_h AS b,
				pembelian_penerimaan_d AS c,
				pembelian_penerimaan_h AS d,
				mastersuplier AS e,
				masterbarang AS f
			WHERE
				c.id_penerimaan_h = d.id_penerimaan_h
			AND b.id_suplier = e.id_suplier
			AND c.id_barang = f.id_barang
			$where
			GROUP BY
				d.no_surat_jalan"*/
				"SELECT
					*
				FROM
					(
						SELECT
							a.id_penerimaan_d,
							a.id_penerimaan_h,
							a.id_pemesanan_d,
							a.kuantitas,
							b.no_surat_jalan,
							b.tanggal,
							b.no_pol,
							b.jam,
							c.nama_barang
						FROM
							pembelian_penerimaan_d a,
							pembelian_penerimaan_h b,
							masterbarang c
						WHERE
							a.id_penerimaan_h = b.id_penerimaan_h
						AND c.id_barang = a.id_barang
					) a
				INNER JOIN (
					SELECT
						a.id_pemesanan_h,
						a.no_surat,
						b.kode_suplier,
						b.id_suplier,
						b.alamat,
						b.telpon,
						b.nama
					FROM
						pembelian_pemesanan_h a,
						mastersuplier b
					WHERE
						a.id_suplier = b.id_suplier
				) b
				$where
				GROUP BY a.id_penerimaan_h
"
		);
		return $query->result();
	}
	
	
	function showDetail($where){
		$tabel = "";
		$tabel .= "<table class=\"table table-bordered table-striped table-hover\">
						<thead>
                            <tr>
                                <th>No</th>
                                <th>Suplier</th>
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Kuantitas</th>
                            </tr>
                        </thead>
                        <tbody>
		";
		$query = $this->db->query(
			"SELECT
					*
				FROM
					(
						SELECT
							a.id_penerimaan_d,
							a.id_penerimaan_h,
							a.id_pemesanan_d,
							a.kuantitas,
							b.no_surat_jalan,
							b.tanggal,
							c.nama_barang
						FROM
							pembelian_penerimaan_d a,
							pembelian_penerimaan_h b,
							masterbarang c
						WHERE
							a.id_penerimaan_h = b.id_penerimaan_h
						AND c.id_barang = a.id_barang
					) a
				INNER JOIN (
					SELECT
						a.id_pemesanan_h,
						a.no_surat,
						b.kode_suplier,
						b.nama
					FROM
						pembelian_pemesanan_h a,
						mastersuplier b
					WHERE
						a.id_suplier = b.id_suplier
				) b
				where a.id_penerimaan_h = $where
				GROUP BY a.id_penerimaan_d
			"
		);
		
		$no = 1;
		foreach($query->result() as $row){
			$tabel .= "
							<tr>
                                <td>$no</td>
                                <td>$row->nama</td>
                                <td>$row->tanggal</td>
                                <td>$row->nama_barang</td>
                                <td>$row->kuantitas</td>
                            </tr>
			";
		$no++;
		}
		$tabel .="</tbody></table>";
		return array('vtabel'=>$tabel);
	}
	
	function hapus($where, $tabel){
		$this->db->where($where);
		$this->db->delete($tabel);
	}

	function cari_barang_pemesanan($id_pem, $id_sup){
		$query = $this->db->query(
"SELECT
	*
FROM
	(
		SELECT
			pemesanan.id_pemesanan_h,
			pemesanan.id_barang,
			pemesanan.kuantitas,
			penerimaan.total,
			pemesanan.kode_barang,
			pemesanan.nama_barang,
			CASE
		WHEN pemesanan.kuantitas = penerimaan.total THEN
			'pass'
		WHEN pemesanan.kuantitas > penerimaan.total THEN
			'lanjut'
		WHEN penerimaan.total IS NULL THEN
			'lanjut'
		END AS STATUS
		FROM
			(
				SELECT
					pemesanan.id_pemesanan_h,
					pemesanan.id_barang,
					pemesanan.kuantitas,
					masterbarang.kode_barang,
					masterbarang.nama_barang
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
									id_suplier = $id_sup
							) pembelian_pemesanan_h
						LEFT JOIN pembelian_pemesanan_d ON pembelian_pemesanan_h.id_pemesanan_h = pembelian_pemesanan_d.id_pemesanan_h
					) pemesanan
				LEFT JOIN masterbarang ON masterbarang.id_barang = pemesanan.id_barang
			) pemesanan
		LEFT JOIN (
			SELECT
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
							AND id_pemesanan_h = $id_pem
						) pembelian_pemesanan_h
					LEFT JOIN pembelian_penerimaan_h ON pembelian_penerimaan_h.id_pemesanan_h = pembelian_pemesanan_h.id_pemesanan_h
				) a1
			LEFT JOIN pembelian_penerimaan_d ON a1.id_penerimaan_h = pembelian_penerimaan_d.id_penerimaan_h
			GROUP BY
				id_barang
		) penerimaan ON penerimaan.id_barang = pemesanan.id_barang
	) a
WHERE a.`STATUS` = 'lanjut'
			");
		return $query;

	}
	
}
