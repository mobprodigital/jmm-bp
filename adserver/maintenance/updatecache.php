<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/adserver/config/mtnc_config.php';
require_once 'db/connection.php';
function updateCampaignsBannersCache($oDbh){
		error_reporting(E_ERROR | E_PARSE);
		$report 		= "\n";
        $prefix 		= 'rv';
        $oNowDate 		= date('Y-m-d');
		$result			= mysqli_query($oDbh, "
            SELECT
                cl.clientid AS advertiser_id,
                cl.account_id AS advertiser_account_id,
                cl.agencyid AS agency_id,
                cl.contact AS contact,
                cl.email AS email,
                cl.reportdeactivate AS send_activate_deactivate_email,
                ca.campaignid AS campaign_id,
                ca.campaignname AS campaign_name,
                ca.views AS targetimpressions,
                ca.clicks AS targetclicks,
                ca.conversions AS targetconversions,
                ca.status AS status,
                ca.activate_time AS start,
                ca.expire_time AS end
            FROM
                campaigns AS ca,
                clients AS cl
            WHERE
                ca.clientid = cl.clientid AND
				ca.expire_time != '0000:00:00'
			ORDER BY
                advertiser_id"
			);
				
		if ($result){
			while ($aCampaign = mysqli_fetch_assoc($result)){
				//echo '<pre>';print_r($aCampaign);die;

				$banners = mysqli_query($oDbh,
					"SELECT
						bannerid
					FROM
						banners
					WHERE
						campaignid = ".$aCampaign['campaign_id']."
					");
					
				if($banners){
					while ($bannersDetail = mysqli_fetch_assoc($banners)){
						//echo '<pre>';print_r($bannersDetail);
						$bannerid 				= $bannersDetail['bannerid'];
						$my_file				= CACHE_PATH."delivery_ad_".$bannerid.".php";
						$bannerdata1 			= json_decode(file_get_contents($my_file), true);
						//$bannerdata1[0]['today_delivered_impression']	= $row['impressions'];
						$bannerdata1[0]['campaign_status']	= $aCampaign['status'];

						file_put_contents($my_file, json_encode($bannerdata1));
					}
				}
			}
		}
	}

function updateCacheForDailyStats($sDate, $oDbh){
		$result = mysqli_query($oDbh,"SELECT
				m.campaignid,m.campaignname,m.target_impression,
				SUM(s.impressions) AS impressions,
                SUM(s.clicks) AS clicks,
                SUM(s.requests) AS requests
            FROM
                campaigns AS m,
                banners AS b,
                rv_data_summary_ad_hourly AS s
            WHERE
			
				m.campaignid = b.campaignid
                AND
                b.bannerid = s.creative_id
				" . $this->getWhereDate($sDate, $sDate) . "

           GROUP BY
                m.campaignid,m.campaignname
        
        ");
		
		//get all bannerid for this campaign
		if ($result){
			while ($row = mysqli_fetch_assoc($result)){
				//echo '<pre>';print_r($row);die;
				if($row['target_impression'] > 0){
					$banners = mysqli_query($oDbh,
					"SELECT
						bannerid
					FROM
						banners
					WHERE
						campaignid = ".$row['campaignid']."
					");
					
					if($banners){
						while ($bannersDetail = mysqli_fetch_assoc($banners)){
							$bannerid 				= $bannersDetail['bannerid'];
							$my_file				= CACHE_PATH."delivery_ad_".$bannerid.".php";
							$bannerdata1 			= json_decode(file_get_contents($my_file), true);
							$bannerdata1[0]['today_delivered_impression']	= $row['impressions'];
							file_put_contents($my_file, json_encode($bannerdata1));
							
						}
					}
				}
			}
		}
	}
	$oDbh		= connect();
	updateCampaignsBannersCache($oDbh);
?>