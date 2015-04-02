<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class pembelian_pemesanan_m extends CI_Model{
	
	function carisuplier($key,$filter){
		if($filter == "kode"){
			$where = "WHERE upper(kode_suplier) like upper('%$key%')";
		}elseif($filter == "nama"){
			$where = "WHERE upper(nama) like upper('%$key%')";
		}else{
			$where = "";
		}
		
		$query = $this->db->query("Select * from mastersuplier $where");
		return $query->result();
	}
	
	function listorderdetail($id_pemesanan_h){
		
		$query = $this->db->query("select * from (select * from pembelian_pemesanan_d where id_pemesanan_h='".$id_pemesanan_h."')a left join (select * from masterbarang)b on a.id_barang=b.id_barang");
		$no=1;
		$tabel='';
		$subtotal=0;
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$ttl=$row->kuantitas*$row->harga;
				$subtotal=$subtotal+$ttl;
				$tabel .= "<tr><td>".$no."</td><td>".$row->kode_barang."/".$row->nama_barang."</td><td>".$row->satuan."</td><td>".$row->kuantitas."</td><td>".$row->harga."</td><td>".$ttl."</td><td><a  class='hapus_tambah_barang' id_pemesanan_d='".$row->id_pemesanan_d."' style='color:black'>Hapus</a></td></tr>";
				$no++;
			}
		}else{
			$tabel .= "<tr><td colspan='7' align='center'>Tidak Ditemukan Detail Order</td></tr>";
		}
		
		return array('vtabel'=>$tabel,'subtotal'=>$subtotal);
	}
	
	function listorderdetailhistory($id_pemesanan_h){
		
		$query = $this->db->query("select * from (select * from pembelian_pemesanan_d where id_pemesanan_h='".$id_pemesanan_h."')a left join (select * from masterbarang)b on a.id_barang=b.id_barang");
		$no=1;
		$tabel='<table border=1 width="100%">';
		$tabel.='<tr><td>No</td><td>Kode / Nama Barang</td><td>Satuan</td><td>Harga</td><td>Kuantitas</td><td>Total</td></tr>';
		$subtotal=0;
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				$ttl=$row->kuantitas*$row->harga;
				$subtotal=$subtotal+$ttl;
				$tabel .= "<tr><td>".$no."</td><td>".$row->kode_barang."/".$row->nama_barang."</td><td>".$row->satuan."</td><td>".$row->kuantitas."</td><td>".$this->gp_m->Rupiah($row->harga)."</td><td>".$this->gp_m->Rupiah($ttl)."</td></tr>";
				$no++;
			}
			$tabel .= "<tr><td colspan='5' align='right'>JUMLAH TOTAL Rp.</td><td>".$this->gp_m->Rupiah($subtotal)."</td></tr>";
		}else{
			$tabel .= "<tr><td colspan='6' align='center'>Tidak Ditemukan Detail Order</td></tr>";
		}
		$tabel .= "</table>";
		return array('vtabel'=>$tabel,'subtotal'=>$subtotal);
	}
	
	function simpanpemesanan(){
		$data=array(
					"id_suplier"=>$this->input->post("id_suplier"),
					"id_ttd"=>$this->input->post("id_ttd"),
					"tanggal_pemesanan"=>date('Y-m-d',strtotime($this->input->post('tanggalpemesanan'))),
					"tanggal_pengiriman"=>date('Y-m-d',strtotime($this->input->post('tanggalpengiriman'))),
					"syarat_pembayaran"=>$this->input->post("syarat_pembayaran"),
					"keterangan"=>$this->input->post("keterangan"),
					"ppn"=>$this->input->post("ppn")
					);
		$this->simpan->SimpanMaster('pembelian_pemesanan_h',$data);
		$q=$this->db->query("select id_pemesanan_h from pembelian_pemesanan_h order by id_pemesanan_h desc limit 1");
		
		$id_customer=1; //taman sriwedari
		$this->gp_m->nosurat($q->row('id_pemesanan_h'),$id_customer,'SP',date('Y-m-d',strtotime($this->input->post('tanggalpemesanan'))));
		
		$this->update->update2('pembelian_pemesanan_h',array("no_surat"=>$this->getnosurat($q->row('id_pemesanan_h'))),array('id_pemesanan_h'=>$q->row('id_pemesanan_h')));
		
		return $q->row('id_pemesanan_h');
		
	}
	
	function getnosurat($id_pemesanan_h){
		$query=$this->db->query("select no_surat from nosurat where id_transaksi='".$id_pemesanan_h."'");
		return $query->row("no_surat");
	}
	
	function updatepemesanan(){
		$data=array(
					"id_suplier"=>$this->input->post("id_suplier"),
					"id_ttd"=>$this->input->post("id_ttd"),
					"tanggal_pemesanan"=>date('Y-m-d',strtotime($this->input->post('tanggalpemesanan'))),
					"tanggal_pengiriman"=>date('Y-m-d',strtotime($this->input->post('tanggalpengiriman'))),
					"syarat_pembayaran"=>$this->input->post("syarat_pembayaran"),
					"keterangan"=>$this->input->post("keterangan"),
					"ppn"=>$this->input->post("ppn")
					);
		$this->update->update2('pembelian_pemesanan_h',$data,array('id_pemesanan_h'=>$this->input->post('id_pemesanan_h')));
		
		$bulan=date('m',strtotime($this->input->post('tanggalpemesanan')));
		$tanggal=date('d',strtotime($this->input->post('tanggalpemesanan')));
		$tahun=date('Y',strtotime($this->input->post('tanggalpemesanan')));
		$this->update->update2('nosurat',array("id_customer"=>$this->input->post("id_suplier"),"bulan"=>$bulan,"tanggal"=>$tanggal,"tahun"=>$tahun),array('id_transaksi'=>$this->input->post('id_pemesanan_h')));
		return 1;
	}
	
	function updatetambahpemesanan(){
		$this->updatepemesanan();
		if($this->input->post('id_barang')!=""){
			$data=array(
						'id_pemesanan_h'=>$this->input->post('id_pemesanan_h'),
						'id_barang'=>$this->input->post('id_barang'),
						'satuan'=>$this->input->post('satuan'),
						'kuantitas'=>$this->input->post('kuantitas'),
						'harga'=>$this->input->post('harga')
						);
			$this->simpan->SimpanMaster('pembelian_pemesanan_d',$data);
		}		
		return $this->listorderdetail($this->input->post('id_pemesanan_h'));

	}
	
	function perusahaan($id_perusahaan){
		$q=$this->db->query("select * from masterperusahaan where id_perusahaan='$id_perusahaan'");
		return $q->row();
	}
	
	function listpemesanancetak($id_pemesanan_h){
		$q = $this->db->query("select * from (select * from pembelian_pemesanan_d where id_pemesanan_h='".$id_pemesanan_h."')a left join (select * from masterbarang)b on a.id_barang=b.id_barang");
		return $q->result();
	}
	
	function tampilpenerima($id_pemesanan_h){
		$q = $this->db->query("select * from (select * from pembelian_pemesanan_h where id_pemesanan_h='".$id_pemesanan_h."')a left join (select * from mastersuplier)b on a.id_suplier=b.id_suplier left join (select id_ttd,nama as nama_ttd from mastertandatangan)c on a.id_ttd=c.id_ttd");
		return $q->row();
	}
}
