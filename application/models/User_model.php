<?php

class User_model  extends CI_Model{
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
    function uploadfile_database($data){
        $this->db->insert('images',$data);
    }
}