<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
        $this->load->model('login_m');
        $this->load->library('email');
    }

	public function index()
	{

		if ($this->session->has_userdata('logged_in')) {    
		  if ($this->session->userdata['logged_in']) {
		    redirect("home");
		  }
		}

		$data['active']="home";
		$data['title']="- Kayıt";
		$data['cities']=$this->login_m->get_cities();

		if($this->session->flashdata('registration')){
			$data['reg_error']=$this->session->flashdata('registration');
		}else $data['reg_error']=false;

		if($this->session->flashdata('loginError')){
			$data['login_error']=true;
		}else $data['login_error']=false;

		if($this->session->flashdata('verification_sent')){
			$data['verification_sent']=true;
		}else $data['verification_sent']=false;

		if($this->session->flashdata('unregistered_email')){
			$data['unregistered_email']=true;
		}else $data['unregistered_email']=false;

		if($this->session->flashdata('request_expired')){
			$data['request_expired']=true;
		}else $data['request_expired']=false;

		if($this->session->flashdata('temp_password_error')){
			$data['temp_password_error']=true;
		}else $data['temp_password_error']=false;

		if($this->session->flashdata('password_request_sent')){
			$data['password_request_sent']=true;
		}else $data['password_request_sent']=false;

		if($this->session->flashdata('user_not_active')){
			$data['user_not_active']=true;
		}else $data['user_not_active']=false;

		if($this->session->has_userdata('account_frozen')){
			$data['account_frozen']=true;
		}else $data['account_frozen']=false;


		if($this->session->flashdata('email')){
			$data['email']=$this->session->flashdata('email');
		}else $data['email']="";


		$this->load->view('header',$data);
		$this->load->view('login_view',$data);
		$this->load->view('footer');
	}

	public function register()
	{

		if ($this->session->has_userdata('logged_in')) {    
		  if ($this->session->userdata['logged_in']) {
		    redirect("home");
		  }
		}

		if ($this->input->post('email')==null) {
			redirect("login");
		}

		$birthdate=date("Y-m-d",strtotime($this->input->post('year')."-".$this->input->post('month')."-".$this->input->post('day')));

		$new_user['email']=$this->input->post('email');
		$new_user['password']=md5($this->input->post('password'));
		$new_user['name']=$this->input->post('name');
		$new_user['surname']=$this->input->post('surname');
		$new_user['birthdate']=$birthdate;
		$new_user['gender']=$this->input->post('gender');
		//$new_user['phone']=$this->input->post('phone');
		$new_user['district']=$this->input->post('district');
		$new_user['reg_date']=date("Y-m-d");
		$new_user['hash']=hash('crc32b' ,rand(0,1000) );

		if ($registered_user = $this->login_m->register_user($new_user)) {

			/*
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
			*/
			//$user=$this->login_m->get_user_by_email($new_user['email']);
			$data['user_id']=$registered_user['user_id'];
			$data['hash']=$new_user['hash'];

			$this->verify_account($data['user_id'],$data['hash']); // When no activation email sent

			/*
			
			$email_body =$this->load->view('verification_email',$data,TRUE);
			
		    $this->email->from('contact@metospher.com', 'Metospher');
			$this->email->to($new_user['email']);
			$this->email->subject('Metospher Aktivasyon');
			$this->email->message($email_body);
			$this->email->send();


			$this->session->set_flashdata('verification_sent',true);
			redirect('login');
			//$this->check_user($new_user['email'],$new_user['password']);

			*/

		}else{
			$this->session->set_flashdata('registration', "Bu email daha önce alınmış gibi gözüküyor.");
			redirect('login');
		}
	}


	public function check_user($email=0,$password=0){

		if ($this->session->has_userdata('logged_in')) {    
		  if ($this->session->userdata['logged_in']) {
		    redirect("home");
		  }
		}

		if($email==0) $email=$this->input->post('email');
		if($password==0) $password=$this->input->post('password');

		if($resultrow=$this->login_m->check_user($email, $password)){
			
			if ($resultrow['is_active']==1) {
				$this->start_session($resultrow);
				if(isset($resultrow['after_frozen'])){
					$this->request_m->unfreeze_requests();
					$this->session->set_userdata('after_frozen',true);
				} 
			}else{
				$this->session->set_flashdata('user_not_active', true);
				redirect("login");
			}
			

			if($this->session->flashdata('redirect')){
				redirect($this->session->flashdata('redirect'));
			}else{
				redirect("home");
			}
								
			
		}else{
			$this->session->set_flashdata('email', $this->input->post('email'));
			$this->session->set_flashdata('loginError', true);
			redirect("login");
		}
							
	}

	public function verify_account($id, $hash){

		if ($this->session->has_userdata('logged_in')) {    
		  if ($this->session->userdata['logged_in']) {
		    redirect("home");
		  }
		}

		//Link ile ulaşılır; linkteki kullanıcı bilgileri kontrol ettirilir
		if($resultrow=$this->login_m->check_hash($id, $hash)){

			//Eğer aktivasyon daha önce gerçekleştirilmişse anasayfaya yönlendirilir
			if ($resultrow['is_active']==1) {
				redirect('home');
			}

			//Eğer aktivasyon henüz gerçekleştirilmemişse aşağıda gerçekleştirilir
			else{

				$this->login_m->activate_user($resultrow['user_id']);

				$this->start_session($resultrow);

				$this->session->set_flashdata('new_registration', true); 
				redirect("register/will_teach");
			}

			

		}
		//Link hatalıysa veya link ile gelinmediyse anasayfaya yönlendirilir
		else{
			redirect('home');
		}
	}

	public function save_contact(){
		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {

		  		$contact['contact_email']=$this->session->userdata['email'];
		  		$contact['contact_name']=$this->session->userdata['name']." ".$this->session->userdata['surname'];
		  		$contact['contact_text']=$this->input->post('contacts_message');
				
				if ($this->login_m->save_contact($contact)) {
					$this->session->set_flashdata('contact_sent',true);
				}
				
				redirect('home');

		  	}else{
		  		$contact['contact_email']=$this->input->post('contacts_email');
		  		$contact['contact_name']=$this->input->post('contacts_name');
		  		$contact['contact_text']=$this->input->post('contacts_message');
				
				if ($this->login_m->save_contact($contact)) {
					$this->session->set_flashdata('contact_sent',true);
				}
				redirect('login');
		  	}
		}else{
			$contact['contact_email']=$this->input->post('contacts_email');
	  		$contact['contact_name']=$this->input->post('contacts_name');
	  		$contact['contact_text']=$this->input->post('contacts_message');
			
			if ($this->login_m->save_contact($contact)) {
				$this->session->set_flashdata('contact_sent',true);
			}
			redirect('login');
		}
	}

	public function send_temp_password(){

		if ($this->session->has_userdata('logged_in')) {    
		  if ($this->session->userdata['logged_in']) {
		    redirect("home");
		  }
		}

		$email = $this->input->post('email-forgot');
		$hash=hash('crc32b' ,rand(0,1000) );

		if (!$this->login_m->email_exists($email)) {
			$this->session->set_flashdata('unregistered_email',true);
			redirect("login");
		}else{
			$user=$this->login_m->email_exists($email);
		}

		if (isset($email)) {
			$password_request['pr_email']=$email;
			$password_request['pr_hash']=$hash;
			$this->login_m->new_password($password_request);
		}

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

		//$user=$this->login_m->get_user_by_email($new_user['email']);
		$data['user_id']=$user['user_id'];
		$data['hash']=$hash;
		
		$email_body =$this->load->view('new_password_email',$data,TRUE);
		
	    $this->email->from('contact@metospher.com', 'Metospher');
		$this->email->to($email);
		$this->email->subject('Yeni Şifre İsteği');
		$this->email->message($email_body);
		$this->email->send();

		$this->session->set_flashdata('password_request_sent',true);
		redirect("login");

	}

	public function check_temp_password($user_id, $hash){
		if ($this->session->has_userdata('logged_in')) {    
		  if ($this->session->userdata['logged_in']) {
		    redirect("home");
		  }
		}

		if ($pr=$this->login_m->check_temp_password($user_id, $hash)) {
			if (strtotime($pr['pr_time'])<strtotime("24 hours ago")) {
				$this->session->set_flashdata('request_expired',true);
				redirect("login");
			}else{
				$data['hash']=$hash;
				$data['active']="home";
				$data['title']="- Şifremi unuttum";
				$data['user_id']=$user_id;

				$this->load->view('header',$data);
				$this->load->view('temporary_password');
				$this->load->view('footer');
			}
		}else{
			redirect("login");
		}


	}

	public function update_temp_password($user_id=""){

		if ($this->session->has_userdata('logged_in')) {    
		  if ($this->session->userdata['logged_in']) {
		    redirect("home");
		  }
		}

		$temp_password=$this->input->post('temp_password');
        $new_password=$this->input->post('new_password');

        if ($user=$this->login_m->update_temp_password($user_id, $temp_password , $new_password)) {
        	$this->start_session($user);
	       	$this->session->set_flashdata('password_updated',true);
        }else{
        	$this->session->set_flashdata('temp_password_error',true);
        }

        redirect("home");
	}


	public function start_session($user){

		$userinfo = array(
			'user_id' => $user['user_id'],
		    'name'  => $user['name'],
		    'surname'  => $user['surname'],
		    'email'     => $user['email'],
		    'birthdate' => $user['birthdate'],
		    'gender' => $user['gender'],
		    'phone' => $user['phone'],
		    'district' => $user['district'],
		    'reg_date' => $user['reg_date'],
		    'short_info' =>htmlspecialchars($user['short_info']),
		    'is_active' => $user['is_active'],
		    'logged_in' => TRUE
		);
		if (isset($user['institution'])) {
			$userinfo['institution']=$user['institution'];
		}
		return $this->session->set_userdata($userinfo);
	}


	public function logout()
	{
		$this->session->sess_destroy();
		
		redirect('login');
	}	

	public function email(){
		$data['user_id']=5;
		$data['hash']=14077519;


		$data['user']=$this->session->userdata;

		$this->load->view('notification_email',$data);
	
	}

	
}
