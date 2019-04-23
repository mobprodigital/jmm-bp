<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Publisher_Model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	
	function getAccountInfo(){
		$uid		= $this->session->userdata('uid');
		$this->db->select("*");
		$this->db->from('users');
		$this->db->where('user_id', $uid);
		$query 			= $this->db->get();
		$result			= $query->row();
		return $result;
		//echo '<pre>';print_r($result);die;
	}
	
	function save($input, $pubId){
		if(!is_null($pubId)){
			$this->db->where('user_id', $pubId);
			$this->db->update('users', $input);
			$msg	= 'publisher updated successfully';
			return $msg;
		}else{
			return '';
		}
		
		
	}
	
	function getwebsites($affiliateid = null){
		$uid		= $this->session->userdata('uid');
		
		$this->db->select("*");
		$this->db->from('affiliates');
		$this->db->where('userid', $uid);

		if(!is_null($affiliateid)){
			$this->db->where('affiliateid', $affiliateid);
		}

		$this->db->order_by("affiliateid",'desc');
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo $this->db->last_query();die;
		//echo '<pre>';print_r($result);die;
		return $result;
	}
	
	function addwebsite($data, $affiliateid = null){
		if(!is_null($affiliateid)){
			$this->db->where('affiliateid', $affiliateid);
		   	$this->db->update('affiliates', $data);
			
			$this->db->select("*");
			$this->db->from('affiliates');
			$this->db->where('affiliates.affiliateid', $affiliateid);
			$query 			= $this->db->get();
			$result			= $query->result();
			return $result;
		}else{
			$userid             = $this->session->userdata('uid');
			$data['userid']		= (int)$userid;
			$this->db->insert('affiliates', $data);
			$insert_id 		= $this->db->insert_id();
			return $insert_id;
		}
		
	}
	
	function getDefaultAffiliate(){
			$uid             = $this->session->userdata('uid');
			$this->db->select("*");
			$this->db->from('affiliates');
			$this->db->where('userid', $uid);
			$query 			= $this->db->get();
			$result			= $query->row();
			//echo '<pre>';print_r($result);die;
			return $result;
		
	}
	
	
	function getzones($affiliateid = null, $zoneid = null){
		$uid 	= $this->session->userdata('uid');
		$this->db->select("*,affiliates.affiliateid as affiliateid");
		$this->db->from('zones');
		$this->db->join('affiliates', 'affiliates.affiliateid = zones.affiliateid');

		$this->db->where('affiliates.userid', $uid);
		if(!is_null($zoneid)){
			$this->db->where('zoneid', $zoneid);
		}elseif(!is_null($affiliateid)){
			$this->db->where('affiliates.affiliateid', $affiliateid);
		}
		$this->db->order_by("zoneid",'desc');

		$query 			= $this->db->get();
		$result			= $query->result();
		//echo $this->db->last_query();die;	
		return $result;
	}
	
	function addzone($data, $affiliateid = null, $zoneid = null){
		if(!is_null($zoneid)){
			$this->db->where('zoneid', $zoneid);
		   	$this->db->update('zones', $data);
			
			$this->db->select("*");
			$this->db->from('zones');
			$this->db->where('zones.zoneid', $zoneid);
			$query 			= $this->db->get();
			$result			= $query->result();
			return $result;
		}else{
			$this->db->insert('zones', $data);
			$insert_id 		= $this->db->insert_id();
			return $insert_id;
		}
	}
	
	function publisherNetworksStats($oStartDate, $oEndDate, $localTZ=false){
		$uid 		= $this->session->userdata('uid');
		$uidStr 	= 'p.userid = '.$uid.' AND';
		
		
		$query = "
            SELECT
                SUM(s.impressions) AS impressions,
                SUM(s.clicks) AS clicks,
               
                SUM(s.total_revenue) AS revenue,
                DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day,
                HOUR(s.date_time) AS hour
            FROM
                zones AS z,
                affiliates AS p,
				rv_data_summary_ad_hourly AS s
            WHERE
                
				".$uidStr." 
				

                p.affiliateid = z.affiliateid
                AND
                z.zoneid = s.zone_id
				
				" .$this->getWhereDate($oStartDate, $oEndDate, $localTZ) . "
			
			";
		//echo $query;die;
		$resut 					= $this->db->query($query);
		$publishersData			= $resut->row();
		//echo '<pre>';print_r($publishersData);die;
		return $publishersData;
	}
	
	
	function publisherStats($publisherId=null,$oStartDate, $oEndDate, $localTZ=false){
		$uid 		= $this->session->userdata('uid');
		$uidStr 	= 'p.userid = '.$uid.' AND';

		
		if(!is_null($publisherId)){
			$str = 'p.affiliateid = '.$publisherId.' AND';
		}else{
			$str = '';
		}
		$query = "
            SELECT
				p.affiliateid,p.name,z.zonename,z.zoneid,
                SUM(s.impressions) AS impressions,
                SUM(s.clicks) AS clicks,
                SUM(s.requests) AS requests,
                SUM(s.total_revenue) AS revenue,
                DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day,
                HOUR(s.date_time) AS hour
            FROM
                zones AS z,
                affiliates AS p,
				rv_data_summary_ad_hourly AS s
            WHERE
                ".$str." 
				".$uidStr." 
				

                p.affiliateid = z.affiliateid
                AND
                z.zoneid = s.zone_id
				
				" .$this->getWhereDate($oStartDate, $oEndDate, $localTZ) . "

				
				 

            GROUP BY
                affiliateid
        ";
		//echo $query;die;
		$resut 					= $this->db->query($query);
		$publishersData			= $resut->result();
		return $publishersData;
		//echo '<pre>';print_r($TableFields);
		
		//p.affiliateid = $publisherId

        //AND
		//" . $this->getWhereDate($oStartDate, $oEndDate, $localTZ) . "


	}
	
    function getWhereDate($oStartDate, $oEndDate, $localTZ = false, $dateField = 's.date_time')
    {
        $where = '';
        if (isset($oStartDate) && $oStartDate) {
            $oStart = "'$oStartDate 00:00:00'";
            $where .= '
                AND ' .
                $dateField .' >= '.$oStart;
        }

        if (isset($oEndDate) && $oEndDate) {
            $oEnd = "'$oEndDate 23:59:59'";
            $where .= '
                AND ' .
                $dateField .' <= '.$oEnd;
        }
		//echo $where;die;
        return $where;
	}
	

