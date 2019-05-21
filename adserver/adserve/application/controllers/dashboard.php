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
        $this->load->model('Home_Model');
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
    }
 
    public function index() {
		$data['cat']				='home';
        $data['activeaction']		='home';
        $data['date']['start'] =date('Y-m-d');
        $data['date']['end']   = date('Y-m-d');
        $date1 = $data['date']['start'];  
        $date2 = $data['date']['end'];
        $data['chart_data']         =  $this->Home_Model->getchartres($date1,$date2,'hour');
        $data['home_chart']         =  $this->Home_Model->getres($date1,$date2);
		$this->load->view('admin_includes/header',$data);
		$this->load->view('admin_includes/left_sidebar',$data);
        $this->load->view('admin/home',$data);
		//$this->load->view('admin/dashboard',$data);
		//$this->load->view('admin_includes/footer',$data);
    }
 
    public function logout() {
		$data=array('id_user' , 'username');
        $this->session->unset_userdata($data);
 
        redirect('admin/login');
    }
}
?>