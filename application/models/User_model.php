<?php
 date_default_timezone_set('Asia/Ho_Chi_Minh');
class User_model  extends CI_Model{
    function getFailedLogin(){
        $query = $this->db->get('failed_log');
        if($query->num_rows()>0){
            return $query->result_array();
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
        $check = $this->db->get_where('failed_log', array('email' => $email))->row();
        if ($check) { 
            //isset account
            $num = $check->counts + 1;
            $data_update=array('time' => date('Y-m-d H:i:s'),'counts' => $num);
            $this->db->where('email', $email);
            $this->db->update('failed_log', $data_update);
        } else {
            //empty account
            $data = array(
                'email' => $email,
                'ip_address' => $ip_address,
                'time' => date('Y-m-d H:i:s'),
                'counts' => 1
            );
            $this->db->insert('failed_log', $data);
        }
    }
   
    function uploadfile_database($data){
        $this->db->insert('images',$data);
    }
}