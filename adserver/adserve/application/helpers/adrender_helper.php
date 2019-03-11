<?php
	function getDateTime($start,$end,$period){
		if($period){
			if($start && $end){
				$startDate		= $start;	
				$endDate		= $end;
			}else{
				if('safds'){
					$endDate			= '';
					$startDate			= '';
				}else{
					$endDate			= date("Y-m-d");
					$startDate			= date("Y-m-d");
				}
			}
			
			
			$period		=$this->input->get('period');
			if($period == 'today'){
				$data['label']	= 'Today';
				
			
			}elseif($period == 'yesterday'){
				$data['label']	= 'Yesterday';

				
			}elseif($period == 'this_month'){
				$data['label']	= 'This Month';

				
			}elseif($period == 'all_stats'){
				$data['label']	= 'All Stats';

				
			}elseif($period == 'specific'){
				$data['label']	= 'Specific';
				$enableDateBox	= true;
			}
			
			$data['value']		= $period;
			
			
			
			
		}else{
			$endDate			= "";
			$startDate			= "";
			$period				= "";
		}
	}



	function MAX_displayAcls($acls, $aParams){
		//echo '<pre>';print_r($acls);die;
		$tabindex = 1;
		$GLOBALS  = array('strAdd'=>'Add','strACLAdd'=>' Add delivery limitation:  ','keyAddNew'=>'n','strNoLimitations'=>'No Limitation',
			'strOnlyDisplayWhen'=>'Only display this banner when:','strDeliveryLimitations'=>'Delivery Limitations','phpAds_TextAlignRight'=>'right',
			'strRemoveAllLimitations'=>'Remove All Limitations','strCampaign'=>'Campaign',
			'strSaveChanges'=>'SaveChanges',
		
		'strOR'=>'OR','strAND'=>'AND','phpAds_TextAlignRight'=>'right','strDown'=>'Down','strUp'=>'strUp',
			'strDelete' => 'Delete'
		);
		
		
		$page = '';
		$conf = '';
		$html = '';

		$html .="<form action='{$page}' method='post'>";
		$html .="<input type='hidden' name='token' value='".rand(5, 15)."' />";

		$html .="<label><img src='" . base_url() . "assets/upimages/icon-acl-add.gif' align='absmiddle'>&nbsp;". $GLOBALS['strACLAdd'] .": &nbsp;";
		$html .="<select name='type' accesskey='{$GLOBALS['keyAddNew']}' tabindex='".($tabindex++)."'>";

		$deliveryLimitations = getComponents();
		foreach ($deliveryLimitations as $pluginName => $plugin) {
			
				$html .="<option value='{$pluginName}'>" . $plugin . "</option>";
			
		}

		$html .="</select></label>";
		$html .="&nbsp;";
		$html .="<input type='submit' class='btn btn-primary' name='action[new]' value='" . $GLOBALS['strAdd'] . "'";
		$html .= "<br/><br/><br/><br/>";
		/* $aErrors = OX_AclCheckInputsFields($acls, $page);
		if (!empty($GLOBALS['action'])) {
			echo "<div class='errormessage'><img class='errormessage' src='" . OX::assetPath() . "/images/warning.gif' align='absmiddle'>";
			echo "<span class='tab-s'>{$GLOBALS['strUnsavedChanges']}</span><br>";
			echo "</div>";
		}
		elseif (!MAX_AclValidate($page, $aParams)) {
			echo "<div class='errormessage'><img class='errormessage' src='" . OX::assetPath() . "/images/warning.gif' align='absmiddle'>";
			echo "<span class='tab-r'>{$GLOBALS['strDeliveryLimitationsDisagree']}</span><br>";
			echo "</div>";
		}

		if ($aErrors  !== true) {
			echo "<div class='errormessage'><img class='errormessage' src='" . OX::assetPath() . "/images/warning.gif' align='absmiddle'>";
			echo "<span class='tab-s'>{$GLOBALS['strDeliveryLimitationsInputErrors']}</span><br><ul>";
			foreach ($aErrors as $error) {
				echo "<li><span class='tab-s'>{$error}</span><br></li>";
			}
			echo "</ul></div>";
		} */

		foreach ($aParams as $name => $value) {
			$html	.= "<input type='hidden' name='{$name}' value='{$value}' />";
		}
		$html	.= "<table border='0' width='100%' cellpadding='0' cellspacing='0'>";
		$html	.= "<tr><td height='25'  colspan='4' bgcolor='#FFFFFF'><b>{$GLOBALS['strDeliveryLimitations']}</b></td></tr>";
		$html	.= "<tr><td height='1'   style='line-height:.1px' colspan='4' bgcolor='#888888'><img src='" . base_url() . "assets/upimages/break.gif' height='1' width='100%'></td></tr>";

		if (empty($acls)) {
			$html	.= "<tr><td height='24' colspan='4' bgcolor='#F6F6F6'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$GLOBALS['strNoLimitations']}</td></tr>";
			$html	.= "<tr><td height='1' style='line-height:.1px'  colspan='4' bgcolor='#888888'><img src='" . base_url() . "assets/upimages/break.gif' height='1' width='100%'></td></tr>";
		
		} else {
			$html	.= "<tr><td height='25' colspan='4' bgcolor='#F6F6F6'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$GLOBALS['strOnlyDisplayWhen']}</td></tr>";
			$html	.= "<tr><td colspan='4'><img src='" . base_url() . "assets/upimages/break-el.gif' width='100%' height='1'></td></tr>";
			
			
			
			$count					= count($acls);
			foreach ($acls as $aclId => $acl) {
				if($acl['data']){
					if($acl['type']=='deliveryLimitations:Geo:City'){
						if(is_array($acl['data'])){
							$data		= $acl['data'];
						}else{
							$data		= explode(',', $acl['data']);
						}
					}elseif($acl['type']=='deliveryLimitations:Geo:Region'){
						if(is_array($acl['data'])){
							$data		= $acl['data'];
						}else{
							
							$data		= explode(',', $acl['data']);
						}
					}else{
						
						if(is_array($acl['data'])){
							$data		= $acl['data'];
						}else{
							$data		= explode(',', $acl['data']);

						}
					}
					
				}else{
					$data		= array();
					
				}
					
				$limitationHtml		 = display($acl, $count, $aParams['bannerid'], $data);
				$html 				.= $limitationHtml;
				
				
				/* if ($deliveryLimitationPlugin = OA_aclGetComponentFromRow($acl)) {
					$deliveryLimitationPlugin->init($acl);
					$deliveryLimitationPlugin->count = count($acls);
					
					if ($deliveryLimitationPlugin->isAllowed($page)) {
						$deliveryLimitationPlugin->display();
					}
				} */
			}
		}

		$html	.= "<tr><td height='30' colspan='2'>";
	
		if (!empty($acls)) {
			$url = $page . '?';
			foreach ($aParams as $name => $value) {
				$url .= "{$name}={$value}&";
			}
			$url .= "action[clear]=true";
			$html	.= "<img src='" . base_url() . "assets/upimages/icon-recycle.gif' border='0' align='absmiddle'>&nbsp;
					<a href='{$url}'>{$GLOBALS['strRemoveAllLimitations']}</a>&nbsp;&nbsp;&nbsp;&nbsp;
			";
		}

		$html	.= "</td><td height='30' colspan='2' align='{$GLOBALS['phpAds_TextAlignRight']}'>";
		$html	.= "</td></tr>";

		$html	.= "</table>";
		
		
		/* $html 	.="
			<table border='0' width='100%' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF'>";

			$aParams = array(
				'title' => $GLOBALS['strCampaign'],
				'titleLink' => "campaign-edit.php?clientid=$clientid&campaignid=$campaignid",
				'aText' => $GLOBALS['strCappingCampaign'],
				'aCappedObject' => $aBanner,
				'type' => 'Campaign'
			);

			$tabindex = _echoDeliveryCappingHtml($tabindex, $GLOBALS['strCappingBanner'], $aBanner, 'Ad', $aParams);

			$html 	.= "
			<tr><td height='1' colspan='6' bgcolor='#888888'>
			<img src='" . base_url() . "assets/upimages/break.gif' height='1' width='100%'></td></tr>

			</table>*/
			$html	.="<br /><br /><br />"; 
			
		$html	.=	"<input type='submit' name='submit' value='{$GLOBALS['strSaveChanges']}' tabindex='".($tabindex++)."'>

			</form>";
		
		return $html;
	}
	
	  /**
     * Echos the HTML to display this limitation
     *
     * @return void
     */
    function display($acl, $count, $bannerid, $data){
	
		
		 $ad_id				= $bannerid;
		 $displayName		= '';
		 if($acl['type'] != ''){
			 $logical			= 'and';//$acl['logical'];
			 $type				= $acl['type'];
			 $comparison		= $acl['comparison'];
			 
			 
			 $count				= $count;
			 $limitationArr		= explode(':', $type);
			 $displayName		= $limitationArr[1].'-'.$limitationArr[2];
			 
		 }
		 $executionorder	= $acl['executionorder'];
		 $columnName 		= '';
		 $nameEnglish 		= '';
		 $defaultComparison = '==';
		 
		 
		
		$html	= '';
        global $tabindex;
        if ($executionorder > 0) {
            $html	.= "<tr><td colspan='4'><img src='" . base_url() . "assets/upimages/break-el.gif' width='100%' height='1'></td></tr>";
        }

        $bgcolor = $executionorder % 2 == 0 ? "#E6E6E6" : "#FFFFFF";

        $html	.= "<tr height='35' bgcolor='$bgcolor'>";
        $html	.= "<td width='100'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        if ($executionorder == 0) {
            $html	.= "<input type='hidden' name='acl[{$executionorder}][logical]' value='and'>&nbsp;";
        } else {
            $html	.= "<select name='acl[{$executionorder}][logical]' tabindex='".($tabindex++)."'>";
            $html	.= "<option value='or' " . (($logical == 'or') ? 'selected' : '') . ">{$GLOBALS['strOR']}</option>";
            $html	.= "<option value='and' " . (($logical == 'and') ? 'selected' : '') . ">{$GLOBALS['strAND']}</option>";
            $html	.= "</select>";
        }
        $html	.= "</td><td width='130'>";
		$html	.= "<table cellpadding='2'><tr><td><img src='" . base_url() . "assets/upimages/icon-acl.gif' align='absmiddle'>&nbsp;</td><td>{$displayName}</td></tr></table>";
		$html	.= "<input type='hidden' name='acl[{$executionorder}][type]' value='{$type}'>";
		$html	.= "<input type='hidden' name='acl[{$executionorder}][executionorder]' value='{$executionorder}'>";
		$html	.= "</td><td >";

        $compHtml 	= displayComparison($acl, $displayName);
		$html		.= $compHtml;

        $html	.= "</td>";
        // Show buttons
		$html	.= "<td align='{$GLOBALS['phpAds_TextAlignRight']}'>";
		$html	.= "<input type='image' name='action[del][{$executionorder}]' value='{$executionorder}' src='" . base_url() . "assets/upimages/icon-recycle.gif' border='0' align='absmiddle' alt='{$GLOBALS['strDelete']}'>";
		$html	.= "&nbsp;&nbsp;";
		$html	.= "<img src='" . base_url() . "assets/upimages/break-el.gif' width='1' height='35'>";
		$html	.= "&nbsp;&nbsp;";

		if ($executionorder && $executionorder < $count)
			$html	.= "<input type='image' name='action[up][{$executionorder}]' src='" . base_url() . "assets/upimages/triangle-u.gif' border='0' alt='{$GLOBALS['strUp']}' align='absmiddle'>";
		else
			$html	.= "<img src='" . base_url() . "assets/upimages/triangle-u-d.gif' alt='{$GLOBALS['strUp']}' align='absmiddle'>";

		if ($executionorder < $count - 1) {
			$html	.= "<input type='image' name='action[down][{$executionorder}]' src='" . base_url() . "assets/upimages/triangle-d.gif' border='0' alt='{$GLOBALS['strDown']}' align='absmiddle'>";
		} else {
			$html	.= "<img src='" . base_url() . "assets/upimages/triangle-d-d.gif' alt='{$GLOBALS['strDown']}' align='absmiddle'>";
		}

		$html	.= "&nbsp;&nbsp;</td></tr>";
		$html	.= "<tr bgcolor='$bgcolor'><td>&nbsp;</td><td>&nbsp;</td><td colspan='2'>";

		$inputHtml 			= displayData($acl, $executionorder, $data,$displayName);
		$html 				.= $inputHtml;
		
        $html	.= "<br /><br /></td></tr>";

		
        //if (!isset($acl[$key]['type']) || $acl[$key]['type'] != $previous_type && $previous_type != '')
        $html	.= "<tr><td height='1' style='line-height: .1px;' colspan='4' bgcolor='#888888'><img src='" . base_url() . "assets/upimages/break.gif' height='1' width='100%'></td></tr>";
		return $html;
	}
	
	
	function displayData($acl,$executionorder, $data, $aclType){
		
		$aclType			= str_replace('-','',$aclType);
		
		if($aclType == 'ClientDomain' ||  $aclType == 'ClientIp'){
			global $tabindex;
			$data	= implode(',',$data);
			$html	= "<input type='text' size='40' name='acl[{$executionorder}][data]' value=\"".htmlspecialchars(isset($data) ? $data : "")."\" tabindex='".($tabindex++)."'>";
			return $html;
		}elseif($aclType	== 'GeoCity'){
			
			$inputData			= $aclType($acl,$data);
			return $inputData;
			
		}elseif($aclType	== 'GeoRegion'){
			
			$inputData			= $aclType($acl, $data);
			return $inputData;
		}else{
			$ci 		= &get_instance();
			$ci->load->library('limitationdata');
			$obj				= new Limitationdata();
			$inputData			= $aclType();
			if($aclType == 'TimeHour'){
				$html				= $obj->displayArrayDataForHour($executionorder, $data, $inputData);
			
			}elseif($aclType == 'TimeDate'){
				$data				= implode(',',$data);
				$html				= $obj->displayData($executionorder, $data, $inputData);

			
			}else{
				
				$html				= $obj->displayArrayData($executionorder, $data, $inputData);

			}
			return $html;
			
		}
	}
	
	function GeoCity($acl, $data){
		include_once APPPATH."libraries/deliveryLimitations/Geo/City.res.inc.php";
		$html 		= initCity($acl, $data);
		
		return $html;
		
	}
	
	function GeoRegion($acl, $data){
		
		include_once APPPATH."libraries/deliveryLimitations/Geo/Region.res.inc.php";
		$html 		= initRegion($acl,$data);
		return $html;
		
	}
	
	function ClientOs(){
		$res = array(
			'w7'        => 'Windows 7',
			'xp'        => 'Windows XP',
			'2k'        => 'Windows 2000',
			'linux'     => 'Linux',
			'freebsd'   => 'FreeBSD',
			'sun'       => 'Solaris',
			'osx'       => 'Mac OSX',
		);
		return $res;
	}
	
	function DeviceScreen(){
		$res = array(
			'mobile'        => 'Mobile',
			'desktop'        => 'Desktop',
			'tablet'        => 'Tablet',
		);
		return $res;
	}
	
	function ClientDomain(){
		
	}
	
	
	
	function ClientBrowser(){
		$aBrowsers = array(
			'GC' => 'Chrome',
			'FX' => 'Firefox',
			'IE' => 'Internet Explorer',
			'SF' => 'Safari',
			'OP' => 'Opera',
		);
		
		return $aBrowsers;
	}
	
	function TimeDate(){
		
		
	}
	function TimeHour(){
		
	}
	function TimeDay(){
		$res = array('Su','Mo','Tu','We','Th','Fr','Sa');
		return $res;
		
	}
	
	
	
	 /**
     * Echos the HTML to display the comparison operator for this limitation
     *
     * @return void
     */
    function displayComparison($acl, $aclType){
        global $tabindex;
		$executionorder		= $acl['executionorder'];
		$comparison			= $acl['comparison'];
		$aOperations		= '';
		$aclType			= str_replace('-','',$aclType);
		$aOperations		= array();
		
		if($aclType == 'TimeDate'){ 
			$aOperations = array(
				'==' => 'is equal to',
				'!=' => 'is different from',
				'>' => 'is later than',
				'>=' =>'is later than or equal to',
				'<' => 'is earlier than',
				'<=' => 'is earlier than or equal to'
			);
		}elseif($aclType == 'ClientIp'){
			$aOperations = array(
				'==' => 'is equal to',
				'!=' => 'is different from',
			  
			);
		}elseif($aclType == 'ClientDomain'){
			$aOperations = array(
				'==' => 'is equal to',
				'!=' => 'is different from',
				'=~' => 'Contains',
				'!~' =>'Does not contain',
			);
		}else{
			$aOperations = array(
				'=~' => 'Is any of',
				'!~' => 'Is not any of');
		}
		$html				= '';
        $html				.= "<select name='acl[{$executionorder}][comparison]' tabindex='".($tabindex++)."'>";
        foreach($aOperations as $sOperator => $sDescription) {
            $html				.= "<option value='$sOperator' " . (($comparison == $sOperator) ? 'selected' : '') . ">$sDescription</option>";
        }
		$html				.= "</select>";
		return $html; 
    }
	
	
	
	function getComponents(){
		$component	= array("deliveryLimitations:Client:Browser"=>"Client - Browser",
		//"deliveryLimitations:Client:BrowserVersion"=>"Client - Browser Version",
		//"deliveryLimitations:Client:Language"=>"Client - Language",
		"deliveryLimitations:Client:Os"=>"Client - Operating system",
		"deliveryLimitations:Device:Screen"=>"Device - Screen",
		"deliveryLimitations:Client:Domain"=>"Client - Domain",
		"deliveryLimitations:Client:Ip"=>"Client - IP address",
		//"deliveryLimitations:Client:OsVersion"=>"Client - Operating System Version",
		//"deliveryLimitations:Client:Useragent"=>"Client - Useragent",
		"deliveryLimitations:Time:Date"=>"Time - Date",
		"deliveryLimitations:Time:Day"=>"Time - Day of week",
		"deliveryLimitations:Time:Hour"=>"Time - Hour of day",
		//"deliveryLimitations:Geo:Areacode"=>"Geo - US Area code",
		"deliveryLimitations:Geo:City"=>"Geo - Country / City",
		//"deliveryLimitations:Geo:Continent"=>"Geo - Continent",
		//"deliveryLimitations:Geo:Country"=>"Geo - Country",
		//"deliveryLimitations:Geo:Dma"=>"GEO - Designated Market Area",
		//"deliveryLimitations:Geo:Latlong"=>"Geo - Latitude/Longitude",
		//"deliveryLimitations:Geo:Netspeed"=>"Geo - Net Speed",
		//"deliveryLimitations:Geo:Organisation"=>"Geo - ISP/Organisation",
		//"deliveryLimitations:Geo:Postalcode"=>"Geo - US/Canada Postal Code",
		"deliveryLimitations:Geo:Region"=>"Geo - Country / Region",
		//"deliveryLimitations:Site:Channel"=>"Site - Channel",
		//"deliveryLimitations:Site:Pageurl"=>"Site - Page URL",
		//"deliveryLimitations:Site:Referingpage"=>"Site - Referring Page",
		//"deliveryLimitations:Site:Source"=>"Site - Source",
		//"deliveryLimitations:Site:Variable"=>"Site - Variable",
		);
		
		return $component;
		
	}
	
	
	function Max_checkGeo_City($inputType, $compOpt){
		$GeoArr  			= explode(',', $inputType);
		$countryCode		= $GeoArr[0];
		$stateCode			= $GeoArr[1];
		unset($GeoArr[0]);
		unset($GeoArr[1]);
		
		include_once APPPATH."libraries/geoip-api/src/geoip.inc";
		include_once APPPATH."libraries/geoip-api/src/geoipcity.inc";
		include_once APPPATH."libraries/geoip-api/src/geoipregionvars.php";
		$ipaddress 			= $_SERVER['REMOTE_ADDR'];
		$gi 				= geoip_open(APPPATH."libraries/geoip-api/src/GeoLiteCity.dat", GEOIP_STANDARD);
		$rsGeoData 			= geoip_record_by_addr($gi, $ipaddress);
		
		
		$city 				= $rsGeoData->city;
		$state 				= $rsGeoData->region;
		$userCountryCode 	= $rsGeoData->country_code; 
		geoip_close($gi);
		//echo '<pre>';print_r($_SERVER);die;
		//echo '<pre>';print_r($rsGeoData);
		//echo $city . ":" . $state . ":" . $country;die;
		//echo $countryCode.'<br>'.$userCountryCode;die;
		//&& in_array($state, $GeoArr)
		//echo '<pre>';print_r($GeoArr);
		//echo $state;die;
		// && in_array($state, $GeoArr)
		
		if($countryCode	== $userCountryCode){
			if($state){
				if($state == $stateCode){
					if($city){
						if(in_array($city, $GeoArr)){
							return true;
						}else{
							return false;	
						}
						
					}else{
						return true;
					}
				}else{
					return false;
				}
			}else{
				return true;
			}
		}else{
			return false;
		}
	}





	function Max_checkGeo_Region($inputType, $compOpt){
		$GeoArr  			= explode(',', $inputType);
		$countryCode		= $GeoArr[0];
		unset($GeoArr[0]);
		
		
		include_once APPPATH."libraries/geoip-api/src/geoip.inc";
		include_once APPPATH."libraries/geoip-api/src/geoipcity.inc";
		include_once APPPATH."libraries/geoip-api/src/geoipregionvars.php";
		$ipaddress 			= $_SERVER['REMOTE_ADDR'];
		$gi 				= geoip_open(APPPATH."libraries/geoip-api/src/GeoLiteCity.dat", GEOIP_STANDARD);
		$rsGeoData 			= geoip_record_by_addr($gi, $ipaddress);
		
		$lat 				= $rsGeoData->latitude;
		$long 				= $rsGeoData->longitude;
		$city 				= $rsGeoData->city;
		$state 				= $rsGeoData->region;
		$userCountryCode 	= $rsGeoData->country_code;
		geoip_close($gi);
		//echo '<pre>';print_r($_SERVER);die;
		//echo '<pre>';print_r($rsGeoData);
		//echo $city . ":" . $state . ":" . $country;die;
		//echo $countryCode.'<br>'.$userCountryCode;die;
		//&& in_array($state, $GeoArr)
		//echo '<pre>';print_r($GeoArr);
		//echo $state;die;
		// && in_array($state, $GeoArr)
		
		if($countryCode	== $userCountryCode){
			if($state && in_array($state, $GeoArr)){
				return true;
			}else{
				return false;
			}
			return true;
			
		}else{
			return false;
		}
	}
	
	
	function Max_checkDevice_Screen($inputType, $compOpt){
		$ci 		= &get_instance();
		$ci->load->library('Mobile_Detect');
		$detect = new Mobile_Detect();
		//echo $inputType.'<br>'.$compOpt;
		
		
		$screenType		= '';
		if ($detect->isMobile()){
			$screenType 	= 'mobile';
			
		}else if($detect->isTablet()){
				$screenType 	= 'tablet';

		}else{
			 $screenType 	=  'desktop';
		}
		
		
		$key		= strpos($inputType,$screenType);
		if($key !== false && $compOpt =='=~'){
			return true;
		}else{
			return false;
		}
	}
	
	
	function Max_checkClient_Browser($inputType, $compOpt){
		
		$aBrowserMap = array(
			EDGE => 'ED',
			IE => 'IE',
			CHROME => 'GC',
			FIREFOX => 'FX',
			OPERA => 'OP',
			OPERA_MINI => 'OP',
			BLACKBERRY => 'BL',
			NAVIGATOR => 'NS',
			GALEON => 'GA',
			PHOENIX => 'PX',
			FIREBIRD => 'FB',
			SAFARI => 'SF',
			MOZILLA => 'MZ',
			KONQUEROR => 'KQ',
			ICAB => 'IC',
			LYNX => 'LX',
			AMAYA => 'AM',
			OMNIWEB => 'OW',
		);
		$ci 		= &get_instance();
		$ci->load->library('UserAgent');
		$ci->load->library('Browser');
		$ci->load->library('BrowserDetector');
		//echo $inputType.'<br>'.$compOpt;
		$userAgent			= $_SERVER['HTTP_USER_AGENT'];
		$browser			= new Browser($userAgent);
		$browserName		= strtoupper($browser->getName());
		
		$browserSym			= '';
        if (isset($aBrowserMap[$browserName])) {
           $browserSym		= $aBrowserMap[$browserName];
        }
		
		$key		= strpos($inputType, $browserSym);
		if($key !== false && $compOpt =='=~'){
			return true;
		}else{
			return false;
		}
	}
	
	
	function Max_checkClient_Os($inputType, $compOpt){
		
		$aOsMap = array(
			WINDOWS => array(
			  '95' => '95',
			  '98' => '98',
			  '2000' => '2k',
			  'XP' => 'xp',
			  '7' => 'w7',
			  '8' => 'w8',
			  '10.0'=> 'w10'
			),
			OSX => 'osx',
			LINUX => 'linux',
			FREEBSD => 'freebsd',
			SUNOS => 'sun',
		);
		$ci 		= &get_instance();
		$ci->load->library('UserAgent');
		$ci->load->library('Os');
		$ci->load->library('OsDetector');
		$osObject			= new Os($userAgent);
		$os 				= strtoupper($osObject->getName());
		
		$osSym			= '';
		

        if (isset($aOsMap[$os])) {
            if (is_array($aOsMap[$os])) {
                $version		= $osObject->getVersion();
                if (isset($aOsMap[$os][$version])) {
                    $osSym	= $aOsMap[$os][$version];
                }
            } else {
                $osSym 		= $aOsMap[$os];
            }
        }else{
			$osSym 		= 'Unknown';
		}
		$key		= strpos($inputType, $osSym);
		if($key !== false && $compOpt =='=~'){
			return true;
		}else{
			return false;
		}
	}
	
	
	function MAX_checkClient_Domain($limitation, $op){
		MAX_remotehostReverseLookup();
		$host 			= $_SERVER['REMOTE_HOST'];
		$domain 		= substr($host,-(strlen($limitation)));
		return MAX_limitationsMatchStringValue($domain, $limitation, $op);
	}
	
	function MAX_remotehostReverseLookup(){
		
		if (empty($_SERVER['REMOTE_HOST'])) {
			if(gethostbyaddr($_SERVER['REMOTE_ADDR'])){
				$_SERVER['REMOTE_HOST'] = gethostbyaddr($_SERVER['REMOTE_ADDR']);
				
			}else{
				$_SERVER['REMOTE_HOST'] = $_SERVER['REMOTE_ADDR'];
			}
		}
		
	}
	
	
	
	function MAX_limitationsMatchStringValue($value, $limitation, $op){
		$limitation = strtolower($limitation);
		$value = strtolower($value);
		
		if ($op == '==') {
			return $limitation == $value;
		} elseif ($op == '!=') {
			return $limitation != $value;
		} elseif ($op == '=~') {
			return MAX_stringContains($value, $limitation);
		} elseif ($op == '!~') {
			return !MAX_stringContains($value, $limitation);
		} elseif ($op == '=x') {
			return preg_match(_getSRegexpDelimited($limitation), $value);
		} else {
			return !preg_match(_getSRegexpDelimited($limitation), $value);
		}
	}
	
	function MAX_stringContains($sString, $sToken){
		
		return strpos($sString, $sToken) !== false;
	}
	
	
	
	function MAX_checkClient_Ip($limitation, $op, $aParams = array()){
		
		if ($limitation == '') {
			return true;
		}
		if (empty($aParams)) {
			$aParams = $_SERVER;
		}
		$ip = $aParams['REMOTE_ADDR'];

		if ($limitation == '')
			return (true);

		if (!strpos($limitation, '/')) {
			$net = explode('.', $limitation);

			for ($i=0;$i<sizeof($net);$i++) {
				if ($net[$i] == '*') {
					$net[$i] = 0;
					$mask[$i] = 0;
				} else {
					$mask[$i] = 255;
				}
			}
			$pnet 	= pack('C4', $net[0], $net[1], $net[2], $net[3]);
			$pmask 	= pack('C4', $mask[0], $mask[1], $mask[2], $mask[3]);
		} else {
			list ($net, $mask) = explode('/', $limitation);
			$net 	= explode('.', $net);
			$pnet 	= pack('C4', $net[0], $net[1], $net[2], $net[3]);
			$mask 	= explode('.', $mask);
			$pmask 	= pack('C4', $mask[0], $mask[1], $mask[2], $mask[3]);
		}

		$ip 	= explode('.', $ip);
		$phost 	= pack('C4', $ip[0], $ip[1], $ip[2], $ip[3]);

		$expression = ($limitation == "*" || ($phost & $pmask) == $pnet);
		$op   = $op == '==';
		return ($expression == $op);
	}
	
	function MAX_checkTime_Day($limitation, $op){
	
		//echo $limitation.'<br>'.$op;die;
		// Get timezone, if any
		
		if ($limitation == '') {
			return true;
		}
		
		$timestamp		= time();
		$day 			= date('w', $timestamp);
		
		return MAX_limitationsMatchArrayValue($day, $limitation, $op);
	}
	
	
	/**
 * An utility function which checks if the array specified in the $value
 * matches the limitation specified in the $limitation and $op variables.
 * The $value is supposed to be a single string and $limitation is
 * a list of values separated by `,' character.
 *
 * The function returns true if the $value matches the limitation,
 * false otherwise.
 *
 * The meaning of $op is the following:
 * <ul>
 *   <li>==: true iff $limitation consists of single value and this value
 *     is exactly the same as $value.</li>
 *   <li>=~: true iff $value is a member of the $limitation array.</li>
 *   <li>!~: true iff $value is not a member of the $limitation array.</li>
 * </ul>
 *
 * @param string $value Value to check against the limitation.
 * @param string $limitation The limitation specification as a string.
 * @param string $op The operator to use to apply the limitation.
 * @return boolean True if the $value matches the limitation,
 * false otherwise.
 */
