<?php
class DashboardController extends CI_Controller{

    public function check(){
        if(!$this->session->userdata('UserLoginSession')){
            redirect(base_url('login'));
        }
    }
    public function index(){
            $this->check();  
            $this->load->view('base/header');
            $this->load->view('dashboard');
            $this->load->view('base/footer');
    }
    public function logout(){
        $this->check();  
        $this->session->unset_userdata('UserLoginSession');
		redirect(base_url('login'));
    }
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