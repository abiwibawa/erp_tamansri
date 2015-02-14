<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class master_popup extends CI_Controller{
	
	function __construct() {
		parent::__construct();
		$this->load->model('master_popup_m');
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
}
