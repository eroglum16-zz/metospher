<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
        $this->load->model('home_m');
        $this->load->model('login_m');
        
    }

	public function index()
	{

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {
				
				$data['active']="home";
				$data['title']="- Anasayfa";

				$data['already_requested']=$this->home_m->get_already_requested();


				if ($this->session->flashdata('request_sent')) {
					$data['alert_type']="success";
					$data['alert_strong']="İstek gönderildi!";
					$data['alert_text']="İsteğiniz karşı tarafa iletildi. Kabul edilmesi durumunda konuşmanız başlayacaktır. Takip etmek için <a href='".site_url('request')."'>tıklayın</a>.";
				}

				if ($this->session->flashdata('request_failed')) {
					$data['alert_type']="danger";
					$data['alert_strong']="İstek gönderilemedi!";
					$data['alert_text']="İsteğiniz karşı tarafa iletilirken bir problem oluştu.";
				}

				if ($this->session->flashdata('alert_text')) {
					$data['alert_type']="danger";
					$data['alert_strong']="İstek gönderilemedi!";
					$data['alert_text']="İsteğiniz karşı tarafa iletilirken bir problem oluştu.";
				}

				if ($this->session->flashdata('password_updated')) {
					$data['alert_type']="success";
					$data['alert_strong']="Tekrar hoşgeldiniz!";
					$data['alert_text']="Şifrenizi başarıyla güncellediniz.";
				}

				if ($this->session->flashdata('complaint_sent')) {
					$data['alert_type']="success";
					$data['alert_strong']="Teşekkürler!";
					$data['alert_text']="Kişiyle ilgili şikayetiniz bize iletilmiştir. En kısa zamanda değerlendirip gerekeni yapacağız.";
				}
				
				
				$data['not_found']="Eşleşme ihtimalini arttırmak için şehir, ilçe ya da ders bilgilerinizi güncelleyebilirsiniz.";

				$data['selected_district']='not_matters'; 
				$data['selected_city']=$this->login_m->get_city_by_district($this->session->userdata['district']);
				$data['selected_lesson']='all';

				$data['cities']=$this->login_m->get_cities();
				$data['mylearns']=$this->home_m->get_mylearns();
				$data['matches']=$this->home_m->bring_matches($data['selected_city'],$data['selected_district'],'all');
				

				$this->load->view('header',$data);
				$this->load->view('home_view');
				$this->load->view('footer');

		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}
	}


	public function options($city=34, $district='not_matters', $lesson='all'){

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {
		  		
				$data['active']="home";
				$data['title']="- Anasayfa";
				$data['cities']=$this->login_m->get_cities();
				$data['mylearns']=$this->home_m->get_mylearns();
				$data['already_requested']=$this->home_m->get_already_requested();

				

				if($this->input->post('district')||$this->input->post('city')){
					$data['selected_city']=$this->input->post('city');
					$data['selected_district']=$this->input->post('district');
					$data['selected_lesson']=$lesson;
					$data['not_found']="Eşleşme ihtimalini arttırmak için şehir, ilçe bilgilerinizi güncelleyebilirsiniz.!";
				}else{
					$data['selected_city']=$city;
					$data['selected_district']=$district;
					$data['selected_lesson']=$lesson;
					$data['not_found']="Başka ders seçerek aramayı deneyebilirsiniz.";
				}
				$data['matches']=$this->home_m->bring_matches($data['selected_city'],$data['selected_district'],$data['selected_lesson']);


				$this->load->view('header',$data);
				$this->load->view('home_view');
				$this->load->view('footer');

		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}

		
	}

	public function search()
	{

		if ($this->session->has_userdata('logged_in')) {    
		  	if ($this->session->userdata['logged_in']) {
				
				$search_string=$this->input->get('user');

				$data['active']="home";
				$data['title']="- Arama";

				$data['already_requested']=$this->home_m->get_already_requested();

				$data['selected_district']=$this->session->userdata['district'];
				$data['selected_city']=$this->login_m->get_city_by_district($data['selected_district']);
				$data['selected_lesson']='all';

				$data['not_found']="Arama yaptığınız kelimelere uygun bir kullanıcı bulunamadı.";

				$data['search_page']=true;

				$data['cities']=$this->login_m->get_cities();
				$data['mylearns']=$this->home_m->get_mylearns();

				$data['matches']=$this->request_m->search($search_string);
				

				$this->load->view('header',$data);
				$this->load->view('home_view');
				$this->load->view('footer');

		  	}else{
		  		redirect("login");
		  	}
		}else{
	  		redirect("login");
	  	}
	}

	public function report_user($complainee){
		$complaint['complainer']=$this->session->userdata['user_id'];
		$complaint['complainee']=$complainee;
		$complaint['ct_text']=$this->input->post('ct_text');

		if ($this->input->post('block')) {
			$block_checked=$this->input->post('block');
		}

		if ($this->request_m->report_user($complaint)) {
			if ($block_checked=='1') {
				if ($this->request_m->block_user($complainee)) {
					$req_id=$this->request_m->detect_interaction($complainee);
					$this->request_m->decline_request($req_id);
				}
			}
			$this->session->set_flashdata('complaint_sent',true);
		}
		redirect('request');
	}

	public function ZIfi89S3(){
		if ($this->session->has_userdata('logged_in')==false) {
			redirect('home');
		}
		if ($this->session->userdata['logged_in']==false) {
			redirect('home');
		}
		if ($this->session->userdata['email']!='m.eroglu5122@gmail.com' && $this->session->userdata['email']!='aydin26532@gmail.com') {
			redirect('home');
		}
		$data['active']="home";
		$data['title']="- Anasayfa";

		$data['contacts']=$this->home_m->get_contact_inbox();

		$this->load->view('header', $data);
		$this->load->view('contact_list');
		$this->load->view('footer');
	}


}
