<?php 
	/**
     * Return invocation code for this plugin (codetype)
     *
     * @return string
     */
    function generateInvocationCode(){
        if (!empty($mi->campaignid)) {
            $mi->parameters['campaignid'] = "campaignid=".$mi->campaignid;
        }
        // The cachebuster for JS tags is auto-generated
        unset($mi->parameters['cb']);

        $buffer .= "<script type='text/javascript'><!--//<![CDATA[\n";
        // Support for 3rd party server clicktracking
        if (!empty($mi->thirdpartytrack)) {
            // Don't pass this in as a parameter... it is dealt with seperatly
            unset($mi->parameters['ct0']);
            $buffer .= "   document.MAX_ct0 = unescape('{$mi->macros['clickurl']}');\n\n";
        }
        $buffer .= "   var m3_u = (location.protocol=='https:'?'https:".MAX_commonConstructPartialDeliveryUrl($conf['file']['js'], true)."':'http:".MAX_commonConstructPartialDeliveryUrl($conf['file']['js'])."');\n";
        $buffer .= "   var m3_r = Math.floor(Math.random()*99999999999);\n";
        $buffer .= "   if (!document.MAX_used) document.MAX_used = ',';\n";
        // Removed the non-XHTML compliant "language='JavaScript'
        $buffer .= "   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);\n";
        if (count($mi->parameters) > 0) {
						//echo '<pre>';print_r($mi->parameters);die;

            $buffer .= "   document.write (\"?".implode ("&amp;", $mi->parameters)."\");\n";
        }
        $buffer .= "   document.write ('&amp;cb=' + m3_r);\n";

        // Don't pass in exclude unless necessary
        $buffer .= "   if (document.MAX_used != ',') document.write (\"&amp;exclude=\" + document.MAX_used);\n";

        if (empty($mi->charset)) {
            $buffer .= "   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));\n";
        } else {
            $buffer .= "   document.write ('&amp;charset=" . $mi->charset . "');\n";
        }
        $buffer .= "   document.write (\"&amp;loc=\" + escape(window.location));\n";
        $buffer .= "   if (document.referrer) document.write (\"&amp;referer=\" + escape(document.referrer));\n";
        $buffer .= "   if (document.context) document.write (\"&context=\" + escape(document.context));\n";

        // Only pass in the 3rd party click URL if it is required and (probably) a valid URL (i.e. not a macro like '%c')
        if (!empty($mi->thirdpartytrack)) {
            $buffer .= "   if ((typeof(document.MAX_ct0) != 'undefined') && (document.MAX_ct0.substring(0,4) == 'http')) {\n";
            $buffer .= "       document.write (\"&amp;ct0=\" + escape(document.MAX_ct0));\n   }\n";
        }
        // Pass in if the FlashObject - Inline code has already been passed in
        $buffer .= "   if (document.mmm_fo) document.write (\"&amp;mmm_fo=1\");\n";
        $buffer .= "   document.write (\"'><\\/scr\"+\"ipt>\");\n";
        $buffer .= "//]]>--></script>";

        if ($mi->extra['delivery'] != phpAds_ZoneText) {
            $buffer .= "<noscript>{$mi->backupImage}</noscript>\n";
        }
        return $buffer;
    }

	function MAX_adRenderImageBeacon($logUrl, $beaconId = 'beacon', $userAgent = null){
		if (!isset($userAgent) && isset($_SERVER['HTTP_USER_AGENT'])) {
		$userAgent = $_SERVER['HTTP_USER_AGENT'];
		}
		$beaconId .= '_{random}';
		if (isset($userAgent) && preg_match("#Mozilla/(1|2|3|4)#", $userAgent)
		&& !preg_match("#compatible#", $userAgent)) {
		$div = "<layer id='{$beaconId}' width='0' height='0' border='0' visibility='hide'>";
		$style = '';
		$divEnd = '</layer>';
		} else {
		$div = "<div id='{$beaconId}' style='position: absolute; left: 0px; top: 0px; visibility: hidden;'>";
		$style = " style='width: 0px; height: 0px;'";
		$divEnd = '</div>';
		}
		$beacon = "$div<img src='".htmlspecialchars($logUrl)."' width='0' height='0' alt=''{$style} />{$divEnd}";
		return $beacon;
	}

	function _adRenderImage(&$aBanner, $zoneId=0, $source='', $ct0='', $withText=false, $logClick=true, $logView=true, $useAlt=false, $richMedia=true, $loc='', $referer='', $context=array(), $useAppend=true){
		$conf = $GLOBALS['_MAX']['CONF'];
		$aBanner['bannerContent'] = $imageUrl = _adRenderBuildFileUrl($aBanner, $useAlt);
		if (!$richMedia) {
		return _adRenderBuildFileUrl($aBanner, $useAlt);
		}
		$prepend = (!empty($aBanner['prepend']) && $useAppend) ? $aBanner['prepend'] : '';
		$append = (!empty($aBanner['append']) && $useAppend) ? $aBanner['append'] : '';
		$clickUrl = _adRenderBuildClickUrl($aBanner, $zoneId, $source, $ct0, $logClick);
		if (!empty($clickUrl)) {  $status = _adRenderBuildStatusCode($aBanner);
		$clickTag = "<a href='$clickUrl' target='{target}'$status>";
		$clickTagEnd = '</a>';
		} else {
		$clickTag = '';
		$clickTagEnd = '';
		}
		if (!empty($imageUrl)) {
		$imgStatus = empty($clickTag) && !empty($status) ? $status : '';
		$width = !empty($aBanner['width']) ? $aBanner['width'] : 0;
		$height = !empty($aBanner['height']) ? $aBanner['height'] : 0;
		$alt = !empty($aBanner['alt']) ? htmlspecialchars($aBanner['alt'], ENT_QUOTES) : '';
		$imageTag = "$clickTag<img src='$imageUrl' width='$width' height='$height' alt='$alt' title='$alt' border='0'$imgStatus />$clickTagEnd";
		} else {
		$imageTag = '';
		}
		$bannerText = $withText && !empty($aBanner['bannertext']) ? "<br />$clickTag" . htmlspecialchars($aBanner['bannertext'], ENT_QUOTES) . "$clickTagEnd" : '';
		$beaconTag = ($logView && $conf['logging']['adImpressions']) ? _adRenderImageBeacon($aBanner, $zoneId, $source, $loc, $referer) : '';
		return $prepend . $imageTag . $bannerText . $beaconTag . $append;
	}
	
	$output['html'] .= (!empty($context)) ? "<script type='text/javascript'>document.context='".MAX_commonPackContext($context)."'; </script>" : '';
	MAX_cookieFlush();
	MAX_commonSendContentTypeHeader("text/javascript", $charset);
	echo MAX_javascriptToHTML($output['html'], 'OX_'.substr(md5(uniqid('', 1)), 0, 8));


?>