<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/adserver/config/mtnc_config.php';
require_once '../db/connection.php';

class OA_Maintenance_RollupStats{
	public $prefix			= 'rv_';
	/*function _rollUpHourlyStatsToDaily($oDate,$oDbh){
			$sDate 		= $oDate;
			$updated 	= date('Y-m-d h:i:s');
			mysqli_query($oDbh,"DROP TABLE IF EXISTS {$this->prefix}data_summary_ad_hourly_rolledup");
			mysqli_query($oDbh,"CREATE TABLE {$this->prefix}data_summary_ad_hourly_rolledup LIKE {$this->prefix}data_summary_ad_hourly;");
			mysqli_query($oDbh,"INSERT INTO {$this->prefix}data_summary_ad_hourly_rolledup (
                               date_time,
							   ad_id,
							   creative_id,
							   zone_id,
							   requests,
							   impressions,
							   clicks,
							   conversions,
                               total_basket_value,
							   total_num_items,
							   total_revenue,
							   total_cost,
							   total_techcost,
							   updated )
                           SELECT
						       DATE_FORMAT(dsah.date_time, '%Y-%m-%d') AS day,
							   dsah.ad_id,
							   dsah.creative_id,
							   dsah.zone_id,
							   SUM(dsah.requests),
							   SUM(dsah.impressions),
							   SUM(dsah.clicks),
							   SUM(dsah.conversions),
                               SUM(dsah.total_basket_value),
							   SUM(dsah.total_num_items),
							   SUM(dsah.total_revenue),
							   SUM(dsah.total_cost),
							   SUM(dsah.total_techcost),
							   '{$updated}'
                           FROM
                               {$this->prefix}data_summary_ad_hourly AS dsah
                           WHERE
							" . $this->getWhereDate($sDate, $sDate) . "
                           GROUP BY
                               day, creative_id, zone_id;
                           ");
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
	
	function update($oDbh, $campaignId, $campaignStatus){
		//echo $campaignId.'<br>';
		$query 		= "update campaigns set status = ".$campaignStatus." where campaignid=".$campaignId;
		mysqli_query($oDbh, $query);
	}
	
	
	
	
	function updateCacheForDailyStatsBackup($sDate, $oDbh){
			
		
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
	
	function updateCacheForAllStats($sDate, $oDbh){
				
		
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
	}*/
	
	function manageCampaigns($oDbh){
		error_reporting(E_ERROR | E_PARSE);

        $report 		= "\n";
        $prefix 		= 'rv';
        $sDate 		= date('Y-m-d');
		$result	= mysqli_query($oDbh, "
            SELECT
                cl.clientid AS advertiser_id,
                cl.account_id AS advertiser_account_id,
                cl.agencyid AS agency_id,
                cl.contact AS contact,
                cl.email AS email,
                cl.reportdeactivate AS send_activate_deactivate_email,
                ca.campaignid AS campaign_id,
                ca.campaignname AS campaign_name,
                ca.target_impression AS targetimpressions,
                ca.target_click AS targetclicks,
                ca.target_conversion AS targetconversions,
                ca.status AS status,
                ca.activate_time AS start,
                ca.expire_time AS end
            FROM
                campaigns AS ca,
                clients AS cl
            WHERE
                ca.clientid = cl.clientid
                AND
                ((
                    ca.status = 1 AND
                    (
                        ca.expire_time != '0000:00:00'
                        OR
                        (
                            ca.target_impression > 0
                            OR
                            ca.target_click > 0
                            OR
                            ca.target_conversion > 0
                        )
                    )
                ) 
			)
            ORDER BY
                advertiser_id"
			);
				
		if ($result){

		while ($aCampaign = mysqli_fetch_assoc($result)){
				//echo '<pre>';print_r($aCampaign);
			if ($aCampaign['status'] == 1) {
                // The campaign is currently running, look at the campaign
                $disableReason = 0;
                if (($aCampaign['targetimpressions'] > 0) ||
                    ($aCampaign['targetclicks'] > 0) ||
                    ($aCampaign['targetconversions'] > 0)) {
                    // The campaign has an impression, click and/or conversion target,
                    // so get the sum total statistics for the campaign	
					
					
					
					$singleCampaignResult = mysqli_query($oDbh,"SELECT
						SUM(s.impressions) AS impressions,
						SUM(s.clicks) AS clicks,
						SUM(s.requests) AS requests
					FROM
						banners AS b,
						rv_data_summary_ad_hourly AS s
					WHERE
						b.bannerid = s.creative_id
						AND b.campaignid = {$aCampaign['campaign_id']}
					" . $this->getWhereDate($sDate, $sDate) . "

						
					");
			
		
					if ($singleCampaignResult){
						while ($valuesRow = mysqli_fetch_assoc($singleCampaignResult)){
							//echo '<pre>';print_r($valuesRow);die;
							if ((isset($valuesRow['impressions']))) {
								// There were impressions, clicks and/or conversions for this
								// campaign, so find out if campaign targets have been passed
								if (!isset($valuesRow['impressions'])) {
									// No impressions
									$valuesRow['impressions'] = 0;
								}
								
								if ($aCampaign['targetimpressions'] > 0) {
									if ($aCampaign['targetimpressions'] <= $valuesRow['impressions']) {
										// The campaign has an impressions target, and this has been
										// passed, so update and disable the campaign
										$disableReason ='OX_CAMPAIGN_DISABLED_IMPRESSIONS';
									}
								}
								
								if ($disableReason) {
									// One of the campaign targets was exceeded, so disable
									$campaignid 	= $aCampaign['campaign_id'];
									$status			= 0;
									$result 		= $this->update($oDbh, $campaignid, $status);
									
								}
							}
						}
					}
				}
			}
		}
    }
}
	
	
	function update($oDbh, $campaignId, $campaignStatus){
		//echo $campaignId.'<br>';
		$query 		= "update campaigns set status = ".$campaignStatus." where campaignid=".$campaignId;
		mysqli_query($oDbh, $query);
	}
	
	function getWhereDate($oStartDate, $oEndDate, $dateField = 's.date_time'){
		//echo $oStartDate;die;
        $where = '';
        if (isset($oStartDate) && $oStartDate) {
            $oStart = "'$oStartDate 00:00:00'";
            $where .='
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
	
	
date_default_timezone_set("Asia/Calcutta");
$oDate = Date('Y-m-d');
$oRollupStats = new OA_Maintenance_RollupStats();
$oDbh		= connect();
$oRollupStats->manageCampaigns($oDbh, $oDate);

//$oRollupStats->_rollUpHourlyStatsToDaily($oDate,$oDbh);
//$oRollupStats->updateCacheForDailyStats($oDate,$oDbh);

//not usable sum and update cache for 
//$oRollupStats->updateCacheForAllStats($oDate,$oDbh);

?>