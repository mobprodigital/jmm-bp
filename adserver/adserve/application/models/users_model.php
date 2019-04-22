<?php

class Users_model extends CI_Model {
	

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	function validate($user_name, $password, $role)
	{
		
		$this->db->select("*");
		$this->db->from('users');
		$this->db->where('username', $user_name);
		$this->db->where('password', $password);
		//$this->db->where('role',$role);
		
		$query 			= $this->db->get();
		$result			= $query->result();
		

 		if(isset($result[0]->username))
		{
			return true;
		}		
	}
	
	function validateuser($user_name, $password)
	{
		$this->db->where('username', $user_name);
		$this->db->where('password', $password);
		$query = $this->db->get('users');
		
		if($query->num_rows == 1)
		{
			return true;
		}		
	}
	
	function getloggedinuser($user_name){
		$this->db->select("user_id ");
		$this->db->from('users');
		$this->db->where('username =', $user_name );
		
		$query 				= $this->db->get();
		$complete			= $query->result();
		return $complete[0]->user_id;
		//echo $this->db->last_query();die;
		/* echo 'sdfaa';
		echo $this->db->last_query();
		echo '<pre>';print_r($complete);die; */

	}
	
	function getroleuser($user_name)
	{
		
		$this->db->select("role");
		$this->db->from('users');
		$this->db->where('username', $user_name );
		
		$query 				= $this->db->get();
		$complete			= $query->result();
		return $complete[0]->role;//echo '<pre>';print_r($complete);die;
	}
	
	///added bys sunil
	function getloggedinusercurrency($user_name)
	{
		
		$this->db->select("currency");
		$this->db->from('users');
		$this->db->where('username =', $user_name );
		
		$query 				= $this->db->get();
		$complete			= $query->result();
		return $complete[0]->currency;//echo '<pre>';print_r($complete);die;
	}
	////end 

    /**
    * Serialize the session data stored in the database, 
    * store it in a new array and return it to the controller 
    * @return array
    */
	function get_db_session_data()
	{
		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); /* array to store the user data we fetch */
		foreach ($query->result() as $row)
		{
		    $udata = unserialize($row->user_data);
		    /* put data in array using username as key */
		    $user['user_name'] = $udata['user_name']; 
		    $user['is_logged_in'] = $udata['is_logged_in']; 
		}
		return $user;
	}
	
	function getuser(){
	  $query = $this->db->get_where('users',array('id'=>1));
	  return $query;        
	}
	 public function updateuser($data) {
    $this->db->where('user_id', 1);
    $this->db->update('users', $data);
}
   
}

