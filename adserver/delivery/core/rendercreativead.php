<?php
	
	include_once $_SERVER['DOCUMENT_ROOT']."/adserver/delivery/config/delivery_config.php";
	include_once $includePathLimitation.'campaignstatus.php';
	//echo $cachePath;
	function renderad(){
		if(isset($_GET['zoneid'])){
			$now 				= time();
			$zoneid				= $_GET['zoneid'];
			if(isset($_GET['domain'])){
				$ip						= $_GET['domain'];
			}
			
			$dfpClickUrl			= '';
			$protocol				= '';
			$protocol 				= $_SERVER['SERVER_PROTOCOL'];
			//echo $_GET['adurl'];die;
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
			//echo '<pre>';print_r($adZoneAssocData);die;

			if((!empty($adZoneAssocData))){
					$adId					= $adZoneAssocData['ad_id'];
					$my_file				= $GLOBALS['cachePath']."delivery_ad_".$adId.".php";
					
					$bannerdata1 			= json_decode(file_get_contents($my_file), true);
					$bannerdata				= $bannerdata1[0];
					//echo '<pre>';print_r($bannerdata);die;

				
					$result					= true;
					$campaignstatus			= checkCampaignStatus($bannerdata);
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
						$renderdata	= html5CreativeCode($bannerdata,$zoneid,$protocol=null,$dfpClickUrl, $ip=null,$iframe=null);
					}else{
						$renderdata	= "";
						
					}
					echo MAX_javascriptToHTML($renderdata, 'MS_'.substr(md5(uniqid('', 1)), 0, 8));
				}
			}
	}
	
		function html5CreativeCode($banner, $zoneid=null,$protocol=null,$dfpClickUrl, $ip=null,$iframe=null){
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
			//echo $clickurl;die;
			//echo '<pre>';print_r($banner);die;
			//$player	 = "<a href='".$clickurl."' target='_blank'";
			//$player	.="><img src='".$src."/banners/images/".$banner['filename']."' width='".$banner['width']."' height='".$banner['height']."' /></a>";
			//echo $clickurl;die;
			if($banner['htmltemplate']){
				$width 			= $banner['width'];
				if(!($dfpClickUrl  && $width == '1' )){
					//echo $clickurl;
					$player		= $banner['htmltemplate'];
					$player 	= str_replace("{clickurl}", "$clickurl", $player);
					
					$player	.="<img src='".$src."core/lgimpr.php?bannerid=".$banner['bannerid']."&zoneid=".$zoneid."&cb=".$cb."' width='1' height='1' alt=''>";
					if($banner['tracking_pixel']){
						$buster		= $cb;
						$trackingPixel = str_replace("{cache}","$buster",$banner['tracking_pixel']);
						$player	.="<img src='".$trackingPixel."' width='1' height='1' alt=''>";
					}
					return $player;
				}else{
					$creativeCode = richMediaCode($banner,$zoneid,$src, $dfpClickUrl,$cb);
					return $creativeCode;
					
				}
				
			}else{
				return "";
			}
			
		}
		
		function richMediaCode($banner, $zoneid, $src, $dfpClickUrl,$cb){
			//echo '<pre>';print_r($banner);die;
			$type = $banner['rich_media_type'];		
			if($type == 1){
				$fileName = 'expandorightleft';
				
			}else if($type ==2){
				$fileName = 'expandotopbottom';
				
			}else if($type == 3){
				$fileName  = 'pagepusher';
			
			}else if($type == 4){
				$fileName  = 'overlay';
				
			}
			
			$ext 			= '.js';
			$fileNameExt 	= $fileName.$ext;
			$filePath 		= $GLOBALS['deliveryPath'].'buster/'.$fileNameExt;
			
			//update buster files with image and click url and tracking pixel
				$creativeImage1					= $GLOBALS['deliveryPath'].'banners/images/'.$banner['filename'];
				$creativeImage2					= $GLOBALS['deliveryPath'].'banners/images/'.$banner['filename2'];
				$lgimprTracker					= $src."core/lgimpr.php?bannerid=".$banner['bannerid']."&zoneid=".$zoneid."&cb=".$cb;
			
				$thirdParyTracker	= '';
				if($banner['tracking_pixel']){
					$buster			= $cb;
					$trackingPixel  = str_replace("{cache}","$buster",$banner['tracking_pixel']);
					$thirdParyTracker		= '<img src="'.$trackingPixel.'" width="1" height="1" alt="">';
				}
				$busterFileName 				= $filePath;
				$busterContent   	    		= file_get_contents($busterFileName);
				$busterContent 					= str_replace("{imagePath1}", "$creativeImage1", $busterContent);
				$busterContent 					= str_replace("{imagePath2}", "$creativeImage2", $busterContent);
				$busterContent 					= str_replace("{clickurl}", "$dfpClickUrl", $busterContent);
				$busterContent 					= str_replace("{lgimprTracker}", $lgimprTracker, $busterContent);
				$busterContent 					= str_replace("{thirdParyTracker}", $thirdParyTracker, $busterContent);
				$busterPath						= $GLOBALS['includePathDelivery'].'buster/'.$fileNameExt;
				$bannerid						= $banner['bannerid'];
				$putFilePath 					= $GLOBALS['includePathDelivery'].'bustercache/'.$bannerid.'_'.$fileNameExt;
				file_put_contents($putFilePath, $busterContent);
				$getFilePath					= $GLOBALS['deliveryPath'].'bustercache/'.$bannerid.'_'.$fileNameExt;;

			
			$coreJs		    	= '<script src="'.$GLOBALS['deliveryPath'].'assets/js/jQuery-2.1.4.min.js'.'" type="text/javascript"></script>';
			$scriptFile 		= '<script src='.$getFilePath.'></script>';
			$ifm 				= "<script type='text/javascript'> 
			var referenceabc	= '".$dfpClickUrl."';
			</script>";
			return $coreJs.$scriptFile.$ifm;
			
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