<?php 

class Limitationdata{
	
	function __construct(){
		
        $this->nameEnglish = 'Client - Browser (Legacy)';
    }
	
    function displayArrayData($executionorder =0, $data, $inputData){
		$tabindex =& $GLOBALS['tabindex'];
		$i = 0;
		$html 	= '';
		$html 	.= "<table cellpadding='3' cellspacing='3'>";
		foreach ($inputData as $key => $value) {
            $value = htmlspecialchars($value, ENT_QUOTES);
			if ($i % 4 == 0) $html 	.= "<tr>";
			$html 	.= "<td><input type='checkbox' name='acl[{$executionorder}][data][]' value='$key'".(in_array($key, $data) ? ' checked="checked"' : '')." tabindex='".($tabindex++)."'>".$value."</td>";
			if (($i + 1) % 4 == 0) $html 	.= "</tr>";
			$i++;
		}
		if (($i + 1) % 4 != 0) $html 	.= "</tr>";
		$html 	.= "</table>";
		return $html;
    }
	
	function displayArrayDataForHour($executionorder =0, $data, $inputData){
        $tabindex =& $GLOBALS['tabindex'];
		$html 	 = '';
		$html 	.= "<table width='500' cellpadding='0' cellspacing='0' border='0'>";
		for ($i = 0; $i < 24; $i++){
			if ($i % 4 == 0) $html 	.= "<tr>";
			$html 	.= "<td><input type='checkbox' name='acl[{$executionorder}][data][]' value='$i'".(in_array($i, $data) ? ' CHECKED' : '')." tabindex='".($tabindex++)."'>&nbsp;{$i}:00-{$i}:59&nbsp;&nbsp;</td>";
			if (($i + 1) % 4 == 0) $html 	.= "</tr>";
		}
		if (($i + 1) % 4 != 0) $html 	.= "</tr>";
		$html 	.= "</table>";
		return $html;
    }
	
	 /**
     * Outputs the HTML to display the data for this limitation
     *
     * @return void
     */
    function displayData($executionorder, $data=null, $inputData)
    {
		
        $data = $this->_expandData($data);
        $tabindex =& $GLOBALS['tabindex'];
		$oDate	  = null;

        if ($data['day'] == 0 && $data['month'] == 0 && $data['year'] == 0) {
            $set = false;
        } else {
            $set = true;
        }
		
		$html	= '';

        $html	.= "<table><tr><td>";

        if ($set) {
			$oDate = $data['day'] .'-'. $data['month'] .'-'. $data['year'];
        }
        $dateStr = is_null($oDate) ? '' : $oDate;
		
        $html	.="
			<input type='text' class='date' name='acl[{$executionorder}][data][date]' id='activate_time' placeholder='dd-mm-yyyy' value='$dateStr' tabindex='".$tabindex++."'>
			<img src='".base_url()."assets/upimages/icon-calendar.gif' id='0_button' align='absmiddle' border='0' tabindex='4'>";
										
		
		

        $html	.= "</td></tr></table>";
		
		return $html;

        //$this->data = $this->_flattenData($this->data);
    }
	
	function _getCurrentTz(){
       /* 
	    <input class='date' name='acl[{$executionorder}][data][date]' id='acl[{$executionorder}][data][day]' type='text' value='$dateStr' tabindex='".$tabindex++."' />
        <input type='image' src='" . base_url() . "assets/upimages/icon-calendar.gif' id='{$executionorder}_button' align='absmiddle' border='0' tabindex='".$tabindex++."' />
       
	   
        Calendar.setup({
            inputField : 'acl[{$executionorder}][data][day]',
             ifFormat   : '%d %B %Y',
            button     : '{$executionorder}_button',
            align      : 'Bl',
             weekNumbers: false,
             firstDay   : " . ($GLOBALS['pref']['begin_of_week'] ? 1 : 0) . ",
             electric   : false
        })  */
		$tz = 'Asia/Kolkata';
        return $tz;
    }
	
    function _flattenData($data = null){
        if (!isset($data)) {
            $data = $this->data;
        } elseif (is_array($data)) {
            if (empty($data['date'])) {
                $data = '00000000';
            } else {
                $data = date('Ymd', strtotime($data['date'])).'@'.$this->_getCurrentTz();
            }
        }
        return $data;
    }

    function _expandData($data = null){
		
        if (!isset($data)) {
            $data = $this->data;
        }
		
        if (is_array($data)) {
			
            return $data;
        }
        $parts = explode('@', $data);
        $data = $parts[0];
        $tz = isset($parts[1]) ? $parts[1] : 'UTC';
        if ($data == '00000000' || empty($data)) {
			
			
            $data = array(
                'day'   => 0,
                'month' => 0,
                'year'  => 0,
                'tz'    => $tz,
            );
        } else {
            $data = array(
                'day'   => substr($data, 6, 2),
                'month' => substr($data, 4, 2),
                'year'  => substr($data, 0, 4),
                'tz'    => $tz,
            );
        }
		
        return $data;
    }


	
	
}
?>