<?php
Class Penjualan_lapinvoice_m extends CI_Model{
	function __construc(){
		parent::__construct();
	}

	function daftarriwayatinvoice($filter,$key){
		$where1="";
		$where2="";
		$where3="";
		$where4="";

		if($filter=='f1')
			$where1="where b.no_surat_jalan like '%$key%'";	
		else if($filter=='f2'){
			$pecah=explode('|',$key);
			$key1=date( 'Y-m-d',strtotime($pecah[0]));
			$key2=date( 'Y-m-d',strtotime($pecah[1]));
			$where2="WHERE tanggal BETWEEN '$key1' AND '$key2'";
		}else if($filter=='f3')
			$where3="where c.kode_customer like '%$key%'";
		else if($filter=='f4')
			$where4="where no_invoice like '%$key%'";
		
		$query = $this->db->query("select *,DATE_FORMAT(tanggal,'%d-%m-%Y')as tanggal_surat from 
									(select * from orderinvoice $where2 $where4)a
									left join 
									(select id_surat_jalan,no_surat_jalan from ordersuratjalan $where1)b
									on 
									a.id_surat_jalan=b.id_surat_jalan
									left join 
									(select id_customer,kode_customer,nama from mastercustomer)c
									on 
									a.id_customer=c.id_customer
									$where1 $where3
									");
		$no=1;
		$tabel='';
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$cetak=base_url('penjualan_invoice/cetak/'.$row->id_invoice.'/'.$row->id_surat_jalan);
				$tabel .= "<tr><td>".$no."</td><td>".$row->no_invoice."</td><td>".$row->kode_customer."</td><td>".$row->tanggal_surat."</td><td>".$row->no_surat_jalan."</td><td><a href='$cetak' target='_blank' style='color:black'>Cetak</a></td></tr>";
				$no++;
			}
		}else{
			$tabel .= "<tr><td colspan='7' align='center'>Tidak Ditemukan Laporan Invoice</td></tr>";
		}
		
		return array('vtabel'=>$tabel);
	}
}