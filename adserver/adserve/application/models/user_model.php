<?php defined('BASEPATH') OR exit('No direct script access allowed');
class User_Model extends CI_Model {
	private $table = 'usersingroup';
	public $bannerTable	='banners';
	public $statsTable	='rv_stats_vast';
	public $zoneTable	='zones';
	public $websiteTable	='affiliates';
	
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

	function __construct(){
		/* Call the Model constructor */
		parent::__construct();
		$this->load->database();
		
	}
	
	
	function mailer($input,$campaignId=null){
		if(!is_null($campaignId)){
			$this->db->where('id', $campaignId);
			$this->db->update('mailer', $input);
			$msg	= 'mailer campaign updated successfully';
		}else{
			$this->db->insert('mailer', $input);
			$msg	= 'mailer campaign inserted successfully';
			
		}
		return $msg;
		
	}
	
	function getlp($agencyid){
		$this->db->select("*");
		$this->db->from('pixel_integration');
		$this->db->where('agency_id', $agencyid);
		$query 						= $this->db->get();
		$requests					= $query->result();
		//echo '<pre>';print_r($requests);die;
		return $requests;
		
	}
	
	function getAgencyDetail($transaction_id){
		$this->db->select("*");
		$this->db->from('pixel_integration');
		$this->db->join('propeller_request', 'pixel_integration.agency_id=propeller_request.agency_id');
	
		if(!is_null($transaction_id)){
			$this->db->where('propeller_request.publisher_ref_id', $transaction_id);
		}
		

		$query 						= $this->db->get();
		$requests					= $query->result();
		//echo '<pre>';print_r($requests);die;
		return $requests;
		
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
			//$this->db->where('status', 'active');
		}
		$query 				= $this->db->get();
		if($row){
			$result 		= $query->row();
		}else{
			$result			= $query->result();
		}
		return $result;
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
		
		if(!is_null($bannerid)){
			$clicks			= $query->row();
		}else{
			$clicks			= $query->result();
		}
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
	
	function getvideoeventbyplacements($bannerid){
		//getting first quadrate time
		$this->db->select("zone_id as placement_ip, count(data_bkt_vast_e.creative_id) as firstquad");
		$this->db->from('data_bkt_vast_e');
		if(!is_null($bannerid)){
			$this->db->where('creative_id', $bannerid);	
			
		}
		
		$this->db->where('vast_event_id =', 2);
		$this->db->group_by('data_bkt_vast_e.zone_id');
		
		$query 				= $this->db->get();
		$firstquad			= $query->result();
		$firstquad			= $query->result();
		
		
		//getting  midpoint time
		$this->db->select("zone_id as placement_ip, count(data_bkt_vast_e.creative_id) as midpoint");
		$this->db->from('data_bkt_vast_e');
		$this->db->where('vast_event_id =', 3);
		if(!is_null($bannerid)){
			$this->db->where('creative_id =', $bannerid);	

		}
		$this->db->group_by('data_bkt_vast_e.zone_id');
		$query 				= $this->db->get();
		$midpoint			= $query->result();
		
		//getting thirdquad
		$this->db->select("zone_id as placement_ip,  count(data_bkt_vast_e.creative_id) as thirdquad");
		$this->db->from('data_bkt_vast_e');
		$this->db->where('vast_event_id', 4);
		if(!is_null($bannerid)){
			$this->db->where('creative_id', $bannerid);	

		}
		
		$this->db->group_by('data_bkt_vast_e.zone_id');
		$query 				= $this->db->get();
		$thirdquad			= $query->result();
		
		//getting completion
		$this->db->select("zone_id as placement_ip, count(data_bkt_vast_e.creative_id) as complete");
		$this->db->from('data_bkt_vast_e');
		$this->db->where('vast_event_id =', 5);
		if(!is_null($bannerid)){
			
			$this->db->where('creative_id =', $bannerid);	

		}
		$this->db->group_by('data_bkt_vast_e.zone_id');
		$query 				= $this->db->get();
		$complete			= $query->result();
		$eventsCount		= array($firstquad, $midpoint, $thirdquad, $complete);

		return $eventsCount;
		
	}
	
	function websiteCampaginStats($publisherId,$zoneId=null,$oStartDate, $oEndDate, $localTZ=false){
		if(!is_null($zoneId)){
			$zoneString = ' s.zone_id = '.$zoneId.' AND ';
		}else{
			$zoneString  = '';
			
		}
		
		
		$query = "
            SELECT 
                SUM(s.impressions) AS impressions,
                SUM(s.clicks) AS clicks,
                SUM(s.requests) AS requests,
                SUM(s.total_revenue) AS revenue,
                SUM(s.conversions) AS conversions,
                m.campaignid AS campaignID,
                m.campaignname AS campaignName,
                c.clientid AS advertiserID,
                c.clientname AS advertiserName
            FROM
				zones AS z,
                affiliates AS p,

                clients AS c,
                campaigns AS m,
                banners AS b,

             
				rv_data_summary_ad_hourly AS s
            WHERE
                p.affiliateid = $publisherId

                AND
				" .$zoneString. "
                c.clientid = m.clientid
                AND
                m.campaignid = b.campaignid
                AND
                b.bannerid = s.creative_id

                AND
                p.affiliateid = z.affiliateid
                AND
                z.zoneid = s.zone_id
				" .$this->getWhereDate($oStartDate, $oEndDate, $localTZ) . "

            GROUP BY
                m.campaignid, m.campaignname,
                c.clientid, c.clientname
        ";

        $result 						= $this->db->query($query);
		$publishersCampaignData			= $result->result();
		/* echo '<pre>';print_r($publishersCampaignData);
		echo $query;die; */
		return $publishersCampaignData;
	}
	
	function getEntityCreationDate($entity,$entityId){
		if($entity == 'zone'){
			$from		= 'zones';
			$where		=  " zoneid = $entityId";
			
		}else{
			$from		= 'affiliates';
			$where		=  " affiliateid = $entityId";
		}
		
		$sql = 
			"select
				updated
			from 
				$from
			
			where ".$where
		;
		$rowResult 						= $this->db->query($sql);
		$entityDetails					= $rowResult->row();
		return date("Y-m-d", strtotime($entityDetails->updated));
		$entityDetails					= $rowResult;
	}
	
