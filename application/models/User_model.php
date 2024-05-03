<?php
 date_default_timezone_set('Asia/Ho_Chi_Minh');
class User_model  extends CI_Model{
    function getFailedLogin(){
        $this->db->select('failed_log.email, failed_log.ip_address, MAX(failed_log.time) as max_time, users.username, COUNT(*) as count');
        $this->db->from('failed_log');
        $this->db->join('users', 'users.email = failed_log.email', 'left');
        $this->db->group_by('failed_log.email');
        $this->db->having('count >=', 1);
        $query = $this->db->get();
        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return false;
        }
    }
    function checkUser($email){
        $check = $this->db->get_where('users', array('email' => $email))->row();
        if($check){
            return true;
        }else{
            return false;
        }
    }
    function insertUser($data){
        $this->db->insert('users',$data);
    }
    function checkLogin($data){
       $query= $this->db->where('email',$data['email'])->where('password',$data['password'])->get('users');
        if($query->num_rows()>0){
            return $query->row_array();
        }else{
            return false;
        }
    }
    // Write log login failed
    public function log_failed_login($email, $ip_address) {
            $data = array(
                'email' => $email,
                'ip_address' => $ip_address,
                'time' => date('Y-m-d H:i:s'),
                'counts' => 1
            );
            $this->db->insert('failed_log', $data);
        }
   
    function uploadfile_database($data){
        $this->db->insert('images',$data);
    }
}