function MAX_limitationsMatchArrayValue($value, $limitation, $op)
{

    if ($op == '==') {
        return strcasecmp($limitation, $value) == 0;
    } else if ($op == '=~') {
        if ($value == '') {
            return true;
        }
        return stripos(','.$limitation.',', ','.$value.',') !== false;
    } else {
        if ($value == '') {
            return false;
        }
        return stripos(','.$limitation.',', ','.$value.',') === false;
    }
}




/*
+---------------------------------------------------------------------------+
| Revive Adserver                                                           |
| http://www.revive-adserver.com                                            |
|                                                                           |
| Copyright: See the COPYRIGHT.txt file.                                    |
| License: GPLv2 or later, see the LICENSE.txt file.                        |
+---------------------------------------------------------------------------+
*/

/**
 * @package    OpenXPlugin
 * @subpackage DeliveryLimitations
 */

/**
 * Check to see if this impression contains the valid date.
 *
 * @param string $limitation The date limitation
 * @param string $op The operator (either '==' or '!=')
 * @param array $aParams An array of additional parameters to be checked
 * @return boolean Whether this impression's date passes this limitation's test.
 */
function MAX_checkTime_Date($limitation, $op)
{
	
	if ($limitation == '' && $limitation == '00000000') {
        return true;
    }
    
	
	$timestamp 		= time();
	$date 			= date('Ymd', $timestamp);
    switch ($op) {
        case '==': return ($date == $limitation); break;
        case '!=': return ($date != $limitation); break;
        case '<=': return ($date <= $limitation); break;
        case '>=': return ($date >= $limitation); break;
        case '<':  return ($date <  $limitation);  break;
        case '>':  return ($date >  $limitation);  break;
    }
    return true;
}
	function MAX_checkTime_Hour($limitation, $op){
		
		if ($limitation == '') {
			return true;
		}
		
		$timestamp 		= time();
		$time 			= date('G', $timestamp);
		return MAX_limitationsMatchArrayValue($time, $limitation, $op);
		
		
		
	}











