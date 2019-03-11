<?php 
		include_once $_SERVER['DOCUMENT_ROOT']."/adserver/delivery/config/delivery_config.php";
		date_default_timezone_set("Asia/Calcutta");
		$dateTime		= date("Y-m-d H:00:00");
		$event			= $_GET['event'];
		$bannerId		= $_GET['bannerid'];
		$zoneId			= $_GET['zoneid'];
		$aVastEventStrToIdMap = array(
			 'start' => 1,
			 'midpoint' => 3,
			 'firstquartile' => 2,
			 'thirdquartile' => 4,
			 'complete' => 5,
			 'skip' => 6,
			 'replay' => 7,
			 'pause_time' => 8,
			 'play_time' => 9,
			 'mute_time' => 10,
			 'resume' => 11,
			 'pause' => 12,
		);
		
		$vastEventId	= $aVastEventStrToIdMap[$event];
		$query			= "INSERT INTO rv_data_bkt_vast_e (`interval_start`, `creative_id`, `zone_id`, `vast_event_id`,`count`) VALUES ('".$dateTime."', '".$bannerId."','".$zoneId."', '".$vastEventId."', '1') ON DUPLICATE KEY UPDATE count = count + 1";

		$servername 	= $GLOBALS['servername'];
		$username 		= $GLOBALS['username'];
		$password 		= $GLOBALS['password'];
		$dbName			= $GLOBALS['dbName'];

		$dbLink 		= mysqli_connect($servername, $username, $password, $dbName);
		if (mysqli_connect_errno()){
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$result 		= mysqli_query($dbLink, $query);
		
		$my_file					= $GLOBALS['cachePath']."file_".$bannerId.".php";
		$completeArr 				= json_decode(file_get_contents($my_file), true);
		if($completeArr[0]['ext_bannertype'] == 'create_video'){
			
			$vastData					= $completeArr[1];
			if($vastEventId == 1 && $vastData['start_pixel']){
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $vastData['start_pixel']);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				$output = curl_exec($ch);
				curl_close($ch);
			}
			if($vastEventId == 2 && $vastData['quater_pixel']){
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $vastData['quater_pixel']);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				$output = curl_exec($ch);
				curl_close($ch);
			}
			if($vastEventId == 3 && $vastData['mid_pixel']){
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $vastData['mid_pixel']);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				$output = curl_exec($ch);
				curl_close($ch);
			}
			if($vastEventId == 4 && $vastData['third_quater_pixel']){
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $vastData['third_quater_pixel']);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				$output = curl_exec($ch);
				curl_close($ch);
			}
			if($vastEventId == 5 && $vastData['end_pixel']){
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $vastData['end_pixel']);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				$output = curl_exec($ch);
				curl_close($ch);
			}
		}
	?>