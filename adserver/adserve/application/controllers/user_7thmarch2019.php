<?php
	error_reporting(E_ALL ^ E_DEPRECATED);

class User extends CI_Controller {


    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
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
		$user_name 		= $this->input->post('user_name');
		$password 		= $this->input->post('password');

		$is_valid 		= $this->Users_model->validate($user_name, $password, 'admin');
		
		
		if($is_valid){
			//get id of logged in user
				$uid		= $this->Users_model->getloggedinuser($user_name);
			//get role of logged in user
				$role		= $this->Users_model->getroleuser($user_name);
			$data = array(
				'username' 	=> $user_name,
				'uid' 		=> $uid	,
				'role'		=> $role,
				'is_logged_in' => true
			);
			ini_set('session.gc_maxlifetime', 7200);
			session_set_cookie_params(7200);

			//echo '<pre>';print_r($data);die;
			$this->session->set_userdata($data);
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