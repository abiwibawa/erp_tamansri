<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_lapkwitansi extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->Model(array("penjualan_lapkwitansi_m","penjualan_kwitansi_m"));
		$this->load->library(array("terbilang_lib"));
    }
	
	function index(){
		$sess_edit = array('id_kwitansi_sess'=>"");
		$this->session->set_userdata($sess_edit);
		
		if($this->input->get('page')=="")
			$page=0;
		else	
			$page=$this->input->get('page');
		
		$total_row=count($this->penjualan_lapkwitansi_m->GetData());
		$url = current_url();
		$config_page=$this->config_page($url,$total_row);
		$this->pagination->initialize($config_page);
		$data['paginator'] = $this->pagination->create_links();
		//end pagination
		$set = array("key_sess"=>"","tanggal1_sess"=>"","tanggal2_sess"=>"","filter"=>"");
		$this->session->set_userdata($set);
		$this->form_data->filter = "";
		$this->form_data->key = "";
		$this->form_data->tanggal1 = "";
		$this->form_data->tanggal2 = "";
		$data['data'] = $this->penjualan_lapkwitansi_m->GetData(null,$page,$config_page['per_page']);
		$data['judullaporan'] = "";
		$data['page'] = 'penjualan/v_penjualan_lapkwitansi';
		$this->load->view('template/index',$data);
	}
	
	function filter(){
		if($this->input->get('page')=="")
			$page=0;
		else	
			$page=$this->input->get('page');
		
		if($_POST){
			$getPost = $this->input->post(null,true);
			$filter['filter'] = $getPost['filter'];
			if($getPost['filter'] == "f1" || $getPost['filter'] == "f3" || $getPost['filter'] == "f4"){
				$set = array("key_sess"=>$getPost['key'],"tanggal1_sess"=>"","tanggal2_sess"=>"");
			}elseif($getPost['filter'] == "f2"){
				$set = array("key_sess"=>"","tanggal1_sess"=>$getPost['tanggal1'],"tanggal2_sess"=>$getPost['tanggal2']);
			}
			$this->session->set_userdata($set+$filter);
		}else{
			$filter['filter'] = $this->session->userdata('filter');
		}
		
		$total_row=count($this->penjualan_lapkwitansi_m->GetData($filter['filter']));
		$url = current_url();
		$config_page=$this->config_page($url,$total_row);
		$this->pagination->initialize($config_page);
		$data['paginator'] = $this->pagination->create_links();
		//end pagination
		
		$this->form_data->filter = $this->session->userdata('filter');
		$this->form_data->key = $this->session->userdata('key_sess');
		$this->form_data->tanggal1 = $this->session->userdata('tanggal1_sess');
		$this->form_data->tanggal2 = $this->session->userdata('tanggal2_sess');
		$data['data'] = $this->penjualan_lapkwitansi_m->GetData($filter['filter'],$page,$config_page['per_page']);
		$data['judullaporan'] = "";
		$data['page'] = 'penjualan/v_penjualan_lapkwitansi';
		$this->load->view('template/index',$data);
	}
	
	function vedit(){		
		$id = $this->input->post('id_order');
		$sess_edit = array('id_kwitansi_sess'=>$id);
		$this->session->set_userdata($sess_edit);
		$hasil['redir'] = base_url('penjualan_kwitansi/vedit');
		echo json_encode($hasil);
	}
	
	function showdetil(){
		$id = $this->input->post('id_order');
		$header = $this->penjualan_kwitansi_m->get_header($id);		
		$hasil['no_dokumen'] = $header['no_kwitansi'];
		$hasil['vtabel'] = $this->penjualan_kwitansi_m->showdetil($id);
		echo json_encode($hasil);
	}
	
	function config_page($url,$total_row){
		$config['base_url']=$url;
		$config['total_rows']=$total_row;
		$config['per_page']=10;
		
		$config['full_tag_open'] = '<div align="center"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></div>';
		 
		$config['first_link'] = '&laquo; Pertama';
		$config['first_tag_open'] = '<li class="prev page">';
		$config['first_tag_close'] = '</li>';
		 
		$config['last_link'] = 'Terakhir &raquo;';
		$config['last_tag_open'] = '<li class="next page">';
		$config['last_tag_close'] = '</li>'; 
		 
		$config['next_link'] = 'Selanjutnya &rarr;';
		$config['next_tag_open'] = '<li class="next page">';
		$config['next_tag_close'] = '</li>';
		 
		$config['prev_link'] = '&larr; Sebelumnya';
		$config['prev_tag_open'] = '<li class="prev page">';
		$config['prev_tag_close'] = '</li>';
		 
		$config['cur_tag_open'] = '<li class="active"><a href="">';
		$config['cur_tag_close'] = '</a></li>';
		 
		$config['num_tag_open'] = '<li class="page">';
		$config['num_tag_close'] = '</li>';
		
		$config['uri_segment'] = 3;
		$config['enable_query_strings'] = TRUE;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
		
		return $config;
	}
}
