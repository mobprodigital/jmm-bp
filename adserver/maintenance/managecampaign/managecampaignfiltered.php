<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/adserver/config/mtnc_config.php';
require_once '../db/connection.php';

function updateDataIntertermediate($oDbh){
		// Copy stats over from the existing table to the new table, rolling up according to each ad's offset
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

           GROUP BY
                m.campaignid,m.campaignname
        
        ");
		
		
		if ($result){
			while ($row = mysqli_fetch_assoc($result)){
				echo '<pre>';print_r($result);
			}
		}
}

function manageCampaigns($oDbh){
		error_reporting(E_ERROR | E_PARSE);

        $report 		= "\n";
        $prefix 		= 'rv';
        $oNowDate 		= date('Y-m-d');
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
                ca.clientid = cl.clientid
                AND
                ((
                    ca.status = 1 AND
                    (
                        ca.expire_time != '0000:00:00'
                        OR
                        (
                            ca.views > 0
                            OR
                            ca.clicks > 0
                            OR
                            ca.conversions > 0
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
					");
			
		
					if ($singleCampaignResult){
						while ($valuesRow = mysqli_fetch_assoc($singleCampaignResult)){
							//echo '<pre>';print_r($valuesRow);
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
									$result 		= update($oDbh, $campaignid, $status);
									
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
	$oDbh		= connect();
	manageCampaigns($oDbh);


?>