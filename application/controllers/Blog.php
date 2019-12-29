<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {

			    $data['active']="blog";
				$data['title']="- Blog";

				$data['logged_in']=true;

				$this->load->view('header',$data);
				$this->load->view('blog_view');
				$this->load->view('footer');
				
		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

		
	}
}
