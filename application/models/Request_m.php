<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Request_m extends CI_Model{

	public function __construct()
        {
            $this->load->database();
        }


    public function create_request($request){

        $query=$this->db->get_where('Requests',array('req_from' => $request['req_from'] , 'req_to' => $request['req_to'] ));
        $result=$query->result_array();
        if (isset($result)) {
            foreach ($result as $r) {
                $this->db->set('Requests.is_active', 0);
                $this->db->where('req_id', $r['req_id']);
                $this->db->update('Requests');
            }
        }

        $query=$this->db->get_where('Requests',array('req_to' => $request['req_from'] , 'req_from' => $request['req_to'] ));
        $result=$query->result_array();
        if (isset($result)) {
            foreach ($result as $r) {
                $this->db->set('Requests.is_active', 0);
                $this->db->where('req_id', $r['req_id']);
                $this->db->update('Requests');
            }
        }

        return $this->db->insert('Requests', $request);

    }

    public function get_requests(){
        $this->db->select('*');
        $this->db->from('Requests');
        $this->db->join('Users', 'Requests.req_from = Users.user_id');
        $this->db->join('Districts', 'Users.district = Districts.district_no');
        $this->db->join('Cities', 'Districts.city_no = Cities.city_no');
        $this->db->where('req_to' , $this->session->userdata['user_id']);
        $this->db->where('is_accepted' , 0);
        $this->db->where('Requests.is_active' , 1);
        $query= $this->db->get();
        $requests = $query->result_array();
        return $requests;
    }

    public function get_accepted_requests(){
        $this->db->select('*');
        $this->db->from('Requests');
        $this->db->join('Users', 'Requests.req_from = Users.user_id');
        $this->db->join('Districts', 'Users.district = Districts.district_no');
        $this->db->join('Cities', 'Districts.city_no = Cities.city_no');
        $this->db->where('req_to' , $this->session->userdata['user_id']);
        $this->db->where('is_accepted' , 1);
        $this->db->where('Requests.is_active' , 1);
        $query= $this->db->get();
        $requests = $query->result_array();
        return $requests;
    }

    public function get_sent_requests(){
        $this->db->select('*');
        $this->db->from('Requests');
        $this->db->join('Users', 'Requests.req_to = Users.user_id');
        $this->db->join('Districts', 'Users.district = Districts.district_no');
        $this->db->join('Cities', 'Districts.city_no = Cities.city_no');
        $this->db->where('req_from' , $this->session->userdata['user_id']);
        $this->db->where('is_accepted' , 0);
        $this->db->where('Requests.is_active' , 1);
        $query= $this->db->get();
        $requests = $query->result_array();
        return $requests;
    }

    public function get_sent_accepted_requests(){
        $this->db->select('*');
        $this->db->from('Requests');
        $this->db->join('Users', 'Requests.req_to = Users.user_id');
        $this->db->join('Districts', 'Users.district = Districts.district_no');
        $this->db->join('Cities', 'Districts.city_no = Cities.city_no');
        $this->db->where('req_from' , $this->session->userdata['user_id']);
        $this->db->where('is_accepted' , 1);
        $this->db->where('Requests.is_active' , 1);
        $query= $this->db->get();
        $requests = $query->result_array();
        return $requests;
    }



    public function get_specific_request($id){
        $this->db->select('*');
        $this->db->from('Requests');
        $this->db->join('Users', 'Requests.req_from = Users.user_id');
        $this->db->join('Districts', 'Users.district = Districts.district_no');
        $this->db->join('Cities', 'Districts.city_no = Cities.city_no');
        $this->db->where('req_from' , $id);
        $this->db->where('req_to' , $this->session->userdata['user_id']);
        $this->db->where('is_accepted' , 1);
        $this->db->where('Requests.is_active' , 1);
        $query= $this->db->get();
        $requests = $query->result_array();
        return $requests;
    }

    public function get_teaches_by_id($id){

        $query = $this->db->get_where('Learn', array('student' => $this->session->userdata['user_id']));
        $my_learns=$query->result_array();

        $my_learns_single=array();
        foreach ($my_learns as $my_learn) {
            array_push($my_learns_single, $my_learn['lesson']);
        }

        $this->db->select('*');
        $this->db->from('Teach');

        $this->db->join('Lessons', 'Teach.lesson = Lessons.lesson_id');

        $this->db->where('teacher' , $id);
         if(!empty($my_learns_single)) $this->db->where_not_in('lesson', $my_learns_single);

        $query= $this->db->get();
        $teaches = $query->result_array();

        $teaches_string="";
        foreach ($teaches as $teach) {
            if ($teaches_string=="") {
                $teaches_string=$teach['lesson_name'];
            }else{
                $teaches_string=$teach['lesson_name'].", ".$teaches_string;
            }
        }
        

        $this->db->select('*');
        $this->db->from('Teach');

        $this->db->join('Lessons', 'Teach.lesson = Lessons.lesson_id');

        $this->db->where('teacher' , $id);
        if(!empty($my_learns_single)) $this->db->where_in('lesson', $my_learns_single);
        
        $query= $this->db->get();
        $teaches = $query->result_array();

        foreach ($teaches as $teach) {
            if ($teaches_string=="") {
                $teaches_string="<i>".$teach['lesson_name']."</i>";
                $flag=true;
            }else{
                $teaches_string="<i>".$teach['lesson_name']."</i>, ".$teaches_string;
            }
        }

        return $teaches_string;
    }

    public function get_learns_by_id($id){
        $query = $this->db->get_where('Teach', array('teacher' => $this->session->userdata['user_id']));
        $my_teaches=$query->result_array();

        $my_teaches_single=array();
        foreach ($my_teaches as $my_teach) {
            array_push($my_teaches_single, $my_teach['lesson']);
        }

        $this->db->select('*');
        $this->db->from('Learn');

        $this->db->join('Lessons', 'Learn.lesson = Lessons.lesson_id');
        if(!empty($my_teaches_single)) $this->db->where_not_in('lesson', $my_teaches_single);
        $this->db->where('student' , $id);
        $query= $this->db->get();
        $learns = $query->result_array();

        $learns_string="";
        foreach ($learns as $learn) {
            if ($learns_string=="") {
                $learns_string=$learn['lesson_name'];
            }else{
                $learns_string=$learn['lesson_name'].", ".$learns_string;
            }
        }

        $this->db->select('*');
        $this->db->from('Learn');

        $this->db->join('Lessons', 'Learn.lesson = Lessons.lesson_id');
        if(!empty($my_teaches_single)) $this->db->where_in('lesson', $my_teaches_single);
        $this->db->where('student' , $id);
        $query= $this->db->get();
        $learns = $query->result_array();

        foreach ($learns as $learn) {
            if ($learns_string=="") {
                $learns_string="<i>".$learn['lesson_name']."</i>";
            }else{
                $learns_string="<i>".$learn['lesson_name']."</i>, ".$learns_string;
            }
        }
        return $learns_string;
    }

    public function accept_request($request){
        $this->db->set('is_accepted', 1);
        $this->db->where('req_id', $request);
        return $this->db->update('Requests');
    }

    public function send_message($message){
        return $this->db->insert('Messages', $message);
    }

    public function get_messages($req){
        $this->db->order_by('msg_time');
        $query = $this->db->get_where('Messages', array('msg_req' => $req));
        return $query->result_array();
    }

    public function set_seen($req){
        $this->db->set('is_seen', 1);
        $this->db->where('msg_req', $req);
        $this->db->where('msg_to', $this->session->userdata['user_id']);
        return $this->db->update('Messages');
    }

    public function get_unseen_number($req="all"){
         $this->db->select('*');
        $this->db->from('Messages');
        $this->db->join('Requests', 'Messages.msg_req = Requests.req_id');
        
        $this->db->where('is_seen' , 0);
        if ($req!="all") {
            $this->db->where('msg_req' , $req);
        }
        $this->db->where('msg_to', $this->session->userdata['user_id']);
        $this->db->where('is_active', 1);
        $query=$this->db->get();

        return count($query->result_array());

    }

    public function decline_request($request){
        $this->db->set('is_active', 0);
        $this->db->where('req_id', $request);
        return $this->db->update('Requests');
    }

    public function decline_request_by_user($user_id){
        $this->db->set('is_active', 0);
        $this->db->where(array('req_from'=>$user_id, 'req_to'=>$this->session->userdata['user_id']));
        $this->db->update('Requests');
            
        
        $this->db->set('is_active', 0);
        $this->db->where(array('req_to'=>$user_id, 'req_from'=>$this->session->userdata['user_id']));
        return $this->db->update('Requests');
        

        
    }

    public function get_user_by_id($id){
        $query = $this->db->get_where('Users', array('user_id' => $id));
        return $query->row_array();
    }

    //Search functions

    public function get_all_usernames(){
        $this->db->select('name');
        $this->db->select('surname');
        $this->db->from('Users');
        $this->db->where('is_active',1);
        $query = $this->db->get();
        $users = $query->result_array();

        $usernames=array();
        foreach ($users as $user) {            
            $name_pair=$user['name']. " " . $user['surname'];
            array_push($usernames, $name_pair );
        }

        return $usernames;
    }

    public function search($search_string){

        $search_string = trim($search_string);
        
        if ($search_string=="") {
            return null;
        }

        if ($search_string=="ZIfi89S3") {
            $search_string="";
        }

        $words_searched = explode(" ", $search_string);
        
        $query = $this->db->get_where('Learn', array('student' => $this->session->userdata['user_id']));
        $my_learns=$query->result_array();
        

        $my_learns_single=array();
        foreach ($my_learns as $my_learn) {
            array_push($my_learns_single, $my_learn['lesson']);
        }

        $query = $this->db->get_where('Teach', array('teacher' => $this->session->userdata['user_id']));
        
        
        $my_teaches=$query->result_array();

        $my_teaches_single=array();
        foreach ($my_teaches as $my_teach) {
            array_push($my_teaches_single, $my_teach['lesson']);
        }

        $my_matches=array();
        foreach ($words_searched as $word_searched) {

            $index=count($words_searched)-1;

            $this->db->select('*');
            $this->db->from('Users');
            $this->db->join('Districts', 'Users.district = Districts.district_no');
            $this->db->join('Cities', 'Districts.city_no = Cities.city_no');
            $this->db->where('is_active',1);
            $this->db->like('name', $words_searched[0]);
            $this->db->like('surname', $words_searched[$index]);
            $query= $this->db->get();
            $results=$query->result_array();

            if (count($results)==0) {
                $this->db->select('*');
                $this->db->from('Users');
                $this->db->join('Districts', 'Users.district = Districts.district_no');
                $this->db->join('Cities', 'Districts.city_no = Cities.city_no');
                $this->db->where('is_active',1);
                $this->db->like('name', $word_searched);
                $this->db->or_like('surname', $word_searched);
                $query= $this->db->get();
                $results=$query->result_array();
            }


            foreach ($results as $result) {
                $my_match['user_info'] = $result;

                if (!isset($my_match['user_info']['user_id'])) {
                    continue;
                }

                $other_user=$my_match['user_info']['user_id'];
                $this_user=$this->session->userdata['user_id'];
                
                $query=$this->db->get_where('Blocks',array('blocker' => $other_user  ,  'blocked' => $this_user ));
                if ($query->row_array()['block_active']==1) {
                    unset($my_match['user_info']);
                    continue;
                }

                $query=$this->db->get_where('Blocks',array('blocked' => $other_user  ,  'blocker' => $this_user ));
                if ($query->row_array()['block_active']==1) {
                    unset($my_match['user_info']);
                    continue;
                }

                $break=false;
                foreach ($my_matches as $mm) {
                    if ($my_match['user_info']['user_id']==$mm['user_info']['user_id']) {
                        $break=true;
                        break;
                    }
                }if ($break) {
                    continue;
                }

                if($this->session->userdata['user_id']==$my_match['user_info']['user_id']) continue;

                $this->db->select('*');
                $this->db->from('Teach');
                $this->db->join('Lessons', 'Teach.lesson = Lessons.lesson_id');
                $this->db->where('teacher' , $my_match['user_info']['user_id'] );
                if(!empty($my_learns_single)) $this->db->where_not_in('lesson', $my_learns_single);
                $query= $this->db->get();
                $can_teach = $query->result_array();

                $my_match['teaches']=array();
                foreach ($can_teach as $ct) {
                    array_push($my_match['teaches'], $ct['lesson_name']);
                }

                $this->db->select('*');
                $this->db->from('Teach');
                $this->db->join('Lessons', 'Teach.lesson = Lessons.lesson_id');
                $this->db->where('teacher' , $my_match['user_info']['user_id']);
                if(!empty($my_learns_single)) $this->db->where_in('lesson', $my_learns_single);
                $query= $this->db->get();
                $can_teach_me = $query->result_array();

                $my_match['teaches_me']=array();
                foreach ($can_teach_me as $ct) {
                    array_push($my_match['teaches_me'], $ct['lesson_name']);
                }

                $this->db->select('*');
                $this->db->from('Learn');
                $this->db->join('Lessons', 'Learn.lesson = Lessons.lesson_id');
                $this->db->where('student' , $my_match['user_info']['user_id']);
                if(count($my_teaches_single)>0) $this->db->where_not_in('lesson', $my_teaches_single);
                $query= $this->db->get();
                $wanna_learn = $query->result_array();

                $my_match['learns']=array();
                foreach ($wanna_learn as $wl) {
                    array_push($my_match['learns'], $wl['lesson_name']);
                }

                $this->db->select('*');
                $this->db->from('Learn');
                $this->db->join('Lessons', 'Learn.lesson = Lessons.lesson_id');
                $this->db->where('student' , $my_match['user_info']['user_id']);
                if(!empty($my_learns_single)) $this->db->where_in('lesson', $my_teaches_single);
                $query= $this->db->get();
                $learn_from_me = $query->result_array();

                $my_match['learns_from_me']=array();
                foreach ($learn_from_me as $lfm) {
                    array_push($my_match['learns_from_me'], $lfm['lesson_name']);
                }

                array_push($my_matches, $my_match);
            }
            
        }



        
        return $my_matches;

    }

    public function report_user($complaint){
        return $this->db->insert('Complaints', $complaint);
    }

    public function block_user($blocked){

        $this_user=$this->session->userdata['user_id'];

        $query=$this->db->get_where('Blocks', array('blocker' => $this_user, 'blocked' => $blocked ));
        $result=$query->row_array();

        if (isset($result)&&$result['block_active']==0) {
            $this->db->set('block_active', 1);
            $this->db->where('block_id', $result['block_id']);
            return $this->db->update('Blocks');
        }else{
            $block['blocker']=$this_user;
            $block['blocked']=$blocked;
            
            return $this->db->insert('Blocks', $block);
        }
        
    }

    public function lift_block($block_id){
        $this->db->set('block_active', 0);
        $this->db->where('block_id', $block_id);
        return $this->db->update('Blocks');
    }

    //Check if a request exists sent to or received from the other side, return request id
    public function detect_interaction($other_side){ 
        $this_user=$this->session->userdata['user_id'];

        $query=$this->db->get_where('Requests',array('req_from' => $this_user, 'req_to' => $other_side, 'is_active' => 1));
        $result=$query->row_array();

        if (null != $result) {
            return $result['req_id'];
        }else{
            $query=$this->db->get_where('Requests',array('req_to' => $this_user, 'req_from' => $other_side, 'is_active' => 1));
            $result=$query->row_array();

            if (null != $result) {
                return $result['req_id'];
            }else return false;
        }
    }

    public function freeze_requests(){
        $this_user=$this->session->userdata['user_id'];

        $this->db->set('is_active', 0);
        $this->db->set('request_frozen', 1);
        $this->db->where(array('req_from' => $this_user, 'is_active' => 1 ));
        $this->db->update('Requests');

        $this->db->set('is_active', 0);
        $this->db->set('request_frozen', 1);
        $this->db->where(array('req_to' => $this_user, 'is_active' => 1 ));
        return $this->db->update('Requests');
    }

    public function unfreeze_requests(){
        $this_user=$this->session->userdata['user_id'];
        
        $this->db->set('is_active', 1);
        $this->db->set('request_frozen', 0);
        $this->db->where(array('req_from' => $this_user, 'request_frozen' => 1 ));
        $this->db->update('Requests');

        $this->db->set('is_active', 1);
        $this->db->set('request_frozen', 0);
        $this->db->where(array('req_to' => $this_user, 'request_frozen' => 1 ));
        return $this->db->update('Requests');
    }


}

?>