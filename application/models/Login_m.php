<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model{

	public function __construct()
        {
            $this->load->database();
        }

    public function check_user($email, $pass){
    	$query = $this->db->get_where('Users', array('email' => $email, 'password' => md5($pass)), 1);
    	$result = $query->row_array();

    	if (isset($result))
		{
            if ($result['is_active']==0 && $result['is_frozen']==1) {
                $this->db->where('user_id', $result['user_id']);
                $this->db->set('is_frozen', 0);
                $this->db->set('is_active', 1);
                if ($this->db->update('Users')) {
                    $result['is_frozen']=0;
                    $result['is_active']=1;
                    $result['after_frozen']=1;
                }
            }
			return $result;
		}else{
			return false;
		}
    }

    public function check_hash($id, $hash){
        $query = $this->db->get_where('Users', array('user_id' => $id, 'hash' => $hash));
        $result = $query->row_array();

        if (isset($result))
        {
            return $result;
        }else{
            return false;
        }
    }

    
    public function new_password($pr){
        return $this->db->insert('PasswordRequests', $pr);
    }

    public function check_temp_password($user_id, $hash){
        $query = $this->db->get_where('Users', array('user_id' => $user_id));
        $email = $query->row_array()['email'];

        if (!isset($email)) {
            return false;
        }

        $query = $this->db->get_where('PasswordRequests', array('pr_email' => $email, 'pr_hash'));
        return $query->row_array();
    }

    public function update_temp_password($user_id, $temp_password , $new_password){

        $query = $this->db->get_where('Users', array('user_id' => $user_id));
        $email = $query->row_array()['email'];

        if (!isset($email)) {
            return false;
        }

        $query=$this->db->get_where('PasswordRequests', array('pr_email' => $email , 'pr_hash' => $temp_password ) );
        $user=$query->row_array();

        if (isset($user)) {
            $this->db->where('email', $user['pr_email']);
            $this->db->set('password', md5($new_password));
            if ($this->db->update('Users')) {
                $query=$this->db->get_where('Users', array('email' => $user['pr_email'] ) );
                return $query->row_array();
            }else return false;
        }else{
            false;
        }

    }    

    public function email_exists($email){
        $query = $this->db->get_where('Users', array('email' => $email));
        $result = $query->row_array();

        if (isset($result)&&is_array($result)) {
            return $result;
        }else return false;
    }

    public function register_user($new_user){


    	$query = $this->db->get_where('Users', array('email' => $new_user['email']), 1);
    	$result = $query->row_array();

    	if(count($result)>0){
    		return false;
    	}else{
    		$this->db->insert('Users', $new_user);
            return $this->db->get_where('Users', array('email' => $new_user['email']))->row_array();
    	}
    	
    }

    public function activate_user($user_id){
        $this->db->set('is_active', 1);
        $this->db->where('user_id', $user_id);
        return $this->db->update('Users');
    }

    public function get_cities(){
        return $this->db->get('Cities')->result_array();
    }

    public function get_district_by_city($city_no){
        return $this->db->get_where('Districts', array('city_no'=>$city_no))->result_array();
    }

    public function get_city_by_district($district){
        return $this->db->get_where('Districts', array('district_no'=>$district))->row_array()['city_no'];
    }

    public function save_contact($contact){
        return $this->db->insert('Contacts', $contact);
    }


}

?>