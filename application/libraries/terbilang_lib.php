<?php
Class Terbilang_lib{
	function Terbilang($x){
		  $abil = array("", "Satu", "Dua", "Tiga", "Empat", "Lima", "Enam", "Tujuh", "Delapan", "Sembilan", "Sepuluh", "Sebelas");
		  if ($x < 12)
			return " " . $abil[$x];
		  elseif ($x < 20)
			return $this->Terbilang($x - 10) . "Belas";
		  elseif ($x < 100)
			return $this->Terbilang($x / 10) . " Puluh" . $this->Terbilang($x % 10);
		  elseif ($x < 200)
			return " Seratus" . $this->Terbilang($x - 100);
		  elseif ($x < 1000)
			return $this->Terbilang($x / 100) . " Ratus" . $this->Terbilang($x % 100);
		  elseif ($x < 2000)
			return " Seribu" . $this->Terbilang($x - 1000);
		  elseif ($x < 1000000)
			return $this->Terbilang($x / 1000) . " Ribu" . $this->Terbilang($x % 1000);
		  elseif ($x < 1000000000)
			return $this->Terbilang($x / 1000000) . " Juta" . $this->Terbilang($x % 1000000);
	}
}
?>
