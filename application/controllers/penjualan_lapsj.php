<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class penjualan_lapsj extends CI_Controller{
	function __construct() {
		parent::__construct();
		$this->load->model(array('penjualan_lapsj_m'));
    }
	
	public function index()
	{
		$this->form_data->filter = "";
		$this->form_data->key = "";
		$this->form_data->tanggal1 = "";
		$this->form_data->tanggal2 = "";
		$data['judullaporan']= "";
		$data['data']=array();
		$data['action_form'] = base_url('penjualan_order/saveorder');
		$data['page'] = 'penjualan/v_penjualan_lapsj';
		$this->load->view('template/index',$data);
	}
	
	function filter(){
		//pagination
		if($this->input->get('page')=="")
			$page=0;
		else	
			$page=$this->input->get('page');
			
		$filter = $this->input->post('filter');
		if($_POST){
			if($filter == "f1" || $filter == "f3" || $filter == "f4"){
				$unt_set = array('tanggal1_sess'=>'','tanggal2_sess'=>'');
				$this->session->unset_userdata($unt_set);
				
				$set_sess = array('key_sess'=>$this->input->post('key'),'filter_sess'=>$filter);
				$this->session->set_userdata($set_sess);
			}else{
				$array_items = array('key_sess'=>'');
				$this->session->unset_userdata($array_items);
				
				$set_sess = array('tanggal1_sess'=>$this->input->post('tanggal1'),'tanggal2_sess'=>$this->input->post('tanggal2'),'filter_sess'=>$filter);
				$this->session->set_userdata($set_sess);
			}
		}
		
		
		if($this->session->userdata('key_sess')!="" || $this->session->userdata('tanggal1_sess')!="" || $this->session->userdata('tanggal2_sess')!=""){
			$total_row=count($this->penjualan_lapsj_m->data($this->session->userdata('filter_sess')));
			$url = current_url();
			$config_page=$this->config_page($url,$total_row);
			$this->pagination->initialize($config_page);
			$data['paginator'] = $this->pagination->create_links();
			//end pagination
			
			$data['data']=$this->penjualan_lapsj_m->data($this->session->userdata('filter_sess'),$page,$config_page['per_page']);
		}else{
			$data['data']=array();
		}
		
		$this->form_data->filter = $this->session->userdata('filter_sess');
		$this->form_data->key = $this->session->userdata('key_sess');
		$this->form_data->tanggal1 = $this->session->userdata('tanggal1_sess');
		$this->form_data->tanggal2 = $this->session->userdata('tanggal2_sess');
		$judul = "";
		
		if($this->session->userdata('filter_sess') == "f1"){
			$judul = " No Dokumen : ".$this->session->userdata('key_sess');
		}elseif($this->session->userdata('filter_sess') == "f4"){
			$judul = " No Surat : ".$this->session->userdata('key_sess');
		}elseif($this->session->userdata('filter_sess') == "f2"){
			$judul = " Tanggal  : ".$this->periode->pisahtanggal($this->session->userdata('tanggal1_sess'))." s/d ".$this->periode->pisahtanggal($this->session->userdata('tanggal2_sess'));
		}elseif($this->session->userdata('filter_sess') == "f3"){
			$judul = " Kode Customer : ".$this->session->userdata('key_sess');
		}
		
		$data['judullaporan']= "Berdasarkan".$judul;
		$data['page']='penjualan/v_penjualan_lapsj';
		$this->load->view('template/index',$data);
		
	}
	
	function vedit(){		
		$id_order = $this->input->post('id_order');
		$sess_edit = array('id_order_edit_sess'=>$id_order);
		$this->session->set_userdata($sess_edit);
		$hasil['redir'] = base_url('penjualan_sj/vedit');
		echo json_encode($hasil);
	}
	
	function showdetil(){
		$id_surat_jalan = $this->input->post('id_order');
		
		$select = array('id_surat_jalan','no_surat_jalan','id_customer');
		$where = array("id_surat_jalan"=>$id_surat_jalan);
		$cek = $this->getdatatabel->getbyid('ordersuratjalan',$select,$where);
		
		$tabel = $this->penjualan_lapsj_m->showdetil($id_surat_jalan);
		
		$hasil['no_dokumen'] = $cek['no_surat_jalan'];
		$hasil['vtabel'] = $tabel['vtabel'];
		
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
