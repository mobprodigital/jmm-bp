<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login_Model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
		
	}
	
	function getClientID($uid){
		$this->db->select("clientid");
		$this->db->from('client_access');
		$this->db->where('userid', $uid);
		
		$query 					= $this->db->get();
		$result					= $query->row();
		
		/* echo '<pre>';print_r($result);
		echo $this->db->last_query();die;  */
		if(!empty($result)){
			return $result->clientid;
		}else{
			return null;
		}
	}
	
/********************start of County iso code ******************** */
	function getCountryCode(){
		$this->db->select("`countries_id`,`countries_name`,`countries_iso_code`,`countries_isd_code`");
		$this->db->from('countries');
		$query 					= $this->db->get();
		$result					= $query->result_array();
		return $result;
		//echo '<pre>';print_r($result); 
		 //echo $this->db->last_query();die;

	}
	function getFlagVal($isd_code){
		$this->db->select("`countries_id`, `countries_name`, `countries_iso_code`, `countries_isd_code`");
		$this->db->from('countries');
		$this->db->where('countries_iso_code', $isd_code);
		$query 					= $this->db->get();
		$results					= $query->result_array();
		
		if (count($results) > 0 ) {
			$arr = array(
				"c_id" => $results[0]["countries_id"],
				"c_name" => $results[0]["countries_name"],
				"c_iso" => strtolower($results[0]["countries_iso_code"]),
				"c_isd" => $results[0]["countries_isd_code"],
			);
		}
		return $arr;
	}

		/********************end of County iso code ******************** */

	
	function validate($userName, $password, $loginID){
		$this->db->select("*");
		$this->db->from('users');
		$this->db->where('username', $userName);
		$this->db->where('password', $password);
		$this->db->where('role', 	$loginID);
		$query 					= $this->db->get();
		$result					= $query->row();
		//echo '<pre>';print_r($result);
		//echo $this->db->last_query();die;
		
		if(!empty($result)){
			return array("validate"=>true, "data"=>$result);
		}else{
			return array("validate"=>false);
		}
	}
	
	function saveAdvertiser($input){
		$this->db->insert('users', $input);
		$msg	= 'advertiser added successfully';
		return $msg;
	}
	
	function savePublisher($input){
		$this->db->insert('users', $input);
		//echo $this->db->last_query();die;
		$data['msg']	= 'publisher added successfully';
		return $data;
	}

	function checkPublisher($input)
	{
		$email = $input['username'];
		$mobile = $input['phone'];
		$role = $input['role'];

		$this->db->select("*");
		$this->db->from('users');
		$this->db->where('username', $email);
		$this->db->where('phone', $mobile);
		$this->db->where('role', 	$role);
		$query 					= $this->db->get();
		$result					= $query->row();
		//echo '<pre>';print_r($result);
		//echo $this->db->last_query();die;
		
		if(!empty($result)){
			return array("duplicate"=>'1');
		}else{
			return array("duplicate"=>'0');
		}

	}

	function checkAdvertiser($input)
	{
		$email = $input['username'];
		$mobile = $input['phone'];
		$role = $input['role'];

		$this->db->select("*");
		$this->db->from('users');
		$this->db->where('username', $email);
		$this->db->where('phone', $mobile);
		$this->db->where('role', 	$role);
		$query 					= $this->db->get();
		$result					= $query->row();
		//echo '<pre>';print_r($result);
		//echo $this->db->last_query();die;
		
		if(!empty($result)){
			return array("duplicate"=>'1');
		}else{
			return array("duplicate"=>'0');
		}

	}

	function send_email($email,$msg,$subject) 
	{
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'mail.onetracky.com',
			'smtp_port' => 25,
			'smtp_user' => 'support@onetracky.com', // change it to yours
			'smtp_pass' => 'Q1w2@Jmm@123', // change it to yours
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		); 
		 
	    $from_email = "support@onetracky.com";
		$to_email = $email;
      
		$this->load->library('email');
        $this->email->initialize($config);
		$this->email->set_newline("\r\n");
		
		$this->email->from($from_email, 'Onetracky');
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($msg);
        //Send mail
		if($this->email->send())
		{
			//echo "email Send";
			//$this->session->set_flashdata("email_sent","Congragulation Email Send Successfully.");
		}
		else
		{
			//echo "email not send";
			//show_error($this->email->print_debugger());
			//$this->session->set_flashdata("email_sent","You have encountered an error");
			//$this->load->view('contact_email_form');
		}
  	}
	
	function forgotPassword($email,$pass,$loginType){
		$this->db->select("*");
		$this->db->from('users');
		$this->db->where('username', $email);
		$this->db->where('role', $loginType);
		$query 					    = $this->db->get();
		//echo $this->db->last_query(); die;
		$results					= $query->result_array();
		//print_r($results[0]['user_id']); die;
		if(count($results)>0){
			 $query 				= $this->db->query("update users set password ='$pass' where user_id = '$results[0][user_id]'");
		}
		return $results;
	} 
}