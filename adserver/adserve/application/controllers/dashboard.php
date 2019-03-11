<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name Home.php
 * @author Imron Rosdiana
 */
class Dashboard extends CI_Controller
{
 
    function __construct() {
        parent::__construct();
		
		$this->load->helper('html');//this is for html tags like link_tags
		$this->load->library('javascript');//this is for script tags 
 
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
 
    public function index() {
		$data['cat']				='home';
		$data['activeaction']		='home';
		$this->load->view('admin_includes/header',$data);
		$this->load->view('admin_includes/left_sidebar',$data);
        $this->load->view('admin/home',$data);
		//$this->load->view('admin/dashboard',$data);
		$this->load->view('admin_includes/footer',$data);
    }
 
    public function logout() {
		$data=array('id_user' , 'username');
        $this->session->unset_userdata($data);
 
        redirect('admin/login');
    }
}
?>