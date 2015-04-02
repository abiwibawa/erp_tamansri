<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class pembelian_penerimaan_barang extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model('m_pembelian_penerimaan_barang');
		$this->form_data = new StdClass;
    }
	
	public function index()
	{	
		$this->form_data->surat_pemesanan = '';
		$this->form_data->id_pemesanan_h = '';
		$this->form_data->id_pemesanan_d = '';
		$this->form_data->id_suplier = '';
		$this->form_data->nama_suplier = '';
		$this->form_data->alamat_suplier = '';
		$this->form_data->telp_suplier = '';
		$this->form_data->surat_jalan = '';
		$this->form_data->nopol_kendaraan = '';
		$this->form_data->jam = '12:12';
		$data['data'] = $this->m_pembelian_penerimaan_barang->getAll(0,0);
		$data['page']='pembelian/v_pembelian_penerimaan_barang';
		$this->load->view('template/index',$data);
	}

	function cari_barang(){
		//$data = array();
		$id_pem = $this->input->get("id_pemesanan");
		$id_sup = $this->input->get("id_suplier");
		$data['list'] = $this->m_pembelian_penerimaan_barang->cari_barang_pemesanan($id_pem,$id_sup)->result();
		$data['page'] = 'popup/cari_barang_pemesanan';
		//echo $data['td'];
		$this->load->view('popup/popup',$data);
	}
	
	function simpan(){
		$this->form_validation->set_rules('no_surat_jalan','surat jalan','trim|required|xss_clean');
		$this->form_validation->set_rules('nopol','Nopol Kendaraan','trim|required|xss_clean');
		$this->form_validation->set_rules('jam','Jam','trim|required|xss_clean');
		$this->form_validation->set_rules('kuantitas_barang','kuantitas barang','trim|required|xss_clean');
		$this->form_validation->set_rules('keterangan','keterangan','trim|required|xss_clean');
		//$date = new now('Y-m-d');
		
		if($this->form_validation->run() == TRUE){
			$value = array(
					'id_pemesanan_h'=>$this->input->post('id_pemesanan_h'),
					'tanggal'=> Date("Y-m-d"),
					'no_surat_jalan'=> $this->input->post('no_surat_jalan'),
					'no_pol'=> $this->input->post('nopol'),
					'jam'=> $this->input->post('jam'),
					);
			$cek = $this->db->get_where('pembelian_penerimaan_h', $value)->num_rows();
			//$cek = $this->m_pembelian_penerimaan_barang->cek_tabel_penerimaan($value);
			//$hasil['dokumen'] = $cek;
			if ($cek != 1) {
				$simpan_penerimaan_h = $this->simpan->SimpanMaster('pembelian_penerimaan_h',$value);
			}

			$this->db->select_max('id_penerimaan_h');
			$query = $this->db->get('pembelian_penerimaan_h')->row();
			//echo $query->id_penerimaan_h;
			$value2 = array(
					'id_penerimaan_h' => $query->id_penerimaan_h,
					'id_pemesanan_d' => $this->input->post('id_pemesanan_d'),
					'id_barang' => $this->input->post('id_barang'),
					'no_urut' => $this->input->post(''),
					'kuantitas' => $this->input->post('kuantitas_barang'),
					'keterangan' => $this->input->post('keterangan'),
					);
			$simpan_penerimaan_d = $this->simpan->SimpanMaster('pembelian_penerimaan_d',$value2);
		}
		//$hasil = $this->m_pembelian_penerimaan_barang->getAll(1);
		$hasil = $this->m_pembelian_penerimaan_barang->getAll($this->input->post('id_pemesanan_h'), $query->id_penerimaan_h);
		//$hasil['dokumen'] = $tes;
		$hasil['js'] = 
		"<script>$(document).ready(function(){
			$(\".edit-penerimaan-barang\").click(function(){
				var vurl=$(this).attr('data-url');
				var id_pemesanan_h=$(this).attr('id-pemesanan-h');
				var id_penerimaan_h=$(this).attr('id-penerimaan-h');
				var id_penerimaan_d=$(this).attr('id-penerimaan-d');
				
				//alert(vurl+id_pemesanan_h+id_penerimaan_h+id_penerimaan_d);
				var parsing = {id_pemesanan_h:id_pemesanan_h, id_penerimaan_h:id_penerimaan_h, id_penerimaan_d:id_penerimaan_d };
				$.ajax({
					type: \"post\",
					url: vurl,
					dataType: \"json\",
					data:parsing,
					success: function(response) {
					//alert(response.dokumen);
					noty({text: '<b>Data Penerimaan Berhasil Di Hapus.</b>', type: 'success',timeout:2000});
						$(\"#tabel .block .content\").html(response.vtabel);
						$(\".js\").html(response.js);
					}
				});
			});
			
			$(\".simpan_penerimaan\").click(function(){
				var vurl = $(this).attr(\"data-url\");
				window.location.replace(vurl,'_blank');
			});
		});</script>";
		echo json_encode($hasil);
		//echo $hasil['vtabel'];
		//redirect(base_url('pembelian_penerimaan_barang'),'refresh');
	}
	
	function edit_modal(){
		$id_penerimaan_d = $this->input->post('id');
		$data_edit = $this->m_pembelian_penerimaan_barang->getById($id_penerimaan_d)->row();
		$this->form_data->id_penerimaan_d = $data_edit->id_penerimaan_d;
		$this->form_data->nama_barang = $data_edit->nama_barang;
		$this->form_data->kuantitas = $data_edit->kuantitas;
		$this->load->view('page/pembelian/modal/mod_edit_penerimaan_qty');
	}
	
	function update(){
		$this->form_validation->set_rules('nama_barang','nama_barang','trim|required|xss_clean');
		$this->form_validation->set_rules('qty','Kuantitas','trim|required|xss_clean');
		if($this->form_validation->run() == TRUE){
			$data = array(
					'kuantitas' => $this->input->post('qty')
					);
			$where = array('id_penerimaan_d'=>$this->input->post('id_penerimaan_d'));
			$simpan_penerimaan_d = $this->update->update2('pembelian_penerimaan_d',$data,$where);
		}
		redirect(base_url('pembelian_penerimaan_barang'),'refresh');
		
	}
	
	function hapus(){
		$id_penerimaan_d = $this->input->post('id_penerimaan_d');
		$id_penerimaan_h = $this->input->post('id_penerimaan_h');
		$id_pemesanan_h = $this->input->post('id_pemesanan_h');
		//$this->m_pembelian_penerimaan_barang->hapus(array('id_penerimaan_h'=>$id_penerimaan_h), 'pembelian_penerimaan_h');
		$this->m_pembelian_penerimaan_barang->hapus(array('id_penerimaan_d'=>$id_penerimaan_d), 'pembelian_penerimaan_d');
		$hasil = $this->m_pembelian_penerimaan_barang->getAll($id_pemesanan_h, $id_penerimaan_h );
		$hasil['dokumen'] = 'berhasil hapus'; 
		$hasil['js'] = 
		"<script>$(document).ready(function(){
			$(\".edit-penerimaan-barang\").click(function(){
				var vurl=$(this).attr('data-url');
				var id_pemesanan_h=$(this).attr('id-pemesanan-h');
				var id_penerimaan_h=$(this).attr('id-penerimaan-h');
				var id_penerimaan_d=$(this).attr('id-penerimaan-d');
				
				//alert(vurl+id_pemesanan_h+id_penerimaan_h+id_penerimaan_d);
				var parsing = {id_pemesanan_h:id_pemesanan_h, id_penerimaan_h:id_penerimaan_h, id_penerimaan_d:id_penerimaan_d };
				$.ajax({
					type: \"post\",
					url: vurl,
					dataType: \"json\",
					data:parsing,
					success: function(response) {
					//alert(response.dokumen);
					noty({text: '<b>Data Penerimaan Berhasil Di Hapus.</b>', type: 'success',timeout:3000});
						$(\"#tabel .block .content\").html(response.vtabel);
						$(\".js\").html(response.js);
					}
				});
			});
			
			$(\".simpan_penerimaan\").click(function(){
				var vurl = $(this).attr(\"data-url\");
				window.location.replace(vurl,'_blank');
			});
		});</script>";
		echo json_encode($hasil);
	}
}
