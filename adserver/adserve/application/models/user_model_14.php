<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_Model extends CI_Model {
	private $table = 'usersingroup';
	function __construct(){
		/* Call the Model constructor */
		parent::__construct();
		$this->load->database();
	}
	
	function fetchintegrationdata(){
		$this->db->select("count(*) as `total_count`,CAST(datetime AS DATE) as  cdate");
		$this->db->from('propeller_request');
		$this->db->group_by('CAST(datetime AS DATE)');
		$query 				= $this->db->get();
		$request			= $query->result();
		
		
		$this->db->select("count(*) as `total_count`,CAST(datetime AS DATE) as  cdate");
		$this->db->from('propeller_conversion');
		$this->db->group_by('CAST(datetime AS DATE)');
		
		$query 				= $this->db->get();
		$conversion			= $query->result();
		return array($request, $conversion);
		
	}
	
	
	/*************** Start of Ad delivery limitations ***********/
	function updatelimitation($bannerid, $aclPlugins, $compiledLimit){
		//$this->db->where('bannerid', $bannerid);
		//$this->db->update('banners', $input);
		$now 				= time();		
		$query 				= $this->db->query("update banners set compiledlimitation='".$compiledLimit."', acl_plugins='".$aclPlugins."',acls_updated=FROM_UNIXTIME(".$now.") where bannerid = ".$bannerid);
	}

	function getlimitation($bannerid){
		$this->db->select("bannerid,compiledlimitation,acl_plugins");
		$this->db->from('banners');
		$this->db->where('bannerid', $bannerid);
		$query 			= $this->db->get();
		$result			= $query->row();
		return $result;
		
	}
	
	
	/*************** End of Ad delivery limitations ***********/
	
	function getcountrylist(){
		
		$this->db->select("*");
		$this->db->from('location');
		$this->db->where('location_type', 0);
		$query 			= $this->db->get();
		$result			= $query->result();
		
		return $result;
		
	}
	
	function getstate($locationId, $locationType){
		$this->db->select("*");
		$this->db->from('location');
		$this->db->where('location_type', $locationType);
		$this->db->where('parent_id', $locationId);
		$query 				= $this->db->get();
		$result				= $query->result();	
		$types = array('country', 'State', 'City');

		// Now display all location in dorp down list...
		$data	= '<option value="">Select '.$types[$locationType].'</option>';
		foreach ($result as $key => $value) {
			$data .="<option value='" . $value->location_id . "'>" . $value->name . "</option>";
		}
		return $data;
	}
	
	
	function gettargeting($campaignid, $targetid=null){
		$this->db->select("*");
		$this->db->from('targeting');
		$this->db->where('targeting.campaignid =', $campaignid);
		if(!is_null($targetid)){
			$this->db->where('targetid =', $targetid);
		}
					

		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
		
	}
	
	function getname($locationid){
		$this->db->select("*");
		$this->db->from('location');
		$this->db->where('location.location_id =', $locationid);
		$query 			= $this->db->get();
		$result			= $query->result();
		
		return $result;
		
	}
	
	function addtargeting($targetid, $target){
		if(!is_null($targetid)){
			$this->db->where('targeting.targetid =', $targetid);
		   	$this->db->update('targeting', $target);
			
			$this->db->select("*");
			$this->db->from('targeting');
			$this->db->where('targeting.targetid =', $targetid);
			$query 			= $this->db->get();
			$result			= $query->result();
			
			return $result;
		}else{
			//add target
			$this->db->insert('targeting', $target);
			$insertId 			= $this->db->insert_id();
			$now 				= time();
			$query 				= $this->db->query("update targeting set datecreated=FROM_UNIXTIME(".$now.") where targetid in (".$insertId.")");
			
		}
		
	}
	
	function getcity($locationId, $locationType){
		$this->db->select("*");
		$this->db->from('location');
		$this->db->where('location_type', $locationType);
		$this->db->where('parent_id', $locationId);
		$query 				= $this->db->get();
		$result				= $query->result();	
		$types = array('country', 'State', 'City');

		// Now display all location in dorp down list...
		$data	= "";
		foreach ($result as $key => $value) {
			$data .="<li id='" . $value->location_id . "'><input type='checkbox' value='".$value->location_id."' class='location-select' name='city'>&nbsp;&nbsp;&nbsp;" . $value->name . "</li>";

		}
		return $data;
	}
	
	
	function setvideocontent($id, $data){
		$this->db->where('id =', $id);
		$this->db->update('uploads', $data);
	}
	
	
	public function getvideos($videoid=null){
		$this->db->select("*");
		$this->db->from('uploads');
		if(!is_null($videoid)){
			$this->db->where('id', $videoid);
			
		}
		$this->db->order_by('id','desc');

		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}
	
	public function getvideoad($bannerid = null, $row=null, $status=''){
		$this->db->select("*");
		$this->db->from('banner_vast_element');
		if(!is_null($bannerid)){
			$this->db->where('banner_id', $bannerid);
			
		}
		if($status != ''){
			$this->db->where('status', 'active');
		}
		$query 				= $this->db->get();
		if($row){
			$result 		= $query->row();
		}else{
			$result			= $query->result();
		}
		return $result;
	}
	
	public function getclicksbyplacements($bannerid){
		
		$this->db->select("zone_id as placement_ip, count(data_bkt_c.creative_id) as click");
		$this->db->from('data_bkt_c');
		if(!is_null($bannerid)){
				$this->db->where('creative_id', $bannerid);
				
		}
		$this->db->group_by('data_bkt_c.zone_id');
		$this->db->order_by('interval_start','desc');

		$query 					= $this->db->get();
		$videoclicks			= $query->result();
		
		
		$this->db->select("placement_ip, count(click.bannerid) as click");
		$this->db->from('click');
		if(!is_null($bannerid)){
			$this->db->where('bannerid', $bannerid);
				
		}
		$this->db->group_by('click.placement_ip');
		$this->db->order_by('clickid','desc');

		$query 			= $this->db->get();
		$clicks			= $query->result();
		return array($clicks, $videoclicks);
	}
	
	
	
	
	public function getrequests($bannerid){
		$this->db->select("banners.bannerid, count(ad_request.bannerid) as requests");
		$this->db->from('banners');
		$this->db->join('ad_request', 'banners.bannerid=ad_request.bannerid','left');
	
		if(!is_null($bannerid)){
			$this->db->where('banners.bannerid =', $bannerid);
		}
		$this->db->group_by('banners.bannerid');
		$this->db->order_by('bannerid','desc');

		$query 					= $this->db->get();
		$requests					= $query->result();
		return $requests;
	}
	
	function bannerdaybyrequest($bannerid, $limit, $start, $end){
		$this->db->select("count(*) as `total_count`,CAST(datetime AS DATE) as  cdate");
		$this->db->from('ad_request');
		$this->db->where('bannerid', $bannerid);
		if($limit){
			$this->db->where('datetime >=', $start);
			$this->db->where('datetime <=', $end);
			
		}
		$this->db->group_by('CAST(datetime AS DATE)');
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo $this->db->last_query();die;
		return $result;
		
	}
	
	public function getclicks($bannerid){
		$this->db->select("banners.bannerid, count(click.bannerid) as clicks");
		$this->db->from('banners');
		$this->db->join('click', 'banners.bannerid=click.bannerid','left');
	
		if(!is_null($bannerid)){
			$this->db->where('banners.bannerid =', $bannerid);
		}
		$this->db->group_by('banners.bannerid');
		$this->db->order_by('bannerid','desc');

		$query 					= $this->db->get();
		$clicks					= $query->result();
		return $clicks;
	}
	
	function checksitecontent($contentid){
		$this->db->select("*");
		$this->db->from('sites_linked');
		$this->db->where('content_id=', $contentid);
		

		$query 				= $this->db->get();
		$content			= $query->result();
		return $content;
		
		
	}
	
	public function getcontentvideo($id){
		$this->db->select("title, name, source");
		$this->db->from('uploads');
		$this->db->where('id', $id);
		

		$query 				= $this->db->get();
		$content			= $query->row();
		
		

		return $content;
		
	}
	
	function getsitevideocontent($domain){
		$this->db->select("uploads.name as videoname,source, affiliates.name as sitename");
		$this->db->from('affiliates');
		$this->db->join('uploads','uploads.id=affiliates.video_content_id');
		$this->db->where('affiliates.name =', $domain);
		

		$query 				= $this->db->get();
		$content			= $query->result();

		return $content;
		
	}
	
	function setsitevideocontent($placementlist, $data){
			$this->db->where_in("affiliateid", $placementlist);
			$this->db->update('affiliates', $data);
		
	}
	
	function savesitecontent($data, $operation, $contentid){
		if($operation == 0){
			$this->db->insert('sites_linked', $data);
			
		}else{
			$this->db->where("content_id=", $contentid);
			$this->db->update('sites_linked', $data);
			
		}
		
	}
	
	
	function getvideoevent($bannerid = null){
		
		/* //getting impression
		$this->db->select("creative_id,vast_event_id, count(data_bkt_vast_e.creative_id) as impression");
		$this->db->from('data_bkt_vast_e');
		$this->db->where('vast_event_id =', 1);
		$this->db->group_by('creative_id');
		$this->db->order_by('creative_id', 'desc');
		$query 				= $this->db->get();
		$impression			= $query->result();
		
		//getting clicks
		$this->db->select("creative_id,vast_event_id, count(data_bkt_vast_e.creative_id) as clicks");
		$this->db->from('data_bkt_vast_e');
		$this->db->where('vast_event_id =', 12);
		$this->db->group_by('creative_id');
		$this->db->order_by('creative_id', 'desc');
		$query 			= $this->db->get();
		$clicks			= $query->result(); */
		
		
		
		//getting first quadrate time
		$this->db->select("creative_id,vast_event_id, count(data_bkt_vast_e.creative_id) as firstquad");
		$this->db->from('data_bkt_vast_e');
		if(!is_null($bannerid)){
			$this->db->where('creative_id =', $bannerid);
		}
		
		$this->db->where('vast_event_id =', 2);
		$this->db->group_by('creative_id');
		$this->db->order_by('creative_id', 'desc');
		$query 				= $this->db->get();
		$firstquad			= $query->result();
		if($bannerid){
			$firstquad 		= $query->row();
		}else{
			$firstquad		= $query->result();
		}
		
		//getting  midpoint time
		$this->db->select("creative_id,vast_event_id, count(data_bkt_vast_e.creative_id) as midpoint");
		$this->db->from('data_bkt_vast_e');
		$this->db->where('vast_event_id =', 3);
		if(!is_null($bannerid)){
			$this->db->where('creative_id =', $bannerid);
		}
		$this->db->group_by('creative_id');
		$this->db->order_by('creative_id', 'desc');
		$query 				= $this->db->get();
		
		if($bannerid){
			$midpoint 		= $query->row();
		}else{
			$midpoint		= $query->result();
		}
		
		//getting thirdquad
		$this->db->select("creative_id, vast_event_id, count(data_bkt_vast_e.creative_id) as thirdquad");
		$this->db->from('data_bkt_vast_e');
		$this->db->where('vast_event_id =', 4);
		if(!is_null($bannerid)){
			$this->db->where('creative_id =', $bannerid);
		}
		$this->db->group_by('creative_id');
		$this->db->order_by('creative_id', 'desc');
		$query 				= $this->db->get();
		if($bannerid){
			$thirdquad 		= $query->row();
		}else{
			$thirdquad		= $query->result();
		}
		
		//getting completion
		$this->db->select("creative_id,vast_event_id, count(data_bkt_vast_e.creative_id) as complete");
		$this->db->from('data_bkt_vast_e');
		$this->db->where('vast_event_id =', 5);
		if(!is_null($bannerid)){
			$this->db->where('creative_id =', $bannerid);
		}
		$this->db->group_by('creative_id');
		$this->db->order_by('creative_id', 'desc');
		$query 				= $this->db->get();
		if($bannerid){
			$complete 		= $query->row();
		}else{
			$complete		= $query->result();
		}
		
		
		$eventsCount		= array($firstquad, $midpoint, $thirdquad, $complete);
		//$eventsCount		= array($impression, $clicks, $firstquad, $midpoint, $thirdquad, $complete);

		return $eventsCount;
		
	}
	
	 function getsinglevideobannerclk($bannerid, $limit, $start, $end){
		$this->db->select("count(*) as `total_count`,CAST(interval_start AS DATE) as  cdate");
		$this->db->from('data_bkt_c');
		$this->db->where('creative_id', $bannerid);
		if($limit){
			$this->db->where('interval_start >=', $start);
			$this->db->where('interval_start <=', $end);
			
		}
		$this->db->group_by('CAST(interval_start AS DATE)');
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
		
	}
	
	function getsinglevideobannerimp($bannerid,$limit, $start, $end){
		
		$this->db->select("count(*) as `total_count`,CAST(interval_start AS DATE) as  cdate");
		$this->db->from('data_bkt_m');
		$this->db->where('creative_id', $bannerid);
		if($limit){
			$this->db->where('interval_start >=', $start);
			$this->db->where('interval_start <=', $end);
			
		}
		
		$this->db->group_by('CAST(interval_start AS DATE)');
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo $this->db->last_query();die;
		return $result;
		
	}
	
	function getsinglevideobannerreq($bannerid, $limit, $start, $end){
		$this->db->select("count(*) as `total_count`,CAST(datetime AS DATE) as  cdate");
		$this->db->from('video_ad_request');
		$this->db->where('bannerid', $bannerid);
		if($limit){
			$this->db->where('datetime >=', $start);
			$this->db->where('datetime <=', $end);
			
		}
		$this->db->group_by('CAST(datetime AS DATE)');
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo $this->db->last_query();die;
		return $result;
		
	}
	
	 function getvideobannerclk($start=null, $end=null, $bannerid=null){
		$this->db->select("banners.bannerid,interval_start,creative_id,banners.description,banners.campaignid, count(data_bkt_c.creative_id) as vclicks");
		$this->db->from('banners');
		$this->db->join('data_bkt_c', 'data_bkt_c.creative_id=banners.bannerid','left');
		$this->db->where('storagetype =', 'html');
		
		if(!is_null($bannerid)){
			$this->db->where('bannerid =', $bannerid);
		}
		
		if(!is_null($start)){
			$start	.=" 00:00:00";
			$end	.=" 00:00:00";
			if($start == $end){
				$this->db->where('interval_start >', $end);
			}
		}


		$this->db->group_by('banners.bannerid');
		$this->db->order_by('bannerid', 'desc');
		
		$query 			= $this->db->get();
		if(!is_null($bannerid)){
			$clicks			= $query->row();
		}else{
			$clicks			= $query->result();
		}
		return $clicks;
		
	}


	function getvideobannerreq(){
		$this->db->select("banners.bannerid, datetime, banners.description,banners.campaignid, count(video_ad_request.bannerid) as requests");
		$this->db->from('banners');
		$this->db->join('video_ad_request', 'video_ad_request.bannerid=banners.bannerid','left');
		$this->db->where('storagetype =', 'html');
		
		$this->db->group_by('banners.bannerid');
		$this->db->order_by('banners.bannerid', 'desc');
		
		$query 				= $this->db->get();
		$requests			= $query->result();
		return $requests;
	}
	
	function getvideobannerimp($start=null, $end=null, $bannerid=null){
		
		$this->db->select("banners.bannerid,interval_start,creative_id,zone_id,banners.description,banners.campaignid, count(data_bkt_m.creative_id) as impressions");
		$this->db->from('banners');
		$this->db->join('data_bkt_m', 'data_bkt_m.creative_id=banners.bannerid','left');
		$this->db->where('storagetype =', 'html');
		
		if(!is_null($bannerid)){
			$this->db->where('bannerid =', $bannerid);
		}
		
		if(!is_null($start)){
			$start	.=" 00:00:00";
			$end	.=" 00:00:00";
			if($start == $end){
				$this->db->where('interval_start >', $end);
			}
		}


		$this->db->group_by('banners.bannerid');
		$this->db->order_by('bannerid', 'desc');
		
		$query 					= $this->db->get();
		
		if(!is_null($bannerid)){
			$impressions			= $query->row();
		}else{
			$impressions			= $query->result();
		}
		
		

		return $impressions;
		
	}
	
	
	public function getimpressionsbyplacements($bannerid){
			$this->db->select("zone_id as placement_ip, count(data_bkt_m.creative_id) as impressions");
			$this->db->from('data_bkt_m');
			if(!is_null($bannerid)){
				$this->db->where('creative_id', $bannerid);
				
			}
			$this->db->group_by('data_bkt_m.zone_id');
			$this->db->order_by('data_bkt_m.impid','desc');
			$query 						= $this->db->get();
			$videoimpressions			= $query->result();
		
			$this->db->select("placement_ip, count(impression.bannerid) as impressions");
			$this->db->from('impression');
			if(!is_null($bannerid)){
				$this->db->where('bannerid', $bannerid);
				
			}
			$this->db->group_by('impression.placement_ip');
			$this->db->order_by('impression.impid','desc');
			
			$query 					= $this->db->get();
			$impressions			= $query->result();
			
			return array($impressions,$videoimpressions);
		
	}
	
	
	
	
	
	function bannerdaybyimpression($bannerid, $limit, $start, $end){
		$this->db->select("count(*) as `total_count`,CAST(datetime AS DATE) as  cdate");
		$this->db->from('impression');
		$this->db->where('bannerid', $bannerid);
		if($limit){
			$this->db->where('datetime >=', $start);
			$this->db->where('datetime <=', $end);
			
		}
		$this->db->group_by('CAST(datetime AS DATE)');
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo $this->db->last_query();die;
		return $result;
		
	}
	
	function bannerdaybyclicks($bannerid, $limit, $start, $end){
		$this->db->select("count(*) as `total_count`,CAST(datetime AS DATE) as  cdate");
		$this->db->from('click');
		$this->db->where('bannerid', $bannerid);
		if($limit){
			$this->db->where('datetime >=', $start);
			$this->db->where('datetime <=', $end);
			
		}
		$this->db->group_by('CAST(datetime AS DATE)');
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}
	
	
/* 	public function getimpressions($bannerid, $start, $end, $period){
		$this->db->select("banners.bannerid,banners.description,banners.campaignid, count(impression.bannerid) as impressions");
		$this->db->from('banners');
		$this->db->join('impression', 'banners.bannerid=impression.bannerid','left');
		if(!is_null($bannerid)){
			$this->db->where('banners.bannerid =', $bannerid);
		}
		if(!is_null($start)){
			$this->db->where('impression.datetime >', $start);
			$this->db->where('impression.datetime <', $end);
		}
		$this->db->group_by('banners.bannerid');
		$this->db->order_by('banners.bannerid','desc');
		$query 					= $this->db->get();
		$impressions			= $query->result();
		return $impressions;
	} */
	public function getimpressions($bannerid, $start, $end, $period){
		$this->db->select("banners.bannerid,banners.description,banners.campaignid, count(impression.bannerid) as impressions");
		$this->db->from('banners');
		$this->db->join('impression', 'banners.bannerid=impression.bannerid','left');
		if(!is_null($bannerid)){
			$this->db->where('banners.bannerid =', $bannerid);
		}
		if(!is_null($start)){
			$this->db->where('impression.datetime >', $start);
			$this->db->where('impression.datetime <', $end);
		}
		$this->db->group_by('banners.bannerid');
		$this->db->order_by('banners.bannerid','desc');
		$query 					= $this->db->get();
		$impressions			= $query->result();
		return $impressions;
	}
	
	function  adclick($ip, $bannerid, $clicks){
		$data['placement_ip']			= $ip;
		$data['bannerid']				= $bannerid;
		$data['click']					= $clicks;
		$this->db->insert('click', $data);
	}
	
	
	/*********** start video ad limitation ***********/
	/*********** end video ad limitation ***********/

	
	function advideoimpression($data){
		$this->db->insert('data_bkt_m', $data);
		$id		= $this->db->insert_id();
		
	}
	
	function totalvideoimpression($creativeid){
		$query 					= $this->db->query("SELECT count(creative_id) as impcount FROM data_bkt_m  group by creative_id having creative_id='$creativeid'");
		$TableFields			= $query->result_array();
		return $TableFields;
		
	}
	
	function todayvideoimpression($creativeid){
		$query 					= $this->db->query("SELECT count(creative_id) as impcount FROM data_bkt_m WHERE interval_start >= NOW() - INTERVAL 1 DAY group by creative_id having creative_id='$creativeid'");
		$TableFields			= $query->result_array();
		return $TableFields;
		
	}
	
	function totalimpression($bannerid){
		$query 					= $this->db->query("SELECT count(impid) as impcount FROM impression  group by bannerid having bannerid='$bannerid'");
		$TableFields			= $query->result_array();
		return $TableFields;
		
	}
	
	
	function todayimpression($bannerid, $url){
		$query 					= $this->db->query("SELECT count(impid) as impcount FROM impression WHERE datetime >= NOW() - INTERVAL 1 DAY group by placement_ip having placement_ip='$url'");
		$TableFields			= $query->result_array();
		return $TableFields;
	}
	
	function clientOnedayvisit($bannerid, $clientIP){
		$query 					= $this->db->query("SELECT count(impid) as impcount FROM impression WHERE datetime >= NOW() - INTERVAL 1 DAY group by client_ip having client_ip='$clientIP'");
		$TableFields			= $query->result_array();
		return $TableFields;
	}
	
	
	
	
	
	
	function campaigndetails($campaignid){
		$this->db->select("*");
		$this->db->from("campaigns");
		$this->db->where("campaignid = ", $campaignid);
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}
	
	
	function  video_adrequest($domain, $clientIP, $bannerid){
		$data['domain']					= $domain;
		$data['client_ip']				= $clientIP;
		$data['bannerid']				= $bannerid;
		$this->db->insert('video_ad_request', $data);
		$insertId			= $this->db->insert_id();
		$now 				= time();
		$query 				= $this->db->query("update video_ad_request set datetime=FROM_UNIXTIME(".$now.") where 	id = ".$insertId);
		
		
		
	}
	
	function  adrequest($ip, $clientIP, $bannerid){
		$data['domain']					= $ip;
		$data['client_ip']				= $clientIP;
		$data['bannerid']				= $bannerid;
		$this->db->insert('ad_request', $data);
		$insertId			= $this->db->insert_id();
		$now 				= time();
		$query 				= $this->db->query("update ad_request set datetime=FROM_UNIXTIME(".$now.") where id = ".$insertId);
		//echo $this->db->last_query();die;
		
		
	}
	
	function  adimpression($ip, $clientIP, $bannerid, $impression){
		$data['placement_ip']			= $ip;
		$data['client_ip']				= $clientIP;
		$data['bannerid']				= $bannerid;
		$data['impression']				= $impression;
		$this->db->insert('impression', $data);
		$insertId			= $this->db->insert_id();
		$now 				= time();
		$query 				= $this->db->query("update impression set datetime=FROM_UNIXTIME(".$now.") where impid = ".$insertId);
		//echo $this->db->last_query();die;
		
		
	}
	
	function getDefault($table, $column){
		$this->db->select($column);
		$this->db->from($table);
		$this->db->limit(1);
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
		
	}
	
	function getsuggestion($id, $key, $column, $returnColumn){
		$this->db->select($returnColumn);
		$this->db->from($id);
		$this->db->like($column, $key);
		//$this->db->where('banners.bannerid =', $bannerid);
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}
	
	public function  updatebanner($tablename, $data, $bannerid){
		$this->db->where('banners.bannerid =', $bannerid);
		$this->db->update('banners', $data);
		
	}
	
	
	function getinactivevideoadid($bannerid){
		$this->db->select("banner_vast_element_id");
		$this->db->from('banner_vast_element');
		$this->db->where('banner_vast_element.banner_id =', $bannerid);
		$this->db->where('status =', 'inactive');

		$query 			= $this->db->get();
		$result			= $query->row();
	
		
		if(!empty($result)){
			return $result->banner_vast_element_id;
		}
	}
	
	function checkmultipleBannerType($bannerid){
		$this->db->select("multiple_banner_existence");
		$this->db->from('banners');
		$this->db->where('bannerid =', $bannerid);
		$query 			= $this->db->get();
		if(!empty($query)){
			return $query->row();

		}else{
			return '';
		}
	}
	
	
	
	function activevideobanner($activeid, $inactiveid){
		$videodata['status']	= 'active';
		$this->db->where('banner_vast_element_id =', $activeid);
		$this->db->update('banner_vast_element', $videodata);
		
		$videodata['status']	= 'inactive';
		$this->db->where('banner_vast_element_id =', $inactiveid);
		$this->db->update('banner_vast_element', $videodata);
		
	}
	
	function addvideoad($bannerId = null, $videodata, $status=''){
		//echo $status;die;
		if(!is_null($bannerId)){
			$this->db->where('banner_vast_element.banner_id =', $bannerId);
			if($status != ''){
				$this->db->where('banner_vast_element.status =', 'active');
			}
			
		   	$this->db->update('banner_vast_element', $videodata);
			//echo $this->db->last_query();die;
			
			$this->db->select("*");
			$this->db->from('banner_vast_element');
			$this->db->where('banner_vast_element.banner_id =', $bannerId);
			if($status != ''){
				$this->db->where('banner_vast_element.status =', 'active');
			}
			
			$query 			= $this->db->get();
			$result			= $query->result();
			return $result;
		}else{
			//add banner
			$this->db->insert('banner_vast_element', $videodata);
			$insertId 				= $this->db->insert_id();
			return $insertId;
		}
	}
	  
	
	function addbanner($banner, $bannerId = null, $campaignid = null){
	   if(!is_null($bannerId)){
		   
			$this->db->where('banners.bannerid =', $bannerId);
		   	$this->db->update('banners', $banner);
			//echo $this->db->last_query();die;
			
			$this->db->select("*");
			$this->db->from('banners');
			$this->db->where('banners.bannerid =', $bannerId);
			$query 			= $this->db->get();
			$result			= $query->result();
			return $result;
		}else{
			//add banner
			$this->db->insert('banners', $banner);
			$insertId 				= $this->db->insert_id();
			return $insertId;
		}
	}
	
	function getvideoeventdetail(){
		$this->db->select("*");
		$this->db->from('data_bkt_vast_e');
		$this->db->order_by("creative_id",'desc');
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
		
	}
	
	function getvideobanner($bannerid=null){
		$this->db->select("*");
		$this->db->from('banners');
		$this->db->join('campaigns', 'campaigns.campaignid = banners.campaignid');
		$this->db->where('banners.storagetype =', 'html');
		if(!is_null($bannerid)){
			$this->db->where('banners.bannerid =', $bannerid);
		}
		$this->db->order_by("bannerid",'desc');
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}
	
	function getclientbanner($campaignid=null){
		$this->db->select("*");
		$this->db->from('banners');
		$this->db->join('campaigns', 'campaigns.campaignid = banners.campaignid');
		if(!is_null($campaignid)){
			$this->db->where_in('campaigns.campaignid', $campaignid);
		}
		$this->db->order_by("bannerid", 'desc');
		$query 			= $this->db->get();
		$result			= $query->result();

		return $result;
	}
	
	function daybyvideoEvent($bannerid, $vastEventId, $limit, $start, $end){
		$this->db->select("vast_event_id, creative_id,count(*) as `total_count`,CAST(interval_start AS DATE) as  cdate");
		$this->db->from('data_bkt_vast_e');
		$this->db->where('creative_id', $bannerid);
		if($vastEventId){
			$this->db->where('vast_event_id', $vastEventId);
		}
		if($limit){
			$this->db->where('interval_start >=', $start);
			$this->db->where('interval_start <=', $end);
			
		}
		$this->db->group_by('CAST(interval_start AS DATE)');
		
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
		
	}
	
	function daybyimpression($bannerid){
		$this->db->select("count(*) as `total_count`,CAST(interval_start AS DATE) as  cdate");
		$this->db->from('data_bkt_m');
		$this->db->where('creative_id', $bannerid);
		$this->db->group_by('CAST(interval_start AS DATE)');
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
		
	}
	
	function daybyclicks($bannerid){
		$this->db->select("count(*) as `total_count`,CAST(interval_start AS DATE) as  cdate");
		$this->db->from('data_bkt_c');
		$this->db->where('creative_id', $bannerid);
		$this->db->group_by('CAST(interval_start AS DATE)');
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
		
		
	}
	
	function getcampaignstatus($campId){
		$this->db->select("status");
		$this->db->from('campaigns');
		$this->db->where('campaignid', $campId);
		$query 			= $this->db->get();
		$result			= $query->row();
		return $result->status;
		
	}
	
	function changecampaignstatus($campId, $status){
		$this->db->where('campaignid =', $campId);
		$this->db->update('campaigns', array("status" => $status));
		return true;
		
	}
	
	
	
	function getcampaignids($clientid=null){
		$this->db->select("campaignid");
		$this->db->from('campaigns');
		if(!is_null($clientid)){
			$this->db->where('clientid =', $clientid);
		}
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}
	
	function getanycontent(){
		$this->db->select("name, status");
		$this->db->from('uploads');
		$this->db->limit(1,1);
		
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result[0]->name;
		
	}
	
	function getactivecontent(){
		$this->db->select("name, status");
		$this->db->from('uploads');
		$this->db->where('status', 1);
		$this->db->limit(1, 0);
		
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
		
	}
	

	function getbanner($campaignid=null, $bannerid=null, $row=null){
		$this->db->select("*");
		$this->db->from('banners');
		$this->db->join('campaigns', 'campaigns.campaignid = banners.campaignid');
		if(!is_null($bannerid)){
			$this->db->where('banners.bannerid =', $bannerid);
		}
		if(!is_null($campaignid)){
			$this->db->where('campaigns.campaignid =', $campaignid);
		}
		$this->db->order_by("bannerid",'desc');
		$query 			= $this->db->get();
		if($row){
			$result			= $query->row();
		}else{
			$result			= $query->result();
		}
		return $result;
	}
  
  
	function addzone($data, $affiliateid =null, $zoneid =null){
		if(!is_null($zoneid)){
			$this->db->where('zoneid =', $zoneid);
		   	$this->db->update('zones', $data);
			
			$this->db->select("*");
			$this->db->from('zones');
			$this->db->where('zones.zoneid =', $zoneid);
			$query 			= $this->db->get();
			$result			= $query->result();
			return $result;
		}else{
			$this->db->insert('zones', $data);
			$insert_id 		= $this->db->insert_id();
			return $insert_id;
		}
	}
	
	
	function getchannels(){
		$this->db->select("*");
		$this->db->from('channel');
		$this->db->order_by("channelid",'desc');

		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}
  
  
	function getzones($affiliateid = null, $zoneid = null){
		$this->db->select("*");
		$this->db->from('zones');
		if(!is_null($zoneid)){
			$this->db->where('zoneid =', $zoneid);
		}elseif(!is_null($affiliateid)){
			$this->db->where('affiliateid =', $affiliateid);
		}
		$this->db->order_by("zoneid",'desc');

		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}
  
  
	function addwebsite($data, $affiliateid = null){
		if(!is_null($affiliateid)){
			$this->db->where('affiliateid =', $affiliateid);
		   	$this->db->update('affiliates', $data);
			
			$this->db->select("*");
			$this->db->from('affiliates');
			//$this->db->join('clients', 'clients.clientid = campaigns.clientid');
			$this->db->where('affiliates.affiliateid =', $affiliateid);
			$query 			= $this->db->get();
			$result			= $query->result();
			return $result;
		}else{
			//add affiliates
			$this->db->insert('affiliates', $data);
			$insert_id 		= $this->db->insert_id();
			return $insert_id;
		}
		
	}
	
	
	function getwebsites($affiliateid = null){
		$this->db->select("*");
		$this->db->from('affiliates');
		if(!is_null($affiliateid)){
			$this->db->where('affiliateid =', $affiliateid);
		}

		$this->db->order_by("affiliateid",'desc');
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}
	
	public function addadvertiser($user, $advertiser, $advertiserId = null, $userId = null){
		//echo '<pre>';print_r($user);die;
	   if(!is_null($advertiserId)){
			$this->db->where('id =', $userId);
		   	$this->db->update('users', $user);
			
			$this->db->where('clientid =', $advertiserId);
		   	$this->db->update('clients', $advertiser);
			
			$this->db->select("*");
			$this->db->from('clients');
			$this->db->join('users', 'users.id = clients.account_id');
			$this->db->where('clients.clientid =', $advertiserId);
			$query 			= $this->db->get();
			$result			= $query->result();
			return $result;
		}else{
			//add user
			$this->db->insert('users', $user);
			$insertId 						= $this->db->insert_id();
			$advertiser['account_id']		= $insertId;
			
			//add advertiser
			$this->db->insert('clients', $advertiser);
			$insertId 				= $this->db->insert_id();
		}
		
	}
	public function addcampaign($campaign, $advertiserId = null, $campaignId = null){
	   if(!is_null($campaignId)){
			$this->db->where('campaignid =', $campaignId);
		   	$this->db->update('campaigns', $campaign);
			
			$this->db->select("*");
			$this->db->from('campaigns');
			$this->db->join('clients', 'clients.clientid = campaigns.clientid');
			$this->db->where('campaigns.campaignid =', $campaignId);
			$query 			= $this->db->get();
			$result			= $query->result();	
			return $result;
		}else{
			//add advertiser
			$this->db->insert('campaigns', $campaign);
			$insertId 				= $this->db->insert_id();
		}
		
	}
  
	function getcampaigns($clientid = null, $campaignId = null){
		$this->db->select("*,campaigns.status as camp_stat");
		$this->db->from('campaigns');
		$this->db->join('clients', 'clients.clientid = campaigns.clientid');
		if(!is_null($clientid)){
			
		  	$this->db->where('clients.clientid =', $clientid);
			//$this->db->where('users.status',	'1');
		}
		if(!is_null($campaignId)){
		  	$this->db->where('campaigns.campaignid =', $campaignId);
		}
		$this->db->order_by("campaignid",'desc');
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}
	
	
  
	function getadvertiser($id = null){
		$this->db->select("*");
		$this->db->from('clients');
		//$this->db->join('users', 'users.id = clients.account_id');
		if(!is_null($id)){
		  	$this->db->where('clients.clientid =', $id);
			//$this->db->where('users.status',	'1');

		}
		$this->db->order_by("clientid",'desc');
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}
  
	function fetchusers($id = null){
		$this->db->select("id, username, password, firstname, lastname, role, date, status");
		$this->db->from('users');
		if(!is_null($id)){
		  	  $this->db->where('id =', $id);
		}
		$this->db->where('username !=', 'admin');
		$this->db->order_by('id','desc');
		$query 					= $this->db->get();
		$result					= $query->result();
		return $result;
	}
  
	function fetchteachers(){
		if($this->session->userdata('role')=='teacher')
		$this->db->where('id', $this->session->userdata('uid'));
	 
		$this->db->where('role', 'teacher');
		$query = $this->db->get('users');
		$return = array();
		$i=0;
		foreach ($query->result() as $user){
			$return[$i]['id']=$user->id;
			$return[$i]['username']=ucfirst($user->username);
			$return[$i]['firstname']=ucfirst($user->firstname);
			$return[$i]['lastname']=ucfirst($user->lastname);
			$i++;
		}
		return $return;
	}
  
	function checkuserunique($str){
		$return='';
		$sql=mysql_query('select * from users where username="'.$str.'"' );
		$numrow=mysql_num_rows($sql);
		return $numrow;
		if($numrow>0){
			$return='Duplicate';
		}else{
			$return='Unique';
		}
		return $return;
	}
  
  
  
  
	public function AddUser($data, $userId = null){
	   if(!is_null($userId)){
			$this->db->where('username !=', 'admin');
			$this->db->where('id =', $userId);
		   	$this->db->update('users', $data);
			
		
			
						
			$this->db->select("id, username, password, firstname, lastname, role, date, status");
			$this->db->from('users');
			$this->db->where('id =', $userId);
			$query 					= $this->db->get();
			$result					= $query->result();
			return $result;
		}else{
			$this->db->insert('users', $data);
			$insert_id 		= $this->db->insert_id();
			return $insert_id;
		}
		
	}
 
	 function getdataedit($id){
		$query = $this->db->get_where('users',array('id'=>$id));
		return $query->row_array();  
	 }
	 
  public function updateuser($id, $data) {
    $this->db->where('id', $id);
    $this->db->update('users', $data);
	}
	
	function remove_item($itemid)
  {
	//Delete Parent record
    $this->db->delete('users', array('id' => $itemid));
	
  }
}