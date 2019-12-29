<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
        $this->load->model('profile_m');
        
    }

    

	public function index()
	{

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {
				$data['active']="profile";
				$data['title']="- Profil";
				$data['view']="profile/default_view";
				$data['option']="default";

				$this->load->helper('form');

				$this->load->view('header',$data);
				$this->load->view('profile_view');
				$this->load->view('footer');
		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

		
	}

	public function settings($view){

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {

				$data['active']="profile";
				$data['view']="profile/".$view."_view";
				$data['option']=$view;

				switch ($view) {
					case 'image':
						$data['title']="- Profil Fotoğrafı";

						$this->load->helper('form');

						if($this->session->flashdata('alert_text')){
							$data['alert_type']=$this->session->flashdata('alert_type');
							$data['alert_strong']=$this->session->flashdata('alert_strong');
							$data['alert_text']=$this->session->flashdata('alert_text');
						}

						break;

					case 'info':
						$data['title']="- Öğretim Tecrübesi";
						break;
					
					case 'password':
						$data['title']="- Şifre Değişikliği";
						break;

					case 'change_teach':
					
						$data['title']="- Öğretebilecekleriniz";

						$this->load->model('register_m');
						$data['categories']=$this->register_m->get_categories();
						$data['lessons']=$this->profile_m->get_lessons_to_teach();

						$data['my_teaches']=$this->profile_m->get_my_teaches();

						break;

					case 'change_learn':
						
						$data['title']="- Öğrenecekleriniz";

						$this->load->model('register_m');
						$data['categories']=$this->register_m->get_categories();
						$data['lessons']=$this->profile_m->get_lessons_to_learn();

						$data['my_learns']=$this->profile_m->get_my_learns();

						

						break;

					case 'city':
						$data['title']="- Yaşadığınız şehir";
						$this->load->model('login_m');
						$data['cities']=$this->login_m->get_cities();
						break;

					case 'freeze':
						$data['title']="- Hesabı dondurun";
						break;

					case 'blocks':
						$data['title']="- Engellenenler";
						$data['blocks']=$this->profile_m->get_blocks();
						break;

					default:
						# code...
						break;
				}


				if($this->session->flashdata('alert_text')){
					$data['alert_type']=$this->session->flashdata('alert_type');
					$data['alert_strong']=$this->session->flashdata('alert_strong');
					$data['alert_text']=$this->session->flashdata('alert_text');
				}

				$this->load->view('header',$data);
				$this->load->view('profile_view');
				$this->load->view('footer');

		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

		
	}

	public function update_info(){

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {
				
				$info_text=htmlspecialchars($this->input->post('info_text'));

		        if ($this->profile_m->update_info($info_text)) {
			       	$this->session->set_userdata(array('short_info'=>$info_text));

			       	$this->session->set_flashdata('alert_type','success');
			       	$this->session->set_flashdata('alert_strong','');
			       	$this->session->set_flashdata('alert_text','Hakkınızda bilgisini başarıyla değiştirdiniz.');
		        }else{
		        	$this->session->set_flashdata('alert_type','danger');
			       	$this->session->set_flashdata('alert_strong','Ops!');
		        	$this->session->set_flashdata('alert_text','Hakkınızda bilgisi güncellenirken bir hata oluştu!');
		        }

		        redirect("profile/settings/info");

		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

        

    }

    public function update_password(){

    	if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {

				$old_password=$this->input->post('old_password');
		        $new_password=$this->input->post('new_password');

		        if ($this->profile_m->update_password($old_password , $new_password)) {
			       	$this->session->set_flashdata('alert_type','success');
			       	$this->session->set_flashdata('alert_strong','');
			       	$this->session->set_flashdata('alert_text','Şifreniz başarıyla güncellenmiştir.');
		        }else{
		        	$this->session->set_flashdata('alert_type','danger');
			       	$this->session->set_flashdata('alert_strong','Şifre değiştirilemedi!');
		        	$this->session->set_flashdata('alert_text','Lütfen eski şifrenizi doğru girdiğinizden emin olun.');
		        }

		        redirect("profile/settings/password");

		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

        

    }

    public function delete_my_teach(){

    	if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {

				$error_found=false;
		    	$lessons=$this->input->post('lessons_to_delete');


					if (is_array($lessons)) {
						foreach ($lessons as $lesson) {
							if(!$this->profile_m->delete_my_teach($lesson)) $error_found=true;
						}
					}else{
						if(!$this->profile_m->delete_my_teach($lessons)) $error_found=true;
					}

					if ($error_found) {
						$this->session->set_flashdata('alert_type','danger');
				       	$this->session->set_flashdata('alert_strong','Ops!');
			        	$this->session->set_flashdata('alert_text','Bilgileriniz güncllenirken bir hata oluştu.');
					}else{
						$this->session->set_flashdata('alert_type','success');
				       	$this->session->set_flashdata('alert_strong','');
				       	$this->session->set_flashdata('alert_text','Öğreteceğiniz dersler başarıyla güncellenmiştir.');
					}

					redirect("profile/settings/change_teach");

		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

    	

    }

    public function delete_my_learn(){

    	if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {

			    $error_found=false;
	    		$lessons=$this->input->post('lessons_to_delete');

				if (is_array($lessons)) {
					
					foreach ($lessons as $lesson) {
						if(!$this->profile_m->delete_my_learn($lesson)) $error_found=true;
					}
					
				}else{
					if(!$this->profile_m->delete_my_learn($lessons))$error_found=true;
				}

				if ($error_found) {
					$this->session->set_flashdata('alert_type','danger');
			       	$this->session->set_flashdata('alert_strong','Ops!');
		        	$this->session->set_flashdata('alert_text','Bilgileriniz güncllenirken bir hata oluştu.');
				}else{
					$this->session->set_flashdata('alert_type','success');
			       	$this->session->set_flashdata('alert_strong','');
			       	$this->session->set_flashdata('alert_text','Öğrenmek istediğiniz dersler başarıyla güncellenmiştir.');
				}

				redirect("profile/settings/change_learn");

		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}
    	
    	

    }

    public function update_district(){

    	if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {

				$district_no=$this->input->post('district');

		    	if ($this->profile_m->update_district($district_no)) {
		    		$this->session->set_userdata('district',$district_no);

		    		$this->session->set_flashdata('alert_type','success');
			       	$this->session->set_flashdata('alert_strong','');
			       	$this->session->set_flashdata('alert_text','Yaşadığınız şehir başarıyla güncellenmiştir.');
		    	}else{
		    		$this->session->set_flashdata('alert_type','danger');
			       	$this->session->set_flashdata('alert_strong','Ops!');
		        	$this->session->set_flashdata('alert_text','Bilgileriniz güncllenirken bir hata oluştu.');
		    	}

		    	redirect("profile/settings/city");
		    	
		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

    	

    }

    public function update_name(){

    	if ($this->session->has_userdata('logged_in')==false || $this->session->userdata['logged_in']==false) {
    		redirect("login");
    	}

    	$name=$this->input->post('name');
    	$surname=$this->input->post('surname');

    	if ($this->profile_m->update_name($name, $surname)) {

    		$this->session->set_userdata('name',$name);
    		$this->session->set_userdata('surname',$surname);

    		$this->session->set_flashdata('alert_type','success');
			$this->session->set_flashdata('alert_strong','');
			$this->session->set_flashdata('alert_text','İsminiz başarıyla güncellenmiştir.');

    	}else{

    		$this->session->set_flashdata('alert_type','danger');
	       	$this->session->set_flashdata('alert_strong','Ops!');
        	$this->session->set_flashdata('alert_text','Bilgileriniz güncllenirken bir hata oluştu.');

    	}

    	redirect("profile/settings/default");

    }

    public function update_birthdate(){

    	if ($this->session->has_userdata('logged_in')==false || $this->session->userdata['logged_in']==false) {
    		redirect("login");
    	}

    	$birthdate=date("Y-m-d",strtotime($this->input->post('year')."-".$this->input->post('month')."-".$this->input->post('day')));

    	if ($this->profile_m->update_birthdate($birthdate)) {

    		$this->session->set_userdata('birthdate',$birthdate);

    		$this->session->set_flashdata('alert_type','success');
			$this->session->set_flashdata('alert_strong','');
			$this->session->set_flashdata('alert_text','Doğum tarihiniz başarıyla güncellenmiştir.');

    	}else{

    		$this->session->set_flashdata('alert_type','danger');
	       	$this->session->set_flashdata('alert_strong','Ops!');
        	$this->session->set_flashdata('alert_text','Bilgileriniz güncllenirken bir hata oluştu.');

    	}

    	redirect("profile/settings/default");

    }

    public function update_gender(){

    	if ($this->session->has_userdata('logged_in')==false || $this->session->userdata['logged_in']==false) {
    		redirect("login");
    	}

    	$gender=$this->input->post('gender');

    	if ($this->profile_m->update_gender($gender)) {

    		$this->session->set_userdata('gender',$gender);

    		$this->session->set_flashdata('alert_type','success');
			$this->session->set_flashdata('alert_strong','');
			$this->session->set_flashdata('alert_text','Cinsiyetiniz başarıyla güncellenmiştir.');

    	}else{

    		$this->session->
    		set_flashdata('alert_type','danger');
	       	$this->session->set_flashdata('alert_strong','Ops!');
        	$this->session->set_flashdata('alert_text','Bilgileriniz güncllenirken bir hata oluştu.');

    	}

    	redirect("profile/settings/default");

    }

    public function update_institution(){

    	if ($this->session->has_userdata('logged_in')==false || $this->session->userdata['logged_in']==false) {
    		redirect("login");
    	}

    	$institution=$this->input->post('institution');

    	if ($this->profile_m->update_institution($institution)) {

    		$this->session->set_userdata('institution',$institution);

    		$this->session->set_flashdata('alert_type','success');
			$this->session->set_flashdata('alert_strong','');
			$this->session->set_flashdata('alert_text','Kurumunuz başarıyla güncellenmiştir.');

    	}else{

    		$this->session->set_flashdata('alert_type','danger');
	       	$this->session->set_flashdata('alert_strong','Ops!');
        	$this->session->set_flashdata('alert_text','Bilgileriniz güncllenirken bir hata oluştu.');

    	}

    	redirect("profile/settings/default");

    }

    public function save_suggestion($segment){

    	if ($this->session->has_userdata('logged_in')==false || $this->session->userdata['logged_in']==false) {
    		redirect("login");
    	}

    	$lesson=$this->input->post('suggestedLesson');

    	$contact['contact_email']=$this->session->userdata['email'];
  		$contact['contact_name']=$this->session->userdata['name']." ".$this->session->userdata['surname'];
  		$contact['contact_text']="Ders önerisi: ".$lesson;
		
		if ($this->profile_m->save_contact($contact)) {
			$this->session->set_flashdata('alert_type','success');
			$this->session->set_flashdata('alert_strong','Teşekkürler!');
			$this->session->set_flashdata('alert_text','Ders öneriniz alınmıştır. En kısa zamanda değerlendireceğiz.');
		}
		
		redirect('profile/settings/'.$segment);

    }

    public function freeze_user(){

    	$password=$this->input->post('password');
    	$freezeReason=$this->input->post('freezeReason');
    	
    	if ($this->profile_m->check_password($password)) {

    		$contact['contact_email']=$this->session->userdata['email'];
	  		$contact['contact_name']=$this->session->userdata['name']." ".$this->session->userdata['surname'];
	  		$contact['contact_text']="Hesabımı donduruyorum çünkü: ".$freezeReason;

    		if ($this->profile_m->freeze_user($contact)) {
    			$this->request_m->freeze_requests();
    			$this->session->sess_destroy();
    			$this->session->set_userdata('account_frozen',true);
    			redirect('login');
    		}else{
    			$this->session->set_flashdata('alert_type','danger');
				$this->session->set_flashdata('alert_strong','Ops!');
				$this->session->set_flashdata('alert_text','Hesabınız dondurulurken bir hatayla karşılaşıldı.');
				redirect('profile/settings/freeze');
    		}
    	}else{
    		$this->session->set_flashdata('alert_type','danger');
			$this->session->set_flashdata('alert_strong','Şifre yanlış!');
			$this->session->set_flashdata('alert_text','Şifreyi yanlış girdiniz. Hesabınızı dondurmak için şifrenizi doğru girmelisiniz.');
			redirect('profile/settings/freeze');
    	}


    }

    public function lift_block($block_id){
    	$this->request_m->lift_block($block_id);
    	redirect('profile/settings/blocks');
    }

	


}