/********************* Added By Riccha *************/
public function deleteWebsite($web_ids)
{
	$uid		= $this->session->userdata('uid');
	
	// delete affiliate ids from affiliate
	$this->db->query("DELETE FROM `affiliates` WHERE affiliateid IN ($web_ids) and userid = $uid");
	$count = $this->db->affected_rows();
	if($count > 0)
	{
		// get zone ids from zone table
		$query_camp = $this->db->query("SELECT zoneid FROM `zones`  WHERE affiliateid IN ($web_ids)");
		$res_zone = $query_camp->result_array();
		$res_zone1 = array_column($res_zone,'zoneid');
		$res_zone2 = implode(',',$res_zone1);
		if(!empty($res_zone))
		{
			// delete from zones
			$this->db->query("DELETE FROM `zones` WHERE zoneid IN ($res_zone2)");
			//ends

			// delete from rv_data_summary_ad_hourly
			$this->db->query("DELETE FROM `rv_data_summary_ad_hourly` WHERE zone_id IN ($res_zone2)");
			//ends

			// delete from rv_ad_zone_assoc
			$this->db->query("DELETE FROM `rv_ad_zone_assoc` WHERE zone_id IN ($res_zone2)");
			//ends
		}
		// ends
	}
	// ends

	
}

public function deleteZone($res_zone)
{
	// delete from zones
	$this->db->query("DELETE FROM `zones` WHERE zoneid IN ($res_zone)");
	//ends

	// delete from rv_data_summary_ad_hourly
	$this->db->query("DELETE FROM `rv_data_summary_ad_hourly` WHERE zone_id IN ($res_zone)");
	//ends

	// delete from rv_ad_zone_assoc
	$this->db->query("DELETE FROM `rv_ad_zone_assoc` WHERE zone_id IN ($res_zone)");
	//ends

}
/*********************** Ends ********************/
}