//require_once MAX_PATH . '/plugins/bannerTypeHtml/vastInlineBannerTypeHtml/common.php';
function deliverVastAd($pluginType, &$aBanner, $zoneId=0, $source='', $ct0='', $withText=false, $logClick=true, $logView=true, $useAlt=false, $richMedia=true, $loc, $referer)
{
    global $format;
    extractVastParameters( $aBanner );
    $aOutputParams = array();
    $aOutputParams['format'] = $format;

    $aOutputParams['videoPlayerSwfUrl'] = getVideoPlayerUrl('flowplayerSwfUrl');
    $aOutputParams['videoPlayerJsUrl'] = getVideoPlayerUrl('flowplayerJsUrl');
    $aOutputParams['videoPlayerRtmpPluginUrl'] = getVideoPlayerUrl('flowplayerRtmpPluginUrl');
    $aOutputParams['videoPlayerControlsPluginUrl'] = getVideoPlayerUrl('flowplayerControlsPluginUrl');

    if ( getVideoPlayerSetting('isAutoPlayOfVideoInOpenXAdminToolEnabled' )){
        $aOutputParams['isAutoPlayOfVideoInOpenXAdminToolEnabled'] = "true";
    } else {
        $aOutputParams['isAutoPlayOfVideoInOpenXAdminToolEnabled'] = "false";
    }
    if(!empty($aBanner['vast_thirdparty_impression'])) {
        $aOutputParams['thirdPartyImpressionUrl'] = $aBanner['vast_thirdparty_impression'];
    }
    prepareCompanionBanner($aOutputParams, $aBanner, $zoneId, $source, $ct0, $withText, $logClick, $logView, $useAlt, $loc, $referer);
    prepareVideoParams( $aOutputParams, $aBanner );
    prepareOverlayParams( $aOutputParams, $aBanner );

    $player = "";
    prepareTrackingParams( $aOutputParams, $aBanner, $zoneId, $source, $loc, $ct0, $logClick, $referer );
    if ( $format == 'vast' ){
        if ( $pluginType == 'vastInline' ){
            $player .= renderVastOutput( $aOutputParams, $pluginType, "Inline Video Ad" );
        } else if ( $pluginType == 'vastOverlay' ) {
            $player .= renderVastOutput( $aOutputParams, $pluginType, "Overlay Video Ad" );
        } else {
            throw new Exception("Uncatered for vast plugintype|$pluginType|");
        }
    } else {
        if ( $pluginType == 'vastInline' ){
            $player .= renderPlayerInPage($aOutputParams);
            $player .= renderCompanionInAdminTool($aOutputParams);
        } else if ( $pluginType == 'vastOverlay' ) {
            $player .= renderOverlayInAdminTool($aOutputParams, $aBanner);
            $player .= renderCompanionInAdminTool($aOutputParams);
            $player .= renderPlayerInPage($aOutputParams);
        } else {
            throw new Exception("Uncatered for vast plugintype|$pluginType|");
        }
    }
    return $player;
}


function testdevicetype($bannerId){
	$tablet_browser = 0;
	$mobile_browser = 0;
	 
	if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$tablet_browser++;
	}
	 
	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
		$mobile_browser++;
	}
	 
	if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
		$mobile_browser++;
	}
	 
	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
	$mobile_agents = array(
		'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
		'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
		'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
		'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
		'newt','noki','palm','pana','pant','phil','play','port','prox',
		'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
		'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
		'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
		'wapr','webc','winw','winw','xda ','xda-');
	 
	if (in_array($mobile_ua,$mobile_agents)) {
		$mobile_browser++;
	}
	 
	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0) {
		$mobile_browser++;
		//Check for tablets on opera mini alternative headers
		$stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua)) {
		  $tablet_browser++;
		}
	}

	$now	= time();
	if ($tablet_browser > 0) {
		$type	= 'tablet';
		
	}else if ($mobile_browser > 0) {
	    $type	= 'mobile';
		
	}else {
		$type	= 'desktop';
	}
	
	$query 					= "INSERT INTO `device_type` (`interval_start`,`creative_id`,`type`)
						VALUES (FROM_UNIXTIME(".$now."), '".$bannerid."', 'desktop')";
	$result 				=  $this->db->query($query);
}
















function getVastXMLHeader($charset)
{
	$header   = "<?xml version=\"1.0\" encoding=\"".$charset."\"?>\n";
    $header  .= "<VideoAdServingTemplate xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"vast.xsd\">\n";
    return $header;
}

function getVastXMLFooter()
{
	$footer = "</VideoAdServingTemplate>\n";
	return $footer;
}

function getVideoPlayerUrl($parameterId)
{
    static $aDefaultPlayerFiles = array(
        'flowplayerSwfUrl'=> "flowplayer/3.1.1/flowplayer-3.1.1.swf",
        'flowplayerJsUrl'=> "flowplayer/3.1.1/flowplayer-3.1.1.min.js",
        'flowplayerControlsPluginUrl' =>  "flowplayer/3.1.1/flowplayer.controls-3.1.1.swf",
        'flowplayerRtmpPluginUrl'=> "flowplayer/3.1.1/flowplayer.rtmp-3.1.0.swf",
    );

    $conf = $GLOBALS['_MAX']['CONF'];

    // you can set this by adding a setting under [vastServeVideoPlayer] in the hostname.conf.php config file
    $fullFileLocationUrl = $GLOBALS['_MAX']['SSL_REQUEST'] ? 'https://' . $conf['webpath']['deliverySSL'] : 'http://' .  $conf['webpath']['delivery'];

    $fullFileLocationUrl .= "/fc.php?script=deliveryLog:vastServeVideoPlayer:player&file_to_serve=";

    if(isset( $conf['vastServeVideoPlayer'][$parameterId])) {
        $configFileLocation = $conf['vastServeVideoPlayer'][$parameterId];
        $fullFileLocationUrl .= $configFileLocation;
    } else {
        if(!isset($aDefaultPlayerFiles[$parameterId])) {
            throw new Exception("Uncatered for setting type in getVideoPlayerUrl() |$parameterId| in <pre>" . print_r( $aDefaultPlayerFiles, true) . '</pre>' );
        } else {
            $fullFileLocationUrl .= $aDefaultPlayerFiles[$parameterId];
        }
    }
    return $fullFileLocationUrl;
}

function extractVastParameters( &$aBanner )
{
    if ( isset($aBanner['parameters']) ){
        $vastVariables = unserialize($aBanner['parameters']);
        $aBanner = array_merge($aBanner, $vastVariables);
    }
}

function prepareVideoParams(&$aOutputParams, $aBanner)
{
    $aOutputParams['name'] = $aBanner['name'];
    if(isset($aBanner['vast_video_outgoing_filename'] )
        && $aBanner['vast_video_outgoing_filename']) {
       $aOutputParams['vastVideoDuration'] = $aBanner['vast_video_duration'];
       $aOutputParams['vastVideoBitrate'] = $aBanner['vast_video_bitrate'];
       $aOutputParams['vastVideoWidth']	= $aBanner['vast_video_width'];
       $aOutputParams['vastVideoHeight'] = $aBanner['vast_video_height'];
       $aOutputParams['vastVideoId'] =  $aBanner['bannerid'];
       $aOutputParams['vastVideoType'] = $aBanner['vast_video_type'];
       $aOutputParams['vastVideoDelivery'] = $aBanner['vast_video_delivery'];
    }
}

function prepareCompanionBanner(&$aOutputParams, $aBanner){
    // If we have a companion banner to serve
    if ( isset( $aBanner['vast_companion_banner_id']  )
        && ($aBanner['vast_companion_banner_id'] != 0) ){
        $companionBannerId = $aBanner['vast_companion_banner_id'];
		global $context;

        if (isset($context) && !is_array($context)) {
            $context = MAX_commonUnpackContext($context);
        }
        if (!is_array($context)) {
            $context = array();
        }
        $companionOutput = MAX_adSelect("bannerid:$companionBannerId", '', "", $source, $withText, '', $context, true, $ct0, $loc, $referer);
        if ( !empty($companionOutput['html'] )){
            // We only regard  a companion existing, if we have some markup to output
            $html = $companionOutput['html'];

            // deal with the case where the companion code itself contains a CDATA
            $html = str_replace(']]>', ']]]]><![CDATA[>', $html);
            $aOutputParams['companionMarkup'] = $html;

            $aOutputParams['companionWidth'] = $companionOutput['width'];
            $aOutputParams['companionHeight'] = $companionOutput['height'];
            $aOutputParams['companionClickUrl'] = $companionOutput['url'];
        }
    }
}

function prepareTrackingParams(&$aOutputParams, $aBanner)
{
    $conf = $GLOBALS['_MAX']['CONF'];
    $aOutputParams['impressionUrl'] =  _adRenderBuildLogURL($aBanner, $zoneId, $source, $loc, $referer, '&');
    if ( $aOutputParams['format'] == 'vast' ){
        $trackingUrl = MAX_commonGetDeliveryUrl($conf['file']['frontcontroller']).
            "?script=videoAds:vastEvent&bannerid={$aBanner['bannerid']}&zoneid={$zoneId}";
        if (!empty($source)) {
            $trackingUrl .= "&source=".urlencode($source);
        }
        $aOutputParams['trackUrlStart'] = $trackingUrl . '&event=start';
        $aOutputParams['trackUrlMidPoint'] = $trackingUrl . '&event=midpoint';
        $aOutputParams['trackUrlFirstQuartile'] = $trackingUrl . '&event=firstquartile';
        $aOutputParams['trackUrlThirdQuartile'] = $trackingUrl . '&event=thirdquartile';
        $aOutputParams['trackUrlComplete'] = $trackingUrl . '&event=complete';
        $aOutputParams['trackUrlMute'] = $trackingUrl . '&event=mute';
        $aOutputParams['trackUrlPause'] = $trackingUrl . '&event=pause';
        $aOutputParams['trackReplay'] = $trackingUrl . '&event=replay';
        $aOutputParams['trackUrlFullscreen'] = $trackingUrl . '&event=fullscreen';
        $aOutputParams['trackUrlStop'] = $trackingUrl . '&event=stop';
        $aOutputParams['trackUrlUnmute'] = $trackingUrl . '&event=unmute';
        $aOutputParams['trackUrlResume'] = $trackingUrl . '&event=resume';
        $aOutputParams['vastVideoClickThroughUrl'] = _adRenderBuildVideoClickThroughUrl($aBanner, $zoneId, $source, $ct0 );
    }
    $aOutputParams['clickUrl'] = _adRenderBuildClickUrl($aBanner, $zoneId, $source, $ct0, $logClick);
}

/**
 * This function builds the Click through URL for this ad
 *
 * @param array   $aBanner      The ad-array for the ad to render code for
 * @param int     $zoneId       The zone ID of the zone used to select this ad (if zone-selected)
 * @param string  $source       The "source" parameter passed into the adcall
 * @param string  $ct0          The 3rd party click tracking URL to redirect to after logging
 * @param bookean $logClick     Should this click be logged (clicks in admin should not be logged)
 *
 * @return string The click URL
 */
