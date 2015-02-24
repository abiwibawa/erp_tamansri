<?php
Class Penjualan_invoice_m extends CI_Model{
	function __construc(){
		parent::__construct();
	}
	
	function carisuratjalan($key){
		if($key != ""){
			$where = "WHERE upper(no_surat_jalan) like upper('%$key%') and status_inv='0'";
		}else{
			$where = "WHERE status_inv='0'";
		}
		
		$query = $this->db->query("select * from 
									(select id_surat_jalan,id_order,id_customer,no_surat_jalan from ordersuratjalan $where)a
									left join 
									(select * from mastercustomer)b
									on 
									a.id_customer=b.id_customer
									left join 
									(select id_order,no_dokumen from `order`)c
									on 
									a.id_order=c.id_order
									
									");
		return $query->result();
	}	
	
	function caritandatangansurat($key){
		if($key != ""){
			$where = "WHERE upper(nama) like upper('%$key%')";
		}else{
			$where = "";
		}
		
		$query = $this->db->query("select * from mastertandatangan $where ");
		return $query->result();
	}	
	
	function detailinvoice($id_surat_jalan){
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
				$tabel .= "<tr><td>".$no."</td><td>".$row->nama_barang."</td><td>".$row->kuantitas."</td><td>".$row->satuan."</td><td>".$row->harga."</td><td>".$row_total."</td></tr>";
				$no++;
				$total = $total+$row_total;
			}
		}else{
			$tabel .= "<tr><td colspan='6'>Tidak Ditemukan Transaksi Barang</td></tr>";
		}
		
		return array('subtotal'=>$total,'vtabel'=>$tabel);
	}
	
	function detailinvoice2($id_surat_jalan){
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
	
	function simpaninvoice($data){
		$this->simpan->SimpanMaster('orderinvoice',$data);
		
		
		$query=$this->db->query("select id_invoice from orderinvoice where id_surat_jalan='".$data['id_surat_jalan']."'");
		$id_invoice=$query->row('id_invoice');
		$query=$this->db->query("select * from (select * from ordersuratjalan_det where id_surat_jalan='".$data['id_surat_jalan']."')a left join (SELECT id_order_det,id_barang,harga FROM order_det) b ON a.id_order_det = b.id_order_det and a.id_barang=b.id_barang");
		foreach($query->result() as $val){
			$simpan=array(	"id_invoice"=>$id_invoice,
							"id_surat_jalan_det"=>$val->id_surat_jalan_det,
							"id_barang"=>$val->id_barang,
							"kuantitas"=>$val->kuantitas,
							"satuan"=>$val->satuan,
							"harga"=>$val->harga,
						);
			$this->simpan->SimpanMaster('orderinvoice_det',$simpan);
		}
		
		//simpan nosurat
		$simpan=array(	"no_surat"=>$this->input->post('nourut'),
						"id_transaksi"=>$id_invoice,
						"id_customer"=>$data['id_customer'],
						"jenis_surat"=>'INV',
						"bulan"=>date('m',strtotime($this->input->post('tanggal'))),
						"tanggal"=>date('d',strtotime($this->input->post('tanggal'))),
						"tahun"=>date('Y',strtotime($this->input->post('tanggal')))
						);
		$this->simpan->SimpanMaster('nosurat',$simpan);
		
		
		//update invoice menjadi 1
		$this->update->update2('ordersuratjalan',array('status_inv'=>1),array('id_surat_jalan'=>$data['id_surat_jalan']));
		
		return $id_invoice;
		
	}
	
	function ceksuratjalan($id_surat_jalan){
		$query=$this->db->query("select id_surat_jalan from orderinvoice where id_surat_jalan='$id_surat_jalan'");
		if($query->num_rows()==0)
			return true;
		else
			return false;
	}
	
		
	function cetak($id_invoice){
		$query = $this->db->query("SELECT
										*
									FROM
										(
											SELECT
												*, DATE_FORMAT(tanggal, '%d-%m-%Y') AS tanggal_invoice
											FROM
												orderinvoice
											WHERE
												id_invoice = '$id_invoice'
										) a
									LEFT JOIN (SELECT * FROM mastercustomer) b ON a.id_customer = b.id_customer
									LEFT JOIN (SELECT id_order,no_dokumen,date_format(tanggal,'%d-%m-%Y')as tanggal_order FROM `order`) c ON a.id_order = c.id_order
									LEFT JOIN (select * from mastertandatangan)d on a.id_ttd=d.id_ttd
									");
		return $query->row();
	}	
	
	function ceknoinv(){
		$query=$this->db->query("select count(id_no_surat)as Jum from nosurat where jenis_surat='INV' and tahun='".date('Y')."'");
		$no=$query->row('Jum')+1;
		if($no<10)
			return '00'.$no;
		else if($no<100)
			return '0'.$no;
		else 
			return $no;
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