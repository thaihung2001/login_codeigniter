<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct() {
        parent::__construct();
		$this->load->database();
		$this->load->model('User_model');
    }
	public function index()
	{
		//$this->load->view('welcome_message');
		$this->load->view('base/header');
		$this->load->view('register');
		$this->load->view('base/footer');
	}
	public function login_page(){
		$this->load->view('base/header');
		$this->load->view('login');
		$this->load->view('base/footer');
	}
	public function authentication(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$this->form_validation->set_rules('email','Email','trim|required');
			$this->form_validation->set_rules('password','PassWord','trim|required');
			if($this->form_validation->run()==TRUE){
				$email=$this->input->post('email');
				$pass=$this->input->post('password');
				$pass=md5($pass);
				$data=array(
					'email'=> $email,
					'password' => $pass,
				);
				$status= $this->User_model->checkLogin($data);
				if ($status) {
					$session_data=array(
						'username'=> $status['username'],
						'email_user'=> $status['email'],
					);
					$this->session->set_userdata('UserLoginSession',$session_data);
					echo json_encode(array("status" => true, "message" =>"Đúng thông tin"));
				} else {
					// Write log
					$ip_address = $this->input->ip_address();
					$this->User_model->log_failed_login($email, $ip_address);
					echo json_encode(array("status" => false, "message" =>" Sai username or password"));
				}
			}
		}
	}
	public function registerNow(){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$this->form_validation->set_rules('username','User Name','required');
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required');

			if($this->form_validation->run()==TRUE){
				$username=$this->input->post('username');
				$email= $this->input->post('email');
				$pass=$this->input->post('password');
				$pass=md5($pass);
				$data= array(
					'username' => $username,
					'email' => $email,
					'password' => $pass,
					'status' =>'1'
				);
				//var_dump($data);die();
				$this->User_model->insertUser($data);
				$this->session->set_flashdata('success','Successfully User Register');
				redirect(base_url('register'));
			}
		}
	}
	
}
