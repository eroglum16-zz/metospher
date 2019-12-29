<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register_m extends CI_Model{

	public function __construct()
        {
            $this->load->database();
        }

    public function get_categories(){
        $query = $this->db->get('Categories');

        return $query->result_array();
    }

    public function get_lessons(){
        //$this->db->group_by('lesson_category');
        $query = $this->db->get('Lessons');

        return $query->result_array();
    }

    public function set_teach_batch($batch){
        return $this->db->insert_batch('Teach', $batch);
    }

    public function set_teach($data){
        return $this->db->insert('Teach', $data);
    }

    public function set_learn_batch($batch){
        return $this->db->insert_batch('Learn', $batch);
    }

    public function set_learn($data){
        return $this->db->insert('Learn', $data);
    }

    public function update_info($user, $info){
        $this->db->set('short_info', $info);
        $this->db->where('user_id', $user);
        return $this->db->update('Users');
    }

    public function update_inst($inst){
        $this->db->set('institution', $inst);
        $this->db->where('user_id', $this->session->userdata['user_id']);
        return $this->db->update('Users');
    }



}

?>