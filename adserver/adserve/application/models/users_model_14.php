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
		$this->db->where('username', $user_name);
		$this->db->where('password', $password);
		$this->db->where('role',$role);
		$query = $this->db->get('users');
		
		if($query->num_rows == 1)
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
	
	function getloggedinuser($user_name)
	{
		$sql="select id from users where username='".$user_name."'";
		$res=mysql_query($sql);
		$row=mysql_fetch_array($res);
		return $row['id'];
	}
	
	function getroleuser($user_name)
	{
		$sql="select role from users where username='".$user_name."'";
		$res=mysql_query($sql);
		$row=mysql_fetch_array($res);
		return $row['role'];
	}

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
    $this->db->where('id', 1);
    $this->db->update('users', $data);
}
   
}

