<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Login_Model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
		
	}
	
	function validate($userName, $password){
		$this->db->select("*");
		$this->db->from('users');
		$this->db->where('username', $userName);
		$this->db->where('password', $password);
		$query 						= $this->db->get();
		$result					= $query->row();
		
		if(!empty($result)){
			return array("validate"=>true, "data"=>$result);
		}else{
			return array("validate"=>false);
		}
	}
	
	function saveAdvertiser($input){
		$this->db->insert('users', $input);
		$data['msg']	= 'advertiser added successfully';
		return $data;
	}
	
	function savePublisher($input){
		$this->db->insert('users', $input);
		$data['msg']	= 'publisher added successfully';
		return $data;
	}
}