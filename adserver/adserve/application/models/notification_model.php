<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Notification_Model extends CI_Model {
	
	function __construct(){
		/* Call the Model constructor */
		parent::__construct();
		$this->load->database();
		
	}
	

	function get_under_dlvr_campaigns()
	{
		$today = date('Y-m-d');
		//$startDate = time();
		//$nextday = date('Y-m-d', strtotime('-1 day', $startDate));

		$this->db->select('campaignid,views,campaignname,expire_time,activate_time');
		$this->db->from('campaigns');
		$this->db->where('activate_time <=', $today);
		//$this->db->where('activate_time <', $nextday);
		$this->db->where('expire_time >=', $today);
		$query = $this->db->get();
		//echo $this->db->last_query(); echo '<br>'; die; 
		$count = $query->num_rows();
		if($count > 0)
		{
			for($i=0;$i<$count;$i++)
			{
				$arr= $query->result_array();
				$campaignId = $arr[$i]['campaignid'];
				$campaignname = $arr[$i]['campaignname'];
				$expire_time = $arr[$i]['expire_time'];
				$activate_time = $arr[$i]['activate_time'];
				$views = $arr[$i]['views'];
				//echo "SELECT m.campaignid,SUM(s.requests) AS requests,SUM(s.impressions) AS impressions,SUM(s.clicks) AS clicks,SUM(s.total_revenue) AS revenue,DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day,HOUR(s.date_time) AS hour FROM campaigns AS m,banners AS b,rv_data_summary_ad_hourly AS s WHERE m.campaignid = ".$campaignId." AND m.campaignid = b.campaignid AND b.bannerid = s.creative_id GROUP BY m.campaignid"; exit;
				//die;
				$campaign_qry = $this->db->query("
											SELECT 
												cl.clientid,
												cl.clientname,
												cl.email,
												m.campaignid, 
												SUM(s.requests) AS requests, 
												SUM(s.impressions) AS impressions, 
												SUM(s.clicks) AS clicks, 
												SUM(s.total_revenue) AS revenue, 
												DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day, 
												HOUR(s.date_time) AS hour 
											FROM 
												campaigns AS m
											LEFT JOIN 
												clients AS cl
												ON cl.clientid = m.clientid  
											LEFT JOIN 
												banners AS b 
												ON m.campaignid = b.campaignid 
											LEFT JOIN 
												rv_data_summary_ad_hourly AS s
												ON b.bannerid = s.creative_id 
											WHERE 
												m.campaignid = ".$campaignId."
											GROUP BY 
												m.campaignid
											");
				$campaign_arr = $campaign_qry->result_array();
				//echo $this->db->last_query(); echo '<br>'; die; 
				//echo $count1 = $campaign_qry->num_rows();
				$response = array();
		  		foreach($campaign_arr as $camp_data)
				{
					$per = ($camp_data['impressions']*100)/$views;
					$response['clientName'] = $camp_data['clientname'];
					$response['clientId'] = $camp_data['clientid'];
					$response['clientEmail'] = $camp_data['email'];
					$response['impressions'] = $camp_data['impressions'];
					$response['campaignname'] = $campaignname;
					$response['expire_time'] = $expire_time;
					$response['activate_time'] = $activate_time;
					$response['views'] = $views;
					$response['impressions'] = $camp_data['impressions'];
					$response['type'] = 'under_delivered';
					$response['per'] = $per;
					$response['count'] = $count;
				  	$new[] = $response;
				}
			}
			//print_r($new);
			//die;
			return $new; 
		} 
	}

	function get_active_campaigns()
	{
		$today = date('Y-m-d');
		$startDate = time();
		$prevday = date('Y-m-d', strtotime('-1 day', $startDate));

		$this->db->select('campaignid,views,campaignname,expire_time,activate_time');
		$this->db->from('campaigns');
		$this->db->where('activate_time', $prevday);
		$this->db->where('expire_time >=', $today);
		$query = $this->db->get();
    	//echo $this->db->last_query(); echo '<br>'; 
		$count = $query->num_rows();
		if($count > 0)
		{
			// $arr= $query->result_array();
			// foreach($arr as $arr1)
			// {
			// 	$response['campaignname'] = $arr1['campaignname'];
			// 	$response['expire_time'] = $arr1['expire_time'];
			// 	$response['type'] = 'active';
			// 	$response['activate_time'] = $arr1['activate_time'];
			//  	$response['count'] = $count;
			// 	$active_array[] = $response;
			// }
			// //print_r($active_array); die;
			// return $active_array;

			for($i=0;$i<$count;$i++)
			{
				$arr= $query->result_array();
				$campaignId = $arr[$i]['campaignid'];
				$campaignname = $arr[$i]['campaignname'];
				$expire_time = $arr[$i]['expire_time'];
				$activate_time = $arr[$i]['activate_time'];
				$views = $arr[$i]['views'];
				//echo "SELECT m.campaignid,SUM(s.requests) AS requests,SUM(s.impressions) AS impressions,SUM(s.clicks) AS clicks,SUM(s.total_revenue) AS revenue,DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day,HOUR(s.date_time) AS hour FROM campaigns AS m,banners AS b,rv_data_summary_ad_hourly AS s WHERE m.campaignid = ".$campaignId." AND m.campaignid = b.campaignid AND b.bannerid = s.creative_id GROUP BY m.campaignid"; exit;
				//die;
				$campaign_qry = $this->db->query("
											SELECT 
												cl.clientid,
												cl.clientname,
												cl.email,
												m.campaignid,
												SUM(s.requests) AS requests,
												SUM(s.impressions) AS impressions,
												SUM(s.clicks) AS clicks,
												SUM(s.total_revenue) AS revenue,
												DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day,
												HOUR(s.date_time) AS hour 
											FROM
												clients AS cl, 
												campaigns AS m,
												banners AS b,
												rv_data_summary_ad_hourly AS s 
											WHERE
												cl.clientid = m.clientid
												AND 
												m.campaignid = ".$campaignId." 
												AND 
												m.campaignid = b.campaignid 
												AND 
												b.bannerid = s.creative_id 
											GROUP BY 
												m.campaignid
											");
				$campaign_arr = $campaign_qry->result_array();
				//echo $count1 = $campaign_qry->num_rows();
				//echo $this->db->last_query(); echo '<br>'; 
				$response = array();
		  		foreach($campaign_arr as $camp_data)
				{
					$per = ($camp_data['impressions']*100)/$views;
					$response['clientName'] = $camp_data['clientname'];
					$response['clientId'] = $camp_data['clientid'];
					$response['clientEmail'] = $camp_data['email'];
					$response['impressions'] = $camp_data['impressions'];
					$response['campaignname'] = $campaignname;
					$response['expire_time'] = $expire_time;
					$response['activate_time'] = $activate_time;
					$response['views'] = $views;
					$response['impressions'] = $camp_data['impressions'];
					$response['type'] = 'active';
					$response['per'] = $per;
					$response['count'] = $count;
				  $active_array[] = $response;
				}
			 }
			return $active_array;
		}

		
	} 

	function get_expired_campaigns()
	{
		$startDate = time();
		$prevday = date('Y-m-d', strtotime('-1 day', $startDate));

		$this->db->select('campaignid,views,campaignname,expire_time,activate_time');
		$this->db->from('campaigns');
		$this->db->where('expire_time <=', $prevday);
		$this->db->where('expire_time !=', '0000-00-00');
		$query = $this->db->get();
    	//echo $this->db->last_query(); echo '<br>'; 
		$count = $query->num_rows();
		if($count > 0)
		{
			// $arr= $query->result_array();
			// foreach($arr as $arr1)
			// {
			// 	$response['campaignname'] = $arr1['campaignname'];
			// 	$response['expire_time'] = $arr1['expire_time'];
			// 	$response['activate_time'] = $arr1['activate_time'];
			// 	$response['type'] = 'expired';
			// 	$response['views'] = $arr1['views'];
			// 	$response['count'] = $count;
			// 	$expired_array[] = $response;
			// }
			// //print_r($active_array); die;
			// return $expired_array;

			for($i=0;$i<$count;$i++)
			{
				$arr= $query->result_array();
				$campaignId = $arr[$i]['campaignid'];
				$campaignname = $arr[$i]['campaignname'];
				$expire_time = $arr[$i]['expire_time'];
				$activate_time = $arr[$i]['activate_time'];
				$views = $arr[$i]['views'];
				//echo "SELECT m.campaignid,SUM(s.requests) AS requests,SUM(s.impressions) AS impressions,SUM(s.clicks) AS clicks,SUM(s.total_revenue) AS revenue,DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day,HOUR(s.date_time) AS hour FROM campaigns AS m,banners AS b,rv_data_summary_ad_hourly AS s WHERE m.campaignid = ".$campaignId." AND m.campaignid = b.campaignid AND b.bannerid = s.creative_id GROUP BY m.campaignid"; exit;
				//die;
				$campaign_qry = $this->db->query("
												SELECT 
													cl.clientid,
													cl.clientname,
													cl.email,
													m.campaignid,
													SUM(s.requests) AS requests,
													SUM(s.impressions) AS impressions,
													SUM(s.clicks) AS clicks,
													SUM(s.total_revenue) AS revenue,
													DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day,
													HOUR(s.date_time) AS hour 
												FROM 
													campaigns AS m
												LEFT JOIN 
													clients AS cl
													ON cl.clientid = m.clientid 
												LEFT JOIN 
													banners AS b 
													ON m.campaignid = b.campaignid
												LEFT JOIN 
													rv_data_summary_ad_hourly AS s
													On b.bannerid = s.creative_id  
												WHERE 
													m.campaignid = ".$campaignId." 
												GROUP BY 
													m.campaignid
												");
				$campaign_arr = $campaign_qry->result_array();
				//echo $count1 = $campaign_qry->num_rows();
				$response = array();
		  		foreach($campaign_arr as $camp_data)
				{
					$per = ($camp_data['impressions']*100)/$views;
					$response['clientName'] = $camp_data['clientname'];
					$response['clientId'] = $camp_data['clientid'];
					$response['clientEmail'] = $camp_data['email'];
					$response['impressions'] = $camp_data['impressions'];
					$response['campaignname'] = $campaignname;
					$response['expire_time'] = $expire_time;
					$response['activate_time'] = $activate_time;
					$response['views'] = $views;
					$response['impressions'] = $camp_data['impressions'];
					$response['type'] = 'expired';
					$response['per'] = $per;
					$response['count'] = $count;
				  $expired_array[] = $response;
				}
			 }
			return $expired_array;
		}

		
	} 

	

	

	

	

	
	
	
	
	
	
	

	
	
	
}