<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
/**
 * @name Home.php
 * @author Imron Rosdiana
 */
class Courses extends CI_Controller
{
 protected $var1,$var2;
    function __construct() {
        parent::__construct();
		
        if(!$this->session->userdata('is_logged_in')){
            redirect('admin/login');
        }
		
		$this->load->database();
		$this->load->helper('form','url');
		$this->load->model('Courses_Model');
    }
 	//load Page Listing Page
    public function index() {
		$this->load->view('admin_includes/header');
		$this->load->view('admin_includes/left_sidebar');
		
        $this->load->view('admin/courses/index');   
		$this->load->view('admin_includes/footer');
    }
	
	 function json_get_courses() {
		
		$data=$this->Courses_Model->fetchcourses();
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
		
		$this->load->view('admin_includes/header');
		$this->load->view('admin_includes/left_sidebar');
		
        $this->load->view('admin/courses/add');
		$this->load->view('admin_includes/footer');
	}
	
	
	public function json_add_course()
 	{
    // Here you will get data from angular ajax request in json format so you have to decode that json data you will get object array in $request variable
 
      $postdata = file_get_contents("php://input");
      $request = json_decode($postdata);
	  $data=array();
	  $teacherlist='';
	  $teachers=$request->teachers;
	  for($i=0;$i<count($teachers);$i++)
	  {
		$teacherlist .= $teachers[$i].',';  
	  }
	  
	  $data['title']=$request->title;
	  $data['short_desc'] = $request->short_desc;
	  $data['description'] = $request->description;
	  $data['duration'] = $request->fromduration.' - '.$request->toduration;
	  $data['price'] = $request->price;
	  $data['teachers'] = trim($teacherlist,',');
      $data['status'] = $request->status;
	
      $id = $this->Courses_Model->AddCourse($data);
      if($id)
      {
         echo $result = '{"status" : "success"}';
      }else{
         echo $result = '{"status" : "failure"}';
      }
    }
	//edit page
	public function edit($id=0){		
		//fetch data in variable $data	   
		//view template for editing content
		$this->load->view('admin_includes/header');
		$this->load->view('admin_includes/left_sidebar');
		$query=$this->Courses_Model->getdataedit($id);
		
        $this->load->view('admin/courses/edit');
		$this->load->view('admin_includes/footer');
		 
		
	}
	
	function json_get_coursebyid() {
	$postdata = file_get_contents("php://input");
      $request = json_decode($postdata);
      $id = $request->id;
	  $data=$this->Courses_Model->getdataedit($id);
        echo json_encode($data);
 }
 
 
	public function json_edit_course()
 {
   // Here you will get data from angular ajax request in json format so you have to decode that json data you will get object array in $request variable
 
      $postdata = file_get_contents("php://input");
      $request = json_decode($postdata);
      $data=array();
	  
	 $data['title']=$request->title;
	  $data['short_desc'] = $request->short_desc;
	  $data['description'] = $request->description;
	  $data['duration'] = $request->fromduration.' - '.$request->toduration;
	  $data['price'] = $request->price;
      $data['status'] = $request->status;
	  $teacherlist='';
	  $teachers=$request->teachers;
	  for($i=0;$i<count($teachers);$i++)
	  {
		$teacherlist .= $teachers[$i].',';  
	  }
	   $data['teachers'] = trim($teacherlist,',');
	  $gid=$request->id;
	  
     
      if($this->Courses_Model->updatecourse($gid,$data))
      {
         echo $result = '{"status" : "success"}';
      }else{
         echo $result = '{"status" : "failure"}';
      }
    }
	 /**
    * Delete product by his id
    * @return void
    */
    public function json_del_course()
    {
        $postdata = file_get_contents("php://input");
      	$request = json_decode($postdata);
      	$id = $request->id;
        $this->Courses_Model->remove_item($id);
		
    }//edit
 
}
?>