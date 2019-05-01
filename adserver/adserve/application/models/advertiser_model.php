<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Advertiser_Model extends CI_Model {
	function __construct(){
		parent::__construct();
		$this->load->database();
		
	}
	
	function save($input, $advtId = null){
		if(!is_null($advtId)){
			$this->db->where('user_id', $advtId);
			$this->db->update('users', $input);
			$msg	= 'advertiser updated successfully';
			return $msg;
		}else{
			return '';
		}
		
	}
	
	function getAccountInfo(){
		$uid		= $this->session->userdata('uid');
		$this->db->select("*");
		$this->db->from('users');
		$this->db->where('user_id', $uid);
		$query 			= $this->db->get();
		$result			= $query->row();
		//echo '<pre>';print_r($result);die;

		return $result;
	}
	
	function getAdvertiser($id = null){
		$uid		 = $this->session->userdata('uid');
		$this->db->select("*");
		$this->db->from('clients');
		$this->db->where('userid', $uid);

		
		if(!is_null($id)){
		  	$this->db->where('clients.clientid', $id);
		}
		$this->db->order_by("clientid",'desc');
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo $this->db->last_query();
		return $result;
	}
	
		function campaignIds($clientid=null){
		$this->db->select("campaignid");
		$this->db->from('campaigns');
		if(!is_null($clientid)){
			if(is_array($clientid)){
				$this->db->where_in('clientid', $clientid);
			}else{
				$this->db->where('clientid', $clientid);
				
			}
			$this->db->where_in('clientid', $clientid);
		}
		$query 				= $this->db->get();
		$result				= $query->result();
		$campaignArr		= array();
		if(!empty($result)){
			foreach($result as $key => $value){
				$campaignArr[]	= $value->campaignid;
			}
		}
		//echo '<pre>';print_r($campaignArr);die;
		return $campaignArr;
		
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
	
	public function addadvertiser($user, $advertiser, $advertiserId = null, $userId = null){
		
	   if(!is_null($advertiserId)){
			$this->db->where('user_id =', $userId);
		   	$this->db->update('users', $user);
			
			$this->db->where('clientid =', $advertiserId);
		   	$this->db->update('clients', $advertiser);
			
			$this->db->select("*");
			$this->db->from('clients');
			$this->db->join('users', 'users.user_id = clients.userid');
			$this->db->where('clients.clientid =', $advertiserId);
			$query 			= $this->db->get();
		//	echo $this->db->last_query(); die;
			$result			= $query->result();
			return $result;
		}else{
			
			$advertiser['userid']		= $this->session->userdata('uid');
			
			//add advertiser
			$this->db->insert('clients', $advertiser);
			
			$insertId 				= $this->db->insert_id();
		}
		
	}
	
	function getclients($result){
		$clientArr		= array();
		if(!empty($result)){
			foreach($result as $key => $value){
				$clientArr[]	= $value->clientid;
			}
		}
		return $clientArr;
	}
	
	function getcampaigns($clientid = null, $campaignId = null){
		$this->db->select("*,campaigns.status as camp_stat");
		$this->db->from('campaigns');
		$this->db->join('clients', 'clients.clientid = campaigns.clientid');
		
		if(is_array($clientid)){
			$this->db->where_in('clients.clientid', $clientid);
		}else{
			if(!is_null($clientid)){
				$this->db->where('clients.clientid', $clientid);
			}
		}
		
		if(!is_null($campaignId)){
			$this->db->where('campaigns.campaignid', $campaignId);
		}
		$this->db->order_by("campaignid",'desc');
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}
	
	function getlinkedZones($bannerId){
		$this->db->select("ad_zone_assoc_id,zone_id,ad_id");
		$this->db->from('rv_ad_zone_assoc');
		$this->db->where('rv_ad_zone_assoc.ad_id', $bannerId);
		
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo '<pre>';print_r($result);die;
		
		
		return $result;
	
	}
	
	function getzoneAffiliate($bannerData){
		$storageType 	= $bannerData->storagetype;
		$width 			= $bannerData->width;
		$height 		= $bannerData->height;
		
		$this->db->select("affiliates.affiliateid,affiliates.name,affiliates.comments as affiliatedescription,zones.zoneid,zones.zonename,zones.description as zonedescription");
		$this->db->from('affiliates');
		$this->db->join('zones', 'zones.affiliateid=affiliates.affiliateid');
		$this->db->where('zones.delivery', $storageType);
		if($storageType != 'html'){
			$this->db->where('zones.width', $width);
			$this->db->where('zones.height',$height);
		}
		
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo $this->db->last_query();
		//echo '<pre>';print_r($result);die;
		return $result;
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
	function getBannerDetails($bannerId){
	
		$query = "
            SELECT
				*
            FROM
                clients AS c,
                campaigns AS m,
                banners AS b
            WHERE
                b.bannerid = $bannerId
                AND
                c.clientid = m.clientid
                AND
                m.campaignid = b.campaignid
               
           
        ";
		//echo $query;die;
		$rowResult 									= $this->db->query($query);
		$bannerDetails								= $rowResult->row();
		return $bannerDetails;
		
		//echo '<pre>';print_r($bannerDetails);die;
		
	}
	
	function getbanner($campaignid=null, $bannerid=null, $row=null){
		$this->db->select("*,campaigns.status as campaignstatu,banners.status as banner_status");
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
	
	function getclientbanner($campaignid=null){
		$this->db->select("*,campaigns.status as campaignstatu,banners.status as banner_status");
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
	
	
	/*************** Start of Ad delivery limitations ***********/
	function updatelimitation($bannerid, $aclPlugins, $compiledLimit){
		//$this->db->where('bannerid', $bannerid);
		//$this->db->update('banners', $input);
		$now 				= time();		
		$query 				= $this->db->query("update banners set compiledlimitation='".$compiledLimit."', acl_plugins='".$aclPlugins."',acls_updated=FROM_UNIXTIME(".$now.") where bannerid = ".$bannerid);
		
		
		$this->db->select("*,banners.status as banner_status,campaigns.status as campaign_status");
		$this->db->from('banners');
		$this->db->join('campaigns', 'campaigns.campaignid = banners.campaignid');
		$this->db->where('banners.bannerid', $bannerid);
		
		$query 			= $this->db->get();
		$result			= $query->result();
		
		//echo '<pre>';print_r($result);die;
		return $result;
	
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
	
	
	/*************** Start of Statistics ***********/
	function advertiserNetworksStats($oStartDate, $oEndDate, $localTZ=false){
		$uid    = $this->session->userdata('uid');
		$advtStr = 'c.userid = '.$uid.' AND';
		

		$query = "
            SELECT
				SUM(s.impressions) AS impressions,
                SUM(s.clicks) AS clicks,
				SUM(s.total_revenue) AS revenue,
                DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day,
                HOUR(s.date_time) AS hour
            FROM
                clients AS c,
                campaigns AS m,
                banners AS b,
                rv_data_summary_ad_hourly AS s
            WHERE
			".$advtStr."
			 
               
                c.clientid = m.clientid
                AND
                m.campaignid = b.campaignid
                AND
                b.bannerid = s.creative_id
                " . $this->getWhereDate($oStartDate, $oEndDate, $localTZ) . "
           
        ";
		$resut 						= $this->db->query($query);
		$advertiserData				= $resut->row();
		return $advertiserData;
	}
	
	function advertiserDailyStats($advertiserId, $oStartDate, $oEndDate, $localTZ=null){
		$uid    = $this->session->userdata('uid');
		$advtStr = '';
		
		$role = $this->session->userdata('role');
		if($role == 2){
		$advtStr = 'c.userid = '.$uid.' AND';
		}	
		if(!is_null($advertiserId)){
			$str = 'c.clientid = '.$advertiserId.' AND';
		}else{
			$str = '';
		}

		$query = "
            SELECT
				c.clientid,c.clientname,m.campaignid,m.campaignname,

                SUM(s.impressions) AS impressions,
                SUM(s.clicks) AS clicks,
                SUM(s.requests) AS requests,
                SUM(s.total_revenue) AS revenue,
                DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day,
                HOUR(s.date_time) AS hour
            FROM
                clients AS c,
                campaigns AS m,
                banners AS b,
                rv_data_summary_ad_hourly AS s
            WHERE
			".$advtStr."
			 ".$str."
               
                c.clientid = m.clientid
                AND
                m.campaignid = b.campaignid
                AND
                b.bannerid = s.creative_id
                " . $this->getWhereDate($oStartDate, $oEndDate, $localTZ) . "
           GROUP BY
                day
        ";
		//echo $query;die;
		$resut 						= $this->db->query($query);
		$advertiserData				= $resut->result();
		//echo $this->db->last_query();die;
		//echo '<pre>';print_r($advertiserData);
		//echo $query;die;
		return $advertiserData;
	
	
	}
	
	
	function advertiserStats($advertiserId, $oStartDate, $oEndDate, $localTZ = false){
		$uid    = $this->session->userdata('uid');
		$advtStr = '';
		
		$role = $this->session->userdata('role');
		if($role == 2){
		$advtStr = 'c.userid = '.$uid.' AND';
		}	
		if(!is_null($advertiserId)){
			$str = 'c.clientid = '.$advertiserId.' AND';
		}else{
			$str = '';
		}

		$query = "
            SELECT
				c.clientid,c.clientname,m.campaignid,m.campaignname,

                SUM(s.impressions) AS impressions,
                SUM(s.clicks) AS clicks,
                SUM(s.requests) AS requests,
                SUM(s.total_revenue) AS revenue,
                DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day,
                HOUR(s.date_time) AS hour
            FROM
                clients AS c,
                campaigns AS m,
                banners AS b,
                rv_data_summary_ad_hourly AS s
            WHERE
			".$advtStr."
			 ".$str."
               
                c.clientid = m.clientid
                AND
                m.campaignid = b.campaignid
                AND
                b.bannerid = s.creative_id
                " . $this->getWhereDate($oStartDate, $oEndDate, $localTZ) . "
           GROUP BY
                c.clientid
        ";
		//echo $query;die;
		$resut 						= $this->db->query($query);
		$advertiserData				= $resut->result();
		//echo $this->db->last_query();die;
		//echo '<pre>';print_r($advertiserData);
		//echo $query;die;
		return $advertiserData;
	}
	
	function getWhereDate($oStartDate, $oEndDate, $localTZ = false, $dateField = 's.date_time'){
        $where = '';
        if (isset($oStartDate) && $oStartDate){
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
	
	/*************** End of Statistics ***********/
	
	public function getSortedAdvertiser($sortBy,$uid)
	{
		$this->db->select("*");
		$this->db->from('clients');
		$this->db->where('userid', $uid);
		if($sortBy == 'name')
		{ $this->db->order_by("clientname",'asc'); }
		elseif($sortBy == 'date')
		{ $this->db->order_by("updated",'desc'); }
		else
		{ $this->db->order_by("clientid",'desc'); }
		
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}

	public function getSortedCampaign($AdvId,$campaignSortType,$userId)
{
	$this->db->select("*,campaigns.status as camp_stat");
	$this->db->from('campaigns');
	$this->db->join('clients', 'clients.clientid = campaigns.clientid');
	
	//$this->db->where('clients.clientid', $clientid);
	
	if(!is_null($AdvId) && !empty($AdvId))
	{
		$this->db->where('clients.clientid', $AdvId);
	}
	else
	{
		$this->db->where('clients.userid', $userId);
	}

	if(!is_null($campaignSortType) && $campaignSortType == 'name')
	{
		$this->db->order_by("campaigns.campaignname",'asc');
	}
	elseif(!is_null($campaignSortType) && $campaignSortType == 'date')
	{
		$this->db->order_by("campaigns.activate_time",'desc');
	}
	else
	{
		$this->db->order_by("campaignid",'desc');
	}
	
	$query 			= $this->db->get();
	//echo $this->db->last_query();
	$result			= $query->result();
	//print_r($result);
	return $result;

}

	function getcampaignstatus($campId){
	$this->db->select("status");
	$this->db->from('campaigns');
	$this->db->where('campaignid', $campId);
	$query 			= $this->db->get();
		
	$result			= $query->row();
	return $result->status;
	//return true;
	
	}

	function changecampaignstatus($campId, $status){
	$this->db->where('campaignid =', $campId);
	$this->db->update('campaigns', array("status" => $status));
	//echo $this->db->last_query(); die;
	return true;
	
	}
	
}