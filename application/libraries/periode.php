<?php
	class Periode{
		var $periodeini="";
		var $namabulan="";
		var $bulanperiode="";
		var $i="";
		var $tahun = "";
		var $now = "";
		var $th = "";
		public function getperiode(){
			$this->month1=date('m');
			if(($this->month1>=1)and($this->month1<=3)){
				$this->periodeini=1;
			}
			
			if(($this->month1>=4)and($this->month1<=6)){
				$this->periodeini=2;
			}
			
			if(($this->month1>=7)and($this->month1<=9)){
				$this->periodeini=3;
			}
			
			if(($this->month1>=10)and($this->month1<=12)){
				$this->periodeini=4;
			}
			
			return $this->periodeini;
		}
		
		public function getbulan($b){
			switch($b) {
				case 1 : $this->namabulan = "Januari";break;
				case 2 : $this->namabulan = "Februari";break;
				case 3 : $this->namabulan = "Maret";break;
				case 4 : $this->namabulan = "April";break;
				case 5 : $this->namabulan = "Mei";break;
				case 6 : $this->namabulan = "Juni";break;
				case 7 : $this->namabulan = "Juli";break;
				case 8 : $this->namabulan = "Agustus";break;
				case 9 : $this->namabulan = "September";break;
				case 10: $this->namabulan = "Oktober";break;
				case 11: $this->namabulan = "November";break;
				case 12: $this->namabulan = "Desember";break;
			}
			
			return $this->namabulan;
		}
		
		public function showBulanRomawi($b){
			switch($b) {
				case 1 : $this->namabulan = "I";break;
				case 2 : $this->namabulan = "II";break;
				case 3 : $this->namabulan = "III";break;
				case 4 : $this->namabulan = "IV";break;
				case 5 : $this->namabulan = "V";break;
				case 6 : $this->namabulan = "VI";break;
				case 7 : $this->namabulan = "VII";break;
				case 8 : $this->namabulan = "VIII";break;
				case 9 : $this->namabulan = "IX";break;
				case 10: $this->namabulan = "X";break;
				case 11: $this->namabulan = "XI";break;
				case 12: $this->namabulan = "XII";break;
			}
			
			return $this->namabulan;
		}
		
		public function pisahtanggal($tgl){
			$this->namabulan = $this->getbulan(date('m',strtotime($tgl)));
			$this->tahun = date('Y',strtotime($tgl));
			$this->now = date('d',strtotime($tgl));
			
			$this->i = $this->now." ".$this->namabulan." ".$this->tahun;
			
			return $this->i;
		}
		
		public function showBulan(){
			$this->namabulan = array("1"=>"Januari",
							"2"=>"Pebruari",
							"3"=>"Maret",
							"4"=>"April",
							"5"=>"Mei",
							"6"=>"Juni",
							"7"=>"Juli",
							"8"=>"Agustus",
							"9"=>"September",
							"10"=>"Oktober",
							"11"=>"November",
							"12"=>"Desember");
			return $this->namabulan;
		}
		
		public function showTahun(){
			$this->tahun=array();
			$this->now = date('Y')-1;
			//echo $now;
			$this->th=0;
			for($this->i=1;$this->i<=20;$this->i++){
				$this->th=$this->now+$this->i;
				$this->tahun[$this->th]=$this->th;
			}
			
			return $this->tahun;
		}
		
		public function getbulanperiode($b){
			switch($b){
				case 1 : $this->bulanperiode = "BULAN JANUARI S/D BULAN MARET";break;
				case 2 : $this->bulanperiode = "BULAN APRIL S/D BULAN JUNI";break;
				case 3 : $this->bulanperiode = "BULAN JULI S/D BULAN SEPTEMBER";break;
				case 4 : $this->bulanperiode = "BULAN OKTOBER S/D BULAN DESEMBER";break;
			}
			
			return $this->bulanperiode;
		}
		
		public function ConverMataUang($a){
			return number_format($a,0,",",".");
		}		
	}
?>