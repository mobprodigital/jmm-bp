<?php 
	function checkCampaignStatus($bannerData){
		//echo '<pre>';print_r($bannerData);die;
		if(!empty($bannerData)){
			$result          = true;
			$activationTime  = $bannerData['activate_time'];
			$expirationTime  = $bannerData['expire_time'];
			$campaignStatus  = $bannerData['campaign_status'];
			$bannerStatus    = $bannerData['banner_status'];
			$deliveredImpr	 = 1000;//$bannerData['deliveredImpr'];
			$campaignTotalLimit             = $bannerData['views'];
			$activationTimestamp			= strtotime($activationTime.' 00:00:00');
			$expirationTimestamp			= strtotime($expirationTime.' 23:59:59');
			$currDate		 				= date('Y-m-d H:i:s');
			$currDateTimestamp				= strtotime($currDate);
			if($campaignStatus != 0){
				//echo 'campaignStatus true'.'<br>';
				
				if($currDateTimestamp >  $activationTimestamp){
					//echo 'activationTimestamp true'.'<br>';

					if($currDateTimestamp <  $expirationTimestamp){
						//echo 'expirationTimestamp true'.'<br>';

						if(checkCampaignImpressionLimit($campaignTotalLimit, $deliveredImpr)){
						//	echo 'checkCampaignImpressionLimit true'.'<br>';
							if(checkCampaignCappign($bannerData)){
								//echo 'checkCampaignCappign true';die;
								if($bannerStatus == 0){
									$result	= true;
								}else{
									$result = false;
								}
							}else{
								return false;
							}
							
						}else{
							return false;
						}
							
							
						}else{
							$result	= false;
						}
				}else{
					$result	= false;
				}
			}else{
				$result	= false;
			}
			return $result;
		}else{
			return true;
		}
	}
	
	function checkCampaignImpressionLimit($campaignTotalLimit, $totalDelivered){
		//echo $campaignTotalLimit.'<br>'.$totalDelivered;die;
		if($campaignTotalLimit != -1){
			if($campaignTotalLimit > $totalDelivered){
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
		
			
	}
	
	function checkCampaignCappign($bannerData){
		//echo '<pre>';print_r($bannerData);die;
		$cappingAmount = $bannerData['capping_amount'];
		if($cappingAmount != 0){
			$cappingPeriod  = getTimeStamp($bannerData['capping_period_value'],$bannerData['capping_period_type']);
			$domain 		= ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
			if(!isset($_COOKIE['JMMID'])){
				$uniqueViewerId 		= md5(uniqid('', true));
				setCookie("JMMID",$uniqueViewerId,time() + $cappingPeriod, '/', $domain,false);
				if(isset($_COOKIE['JMMCAP'])){
					setCookie("JMMCAP",$_COOKIE['JMMCAP'],time() - $cappingPeriod, '/', $domain,false);
				}
				return true;
			} else {
				if(isset($_COOKIE['JMMID'])){
					if(!isset($_COOKIE['JMMCAP'])){
						setCookie("JMMCAP",1,time() + $cappingPeriod, '/', $domain,false);
						return true;
					}else{
						$cCap = $cappingAmount;
						
						if($_COOKIE['JMMCAP'] <= $cCap-2){
							$cVal			= $_COOKIE['JMMCAP'];
							$newCVal		= $cVal + 1;
							$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;
							setCookie("JMMCAP",$newCVal, time() + $cappingPeriod, '/', $domain,false);
							return true;
				
						}else{
							return false;
						}
					}
				}
			}
		}else{
			return true;
		}
		

	}
	
	
	function getTimeStamp($capping_period_value, $capping_period_type){
		switch($capping_period_type){
			case 'hours':
				$timestamp =3600;
				break;
			case 'days':
				$timestamp = 86400;
				break;
			case 'months':
				$timestamp =(86400 * 30);
				break;
			case 'years':
				$timestamp  = (86400 * 30 * 365);
				break;
		}
		return ($timestamp * $capping_period_value);
	}
	
	
	
	function checkCampaignDailyLimit($campaignDailyLimit, $todayDelivered){
	}
	
	
	
	
	
	
	
	


?>