function _adRenderBuildVideoClickThroughUrl($aBanner){

    // We dont pass $aBanner by reference - so the changes to this $aBanner are lost - which is a good thing
    // we need the url attribute of aBanner to contain the url we want created
    $clickUrl = '';
    if(!empty($aBanner['vast_video_clickthrough_url'])) {
        $aBanner['url'] = $aBanner['vast_video_clickthrough_url'];
        $clickUrl 		= _adRenderBuildClickUrl($aBanner, $zoneId, $source, $ct0, $logClick);
    }
    return $clickUrl;
}


function errorvast(){
	header("Content-type: text/xml");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Origin: *");
	
	$string	  	= "<?xml version=\"1.0\"  encoding='UTF-8'?>";
	$string		= "<VAST version=\"2.0\">
	<Error></Error>
	<Extensions>
	<Extension type=\"adaptv_error\">
	<Error code=\"2\">
	<![CDATA[ No ad could be found matching this request. ]]>
	</Error>
	</Extension>
	</Extensions>
	</VAST>";
	
	return $string;
}

function getVastVideoAdOutput($banner, $vast){
	//echo '<pre>';print_r($banner);print_r($vast);die;
	if($vast['vast_video_duration']!=0){
			$vast['vast_video_duration']		= $vast['vast_video_duration'];
			
	}else{
		$vast['vast_video_duration']			= '00:00:30';
	}
	

    if(!empty($vast['third_party_click'])) {
		
		/*  if(strpos($vast['third_party_click'],'&')){
			$vast['third_party_click']	= str_replace('&','&amp;',$vast['third_party_click']);
				
		} */
		/* if(strpos($banner['url'],'&')){
			$banner['url']	= str_replace('&','&amp;',$banner['url']);
				
		} */
		$videoClicksVast = '    <VideoClicks>
                                <ClickThrough><![CDATA['.$banner['url'].']]></ClickThrough>
                                <ClickTracking><![CDATA['.$vast['third_party_click'].']]></ClickTracking>
							</VideoClicks>';
    }else{
		/* if(strpos($banner['url'],'&')){
			$banner['url']	= str_replace('&','&amp;',$banner['url']);
				
		} */
		$videoClicksVast = '	        <VideoClicks>
                            <ClickThrough>'.$banner['url'].'</ClickThrough>
                        </VideoClicks>';
		
	}
	
	/* if(strpos($vast['start_pixel'],'&')){
			$vast['start_pixel']	= str_replace('&','&amp;',$vast['start_pixel']);
				
	}
	if(strpos($vast['quater_pixel'],'&')){
			$vast['quater_pixel']	= str_replace('&','&amp;',$vast['quater_pixel']);
				
	}if(strpos($vast['mid_pixel'],'&')){
			$vast['mid_pixel']	= str_replace('&','&amp;',$vast['mid_pixel']);
				
	}if(strpos($vast['third_quater'],'&')){
			$vast['third_quater']	= str_replace('&','&amp;',$vast['third_quater']);
				
	}if(strpos($vast['end_pixel'],'&')){
			$vast['end_pixel']	= str_replace('&','&amp;',$vast['end_pixel']);
				
	}if(strpos($vast['vast_thirdparty_impression'],'&')){
			$vast['vast_thirdparty_impression']	= str_replace('&','&amp;',$vast['vast_thirdparty_impression']);
				
	}if(strpos($vast['third_party_click'],'&')){
			$vast['third_party_click']	= str_replace('&','&amp;',$vast['third_party_click']);
				
	} */
	
	
	$vast['vast_video_delivery']	='Progressive';
	
	
	

    $vastVideoMarkup =<<<VAST_VIDEO_AD_TEMPLATE
                <Creative AdID="601364">
                    <Linear>
                        <Duration>${vast['vast_video_duration']}</Duration>
						$videoClicksVast
						<MediaFiles>
							<MediaFile delivery="${vast['vast_video_delivery']}" bitrate="${vast['vast_video_bitrate']}" width="${vast['vast_video_width']}" height="${vast['vast_video_height']}" type="${vast['vast_video_type']}">
                                <![CDATA[${vast['vast_video_outgoing_filename']}]]>
                            </MediaFile>
					    </MediaFiles>
						<TrackingEvents>
                            <Tracking event="start"><![CDATA[${vast['start_pixel']}]]></Tracking>
                            <Tracking event="midpoint"><![CDATA[${vast['mid_pixel']}]]></Tracking>
                            <Tracking event="firstQuartile"><![CDATA[${vast['quater_pixel']}]]></Tracking>
                            <Tracking event="thirdQuartile"><![CDATA[${vast['quater_pixel']}]]></Tracking>
                            <Tracking event="complete"><![CDATA[${vast['end_pixel']}]]></Tracking>
                            <Tracking event="mute"><![CDATA[${vast['end_pixel']}]]></Tracking>
                            <Tracking event="pause"><![CDATA[${vast['end_pixel']}]]></Tracking>
                            <Tracking event="replay"><![CDATA[${vast['end_pixel']}]]></Tracking>
                            <Tracking event="fullscreen"><![CDATA[${vast['end_pixel']}]]></Tracking>
                            <Tracking event="stop"><![CDATA[${vast['end_pixel']}]]></Tracking>
                            <Tracking event="unmute"><![CDATA[${vast['end_pixel']}]]></Tracking>
                            <Tracking event="resume"><![CDATA[${vast['end_pixel']}]]></Tracking>
                        </TrackingEvents> 
                    </Linear>
                </Creative>
VAST_VIDEO_AD_TEMPLATE;

    return $vastVideoMarkup;
}

function getImageUrlFromFilename($filename)
{
    return _adRenderBuildImageUrlPrefix() . "/" . $filename;
}

function renderVastOutput($banner, 	$vast){
	//echo '<pre>';print_r($banner);print_r($vast);die;
	

    $adSystem = 'media adserver';
	$adName   = $banner['description'];
	$vastAdDescription	= 'Inline Video Ad';
	
    $player   = "";
	header("Content-type: text/xml");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Origin: *");
	

	
	$player	  = "<?xml version=\"1.0\"  encoding='UTF-8'?>";
	/* $player	  = "<VAST version=\"3.0\">
	<Ad id=\"697200496\">
	<InLine>
	<AdSystem>MediaConverison</AdSystem>
	<AdTitle>Media Ads</AdTitle>
	<Description>MediaConverison Vast Tag</Description>
	<Error></Error>
	<Impression><![CDATA[${vast['vast_thirdparty_impression']}]]></Impression>
	<Creatives>
	<Creative id=\"57860459056\" sequence=\"1\">
	<Linear>
	<Duration>00:00:30</Duration>
	<TrackingEvents>
	<Tracking event=\"start\"><![CDATA[${vast['start_pixel']}]]></Tracking>
	<Tracking event=\"firstQuartile\"><![CDATA[${vast['quater_pixel']}]]></Tracking>
	<Tracking event=\"midpoint\"><![CDATA[${vast['mid_pixel']}]]></Tracking>
	<Tracking event=\"thirdQuartile\"><![CDATA[${vast['third_quater']}]]></Tracking>
	<Tracking event=\"complete\"><![CDATA[${vast['end_pixel']}]]></Tracking>
	<Tracking event=\"mute\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"unmute\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"rewind\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"pause\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"resume\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"fullscreen\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"creativeView\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"exitFullscreen\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"acceptInvitationLinear\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"closeLinear\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"skip\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	</TrackingEvents>
	<VideoClicks>
		<ClickThrough><![CDATA[${banner['url']}]]></ClickThrough>
		<ClickTracking><![CDATA[${vast['third_party_click']}]]></ClickTracking>
	</VideoClicks>		
	<MediaFiles>
		<MediaFile id=\"GDFP\" delivery=\"progressive\" width=\"1280\" height=\"720\" type=\"video/mp4\" bitrate=\"533\" scalable=\"true\" maintainAspectRatio=\"true\"><![CDATA[${vast['vast_video_outgoing_filename']}]]></MediaFile>
	</MediaFiles>
	</Linear>
	</Creative>
	<Creative id=\"57857370976\" sequence=\"1\">
	<CompanionAds>
	<Companion id=\"57857370976\" width=\"300\" height=\"250\">
	<StaticResource creativeType=\"image/png\"></StaticResource>
	<TrackingEvents>
	<Tracking event=\"creativeView\"></Tracking>
	</TrackingEvents>
	<CompanionClickThrough>
	</CompanionClickThrough>
	</Companion>
	</CompanionAds>
	</Creative>
	</Creatives>
	</InLine>
	</Ad>
	</VAST>"; */
	
	$player	  = "<VAST version=\"3.0\">
	<Ad id=\"697200496\">
	<InLine>
	<AdSystem>MediaConverison</AdSystem>
	<AdTitle>Media Ads</AdTitle>
	<Description>MediaConverison Vast Tag</Description>
	<Error></Error>
	<Impression><![CDATA[${vast['vast_thirdparty_impression']}]]></Impression>
	<Creatives>
	<Creative id=\"57860459056\" sequence=\"1\">
	<Linear skipoffset=\"00:00:05\">
	<Duration>00:00:30</Duration>
	<TrackingEvents>
	<Tracking event=\"start\"><![CDATA[${vast['start_pixel']}]]></Tracking>
	<Tracking event=\"firstQuartile\"><![CDATA[${vast['quater_pixel']}]]></Tracking>
	<Tracking event=\"midpoint\"><![CDATA[${vast['mid_pixel']}]]></Tracking>
	<Tracking event=\"thirdQuartile\"><![CDATA[${vast['third_quater']}]]></Tracking>
	<Tracking event=\"complete\"><![CDATA[${vast['end_pixel']}]]></Tracking>
	<Tracking event=\"mute\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"unmute\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"rewind\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"pause\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"resume\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"fullscreen\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"creativeView\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"exitFullscreen\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"acceptInvitationLinear\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"closeLinear\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"skip\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"progress\" offset=\"00:00:05\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"progress\" offset=\"00:00:30\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	</TrackingEvents>
	<VideoClicks>
		<ClickThrough><![CDATA[${banner['url']}]]></ClickThrough>
		<ClickTracking><![CDATA[${vast['third_party_click']}]]></ClickTracking>
	</VideoClicks>		
	<MediaFiles>
		<MediaFile id=\"GDFP\" delivery=\"progressive\" width=\"1280\" height=\"720\" type=\"video/mp4\" bitrate=\"533\" scalable=\"true\" maintainAspectRatio=\"true\"><![CDATA[${vast['vast_video_outgoing_filename']}]]></MediaFile>
	</MediaFiles>
	</Linear>
	</Creative>
	<Creative id=\"57857370976\" sequence=\"1\">
	<CompanionAds>
	<Companion id=\"57857370976\" width=\"300\" height=\"250\">
	<StaticResource creativeType=\"image/png\"></StaticResource>
	<TrackingEvents>
	<Tracking event=\"creativeView\"></Tracking>
	</TrackingEvents>
	<CompanionClickThrough>
	</CompanionClickThrough>
	</Companion>
	</CompanionAds>
	</Creative>
	</Creatives>
	</InLine>
	</Ad>
	</VAST>"; 
	return $player;
	
	
}


function renderVastOutputForThirdParty($banner, $vast){
	$adSystem = 'media adserver';
	$adName   = $banner['description'];
	$vastAdDescription	= 'Inline Video Ad';
	
    $player   = "";
	header("Content-type: text/xml");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Origin: *");
	
	$player	="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<VAST  xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:noNamespaceSchemaLocation=\"vast_wrapper.xsd\" version=\"2.0.1\">
    <Ad id=\"15780383\">
        <Wrapper>
            <AdSystem>MediaConverison</AdSystem>
            <VASTAdTagURI><![CDATA[${vast['vast_tag']}]]></VASTAdTagURI>
            <Impression>
<![CDATA[${vast['vast_thirdparty_impression']}]]>
</Impression>
            <TrackingEvents>
			<Tracking event=\"start\">
<![CDATA[${vast['start_pixel']}]]>
</Tracking>
<Tracking event=\"complete\">
<![CDATA[${vast['end_pixel']}]]>
</Tracking>
<Tracking event=\"creativeView\">
<![CDATA[${vast['quater_pixel']}]]>
</Tracking>
<Tracking event=\"firstQuartile\">
<![CDATA[${vast['mid_pixel']}]]>
</Tracking>
<Tracking event=\"midpoint\">
<![CDATA[${vast['quater_pixel']}]]>
</Tracking>
<Tracking event=\"thirdQuartile\">
<![CDATA[${vast['third_quater']}]]>
</Tracking>
</TrackingEvents>
            <VideoClicks>
</VideoClicks>
        </Wrapper>
    </Ad>
</VAST >";
	
    return $player;
	
}


function renderPlayerInPage($aOut)
{
	
	$player = "";
	if ( isset($aOut['fullPathToVideo'] ) ){
		$player = <<<PLAYER
			<h3>Video ad preview</h3>
			<script type="text/javascript" src="{$aOut['videoPlayerJsUrl']}"></script>
			<style>
			a.player {
			    display:block;
			    width:640px;
			    height:360px;
			    margin:25px 0;
			    text-align:center;
			}
			</style>

			<a class="player" id="player"></a>
PLAYER;

		// encode data before echoing to the browser to prevent xss
		$aOut['videoFileName'] = encodeUserSuppliedData( $aOut['videoFileName'] );
        $aOut['videoNetConnectionUrl'] = encodeUserSuppliedData( $aOut['videoNetConnectionUrl'] );

		$httpPlayer = <<<HTTP_PLAYER

		    <!-- http flowplayer setup -->
            <script language="JavaScript">
            flowplayer("a.player", "${aOut['videoPlayerSwfUrl']}", {
               playlist: [ '${aOut['videoFileName']}' ],
                clip: {
                       autoPlay: ${aOut['isAutoPlayOfVideoInOpenXAdminToolEnabled']}
               },
               plugins: {

                   controls: {
                        url: escape('${aOut['videoPlayerControlsPluginUrl']}')
                   }
               }

            });
            </script>
HTTP_PLAYER;

        $rtmpPlayer = <<<RTMP_PLAYER

            <!-- rmtp flowplayer setup -->
            <script language="JavaScript">
            flowplayer("a.player", "${aOut['videoPlayerSwfUrl']}", {
               clip: {
                       url: '${aOut['videoFileName']}',
                       provider: 'streamer',
                       autoPlay: ${aOut['isAutoPlayOfVideoInOpenXAdminToolEnabled']}
               },

               plugins: {
                   streamer: {
                        // see http://flowplayer.org/forum/8/15861 for reason I use encode() function
                        url: escape('${aOut['videoPlayerRtmpPluginUrl']}'),
                        netConnectionUrl: '${aOut['videoNetConnectionUrl']}'
                   },
                   controls: {
                        url: escape('${aOut['videoPlayerControlsPluginUrl']}')
                   }
               }

            });
            </script>
RTMP_PLAYER;

        $webmPlayer = <<<WEBM_PLAYER

            <!-- HTML5 Webm setup -->
            <script type="text/javascript">
                (function (p) {
                    p.html('<video width="640" height="360" controls><source src="{$aOut['fullPathToVideo']}" type="{$aOut['vastVideoType']}"/>You need an HTML5 compatible player, sorry</video>');
                })($("#player"));
            </script>

WEBM_PLAYER;

        if ( $aOut['videoDelivery'] == 'player_in_http_mode' ){
            if ($aOut['vastVideoType'] == 'video/webm') {
                $player .= $webmPlayer;
            } else {
                $player .= $httpPlayer;
            }
        }
        else if ( $aOut['videoDelivery'] == 'player_in_rtmp_mode' ) {
            $player .= $rtmpPlayer;
        }
        else {
            // default to rtmp play format
            $player .= $rtmpPlayer;
        }
    }
	//echo $player;die;
    return $player;
}

