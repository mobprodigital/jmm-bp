<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Classes_Model extends CI_Model {
  
  private $table = 'classes';
  
  function __construct() 
  {
    /* Call the Model constructor */
    parent::__construct();
	$this->load->database();
  }
  
  function fetchclasses()
  {
	if($this->session->userdata('role')=='teacher')
	{
		
    $query=mysql_query("select * from classes where courseid in(select id from courses where teachers  LIKE '%".$this->session->userdata('uid').",%' OR teachers LIKE '%,".$this->session->userdata('uid')."%' OR teachers='".$this->session->userdata('uid')."')");
	}
	else
	$query=mysql_query("select * from classes");
	//$query = $this->db->get('courses');
    $return = array();
	$i=0;
    //foreach ($query->result() as $course)
	while($class=mysql_fetch_array($query))
    {
		
		
		//course title
		$coursequery=mysql_query("select title from courses where id=".$class['courseid']);
		$courserow=mysql_fetch_array($coursequery);
		
		$groups='';
		$return[$i]['id']=$class['id'];
		$return[$i]['title']=ucfirst($class['title']);
		$return[$i]['courseid']=ucfirst($courserow['title']);
		
		$return[$i]['status']=$class['status']==1?'Active':'Inactive';
		
		
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
  
  
  
  
   public function AddClass($data)
 {
	 
  $this->db->insert('classes',$data);
  $insert_id = $this->db->insert_id();
  return $insert_id;
 }
 
 function getdataedit($id){
 $query = $this->db->get_where('classes',array('id'=>$id));
 return $query->row_array();  
 }
 
  public function updateclass($id, $data) {
    $this->db->where('id', $id);
    $this->db->update('classes', $data);
	return true;
	}
	
	function getslots($id){
 $query = $this->db->get_where('classes_meta',array('classid'=>$id));
 $return = array();
	$i=0;
    foreach ($query->result() as $class)
	//while($class=mysql_fetch_array($query))
    {
	
		$return[$i]['id']=$class->id;
		$return[$i]['classid']=$class->classid;
		$return[$i]['weekday']=ucfirst($class->weekday);
		$return[$i]['weekdate']=ucfirst($class->weekdate);
		$return[$i]['fromtime']=$class->fromtime;
		$return[$i]['totime']=$class->totime;
		
		$return[$i]['status']=$class->status;
		
		
		$i++;
    }
	

    return $return;
 }
 
  public function EditSlot($id, $data) {
    $this->db->where('id', $id);
    $this->db->update('classes_meta', $data);
	return true;
	}
 
 
	 public function AddSlot($data)
 {
	 
  $this->db->insert('classes_meta',$data);
  $insert_id = $this->db->insert_id();
  return $insert_id;
 }
	function remove_item($itemid)
  {
	//Delete Parent record
    $this->db->delete('classes', array('id' => $itemid));
	
  }
  function remove_slotitem($itemid)
  {
	//Delete Parent record
    $this->db->delete('classes_meta', array('id' => $itemid));
	
  }
}