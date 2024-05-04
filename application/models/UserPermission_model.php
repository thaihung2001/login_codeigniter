<?php
class UserPermission_model  extends CI_Model{
    function getPermission(){
        $query = $this->db->get('permissions');
        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return false;
        }
    }
    function checkIssetUserPermission($data){
        $query= $this->db->where('userID',$data['userID'])->where('permissionID',$data['permissionID'])->get('userpermissions');
        if($query->num_rows() > 0){
            return true;
        } else {
            return false;
        }
    }
    function insertUserPermission($data){
        $success=$this->db->insert('userpermissions',$data);
        if ($success) {
            return true;
        } else {
            return false;
        }
    }
    function revokeUserPermission($data){
        $result= $this->db->where('userID',$data['userID'])->where('permissionID',$data['permissionID'])->delete('userpermissions');
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    function getUserPermissions(){
        $query = $this->db->query("SELECT Users.userID, Users.username, Users.email, Permissions.permissionID, Permissions.PermissionName 
                                   FROM Users
                                   JOIN UserPermissions ON Users.UserID = UserPermissions.UserID
                                    JOIN Permissions ON UserPermissions.PermissionID = Permissions.PermissionID");
        if($query->num_rows() > 0){
            return $query->result_array();
        } else {
            return false;
        }
    }
}