	function websiteZoneVideoStats($entity,$entityId,$dimension,$startDate,$endDate){
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
		
		$sql = 
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
		if(!empty($entityDetails)){
			$expansionDetails	= array(
				'type'	=> $entity,
				'id'	=> $entityId,
				'zonename'	=> $entityDetails->zonename,
				'name'	=> $entityDetails->name
			);
		}else{
			$expansionDetails = array();
		}
		$VideoStats		= array(
			'tableData'	=>$result,
			'summaryRow'=>$summaryRow,
			'videoExpansionDetails'	=> $expansionDetails
		);
		//echo '<pre>';print_r($VideoStats);

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
	
	function getVastStatistics(	$entity, // advertiser, campaign, banner
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
	
	function publisherDailyStats($publisherId, $oStartDate, $oEndDate, $localTZ=false){
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
				" .$this->getWhereDate($oStartDate, $oEndDate, $localTZ) . "

            GROUP BY
                day
                
        ";
		
		$rowResult 						= $this->db->query($query);
		$publishersDailyData			= $rowResult->result();
		//echo '<pre>';print_r($publishersDailyData);
		//echo $query;die;
		return $publishersDailyData;

	}
	
	function websiteZoneDailyStats($publisherId, $zoneId, $oStartDate, $oEndDate, $localTZ=false){
		
		$query = "
            SELECT s.zone_id as zoneID,
                SUM(s.impressions) AS impressions,
                SUM(s.clicks) AS clicks,
                SUM(s.requests) AS requests,
                SUM(s.total_revenue) AS revenue,
                DATE_FORMAT(s.date_time, '%Y-%m-%d') AS day,
                HOUR(s.date_time) AS hour
            FROM
                rv_data_summary_ad_hourly AS s
            WHERE
                s.zone_id = $zoneId
				" .$this->getWhereDate($oStartDate, $oEndDate, $localTZ) . "

             GROUP BY
                day
        ";
		
		$rowResult 							= $this->db->query($query);
		$publishersZoneDailyData			= $rowResult->result();
		//echo '<pre>';print_r($publishersZoneDailyData);
		//echo $query;die;
		return $publishersZoneDailyData;
		
	}
	
	function websiteZoneStats($publisherId,$oStartDate, $oEndDate, $localTZ=false){
		$query = "
            SELECT p.affiliateid,p.name,z.zonename,z.zoneid,

                SUM(s.impressions) AS impressions,
                SUM(s.clicks) AS clicks,
                SUM(s.requests) AS requests,
                SUM(s.total_revenue) AS revenue,
                z.zoneid AS zoneID,
                z.zonename AS zoneName
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
				" .$this->getWhereDate($oStartDate, $oEndDate, $localTZ) . "


            GROUP BY
                z.zoneid, z.zonename
        ";
		$resut 					= $this->db->query($query);
		$publishersZoneData			= $resut->result();
		//echo '<pre>';print_r($publishersZoneData);
		//echo $query;die;
		return $publishersZoneData;
	}
	
	function publisherStats($publisherId=null,$oStartDate, $oEndDate, $localTZ=false){
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
	
	/**
     * Get SQL where for statistics methods.
     *
     *  @access public
     *
     * @param Date   $oStartDate
     * @param Date   $oEndDate
     * @param bool   $localTZ
     * @param string $dateField
     *
     * @return string
     */
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
	
	/**
     * A private method to return the current TimeZone as selected by the useUTC parameter
     *
     * @param bool $localTZ
     * @return Date_TimeZone
     */
    private function getTimeZone($localTZ = false)
    {
        if (empty($localTZ)) {
            $oTz = new Date_TimeZone('UTC');
        } else {
            $oNow = new Date();
            $oTz = $oNow->tz;
        }

        return $oTz;
    }

    /**
     * A private method used to return a copy of a Date object after altering its time. It can work using
     * either UTC or the current TZ and eventually converting the result back to UTC.
     *
     * @param Date $oDate
     * @param bool $localTZ
     * @param int $hour
     * @param int $minute
     * @param int $second
     * @return Date
     */
    private function setTimeAndReturnUTC($oDate, $localTZ = false, $hour = 0, $minute = 0, $second = 0)
    {
        $oTz = $this->getTimeZone($localTZ);

        $oDateCopy = new Date($oDate);
        $oDateCopy->setHour($hour);
        $oDateCopy->setMinute($minute);
        $oDateCopy->setSecond($second);
        $oDateCopy->setTZ($oTz);
        $oDateCopy->toUTC();

        return $oDateCopy;
    }
	
	function vastTotalImpressionData($bannerid){
		$this->db->select("SUM(`impressions`) as impressions,SUM(`clicks`) as clicks");
		$this->db->from('rv_data_summary_ad_hourly');
		$this->db->where('creative_id', $bannerid);
		$query 						= $this->db->get();
		$totalImpressionData		= $query->row();
		//echo $this->db->last_query();
		//echo '<pre>';print_r($totalImpressionData);die;
		return $totalImpressionData;
	
		
	}
	
	function vastImpressionDataDay($bannerid, $start, $end, $limit){
		$this->db->select("DATE_FORMAT(date_time, '%Y-%m-%d') AS day", FALSE); 
		$this->db->select("SUM(`impressions`) as impressions,SUM(`clicks`) as clicks");

		$this->db->from('rv_data_summary_ad_hourly');
		$this->db->where('creative_id', $bannerid);


		if($limit){
			/* $this->db->where('interval_start >=', $start);
			$this->db->where('interval_start <=', $end); */
			
		}
		
		$this->db->group_by("day");
		$this->db->order_by('date_time', 'desc');

		$query 				= $this->db->get();
		$vastEventData		= $query->result();
		//echo $this->db->last_query();
		//echo '<pre>';print_r($vastEventData);die;
		return $vastEventData;
	}
	
	function vastEventSumData($bannerid){
		$vastEventId	= 1;
		$this->db->select("SUM(`count`) as total, `vast_event_id`");
		$this->db->from('rv_stats_vast');
		$this->db->where('creative_id', $bannerid);
		$this->db->where('vast_event_id', $vastEventId);
		$query 				= $this->db->get();
		$vastEventStartData		= $query->row();
		
		$vastEventId	= 2;
		$this->db->select("SUM(`count`) as total, `vast_event_id`");
		$this->db->from('rv_stats_vast');
		$this->db->where('creative_id', $bannerid);
		$this->db->where('vast_event_id', $vastEventId);
		$query 				= $this->db->get();
		$vastEventFirstData		= $query->row();
		
		$vastEventId	= 3;
		$this->db->select("SUM(`count`) as total, `vast_event_id`");
		$this->db->from('rv_stats_vast');
		$this->db->where('creative_id', $bannerid);
		$this->db->where('vast_event_id', $vastEventId);
		$query 				= $this->db->get();
		$vastEventMidData		= $query->row();
		
		$vastEventId	= 4;
		$this->db->select("SUM(`count`) as total, `vast_event_id`");
		$this->db->from('rv_stats_vast');
		$this->db->where('creative_id', $bannerid);
		$this->db->where('vast_event_id', $vastEventId);
		$query 				= $this->db->get();
		$vastEventThirdData		= $query->row();
		
		$vastEventId	= 5;
		$this->db->select("SUM(`count`) as total, `vast_event_id`");
		$this->db->from('rv_stats_vast');
		$this->db->where('creative_id', $bannerid);
		$this->db->where('vast_event_id', $vastEventId);
		$query 						= $this->db->get();
		$vastEventCompleteData		= $query->row();
		
		$totalEventData = array(
			'vastEventStartData' => $vastEventStartData,
			'vastEventFirstData' => $vastEventFirstData,
			'vastEventMidData' => $vastEventMidData,
			'vastEventThirdData' => $vastEventThirdData,
			'vastEventCompleteData' => $vastEventCompleteData,
		);
		//echo '<pre>';print_r($totalEventData);die;
		
		
		return $totalEventData;
		 
	}
	
	function vastEventDataDay($bannerid, $start, $end, $limit,$vastEventId){
		$this->db->select("DATE_FORMAT(interval_start, '%Y-%m-%d') AS day", FALSE); 
		$this->db->select("SUM(`count`) as total, `vast_event_id`");

		$this->db->from('rv_stats_vast');
		$this->db->where('creative_id', $bannerid);
		$this->db->where('vast_event_id', $vastEventId);
		

		if($limit){
			/* $this->db->where('interval_start >=', $start);
			$this->db->where('interval_start <=', $end); */
			
		}
		
		$this->db->group_by("day");
		$this->db->order_by('interval_start', 'desc');

		$query 				= $this->db->get();
		$vastEventData		= $query->result();
		//echo $this->db->last_query();
		//echo '<pre>';print_r($vastEventData);die;
		return $vastEventData;
	}
	
	
	function vastImpressionData($bannerid, $start, $end, $limit){
		$this->db->select("*");

		$this->db->from('rv_data_summary_ad_hourly');
		$this->db->where('creative_id', $bannerid);

		if($limit){
			$this->db->where('date_time >=', $start);
			$this->db->where('date_time <=', $end);
			
		}
		
		$this->db->order_by('data_summary_ad_hourly_id', 'asc');

		$query 				= $this->db->get();
		$vastEventData		= $query->result();
		return $vastEventData;	
		
	}
	
	function vastEventData($bannerid, $start, $end, $limit){
		$this->db->select("*");
		$this->db->from('rv_stats_vast');
		$this->db->where('creative_id', $bannerid);

		if($limit){
			$this->db->where('interval_start >=', $start);
			$this->db->where('interval_start <=', $end);
			
		}
		
		$this->db->order_by('data_summary_ad_hourly_id', 'asc');

		$query 				= $this->db->get();
		$vastEventData		= $query->result();
		return $vastEventData;
		
	}
	
	
	function getvideoevent($bannerid = null, $bannerType = null){
		
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
			if($bannerType == 'Multiple'){
				$this->db->where_in('creative_id', $bannerid);
				
			}else{
				$this->db->where('creative_id =', $bannerid);	
			}
		}
		
		$this->db->where('vast_event_id =', 2);
		$this->db->group_by('creative_id');
		$this->db->order_by('creative_id', 'desc');
		$query 				= $this->db->get();
		$firstquad			= $query->result();
		/* if($bannerid){
			$firstquad 		= $query->row();
		}else{
			$firstquad		= $query->result();
		} */
		$firstquad		= $query->result();
		
		//getting  midpoint time
		$this->db->select("creative_id,vast_event_id, count(data_bkt_vast_e.creative_id) as midpoint");
		$this->db->from('data_bkt_vast_e');
		$this->db->where('vast_event_id =', 3);
		if(!is_null($bannerid)){
			if($bannerType == 'Multiple'){
				$this->db->where_in('creative_id', $bannerid);
				
			}else{
				$this->db->where('creative_id =', $bannerid);	
			}
		}
		$this->db->group_by('creative_id');
		$this->db->order_by('creative_id', 'desc');
		$query 				= $this->db->get();
		
		/* if($bannerid){
			$midpoint 		= $query->row();
		}else{
			$midpoint		= $query->result();
		} */
		$midpoint		= $query->result();
		
		//getting thirdquad
		$this->db->select("creative_id, vast_event_id, count(data_bkt_vast_e.creative_id) as thirdquad");
		$this->db->from('data_bkt_vast_e');
		$this->db->where('vast_event_id =', 4);
		if(!is_null($bannerid)){
			if($bannerType == 'Multiple'){
				$this->db->where_in('creative_id', $bannerid);
				
			}else{
				$this->db->where('creative_id =', $bannerid);	
			}
		}
		$this->db->group_by('creative_id');
		$this->db->order_by('creative_id', 'desc');
		$query 				= $this->db->get();
		/* if($bannerid){
			$thirdquad 		= $query->row();
		}else{
			$thirdquad		= $query->result();
		} */
		$thirdquad		= $query->result();
		
		//getting completion
		$this->db->select("creative_id,vast_event_id, count(data_bkt_vast_e.creative_id) as complete");
		$this->db->from('data_bkt_vast_e');
		$this->db->where('vast_event_id =', 5);
		if(!is_null($bannerid)){
			if($bannerType == 'Multiple'){
				$this->db->where_in('creative_id', $bannerid);
				
			}else{
				$this->db->where('creative_id =', $bannerid);	
			}
		}
		$this->db->group_by('creative_id');
		$this->db->order_by('creative_id', 'desc');
		$query 				= $this->db->get();
		/* if($bannerid){
			$complete 		= $query->row();
		}else{
			$complete		= $query->result();
		} */
		$complete		= $query->result();
		
		
		$eventsCount		= array($firstquad, $midpoint, $thirdquad, $complete);
		//$eventsCount		= array($impression, $clicks, $firstquad, $midpoint, $thirdquad, $complete);

		return $eventsCount;
		
	}
	
	 function getsinglevideobannerclk($bannerid, $limit, $start, $end, $affiliateid=null){
		$this->db->select("count(*) as `total_count`,CAST(interval_start AS DATE) as  cdate");
		$this->db->from('data_bkt_c');
		$this->db->where('creative_id', $bannerid);
		if($limit){
			$this->db->where('interval_start >=', $start);
			$this->db->where('interval_start <=', $end);
			
		}
		if(!is_null($affiliateid)){
			$this->db->where('zone_id', $affiliateid);
			
		}
		$this->db->group_by('CAST(interval_start AS DATE)');
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
		
	}
	
	function getsinglevideobannerimp($bannerid,$limit, $start, $end, $affiliateid=null){
		
		$this->db->select("count(*) as `total_count`,CAST(interval_start AS DATE) as  cdate");
		$this->db->from('data_bkt_m');
		$this->db->where('creative_id', $bannerid);
		if($limit){
			$this->db->where('interval_start >=', $start);
			$this->db->where('interval_start <=', $end);
			
		}
		if(!is_null($affiliateid)){
			$this->db->where('zone_id', $affiliateid);
			
		}
		
		$this->db->group_by('CAST(interval_start AS DATE)');
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo $this->db->last_query();die;
		return $result;
		
	}
	
	function getsinglevideobannerreq($bannerid, $limit, $start, $end, $affiliateid = null){
		$this->db->select("count(*) as `total_count`,CAST(datetime AS DATE) as  cdate");
		$this->db->from('video_ad_request');
		$this->db->where('bannerid', $bannerid);
		if($limit){
			$this->db->where('datetime >=', $start);
			$this->db->where('datetime <=', $end);
			
		}
		if(!is_null($affiliateid)){
			$this->db->where('domain', $affiliateid);
			
		}
		$this->db->group_by('CAST(datetime AS DATE)');
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo $this->db->last_query();die;
		return $result;
		
	}
	
	 function getvideobannerclk($start=null, $end=null, $bannerid=null, $bannerType=null){
		$this->db->select("banners.bannerid,interval_start,creative_id,banners.description,banners.campaignid, count(data_bkt_c.creative_id) as vclicks");
		$this->db->from('banners');
		$this->db->join('data_bkt_c', 'data_bkt_c.creative_id=banners.bannerid','left');
		$this->db->where('storagetype =', 'html');
		
		if(!is_null($bannerid)){
			if($bannerType == 'Multiple'){
				$this->db->where_in('bannerid', $bannerid);
			}else{
				$this->db->where('bannerid =', $bannerid);
			}
			
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
		/* if(!is_null($bannerid)){
			$clicks			= $query->row();
		}else{
			$clicks			= $query->result();
		} */
		$clicks			= $query->result();
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
	
	function getvideobannerimp($start=null, $end=null, $bannerid=null, $bannerType=null){
		
		$this->db->select("banners.bannerid,interval_start,creative_id,zone_id,banners.description,banners.campaignid, count(data_bkt_m.creative_id) as impressions");
		$this->db->from('banners');
		$this->db->join('data_bkt_m', 'data_bkt_m.creative_id=banners.bannerid','left');
		$this->db->where('storagetype =', 'html');
		
		if(!is_null($bannerid)){
			if($bannerType == 'Multiple'){
				$this->db->where_in('bannerid', $bannerid);
			}else{
				$this->db->where('bannerid =', $bannerid);
			}
			
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
		
		/* if(!is_null($bannerid)){
			$impressions			= $query->row();
		}else{
			$impressions			= $query->result();
		} */
		
		$impressions			= $query->result();

		return $impressions;
		
	}
	
	
	public function getrequestsbyplacements($bannerid, $type){
			if($type == 'html'){
				$this->db->select("zone_id as placement_ip, count(data_bkt_m.creative_id) as requests");
				$this->db->from('video_ad_request');
				if(!is_null($bannerid)){
					$this->db->where('bannerid', $bannerid);
					
				}
				$this->db->group_by('video_ad_request.domain');
				//$this->db->order_by('data_bkt_m.impid','desc');
				$query 						= $this->db->get();
				$videorequests			= $query->result();
				return $videorequests;
			}else{
		
				$this->db->select("domain, count(ad_request.bannerid) as requests");
				$this->db->from('ad_request');
				if(!is_null($bannerid)){
					$this->db->where('bannerid', $bannerid);
					
				}
				$this->db->group_by('ad_request.domain');
				$this->db->order_by('ad_request.id','desc');
				
				$query 					= $this->db->get();
				$requests			= $query->result();
				return $requests;
			}
		}
	
	public function getimpressionsbyplacements($bannerid, $type){
			if($type == 'html'){
				$this->db->select("zone_id as placement_ip, count(data_bkt_m.creative_id) as impressions");
				$this->db->from('data_bkt_m');
				if(!is_null($bannerid)){
					$this->db->where('creative_id', $bannerid);
					
				}
				$this->db->group_by('data_bkt_m.zone_id');
				//$this->db->order_by('data_bkt_m.impid','desc');
				$query 						= $this->db->get();
				$videoimpressions			= $query->result();
				return $videoimpressions;
			}else{
		
				$this->db->select("placement_ip, count(impression.bannerid) as impressions");
				$this->db->from('impression');
				if(!is_null($bannerid)){
					$this->db->where('bannerid', $bannerid);
					
				}
				$this->db->group_by('impression.placement_ip');
				$this->db->order_by('impression.impid','desc');
				
				$query 					= $this->db->get();
				$impressions			= $query->result();
				return $impressions;
			}
		}
		
		public function getclicksbyplacements($bannerid, $type){
		if($type == 'html'){
		
			$this->db->select("zone_id as placement_ip, count(data_bkt_c.creative_id) as click");
			$this->db->from('data_bkt_c');
			if(!is_null($bannerid)){
					$this->db->where('creative_id', $bannerid);
					
			}
			$this->db->group_by('data_bkt_c.zone_id');
			$this->db->order_by('interval_start','desc');

			$query 					= $this->db->get();
			$videoclicks			= $query->result();
			return $videoclicks;
		}else{
		
		
			$this->db->select("placement_ip, count(click.bannerid) as click");
			$this->db->from('click');
			if(!is_null($bannerid)){
				$this->db->where('bannerid', $bannerid);
					
			}
			$this->db->group_by('click.placement_ip');
			$this->db->order_by('clickid','desc');

			$query 			= $this->db->get();
			$clicks			= $query->result();
			return $clicks;
		}
	}
	
	
	
	
	
	function bannerdaybyimpression($bannerid, $limit, $start, $end, $affiliateid=null){
		$this->db->select("DATE_FORMAT(date_time, '%Y-%m-%d') AS day", FALSE); 
		$this->db->select("SUM(`impressions`) as total_count,SUM(`clicks`) as clicks");

		$this->db->from('rv_data_summary_ad_hourly');
		$this->db->where('creative_id', $bannerid);


		if($limit){
			$this->db->where('date_time >=', $start);
			$this->db->where('date_time <=', $end);
			
		}
		
		$this->db->group_by("day");
		$this->db->order_by('date_time', 'desc');

		$query 				= $this->db->get();
		$vastEventData		= $query->result();
		//echo $this->db->last_query();
		//echo '<pre>';print_r($vastEventData);die;
		return $vastEventData;
		/* $this->db->select("count(*) as `total_count`,CAST(date_time AS DATE) as  cdate");
		$this->db->from(' rv_data_summary_ad_hourly');
		$this->db->where('creative_id', $bannerid);
		if($limit){
			$this->db->where('date_time >=', $start);
			$this->db->where('date_time <=', $end);
			
		}
		if(!is_null($affiliateid)){
			$this->db->where('placement_ip', $affiliateid);

		}
		$this->db->group_by('CAST(date_time AS DATE)');
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo $this->db->last_query();die;
		return $result; */
		
	}
	
	function bannerdaybyclicks($bannerid, $limit, $start, $end, $affiliateid=null){
		$this->db->select("count(*) as `total_count`,CAST(datetime AS DATE) as  cdate");
		$this->db->from('click');
		$this->db->where('bannerid', $bannerid);
		if($limit){
			$this->db->where('datetime >=', $start);
			$this->db->where('datetime <=', $end);
			
		}
		if(!is_null($affiliateid)){
			$this->db->where('placement_ip', $affiliateid);

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
		//$impressions			= $query->result();
		if(!is_null($bannerid)){
			$impressions			= $query->row();
		}else{
			$impressions			= $query->result();
		}
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
	
	function totalRequestInOneDay($bannerId, $clientIP){
		
		$initialTime		= date('Y-m-d 00:00:00');
		$finalTime			= date('Y-m-d 23:59:50');
		$this->db->select("count(*) as cnt");
		$this->db->from("video_ad_request");
		$this->db->where("bannerid", $bannerId);
		$this->db->where("client_ip", $clientIP);
		$this->db->where("datetime > ", $initialTime);
		$this->db->where("datetime < ", $finalTime);
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo $this->db->last_query();
		//echo '<pre>';print_r($result);
		
		if(!empty($result)){
			return $result[0]->cnt;
			
		}else{
			return 0;
		}
		
		
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
		$now 			= date("Y-m-d H:i:s");
		$query 			= "INSERT INTO `impression` (`datetime`,`bannerid`,`placement_ip`,`client_ip`)
					VALUES ('".$now."', '".$bannerid."', '".$ip."', '".$clientIP."')";
		$result			= $this->db->query($query); 
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
			
			$updateSql = "update banner_vast_element set vast_element_type='',vast_video_id='',content_video=0,skip=0,skip_time=0,mute=0,autoplay=0,impression_pixel='',start_pixel='',quater_pixel='',mid_pixel='',third_quater_pixel='',end_pixel='',third_party_click='',creative_view='',vast_tag='',vast_video_duration=0,vast_video_delivery='',vast_video_type='',vast_video_bitrate='',vast_video_height=0,vast_video_width=0,vast_video_outgoing_filename='',vast_companion_banner_id=0,vast_overlay_height=0,vast_overlay_width=0,vast_video_clickthrough_url='',vast_overlay_action='',vast_overlay_format='',vast_overlay_text_title='',vast_overlay_text_description='',vast_overlay_text_call='',vast_creative_type='',vast_thirdparty_impression='',vast_thirdparty_erorr='' where banner_id=$bannerId";
		
			$this->db->query($updateSql);
			
			
			
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
	
	function getvideobanner($bannerid=null, $bannerType=null){
		$this->db->select("*");
		$this->db->from('banners');
		$this->db->join('campaigns', 'campaigns.campaignid = banners.campaignid');
		$this->db->where('banners.storagetype =', 'html');
		if(!is_null($bannerid)){
			if($bannerType == 'Multiple'){
				$this->db->where_in('banners.bannerid', $bannerid);
			}else{
				$this->db->where('banners.bannerid =', $bannerid);
				
			}
			
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
	
	function daybyvideoEvent($bannerid, $vastEventId, $limit, $start, $end,$affiliateid=null){
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
		if(!is_null($affiliateid)){
			$this->db->where('zone_id', $affiliateid);
			
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
	
	function getbannerstatus($bannerId){
		$this->db->select("status");
		$this->db->from('banners');
		$this->db->where('bannerid', $bannerId);
		$query 			= $this->db->get();
		$result			= $query->row();
		return $result->status;
	}
	
	function changebannerstatus($bannerId, $status){
		$this->db->where('bannerid', $bannerId);
		$this->db->update('banners', array("status" => $status));
		return true;
		
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
		return true;
		
	}
	
	
	function bannerIds($campaignid	= null){
		$this->db->select("bannerid");
		$this->db->from('banners');
		if(!is_null($campaignid)){
			$this->db->where_in('campaignid', $campaignid);
		}
		$query 			= $this->db->get();
		$result			= $query->result();
		$bannerArr		= array();
		if(!empty($result)){
			foreach($result as $key => $value){
				$bannerArr[]	= $value->bannerid;
			}
			
		}
		//echo '<pre>';print_r($bannerArr);die;
		return $bannerArr;
		
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
		$query 			= $this->db->get();
		$result			= $query->result();
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
	

	function getirctcbanner($bannerid){
		$this->db->select("htmltemplate,url");
		$this->db->from('banners');
		$this->db->where('bannerid', $bannerid);
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
		
	}
	function getbanner($campaignid=null, $bannerid=null, $row=null , $limit=null , $offset=null){
		$this->db->select("*,campaigns.status as campaignstatu,banners.status as banner_status");
		$this->db->from('banners');
		$this->db->join('campaigns', 'campaigns.campaignid = banners.campaignid');
		if(!is_null($bannerid)){
			$this->db->where('banners.bannerid =', $bannerid);
		}
		if(!is_null($campaignid)){
			$this->db->where('campaigns.campaignid =', $campaignid);
		}
$this->db->where('banners.delete_status =', 'active');
		//$this->db->order_by("bannerid",'desc');
	//echo $offset; die;
		if(!is_null($limit)){
        	$this->db->limit($limit,$offset);

        }
		$this->db->order_by("banners.description,campaigns.campaignname",'desc');
		$query 			= $this->db->get();
		if($row){
			$result			= $query->row();
		}else{
			$result			= $query->result();
		}
		return $result;
	}
	// added by sunil
	function getbannercount($campaignid=null, $bannerid=null, $row=null , $limit=null , $offset=null){

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
			$result			= $query->num_rows();
		}
		return $result;
	}
	////end
	function getlinkedZone($zoneId){
	
		$this->db->select("*");
		$this->db->from('rv_ad_zone_assoc');
		$this->db->where('rv_ad_zone_assoc.zone_id', $zoneId);
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo '<pre>';print_r($result);die;
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
	
	
	function getchannels(){
		$this->db->select("*");
		$this->db->from('channel');
		$this->db->order_by("channelid",'desc');

		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}
  
  
	function getzones($affiliateid = null, $zoneid = null){
		$this->db->select("*,affiliates.affiliateid as affiliateid");
		$this->db->from('zones');
		$this->db->join('affiliates', 'affiliates.affiliateid = zones.affiliateid');

		
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
  
	function getcampaigns($clientid = null, $campaignId = null, $clientType=null,$limit=null, $offset=null){
		$this->db->select("*,campaigns.status as camp_stat");
		$this->db->from('campaigns');
		$this->db->join('clients', 'clients.clientid = campaigns.clientid');
		
//added by sunil
if(!is_null($clientid)){
			if($clientType == 'ALL'){
				
				$this->db->where_in('clients.clientid', $clientid);
			}else{
				$this->db->where('clients.clientid', $clientid);
			}
		}
		
		if(!is_null($campaignId)){
			
		  	$this->db->where('campaigns.campaignid', $campaignId);
		}
		$this->db->order_by("campaignid",'desc');
		if(!is_null($limit)){
        	$this->db->limit($limit,$offset);

        }
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}

	function getcampaignscount($clientid = null, $campaignId = null, $clientType=null,$limit=null, $offset=null){
		$this->db->select("*,campaigns.status as camp_stat");
		$this->db->from('campaigns');
		$this->db->join('clients', 'clients.clientid = campaigns.clientid');
		
		
		
		if(!is_null($clientid)){
			if($clientType == 'ALL'){
				
				$this->db->where_in('clients.clientid', $clientid);
			}else{
				$this->db->where('clients.clientid', $clientid);
			}
		}
		
		if(!is_null($campaignId)){
			
		  	$this->db->where('campaigns.campaignid', $campaignId);
		}
		$this->db->order_by("campaignid",'desc');
		$query 			= $this->db->get();
		$result			= $query->num_rows();
		return $result;
	}
	
	function getreportclients($userId){
		$this->db->select("*");
		$this->db->from('client_access');
		
		
		$query 			= $this->db->get();
		$result			= $query->result();
		$clientArr		= array();
		//echo $userId;
		//echo '<pre>';print_r($result);die;
		if(!empty($result)){
			foreach($result as $key => $value){
				$reportUserArr	= json_decode($value->user_id);
				//echo '<pre>';print_r($reportUserArr);
				if(in_array($userId, $reportUserArr)){
					$clientArr[]	= $value->client_id;
				}
			}
			
		}
		//echo '<pre>';print_r($clientArr);die;
		return $clientArr;
	}
	
	function getclients($userId){
		$this->db->select("clientid");
		$this->db->from('clients');
		if(!is_null($userId)){
		  	$this->db->where('clients.agencyid =', $userId);
		}
		
		$this->db->order_by("clientid",'desc');
		$query 			= $this->db->get();
		$result			= $query->result();
		$clientArr		= array();
		if(!empty($result)){
			foreach($result as $key => $value){
				$clientArr[]	= $value->clientid;
			}
			
		}
		//echo '<pre>';print_r($clientArr);die;
		return $clientArr;
		
	}
	
	function getclientaccess($clientId){
		$this->db->select("*");
		$this->db->from('client_access');
		$this->db->where('client_access.client_id =', $clientId);
		$query 			= $this->db->get();
		$result			= $query->row();
		if(!empty($result)){
			return (json_decode($result->user_id));
		}else{
			return array();
		}
		
		
	}
	
	function updateclientaccess($clientId, $users){
		$this->db->select("*");
		$this->db->from('client_access');
		$this->db->where('client_access.client_id =', $clientId);
		$query 			= $this->db->get();
		$result			= $query->row();
		
		
		if(!empty($result)){
			$this->db->where('client_id', $clientId);
		   	$this->db->update('client_access', $users);
			$msg 		= "client access list updated successfully";
			
		}else{
			$this->db->insert('client_access', $users);
			$insert_id 		= $this->db->insert_id();
			$msg 			= "client access list inserted successfully";
		}
		
		return $msg;
		
	}
	
	function getreportadvertiser($clientIds){
		$this->db->select("*");
		$this->db->from('clients');
		if(!is_null($clientIds)){
		  	$this->db->where_in('clients.clientid', $clientIds);
		}
		
		$this->db->order_by("clientid",'desc');
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo $this->db->last_query();die;
		return $result;
	}
	
	function  updateAdZoneAssoc($adId,$zoneId){
		$this->db->select('ad_zone_assoc_id');
		$this->db->from('rv_ad_zone_assoc');
		$this->db->where('zone_id', $zoneId);
		$this->db->where('ad_id', $adId);

		
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo '<pre>';print_r($result);die;
		if(empty($result)){
			$data		= array("zone_id"=>$zoneId, "ad_id"=>$adId);
			$this->db->insert('rv_ad_zone_assoc', $data);
			$msg		= array('msgType'=>'success','msg'=>'zone is successfully linked to banner');
			return $msg;
		}else{
			$msg		= array('msgType'=>'warning','msg'=>'zone is already linked to banner');
			return $msg;			
		}
	}
	
	function getLinkedBannersByZones($zoneId){
		$this->db->select("ad_zone_assoc_id,zone_id,ad_id,bannerid,storagetype,campaignid,filename,description");
		$this->db->from('rv_ad_zone_assoc');
		$this->db->join('banners', 'banners.bannerid = rv_ad_zone_assoc.ad_id');
		$this->db->where('rv_ad_zone_assoc.zone_id', $zoneId);
		
		$query 			= $this->db->get();
		$result			= $query->result();
		if(!empty($result)){
			foreach($result as $key => $value){
				$this->db->select("clientid");
				$this->db->from('campaigns');
				$this->db->where('campaignid', $value->campaignid);
				$query 			= $this->db->get();
				$id			    = $query->result();
				$result[$key]->clientid	= $id[0]->clientid;
			}
			
		}
		
		return $result;
	}
		
	
	function getAdIdByZones($campaignid, $width, $height){
		$this->db->select("bannerid");
		$this->db->from('banners');
		$this->db->where('banners.campaignid', $campaignid);
		
		$query 			= $this->db->get();
		$result			= $query->result();
		if(!empty($result)){
			return $result[0]->bannerid;
		}else{
			return 0;
		}
		
	}
	function getbannersByZones($clientid, $campaignid, $zoneType, $width, $height){
		$this->db->select("*");
		$this->db->from('banners');
		$this->db->where('banners.campaignid', $campaignid);
		$this->db->where('banners.storagetype', $zoneType);

		if($zoneType != 'html'){
			$this->db->where('banners.width', $width);
			$this->db->where('banners.height',$height);
		}
		//$this->db->where('banners.width', $width);
		//$this->db->where('banners.height', $height);
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}
	function  getcampaignsByZones($clientId, $zoneType, $width, $height){
		$this->db->distinct();
		$this->db->select("*");
		$this->db->from('campaigns');
		$this->db->join('banners', 'banners.campaignid=campaigns.campaignid');
		$this->db->where('campaigns.clientid', $clientId);
		$this->db->where('banners.storagetype', $zoneType);
		if($zoneType != 'html'){
			$this->db->where('banners.width', $width);
			$this->db->where('banners.height',$height);
		}
		
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo $this->db->last_query();
		//echo '<pre>';print_r($result);die;
		return $result;
		

	/* 	SELECT clients.clientid,clients.clientname,campaigns.campaignid,banners.width,banners.height,banners.bannerid FROM `clients`
		JOIN campaigns on campaigns.clientid= clients.clientid
		JOIN banners on banners.campaignid = campaigns.campaignid
		where banners.width=300 and  banners.height=250 */
	}
	function getadvertiserByZones($zoneType, $width, $height){
		$this->db->distinct();
		$this->db->select("clients.clientid,clients.clientname");

		//$this->db->select("clients.clientid,clients.clientname,campaigns.campaignid,banners.width,banners.height,banners.bannerid");
		$this->db->from('clients');
		$this->db->join('campaigns', 'campaigns.clientid=clients.clientid');
		$this->db->join('banners', 'banners.campaignid=campaigns.campaignid');
		$this->db->where('banners.storagetype', $zoneType);
		if($zoneType != 'html'){
			$this->db->where('banners.width', $width);
			$this->db->where('banners.height',$height);
		}
		
		
		$query 			= $this->db->get();
		$result			= $query->result();
		//echo $this->db->last_query();
		//echo '<pre>';print_r($result);die;
		return $result;
		

	/* 	SELECT clients.clientid,clients.clientname,campaigns.campaignid,banners.width,banners.height,banners.bannerid FROM `clients`
		JOIN campaigns on campaigns.clientid= clients.clientid
		JOIN banners on banners.campaignid = campaigns.campaignid
		where banners.width=300 and  banners.height=250 */
		
	}
  
	function getadvertiser($userId=null, $id=null, $limit = null, $offset = null){
		$this->db->select("*");
		$this->db->from('clients');
		if(!is_null($userId)){
		  	$this->db->where('clients.agencyid', $userId);
		}
if(!is_null($limit)){
        	$this->db->limit($limit,$offset);


        }
		if(!is_null($id) && $id!=""){
		  	$this->db->where('clients.clientid', $id);
			//$this->db->where('users.status',	'1');

		}
		$this->db->order_by("clientid",'desc');
		$query 			= $this->db->get();
		$result			= $query->result();
		return $result;
	}
	////added by sunil
	function getadvertisernumrows($userId=null,$id=null){
		$this->db->select("*");
		$this->db->from('clients');
		if(!is_null($userId)){
		  	$this->db->where('clients.agencyid', $userId);
		  	
		}
		if(!is_null($id) && $id!=""){
		  	$this->db->where('clients.clientid', $id);
			//$this->db->where('users.status',	'1');

		}
		$this->db->order_by("clientid",'desc');
		$query 			= $this->db->get();
		$result			= $query->num_rows();
		//print_r($result); die;
		return $result;
	}
	//// end
	
	
	function deletereportuserclients($userId, $clientId){
		$this->db->select("*");
		$this->db->from('client_access');
		$this->db->where('client_id', $clientId);
		$query 			= $this->db->get();
		$result			= $query->row();
		$reportUserArr	= json_decode($result->user_id);

		foreach($reportUserArr as $key => $value){
			if($value == $userId){
				unset($reportUserArr[$key]);
			}
		}
		$reportUserArr = array_values($reportUserArr); 
		$rowData		= array('user_id'=>json_encode($reportUserArr));
		$this->db->where('client_id', $clientId);
		$this->db->update('client_access', $rowData);
		
	}
	
	function reportuseradvertiserlist($reportUserId){
		$this->db->select("*");
		$this->db->from('client_access');
		
		$query 			= $this->db->get();
		$result			= $query->result();
		$clientArr		= array();
		//echo $userId;
		//echo '<pre>';print_r($result);die;
		if(!empty($result)){
			foreach($result as $key => $value){
				$reportUserArr	= json_decode($value->user_id);
				//echo '<pre>';print_r($reportUserArr);
				if(in_array($reportUserId, $reportUserArr)){
					$clientArr[]	= $value->client_id;
				}
			}
		}
		
		
		
		$clients	= array();
		if(!empty($clientArr)){
			$this->db->select("*");
			$this->db->from('clients');
			$this->db->where_in('clientid', $clientArr);
			$query 				= $this->db->get();
			$clients			= $query->result();
			
		}
		return $clients;
		
	}
	
	function fetchreportusers(){
		$this->db->select("id, username, password, firstname, lastname, role, date, status");
		$this->db->from('users');
		$this->db->where('role', 'view report');
		
		$query 					= $this->db->get();
		$result					= $query->result();
		return $result;	
	}
  
	function fetchusers($id = null,$role = null){
		$this->db->select("id, username, password, firstname, lastname, role, date, status");
		$this->db->from('users');
		if(!is_null($id)){
		  	  $this->db->where('id =', $id);
		}
		if(!is_null($role)){
		  	  $this->db->where('role =', $role);
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
function getcurrency(){
	        $this->db->select("id, currency_name, currency_symbol");
			$this->db->from('currency');
			$query 					= $this->db->get();
			$result					= $query->result_array();
	        return $result;        
	}
  /**********************Added By Riccha ********/
//   function getActivebanner($banner_status){
// 	$this->db->select("*,campaigns.status as campaignstatu,banners.status as banner_status");
// 	$this->db->from('banners');
// 	$this->db->join('campaigns', 'campaigns.campaignid = banners.campaignid');
// 	if($banner_status == 1){
// 		$this->db->where('banners.status =', $banner_status);
// 	}
// 	$this->db->order_by("bannerid",'desc');
// 	$query 			= $this->db->get();
// 	$result			= $query->result();
	
// 	//print_r($result);
// 	//die;
// 	return $result;
// }

public function getSortedBanner($banner_status,$sortBy)
{
	$this->db->select("*,campaigns.status as campaignstatu,banners.status as banner_status");
	$this->db->from('banners');
	$this->db->join('campaigns', 'campaigns.campaignid = banners.campaignid');
	
	if($sortBy == 'name' && $banner_status == 1)
	{ 
		$this->db->where('banners.status =', $banner_status);
		$this->db->order_by("banners.description,campaigns.campaignname",'desc');
	}
	elseif($sortBy == 'name' && $banner_status == 0)
	{ 
		$this->db->order_by("banners.description,campaigns.campaignname",'desc');
	}
	elseif($sortBy == 'date' && $banner_status == 1)
	{ 
		$this->db->where('banners.status =', $banner_status);
		$this->db->order_by("banners.updated",'desc'); 
	}
	elseif($sortBy == 'date' && $banner_status == 0)
	{ 
		$this->db->order_by("banners.updated",'desc'); 
	}
	

	$query 			= $this->db->get();
	//echo $this->db->last_query(); echo '<br>';
	$result			= $query->result();
	
	//print_r($result);
	//die;
	return $result;
}

public function getSortedAdvertiser($sortBy)
{
	$this->db->select("*");
	$this->db->from('clients');
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

public function getSortedCampaign($AdvId,$campaignSortType)
{
	$this->db->select("*,campaigns.status as camp_stat");
	$this->db->from('campaigns');
	$this->db->join('clients', 'clients.clientid = campaigns.clientid');
	
	
	if(!is_null($AdvId) && !empty($AdvId))
	{
		$this->db->where('clients.clientid', $AdvId);
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
	return $result;

}

public function deleteBannerByIds($advertzId)
{
	//Delete Banner record
	$updateData = array(
		'status' => '0'
	);
	$this->db->where_in('bannerid', $advertzId);
	$this->db->update('banner', $updateData);	
	echo $this->db->last_query();
	die;
	$report = array();
	$report['error'] = $this->db->_error_number();
	$report['message'] = $this->db->_error_message();
	
	if($report !== 0){
		return true;
	}else{
		return false;
	}
}




/**************************** Ends ******************/
}