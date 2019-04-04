<?php 	

defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ALL ^ E_DEPRECATED);

class Login extends CI_Controller{
 protected $var1,$var2;
    function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Kolkata');
		header("Access-Control-Allow-Origin: *");
		$this->load->database();
		$this->load->helper('form','url');
		$this->load->model('Login_Model');
	
	}
	function registration(){
		$data['cat']			= 'inventory';
		$data['activeaction']	= 'viewuser';
		$this->load->view('login/registration', $data);	
	}
	
	
	/**
    * check the username and the password with the database
    * @return void
    */
	function validateUser(){
		//echo '<pre>';print_r($_POST);die;
		if(isset($_POST['submit'])){
			$userName 		= $this->input->post('email');
			$password 		= $this->input->post('password');
			$result 		= $this->Login_Model->validate($userName, $password);
			$data			= array();
			//echo '<pre>';print_r($result);die;
			if($result['validate']){
				$role	= $result['data']->role;
				$uid	= $result['data']->user_id;
				$data = array(
						'username' => $userName,
						'uid' => $uid,
						'role'=> $role,
						'type' => 'user',
						'is_logged_in' => true,
				);
				//echo '<pre>';print_r($data);die;
				$this->session->set_userdata($data);
				if($role == 1){
					redirect('admin');

				}else if($role == 2){
					redirect("advertiser/");

				}else if($role == 3){
					redirect('publisher/');
				}
				
				
			}else {
				$data['msg'] = 'not valid credential';
				
				//echo '<pre>';print_r($data);die;
			}
		}
		$this->load->view('publisher/login', $data);
	}
	
	
	function advertiserSignup(){
		if(isset($_POST['submit'])){
			//echo '<pre>';print_r($_POST);die;
			$input['username']	= $this->input->post('email');
			$input['password']	= $this->input->post('password');
			$input['firstname']	= $this->input->post('firstname');
			$input['lastname']	= $this->input->post('lastname');
			$input['skype']		= $this->input->post('skype');
			$input['phone']		= $this->input->post('phone');
			$input['role']		= 2;
			$input['date_created']	= date('Y-m-d');
			$input['date_updated']	= date('Y-m-d');
	
			$result 			= $this->Advertiser_Model->saveAdvertiser($input);
			$data['msg']		= $result;
			redirect('publisher/index');	
		}
		//echo '<pre>';print_r($data);die;

		$this->load->view('advertiser/signup', $data);	
	}
		
		
	
	
	function advertiserLogin(){
		$this->load->view('advertiser/login');	
	}
	
	function advertiserLogout(){
		$this->session->sess_destroy();
		redirect('advertiser/login');
	}
	
	function publisherSignup(){
		$data['cat']			= 'inventory';
		$data['activeaction']	= 'viewuser';
		if(isset($_POST['submit'])){
			//echo '<pre>';print_r($_POST);die;
			$input['username']	= $this->input->post('email');
			$input['password']	= $this->input->post('password');
			$input['firstname']	= $this->input->post('firstname');
			$input['lastname']	= $this->input->post('lastname');
			$input['skype']		= $this->input->post('skype');
			$input['phone']		= $this->input->post('phone');
			$input['role']		= 3;
			$input['date_created']	= date('Y-m-d');
			$input['date_updated']	= date('Y-m-d');
			$result 			= $this->Login_Model->savePublisher($input);
			redirect('publisher/index');	

		}else{
			$this->load->view('publisher/signup', $data);
		}
	}
	
	function publisherLogin(){
		$this->load->view('publisher/login');	
	}
	
	function publisherLogout(){
		$this->session->sess_destroy();
		redirect('publisher/login');
	}
	
	
	 /**
    * check the username and the password with the database
    * @return void
    */
	function validate_credentials(){
	
		$this->load->model('Users_model');
		//echo $this->input->post('user_name');
		//die;
		$user_name 		= $this->input->post('user_name');
		$password 		= $this->input->post('password');

		$is_valid 		= $this->Users_model->validate($user_name, $password, 'admin');
		//print_r($is_valid);
		//die;
		
		if($is_valid){
			
			/* Load Notification Model */

			$this->load->model('Notification_Model');
			$data['get_under_dlvr_campaigns'] = array();
			$data['get_active_campaigns'] = array();
			$data['get_expired_campaigns'] = array();

			$data['get_under_dlvr_campaigns']= $this->Notification_Model->get_under_dlvr_campaigns();
			$data['get_active_campaigns']= $this->Notification_Model->get_active_campaigns();
			$data['get_expired_campaigns']= $this->Notification_Model->get_expired_campaigns();
			if(empty($data['get_under_dlvr_campaigns'])) { $data['get_under_dlvr_campaigns'] = array(); }
			if(empty($data['get_active_campaigns'])) { $data['get_active_campaigns'] = array(); }
			if(empty($data['get_expired_campaigns'])) { $data['get_expired_campaigns'] = array(); }
			$data['my_array'] = array_merge($data['get_under_dlvr_campaigns'],$data['get_active_campaigns'],$data['get_expired_campaigns']);
			
			
			//print_r($data['my_array']);
			//die;
			
			/* Ends */
			
			//get id of logged in user
				$uid		= $this->Users_model->getloggedinuser($user_name);
			//get role of logged in user
				$role		= $this->Users_model->getroleuser($user_name);
			$data = array(
				'username' 	=> $user_name,
				'uid' 		=> $uid	,
				'role'		=> $role,
				'notification_array' => $data['my_array'],
				'is_logged_in' => true
			);
			$count = count($data['notification_array']);
			$data1 = array("countNotifications"=>$count);

			//print_r($data);
			//die;

			ini_set('session.gc_maxlifetime', 7200);
			session_set_cookie_params(7200);

			//echo '<pre>';print_r($data);die;
			$this->session->set_userdata(array_merge($data,$data1));
			//print_r($this->session->userdata('countNotifications')); 
			//die;
			redirect('admin/dashboard');
			
			// incorrect username or password 
		}else {
		
			
			$is_validuser = $this->Users_model->validateuser($user_name, $password);
			if($is_validuser){
				//get id of logged in user
				$uid=$this->Users_model->getloggedinuser($user_name);
				//get role of logged in user
				$role=$this->Users_model->getroleuser($user_name);
				$data = array(
					'username' => $user_name,
					'uid' => $uid,
					'role'=> $role,
					'type' => 'user',
					'is_logged_in' => true,
					'is_userlogged_in' => true
				);
				$this->session->set_userdata($data);
				redirect($user_name.'/dashboard');
			}else{
				$is_validmanager = $this->Users_model->validate($user_name, $password, 'manager');
				if($is_validmanager){
					$data = array(
						'username' => $user_name,
						'type' 	=> 'manager',
						'is_logged_in' => true,
						'is_managerlogged_in' => true
					);
					
					$this->session->set_userdata($data);
					redirect($user_name.'/dashboard');
				}else{
			
					$data['message_error'] = TRUE;
					$this->load->view('admin/login', $data);
				}
			}
		}
	}
}	

	
?>