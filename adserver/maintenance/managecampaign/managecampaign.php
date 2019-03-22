<?php
function manageCampaigns($oDate){
       
        $report = "\n";
        // Select all campaigns in the system, where:
        //    The campaign is ACTIVE and:
        //    - The end date stored for the campaign is not null; or
        //    - The campaign has a lifetime impression, click or conversion
        //      target set.
        //
        //    That is:
        //    - It is possible for the active campaign to be automatically
        //      stopped, as it has a valid end date. (No limitations are
        //      applied to those campaigns tested, as the ME may not have
        //      run for a while, and if so, even campaigns with an end date
        //      of many, many weeks ago should be tested to ensure they are
        //      [belatedly] halted.)
        //    - It is possible for the active campaign to be automatically
        //      stopped, as it has at leaast one lifetime target that could
        //      have been reached.
        //
        //    The campaign is INACTIVE and:
        //    - The start date stored for the campaign is not null; and
        //    - The weight is greater than zero; and
        //    - The end date stored for the campaign is either null, or is
        //      greater than "today" less one day.
        //
        //    That is:
        //    - It is possible for the inactive campaign to be automatically
        //      started, as it has a valid start date. (No limitations are
        //      applied to those campaigns tested, as the ME may not have run
        //      for a while, and if so, even campaigns with an activation date
        //      of many, many weeks ago should be tested to ensure they are
        //      [belatedy] enabled.)
        //    - The campaign is not in a permanently inactive state, as a
        //      result of the weight being less then one, which means that
        //      it cannot be activated.
        //    - The test to start the campaign is unlikely to fail on account
        //      of the end date.
        $prefix 	= 'rv';
        $oNowDate 	= date('Y-m-d H:i:s');
        

        $query = "
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
                {$prefix}campaigns AS ca,
                {$prefix}clients AS cl
            WHERE
                ca.clientid = cl.clientid
                AND
                ((
                    ca.status = ".$this->oDbh->quote(OA_ENTITY_STATUS_RUNNING, 'integer')." AND
                    (
                        ca.expire_time IS NOT NULL
                        OR
                        (
                            ca.views > 0
                            OR
                            ca.clicks > 0
                            OR
                            ca.conversions > 0
                        )
                    )
                ) OR (
                    ca.status = ".$this->oDbh->quote(OA_ENTITY_STATUS_AWAITING, 'integer')." AND
                    (
                        ca.activate_time <= " . $this->oDbh->quote($oNowDate->getDate(DATE_FORMAT_ISO), 'timestamp') . "
                        AND
                        (
                            ca.weight > 0
                            OR
                            ca.priority > 0
                        )
                        AND
                        (
                            ca.expire_time >= " . $this->oDbh->quote($oNowDate->getDate(DATE_FORMAT_ISO), 'timestamp') . "
                            OR
                            ca.expire_time IS NULL
                        )
                    )
                ))
            ORDER BY
                advertiser_id";
        OA::debug('- Requesting campaigns to test for activation/deactivation', PEAR_LOG_DEBUG);
        $rsResult = $this->oDbh->query($query);
        if (PEAR::isError($rsResult)) {
            return MAX::raiseError($rsResult, MAX_ERROR_DBFAILURE, PEAR_ERROR_DIE);
        }
        OA::debug('- Found ' . $rsResult->numRows() . ' campaigns to test for activation/deactivation', PEAR_LOG_DEBUG);
        
		while ($aCampaign = $rsResult->fetchRow()) {
            if ($aCampaign['status'] == OA_ENTITY_STATUS_RUNNING) {
                // The campaign is currently running, look at the campaign
                $disableReason = 0;
                $canExpireSoon = false;
                if (($aCampaign['targetimpressions'] > 0) ||
                    ($aCampaign['targetclicks'] > 0) ||
                    ($aCampaign['targetconversions'] > 0)) {
                    OA::debug('  - Selecting impressions, clicks and conversions for this running campaign ID = '.$aCampaign['campaign_id'], PEAR_LOG_DEBUG);
                    // The campaign has an impression, click and/or conversion target,
                    // so get the sum total statistics for the campaign
                    $query = "
                        SELECT
                            SUM(dia.impressions) AS impressions,
                            SUM(dia.clicks) AS clicks,
                            SUM(dia.conversions) AS conversions
                        FROM
                            ".$this->oDbh->quoteIdentifier($aConf['table']['prefix'].$aConf['table']['data_intermediate_ad'],true)." AS dia,
                            ".$this->oDbh->quoteIdentifier($aConf['table']['prefix'].$aConf['table']['banners'],true)." AS b
                        WHERE
                            dia.ad_id = b.bannerid
                            AND b.campaignid = {$aCampaign['campaign_id']}";
                    $rsResultInner = $this->oDbh->query($query);
                    $valuesRow = $rsResultInner->fetchRow();
                    if ((isset($valuesRow['impressions'])) || (!is_null($valuesRow['clicks'])) || (!is_null($valuesRow['conversions']))) {
                        // There were impressions, clicks and/or conversions for this
                        // campaign, so find out if campaign targets have been passed
                        if (!isset($valuesRow['impressions'])) {
                            // No impressions
                            $valuesRow['impressions'] = 0;
                        }
                        if (!isset($valuesRow['clicks'])) {
                            // No clicks
                            $valuesRow['clicks'] = 0;
                        }
                        if (!isset($valuesRow['conversions'])) {
                            // No conversions
                            $valuesRow['conversions'] = 0;
                        }
                        if ($aCampaign['targetimpressions'] > 0) {
                            if ($aCampaign['targetimpressions'] <= $valuesRow['impressions']) {
                                // The campaign has an impressions target, and this has been
                                // passed, so update and disable the campaign
                                $disableReason |= OX_CAMPAIGN_DISABLED_IMPRESSIONS;
                            }
                        }
                        if ($aCampaign['targetclicks'] > 0) {
                            if ($aCampaign['targetclicks'] <= $valuesRow['clicks']) {
                                // The campaign has a click target, and this has been
                                // passed, so update and disable the campaign
                                $disableReason |= OX_CAMPAIGN_DISABLED_CLICKS;
                            }
                        }
                        if ($aCampaign['targetconversions'] > 0) {
                            if ($aCampaign['targetconversions'] <= $valuesRow['conversions']) {
                                // The campaign has a target limitation, and this has been
                                // passed, so update and disable the campaign
                                $disableReason |= OX_CAMPAIGN_DISABLED_CONVERSIONS;
                            }
                        }
                        if ($disableReason) {
                            // One of the campaign targets was exceeded, so disable
                            $message = '  - Exceeded a campaign quota: Deactivating campaign ID ' .
                                       "{$aCampaign['campaign_id']}: {$aCampaign['campaign_name']}";
                            OA::debug($message, PEAR_LOG_INFO);
                            $report .= $message . "\n";
                            $doCampaigns = OA_Dal::factoryDO('campaigns');
                            $doCampaigns->campaignid = $aCampaign['campaign_id'];
                            $doCampaigns->find();
                            $doCampaigns->fetch();
                            $doCampaigns->status = OA_ENTITY_STATUS_EXPIRED;
                            $result = $doCampaigns->update();
                            if ($result == false) {
                                return MAX::raiseError($rows, MAX_ERROR_DBFAILURE, PEAR_ERROR_DIE);
                            }
                            phpAds_userlogSetUser(phpAds_userMaintenance);
                            phpAds_userlogAdd(phpAds_actionDeactiveCampaign, $aCampaign['campaign_id']);
                        } else {
                            // The campaign didn't have a diable reason,
                            // it *might* possibly be diabled "soon"...
                            $canExpireSoon = true;
                        }
                    }
                }
                // Does the campaign need to be disabled due to the date?
                if (!empty($aCampaign['end'])) {
                    // The campaign has a valid end date, stored in in UTC
                    $oEndDate = new Date($aCampaign['end']);
                    $oEndDate->setTZByID('UTC');
                    if ($oDate->after($oEndDate)) {
                        // The end date has been passed; disable the campaign
                        $disableReason |= OX_CAMPAIGN_DISABLED_DATE;
                        $message = "  - Passed campaign end time of '" . $oEndDate->getDate() . " UTC" .
                                   "': Deactivating campaign ID {$aCampaign['campaign_id']}: {$aCampaign['campaign_name']}";
                        OA::debug($message, PEAR_LOG_INFO);
                        $report .= $message . "\n";
                        $doCampaigns = OA_Dal::factoryDO('campaigns');
                        $doCampaigns->campaignid = $aCampaign['campaign_id'];
                        $doCampaigns->find();
                        $doCampaigns->fetch();
                        $doCampaigns->status = OA_ENTITY_STATUS_EXPIRED;
                        $result = $doCampaigns->update();
                        if ($result == false) {
                            return MAX::raiseError($rows, MAX_ERROR_DBFAILURE, PEAR_ERROR_DIE);
                        }
                        phpAds_userlogSetUser(phpAds_userMaintenance);
                        phpAds_userlogAdd(phpAds_actionDeactiveCampaign, $aCampaign['campaign_id']);
                    } else {
                        // The campaign wasn't disabled based on the end
                        // date, to it *might* possibly be disabled "soon"...
                        $canExpireSoon = true;
                    }
                }
                if ($disableReason) {
                    // The campaign was disabled, so send the appropriate
                    // message to the campaign's contact
                    $query = "
                        SELECT
                            bannerid AS advertisement_id,
                            description AS description,
                            alt AS alt,
                            url AS url
                        FROM
                            ".$this->oDbh->quoteIdentifier($aConf['table']['prefix'].$aConf['table']['banners'],true)."
                        WHERE
                            campaignid = {$aCampaign['campaign_id']}";
                    OA::debug("  - Getting the advertisements for campaign ID {$aCampaign['campaign_id']}", PEAR_LOG_DEBUG);
                    $rsResultAdvertisement = $this->oDbh->query($query);
                    if (PEAR::isError($rsResultAdvertisement)) {
                        return MAX::raiseError($rsResultAdvertisement, MAX_ERROR_DBFAILURE, PEAR_ERROR_DIE);
                    }
                    while ($advertisementRow = $rsResultAdvertisement->fetchRow()) {
                        $advertisements[$advertisementRow['advertisement_id']] = array(
                            $advertisementRow['description'],
                            $advertisementRow['alt'],
                            $advertisementRow['url']
                        );
                    }
                    if ($aCampaign['send_activate_deactivate_email'] == 't') {
                        OA::debug("  - Sending campaign deactivated email ", PEAR_LOG_DEBUG);
                        $oEmail->sendCampaignActivatedDeactivatedEmail($aCampaign['campaign_id'], $disableReason);

                        // Also send campaignDeliveryEmail for the campaign we just deactivated.
                        $doClients = OA_Dal::staticGetDO('clients', $aCampaign['advertiser_id']);
                        $aAdvertiser = $doClients->toArray();
                        OA::debug("  - Sending campaign delivery email ", PEAR_LOG_DEBUG);
                        $oStart = new Date($aAdvertiser['reportlastdate']);
                        $oEnd = new Date($oDate);
                        // Set end date to tomorrow so we get stats for today.
                        $oEnd->addSpan(new Date_Span('1-0-0-0'));
                        $oEmail->sendCampaignDeliveryEmail($aAdvertiser, $oStart, $oEnd, $aCampaign['campaign_id']);
                    }
                } else if ($canExpireSoon) {
                    // The campaign has NOT been deactivated - test to see if it will
                    // be deactivated "soon", and send email(s) warning of this as required
                    OA::debug("  - Sending campaign 'soon deactivated' email ", PEAR_LOG_DEBUG);
                    $oEmail->sendCampaignImpendingExpiryEmail($oDate, $aCampaign['campaign_id']);
                }
            } elseif (!empty($aCampaign['start'])) {
                // The campaign is awaiting activation and has a valid start date, stored in UTC
                $oStartDate = new Date($aCampaign['start']);
                $oStartDate->setTZByID('UTC');
                // Find out if there are any impression, click or conversion targets for
                // the campaign (i.e. if the target values are > 0)
                $remainingImpressions = 0;
                $remainingClicks      = 0;
                $remainingConversions = 0;
                if (($aCampaign['targetimpressions'] > 0) ||
                    ($aCampaign['targetclicks'] > 0) ||
                    ($aCampaign['targetconversions'] > 0)) {
                    OA::debug("  - The campaign ID ".$aCampaign['campaign_id']." has an impression, click and/or conversion target, requesting impressions so far", PEAR_LOG_DEBUG);
                    $query = "
                        SELECT
                            SUM(dia.impressions) AS impressions,
                            SUM(dia.clicks) AS clicks,
                            SUM(dia.conversions) AS conversions
                        FROM
                            ".$this->oDbh->quoteIdentifier($aConf['table']['prefix'].$aConf['table']['data_intermediate_ad'],true)." AS dia,
                            ".$this->oDbh->quoteIdentifier($aConf['table']['prefix'].$aConf['table']['banners'],true)." AS b
                        WHERE
                            dia.ad_id = b.bannerid
                            AND b.campaignid = {$aCampaign['campaign_id']}";
                    $rsResultInner = $this->oDbh->query($query);
                    $valuesRow = $rsResultInner->fetchRow();
                    // Set the remaining impressions, clicks and conversions for the campaign
                    $remainingImpressions = $aCampaign['targetimpressions'] - $valuesRow['impressions'];
                    $remainingClicks      = $aCampaign['targetclicks']      - $valuesRow['clicks'];
                    $remainingConversions = $aCampaign['targetconversions'] - $valuesRow['conversions'];
                }
                // In order for the campaign to be activated, need to test:
                // 1) That there is no impression target (<= 0), or, if there is an impression target (> 0),
                //    then there must be remaining impressions to deliver (> 0); and
                // 2) That there is no click target (<= 0), or, if there is a click target (> 0),
                //    then there must be remaining clicks to deliver (> 0); and
                // 3) That there is no conversion target (<= 0), or, if there is a conversion target (> 0),
                //    then there must be remaining conversions to deliver (> 0)
                if ((($aCampaign['targetimpressions'] <= 0) || (($aCampaign['targetimpressions'] > 0) && ($remainingImpressions > 0))) &&
                    (($aCampaign['targetclicks']      <= 0) || (($aCampaign['targetclicks']      > 0) && ($remainingClicks      > 0))) &&
                    (($aCampaign['targetconversions'] <= 0) || (($aCampaign['targetconversions'] > 0) && ($remainingConversions > 0)))) {
                    $message = "- Passed campaign start time of '" . $oStartDate->getDate() . " UTC" .
                               "': Activating campaign ID {$aCampaign['campaign_id']}: {$aCampaign['campaign_name']}";
                    OA::debug($message, PEAR_LOG_INFO);
                    $report .= $message . "\n";
                    $doCampaigns = OA_Dal::factoryDO('campaigns');
                    $doCampaigns->campaignid = $aCampaign['campaign_id'];
                    $doCampaigns->find();
                    $doCampaigns->fetch();
                    $doCampaigns->status = OA_ENTITY_STATUS_RUNNING;
                    $result = $doCampaigns->update();
                    if ($result == false) {
                        return MAX::raiseError($rows, MAX_ERROR_DBFAILURE, PEAR_ERROR_DIE);
                    }
                    phpAds_userlogSetUser(phpAds_userMaintenance);
                    phpAds_userlogAdd(phpAds_actionActiveCampaign, $aCampaign['campaign_id']);
                    if ($aCampaign['send_activate_deactivate_email'] == 't') {
                        OA::debug("  - Sending activation email for campaign ID ". $aCampaign['campaign_id'], PEAR_LOG_DEBUG);
                        $oEmail->sendCampaignActivatedDeactivatedEmail($aCampaign['campaign_id']);
                    }
                }
            }
        }
    }


?>