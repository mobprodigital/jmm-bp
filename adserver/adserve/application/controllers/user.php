<?php
	error_reporting(E_ALL ^ E_DEPRECATED);

class User extends CI_Controller {


    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page ff
    * @return void
    */	
	function index(){
		
		$data['cat']			= 'inventory';
		$data['activeaction']	= 'viewuser';
		if($this->session->userdata('is_logged_in')){
			redirect('admin/dashboard', $data);
        }else{
        	$this->load->view('admin/login', $data);	
        }
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
			

			$data['get_under_dlvr_campaigns']= $this->Notification_Model->get_under_dlvr_campaigns();
			$data['get_active_campaigns']= $this->Notification_Model->get_active_campaigns();
			
			if(empty($data['get_under_dlvr_campaigns'])) { $data['get_under_dlvr_campaigns'] = array(); }
			if(empty($data['get_active_campaigns'])) { $data['get_active_campaigns'] = array(); }
			
			$data['my_array'] = array_merge($data['get_under_dlvr_campaigns'],$data['get_active_campaigns']);
			
			
			//print_r($data['my_array']);
			//die;
			
			/* Ends */
			
			//get id of logged in user
$currency	= $this->Users_model->getloggedinusercurrency($user_name);
				$uid		= $this->Users_model->getloggedinuser($user_name);
			//get role of logged in user
				$role		= $this->Users_model->getroleuser($user_name);
			$data = array(
				'username' 	=> $user_name,
				'uid' 		=> $uid	,
'currency'		=> $currency,
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

			//echo '<pre>';print_r($data);
			$this->session->set_userdata(array_merge($data,$data1));
			
			//print_r($this->session->userdata('countNotifications')); 
			//die;
			//redirect('admin/dashboard');
			redirect('users/dashboard/home');
			
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

    
	
	/**
    * Destroy the session, and logout the user.
    * @return void
    */		
	function logout()
	{
		
		$this->session->sess_destroy();
		redirect('admin');
	}

}