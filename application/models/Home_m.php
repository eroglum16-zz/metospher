<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_m extends CI_Model{

	public function __construct()
        {
            $this->load->database();
        }


    public function bring_matches($city='not_matters', $district='not_matters', $lesson='all'){

        if($lesson=='all'){
            $query = $this->db->get_where('Learn', array('student' => $this->session->userdata['user_id']));
        }/*elseif($lesson=='everybody'){
            $query = $this->db->get('Learn');
        }*/else{
            $query = $this->db->get_where('Learn', array('student' => $this->session->userdata['user_id'], 'lesson' => $lesson));
        }
        $my_learns=$query->result_array();

        

        $my_learns_single=array();
        foreach ($my_learns as $my_learn) {
            array_push($my_learns_single, $my_learn['lesson']);
        }

        $my_teachers=array(); 
        foreach ($my_learns as $my_learn) {
            $query = $this->db->get_where('Teach', array('lesson' => $my_learn['lesson']));
            $teachers = $query->result_array();
            foreach ($teachers as $teacher) {
                array_push($my_teachers, $teacher);
            }
        }

        /*if ($lesson=='everybody') {
            $query = $this->db->get('Teach');
        }else{*/
            $query = $this->db->get_where('Teach', array('teacher' => $this->session->userdata['user_id']));
        #}
        
        $my_teaches=$query->result_array();

        $my_teaches_single=array();
        foreach ($my_teaches as $my_teach) {
            array_push($my_teaches_single, $my_teach['lesson']);
        }

        $my_students=array(); 
        foreach ($my_teaches as $my_teach) {
            $query = $this->db->get_where('Learn', array('lesson' => $my_teach['lesson']));
            $students = $query->result_array();
            foreach ($students as $student) {
                array_push($my_students, $student);
            }
        }


        $matches=array();
        foreach ($my_students as $my_student) {
            foreach ($my_teachers as $my_teacher) {
                if ($my_teacher['teacher']==$my_student['student']&&in_array($my_teacher['teacher'], $matches)==false) {
                    array_push($matches, $my_teacher['teacher']);
                }
            }
        }

        $my_matches=array();
        foreach ($matches as $match) {

            if($this->session->userdata['user_id']==$match) continue;            

            $this->db->select('*');
            $this->db->from('Users');
            $this->db->join('Districts', 'Users.district = Districts.district_no');
            $this->db->join('Cities', 'Districts.city_no = Cities.city_no');
            $this->db->where(array('user_id' => $match));
            $query= $this->db->get();
            $my_match['user_info'] = $query->row_array();

            
            if($city!='not_matters'){
                if($my_match['user_info']['city_no']!= $city) continue;
            }

            if ($district!='not_matters') {
                if($my_match['user_info']['district']!= $district) continue;
            }

            $other_user=$my_match['user_info']['user_id'];
            $this_user=$this->session->userdata['user_id'];
            
            $query=$this->db->get_where('Blocks', array('blocker' => $other_user  ,  'blocked' => $this_user ));
            if ($query->row_array()['block_active']==1) {
                continue;
            }

            $query=$this->db->get_where('Blocks', array('blocked' => $other_user  ,  'blocker' => $this_user ));
            if ($query->row_array()['block_active']==1) {
                continue;
            }

            

            //=$this->db->get_where('Users', array('user_id' => $match))->row_array();

            $this->db->select('*');
            $this->db->from('Teach');
            $this->db->join('Lessons', 'Teach.lesson = Lessons.lesson_id');
            $this->db->where('teacher' , $match );
            $this->db->where_in('lesson', $my_learns_single);
            $query= $this->db->get();
            $can_teach_me = $query->result_array();

            $my_match['teaches_me']=array();
            foreach ($can_teach_me as $ct) {
                array_push($my_match['teaches_me'], $ct['lesson_name']);
            }

            $this->db->select('*');
            $this->db->from('Teach');
            $this->db->join('Lessons', 'Teach.lesson = Lessons.lesson_id');
            $this->db->where('teacher' , $match );
            $this->db->where_not_in('lesson', $my_learns_single);
            $query= $this->db->get();
            $can_teach = $query->result_array();

            $my_match['teaches']=array();
            foreach ($can_teach as $ct) {
                array_push($my_match['teaches'], $ct['lesson_name']);
            }

            $this->db->select('*');
            $this->db->from('Learn');
            $this->db->join('Lessons', 'Learn.lesson = Lessons.lesson_id');
            $this->db->where('student' , $match);
            $this->db->where_not_in('lesson', $my_teaches_single);
            $query= $this->db->get();
            $wanna_learn = $query->result_array();

            $my_match['learns']=array();
            foreach ($wanna_learn as $wl) {
                array_push($my_match['learns'], $wl['lesson_name']);
            }


            $this->db->select('*');
            $this->db->from('Learn');
            $this->db->join('Lessons', 'Learn.lesson = Lessons.lesson_id');
            $this->db->where('student' , $match);
            $this->db->where_in('lesson', $my_teaches_single);
            $query= $this->db->get();
            $learn_from_me = $query->result_array();

            $my_match['learns_from_me']=array();
            foreach ($learn_from_me as $lfm) {
                array_push($my_match['learns_from_me'], $lfm['lesson_name']);
            }

            array_push($my_matches, $my_match);
            
        }

        return $my_matches;
        

    }

    public function get_mylearns(){

        $this->db->select('*');
        $this->db->from('Learn');
        $this->db->join('Lessons', 'Learn.lesson = Lessons.lesson_id');
        $this->db->where('student' , $this->session->userdata['user_id']);
        $query= $this->db->get();
        return $query->result_array();

    }

    public function get_already_requested(){

        $query = $this->db->get_where('Requests', array('req_from' => $this->session->userdata['user_id'], 'is_active' => 1));

        $rows = $query->result_array();

        $already_requested = array();

        foreach ($rows as $row) {
            array_push($already_requested, $row['req_to']);
        }

        $query = $this->db->get_where('Requests', array('req_to' => $this->session->userdata['user_id'],'is_active' => 1));

        $rows = $query->result_array();

        foreach ($rows as $row) {
            array_push($already_requested, $row['req_from']);
        }

        return $already_requested;

    }

    public function get_contact_inbox(){
        $this->db->order_by('contact_time','DESC');
        $query = $this->db->get('contacts');
        return $query->result_array();
    }

    public function get_id_by_email($email){
        $query = $this->db->get_where('Users', array('email' => $email));
        return $query->row_array()['user_id'];
    }

}

?>