function renderCompanionInAdminTool($aOut)
{
    $player = "";
    if(isset($aOut['companionMarkup'])) {
        $player .=  "<h3>Companion Preview (" .$aOut['companionWidth'] . "x" . $aOut['companionHeight'] . ")</h3>";
        $player .= $aOut['companionMarkup'];
        /*$aBanner = Admin_DA::getAd($aOut['companionId']);
        $aBanner['bannerid'] = $aOut['companionId'];
        $bannerCode = MAX_adRender($aBanner, 0, '', '', '', true, '', false, false);
        $player .=  "<h3>Companion Preview</h3>";
        $player .= "This companion banner will appear during the duration of the Video Ad in the DIV specified in the video player plugin configuration. ";
        if(!empty($aOut['companionWidth'])) {
            $player .= " It has the following dimensions: width = ". $aOut['companionWidth'] .", height = ".$aOut['companionHeight'] .". ";
        }
        $player .= "<a href='".VideoAdsHelper::getHelpLinkVideoPlayerConfig()."' target='_blank'>Learn more</a><br/><br/>";
        $player .= $bannerCode;*/
        $player .= "<br>";
    }
    return $player;
}

function renderOverlayInAdminTool($aOut, $aBanner)
{

    $title =  "Overlay Preview";
    $borderStart = "<div style='color:black;text-decoration:none;border:1px solid black;padding:15px;'>";
    $borderEnd = "</div>";
    $htmlOverlay = '';
    switch($aOut['overlayFormat']) {
        case VAST_OVERLAY_FORMAT_HTML:
            $htmlOverlay = $borderStart . $aOut['overlayMarkupTemplate'] . $borderEnd;
        break;

        case VAST_OVERLAY_FORMAT_IMAGE:
            $title = "Image Overlay Preview";
            $imagePath = getImageUrlFromFilename($aOut['overlayFilename']);
            $htmlOverlay = "<img border='0' src='$imagePath' />";
        break;

        case VAST_OVERLAY_FORMAT_SWF:
            $title = "SWF Overlay Preview";
            // we need to set a special state for adRenderFlash to work (which tie us to this implementation...)
            $aBanner['type'] = 'web';
            $aBanner['width'] = $aOut['overlayWidth'];
            $aBanner['height'] = $aOut['overlayHeight'];
            $htmlOverlay = _adRenderFlash($aBanner, $zoneId=0, $source='', $ct0='', $withText=false, $logClick=false, $logView=false);
        break;

        case VAST_OVERLAY_FORMAT_TEXT:
            $title = "Text Overlay Preview";
            $overlayTitle = $aOut['overlayTextTitle'];
            $overlayDescription = str_replace("\n","<br/>",$aOut['overlayTextDescription']);
            $overlayCall = $aOut['overlayTextCall'];
            $htmlOverlay = "
            	$borderStart
                    <div style='font-family:arial;font-size:18pt;font-weight:bold;'>$overlayTitle </div>
                    <div style='font-family:arial;font-size:15pt;'>$overlayDescription</div>
                    <div style='font-family:arial;font-size:15pt;font-weight:bold;color:orange;'>$overlayCall</div>
                $borderEnd
            ";
        break;
    }


    $htmlOverlayPrepend = 'The overlay will appear on top of video content during video play.';

    switch($aOut['overlayFormat']) {
        case VAST_OVERLAY_FORMAT_IMAGE:
        case VAST_OVERLAY_FORMAT_SWF:
            $htmlOverlayPrepend .= " This overlay has the following dimensions: width = " . $aOut['overlayWidth'] . ", height = " . $aOut['overlayHeight'] . ".";
        break;
    }
    if ($aOut['overlayDestinationUrl']) {
        $htmlOverlayPrepend .= ' In the video player, this overlay will be clickable.';
        $htmlOverlay =  "<a target=\"_blank\" href=\"${aOut['overlayDestinationUrl']}\"> {$htmlOverlay}</a>";
    }

    $htmlOverlay = $htmlOverlayPrepend . '<br/><br/>' . $htmlOverlay;

    $player = "<h3>$title</h3>";
    $player .= $htmlOverlay;
    $player .= "<br>";
    return $player;
}

// if bcmath php extension not installed
if ( !(function_exists('bcmod'))) {
    /**
     * for extremely large numbers of seconds this will break
     * but for video we will never have extremely large numbers of seconds
     *
     * see http://www.php.net/manual/en/language.operators.arithmetic.php
     **/
    function bcmod( $x, $y )
    {
        $mod= $x % $y;

        return (int)$mod;
    }

}// end of if bcmath php extension not installed

function secondsToVASTDuration($seconds)
{
    $hours = intval(intval($seconds) / 3600);
    $minutes = bcmod((intval($seconds) / 60),60);
    $seconds = bcmod(intval($seconds),60);
    $ret = sprintf( "%02d:%02d:%02d", $hours, $minutes, $seconds );
    return $ret;
}

	
	function vastparser($vastnetconnecturl, $description){
		//$vastnetconnecturl 		 = $_SERVER['DOCUMENT_ROOT']."/test/vast/vast.xml";
		//$vastnetconnecturl		 = 'http://demo.tremorvideo.com/proddev/vast/vast_inline_linear.xml';
		//$vastnetconnecturl		 = 'https://www.lycatv.tv/ads/get_vast_tag/57';
		//$vastnetconnecturl 		 = "https://loopme.me/api/vast/ads?appId=e18c19fa43&vast=2&uid=1234&ip=8.8.8.8&bundleid=com.loopme&appname=my_talking_pet&sdk=16.2&exchange=admarvel";
		//$target_dir			 = $vastnetconnecturl;
		//echo $vastnetconnecturl;die;
		//$vastnetconnecturl	= 'https://pubads.g.doubleclick.net/gampad/ads?sz=640x480&iu=/124319096/external/single_ad_samples&ciu_szs=300x250&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&cust_params=deployment%3Ddevsite%26sample_ct%3Dskippablelinear&correlator=[timestamp]%27';
		//echo $xml11 			= file_get_contents($vastnetconnecturl);
	
		$xml 				 	= simplexml_load_file($vastnetconnecturl);
	
		
	
		if(isset($xml->Ad->Wrapper)){
			while(isset($xml->Ad->Wrapper)){
				if(isset($xml->Ad->Wrapper->VASTAdTagURL->URL)){
					$VASTAdTagURL	= (string)$xml->Ad->Wrapper->VASTAdTagURL->URL;
				}elseif(isset($xml->Ad->Wrapper->VASTAdTagURI)){
					$VASTAdTagURL	= (string)$xml->Ad->Wrapper->VASTAdTagURI;
				}else{
					$VASTAdTagURL	= (string)$xml->Ad->Wrapper->VASTAdTagURL;
				}
				$xml 				 = simplexml_load_file($VASTAdTagURL);
			}
		}
		
		
			//echo '<pre>';print_r($xml);die;
			//echo '<pre>';print_r($xml);die;
			//echo '<pre>';print_r((string)$xml->Ad->InLine->Video);die;
			$video = array();
			
			if(isset($xml->Ad->InLine->Creatives->Creative[0]) && $xml->Ad->InLine->Creatives->Creative[0]){
				
				if($xml->Ad->InLine->Impression){
						$video['vast_thirdparty_impression']=  (string)$xml->Ad->InLine->Impression;
					}
					
					if(isset($xml->Ad->InLine->Creatives->Creative[0])){
						$creatives		= $xml->Ad->InLine->Creatives->Creative[0];
					}
					if(isset($creatives->Linear->Duration)){
						$video['vast_video_duration']	= (string)$creatives->Linear->Duration;
						
					
					//tracking events
					}if(isset($creatives->Linear->TrackingEvents)){
						$creativeView	= $creatives->Linear->TrackingEvents;			
					}
					if(isset($creativeView->Tracking[0])){
						$video['creative_view']		= (string)$creativeView->Tracking[0];
					}
					if(isset($creativeView->Tracking[1])){
						$video['start_pixel']			= (string)$creativeView->Tracking[1];
						
					}
					if(isset($creativeView->Tracking[2])){
						$video['mid_pixel']		= (string)$creativeView->Tracking[2];
						
					}
					if(isset($creativeView->Tracking[3])){
						$video['start_pixel']	= (string)$creativeView->Tracking[3];
						
					}
					if(isset($creativeView->Tracking[4])){
						$video['quater_pixel']	= (string)$creativeView->Tracking[4];
						
					}
					if(isset($creativeView->Tracking[5])){
						$video['end_pixel']		= (string)$creativeView->Tracking[5];
					}
					if(isset($creatives->Linear->VideoClicks->ClickThrough)){
						$video['vast_video_clickthrough_url']	= (string)$creatives->Linear->VideoClicks->ClickThrough;
						
					}if(isset($creatives->Linear->VideoClicks->ClickTracking)){
						$video['third_party_click']	= (string)$creatives->Linear->VideoClicks->ClickTracking;
						
					}if(isset($creatives->Linear->MediaFiles->MediaFile)){
						$video['vast_video_outgoing_filename']	= (string)$creatives->Linear->MediaFiles->MediaFile;
						$video['vast_video_delivery']			= (string)$creatives->Linear->MediaFiles->MediaFile['delivery'];
						$video['vast_video_type']				= (string)$creatives->Linear->MediaFiles->MediaFile['type'];
						$video['vast_video_bitrate']			= (string)$creatives->Linear->MediaFiles->MediaFile['bitrate'];
						$video['vast_video_width']				= (string)$creatives->Linear->MediaFiles->MediaFile['width'];
						$video['vast_video_height']				= (string)$creatives->Linear->MediaFiles->MediaFile['height'];
					}
					
					//campaign attribute	
					if(isset($xml->Ad->InLine->Creatives->Creative[1])){
						$creatives					= $xml->Ad->InLine->Creatives->Creative[1];
						
					}if(isset( $creatives->CompanionAds->Companion[0]['height'])){
						$banner['height']	= (string)$creatives->CompanionAds->Companion[0]['height'];
					
					}if(isset($creatives->CompanionAds->Companion[0]['width'])){
						$banner['width']	= (string)$creatives->CompanionAds->Companion[0]['width'];
					
					}if(isset($creatives->CompanionAds->Companion->StaticResource)){
						$banner['imageurl']	= (string)$creatives->CompanionAds->Companion->StaticResource;
					
					}if(isset($creatives->CompanionAds->Companion->TrackingEvents->Tracking)){
						$CompanionClickThrough		= (string)$creatives->CompanionAds->Companion->TrackingEvents->Tracking;
					}
					
			}else{
				if(isset($xml->Ad->InLine)){
					
					$inline		= $xml->Ad->InLine;
					if(isset($inline->Impression->URL)){
							$video['vast_thirdparty_impression']=  (string)$inline->Impression->URL;
					}
					if(isset($inline->Video->MediaFiles->MediaFile)){
							$video['vast_video_outgoing_filename']	= (string)$inline->Video->MediaFiles->MediaFile->URL;
							$video['vast_video_delivery']			= (string)$inline->Video->MediaFiles->MediaFile['delivery'];
							$video['vast_video_type']				= (string)$inline->Video->MediaFiles->MediaFile['type'];
							$video['vast_video_bitrate']			= (string)$inline->Video->MediaFiles->MediaFile['bitrate'];
							$video['vast_video_width']				= (string)$inline->Video->MediaFiles->MediaFile['width'];
							$video['vast_video_height']				= (string)$inline->Video->MediaFiles->MediaFile['height'];
					}
					if(isset($inline->Video->VideoClicks->ClickThrough->URL)){
						$video['vast_video_clickthrough_url']	= (string)$inline->Video->VideoClicks->ClickThrough->URL;
					}
					
					if(isset($inline->TrackingEvents->Duration)){
						$video['vast_video_duration']	= (string)$creatives->Linear->Duration;
							
					}
					//tracking events

					if(isset($inline->TrackingEvents)){
						
							$trackingEvents			= $inline->TrackingEvents;			
						if(isset($trackingEvents->Tracking[0]->URL)){
							$video['start_pixel']		= (string)$trackingEvents->Tracking[0]->URL;
						}
						if(isset($trackingEvents->Tracking[1]->URL)){
							$video['quater_pixel']			= (string)$trackingEvents->Tracking[1]->URL;
							
						}
						if(isset($trackingEvents->Tracking[2]->URL)){
							$video['mid_pixel']		= (string)$trackingEvents->Tracking[2]->URL;
							
						}
						if(isset($trackingEvents->Tracking[3]->URL)){
							$video['third_quater_pixel']	= (string)$trackingEvents->Tracking[3]->URL;
							
						}
						if(isset($trackingEvents->Tracking[4]->URL)){
							$video['end_pixel']	= (string)$trackingEvents->Tracking[4]->URL;
						}
					}
				
				}
			}
		
			$banner['storagetype'] 		= 'html';
			$banner['ext_bannertype'] 	= 'upload_video';
			$banner['description'] 		= $description;
			

			//echo '<pre>';print_r($video);print_r($banner);die;
			return array($banner, $video);
			
		/* echo '<pre>';
		print_r($xml);die;
		echo 'xml verison : '.$xml['version']."<br>";
		echo 'Ad  Id : '.$xml->Ad['id']."<br>";
		echo $xml->Ad->InLine->AdSystem."<br>";
		echo $xml->Ad->InLine->AdTitle."<br>";
		
		$creatives			= $xml->Ad->InLine->Creatives->Creative[0];
		echo $creatives->Linear->Duration."<br>";
		echo $creatives->Linear->MediaFiles->MediaFile['height']."<br>";
		echo $creatives->Linear->MediaFiles->MediaFile['width']."<br>";
		echo $creatives->Linear->MediaFiles->MediaFile['type']."<br>";
		
		$creatives			= $xml->Ad->InLine->Creatives->Creative[1];
		echo $creatives->CompanionAds->Duration."<br>";
		echo $creatives->CompanionAds->Companion['height']."<br>";
		echo $creatives->CompanionAds->Companion['width']."<br>";
		echo $creatives->CompanionAds->Companion['id']."<br>";
		
		die;
		print_r($xml->Ad->InLine->AdSystem);
		print_r($xml->Ad->InLine->AdSystem);
		print_r($xml->Ad->InLine->AdSystem);
		print_r($xml->Ad->InLine->AdSystem);

		die;
		print_r($xml);die; */
	}
	
	
	function vasttags($banner, $vast){
	}
	
	function  generateVastVideoZoneInvocationCode($zoneId){
	}
	
	function generateVideoZoneInvocationCode($zoneid=null,$campaignid =null, $bannerid =null,$clickTag=null, $thirdPartyServer=null){
		$ssrc	 = $GLOBALS['deliveryCorePath']."preroll.php";


		$src	 = str_replace('https','http',$ssrc);
		$buffer	 = '';
        $buffer .= "<script type='text/javascript'><!--//<![CDATA[\n";
        $buffer .= "  var url=window.location.host; var m3_u = (location.protocol=='https:'?'".$ssrc."?domain='+url:'".$src."?domain='+url);\n";
		$buffer .= "  var m3_r = Math.floor(Math.random()*99999999999);\n";

		if(!is_null($thirdPartyServer)){
			if($thirdPartyServer == 'doubleclick'){
				//$buffer .= "   m3_r  = '%%CACHEBUSTER%%'\n";
			}
		}
        
        $buffer .= "   if (!document.MAX_used) document.MAX_used = ',';\n";
        $buffer .= "   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);\n";
		$buffer .= "   document.write (\"&zoneid=".$zoneid."\");\n";
		
		if(!is_null($thirdPartyServer)){
			if($thirdPartyServer == 'revive'){
				$buffer .= "   document.write ('&amp;clickTag=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;cb=' + m3_r);\n";

			}elseif($thirdPartyServer == 'newdoubleclick'){
				$buffer .= "   document.write ('&amp;click=%%VIEW_URL_UNESC%%".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;ord=' + m3_r);\n";
				
			}elseif($thirdPartyServer == 'doubleclick'){
				
				$buffer .= "   document.write ('&click=%%CLICK_URL_UNESC%%".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;ord=' + m3_r);\n";
				 
			}elseif($thirdPartyServer == 'zedo'){
				$buffer .= "   document.write ('&amp;l=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;z=' + m3_r);\n";


				
			}elseif($thirdPartyServer == 'adtech'){
				$buffer .= "   document.write ('&amp;rdclick=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;misc=' + m3_r);\n";


				
			}else{
				$buffer .= "   document.write ('&amp;clickTag=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;cb=' + m3_r);\n";
			}
		}
		
		
		$buffer .= " document.write (\"&amp;loc=\" + escape(window.location));\n";
		$buffer .="  document.write ('&cb=' + m3_r);\n";

		$buffer .= "   document.write (\"'><\\/scr\"+\"ipt>\");\n";
        $buffer .= "//]]>--></script>";
		$buffer .= "<noscript><a href='".$GLOBALS['deliveryCorePath']."' target='_blank'><img src='".$GLOBALS['deliveryCorePath']."setdefaultimage?bannerid=".$bannerid."' border='0' alt=''/></a></noscript>\n";
        return $buffer;
		
	}
	


	function generateVideoInvocationCode($campaignid =null, $bannerid =null,$clickTag=null, $thirdPartyServer=null){
		$ssrc	 = $GLOBALS['deliveryCorePath']."preroll.php";


		$src	 = str_replace('https','http',$ssrc);
		$buffer	 = '';
        $buffer .= "<script type='text/javascript'><!--//<![CDATA[\n";
        $buffer .= "  var url=window.location.host; var m3_u = (location.protocol=='https:'?'".$ssrc."?domain='+url:'".$src."?domain='+url);\n";
		$buffer .= "  var m3_r = Math.floor(Math.random()*99999999999);\n";

		if(!is_null($thirdPartyServer)){
			if($thirdPartyServer == 'doubleclick'){
				//$buffer .= "   m3_r  = '%%CACHEBUSTER%%'\n";
			}
		}
        
        $buffer .= "   if (!document.MAX_used) document.MAX_used = ',';\n";
        $buffer .= "   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);\n";
		$buffer .= "   document.write (\"&bannerid=".$bannerid."\");\n";
		
		if(!is_null($thirdPartyServer)){
			if($thirdPartyServer == 'revive'){
				$buffer .= "   document.write ('&amp;clickTag=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;cb=' + m3_r);\n";

			}elseif($thirdPartyServer == 'newdoubleclick'){
				$buffer .= "   document.write ('&amp;click=%%VIEW_URL_UNESC%%".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;ord=' + m3_r);\n";
				
			}elseif($thirdPartyServer == 'doubleclick'){
				
				$buffer .= "   document.write ('&click=%%CLICK_URL_UNESC%%".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;ord=' + m3_r);\n";
				 
			}elseif($thirdPartyServer == 'zedo'){
				$buffer .= "   document.write ('&amp;l=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;z=' + m3_r);\n";


				
			}elseif($thirdPartyServer == 'adtech'){
				$buffer .= "   document.write ('&amp;rdclick=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;misc=' + m3_r);\n";


				
			}else{
				$buffer .= "   document.write ('&amp;clickTag=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;cb=' + m3_r);\n";
			}
		}
		
		
		$buffer .= " document.write (\"&amp;loc=\" + escape(window.location));\n";
		$buffer .="  document.write ('&cb=' + m3_r);\n";

		$buffer .= "   document.write (\"'><\\/scr\"+\"ipt>\");\n";
        $buffer .= "//]]>--></script>";
		$buffer .= "<noscript><a href='".base_url()."users/adtrack' target='_blank'><img src='".base_url()."users/setdefaultimage?bannerid=".$bannerid."' border='0' alt=''/></a></noscript>\n";
        return $buffer;
		
	}
	
	
	/**
     * Return invocation code for this plugin (codetype)
     *
     * @return string
     */
    function generateIframeInvocationCode($campaignid =null, $bannerid =null, $width, $height)
    {
		
		$parameters	 = "";
		$buffer		 = "";
        $uniqueid	 = 'a'.substr(md5(uniqid('', 1)), 0, 7);
		$frame_width = $width;
		$frame_height= $height;

		$buffer .= "<iframe id='{$uniqueid}' name='{$uniqueid}' src='".base_url()."users/renderiframes?bannerid=".$bannerid;
		$buffer .= "&amp;cb=INSERT_NUMBER_HERE";
		$buffer .= "' frameborder='0' scrolling='no'";
		$buffer .= " width='".$frame_width."'";
		$buffer .= " height='".$frame_height."'";
		$buffer .= " allowtransparency='true'";
		$buffer .= ">";
		$buffer .= "</iframe>\n";

        /* if (isset($mi->target) && $mi->target != '') {
            $mi->parameters['target'] = "target=".urlencode($mi->target);
        }
        if (isset($mi->ilayer) && $mi->ilayer == 1 && isset($mi->frame_width) && $mi->frame_width != '' && $mi->frame_width != '-1' && isset($mi->frame_height) && $mi->frame_height != '' && $mi->frame_height != '-1') {
            $mi->parameters['rewrite'] = 'rewrite=0';
            $buffer .= "\n\n";
            $buffer .= "<!-- " . $this->translate("Placement Comment") . " -->\n";
            $buffer .= "<layer src='".MAX_commonConstructDeliveryUrl($conf['file']['frame']);
            $buffer .= "?n=".$uniqueid;
            if (sizeof($mi->parameters) > 0) {
                $buffer .= "&".implode ("&", $mi->parameters);
            }
            $buffer .= "' width='".$mi->frame_width."' height='".$mi->frame_height."' visibility='hidden' onload=\"moveToAbsolute(layer".$uniqueid.".pageX,layer".$uniqueid.".pageY);clip.width=".$mi->frame_width.";clip.height=".$mi->frame_height.";visibility='show';\"></layer>";
        }

        if (!isset($mi->iframetracking) || $mi->iframetracking != 0) {
            $buffer .= "<script type='text/javascript' src='".MAX_commonConstructDeliveryUrl($conf['file']['google'])."'></script>";
        } */
		return $buffer;
    }
	
	
	
	/**
     * Return invocation code for this plugin (codetype)
     *
     * @return string
     */
    function exscrptInvocationTag($src, $noscript, $impressionUrl){
		$buffer	="";
		$buffer	.=" \n";
		$buffer .="  var m3_u = (location.protocol=='https:'?'".$src."':'".$src."');\n";
		$buffer .="   var m3_r = Math.floor(Math.random()*99999999999);\n";
		$buffer .="  if (!document.MAX_used) document.MAX_used = ',';\n";
		$buffer .="  document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);\n";
		$buffer .="  document.write (\"?bannerid=61\");\n";
		$buffer .="  document.write ('&cb=' + m3_r);\n";
		$buffer .="  document.write (\"'><\\/scr\"+\"ipt>\");\n";
		$buffer  .=" \n";
		
		$buffer .="  document.write (\"<noscr\"+\"ipt>\");\n";
		$buffer .="  document.write ('<a href=\"http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=brd&FlightID=18355922&Page=&PluID=0&Pos=1288844910\" target=\"_blank\"><img src=\"http://bs.serving-sys.com/BurstingPipe/adServer.bs?cn=bsr&FlightID=18355922&Page=&PluID=0&Pos=1288844910\"></a>')\n";
        $buffer	.="  document.write (\"<\\/noscr\"+\"ipt>\")\n"; 
		return $buffer;
    }
	
	
	
	
	function generatescriptforextranaliframe($bannerid){
		$buffer	 = '';
        $buffer .= "<script type='text/javascript'><!--//<![CDATA[\n";
        $buffer .= "  var url=window.location.host; var m3_u = (location.protocol=='https:'?'".base_url()."users/renderextiframead?domain='+url:'".base_url()."users/renderextiframead?domain='+url);\n";
        $buffer .= "   var m3_r = Math.floor(Math.random()*99999999999);\n";
        $buffer .= "   if (!document.MAX_used) document.MAX_used = ',';\n";
        $buffer .= "   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);\n";
		$buffer .= "   document.write (\"&bannerid=".$bannerid."\");\n";
		$buffer .= "   document.write ('&amp;cb=' + m3_r);\n";
		//$buffer .= "   document.write (\"&amp;loc=\" + escape(window.location));\n";
		$buffer .= "   document.write (\"'><\\/scr\"+\"ipt>\");\n";

        $buffer .= "//]]>--></script>";
		
		return $buffer;
		
	}
	
	/**
     * Return invocation code for this plugin (codetype)
     *
     * @return string
     */
    function generateHtml5ZoneInvocationCode($zoneId=null, $thirdPartyServer=null,$clickTag=null,$campaignid = null){
		$ssrc	 = $GLOBALS['deliveryCorePath']."rendercreativead.php";

		$src	 = str_replace('https','http',$ssrc);
	
		
		
		$buffer	 = '';
        $buffer .= "<script type='text/javascript'><!--//<![CDATA[\n";
		$buffer .= "   var url  	= window.location.host;\n";
	    $buffer .= "   var m3_u 	= (location.protocol=='https:'?'".$ssrc."':'".$src."');\n";
        $buffer .= "   var m3_r 	= Math.floor(Math.random()*99999999999);\n";
		if(!is_null($thirdPartyServer)){
			if($thirdPartyServer == 'doubleclick'){
				$buffer .= "   m3_r  = '%%CACHEBUSTER%%'\n";
			}
		}
        
		$buffer .= "   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);\n";
		$buffer .= "   document.write (\"?zoneid=".$zoneId."\");\n";

		
		if(!is_null($thirdPartyServer)){
			if($thirdPartyServer == 'revive'){
				$buffer .= "   document.write ('&amp;clickTag=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;cb=' + m3_r);\n";

			
			}elseif($thirdPartyServer == 'newdoubleclick'){
				$buffer .= "   document.write ('&amp;click=%%VIEW_URL_UNESC%%".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;ord=' + m3_r);\n";
				
			}elseif($thirdPartyServer == 'doubleclick'){
				
				$buffer .= "   document.write ('&click=%%CLICK_URL_UNESC%%".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;ord=' + m3_r);\n";
			
				
			}elseif($thirdPartyServer == 'zedo'){
				$buffer .= "   document.write ('&amp;l=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;z=' + m3_r);\n";


				
			}elseif($thirdPartyServer == 'adtech'){
				$buffer .= "   document.write ('&amp;rdclick=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;misc=' + m3_r);\n";


				
			}else{
				$buffer .= "   document.write ('&amp;clickTag=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;cb=' + m3_r);\n";
			}
		}else{
				$buffer .= "   document.write ('&amp;click=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;cb=' + m3_r);\n";
			
		}
		$buffer .= "   document.write ('&amp;url=' + url);\n";
		$buffer .= "   document.write (\"&amp;loc=\" + escape(window.location));\n";
   
		// Only pass in the 3rd party click URL if it is required and (probably) a valid URL (i.e. not a macro like '%c')
		// $buffer .= "   if ((typeof(document.MAX_ct0) != 'undefined') && (document.MAX_ct0.substring(0,4) == 'http')) {\n";
		//$buffer  .= "   document.write (\"&amp;ct0=\" + escape(document.MAX_ct0));\n   }\n";
        
       

		$buffer .= "   document.write (\"'><\\/scr\"+\"ipt>\");\n";
        $buffer .= "//]]>--></script>";
		$buffer .= "\n<noscript><a href='".$GLOBALS['deliveryCorePath']."' target='_blank'><img src='".$GLOBALS['deliveryCorePath']."setdefaultimage?zoneid='".$zoneId."' border='0' alt=''/></a></noscript>\n";
        return $buffer;
    }
	
	
	
	
	/**
     * Return invocation code for this plugin (codetype)
     *
     * @return string
     */
    function generateHtml5InvocationCode($campaignid = null, $bannerid = null, $clickTag=null, $thirdPartyServer=null){
		$ssrc	 = $GLOBALS['deliveryCorePath']."rendercreativead.php";

		$src	 = str_replace('https','http',$ssrc);
	
		
		
		$buffer	 = '';
        $buffer .= "<script type='text/javascript'><!--//<![CDATA[\n";
		$buffer .= "   var url  	= window.location.host;\n";
	    $buffer .= "   var m3_u 	= (location.protocol=='https:'?'".$ssrc."':'".$src."');\n";
        $buffer .= "   var m3_r 	= Math.floor(Math.random()*99999999999);\n";
		if(!is_null($thirdPartyServer)){
			if($thirdPartyServer == 'doubleclick'){
				$buffer .= "   m3_r  = '%%CACHEBUSTER%%'\n";
			}
			
		}
        
		$buffer .= "   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);\n";
		$buffer .= "   document.write (\"?bannerid=".$bannerid."\");\n";

		
		if(!is_null($thirdPartyServer)){
			if($thirdPartyServer == 'revive'){
				$buffer .= "   document.write ('&amp;clickTag=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;cb=' + m3_r);\n";

			
			}elseif($thirdPartyServer == 'newdoubleclick'){
				$buffer .= "   document.write ('&amp;click=%%VIEW_URL_UNESC%%".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;ord=' + m3_r);\n";
				
			}elseif($thirdPartyServer == 'doubleclick'){
				
				$buffer .= "   document.write ('&click=%%CLICK_URL_UNESC%%".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;ord=' + m3_r);\n";
			
				
			}elseif($thirdPartyServer == 'zedo'){
				$buffer .= "   document.write ('&amp;l=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;z=' + m3_r);\n";


				
			}elseif($thirdPartyServer == 'adtech'){
				$buffer .= "   document.write ('&amp;rdclick=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;misc=' + m3_r);\n";


				
			}else{
				$buffer .= "   document.write ('&amp;clickTag=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;cb=' + m3_r);\n";
			}
		}else{
				$buffer .= "   document.write ('&amp;click=".$clickTag."');\n";
				$buffer .= "   document.write ('&amp;cb=' + m3_r);\n";
			
		}
		$buffer .= "   document.write ('&amp;url=' + url);\n";
		$buffer .= "   document.write (\"&amp;loc=\" + escape(window.location));\n";
   
		// Only pass in the 3rd party click URL if it is required and (probably) a valid URL (i.e. not a macro like '%c')
		// $buffer .= "   if ((typeof(document.MAX_ct0) != 'undefined') && (document.MAX_ct0.substring(0,4) == 'http')) {\n";
		//$buffer  .= "   document.write (\"&amp;ct0=\" + escape(document.MAX_ct0));\n   }\n";
        
       

		$buffer .= "   document.write (\"'><\\/scr\"+\"ipt>\");\n";
        $buffer .= "//]]>--></script>";
		$buffer .= "\n<noscript><a href='".base_url()."users/adtrack' target='_blank'><img src='".base_url()."users/setdefaultimage?bannerid='".$bannerid."' border='0' alt=''/></a></noscript>\n";
        return $buffer;
    }
	
	/**
     * Return invocation code for this plugin (codetype)
     *
     * @return string
     */
    function generateWebZoneInvocationCode($zoneId=null,$thirdPartyServer=null,$clickTag=null,$campaignid =null, $bannerid =null){
        if (!is_null($campaignid)) {
        }
		
		//$ssrc	 = "https://crickbooks.com/delivery/core/renderad.php/";
		$ssrc	 = $GLOBALS['deliveryCorePath']."renderad.php";
		$src	 = str_replace('https','http',$ssrc);
		
		$buffer	 = '';
        $buffer .= "<script type='text/javascript'><!--//<![CDATA[\n";
        $buffer .= "  var url=window.location.host; var m3_u = (location.protocol=='https:'?'".$ssrc."?domain='+url:'".$src."?domain='+url);\n";
		$buffer .= "  var m3_r = Math.floor(Math.random()*99999999999);\n";
		if(!is_null($thirdPartyServer)){
			if($thirdPartyServer == 'doubleclick'){
				$buffer .= "   m3_r  = '%%CACHEBUSTER%%'\n";
			}
		}
		$buffer .= "  var url=window.location.host;\n";
        $buffer .= "   if (!document.MAX_used) document.MAX_used = ',';\n";
        // Removed the non-XHTML compliant "language='JavaScript'
        $buffer .= "   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);\n";
        /* if (count($mi->parameters) > 0) {
						//echo '<pre>';print_r($mi->parameters);die;

            $buffer .= "   document.write (\"?bannerid=".$bannerid."\");\n";
        } */
		$buffer .= "   document.write (\"&amp;zoneid=".$zoneId."\");\n";
		if($thirdPartyServer == 'doubleclick'){
				
			$buffer .= "   document.write ('&click=%%CLICK_URL_UNESC%%".$clickTag."');\n";
			$buffer .= "   document.write ('&amp;ord=' + m3_r);\n";
		}else{
			$buffer .= "   document.write ('&amp;cb=' + m3_r);\n";
		}
		$buffer .= "   document.write ('&amp;url=' + url);\n";
		$buffer .= "   document.write (\"&amp;loc=\" + escape(window.location));\n";
        $buffer .= "   document.write (\"'><\\/scr\"+\"ipt>\");\n";
        $buffer .= "//]]>--></script>";
 
        $buffer .= "<noscript><a href='".$GLOBALS['deliveryCorePath']."' target='_blank'><img src='".$GLOBALS['deliveryCorePath']."setdefaultimage?bannerid='".$bannerid." border='0' alt=''/></a></noscript>\n";
        
        return $buffer;
		
					
			
    }

	

	
	/**
     * Return invocation code for this plugin (codetype)
     *
     * @return string
     */
    function generateInvocationCode($campaignid =null, $bannerid =null, $clickTag, $thirdPartyServer=null){
        if (!is_null($campaignid)) {
        }
		//$ssrc	 = "https://crickbooks.com/delivery/core/renderad.php/";
		$ssrc	 = $GLOBALS['deliveryCorePath']."renderad.php";
		$src	 = str_replace('https','http',$ssrc);
		
		$buffer	 = '';
        $buffer .= "<script type='text/javascript'><!--//<![CDATA[\n";
        $buffer .= "  var url=window.location.host; var m3_u = (location.protocol=='https:'?'".$ssrc."?domain='+url:'".$src."?domain='+url);\n";
		$buffer .= "  var m3_r = Math.floor(Math.random()*99999999999);\n";
		if(!is_null($thirdPartyServer)){
			if($thirdPartyServer == 'doubleclick'){
				$buffer .= "   m3_r  = '%%CACHEBUSTER%%'\n";
			}
		}
		$buffer .= "  var url=window.location.host;\n";
        $buffer .= "   if (!document.MAX_used) document.MAX_used = ',';\n";
        // Removed the non-XHTML compliant "language='JavaScript'
        $buffer .= "   document.write (\"<scr\"+\"ipt type='text/javascript' src='\"+m3_u);\n";
        /* if (count($mi->parameters) > 0) {
						//echo '<pre>';print_r($mi->parameters);die;

            $buffer .= "   document.write (\"?bannerid=".$bannerid."\");\n";
        } */
		$buffer .= "   document.write (\"&amp;bannerid=".$bannerid."\");\n";
		if($thirdPartyServer == 'doubleclick'){
				
			$buffer .= "   document.write ('&click=%%CLICK_URL_UNESC%%".$clickTag."');\n";
			$buffer .= "   document.write ('&amp;ord=' + m3_r);\n";
		}else{
			$buffer .= "   document.write ('&amp;cb=' + m3_r);\n";
		}
		$buffer .= "   document.write ('&amp;url=' + url);\n";
		$buffer .= "   document.write (\"&amp;loc=\" + escape(window.location));\n";
        $buffer .= "   document.write (\"'><\\/scr\"+\"ipt>\");\n";
        $buffer .= "//]]>--></script>";
 
        $buffer .= "<noscript><a href='https://localhost/adserver/delivery/core' target='_blank'><img src='https://localhost/adserver/delivery/core/setdefaultimage?bannerid='".$bannerid." border='0' alt=''/></a></noscript>\n";
        
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
	
	
	function adRenderIframeVideo($bannerid){
		$sourceSrc	= "https://www.mediaconversion.com/report/newMobilePlayer/";
		$ifm		= "";
		$ifm		.=	"<script src='".$sourceSrc."jquery.js'></script>";
		$ifm		.=	"<script src='".$sourceSrc."mediaelement-and-player.min.js'></script>";
		$ifm		.=	"<script src='".$sourceSrc."homeiframebuster.js'></script>";
		$ifm 		.=  "<script type='text/javascript'> 
		var baseUrl			= '".base_url()."';
		var bannerId		= '".$bannerid."';
		</script>";
		return $ifm;
	
	}
	
	
	
	function adRenderVideo($banner, $vastdata, $vidcontent1, $source, $protocol=null,$dfpClickUrl, $ip=null,$iframe=null){
		$src		= base_url();
		if($protocol == 'HTTP/1.1' || $protocol == 'HTTP/1.0'){
			$src	= str_replace('https','http',$src);
		}
		if($banner[0]->ext_bannertype == 'create_video'){
			if(isset($vastdata[0]->vast_video_outgoing_filename) && $vastdata[0]->vast_video_outgoing_filename != ""){
				$videourl = $vastdata[0]->vast_video_outgoing_filename;
			}else{
				$videourl = 'no_ad';
			}
		}else{
			$videourl	= $vastdata[0]->vast_video_outgoing_filename;
		}
		
		if($vastdata[0]->skip_time	!='0' ){ 
			$skipTime	= $vastdata[0]->skip_time;
		}else{
			$skipTime	= 0;
		}
		
		if($vastdata[0]->skip=='1' ){
			$skipOption	= 'true'; 
		}else{
			$skipOption	= 'false';
		}
		
		if($vastdata[0]->mute=='0'){
			$mute		='false';
		}else{
			$mute		='true';
		}
		
		if($vastdata[0]->autoplay=='0'){
			$autoplay	= 'false';
		}else{
			$autoplay	= 'true';
		}
		
		if($vastdata[0]->vast_video_width==0){
			$width		= 500;
		}else{
			$width		= $vastdata[0]->vast_video_width;
		}
		
		if($vastdata[0]->vast_video_height==0){
			$height		= 400; 
		}else{
			$height		= $vastdata[0]->vast_video_height;
		}
		
		if(isset($vastdata[0]->start_pixel)){
			$startpixel	= "var x 	= document.createElement('img');
			x.src		= '".$vastdata[0]->start_pixel."';x.width='1';x.height='1';";
		}else{
			$startpixel	= "";
		}
		
		if(isset($vastdata[0]->end_pixel)){
			$endpixel	= "var x 	= document.createElement('img');
			x.src		= '".$vastdata[0]->end_pixel."';x.width='1';x.height='1';";
		}else{
			$endpixel	= "";
			
		} 
		if(isset($vastdata[0]->mid_pixel)){
			$midpixel	= "var x 	= document.createElement('img');
			x.src		= '".$vastdata[0]->mid_pixel."';x.width='1';x.height='1';";
		}else{
			$midpixel	= "";
			
		}
		
		if(isset($vastdata[0]->quater_pixel)){
			$quaterpixel	= "var x 	= document.createElement('img');
			x.src			= '".$vastdata[0]->quater_pixel."';x.width='1';x.height='1';";
		}else{
			$quaterpixel	= "";
		}
		
		if(isset($vastdata[0]->third_quater_pixel)){
			$thirdquaterpixel	= "var x 	= document.createElement('img');
			x.src		= '".$vastdata[0]->third_quater_pixel."';x.width='1';x.height='1';";
		}else{
			$thirdquaterpixel	= "";
		}
		
		if(isset($vastdata[0]->mute_pixel)){
			$mutepixel	= "var x 	= document.createElement('img');
			x.src		= '".$vastdata[0]->mute_pixel."';x.width='1';x.height='1';";
		}else{
			$mutepixel	= "";
		}
		
		if(isset($vastdata[0]->pause_pixel)){
			$pausepixel	= "var x 	= document.createElement('img');
			x.src		= '".$vastdata[0]->pause_pixel."';x.width='1';x.height='1';";
		}else{
			$pausepixel	= "";
		}
		
		if(isset($banner[0]->url) && $banner[0]->url){
			if($dfpClickUrl){
				$clickurl	= $dfpClickUrl;
			}else{
				$clickurl					= base_url().'users'.'/adtrack?bannerid='.$banner[0]->bannerid;
			}
		}else{
			//$lp						= "https://mediaconversion.com/";
			//$clickurl					= base_url().'users'.'/adtrack?bannerid='.$banner[0]->bannerid;
			$clickurl					= '';
			$clickurl					= base_url().'users'.'/adtrack?bannerid='.$banner[0]->bannerid;

		}
		
		if($vidcontent1){
			$contentVid	= base_url()."assets/videos/".$vidcontent1;
			$contentVid	= base_url()."assets/videos/swach bharat.mp4";
		}else{
			$contentVid	= base_url()."assets/videos/swach bharat.mp4";
		}
		$jspath		= "https://www.mediaconversion.com/report/NewVideoPlayer/AC_RunActiveContent.js";
		$swfpath	= "https://www.mediaconversion.com/report/NewVideoPlayer/video.swf";
		
		$sourceSrc	= "https://www.mediaconversion.com/report/newMobilePlayer/";
		
		
		$player		= "";
		
		
		if($iframe){
			$player		.=			"<script src='".$sourceSrc."jquery.js'></script>";

		}
		if($ip == 'partner.googleadservices.com' || 1){
			//$player		.=			"<script src='".$sourceSrc."jquery.js'></script>";
 		}
		$player		.=			"<script src='".$sourceSrc."mediaelement-and-player.min.js'></script>";
		$player		.=			"<link rel='stylesheet' href='".$sourceSrc."mediaelementplayer.min.css'/>";
		//$player	.=			"<script src='http://www.mediaconversion.com/report/newMobilePlayer/iframebuster.js'></script>";

		$autoPlayParam	= '';
		if($mute	==	'true'){
			$autoPlayParam = ' muted ';
			//$autoPlayParam	= 'controls autoplay loop muted playsinline';
			$autoPlayParam="controls autoplay muted playsinline";
				
		}else{
			
			$autoPlayParam = 'onloadstart="this.volume=0.1"';
			$autoPlayParam = ' controls autoplay muted playsinline';
		}
	if($banner[0]->description == 'Vivo_Newindianexpress' || $banner[0]->description == 'Thinkdigit_Vivo_ Desktop' || 	$banner[0]->description == 'indiatv_Desktop_ Vivo' || $banner[0]->description =='indiatv_Mobile_ Vivo' || 	   $banner[0]->description == 'Thinkdigit_Vivo_ Mobile' || $banner[0]->description == 'Video Pre roll' || $banner[0]->description =='In Article'){
			 $autoPlayParam 	= "controls autoplay loop muted playsinline";
			 $player		.="<script>
			 
			 function myFunction() {
					var x = document.getElementById('inread1_26817');
					var y = document.getElementById('closeDiv');

					x.style.display = 'none';
					y.style.display = 'none';

				}
			
				
				var vinterval=null;
				var pos		= null;
				var abc 	= 0;
			  				
				jQuery(window).scroll(function() {
					if(abc > 0)
					{
					 if( jQuery('#inread1_26817').length ) 
					 {
						var topPos	= parseInt(jQuery(this).scrollTop());
						var abctemp = abc - 200;
						if ( topPos >= abctemp){
							var x = document.getElementById('closeDiv');
							x.style.display = 'block';


							jQuery('#inread1_26817').slideDown(1000);
							
						}else{
							
							jQuery('#inread1_26817').slideUp(1000);
						}
					 }
					}
				});
			
			vinterval = setInterval(function(){
                if( jQuery('#inread1_26817').length ) 
				{
					pos = jQuery('.expando').offset();
					abc = parseInt(pos.top);
					clearInterval(vinterval);
				}	 
								 
			
			 
			}, 100);
		</script>"; 
		$player		.="<div class='expando' id='inread1_26817' style='display:inline-block;overflow:hidden;clear: both;width:100%;transition: none;height:auto; padding: 20px 0;'>";
		
		$player		.="	<div id='closeDiv' onclick='myFunction()'>
			<img src='".$sourceSrc."closeBtn.png' alt='close button' style='width:16px;height:16px;'>
			</div>";
		}
		
		
		
		
		$player		.=			"<script>";
		$player		.=			"
		
								var unmuteSound			= '".$mute."';
								var source1				= '".$source."';
								var playingName='ad';
								var adDuration=1;
								var counter = ".$skipTime.";
								var displaySkipBtn	= '".$skipOption."';
								var contentSource='".$contentVid."';
								var landingPageUrl='".$clickurl."';
								var start	='false';";
								
		$player		.=			"</script>";

								
		
		$player		.=			"<style>
		
		/* @media only screen and (min-width:1365px){
			#mep_0{height: 415px !important;}
		} */
		
		 
		
		
		
		#closeDiv{
			z-index: 99999;
			position: relative;
			float: right;
			padding: 25px;
			cursor:pointer;
		}
		
		#skipBtn { background-color: rgba(0, 0, 0, .5); bottom: 30%; color: #fff; cursor: pointer; height: 30px; line-height: 30px; position: absolute;right:0; text-align: center; width: 100px;font-family:verdana;margin-bottom:-80px;top:0;}
										#mask {position: absolute; width:100%;width: 100%;z-index: 9999999;}
										#player1 {width: 100% !important;-moz-width: 100% !important;
											padding: 0 1%;
											box-sizing: border-box;
											
										}</style>";
		$player		.= "<div style='position:relative;width:100%;height:100%;background:#000;padding:41px 0;'>
						<video ".$autoPlayParam." width='100%' height='100%'  onclick='window.open(landingPageUrl)' src='".$videourl."' type='video/mp4' id='player1' controls preload='no' ></video>
						<div id='skipBtn'></div>
						<div id='disableSlider'></div>
						</div>";
		$player		.="<script type='text/javascript'>
				
			jQuery('#player1').mediaelementplayer({
				success: function(player, node) {
					jQuery('#' + node.id + '-mode').html('mode: ' + player.pluginType);
				}
			});
			
			if(displaySkipBtn=='true'){
			   jQuery('#skipBtn').css('display','block');
			}else{
			   jQuery('#skipBtn').css('display','none');
			}

			

			new MediaElement('player1', {
	
				success: function (mediaElement, domObject) { 
				
				  if(playingName=='ad'){
			jQuery('.mejs-mediaelement').css('cursor','pointer');
			jQuery('.mejs-button.mejs-playpause-button.mejs-play').find('button').attr('title','Pause').css('display','none');
			jQuery('.mejs-time-rail').prepend('<div id=mask></div>');
		 }
				 
				if(jQuery('.mejs-controls').css('display')=='block'){
					
				}
				
				
				 
				mediaElement.addEventListener('ended', function(e) {
				  mediaElement.setSrc(contentSource);
				  mediaElement.play();
				  playingName='content';
				  
				  if(playingName=='content'){
					landingPageUrl = '';
					jQuery('.mejs-mediaelement').css('cursor','default');

					jQuery('.mejs-button.mejs-playpause-button.mejs-play').find('button').attr('title','Pause').css('display','block');
					jQuery('#disableSlider').css('display', 'none');
					
				  }
				  document.getElementById('skipBtn').style.display = 'none';
				 
				}, false);
				
				
				 mediaElement.addEventListener('loadeddata', function(e) {
				}, false);
				
				
				var link 	= document.getElementById('skipBtn');
				var host	= window.location.hostname;


				link.onclick = function () { mediaElement.setSrc(contentSource);
				jQuery('.mejs-button.mejs-playpause-button.mejs-play').find('button').attr('title','Pause').css('display','block');
				
				jQuery('#disableSlider').css('display', 'none');
				
				mediaElement.play();

				adDuration		=0;
				document.getElementById('skipBtn').style.display = 'none';
				playingName		='content';
			
				};
				
				 mediaElement.addEventListener('timeupdate', function(e) {
				   if(playingName=='ad'){
					   
				   
				  var durationBrake = Math.round(Math.round(mediaElement.duration)/4);
				  var duration		= durationBrake;
				  var event			= '';
				  
				  if(Math.round(mediaElement.currentTime)== 1&&start == 'false'){
					  ".$startpixel."
						eventname	= 'impression';
						var rand 	= Math.floor(Math.random()*99999999999);
						var x 		= document.createElement('img');
						x.src		='".$src."users/getevent?src='+host+'&event='+eventname+'&time='+duration+'&bannerid='+".$banner[0]->bannerid."+'&r='+rand;x.width='1';x.height='1';
					
						
						start ='true';
				  }
				  
				  if(Math.round(mediaElement.currentTime)==durationBrake && adDuration==1){
					  	".$quaterpixel."
						eventname	= 'firstquartile';
						var rand 	= Math.floor(Math.random()*99999999999);
						var x 		= document.createElement('img');
						x.src		='".$src."users/getevent?src='+host+'&event='+eventname+'&time='+duration+'&bannerid='+".$banner[0]->bannerid."+'&r='+rand;x.width='1';x.height='1';
					
				
				  adDuration=2;
				  }
				  
				  if(Math.round(mediaElement.currentTime)==durationBrake*2&&adDuration==2){
				 
				  ".$midpixel."
					eventname		= 'midpoint';	
					var rand 	= Math.floor(Math.random()*99999999999);
					var x 		= document.createElement('img');
					x.src		='".$src."users/getevent?src='+host+'&event='+eventname+'&time='+duration+'&bannerid='+".$banner[0]->bannerid."+'&r='+rand;x.width='1';x.height='1';
					
					adDuration=3;
				  }
				  
				   if(Math.round(mediaElement.currentTime)==durationBrake*3&&adDuration==3){
				
				  	".$thirdquaterpixel."
						eventname		= 'thirdquartile';	
						var rand 	= Math.floor(Math.random()*99999999999);
						var x 		= document.createElement('img');
						x.src		='".$src."users/getevent?src='+host+'&event='+eventname+'&time='+duration+'&bannerid='+".$banner[0]->bannerid."+'&r='+rand;x.width='1';x.height='1';
					
				  adDuration=4;
				  }
				  
				   if(Math.round(mediaElement.currentTime)==Math.round(mediaElement.duration)&&adDuration==4){
				 
				  adDuration=0;
				  	".$endpixel."
						
						eventname		= 'complete';	
						var rand 	= Math.floor(Math.random()*99999999999);
						var x 		= document.createElement('img');
						x.src		='".$src."users/getevent?src='+host+'&event='+eventname+'&time='+duration+'&bannerid='+".$banner[0]->bannerid."+'&r='+rand;x.width='1';x.height='1';
					
				  playingName='content';
				  }
				  
				  }
				  
				}, false);
				
				var interval = setInterval(function() {
					if(Math.round(mediaElement.currentTime)>0){
						if(counter!=0){
							counter--;
							document.getElementById('skipBtn').onclick = null;
						}
						
						if (counter == 0) {
							clearInterval(interval);
						}
					
					document.getElementById('skipBtn').innerHTML = 'Ad 00:0' + counter;
					if(counter==0){
						document.getElementById('skipBtn').innerHTML = 'Skip Ad';
						jQuery('#skipBtn').click(function(){
							landingPageUrl = '';
							jQuery('.mejs-mediaelement').css('cursor','default');
							
							playingName='content';
							if(playingName=='content'){
								jQuery('.mejs-button.mejs-playpause-button.mejs-play').find('button').attr('title','Pause').css('display','block');
								jQuery('#disableSlider').css('display', 'none');
							}
							if(document.getElementById('skipBtn').innerHTML==='Skip Ad'){
								mediaElement.setSrc(contentSource);
								mediaElement.play();
								jQuery(this).hide();
								jQuery('.mejs-controls.mejs-offscreen').find('button').attr('title','Pause').css('display','block');
								document.getElementById('player1').onclick = null;
								jQuery('#disableSlider').css('display', 'none');
							}
						});

					}				}}, 1000);
				mediaElement.play();
			},
			error: function () { 
			 
			}
	});

</script>";
	if($banner[0]->description == 'Vivo_Newindianexpress' || $banner[0]->description == 'Thinkdigit_Vivo_ Desktop' || $banner[0]->description == 'indiatv_Desktop_ Vivo' || $banner[0]->description =='indiatv_Mobile_ Vivo' ||
	$banner[0]->description == 'Thinkdigit_Vivo_ Mobile' || $banner[0]->description == 'Video Pre roll' || $banner[0]->description =='In Article' ){
		$player	.= "</div>";
	}
	
	
	$sourceSrc	= "https://www.mediaconversion.com/report/newMobilePlayer/";
	$ifm		= "";
	$ifm		.=			"<script src='".$sourceSrc."jquery.js'></script>";
	$ifm		.=			"<script src='".$sourceSrc."mediaelement-and-player.min.js'></script>";
/* 	$ifm		.=			"<link rel='stylesheet' href='".$sourceSrc."mediaelementplayer.min.css'/>";
 */	$ifm		.=			"<script src='https://www.mediaconversion.com/report/newMobilePlayer/iframebuster.js'></script>";
	 
	if($dfpClickUrl && $ip != 'partner.googleadservices.com' &&($banner[0]->description == 'Vivo_Newindianexpress' || $banner[0]->description == 'Thinkdigit_Vivo_ Desktop' || $banner[0]->description == 'indiatv_Desktop_ Vivo' || $banner[0]->description =='indiatv_Mobile_ Vivo' ||
	$banner[0]->description == 'Thinkdigit_Vivo_ Mobile' || $banner[0]->description == 'Video Pre roll' || $banner[0]->description =='In Article' )){
		 	$ifm 		.= "<script type='text/javascript'> 
			var referenceabc	= '".$dfpClickUrl."';
			var baseUrl			= '".base_url()."';
			var bannerId		= '".$banner[0]->bannerid."';
			</script>";

		return $ifm;
		
	}else{
		return $player;
	}
	
	
	
}
	

	function adRenderImage($banner, $width, $height, $host,$dfpClickUrl){
		if($width	== 0){
			$banner[0]->width	=0;
			$banner[0]->height	=0;
		}
		$imageUrl 			=base_url().'assets/banners/'.$banner[0]->filename;
		//$prepend = (!empty($aBanner['prepend']) && $useAppend) ? $aBanner['prepend'] : '';
		//$append = (!empty($aBanner['append']) && $useAppend) ? $aBanner['append'] : '';
		//$clickUrl = base_url().'users/adtrack?bannerid='.$banner[0]->bannerid.'&dest='.$banner[0]->url.'&host='.$host;
		//$clickUrl = base_url().'users/adtrack?bannerid='.$banner[0]->bannerid.'&host='.$host;
		if($dfpClickUrl == ""){
			$clickUrl = base_url().'users/adtrack?bannerid='.$banner[0]->bannerid.'&host='.$host;
		}else{
			$clickUrl = $dfpClickUrl;
		}

		$str	  = "<a href='".$clickUrl."' target='_blank'";
		$str	  .="><img src='".$imageUrl."' width='".$banner[0]->width."' height='".$banner[0]->height."' /></a>";
		
		$str		.=" <script>";
		$str	.=" var rand 	= Math.floor(Math.random()*99999999999);";
		$str	.=" var x 		= document.createElement('img');";
		$str	.=" x.src		= '".$banner[0]->tracking_pixel."'+'&r='+rand;x.width='1';x.height='1';";
		$str		.="</script>";

					
		return $str;
		/* $str 		="var clicktag = '';"
		$str .=  clicktag += "<"+"a href=\'".$clickUrl."\' target=\'_blank\'><"+"img src=\'http://localhost/reviveadserver/www/images/584087e620e71b7a7d60a08152eb39b6.jpg\' width=\'300\' height=\'250\' alt=\'\' title=\'\' border=\'0\' /><"+"/a><"+"div id=\'beacon_11b877d82f\' style=\'position: absolute; left: 0px; top: 0px; visibility: hidden;\'><"+"img src=\'http://localhost/reviveadserver/www/delivery/lg.php?bannerid=5&amp;campaignid=5&amp;zoneid=6&amp;loc=http%3A%2F%2Flocalhost%2Fcricmagic%2F&amp;cb=11b877d82f\' width=\'0\' height=\'0\' alt=\'\' style=\'width: 0px; height: 0px;\' /><"+"/div>\n";
		$str .="document.write(clicktag);";
		 */
	}
	
	

?>