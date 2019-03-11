<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Courses_Model extends CI_Model {
  
  private $table = 'courses';
  
  function __construct() 
  {
    /* Call the Model constructor */
    parent::__construct();
	$this->load->database();
  }
  
  function fetchcourses()
  {
	if($this->session->userdata('role')=='teacher')
    $query=mysql_query("select * from courses where teachers  LIKE '%".$this->session->userdata('uid').",%' OR teachers LIKE '%,".$this->session->userdata('uid')."%' OR teachers='".$this->session->userdata('uid')."'");
	else
	$query=mysql_query("select * from courses");
	//$query = $this->db->get('courses');
    $return = array();
	$i=0;
    //foreach ($query->result() as $course)
	while($course=mysql_fetch_array($query))
    {
		//check for assigned teacher
		if($this->session->userdata('role')=='teacher')
		{
		$tlist=array();
		$teach=explode(',',$course['teachers']);
		$i=0;
		foreach($teach as $t)
		{
		$tlist[$i]=$t;	
		$i++;
		}
		
		if (!in_array($this->session->userdata('uid'), $tlist))
		{
			continue;
		}
		}
		//check for assigned teacher
		
		
		$groups='';
		$return[$i]['id']=$course['id'];
		$return[$i]['title']=ucfirst($course['title']);
		$return[$i]['short_desc']=ucfirst($course['short_desc']);
		$return[$i]['duration']=ucfirst($course['duration']);
		$return[$i]['price']=ucfirst($course['price']);
		$return[$i]['status']=$course['status']==1?'Active':'Inactive';
		
		
		$i++;
    }
	

    return $return;
  }
  
  function checkcourseunique($str)
  {
	  $return='';
	$sql=mysql_query('select * from courses where title="'.$str.'"' );
	$numrow=mysql_num_rows($sql);
	return $numrow;
	if($numrow>0)
	{
		$return='Duplicate';
	}
	else
	{
		$return='Unique';
	}
	return $return;
  }
  
  
  
  
   public function AddCourse($data)
 {
	 
  $this->db->insert('courses',$data);
  $insert_id = $this->db->insert_id();
  return $insert_id;
 }
 
 function getdataedit($id){
 $query = $this->db->get_where('courses',array('id'=>$id));
 return $query->row_array();  
 }
 
  public function updatecourse($id, $data) {
    $this->db->where('id', $id);
    $this->db->update('courses', $data);
	}
	
	function remove_item($itemid)
  {
	//Delete Parent record
    $this->db->delete('courses', array('id' => $itemid));
	
  }
}