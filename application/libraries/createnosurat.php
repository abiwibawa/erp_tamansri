<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class CreateNoSurat{
	private $ci;
	function __construct() {
		$this->ci =& get_instance();
    }
	
	public function nosurat($id_transaksi,$id_customer,$jenis_surat,$tanggal){
		$tahun = date('Y',strtotime($tanggal));
		$bulan = date('m',strtotime($tanggal));
		$tanggal = date('d',strtotime($tanggal));
		
		$next_number = $this->NextNumber($bulan,$tahun);
		
		$simpan = array('no_surat'=>$next_number,
								'id_transaksi'=>$id_transaksi,
								'id_customer'=>$id_customer,
								'jenis_surat'=>$jenis_surat,
								'bulan'=>$bulan,
								'tanggal'=>$tanggal,
								'tahun'=>$tahun
								);
		$this->ci->simpan->SimpanMaster('nosurat',$simpan);
	}
	
	public function nosurat2($id_transaksi,$id_customer,$jenis_surat,$tanggal){
		$tahun = date('Y',strtotime($tanggal));
		$bulan = date('m',strtotime($tanggal));
		$tanggal = date('d',strtotime($tanggal));
		
		$next_number = $this->NextNumber2($tahun,$jenis_surat);
		
		$simpan = array('no_surat'=>$next_number,
								'id_transaksi'=>$id_transaksi,
								'id_customer'=>$id_customer,
								'jenis_surat'=>$jenis_surat,
								'bulan'=>$bulan,
								'tanggal'=>$tanggal,
								'tahun'=>$tahun
								);
		$this->ci->simpan->SimpanMaster('nosurat',$simpan);
	}
	
	public function convertnosurat($id_transaksi,$jenis_surat){
		$get = $this->getnosurat($id_transaksi,$jenis_surat);
		
		if($get->no_surat >= 100)
			$no_surat = $get->no_surat;
		elseif($get->no_surat >= 10)
			$no_surat = "0".$get->no_surat;
		elseif($get->no_surat < 10)
			$no_surat = "00".$get->no_surat;
		
		$bulan = $this->ci->periode->showBulanRomawi($get->bulan);
		
		$conv = $no_surat."/TS-".$get->inisial."/".$get->jenis_surat."/".$bulan."-".$get->tanggal."/".$get->tahun;
		
		return $conv;
	}
	
	public function getnosurat($id_transaksi,$jenis_surat){
		$query = $this->ci->db->query("SELECT
															n.no_surat,
															m.inisial,
															n.jenis_surat,
															n.bulan,
															n.tanggal,
															n.tahun
														FROM
															(
																SELECT
																	*
																FROM
																	nosurat
																WHERE
																	id_transaksi = '$id_transaksi'
																AND jenis_surat = '$jenis_surat'
															) n
														LEFT JOIN mastercustomer m ON n.id_customer = m.id_customer");
		return $query->row();
	}
	
	public function NextNumber($bulan,$tahun){
		$next = 1;
		$this->ci->db->select_max('no_surat');
		$this->ci->db->where('bulan',$bulan);
		$this->ci->db->where('tahun',$tahun);
		$query = $this->ci->db->get('nosurat');
		if($query->num_rows()>0){
			$hasil = $query->row();
			$next = $hasil->no_surat+1;
		}
		
		return $next;
	}
	
	public function NextNumber2($tahun,$js){
		$next = 1;
		$this->ci->db->select_max('no_surat');
		$this->ci->db->where('jenis_surat',$js);
		$this->ci->db->where('tahun',$tahun);
		$query = $this->ci->db->get('nosurat');
		if($query->num_rows()>0){
			$hasil = $query->row();
			$next = $hasil->no_surat+1;
		}
		
		return $next;
	}
}
