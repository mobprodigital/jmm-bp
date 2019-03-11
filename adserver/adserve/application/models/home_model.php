<?php

class Home_model extends CI_Model {
	

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
 function __construct(){
		 /*Call the Model constructor */
		parent::__construct();
		$this->load->database();
		
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
 
 
  public function getday($value){
  	// echo APPPATH."libraries/statistics/dateTimeFilter.php"; exit;
     
  	  require_once APPPATH."libraries/statistics/dateTimeFilter.php";
        //base_url().'application\libraries\statistics\dateTimeFilter.php';
  	  $get_date = $this->_getSpanDates($value);
       
   }


    public function gethomepagestatitics($all_period='')
    {
   	//echo $all_period; exit;
   	  $c = $this->getday($all_period); 
   	   
   }

   public function getres($date1=null,$date2=null)
   {
 
        if(!empty($date1) && !empty($date2)){
        	$where_cond = $this->getWhereDate($date1,$date2);
        	//print_r($where_cond); exit;
        }
        
       $campaign_qry = $this->db->query("SELECT
                                             a.clientid,
                                             a.clientname,
                                             b.campaignid,
                                             b.campaignname,
                                             b.revenue,
                                             SUM(s.requests) AS requests,
                                             SUM(s.impressions) AS impressions,
                                             SUM(s.clicks) AS clicks,
                                             SUM(s.total_revenue) AS revenue,
                                             DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day,
                                             HOUR(s.date_time) AS hour 
                                         FROM
                                           `clients` as a,
                                           `campaigns` as b,
                                           `banners` as c,
                                           `rv_data_summary_ad_hourly` as s
                                         WHERE a.clientid=b.clientid
                                           AND b.campaignid=c.campaignid
                                           AND c.bannerid=s.creative_id". $where_cond );
		  $count = $campaign_qry->num_rows();
		  $result = $campaign_qry->result();
		 //  echo '<pre>';print_r($result); 
      return $result;
		 
		 
  
   }


    public function getchartres($date1=null,$date2=null,$cond=null)
   {
 
        if(!empty($date1) && !empty($date2)){
          $where_cond = $this->getWhereDate($date1,$date2);
          //print_r($where_cond); exit;
        }

        
       $campaign_qry = $this->db->query("SELECT
                                             a.clientid,
                                             a.clientname,
                                             b.campaignid,
                                             b.campaignname,
                                             b.revenue,
                                             SUM(s.requests) AS requests,
                                             SUM(s.impressions) AS impressions,
                                             SUM(s.clicks) AS clicks,
                                             SUM(s.total_revenue) AS revenue,
                                             DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day,
                                             HOUR(s.date_time) AS hour 
                                         FROM
                                           `clients` as a,
                                           `campaigns` as b,
                                           `banners` as c,
                                           `rv_data_summary_ad_hourly` as s
                                         WHERE a.clientid=b.clientid
                                           AND b.campaignid=c.campaignid
                                           AND c.bannerid=s.creative_id". $where_cond . " GROUP BY ". $cond);
      $count = $campaign_qry->num_rows();
      $result = $campaign_qry->result();
    // echo '<pre>';print_r($result); 
      return $result;
     
     
  
   }


   
    
   
}

