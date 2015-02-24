<?php
Class Penjualan_fp_m extends CI_Model{
	function __construc(){
		parent::__construct();
	}
	
	function carisuratjalan($key){
		if($key != ""){
			$where = "WHERE upper(no_surat_jalan) like upper('%$key%') and status_faktur='0'";
		}else{
			$where = "WHERE status_faktur='0'";
		}
		
		$query = $this->db->query("select a.*,b.*,c.no_dokumen,d.id_invoice from 
									(select id_surat_jalan,id_order,id_customer,no_surat_jalan from ordersuratjalan $where)a
									left join 
									(select * from mastercustomer)b
									on 
									a.id_customer=b.id_customer
									left join 
									(select id_order,no_dokumen from `order`)c
									on 
									a.id_order=c.id_order
									left join 
									(select id_invoice,id_surat_jalan,id_order from orderinvoice)d
									on 
									a.id_order=d.id_order and a.id_surat_jalan=d.id_surat_jalan
									");
		return $query->result();
	}	
	
	
	
	function detailitem($id_surat_jalan){
		$query = $this->db->query("SELECT
										*
									FROM
										(
											SELECT
												*
											FROM
												ordersuratjalan_det
											WHERE
												id_surat_jalan = '$id_surat_jalan'
										) a
									LEFT JOIN 
									(SELECT id_barang,nama_barang FROM masterbarang) b 
									ON a.id_barang = b.id_barang
									LEFT JOIN 
									(SELECT id_order_det,id_barang,harga FROM order_det) c 
									ON a.id_order_det = c.id_order_det and a.id_barang=c.id_barang
									");
		$no=1;
		$tabel='';
		$row_total='';
		$total=0;
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$row_total=$row->harga*$row->kuantitas;
				$tabel .= "<tr><td>".$no."</td><td>".$row->nama_barang." ".$row->kuantitas." ".$row->satuan." @ ".$row->harga."</td><td>".$row_total."</td></tr>";
				$no++;
				$total = $total+$row_total;
			}
		}else{
			$tabel .= "<tr><td colspan='3'>Tidak Ditemukan Transaksi Barang</td></tr>";
		}
		
		return array('subtotal'=>$total,'vtabel'=>$tabel);
	}
	
	function tampilperusahaan($id){
		$query=$this->db->query("select * from masterperusahaan where id_perusahaan='$id'");
		return $query->row();
	}
	function tampilnofaktur(){
		$query=$this->db->query("select * from nofaktur where status='0' order by id_no_faktur asc limit 1");
		return array("no_faktur"=>$query->row('kode_status').'-'.substr($query->row('tahun'),'-2').'-'.$this->generatenoseri($query->row('no_seri')),"id_no_faktur"=>$query->row('id_no_faktur'));
	}
	
	function generatenoseri($input){
		while(strlen($input)<=8){
			$input='0'.$input;
		}
		return $input;
	}
	
	function simpanfakturpajak(){
		//update nofaktur menjadi 1
		$this->update->update2('nofaktur',array('status'=>1),array('id_no_faktur'=>$this->input->post('id_no_faktur')));
		
		//update ordersuratjalan menjadi 1
		$this->update->update2('ordersuratjalan',array('status_faktur'=>1),array('id_surat_jalan'=>$this->input->post('id_surat_jalan')));
		
		$data=array(
					"kode_transaksi"=>$this->input->post('kode_transaksi'),
					"id_no_faktur"=>$this->input->post('id_no_faktur'),
					"no_faktur"=>$this->input->post('no_faktur'),
					"tanggal"=>date('Y-m-d',strtotime($this->input->post('tanggal'))),
					"id_surat_jalan"=>$this->input->post('id_surat_jalan'),
					"id_order"=>$this->input->post('id_order'),
					"id_invoice"=>$this->input->post('id_invoice'),
					"id_customer"=>$this->input->post('id_customer'),
					"subtotal"=>$this->input->post('subtotal'),
					"potongan"=>$this->input->post('potongan'),
					"uang_muka"=>$this->input->post('uang_muka'),
					"dasar_pajak"=>$this->input->post('dasar_pajak'),
					"ppn"=>$this->input->post('ppn'),
					"id_ttd"=>$this->input->post('id_ttd')
					);
		$this->simpan->SimpanMaster('orderfakturpajak',$data);
		
		
		$query=$this->db->query("select id_faktur_pajak from orderfakturpajak where id_no_faktur='".$data['id_no_faktur']."'");
		$id_faktur_pajak=$query->row('id_faktur_pajak');
		
		return $id_faktur_pajak;
		
	}
	
	function ceknofaktur($id_no_faktur){
		$query=$this->db->query("select id_faktur_pajak from orderfakturpajak where id_no_faktur='$id_no_faktur'");
		if($query->num_rows()==0)
			return true;
		else
			return false;
	}
	
	function cetak($id_faktur_pajak){
		$query = $this->db->query("select a.*,date_format(a.tanggal,'%d-%m-%Y')as tanggal_indo,d.nama,d.alamat,d.npwp from 
									(select * from orderfakturpajak where id_faktur_pajak='$id_faktur_pajak')a
									left join 
									(select id_order,id_surat_jalan from ordersuratjalan)b
									on 
									a.id_surat_jalan=b.id_surat_jalan
									left join 
									(select id_order,id_customer from `order`)c
									on 
									b.id_order=c.id_order
									left join 
									(select id_customer,nama,alamat,npwp from mastercustomer)d
									on 
									c.id_customer=d.id_customer
									");
		return $query->row();
	}	
	
		
	function detailfakturpajak2($id_surat_jalan){
		$query = $this->db->query("SELECT
										*
									FROM
										(
											SELECT
												*
											FROM
												ordersuratjalan_det
											WHERE
												id_surat_jalan = '$id_surat_jalan'
										) a
									LEFT JOIN 
									(SELECT id_barang,nama_barang FROM masterbarang) b 
									ON a.id_barang = b.id_barang
									LEFT JOIN 
									(SELECT id_order_det,id_barang,harga FROM order_det) c 
									ON a.id_order_det = c.id_order_det and a.id_barang=c.id_barang
									");
		return $query->result();
	}

}