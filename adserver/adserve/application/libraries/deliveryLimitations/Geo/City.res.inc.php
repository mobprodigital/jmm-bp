<style>
.box11 {
    margin-top: 20px;
    margin-bottom: 1px;
}

div.boxrow{
cursor: pointer;
    border-bottom: 1px #DDD solid;
    padding: 2px;
   
}

.box1 {
    height: 100px;
    width: 275px;
    background-color: #FFF;
    border: 1px solid #7F9DB9;
    overflow: auto;
    overflow-x: hidden;
    overflow-y: scroll;
    margin-top: 20px;
  
</style>



<?php


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
	function initCity($acl, $data){
		$pathPlugins = dirname(__FILE__) . '/data/';
		require $pathPlugins.'res-iso3166.inc.php';
		require $pathPlugins.'res-iso3166-2.inc.php';
		require $pathPlugins.'res-fips.inc.php';

		foreach ($OA_Geo_FIPS as $k => $v) {
			if ($k == 'US' || $k == 'CA') {
				$v = $OA_Geo_ISO3166_2[$k];
			}
			$res[$k] = array($OA_Geo_ISO3166[$k]) + $v;
		}
		uasort($res, create_function('$a,$b', 'return strcmp($a[0], $b[0]);'));
		if(empty($data)){
			$data	= null;
			
		}
		$html 				= displayRegionData1($acl, $res, $data, $acl['executionorder']);
		return $html;
	}
	
	 function displayRegionData1($acl, $res, $data=null, $executionorder){
		 
		$data 		= _expandData1($data);
		$tabindex 	=& $GLOBALS['tabindex'];
		$disabled	= '';

        $html 	= '';
        $html  .= "
            <table border='0' cellpadding='2'>
                <tr>
                    <th> Country &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                    <td>
                        <select name='acl[{$executionorder}][data][]' {$disabled}>";
                        foreach ($res as $countryCode => $countryName) {
                            if (count($countryName) === 1) { continue; }
                            $selected = ($data[0] == $countryCode) ? 'selected="selected"' : '';
                            $html .= "<option value='{$countryCode}' {$selected}>{$countryName[0]}</option>";
                        }
                        $html .= "
                        </select>
                    &nbsp;<input type='image' name='action[none]' src='" . base_url() . "assets/upimages/ltr/go_blue.gif' border='0' align='absmiddle' alt='Save'></td>
                </tr>";

        if (!empty($data[0])) {
			
			$aRegions = $res[$data[0]];
			unset($aRegions[0]);
			  $html  .= "  <tr>
                    <th><div class='box11'> States </div></th>
                    <td><div class='box11'>
                        <select name='acl[{$executionorder}][data][]' {$disabled}>";
                        foreach ($aRegions as $sCode => $sName) {
							if(isset($acl['state'])){$selected = ($acl['state'] == $sCode) ? 'selected="selected"' : '';}
							$html .= "<option value='{$sCode}' {$selected}>{$sName}</option>";
                        }
                        $html .= "
                        </select>
                    &nbsp;<input type='image' name='action[city]' src='" . base_url() . "assets/upimages/ltr/go_blue.gif' border='0' align='absmiddle' alt='Save'></div></td>
                </tr>";
			}
		
		/* echo $data[0];die;
		echo '<pre>';print_r($acl);die;	 */
		//echo '<pre>';print_r($list);die;
		if(isset($acl['state'])&& $data[0]=='IN'){
			
			$pathPlugins 			= dirname(__FILE__) . '/data/';
			require $pathPlugins.'city.php';
			$aRegions 			= $res[$data[0]];
			$stateCode			= $acl['state'];
			$statename			= $aRegions[$stateCode];

			$aCitys 		= $list[$statename];
			$aSelectedCitys = $data;
			//unset($aCitys[0]);
			unset ($aSelectedCitys[0]);
			unset ($aSelectedCitys[1]);
			
			//echo '<pre>';print_r($acl);die;	
			//echo '<pre>';print_r($list);die;
			


			$html .= "<tr><th> City </th><td><div class='box1'>";
			foreach ($aCitys as $sCode => $sName) {
				$html .= "<div class='boxrow'>";
				$html .= "<input tabindex='".($tabindex++)."' ";
				$html .= "type='checkbox' id='c_{$executionorder}_{$sCode}' name='acl[{$executionorder}][data][]' value='{$sCode}'".(in_array($sCode, $aSelectedCitys) ? ' CHECKED' : '').">{$sName}</div>";
			}
			$html .= "</div></td></tr>";
		
		}
		
		
        $html .= "
            </table>
        ";
		
		return $html;
        //$data = _flattenData($data);
    }

    /**
     * A private method to "flatten" a delivery limitation into the string format that is
     * saved to the database (either in the acls, acls_channel or banners table, when part
     * of a compiled limitation string).
     *
     * Flattens the country and region array into string format.
     *
     * @access private
     * @param mixed $data An optional, expanded form delivery limitation.
     * @return string The delivery limitation in flattened format.
     */
    function _flattenData1($data = null)
    {
        if (is_null($data)) {
            $data = $data;
        }
        if (is_array($data)) {
            $country = $data[0];
            unset($data[0]);
            return $country . '|' . implode(',', $data);

        }
        return $data;
    }

    /**
     * A private method to "expand" a delivery limitation from the string format that
     * is saved in the database (ie. in the acls or acls_channel table) into its
     * "expanded" form.
     *
     * Expands the string format into an array with the country code in the first
     * element, and the region codes in the remaining elements.
     *
     * @access private
     * @param string $data An optional, flat form delivery limitation data string.
     * @return mixed The delivery limitation data in expanded format.
     */
    function _expandData1($data = null)
    {
        if (is_null($data)) {
            $data = $data;
        }
        if (!is_array($data)) {
			
            $aData = strlen($data) ? explode('|', $data) : array();
            $aRegions = array();//MAX_limitationsGetAFromS($aData[1]);
            return array_merge(array($aData), $aRegions);
        }
        return $data;
    }

    /* function compile()
    {
        return $this->compileData($this->_preCompile($this->data));
    }

    function _preCompile($sData)
    {
        $aData = $this->_expandData($sData);
        $aData = MAX_limitationsGetPreprocessedArray($aData);
        return $this->_flattenData($aData);
    }
	
	function MAX_limitationsGetAFromS($sString){
		return strlen($sString) ? explode(',', $sString) : array();
	}
	 */
		


?>
