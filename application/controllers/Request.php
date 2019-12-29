<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request extends CI_Controller {

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

	public function __construct()
    {
        parent::__construct();
        $this->load->model('request_m');
        $this->load->helper('date');
    }

    

	public function index()
	{

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {
				$data['active']="request";
				$data['title']="- İstekler";


				$data['person']="new";

				$data['requests']=$this->request_m->get_requests();
				$data['accepted_requests']=$this->request_m->get_accepted_requests();

				$data['sent_requests']=$this->request_m->get_sent_requests();
				$data['sent_accepted_requests']=$this->request_m->get_sent_accepted_requests();

				$this->load->view('header',$data);
				$this->load->view('request_view');
				$this->load->view('footer');
		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

		
	}


	public function chats($person){

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {

		  		$talk_exists=false;

				if ($person=="new") {
					redirect('request');
				}

				$data['active']="request";
				$data['title']="- İstekler";

				
				

				$data['requests']=$this->request_m->get_requests();
				$ars=$data['accepted_requests']=$this->request_m->get_accepted_requests();

				$data['sent_requests']=$this->request_m->get_sent_requests();
				$sars=$data['sent_accepted_requests']=$this->request_m->get_sent_accepted_requests();

				foreach ($ars as $ar) {
					if ($ar['req_from']==$person) {
						$data['person_info']=$ar;
						$data['messages']=$this->request_m->get_messages($ar['req_id']);
						$this->request_m->set_seen($ar['req_id']);
						$talk_exists=true;
					}
				}

				foreach ($sars as $sar) {
					if ($sar['req_to']==$person) {
						$data['person_info']=$sar;
						$data['messages']=$this->request_m->get_messages($sar['req_id']);
						$this->request_m->set_seen($sar['req_id']);
						$talk_exists=true;
					}
				}

				if (!$talk_exists) {
					$person="new";
					redirect("request");
				}

				$data['person']=$person;

				$this->load->view('header',$data);
				$this->load->view('request_view');
				$this->load->view('footer');

		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

		

	}

	public function send_request($to){

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {
				
				$request['req_from']=$this->session->userdata['user_id'];
				$request['req_to']=$to;

				if($this->request_m->create_request($request)){
					$this->session->set_flashdata('request_sent',true);
					$this->send_request_email($to);
				}else{
					$this->session->set_flashdata('request_failed',true);
				}

				redirect('home');

		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

		
	}

	public function send_request_email($to){

		if (!$this->session->has_userdata('logged_in')) {    
		  if (!$this->session->userdata['logged_in']) {
		    redirect("login");
		  }
		}

		$this->load->library('email');

		$config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.elasticemail.com';
        $config['smtp_user'] = 'contact@metospher.com';
        $config['smtp_pass'] = '99a6c500-95b2-4a43-94fd-3dc8cc262ac3';
        $config['smtp_port'] = 587;
        $config['mailtype']= 'html';
        $config['charset']= 'utf-8';
        $config['newline']    = "\r\n";
        $config['wordwrap']= true;
        
		$this->email->initialize($config);

		$user=$this->request_m->get_user_by_id($this->session->userdata['user_id']);


		$email=$this->request_m->get_user_by_id($to)['email'];

		$this->load->model('profile_m');
		$user['district_name']=$this->profile_m->district_name_by_id($user['district']);
		$user['city_name']=$this->profile_m->city_name_by_district($user['district']);

		$user['teaches']=$this->request_m->get_teaches_by_id($user['user_id']);
		$user['learns']=$this->request_m->get_learns_by_id($user['user_id']);

		
		$email_body =$this->load->view('notification_email',$user,TRUE);
		
	    $this->email->from('contact@metospher.com', 'Metospher');
		$this->email->to($email);
		$this->email->subject('Çalışma İsteği');
		$this->email->message($email_body);
		$this->email->send();

		redirect("request");

	}

	public function accept_request($req_id, $req_from){

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {
				
				$this->request_m->accept_request($req_id);

				redirect('request/chats/'.$req_from);

		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

		

	}

	public function send_message($to, $req){

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {
				
				$message['msg_from']=$this->session->userdata['user_id'];
				$message['msg_to']=$to;
				$message['msg_text']=$this->input->post('msg_text');
				$message['msg_req']=$req;

				$this->request_m->send_message($message);

				redirect('request/chats/'.$to);

		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

		
	}

	public function decline_request($request){
		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {
				
				$this->request_m->decline_request($request);
				redirect('request');
				
		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

		
	}

	public function delete_message($person){
		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {
				
				$this->request_m->decline_request_by_user($person);
				redirect('request');
				
		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

		
	}



	


}
