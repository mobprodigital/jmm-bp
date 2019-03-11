<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Statistics_Model extends CI_Model {
	public $bannerTable	='banners';
	public $statsTable	='rv_stats_vast';
	public $zoneTable	='zones';
	public $websiteTable	='affiliates';
	public $campaignTable	='campaigns';

	
	static $graphMetricsToPlot = array(1,3,2,4,5);
	
	static $vastEventIdToEventName = array(
	     1 => 'Started',
	     2 => 'Viewed > 50%',
	     3 => 'Viewed > 25%',
	     4 => 'Viewed > 75%',
	     5 => 'Completed',
	     6 => 'Muted',
	     7 => 'Replayed',
	     8 => 'Fullscreen',
	     9 => 'Stopped',
	 );
	 
	 static $vastEventIdInOrder = array(1,3,2,4,5,7,8,6,9,);
	private $table = 'usersingroup';
	function __construct(){
		/* Call the Model constructor */
		parent::__construct();
		$this->load->database();
		
		
	}
	
	

	function helloGoolge($publisherId,$campaignId,$zoneId=null,$oStartDate, $oEndDate, $localTZ = false){
		include APPPATH.'/models/statistics/Publisher.php';
		$query      								= getPublisherCampaignDailyStatistics($publisherId,  $campaignId,$zoneId, $oStartDate, $oEndDate, $localTZ = false);
		$rowResult 									= $this->db->query($query);
		$PublisherCampaignDailyStatistics			= $rowResult->result();
		/* echo '<pre>';print_r($PublisherCampaignDailyStatistics);
		echo $query;die; */
		return $PublisherCampaignDailyStatistics;
	}
	
	function advertiserWebsiteDailyStatus($advertiserId,$campaignId,$bannerId,$affiliateId, $oStartDate, $oEndDate,$localTZ = false){
		if(!is_null($campaignId)){
			$campaignWhere 	= "m.campaignid = $campaignId AND";
		}else{
			$campaignWhere 	= "";
			
			
		}
		if(!is_null($bannerId)){
			$bannerWhere = "b.bannerid = $bannerId AND";
		}else{
			$bannerWhere = "";
		}
		
		if(!is_null($affiliateId)){
			$affiliateWhere = "p.affiliateid = $affiliateId AND";
		}else{
			$affiliateWhere = "";
		}
		
		
		$query = "
            SELECT
                SUM(s.impressions) AS impressions,
                SUM(s.clicks) AS clicks,
                SUM(s.requests) AS requests,
                SUM(s.total_revenue) AS revenue,
				DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day,
                HOUR(s.date_time) AS hour,
                p.affiliateid AS publisherID,
                p.name AS publisherName
            FROM
                clients AS c,
                campaigns AS m,
                banners AS b,
				zones AS z,
                affiliates AS p,

                rv_data_summary_ad_hourly AS s
            WHERE
				".$campaignWhere."
				".$bannerWhere."
				".$affiliateWhere."
                c.clientid = $advertiserId
                AND
                c.clientid = m.clientid
                AND
                m.campaignid = b.campaignid
                AND
                b.bannerid = s.creative_id

                AND
                p.affiliateid = z.affiliateid
                AND
                z.zoneid = s.zone_id
                " . $this->getWhereDate($oStartDate, $oEndDate, $localTZ) . "
            GROUP BY
                day
        ";
		
		$resut 						= $this->db->query($query);
		$advertiserData				= $resut->result();
		//echo $this->db->last_query();die;
		//echo '<pre>';print_r($advertiserData);
		//echo $query;die;
		return $advertiserData;	
	}
	
	function advertiserWebsiteStatus($advertiserId, $campaignId,$bannerId, $oStartDate, $oEndDate,$localTZ = false){
		
		$query = "
            SELECT
                SUM(s.impressions) AS impressions,
                SUM(s.clicks) AS clicks,
                SUM(s.requests) AS requests,
                SUM(s.total_revenue) AS revenue,
                p.affiliateid AS publisherID,
                p.name AS publisherName
            FROM
                clients AS c,
                campaigns AS m,
                banners AS b,
				zones AS z,
                affiliates AS p,

                rv_data_summary_ad_hourly AS s
            WHERE
                c.clientid = $advertiserId
                AND
                c.clientid = m.clientid
                AND
                m.campaignid = b.campaignid
                AND
                b.bannerid = s.creative_id

                AND
                p.affiliateid = z.affiliateid
                AND
                z.zoneid = s.zone_id
                " . $this->getWhereDate($oStartDate, $oEndDate, $localTZ) . "
            GROUP BY
                p.affiliateid, p.name
        ";
		
		$resut 						= $this->db->query($query);
		$advertiserData				= $resut->result();
		//echo $this->db->last_query();die;
		//echo '<pre>';print_r($advertiserData);
		//echo $query;die;
		return $advertiserData;
	}
	
	function advertiserBannerDailyStatus($bannerId, $oStartDate, $oEndDate, $localTZ = false){
		$query = "
            SELECT
                SUM(s.impressions) AS impressions,
                SUM(s.clicks) AS clicks,
                SUM(s.requests) AS requests,
                SUM(s.total_revenue) AS revenue,
                DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day,
                HOUR(s.date_time) AS hour,
				b.campaignid AS campaignID,
                b.bannerid AS bannerID,
                b.description AS bannerName,
				b.storagetype
            FROM
                banners AS b,
                rv_data_summary_ad_hourly AS s
            WHERE
                b.bannerid = $bannerId
                AND
                b.bannerid = s.creative_id
                " . $this->getWhereDate($oStartDate, $oEndDate, $localTZ) . "
            GROUP BY
                day
        ";

		$resut 						= $this->db->query($query);
		$advertiserData				= $resut->result();
		//echo $this->db->last_query();die;
		//echo '<pre>';print_r($advertiserData);
		//echo $query;die;
		return $advertiserData;	
	}
	
	function advertiserBannerStatus($advertiserId, $campaignId, $oStartDate, $oEndDate, $localTZ = false){
	$query = "
            SELECT
                SUM(s.impressions) AS impressions,
                SUM(s.clicks) AS clicks,
                SUM(s.requests) AS requests,
                SUM(s.total_revenue) AS revenue,
                m.campaignid AS campaignID,
                m.campaignname AS campaignName,
                b.bannerid AS bannerID,
                b.description AS bannerName,
				b.storagetype
            FROM
                campaigns AS m,
                banners AS b,

                rv_data_summary_ad_hourly AS s
            WHERE
                m.campaignid = $campaignId
                AND
                m.campaignid = b.campaignid
                AND
                b.bannerid = s.creative_id
                " . $this->getWhereDate($oStartDate, $oEndDate, $localTZ) . "
            GROUP BY
                b.bannerid
        ";
		
		$resut 						= $this->db->query($query);
		$advertiserData				= $resut->result();
		//echo $this->db->last_query();die;
		//echo '<pre>';print_r($advertiserData);
		//echo $query;die;
		return $advertiserData;
	
	
	
	}
	
	function getadvertiserCampaignDailyStatistics($advertiserId, $campaignId, $oStartDate, $oEndDate, $localTZ = false){
		$query = "
            SELECT
				m.campaignid,
				m.campaignname,
                SUM(s.requests) AS requests,
                SUM(s.impressions) AS impressions,
                SUM(s.clicks) AS clicks,
                SUM(s.total_revenue) AS revenue,
                DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day,
                HOUR(s.date_time) AS hour
            FROM
                campaigns AS m,
                banners AS b,

                rv_data_summary_ad_hourly AS s
            WHERE
                m.campaignid = $campaignId
                AND
                m.campaignid = b.campaignid
                AND
                b.bannerid = s.creative_id
                " . $this->getWhereDate($oStartDate, $oEndDate, $localTZ) . "
            GROUP BY
                day
        ";
		
		$resut 						= $this->db->query($query);
		$advertiserData				= $resut->result();
		//echo $this->db->last_query();die;
		//echo '<pre>';print_r($advertiserData);
		//echo $query;die;
		return $advertiserData;

	
	}
	
	function advertiserCampaignStatus($advertiserId, $oStartDate, $oEndDate, $localTZ = false){
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
			 ".$str."
               
                c.clientid = m.clientid
                AND
                m.campaignid = b.campaignid
                AND
                b.bannerid = s.creative_id
                " . $this->getWhereDate($oStartDate, $oEndDate, $localTZ) . "
           GROUP BY
                m.campaignid,m.campaignname
        ";
		//echo $query;die;
		$resut 						= $this->db->query($query);
		$advertiserData				= $resut->result();
		//echo $this->db->last_query();die;
		//echo '<pre>';print_r($advertiserData);
		//echo $query;die;
		return $advertiserData;
		
		
	}
	
	
	function advertiserStats($advertiserId, $oStartDate, $oEndDate, $localTZ = false)
    {
        /* $advertiserId   = $this->oDbh->quote($advertiserId, 'integer');
		$tableClients   = $this->quoteTableName('clients');
        $tableCampaigns = $this->quoteTableName('campaigns');
        $tableBanners   = $this->quoteTableName('banners');
        $tableSummary   = $this->quoteTableName('data_summary_ad_hourly'); */
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
	
	function adCampVideoStats($entity, $entityId, $dimension, $startDate, $endDate){
		if(($startDate == '')&& ($startDate == $endDate)){
				$startDate = $this->getEntityCreationDate($entity,$entityId);
				$endDate   = date("Y-m-d");
		}
		$result 	 = $this->getVastStatistics($entity,$entityId,$dimension,$startDate,$endDate);
		$summaryRow  = $this->getSummaryRowFromDataTable($result);
		
		if($entity == 'zone'){
			$zonename	= ' zonename,';
			$where		=  " z.zoneid = $entityId";
			
		}else{
			
			$zonename	= '';
			$where		=  " p.affiliateid = $entityId";
		}
		
		/* $sql = 
			"select
				z.zonename,p.name
			from 
				affiliates as p
			join 
				 zones z on p.affiliateid = z.affiliateid 
			where ".$where
		;
		$rowResult 						= $this->db->query($sql);
		$entityDetails					= $rowResult->row();
		 */
		 $entityDetails	= array("ss");
		if(!empty($entityDetails)){
			$expansionDetails	= array(
				'type'	=> $entity,
				'id'	=> $entityId,
				
			);
		}else{
			$expansionDetails = array();
		}
		
		$VideoStats		= array(
			'tableData'	=>$result,
			'summaryRow'=>$summaryRow,
			'videoExpansionDetails'	=> $expansionDetails
		);
		//echo '<pre>';print_r($VideoStats);die;

		return $VideoStats;

		
		/* if(!is_null($zoneId)){
			$zoneWhere	=  "AND z.zoneid = $zoneId";
		}else{
			$zoneWhere	= '';
		}
		$query = "
			SELECT
				sum(count) as count,			
				DATE(interval_start) as dimension_id,
				DATE(interval_start) as dimension_name,
				vast_event_id as event_id
			FROM rv_stats_vast AS s 
			JOIN zones as z ON s.zone_id = z.zoneid 
			WHERE z.affiliateid = 1
				AND 
				interval_start >= '2019-02-26 23:00:00'
				AND interval_start <= '2019-02-27 22:59:59'	
			GROUP BY 
				zone_id, vast_event_id
		";
		$rowResult 					= $this->db->query($query);
		$videoStats					= $rowResult->result();
		echo '<pre>';print_r($videoStats); */
	}
	
	function getVastStatistics($entity, // advertiser, campaign, banner
									$entityValue, // ID
									$dimension, // "campaign", "banner", "day", "week", "month", "year", "hour-of-day"
									$startDate, 
									$endDate,
									$entityFilterName = false,
									$entityFilterValue = false
									)
	{
		
			/* echo $entity."<br>". 
									$entityValue."<br>". 
									$dimension."<br>". 
									$startDate."<br>". 
									$endDate."<br>".
									$entityFilterName.'<br>',
									$entityFilterValue;die; */
		$startDateTime = $startDate." 00:00:00";
		$endDateTime = $endDate." 23:59:59";
		 
		
		//echo $startDateTime . " / " . $endDateTime;

		$sqlFrom = $whereEntity = '';
		switch($entity) {
			case 'advertiser':
				$sqlFrom = $this->statsTable. " AS s 
							JOIN $this->bannerTable as b ON s.creative_id = b.bannerid
							JOIN $this->campaignTable AS c ON b.campaignid = c.campaignid";
				$whereEntity = "c.clientid = $entityValue";
			break;
			
			case 'campaign':
				$sqlFrom = $this->statsTable." AS s 
							JOIN ".$this->bannerTable." as b ON s.creative_id = b.bannerid
							";
				$whereEntity = "b.campaignid = $entityValue";
			break;
			
			case 'banner':
				$sqlFrom = $this->statsTable;
				$whereEntity = "creative_id = $entityValue";
			break;
			
			case 'zone':
				$sqlFrom = $this->statsTable;
				$whereEntity = "zone_id = $entityValue";
		    break;
		    
			case 'affiliate':
				$sqlFrom = $this->statsTable." AS s 
							JOIN ".$this->zoneTable." as z ON s.zone_id = z.zoneid
							JOIN ".$this->websiteTable." as a ON a.affiliateid = z.affiliateid
							";
				$whereEntity = "a.affiliateid = $entityValue";
		    break;
		}
		
		// the field to use as an ID 
		$sqlSelectAsDimensionId = $this->getSqlFieldFromDimension($dimension);
		// the field to use as a name for the row (first displayed column)
		$sqlSelectAsDimensionName = $this->getSqlFieldNameFromDimension($dimension, $sqlSelectAsDimensionId);
		
		/* if(!empty($entityFilterName)) {
			$entityFilterName = $this->getSqlFieldFromDimension( $entityFilterName );
			$whereEntity .= " AND $entityFilterName = ".OA_DB::singleton()->quote($entityFilterValue);
		} */
		$query = "	SELECT 	sum(count) as count, 
							$sqlSelectAsDimensionId as dimension_id,
							$sqlSelectAsDimensionName as dimension_name,
							vast_event_id as event_id
					FROM $sqlFrom 
					WHERE $whereEntity
						AND interval_start >= '$startDateTime'
						AND interval_start <= '$endDateTime'
					GROUP BY dimension_id, vast_event_id
					ORDER BY interval_start, vast_event_id ASC";
			//var_dump($query);exit;
		$rowResult 					= $this->db->query($query);
		$result						= $rowResult->result_array();
	//	echo '<pre>';print_r($result);die;		
		
        /* if (PEAR::isError($result)) {
           var_dump($result->getMessage());
           $result = array();
        }*/
		$dimensionToMetrics = array();
		foreach($result as $row) {
			$rowDimension = $row['dimension_id'];
			$rowDimensionName = $row['dimension_name'];
			$metricName = $row['event_id'];
			$metricValue = $row['count'];
			$dimensionToMetrics[$rowDimension][$metricName] = $metricValue;
			$dimensionToMetrics[$rowDimension]['name'] = htmlentities($rowDimensionName);
		}
		
		// if segmented by date, we make sure all dates are set with at least an empty row (no gaps)
		$allRowNames = $this->getDateLabelsBetweenDates($startDate, $endDate, $dimension);
		if(!empty($allRowNames)) {
			$dimensionToMetricsFilled = array();
			foreach($allRowNames as $rowName) {
			    $value = array('name' => $rowName);
			    if(isset($dimensionToMetrics[$rowName])) {
			        $value = $dimensionToMetrics[$rowName];
			    }
			    $dimensionToMetricsFilled[$rowName] = $value;
			}
			$dimensionToMetrics = $dimensionToMetricsFilled;
		} 
		//echo '<pre>';print_r($dimensionToMetrics);die;
		return $dimensionToMetrics;
	}
	protected function getDateLabelsBetweenDates($startDate, $endDate, $dimension)
	{
    	switch($dimension) {
    	    case 'hour-of-day':
    	         return array(
					'0h', '1h', '2h', '3h', '4h', '5h', '6h', '7h', '8h', '9h', '10h', '11h', 
					'12h', '13h', '14h', '15h', '16h', '17h', '18h', '19h', '20h', '21h', '22h', '23h',
				);
    	    break;
			case 'day': 
				$pattern = '%Y-%m-%d'; 
			break;
			case 'week': 
			    $pattern = 'Week %W (%Y)';
			break;
			case 'month': 
			    $pattern = '%B %Y';
			break;
			case 'year': 
			    $pattern = '%Y';
			break;
			default:
			    return array();
		    break;
    	}
	    $startTimestamp = strtotime($startDate);
	    $endTimestamp = strtotime($endDate);
    	while($startTimestamp <= $endTimestamp) {
    	    $dates[] = strftime($pattern, $startTimestamp);
    	    $startTimestamp = strtotime("+1 day", $startTimestamp);
    	}
		//echo '<pre>';print_r($dates);die;
	    return $dates;
	}
	
	public function getSummaryRowFromDataTable($dimensionToMetrics)
	{
		//echo '<pre>';print_r($dimensionToMetrics);die;

		$totalMetrics = array();
		foreach($dimensionToMetrics as $dimension => $metrics) {
			foreach($metrics as $metricId => $value) {
			    // make sure this event exists
			    if(!isset(self::$vastEventIdToEventName[$metricId])) {
			        continue;
			    }
				if(!isset($totalMetrics[$metricId])) {
					$totalMetrics[$metricId] = 0;
				}
				$totalMetrics[$metricId] += $value;
			}
		}
		// only works because we know there are no event_id == 0
		return array('Total') + $totalMetrics;
	}
	
	
	
	protected function getSqlFieldNameFromDimension($dimension, $sqlSelectAsDimensionId)
	{
	    $sqlSelectAsDimensionName = $sqlSelectAsDimensionId;
		if($dimension == 'banner') { 
			$sqlSelectAsDimensionName = 'b.description';
		} else if($dimension == 'campaign') { 
			$sqlSelectAsDimensionName = 'c.campaignname';
		} else if($dimension == 'zone') {
		    $sqlSelectAsDimensionName = 'z.zonename';
		}
		return $sqlSelectAsDimensionName;
	}
	
	protected function getSqlFieldFromDimension($dimension)
	{
		switch($dimension) {
			case 'day': 
				$sqlSelectAsDimensionId = 'DATE(interval_start)'; 
			break;
			case 'week': 
				$sqlSelectAsDimensionId = 'DATE_FORMAT(interval_start, \'Week %v (%x)\')'; 
			break;
			case 'month': 
				$sqlSelectAsDimensionId = 'DATE_FORMAT(interval_start, \'%M %Y\')';
			break;
			case 'year': 
				$sqlSelectAsDimensionId = 'DATE_FORMAT(interval_start, \'%Y\')';
			break;
			case 'hour-of-day': 
				$sqlSelectAsDimensionId = 'DATE_FORMAT(interval_start, \'%kh\')';
			break;
			case 'banner': 
				$sqlSelectAsDimensionId = 's.creative_id'; 
			break;
			case 'campaign': 
				$sqlSelectAsDimensionId = 'b.campaignid'; 
			break;
			case 'zone':
			    $sqlSelectAsDimensionId = 'zone_id';
		    break;
			case 'website':
			    $sqlSelectAsDimensionId = 'z.affiliateid';
		    break;
			default: 
				exit("dimension not known"); 
			break;
		}
		return $sqlSelectAsDimensionId;
	}
	
	
	function checkVideoPub($publisherId,$zoneId){
		if(!is_null($publisherId)){
		if(!is_null($zoneId)){
			$zoneWhere	=  "AND z.zoneid = $zoneId";
		}else{
			$zoneWhere	= '';
		}
		
		$query = "
            SELECT
                z.zonename,
				z.delivery,
				p.affiliateid
            FROM
                zones AS z
			JOIN
                affiliates AS p
			ON z.affiliateid = p.affiliateid
            WHERE
                p.affiliateid = $publisherId
				$zoneWhere
				AND
				z.delivery='html'
		";
		$rowResult 						= $this->db->query($query);
		$checkVideoAff					= $rowResult->result();
		
		if(!empty($checkVideoAff)){
			if(!is_null($zoneId)){
				$checkVideoPub	= array(
					"checkVideoPubStatus"	=> true,
					"expansionType"	=> 'Zone',
					"affiliateid"	=> $publisherId,
					"zoneid"		=> $zoneId
				);
			}else{
				if(!is_null($publisherId)){
					$checkVideoPub	= array(
						"checkVideoPubStatus"	=> true,
						"expansionType"	=> 'Website',
						"affiliateid"	=> $publisherId
					);
				}
			}
		}else{
			$checkVideoPub = array(
				"checkVideoPubStatus"	=> false
			);
		}
		//echo $this->db->last_query();die;
		//echo '<pre>';print_r($checkVideoPub);die;
		return $checkVideoPub;
		}else{
			return $checkVideoPub = array(
				"checkVideoPubStatus"	=> false
			);
		}
		
	}
	
	
	function checkVideoAdvt($clientId, $campaignId, $bannerId){

		if(!is_null($clientId)){
			$bannerWhere	= '';
			$campaignWhere	= '';

			if(!is_null($bannerId)){
				$bannerWhere	=  "AND b.bannerid = $bannerId";
			}elseif(!is_null($campaignId)){
				$campaignWhere	=  "AND m.campaignid = $campaignId";
			}
			
			$query = "
				SELECT
					m.campaignname,
					b.storagetype,
					m.clientid
				FROM
					campaigns AS m
				JOIN
					banners AS b
				ON b.campaignid = m.campaignid
				WHERE
					m.clientid = $clientId
					$campaignWhere
					$bannerWhere

					AND
					b.storagetype='html'
			";
			$rowResult 						= $this->db->query($query);
			$checkVideoAdvt					= $rowResult->result();
			//echo $this->db->last_query();die;
			
			if(!empty($checkVideoAdvt)){
				if(!is_null($bannerId)){
					$checkVideoAdvt	= array(
						"checkVideoAdvtStatus"	=> true,
						"expansionType"	=> 'Ad',
						"clientid"	=> $clientId,
						"campaignid"=> $campaignId,
						"bannerid"=> $bannerId,
					);
				
				}elseif(!is_null($campaignId)){
					$checkVideoAdvt	= array(
						"checkVideoAdvtStatus"	=> true,
						"expansionType"	=> 'Campaign',
						"clientid"	=> $clientId,
						"campaignid"=> $campaignId
					);
				}else{
					if(!is_null($clientId)){
						$checkVideoAdvt	= array(
							"checkVideoAdvtStatus"	=> true,
							"expansionType"	=> 'Advertiser',
							"clientid"	=> $clientId
						);
					}
				}
			}else{
				$checkVideoAdvt = array(
					"checkVideoAdvtStatus"	=> false
				);
			}
			//echo $this->db->last_query();die;
			//echo '<pre>';print_r($checkVideoPub);die;
				return $checkVideoAdvt;
		}else{
			return $checkVideoAdvt = array(
				"checkVideoAdvtStatus"	=> false
			);
		}
		
	}
	
	function publisherDailyStats($publisherId, $startDate, $endDate){
		$query = "
            SELECT
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
                p.affiliateid = $publisherId

                AND
                p.affiliateid = z.affiliateid
                AND
                z.zoneid = s.zone_id

            GROUP BY
                day
                
        ";
		
		$rowResult 						= $this->db->query($query);
		$publishersDailyData			= $rowResult->result();
		//echo '<pre>';print_r($publishersDailyData);
		//echo $query;die;
		return $publishersDailyData;

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
	
	
	
	
	
	
	
	
	
}