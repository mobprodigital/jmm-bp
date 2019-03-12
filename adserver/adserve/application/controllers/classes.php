<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name Home.php
 * @author Imron Rosdiana
 */
class Classes extends CI_Controller
{
 protected $var1,$var2;
    function __construct() {
        parent::__construct();
		
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
		//// hello
		$this->load->database();
		$this->load->helper('form','url');
		$this->load->model('Classes_Model');
		$this->load->model('Courses_Model');
    }
 	//load Page Listing Page
    public function index() {
		$this->load->view('admin_includes/header');
		$this->load->view('admin_includes/left_sidebar');
		
        $this->load->view('admin/classes/index');   
		$this->load->view('admin_includes/footer');
    }
	
	 function json_get_classes() {
		
		$data=$this->Classes_Model->fetchclasses();
        echo json_encode($data);
 }
 
 function json_check_course_unique(){
	 $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $title = $request->title;
		$data= $this->Courses_Model->checkcoursunique($title);
		if($data==1)
		echo 'Duplicate';
		else
		echo 'Unique';
	 
 }
 

	//Load Add new page
	public function create(){
		$this->load->library('form_validation');
     	$this->form_validation->set_rules('title', 'Title', 'required|trim');
		$this->load->view('admin_includes/header');
		$this->load->view('admin_includes/left_sidebar');
		$data['courses']=$this->Courses_Model->fetchcourses();
		
        $this->load->view('admin/classes/add',$data);
		$this->load->view('admin_includes/footer');
		
		 if($this->form_validation->run() == TRUE){
		 // Here you will get data from angular ajax request in json format so you have to decode that json data you will get object array in $request variable
	  $data=array();
	  $data['title']=$_REQUEST['title'];
	  $data['courseid'] = $_REQUEST['courseid'];
      $data['status'] = $_REQUEST['status'];
	
      $id = $this->Classes_Model->AddClass($data);
      if($id)
      {
         $this->session->set_flashdata('success_msg', ' <div class="text-success">Class has been inserted, please add some time slots now..</div>');
	redirect($this->session->userdata('username').'/classes/edit/'.$id);
      }else{
        $this->session->set_flashdata('error_msg', ' Class has not inserted, please try again..');
      }
		 }
	}
	
	
	
	//edit page
	public function edit($id=0){	
	
		
		//fetch data in variable $data	   
		//view template for editing content
		$this->load->library('form_validation');
     	$this->form_validation->set_rules('title', 'Title', 'required|trim');
		
		 
		
		$this->load->view('admin_includes/header');
		$this->load->view('admin_includes/left_sidebar');
		$id=$this->uri->segment(4);
		$query=$this->Classes_Model->getdataedit($id);
		
		$data['id']['value'] = $query['id'];
		$data['title']['value']=$query['title'];
		$data['courseid']['value']=$query['courseid'];
		$data['status']['value']=$query['status'];
		$data['courses']=$this->Courses_Model->fetchcourses();
		
		//get slots
		$data['queryslot']=$this->Classes_Model->getslots($id);
		
        $this->load->view('admin/classes/edit',$data);
		$this->load->view('admin_includes/footer');
		 //update data in database
		if ($this->input->post('submit')) {
		  if($this->form_validation->run() == TRUE){ //check for title field is not empty
		   $data=array();
	  
	 	 $data['title']=$_REQUEST['title'];
	  $data['courseid'] = $_REQUEST['courseid'];
      $data['status'] = $_REQUEST['status'];
	  $gid=$_REQUEST['id'];
	  
	  //add edit slots
	  $slotdate=$_REQUEST['slotdate'];
	  $slotids=$_REQUEST['slotid'];
	  $classids=$_REQUEST['classid'];
	  $fromtime=$_REQUEST['fromtime'];
	  $totime=$_REQUEST['totime'];
	   $slotstatus=$_REQUEST['slotstatus'];
	  $countslots=count($slotdate);
	  for($i=1;$i<$countslots;$i++)
	  {
		  $slotdata['weekday'] = date('l', strtotime($slotdate[$i]));
		 $slotdata['weekdate']=$slotdate[$i];
		 $slotdata['fromtime']=$fromtime[$i];
		 $slotdata['totime']=$totime[$i];
		 $slotdata['status']=$slotstatus[$i];
		 $slotdata['classid']=$classids[$i];
		 $slotid=$slotids[$i]; 
		 if($slotid=='' && $slotdata['weekdate']!='')
		 $this->Classes_Model->AddSlot($slotdata);
		 else
		 $this->Classes_Model->EditSlot($slotid,$slotdata);
	  }
	 
      if($this->Classes_Model->updateclass($gid,$data))
      {
		  
        $this->session->set_flashdata('success_msg', ' <div class="text-success">Class details has been updated.</div>');
		redirect($this->session->userdata('username').'/classes/edit/'.$id);
      }else{
         $this->session->set_flashdata('error_msg', ' There is any issue, please try again.');
      }
		  }
		}
		
		
		
	}
	
	
 
 
	
	 /**
    * Delete product by his id
    * @return void
    */
    public function json_del_class()
    {
        $postdata = file_get_contents("php://input");
      	$request = json_decode($postdata);
      	$id = $request->id;
        $this->Classes_Model->remove_item($id);
		
    }//edit
	
	public function deleteslot($id=0){
	$id=$this->uri->segment(5);
	$cid=$this->uri->segment(3);
	$this->Classes_Model->remove_slotitem($id);
	$this->session->set_flashdata('success_msg', ' <div class="text-success">Time slot has been deleted.</div>');
	redirect($this->session->userdata('username').'/classes/edit/'.$cid);
	}
 
}
?>