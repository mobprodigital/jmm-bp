<?php 
		include_once $_SERVER['DOCUMENT_ROOT']."/adserver/delivery/config/delivery_config.php";
		date_default_timezone_set("Asia/Calcutta");
		$dateTime		= date("Y-m-d H:00:00");
		$bannerId		= $_GET['bannerid'];
		$zoneId		= $_GET['zoneid'];
		$my_file		= $cachePath."delivery_ad_".$bannerId.".php";
	
		$completeArr 				= json_decode(file_get_contents($my_file), true);
		$bannerdata					= $completeArr[0];
		//echo '<pre>';print_r($completeArr);die;

		$query			= "INSERT INTO rv_data_bkt_c (`interval_start`, `creative_id`, `zone_id`, `count`) VALUES ('".$dateTime."', '".$bannerId."', '".$zoneId."', '1') ON DUPLICATE KEY UPDATE count = count + 1";
		$servername 	= $GLOBALS['servername'];
		$username 		= $GLOBALS['username'];
		$password 		= $GLOBALS['password'];
		$dbName			= $GLOBALS['dbName'];

		$dbLink = mysqli_connect($servername, $username, $password, $dbName);
		if (mysqli_connect_errno()){
		  echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$result = mysqli_query($dbLink, $query);
		
		
		/* if($completeArr[0]['storagetype'] == 'html'){
			if(isset($completeArr[1]['vast_video_clickthrough_url']) && $completeArr[1]['vast_video_clickthrough_url']){
				$url	= str_replace('%26', '&', $completeArr[1]['vast_video_clickthrough_url']);
				//echo $url;die;
				header('Location: '.$url);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $completeArr[1]['third_party_click']);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				$output = curl_exec($ch);
				curl_close($ch);
			}
		}else{
			
		} */
		if($bannerdata['url']){
			$url	= str_replace('%26', '&', $bannerdata['url']);
			//echo $url;die;
			header('Location: '.$url);
		}else if(isset($completeArr[1]['vast_video_clickthrough_url']) && $completeArr[1]['vast_video_clickthrough_url']){
			$url	= str_replace('%26', '&', $completeArr[1]['vast_video_clickthrough_url']);
			//echo $url;die;
			header('Location: '.$url);
		}
		
		
		
		
	
	?>