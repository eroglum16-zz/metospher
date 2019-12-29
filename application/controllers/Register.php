<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

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
        $this->load->model('register_m');
    }

	public function will_teach(){
		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {

			    
				
				$data['active']="profile";
				$data['categories']=$this->register_m->get_categories();
				$data['lessons']=$this->register_m->get_lessons();

				$this->session->set_flashdata('new_registration', true); 

				$this->load->view('header',$data);
				$this->load->view('teach_view');
				$this->load->view('footer');
			
				

		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}
		
	}

	public function wanna_learn($save='saved'){

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {
				
				

				$data['active']="profile";

				$data['categories']=$this->register_m->get_categories();
				$data['lessons']=$this->register_m->get_lessons();

				$save=$this->session->flashdata('is_saved');

				if($this->session->flashdata('is_saved')){
					$data['alert_type']="success";
					$data['alert_strong']="Tebrikler!";
					$data['alert_text']="Öğretebileceğiniz dersleri kaydettiniz. Peki ne öğrenmek istiyorsunuz?";
				}else{
					$data['alert_type']="warning";
					$data['alert_strong']="Hatırlatma!";
					$data['alert_text']="Öğretebileceğiniz dersleri kaydetmediniz. Aradığınız dersi bulamadıysanız devam edin, daha sonra profil bölümündeki ders menüsünden listeye eklenmesini istediğiniz dersi bize iletin.";
				}

				if($save==false){
					$data['alert_type']="warning";
					$data['alert_strong']="Hatırlatma!";
					$data['alert_text']="Öğretebileceğiniz dersleri kaydetmediniz. Aradığınız dersi bulamadıysanız devam edin, daha sonra profil bölümündeki ders menüsünden listeye eklenmesini istediğiniz dersi bize iletin.";
				}

				$this->session->set_flashdata('new_registration', true); 

				$this->load->view('header',$data);
				$this->load->view('learn_view');
				$this->load->view('footer');

				

		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

		
	}

	public function set_profile($save='saved'){

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {
				

				$data['active']="profile";

				$save=$this->session->flashdata('is_saved');

				if($this->session->flashdata('is_saved')){
					$data['alert_type']="success";
					$data['alert_strong']="Tebrikler!";
					$data['alert_text']="Öğrenmek istediğiniz dersleri kaydettiniz. Şimdi kendiniz hakkında kısa bir bilgi ve bir de fotoğrafınızı rica edebilir miyiz?";
				}else{
					$data['alert_type']="warning";
					$data['alert_strong']="Hatırlatma!";
					$data['alert_text']="Öğrenmek istediğiniz dersleri kaydetmediniz. Aradığınız dersi bulamadıysanız devam edin, daha sonra profil bölümündeki ders menüsünden listeye eklenmesini istediğiniz dersi bize iletin.";
				}

				if($save==false){
					$data['alert_type']="warning";
					$data['alert_strong']="Hatırlatma!";
					$data['alert_text']="Öğrenmek istediğiniz dersleri kaydetmediniz. Aradığınız dersi bulamadıysanız devam edin, daha sonra profil bölümündeki ders menüsünden listeye eklenmesini istediğiniz dersi bize iletin.";
				}

				if($this->session->flashdata('upload_error')){
					$data['alert_type']="danger";
					$data['alert_strong']="Hata!";
					$data['alert_text']=$this->session->flashdata('upload_error');
				}

				$this->load->helper('form');

				$this->load->view('header',$data);
				$this->load->view('photo_view');
				$this->load->view('footer');

				
		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

		
	}

	public function save_teach($op="set"){

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {
				
				

				$this->session->set_flashdata('new_registration', true); 

				# When seach tab is used
				if($this->input->post('lesson_search')){

					$batch=array();

					$lessons=$this->input->post('lesson_search');

					if (is_array($lessons)) {
						$i=0;
						foreach ($lessons as $lesson) {
							$batch[$i] = array('teacher' => $this->session->userdata['user_id'] , 'lesson' => $lesson);
							$i++;
						}
						if($this->register_m->set_teach_batch($batch)) $this->session->set_flashdata('is_saved', true); 
						else $this->session->set_flashdata('is_saved', false); 
					}else{
						$data = array('teacher' => $this->session->userdata['user_id'] , 'lesson' => $lessons );
						if($this->register_m->set_teach($data)) $this->session->set_flashdata('is_saved', true);
						else $this->session->set_flashdata('is_saved', false);  
					}

				# When categories tab is used
				}elseif ($this->input->post('lesson_list')) {
					
					$batch=array();

					$lessons=$this->input->post('lesson_list');

					if (is_array($lessons)) {
						$i=0;
						foreach ($lessons as $lesson) {
							$batch[$i] = array('teacher' => $this->session->userdata['user_id'] , 'lesson' => $lesson);
							$i++;
						}
						if($this->register_m->set_teach_batch($batch)) $this->session->set_flashdata('is_saved', true); 
						else $this->session->set_flashdata('is_saved', false);
					}else{
						$data = array('teacher' => $this->session->userdata['user_id'] , 'lesson' => $lessons );
						if($this->register_m->set_teach($data)) $this->session->set_flashdata('is_saved', true); 
						else $this->session->set_flashdata('is_saved', false); 
					}
				}else{
					$this->session->set_flashdata('is_saved', false); 
				}

				if($op=="change"){
					redirect("profile/settings/change_teach");
				}else{
					redirect("register/wanna_learn");
				}


		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

		
	}

	public function save_learn($op="set"){

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {
				

				$this->session->set_flashdata('new_registration', true); 


				# When seach tab is used
				if($this->input->post('lesson_search')){

					$batch=array();

					$lessons=$this->input->post('lesson_search');

					if (is_array($lessons)) {
						$i=0;
						foreach ($lessons as $lesson) {
							$batch[$i] = array('student' => $this->session->userdata['user_id'] , 'lesson' => $lesson);
							$i++;
						}
						if($this->register_m->set_learn_batch($batch)) $this->session->set_flashdata('is_saved', true); 
						else $this->session->set_flashdata('is_saved', false); 
					}else{
						$data = array('student' => $this->session->userdata['user_id'] , 'lesson' => $lessons );
						if($this->register_m->set_learn($data)) $this->session->set_flashdata('is_saved', true);
						else $this->session->set_flashdata('is_saved', false);  
					}

				# When categories tab is used
				}elseif ($this->input->post('lesson_list')) {
					
					$batch=array();

					$lessons=$this->input->post('lesson_list');

					if (is_array($lessons)) {
						$i=0;
						foreach ($lessons as $lesson) {
							$batch[$i] = array('student' => $this->session->userdata['user_id'] , 'lesson' => $lesson);
							$i++;
						}
						if($this->register_m->set_learn_batch($batch)) $this->session->set_flashdata('is_saved', true); 
						else $this->session->set_flashdata('is_saved', false);
					}else{
						$data = array('student' => $this->session->userdata['user_id'] , 'lesson' => $lessons );
						if($this->register_m->set_learn($data)) $this->session->set_flashdata('is_saved', true); 
						else $this->session->set_flashdata('is_saved', false); 
					}
				}else{
					$this->session->set_flashdata('is_saved', false); 
				}


					
				
					

				if($op=="change"){
					redirect("profile/settings/change_learn");
				}else{
					redirect("register/set_profile");
				}

		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

		
	}

	public function upload_photo($op="set"){

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {
		  		
					

				$this->session->set_flashdata('new_registration', true); 

				$config['upload_path']          = 'assets/profiles/';
		        $config['allowed_types']        = 'jpeg|jpg|png|JPG';
		        $config['file_name']            = $this->session->userdata['user_id'].'.jpg';
		        $config['overwrite']            = true;
		        $config['max_size']             = 5000;
		        $config['max_width']            = 0;
		        $config['max_height']           = 0;

		        $this->load->library('upload', $config);
		        
		        $this->upload->initialize($config);

		        if ( ! $this->upload->do_upload('userfile'))
		        {

		            if($op=="change"){

		            	$this->session->set_flashdata('alert_type','danger');
				       	$this->session->set_flashdata('alert_strong','Ops');
				       	$this->session->set_flashdata('alert_text',$this->upload->display_errors());

				       		            	

		        		redirect("profile/settings/image");

		        	}else{
		        		$user=$this->session->userdata['user_id'];
		        		$info=htmlspecialchars($this->input->post('info'));

		        		if ($this->register_m->update_info($user,$info)) {
		        			$this->session->set_userdata('short_info',$info);
		        		}

		        		if ($inst=$this->input->post('institution')) {
		        			if ($this->register_m->update_inst($inst)) {
		        				$this->session->set_userdata('institution',$inst);
		        			}
		        		}
		        		
		                redirect("home");
		        	}
		        }
		        else
		        {
		        	$upload_data = $this->upload->data();

			        //resize:

			        $config['image_library'] = 'gd2';
			        $config['source_image'] = $upload_data['full_path'];
			        $config['maintain_ratio'] = TRUE;
			        $config['width']     = 300;
			        $config['height']   = 400;

			        $this->load->library('image_lib', $config); 

			        $this->image_lib->resize();

		        	if($op=="change"){

		        		$this->session->set_flashdata('alert_type','success');
				       	$this->session->set_flashdata('alert_strong','Başarılı');
				       	$this->session->set_flashdata('alert_text','Fotoğrafınız yüklendi. Burada belirmesi zaman alabilir!');

				       	

		        		redirect("profile/settings/image");

		        	}else{
		        		$user=$this->session->userdata['user_id'];
		        		$info=htmlspecialchars($this->input->post('info'));

		        		if ($this->register_m->update_info($user,$info)) {
		        			$this->session->set_userdata('short_info',$info);
		        		}

		        		if ($inst=$this->input->post('institution')) {
		        			if ($this->register_m->update_inst($inst)) {
		        				$this->session->set_userdata('institution',$inst);
		        			}
		        		}
		        		
		                redirect("home");
		        	}

		        }

		        

		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

		
	}


}

