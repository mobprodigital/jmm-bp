<?php 
		include_once $_SERVER['DOCUMENT_ROOT']."/adserver/delivery/config/delivery_config.php";
		date_default_timezone_set("Asia/Calcutta");
		$dateTime		= date("Y-m-d H:00:00");
		$bannerId		= $_GET['bannerid'];
		$zoneId			= $_GET['zoneid'];
		//$my_file					= $GLOBALS['cachePath']."delivery_ad_".$bannerId.".php";
		//$completeArr 				= json_decode(file_get_contents($my_file), true);
		//echo '<pre>';print_r($completeArr);die;
		$bannerdata					= $completeArr[0];
		
		$query			= "INSERT INTO rv_data_bkt_m (`interval_start`, `creative_id`, `zone_id`, `count`) VALUES ('".$dateTime."', '".$bannerId."', '".$zoneId."', '1') ON DUPLICATE KEY UPDATE count = count + 1";
		$servername 	= $GLOBALS['servername'];
		$username 		= $GLOBALS['username'];
		$password 		= $GLOBALS['password'];
		$dbName			= $GLOBALS['dbName'];

		$dbLink = mysqli_connect($servername, $username, $password, $dbName);
		if (mysqli_connect_errno()){
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$result 		= mysqli_query($dbLink, $query);
		
		if($completeArr[1]['impression_pixel']){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $completeArr[1]['impression_pixel']);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			$output = curl_exec($ch);
			curl_close($ch);
		}
	?>
	
	