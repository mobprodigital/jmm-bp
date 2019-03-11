<?php 

	date_default_timezone_set("Asia/Calcutta");
		
	function Max_checkGeo_City($inputType, $compOpt){
		
		$GeoArr  			= explode(',', $inputType);
		$countryCode		= $GeoArr[0];
		$stateCode			= $GeoArr[1];
		unset($GeoArr[0]);
		unset($GeoArr[1]);
		
		include_once $GLOBALS['includePathLimitation']."libraries/geoip-api/src/geoip.inc";
		include_once $GLOBALS['includePathLimitation']."libraries/geoip-api/src/geoipcity.inc";
		include_once $GLOBALS['includePathLimitation']."libraries/geoip-api/src/geoipregionvars.php";
		$ipaddress 			= $_SERVER['REMOTE_ADDR'];
		$gi 				= geoip_open($GLOBALS['includePathLimitation']."libraries/geoip-api/src/GeoLiteCity.dat", GEOIP_STANDARD);
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
		
		
		include_once $GLOBALS['includePathLimitation']."libraries/geoip-api/src/geoip.inc";
		include_once $GLOBALS['includePathLimitation']."libraries/geoip-api/src/geoipcity.inc";
		include_once $GLOBALS['includePathLimitation']."libraries/geoip-api/src/geoipregionvars.php";
		$ipaddress 			= $_SERVER['REMOTE_ADDR'];
		$gi 				= geoip_open($GLOBALS['includePathLimitation']."libraries/geoip-api/src/GeoLiteCity.dat", GEOIP_STANDARD);
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
		include_once $GLOBALS['includePathLimitation'].'libraries/Mobile_Detect.php';

		//$ci->load->library('Mobile_Detect');
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
		
		include_once $GLOBALS['includePathLimitation'].'libraries/UserAgent.php';
		include_once $GLOBALS['includePathLimitation'].'libraries/Browser.php';
		include_once $GLOBALS['includePathLimitation'].'libraries/BrowserDetector.php';
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
		
		include_once $GLOBALS['includePathLimitation'].'libraries/UserAgent.php';
		include_once $GLOBALS['includePathLimitation'].'libraries/Os.php';
		include_once $GLOBALS['includePathLimitation'].'libraries/OsDetector.php';
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
?>