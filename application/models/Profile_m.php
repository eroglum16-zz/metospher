<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_m extends CI_Model{

	public function __construct()
        {
            $this->load->database();
        }

    public function update_info($info_text){

        $this->db->where('user_id', $this->session->userdata['user_id']);
        $this->db->set('short_info', $info_text);
        return $this->db->update('Users');

    }

    public function update_password($old_password, $new_password){

        $user_id=$this->session->userdata['user_id'];

        $query=$this->db->get_where('Users', array('user_id' => $user_id , 'password' => md5($old_password) ) );

        $verified_user=$query->row_array();


        if (isset($verified_user)) {
            $this->db->where('user_id', $this->session->userdata['user_id']);
            $this->db->set('password', md5($new_password));
            return $this->db->update('Users');
        }else{
            return false;
        }

    }

    public function update_name($name, $surname){
        $this->db->where('user_id', $this->session->userdata['user_id']);
        $this->db->set('name', $name);
        $op1= $this->db->update('Users');

        if ($op1) {
            $this->db->where('user_id', $this->session->userdata['user_id']);
            $this->db->set('surname', $surname);
            return $this->db->update('Users');
        }else return false;

    }

    public function update_birthdate($birthdate){
        $this->db->where('user_id', $this->session->userdata['user_id']);
        $this->db->set('birthdate', $birthdate);
        return $this->db->update('Users');

    }

    public function update_gender($gender){
        $this->db->where('user_id', $this->session->userdata['user_id']);
        $this->db->set('gender', $gender);
        return $this->db->update('Users');

    }

    public function update_institution($institution){
        $this->db->where('user_id', $this->session->userdata['user_id']);
        $this->db->set('institution', $institution);
        return $this->db->update('Users');

    }

    public function update_district($district_no){
        $this->db->where('user_id', $this->session->userdata['user_id']);
        $this->db->set('district', $district_no);
        return $this->db->update('Users');
    }

    public function get_my_teaches(){

        $this->db->select('*');
        $this->db->from('Teach');
        $this->db->join('Lessons', 'Teach.lesson = Lessons.lesson_id');
        $this->db->where('teacher' , $this->session->userdata['user_id']);
        $query= $this->db->get();
        return $query->result_array();

    }

    public function get_my_learns(){

        $this->db->select('*');
        $this->db->from('Learn');
        $this->db->join('Lessons', 'Learn.lesson = Lessons.lesson_id');
        $this->db->where('student' , $this->session->userdata['user_id']);
        $query= $this->db->get();
        return $query->result_array();

    }

    public function get_lessons_to_teach(){
        $my_teaches_result = $this->get_my_teaches();

        $my_teaches= array();

        foreach ($my_teaches_result as $my_teach) {
            array_push($my_teaches, $my_teach['lesson']);
        }
        if (!empty($my_teaches)) $this->db->where_not_in('lesson_id', $my_teaches);
        
        
        $query = $this->db->get('Lessons');

        return $query->result_array();
    }

    public function delete_my_teach($lesson_id){

        $teacher=$this->session->userdata['user_id'];
        return $this->db->delete('Teach', array('teacher' => $teacher, 'lesson' => $lesson_id));

    }

    public function get_lessons_to_learn(){
        $my_learns_result = $this->get_my_learns();

        $my_learns= array();

        foreach ($my_learns_result as $my_learn) {
            array_push($my_learns, $my_learn['lesson']);
        }

        if (!empty($my_learns)) $this->db->where_not_in('lesson_id', $my_learns);
        $query = $this->db->get('Lessons');

        return $query->result_array();
    }

    public function delete_my_learn($lesson_id){

        $student=$this->session->userdata['user_id'];
        return $this->db->delete('Learn', array('student' => $student, 'lesson' => $lesson_id));

    }

    public function city_name_by_district($district){
        $query=$this->db->get_where('Districts', array('district_no' => $district));
        $city=$query->row_array()['city_no'];

        $query=$this->db->get_where('Cities', array('city_no' => $city));
        return $query->row_array()['city_name'];

    }

    public function district_name_by_id($id){
        $query=$this->db->get_where('Districts', array('district_no' => $id));
        return $query->row_array()['district_name'];
    }

    public function save_contact($contact){
        return $this->db->insert('Contacts', $contact);
    }

    public function check_password($password){

        $user_id=$this->session->userdata['user_id'];
        $pass=md5($password);

        $query=$this->db->get_where('Users', array('user_id' => $user_id, 'password' => $pass));
        $verified_user=$query->row_array();

        if (isset($verified_user)) {
            return true;
        }else return false;

    }

    public function freeze_user($contact){

        $this->db->insert('Contacts', $contact);

        $this->db->where('user_id', $this->session->userdata['user_id']);
        $this->db->set('is_frozen', 1);
        $this->db->set('is_active', 0);
        return $this->db->update('Users');

    }

    public function get_blocks(){

        $this->db->select('*');
        $this->db->from('Blocks');
        $this->db->join('Users', 'Blocks.blocked = Users.user_id');
        $this->db->where('blocker' , $this->session->userdata['user_id']);
        $this->db->where('block_active' , 1);
        $query= $this->db->get();
        return $query->result_array();

    }




}

?>