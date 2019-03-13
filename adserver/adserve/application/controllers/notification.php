<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//error_reporting(E_ALL ^ E_DEPRECATED);

class Notification extends CI_Controller{
	
    function __construct() {
		parent::__construct();
		 
		 
		/*  if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
        } */
		
		date_default_timezone_set('Asia/Kolkata');
		header("Access-Control-Allow-Origin: *");
		$this->load->database();
		$this->load->helper('form','url');
		$this->load->model('User_Model');
		$this->load->model('Notification_Model');
	}
	
	function get_all_notifications()
	{   
		if(!$this->session->userdata('is_logged_in')){
            redirect('admin');
		}
		//$data['all_notifications'] = $this->session->userdata('notification_array');
		$data['get_under_dlvr_campaigns']= $this->Notification_Model->get_under_dlvr_campaigns();
		$data['get_active_campaigns']= $this->Notification_Model->get_active_campaigns();
		$data['get_expired_campaigns']= $this->Notification_Model->get_expired_campaigns();
		$data['get_upcoming_campaigns']= $this->Notification_Model->get_upcoming_campaigns();
		$data['get_pause_campaigns']= $this->Notification_Model->get_pause_campaigns();

		if(empty($data['get_under_dlvr_campaigns'])) { $data['get_under_dlvr_campaigns'] = array(); }
		if(empty($data['get_active_campaigns'])) { $data['get_active_campaigns'] = array(); }
		if(empty($data['get_expired_campaigns'])) { $data['get_expired_campaigns'] = array(); }
		if(empty($data['get_upcoming_campaigns'])) { $data['get_upcoming_campaigns'] = array(); }
		if(empty($data['get_pause_campaigns'])) { $data['get_pause_campaigns'] = array(); }

		$data['my_array'] = array_merge($data['get_under_dlvr_campaigns'],$data['get_active_campaigns'],$data['get_expired_campaigns'],$data['get_upcoming_campaigns'],$data['get_pause_campaigns']);
		
		//print_r($data['my_array']);
		//die;
		 
		$data['cat']			= 'inventory';
		$data['users']			= $this->User_Model->fetchusers();
		$data['activeaction']	= 'notification';

		//echo '<pre>';print_r($data['banner']);die;
		$this->load->view('admin_includes/header', $data);
		$this->load->view('admin_includes/left_sidebar',		$data);
		$this->load->view("admin/viewNotifications",	$data);


		
	}
	
	
	
	
	
	
	
	
	
}
?>