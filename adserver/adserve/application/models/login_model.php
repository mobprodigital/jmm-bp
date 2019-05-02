<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login_Model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
		
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
}