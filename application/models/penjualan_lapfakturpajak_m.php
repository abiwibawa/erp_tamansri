<?php
Class Penjualan_lapfakturpajak_m extends CI_Model{
	function __construc(){
		parent::__construct();
	}

	function daftarriwayatfakturpajak($filter,$key){
		$where1="";
		$where2="";
		$where3="";

		if($filter=='f1')
			$where1="where no_faktur like '%$key%'";	
		else if($filter=='f2'){
			$pecah=explode('|',$key);
			$key1=date( 'Y-m-d',strtotime($pecah[0]));
			$key2=date( 'Y-m-d',strtotime($pecah[1]));
			$where2="where tanggal BETWEEN '$key1' AND '$key2'";
		}else if($filter=='f3')
			$where3="where c.kode_customer like '%$key%'";
		
		$query = $this->db->query("select *,DATE_FORMAT(tanggal,'%d-%m-%Y')as tanggal_faktur_pajak from 
									(select * from orderfakturpajak $where1 $where2)a
									left join 
									(select id_surat_jalan,no_surat_jalan from ordersuratjalan)b
									on 
									a.id_surat_jalan=b.id_surat_jalan
									left join 
									(select id_customer,kode_customer,nama from mastercustomer)c
									on 
									a.id_customer=c.id_customer
									$where3
									");
		$no=1;
		$tabel='';
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$cetak=base_url('penjualan_lapfp/cetak/'.$row->id_faktur_pajak);
				$tabel .= "<tr><td>".$no."</td><td>".$row->tanggal_faktur_pajak."</td><td>".$row->no_faktur."</td><td>".$row->kode_customer."</td><td>".$row->subtotal."</td><td><a href='$cetak' target='_blank' style='color:black'>Cetak</a></td></tr>";
				$no++;
			}
		}else{
			$tabel .= "<tr><td colspan='6' align='center'>Tidak Ditemukan Faktur Pajak</td></tr>";
		}
		
		return array('vtabel'=>$tabel);
	}
	
	function RubahTanggal($tgl){
		$x=explode("-",$tgl);
		$tanggal=$x[0];
		$tahun=$x[2];
		if($x[1]==1)
			$bulan=" Januari ";
		else if($x[1]==2)
			$bulan=" Februari ";
		else if($x[1]==3)
			$bulan=" Maret ";
		else if($x[1]==4)
			$bulan=" April ";
		else if($x[1]==5)
			$bulan=" Mei ";
		else if($x[1]==6)
			$bulan=" Juni ";
		else if($x[1]==7)
			$bulan=" Juli ";
		else if($x[1]==8)
			$bulan=" Agustus ";
		else if($x[1]==9)
			$bulan=" September ";
		else if($x[1]==10)
			$bulan=" Oktober ";
		else if($x[1]==11)
			$bulan=" November ";
		else if($x[1]==11)
			$bulan=" Desember ";
		else
			$bulan='?';
		
		return $tanggal.$bulan.$tahun;
	}
	
	function Rupiah($rupiah){
		return number_format($rupiah, 2 , ',' , '.' ); 
	}
}