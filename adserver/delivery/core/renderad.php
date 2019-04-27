<?php
	include_once $_SERVER['DOCUMENT_ROOT']."/adserver/delivery/config/delivery_config.php";
	include_once $includePathLimitation.'campaignstatus.php';

	function renderad(){
		if(isset($_GET['zoneid'])){
			$now 					= time();
			$zoneid					= $_GET['zoneid'];
			//$ip						= $_GET['domain'];
			$dfpClickUrl			= '';
			$protocol				= '';
			$protocol 				= $_SERVER['SERVER_PROTOCOL'];
			if(isset($_GET['adurl'])){
				$Original_url		= $_SERVER['QUERY_STRING'];
				$first_index 		= stripos($Original_url, "&click");
				$first_string 		= substr($Original_url, $first_index);
				$second_index 		= stripos($first_string, "&ord=");
				$dfpClickUrl 		= substr($first_string, strlen("&click")+1,$second_index-strlen("&ord=")-2);
			}
			
			$clientIP				= $_SERVER['REMOTE_ADDR'];
			
			
			///$zoneFile			= $GLOBALS['cachePath']."delivery_zone_".$zoneid.".php";
			//$zoneData			= json_decode(file_get_contents($zoneFile), true);
			
			$adZoneAssocFile	= $GLOBALS['cachePath']."delivery_ad_zone_".$zoneid.".php";
			$adZoneAssocData	= json_decode(file_get_contents($adZoneAssocFile), true);

			if((!empty($adZoneAssocData))){
				
				$adId				= $adZoneAssocData['ad_id'];
				$my_file			= $GLOBALS['cachePath']."delivery_ad_".$adId.".php";

				$bannerdata1 			= json_decode(file_get_contents($my_file), true);
				$bannerdata				= $bannerdata1[0];
				//echo '<pre>';print_r($bannerdata);die;

				$result								= true;
				$campaignstatus						= checkCampaignStatus($bannerdata);
				if($campaignstatus){
					$result  = true;
					$row['acl_plugins']			= $bannerdata['acl_plugins'];
					if(strlen($row['acl_plugins'])) {
						include_once $GLOBALS['includePathLimitation'].'validate.php';
						$acl_plugins = explode('and', $bannerdata['compiledlimitation']);
						foreach ($acl_plugins as $acl_plugin) {
							@eval('$result = (' . $acl_plugin . ');');
						}
					}
				}else{
					$result  = false;
				}
				

				
				
				
				
				if($result){
					$renderdata	= bannerCode($bannerdata,$zoneid,$protocol=null,$dfpClickUrl, $ip=null,$iframe=null);
				}else{
					$renderdata	= "";
					
				}
				echo MAX_javascriptToHTML($renderdata, 'MS_'.substr(md5(uniqid('', 1)), 0, 8));
			}
			
		}
	}
	
		function bannerCode($banner,$zoneid=null,$protocol=null,$dfpClickUrl, $ip=null,$iframe=null){
			
			//echo '<pre>';print_r($banner);die;
			$src		= $GLOBALS['deliveryPath'];
			if($protocol == 'HTTP/1.1' || $protocol == 'HTTP/1.0'){
				$src	= str_replace('https','http',$src);
			}
			$cb			= substr(md5(uniqid('', 1)), 0, 8);
			if(isset($banner['url']) && $banner['url']){
				if($dfpClickUrl){
					$clickurl					= $dfpClickUrl;
				}else{
					$clickurl					= $src.'core/ckvast.php?bannerid='.$banner['bannerid']."&zoneid=".$zoneid."&cb=".$cb;
				}
			}else{
				$clickurl					= '';
				$clickurl					= $src().'core/ckvast.php?bannerid='.$banner['bannerid']."&zoneid=".$zoneid."&cb=".$cb;
			}
			$player	 = "<a href='".$clickurl."' target='_blank'";
			$player	.="><img src='".$src."/banners/images/".$banner['filename']."' width='".$banner['width']."' height='".$banner['height']."' /></a>";
			$player	.="<img src='".$src."core/lgimpr.php?bannerid=".$banner['bannerid']."&zoneid=".$zoneid."&cb=".$cb."' width='1' height='1' alt=''>";
			if($banner['tracking_pixel']){
				$buster		= $cb;
				$trackingPixel = str_replace("{cache}", "$buster", $banner['tracking_pixel']);
				$player	.="<img src='".$trackingPixel."' width='1' height='1' alt=''>";

			}
			return $player;
		}
		
		
	
	
		function MAX_javascriptToHTML($string, $varName, $output = true, $localScope = true){
			$jsLines = array();
			$search[] = "\\"; $replace[] = "\\\\";
			$search[] = "\r"; $replace[] = '';
			$search[] = '"'; $replace[] = '\"';
			$search[] = "'"; $replace[] = "\\'";
			$search[] = '<'; $replace[] = '<"+"';
			$string 		= str_replace($search, $replace, $string);
			$lines 			= explode("\n", $string);
			foreach ($lines AS $line) {
				if(trim($line) != '') {
					$jsLines[] = $varName . ' += "' . trim($line) . '\n";';
				}
			}
			$buffer = (($localScope) ? 'var ' : '') . $varName ." = '';\n";
			$buffer .= implode("\n", $jsLines);
			if ($output == true) {
				$buffer .= "\ndocument.write({$varName});\n";
			}
			return $buffer;
		}


		


renderad();
		
?>