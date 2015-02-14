<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_order extends CI_Controller{
	
	function __construct() {
		parent::__construct();
		$this->load->model('penjualan_order_m');
    }
	
	public function index()
	{
		$sess_edit = array('id_order_edit_sess'=>'');
		$this->session->unset_userdata($sess_edit);
		$data['action_form'] = base_url('penjualan_order/saveorder');
		$data['page'] = 'penjualan/v_penjualan_order';
		$this->load->view('template/index',$data);
	}
	
	function saveorder(){
		$this->form_validation->set_rules('no_dokumen', 'No Dokumen', 'trim|required|xss_clean');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required|xss_clean');
		$this->form_validation->set_rules('kode_customer', 'kode_customer', 'required|xss_clean');
		$this->form_validation->set_rules('kode_barang', 'kode_barang', 'required|xss_clean');
		$this->form_validation->set_rules('kuantitas', 'kuantitas', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required|integer|xss_clean');
		
		if($this->form_validation->run()==false){
			$hasil['status']="false";
			$hasil['msg']="Kolom No Dokumen, Kode Customer,Tanggal, Kode Barang, Kuantitas, dan Harga Tidak Boleh Kosong";
			$hasil['id_order'] = "";
			$hasil['subtotal'] = "";
			$hasil['redir'] = base_url('penjualan_order');
		}else{
			$cek_order = $this->penjualan_order_m->cek_no_dokumen($this->input->post('no_dokumen'));
			$cek_order_temp = $this->penjualan_order_m->cek_no_dokumen_temp($this->input->post('no_dokumen'));
			
			if($cek_order && $this->input->post('id_order')==""){
				$hasil['status']="false";
				$hasil['msg']="No Dokumen yang di inputkan sudah ada dalam daftar order, jika ingin merubah detail order silahkan gunakan fasilitas edit pada menu riwayat input order";
				$hasil['id_order'] = "";
				$hasil['subtotal'] = "";
				$hasil['redir'] = base_url('penjualan_order');
				
				echo json_encode($hasil);
				
				exit();
			}
			
			if($cek_order_temp && $this->input->post('id_order')==""){
				$hasil['status']="false";
				$hasil['msg']="No Dokumen yang di inputkan sudah ada dalam database order temporary, gunakan tombol cari disebelah kanan kolom No Dokumen untuk mencari Order temporary";
				$hasil['id_order'] = "";
				$hasil['subtotal'] = "";
				$hasil['redir'] = base_url('penjualan_order');
				
				echo json_encode($hasil);
				
				exit();
			}
			
			$select = array('id_order','no_dokumen','id_customer');
			$where = array("no_dokumen"=>$this->input->post('no_dokumen'));
			$cek = $this->getdatatabel->getbyid('temp_order',$select,$where); //cek ke tbl order berdasarkan no dokumen, untuk memastikan no dokumen sudah ada atau belum, jika belum ada insert ke tbl order jika sudah ada cukup hanya insert ke tabel order det.
			
			if(!empty($cek['id_order'])){ //true berarti no dokumen ada;
				$order_det = array("id_order"=>$cek['id_order'],
											"no_dokumen"=>$cek['no_dokumen'],
											"id_barang"=>$this->input->post('id_barang'),
											"kuantitas"=>$this->input->post('kuantitas'),
											"satuan"=>$this->input->post('satuan'),
											"harga"=>$this->input->post('harga'),
											"keterangan"=>$this->input->post('keterangan')
											);
				$this->simpan->SimpanMaster('temp_order_det',$order_det);
				
				$hasil = $this->penjualan_order_m->getsubtotal($cek['id_order']);
				$this->update->update2('temp_order',array('subtotal'=>$hasil['subtotal'],'total_harga'=>$hasil['subtotal']),array('id_order'=>$cek['id_order']));//sementara
			}else{ //false berarti no dokumen tidak ada
				$order = array("id_customer"=>$this->input->post('id_customer'),
									"tanggal"=>date('Y-m-d',strtotime($this->input->post('tanggal'))),
									"no_dokumen"=>$this->input->post('no_dokumen'),
									"keterangan"=>$this->input->post('keterangan_order'),
									"syarat_bayar"=>$this->input->post('syarat_bayar')
									);
				$this->simpan->SimpanMaster('temp_order',$order);
				
				$select = array('id_order','no_dokumen','id_customer');
				$where = array("no_dokumen"=>$this->input->post('no_dokumen'));
				$cek = $this->getdatatabel->getbyid('temp_order',$select,$where);
				$order_det = array("id_order"=>$cek['id_order'],
											"no_dokumen"=>$cek['no_dokumen'],
											"id_barang"=>$this->input->post('id_barang'),
											"kuantitas"=>$this->input->post('kuantitas'),
											"satuan"=>$this->input->post('satuan'),
											"harga"=>$this->input->post('harga'),
											"keterangan"=>$this->input->post('keterangan')
											);
				$this->simpan->SimpanMaster('temp_order_det',$order_det);
				
				$hasil = $this->penjualan_order_m->getsubtotal($cek['id_order']);
				$this->update->update2('temp_order',array('subtotal'=>$hasil['subtotal'],'total_harga'=>$hasil['subtotal']),array('id_order'=>$cek['id_order']));//sementara
			}
			
			$hasil['status']="true";
			$hasil['msg']="";
			$hasil['id_order'] = $cek['id_order'];
		}
		
		echo json_encode($hasil);
	}
	
	function hapus_item(){
		$postData = $this->input->post(null,true);
		$id_order_det = $postData[0];
		$id_order = $postData[1];
		$this->hapus->HapusMaster2(array('id_order_det'=>$id_order_det,'id_order'=>$id_order),'temp_order_det');
		$hasil = $this->penjualan_order_m->getsubtotal($id_order);
		//$hasil['vtabel'] = $detail['vtabel'];
		/* $hasil['status']="true";
		$hasil['msg']="";
		$hasil['id_order'] = $id_order; */
		$hasil = $hasil+array("status"=>"true")+array("msg"=>"")+array("id_order"=>$id_order);
		echo json_encode($hasil);
	}
	
	function get_data_temp(){
		$id_order = $this->input->post('id_order');
		
		$header = $this->penjualan_order_m->get_header_temp($id_order);
		
		$hasil['id_order'] = $id_order;
		$hasil['tanggal'] = $header[0]->tanggal;
		$hasil['kode_customer'] = $header[0]->kode_customer;
		$hasil['id_customer'] = $header[0]->id_customer;
		$hasil['nama_customer'] = $header[0]->nama;
		$hasil['alamat_customer'] = $header[0]->alamat;
		$hasil['telp_customer'] = $header[0]->telpon;
		$hasil['kota_customer'] = $header[0]->kota;
		$hasil['syarat_bayar'] = $header[0]->syarat_bayar;
		$hasil['keterangan_order'] = $header[0]->keterangan;
		
		$detail = $this->penjualan_order_m->getsubtotal($id_order);
		$hasil['subtotal'] = $detail['subtotal'];
		$hasil['vtabel'] = $detail['vtabel'];
		
		
		echo json_encode($hasil);
	}
	
	function aprove_order(){
		$header = array();
		$subtotal = $this->input->post('subtotal');
		$pengiriman = $this->input->post('pengiriman');
		$id_order = $this->input->post('id_order');
		
		$total_harga = $subtotal+$pengiriman;
		
		$cek_order = $this->penjualan_order_m->cek_tabel_order_byid($id_order); //di cek jika tabel order dengan id_order sama ada di update jika tidak sama di insert
		
		if($cek_order){ //jika id order ada
			//update
			$this->update->update2('order',array('subtotal'=>$subtotal,'total_harga'=>$total_harga,'status_edit'=>'0'),array('id_order'=>$id_order));// update order
			
			$this->hapus->HapusMaster2(array('id_order'=>$id_order),'temp_order'); //setelah disimpan ke tabel order, tabel temp_order di hapus
			
			$this->hapus->HapusMaster2(array('id_order'=>$id_order),'order_det'); //setelah disimpan ke tabel order, tabel temp_order di hapus
			
			$this->penjualan_order_m->simpan_detail($id_order);//simpan ke tabel order_det dari temp_order_det
		}else{ //jika id order tidak ada
			//insert
			$tabel_hd = "temp_order";
			$select_hd = array("id_order","no_dokumen","id_customer","tanggal","syarat_bayar","keterangan","subtotal","biaya_pengiriman","total_harga");
			$where_hd = array("id_order"=>$id_order);
			$header = $this->getdatatabel->getbyid($tabel_hd,$select_hd,$where_hd);
			$header['status_sj'] = "0";
			$header['status_edit'] = "0";
			$this->simpan->SimpanMaster('order',$header); //simpan ke tabel order dari temp_order
			$this->hapus->HapusMaster2(array('id_order'=>$id_order),'temp_order'); //setelah disimpan ke tabel order, tabel temp_order di hapus
			
			$this->penjualan_order_m->simpan_detail($id_order);//simpan ke tabel order_det dari temp_order_det
		}
		
		$hasil = array('redir'=>base_url('penjualan_order'));
		echo json_encode($hasil);
	}
	
	//coding ini ke bawah untuk proses edit
	function vedit(){		
		$id_order = $this->session->userdata('id_order_edit_sess');
		$header = $this->penjualan_order_m->get_header($id_order);
		
		$this->form_data->id_order = $id_order;
		$this->form_data->no_dokumen = $header[0]->no_dokumen;
		$this->form_data->tanggal = $header[0]->tanggal;
		$this->form_data->total_harga = $header[0]->total_harga;
		$this->form_data->subtotal = $header[0]->subtotal;
		$this->form_data->pengiriman = $header[0]->biaya_pengiriman;
		$this->form_data->keterangan = $header[0]->keterangan;
		$this->form_data->syarat_bayar = $header[0]->syarat_bayar;
		$this->form_data->id_customer = $header[0]->id_customer;
		$this->form_data->kode_customer = $header[0]->kode_customer;
		$this->form_data->nama_customer = $header[0]->nama;
		$this->form_data->alamat_customer = $header[0]->alamat;
		$this->form_data->telp_customer = $header[0]->telpon;
		$this->form_data->kota_customer = $header[0]->kota;
		
		$this->hapus->HapusMaster2(array('id_order'=>$id_order),'temp_order_det'); //setelah disimpan ke tabel order, tabel temp_order di hapus
		$this->penjualan_order_m->simpan_detail_ketemp($id_order);//simpan ke tabel temp_order_det dari order_det
		
		$data['action_form'] = base_url('penjualan_order/saveorder_edit');
		$data['page'] = 'penjualan/v_edit_penjualan_order';
		$this->load->view('template/index',$data);
	}
	
	function saveorder_edit(){
		$this->form_validation->set_rules('no_dokumen', 'No Dokumen', 'trim|required|xss_clean');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required|xss_clean');
		$this->form_validation->set_rules('kode_customer', 'kode_customer', 'required|xss_clean');
		$this->form_validation->set_rules('kode_barang', 'kode_barang', 'required|xss_clean');
		$this->form_validation->set_rules('kuantitas', 'kuantitas', 'trim|required|integer|xss_clean');
		$this->form_validation->set_rules('harga', 'harga', 'trim|required|integer|xss_clean');
		
		if($this->form_validation->run()==false){
			$hasil['status']="false";
			$hasil['msg']="Kolom No Dokumen, Kode Customer,Tanggal, Kode Barang, Kuantitas, dan Harga Tidak Boleh Kosong";
			$hasil['id_order'] = "";
			$hasil['subtotal'] = "";
			$hasil['redir'] = base_url('penjualan_order/vedit');
		}else{
			$id_order = $this->input->post('id_order');
			$select = array('id_order','no_dokumen','id_customer');
			$where = array("id_order"=>$id_order);
			$cek = $this->getdatatabel->getbyid('temp_order',$select,$where); //cek ke tbl order berdasarkan no dokumen, untuk memastikan no dokumen sudah ada atau belum, jika belum ada insert ke tbl order jika sudah ada cukup hanya insert ke tabel order det.
			
			if(!empty($cek['id_order'])){
				$order_det = array("id_order"=>$cek['id_order'],
											"no_dokumen"=>$cek['no_dokumen'],
											"id_barang"=>$this->input->post('id_barang'),
											"kuantitas"=>$this->input->post('kuantitas'),
											"satuan"=>$this->input->post('satuan'),
											"harga"=>$this->input->post('harga'),
											"keterangan"=>$this->input->post('keterangan')
											);
				$this->simpan->SimpanMaster('temp_order_det',$order_det);
				
				$hasil = $this->penjualan_order_m->getsubtotal($cek['id_order']);
				$this->update->update2('temp_order',array('subtotal'=>$hasil['subtotal'],'total_harga'=>$hasil['subtotal']),array('id_order'=>$cek['id_order']));//sementara
			}else{
				//pindah data dari order n order_det
				$tabel_hd = "order";
				$select_hd = array("id_order","no_dokumen","id_customer","tanggal","syarat_bayar","keterangan","subtotal","biaya_pengiriman","total_harga");
				$where_hd = array("id_order"=>$id_order);
				$header = $this->getdatatabel->getbyid($tabel_hd,$select_hd,$where_hd);
				$this->simpan->SimpanMaster('temp_order',$header); //simpan ke tabel temp_order dari order
				
				$select = array('id_order','no_dokumen','id_customer');
				$where = array("id_order"=>$id_order);
				$cek = $this->getdatatabel->getbyid('temp_order',$select,$where);
				$order_det = array("id_order"=>$cek['id_order'],
											"no_dokumen"=>$cek['no_dokumen'],
											"id_barang"=>$this->input->post('id_barang'),
											"kuantitas"=>$this->input->post('kuantitas'),
											"satuan"=>$this->input->post('satuan'),
											"harga"=>$this->input->post('harga'),
											"keterangan"=>$this->input->post('keterangan')
											);
				$this->simpan->SimpanMaster('temp_order_det',$order_det);
				
				//update status edit di order jadi 1
				$this->update->update2('order',array('status_edit'=>'1'),array('id_order'=>$id_order));
				
				$hasil = $this->penjualan_order_m->getsubtotal($cek['id_order']);
				$this->update->update2('temp_order',array('subtotal'=>$hasil['subtotal'],'total_harga'=>$hasil['subtotal']),array('id_order'=>$cek['id_order']));//sementara
			}
			
			$hasil['status']="true";
			$hasil['msg']="";
			$hasil['id_order'] = $id_order;
			
		}
		echo json_encode($hasil);
	}
	
	function get_item_order(){
		$id_order = $this->input->post('id_order');
		
		$data_temp = $this->getdatatabel->getonetabel('temp_order_det',array('id_order'=>$id_order));
		if(count($data_temp)>0){
			$hasil = $this->penjualan_order_m->getsubtotal_edit_temp($id_order);
		}else{
			$hasil = $this->penjualan_order_m->getsubtotal_edit_($id_order);
		}
		
		echo json_encode($hasil);
	}
}
