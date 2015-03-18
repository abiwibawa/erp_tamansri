<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_pembayaran extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model(array('penjualan_pembayaran_m'));
    }
	
	public function index()
	{
		$key=md5(rand(8888,999999));
		$this->form_data->key = $key;
		$this->form_data->id_akun_bank = "";
		$data['cmbakunbank'] = $this->cmb_akunbank();
		$data['cmb_perkiraanhutang'] = $this->cmb_perkiraanhutang();
		$data['action_form'] = base_url('penjualan_pembayaran/savetemp');
		$data['page'] = 'penjualan/v_penjualan_pembayaran';
		$this->load->view('template/index',$data);
	}
	
	function simpan(){
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required|xss_clean');
		$this->form_validation->set_rules('id_akun_bank', 'id_akun_bank', 'required|xss_clean');
		$this->form_validation->set_rules('kode_customer', 'kode_customer', 'required|xss_clean');
		$this->form_validation->set_rules('no_kwitansi', 'no_kwitansi', 'required|xss_clean');
		$this->form_validation->set_rules('jumlah', 'jumlah', 'required|xss_clean');
		$getPost = $this->input->post(null,true);
		if($this->form_validation->run()==false){
			$hasil['status']="false";
		}else{
			$wherecek['key'] = $getPost['key'];
			$tanggal['tanggal'] =date('Y-m-d',strtotime($getPost['tanggal']));
			$save_debet_h = elements(array('key'),$getPost);
			$save_debet_h = $save_debet_h+$tanggal+array('keterangan'=>$getPost['memo']);
			$this->simpan->SimpanMaster('debit_h',$save_debet_h);
			$this->simpan->SimpanMaster('kredit_h',$save_debet_h);
			
			if($getPost['debet']!="" || $getPost['kredit']!=""){
				if(intval($getPost['debet'])>intval($getPost['kredit'])){
					$jum_debit['jumlah'] = intval($getPost['jumlah']);
					$jum_kredit['jumlah'] = intval($getPost['jumlah'])+intval($getPost['debet']);
					$nilaitambahan['jumlah'] = intval($getPost['debet']);
				}else{
					$jum_debit['jumlah'] = intval($getPost['jumlah'])-intval($getPost['kredit']);
					$jum_kredit['jumlah'] = intval($getPost['jumlah']);
					$nilaitambahan['jumlah'] = intval($getPost['kredit']);
				}
			}else{
				$jum_debit['jumlah'] = intval($getPost['jumlah']);
				$jum_kredit['jumlah'] = intval($getPost['jumlah']);
				$nilaitambahan['jumlah'] = "";
			}
			
			$select_deb = array('id_debit_h');
			$debit_h = $this->getdatatabel->getbyid('debit_h',$select_deb,$wherecek);
			$save_deb_d = elements(array('id_rek'),$getPost);
			$save_deb_d = $save_deb_d+$jum_debit+array('id_debit_h'=>$debit_h['id_debit_h'])+array('keterangan'=>$getPost['memo']);
			$this->simpan->SimpanMaster('debit_d',$save_deb_d);
			
			
			$select_ker = array('id_kredit_h');
			$kredit = $this->getdatatabel->getbyid('kredit_h',$select_ker,$wherecek);
			$save_kred_d['id_rek'] = $getPost['id_rek_lawan'];
			$save_kred_d = $save_kred_d+$jum_kredit+array('id_kredit_h'=>$kredit['id_kredit_h'])+array('keterangan'=>$getPost['memo']);
			$this->simpan->SimpanMaster('kredit_d',$save_kred_d);
			
			if($nilaitambahan['jumlah']!=""){
				$nilaitambahan = $nilaitambahan+array('id_debit_h'=>$debit_h['id_debit_h'])+array('keterangan'=>$getPost['keterangan'])+array('id_rek'=>$getPost['id_perkiraan_hutang']);
				$this->simpan->SimpanMaster('debit_d',$nilaitambahan);
			}
			
			$jurnal = elements(array('id_akun_bank','id_customer'),$getPost);
			$jurnal = $jurnal+array('id_kredit_h'=>$kredit['id_kredit_h'])+array('id_debit_h'=>$debit_h['id_debit_h'])+$tanggal+array('id_jenis_jurnal'=>'1')+array('no_dokumen'=>$getPost['no_kwitansi'])+array('memo'=>$getPost['memo']);
			$this->simpan->SimpanMaster('jurnal',$jurnal);
			$hasil['status']="true";
			$hasil['redir']=base_url('penjualan_pembayaran');
		}
		
		echo json_encode($hasil);
	}
	
	function cmb_akunbank(){
		$cmb = array();
		$cmb[''] = '- akun bank -';
		$q = "select * from kode_perkiraan where CHAR_LENGTH(no_perkiraan)>2 AND LEFT(no_perkiraan,2) = '10'";
		$query = $this->db->query($q);
		foreach($query->result() as $row){
			$cmb[$row->no_perkiraan] = $row->uraian;
		}
		return $cmb;
	}
	function cmb_perkiraanhutang(){
		$cmb = array();
		$cmb[''] = '- kode perkiraan -';
		$q = "select * from kode_perkiraan where CHAR_LENGTH(no_perkiraan)>2 AND LEFT(no_perkiraan,2) = '24'";
		$query = $this->db->query($q);
		foreach($query->result() as $row){
			$cmb[$row->id_perkiraan] = $row->no_perkiraan.' - '.$row->uraian;
		}
		return $cmb;
	}
}
