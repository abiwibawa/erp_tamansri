<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function index()
	{
		$data['page']='home';
		$this->load->view('template/index',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */