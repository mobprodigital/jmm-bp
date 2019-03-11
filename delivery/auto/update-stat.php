<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/adserver/delivery/config/delivery_config.php";
function dboperation(){
		$servername 	= $GLOBALS['servername'];
		$username 		= $GLOBALS['username'];
		$password 		= $GLOBALS['password'];
		$dbName			= $GLOBALS['dbName'];

	$dbLink 	= mysqli_connect($servername, $username, $password, $dbName);
	if (mysqli_connect_errno()){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	$squery = "SELECT m.interval_start, m.creative_id , m.zone_id, m.count as mcount, ifnull(c.count,0) as ccount FROM rv_data_bkt_m m LEFT JOIN 
    rv_data_bkt_c c ON (c.creative_id = m.creative_id)";
	$result = mysqli_query($dbLink, $squery);
	
	if (mysqli_num_rows($result) > 0) { 
		while($row = mysqli_fetch_assoc($result)) {
			
			$iquery	= "INSERT INTO rv_data_summary_ad_hourly (`date_time`, `creative_id`, `zone_id`, `impressions`,`clicks`) VALUES ('".$row['interval_start']."', ".$row['creative_id'].", ".$row['zone_id'].", ".$row['mcount'].", ".$row['ccount'].")";
			$result12 = mysqli_query($dbLink, $iquery);
		
		}
	}
	

	
	$dquery	= "delete from rv_data_bkt_m";
	$result = mysqli_query($dbLink, $dquery);
	
	$dquery	= "delete from rv_data_bkt_c";
	$result = mysqli_query($dbLink, $dquery);
	
	
	
	$squery = "SELECT interval_start, creative_id , zone_id,vast_event_id, count FROM rv_data_bkt_vast_e";
	$result = mysqli_query($dbLink, $squery);
	


	if (mysqli_num_rows($result) > 0) {
		while($row = mysqli_fetch_assoc($result)) {
			$iquery	= "INSERT INTO rv_stats_vast (`interval_start`, `creative_id`, `zone_id`,`vast_event_id`, `count`) VALUES ('".$row['interval_start']."', ".$row['creative_id'].", ".$row['zone_id'].",".$row['vast_event_id'].",  ".$row['count'].")";
			$result11 = mysqli_query($dbLink, $iquery);
		
		}
	}
	
	$dquery	= "delete from rv_data_bkt_vast_e";
	$result123 = mysqli_query($dbLink, $dquery);
	
	
	
	
	
	

	
}

dboperation();


?>






