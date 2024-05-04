<?php
class DashboardController extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('UserLoginSession')){ // is Login
            redirect(base_url('login'));
        }
		$this->load->database();
		$this->load->model('UserPermission_model');
    }
   
    public function index(){  
            $this->load->view('base/header');
            $data['datas']=$this->UserPermission_model->getUserPermissions();
            $this->load->view('dashboard',$data);
            $this->load->view('base/footer');
    }
    public function logout(){
        $this->session->unset_userdata('UserLoginSession');
		redirect(base_url('login'));
    }
    //processPermission
    function checkUserPermission($data){
        return $this->UserPermission_model->checkIssetUserPermission($data);
    } 
    public function processPermission(){
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$this->form_validation->set_rules('user','userid','required');
			$this->form_validation->set_rules('permission','permissionid','required');
			$this->form_validation->set_rules('action','action','required');
			if($this->form_validation->run()==TRUE){
                $data=[];
                $userID=$this->input->post('user');
				$permissionID=$this->input->post('permission');
                $action=$this->input->post('action');
                $data['userID']=$userID;
                $data['permissionID']=$permissionID;
                // Grant 
                if($action=="Grant"){
                    //check isset
                    if($this->checkUserPermission($data) == true){
                        $data['message']="Error: User is Granted !!!";
                    }else{
                        if($this->UserPermission_model->insertUserPermission($data)==true){
                            $data['message']=" Granted successfully! ";
                        }else{
                            $data['message']="Error: User permission granted failed!!!";
                        }
                    }
                    echo json_encode($data['message']);

                }else if($action=="Revoke"){ //Revoke
                    if($this->checkUserPermission($data) == false){
                        $data['message']="Error: User has not been granted this permission !!!";
                    }else{
                        if($this->UserPermission_model->revokeUserPermission($data)==true){
                            $data['message']=" Revoked successfully! ";
                        }else{
                            $data['message']="Error: User permission granted failed!!!";
                        }
                    }
                    echo json_encode($data['message']);
                }

                //echo json_encode($data);
            }
        }
    }
      
    //
    public function upload(){
        $this->check();

        $countFiles = count($_FILES['uploadfile']['name']);
        $countUploadedFiles=0;
        $countErrorUploadFiles=0;
        for($i=0 ; $i< $countFiles; $i++){
            $_FILES['uploadfile']['name']=$_FILES['uploadfile']['name'][$i];
            $_FILES['uploadfile']['type']=$_FILES['uploadfile']['type'][$i];
            $_FILES['uploadfile']['size']=$_FILES['uploadfile']['size'][$i];
            $_FILES['uploadfile']['tmp_name']=$_FILES['uploadfile']['tmp_name'][$i];
            $_FILES['uploadfile']['error']=$_FILES['uploadfile']['error'][$i];
        
            $upload_status=$this->uploadFile('uploadfile');
            if($upload_status!=false){
                $countUploadedFiles ++;
                $data= array(
                    'img_path'=>$upload_status,
                    'upload_time'=>date('Y-m-d H:i:s'),
                );
                $this->load->database();
				$this->load->model('User_model');
                $this->User_model->uploadfile_database($data);
            }
            else{
                $countErrorUploadFiles ++;
            }
        }
        $this->session->set_flashdata('message','File Uploaded Successful: '.$countUploadedFiles. 'Error Upload File: '.$countErrorUploadFiles );
        redirect(base_url('dashboard'));
    }
    public function uploadfile($name){
        $this->check();

        $uploadPath='uploads/images/';
        if(!is_dir($uploadPath)){
            mkdir($uploadPath,0777,TRUE);  
        }
        $config['upload_path']= $uploadPath;
        $config['allowed_types']= 'jpeg|JPEG|JPG|jpg|png|PNG';
        $config['encrypt_name']= TRUE;

        $this->load->library('upload',$config);
        $this->upload->initialize($config);
        if($this->upload->do_upload($name)){
            $fileData= $this->upload->data();
            return $fileData['file_name'];
        }
        else{
            return false;
        }
    }
}