<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Field extends CI_Controller{
function __construct(){
		parent::__construct();
		//$this->master->hak_akses();
	}
	
	function show(){
		//contoh misal http://192.168.1.105/simpek/field/show/post/tmpriwayatkgb
		$jenis=$this->uri->segment(3);
		$tabel=$this->uri->segment(4);
		$array_fields = $this->db->list_fields($tabel);
		if($jenis=='post'){
			$jum=count($array_fields);
			$n=1;
			echo "\$data=array(<br>";
			foreach ($array_fields as $fieldx){
				//echo "\$data['$fieldx']=\$this->input->post('$fieldx');<br>";
				if($jum!=$n)
					echo "'$fieldx'=>\$this->input->post('$fieldx'),<br>";
				else
					echo "'$fieldx'=>\$this->input->post('$fieldx')<br>";
				$n++;
			}
			echo ");";

		}
	}
	
	
	function show2(){
		//contoh misal http://192.168.1.105/simpek/field/show2/post/tmpriwayatkgb
		$jenis=$this->uri->segment(3);
		$tabel=$this->uri->segment(4);
		//$array_fields = $this->db->list_fields($tabel);
		$array_fields = $this->db->field_data($tabel);
		if($jenis=='post'){
			$jum=count($array_fields);
			$n=1;
			echo "\$data=array(<br>";
			foreach ($array_fields as $fieldx){
				//echo "\$data['$fieldx']=\$this->input->post('$fieldx');<br>";
				if($fieldx->type=='datetime'){
					if($jum!=$n)
						echo "'$fieldx->name'=>\$this->master->SimpanTanggal(\$this->input->post('$fieldx->name')),<br>";
					else
						echo "'$fieldx->name'=>\$this->master->SimpanTanggal(\$this->input->post('$fieldx->name'))<br>";
				}else{
					if($jum!=$n)
						echo "'$fieldx->name'=>\$this->input->post('$fieldx->name'),<br>";
					else
						echo "'$fieldx->name'=>\$this->input->post('$fieldx->name')<br>";
				}
				$n++;
			}
			echo ");";

		}
	}
		
	
	function beda(){
		//contoh misal http://192.168.1.105/simpek/field/beda/tmpriwayatkgb/riwayatkgb
		$tabel1=$this->uri->segment(3);
		$tabel2=$this->uri->segment(4);
		//$array_fields = $this->db->list_fields($tabel);
		
		$array_fields = $this->db->field_data($tabel1);
		foreach ($array_fields as $fieldx){
			$arr_tb1[$fieldx->name]=$fieldx->name;
		}
		
		$array_fields = $this->db->field_data($tabel2);
			$jum=count($array_fields);
			$n=1;
			echo "\$data=array(<br>";
			foreach ($array_fields as $fieldx){
				if(!in_array($fieldx->name,$arr_tb1)){
					$color1="<span style='color:red'>";
					$color2="</span>";
				}else{
					$color1="";
					$color2="";
				}
				//echo "\$data['$fieldx']=\$this->input->post('$fieldx');<br>";
				if($fieldx->type=='datetime'){
					if($jum!=$n)
						echo $color1."'$fieldx->name'=>\$this->master->SimpanTanggal(\$this->input->post('$fieldx->name')),<br>".$color2;
					else
						echo $color1."'$fieldx->name'=>\$this->master->SimpanTanggal(\$this->input->post('$fieldx->name'))<br>".$color2;
				}else{
					if($jum!=$n)
						echo $color1."'$fieldx->name'=>\$this->input->post('$fieldx->name'),<br>".$color2;
					else
						echo $color1."'$fieldx->name'=>\$this->input->post('$fieldx->name')<br>".$color2;
				}
				$n++;
			}
			echo ");";

	}
	
	function form_data(){
		//contoh misal http://192.168.1.105/simpek/field/show/post/tmpriwayatkgb
		//$jenis=$this->uri->segment(3);
		$tabel=$this->uri->segment(3);
		$array_fields = $this->db->list_fields($tabel);
		//if($jenis=='post'){
			$jum=count($array_fields);
			$n=1;
			//echo "\$data=array(<br>";
			foreach ($array_fields as $fieldx){
				//echo "\$data['$fieldx']=\$this->input->post('$fieldx');<br>";
				echo "\$this->form_data->$fieldx=\"\";<br>";
				$n++;
			}
			//echo ");";

	//	}
	}
	
	function form_data_set(){
		//contoh misal http://192.168.1.105/simpek/field/show/post/tmpriwayatkgb
		//$jenis=$this->uri->segment(3);
		$tabel=$this->uri->segment(3);
		$array_fields = $this->db->list_fields($tabel);
		//if($jenis=='post'){
			$jum=count($array_fields);
			$n=1;
			//echo "\$data=array(<br>";
			foreach ($array_fields as $fieldx){
				//echo "\$data['$fieldx']=\$this->input->post('$fieldx');<br>";
				echo "\$this->form_data->$fieldx=\$hasil[0]['$fieldx'];<br>";
				$n++;
			}
			//echo ");";

	//	}
	}
	
	function data_set(){
		//contoh misal http://192.168.1.105/simpek/field/show/post/tmpriwayatkgb
		//$jenis=$this->uri->segment(3);
		$tabel=$this->uri->segment(3);
		$array_fields = $this->db->list_fields($tabel);
		//if($jenis=='post'){
			$jum=count($array_fields);
			$n=1;
			//echo "\$data=array(<br>";
			foreach ($array_fields as $fieldx){
				//echo "\$data['$fieldx']=\$this->input->post('$fieldx');<br>";
				echo "\$data[\$no]['$fieldx']=\$row->$fieldx;<br>";
				$n++;
			}
			//echo ");";

	//	}
	}
}
?>