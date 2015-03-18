<?php
Class Gp_m extends CI_Model{
	function __construc(){
		parent::__construct();
	}
	
	function TampilCepat($a=null,$b=null,$c=null,$d=null){
		/*
		if($a==null)
			return 'nama field kosong';
		else if($b==null)
			return 'nama table kosong';
		else if($c==null)
			return 'nama field yang dicari kosong';
		else if($d==null)
			return 'value yang dicari kosong';
		*/
		if($a==null or $b==null or $c==null or $d==null)
			return '';
		
		if(is_array($a)){
			$a=implode (", ", $a);
		}
		$query=$this->db->query("select ".$a." from ".$b." where ".$c."=".$d."");
		
		if($query->num_rows==0)
			return '';
		
		if(is_array($a)){
			return $query->row();
		}else{
			return $query->row($a);
		}
	}
	
	function Rupiah($rupiah){
		return number_format($rupiah, 2 , ',' , '.' ); 
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

	public function nosurat($id_transaksi,$id_customer,$jenis_surat,$tanggal){
		$tahun = date('Y',strtotime($tanggal));
		$bulan = date('m',strtotime($tanggal));
		$tanggal = date('d',strtotime($tanggal));
		
		$next_number =  $this->NextNumber($tahun,$bulan,$jenis_surat);
		
		$simpan = array('no_surat'=>$next_number,
								'id_transaksi'=>$id_transaksi,
								'id_customer'=>$id_customer,
								'jenis_surat'=>$jenis_surat,
								'bulan'=>$bulan,
								'tanggal'=>$tanggal,
								'tahun'=>$tahun
								);
		$this->simpan->SimpanMaster('nosurat',$simpan);
	}
	
		
	public function NextNumber($tahun,$bulan,$js){
		$next = 1;
		$this->db->select_max('no_surat');
		$this->db->where('jenis_surat',$js);
		$this->db->where('tahun',$tahun);
		$this->db->where('bulan',$bulan);
		$query = $this->db->get('nosurat');
		if($query->num_rows()>0){
			$hasil = $query->row();
			$next = $hasil->no_surat+1;
		}
		
		return $next;
	}
}