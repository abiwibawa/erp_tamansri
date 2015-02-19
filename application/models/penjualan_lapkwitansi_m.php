<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_lapkwitansi_m extends CI_Model{
	function GetData(){
		$q = "SELECT 
						k.id_kwitansi,
						k.tanggal,
						k.no_kwitansi,
						k.id_ttd,
						kd.id_kwitansi_det,
						kd.id_invoice,
						GetNoInvByID(kd.id_invoice) AS no_invoice,
						SUM(FTotalHargaInvByCustomer (kd.id_invoice)) AStotal,
						mc.nama AS nm_customer,
						mc.kode_customer
					FROM
					(SELECT * FROM orderkwitansi) k INNER JOIN
					(SELECT * FROM orderkwitansi_det) kd ON k.id_kwitansi=kd.id_kwitansi LEFT JOIN
					orderinvoice inv ON kd.id_invoice=inv.id_invoice LEFT JOIN
					ordersuratjalan os ON inv.id_surat_jalan=os.id_surat_jalan LEFT JOIN
					`order` o ON os.id_order=o.id_order LEFT JOIN
					mastercustomer mc ON o.id_customer=mc.id_customer
					GROUP BY k.id_kwitansi";
	}
}