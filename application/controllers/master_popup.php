<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class master_popup extends CI_Controller{
	
	function __construct() {
		parent::__construct();
		$this->load->model('master_popup_m');
    }
	
	function carikwitansi(){
		$key = $this->input->get('idcustomer');
		$data['list'] = $this->master_popup_m->carikwitansi($key);
		$data['page'] = 'popup/carikwitansi';
		$this->load->view('popup/popup',$data);
	}
	
	function caricustomerpembayaran(){
		$key = $this->input->post('key');
		$filter = $this->input->post('filter');
		$this->form_data->key=$key;
		$this->form_data->filter = $filter;
		$data['list'] = $this->master_popup_m->caricustomerpembayaran($key,$filter);
		$data['page'] = 'popup/caricustomerpembayaran';
		$this->load->view('popup/popup',$data);
	}

	function caricustomer(){
		$key = $this->input->post('key');
		$filter = $this->input->post('filter');
		$this->form_data->key=$key;
		$this->form_data->filter=$filter;
		$data['list'] = $this->master_popup_m->caricustomer($key,$filter);
		$data['page'] = 'popup/caricustomer';
		$this->load->view('popup/popup',$data);
	}
	
	function cariproduk(){
		$key = $this->input->post('key');
		$filter = $this->input->post('filter');
		$this->form_data->key=$key;
		$this->form_data->filter=$filter;
		$data['list'] = $this->master_popup_m->cariproduk($key,$filter);
		$data['page'] = 'popup/cariproduk';
		$this->load->view('popup/popup',$data);
	}
	
	function cariproduk_order(){
		$id_order = $this->input->get('id_order');
		$data['list'] = $this->master_popup_m->cariproduk_order($id_order);
		$data['page'] = 'popup/cariproduk_order';
		$this->load->view('popup/popup',$data);
	}
	
	function caricustomer_inv(){
		$key = $this->input->post('key');
		$filter = $this->input->post('filter');
		$this->form_data->key=$key;
		$this->form_data->filter = $filter;
		$data['list'] = $this->master_popup_m->caricustomerinv($key,$filter);
		$data['page'] = 'popup/caricustomer_inv';
		$this->load->view('popup/popup',$data);
	}
	
	function caritempdokumen(){
		$key = $this->input->post('key');
		$this->form_data->key=$key;
		$data['list'] = $this->master_popup_m->cariptempdokumen($key);
		$data['page'] = 'popup/caritempdokumen';
		$this->load->view('popup/popup',$data);
	}
	
	function caripreorder(){
		$key = $this->input->post('key');
		$this->form_data->key = $key;
		$data['list'] = $this->master_popup_m->caripreorder($key);
		$data['page'] = 'popup/caripreorder';
		$this->load->view('popup/popup',$data);
	}
	
	function carisupir(){
		$key = $this->input->post('key');
		$this->form_data->key = $key;
		$data['list'] = $this->master_popup_m->carisupir($key,'mastersupir');
		$data['page'] = 'popup/carisupir';
		$this->load->view('popup/popup',$data);
	}
	
	function caripengirim(){
		$key = $this->input->post('key');
		$this->form_data->key = $key;
		$data['list'] = $this->master_popup_m->carisupir($key,'masterpengirim');
		$data['page'] = 'popup/caripengirim';
		$this->load->view('popup/popup',$data);
	}
	
	function carittd(){
		$key = $this->input->post('key');
		$this->form_data->key = $key;
		$data['list'] = $this->master_popup_m->carisupir($key,'mastertandatangan');
		$data['page'] = 'popup/carittd';
		$this->load->view('popup/popup',$data);
	}
	
	function cariinv(){
		$id_customer = $this->input->get("id_customer");
		$data['list'] = $this->master_popup_m->cariinv($id_customer);
		$data['page'] = 'popup/cariinvoice';
		$this->load->view('popup/popup',$data);
	}
	
	function cariinv_edit(){
		$id_customer = $this->input->get("id_customer");
		$id_kwitansi = $this->input->get("id_kwitansi");
		$data['list'] = $this->master_popup_m->cariinv_edit($id_kwitansi,$id_customer);
		$data['page'] = 'popup/cariinvoice';
		$this->load->view('popup/popup',$data);
	}
	
	function carisuratpemesanan(){
		$data['list'] = $this->master_popup_m->cari_surat_pemesanan();
		//$data['penerimaan'] = $this->master_m->cari_penerimaan();
		$data['page'] = 'popup/carisuratpemesanan';
		$this->load->view('popup/popup',$data);
	}
	
	function cari_barang(){
		//$data = array();
		$id_pem = $this->input->get("id_pemesanan");
		$id_sup = $this->input->get("id_suplier");
		$data['list'] = $this->master_popup_m->cari_barang_pemesanan($id_pem,$id_sup)->result();
		$data['page'] = 'popup/cari_barang_pemesanan';
		//echo $data['td'];
		$this->load->view('popup/popup',$data);
	}
}
