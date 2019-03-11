<?php 
    /**
     * A method to return the pre-defined 'friendly' value based on the
     * span that has been set, if such a value exists - otherwise the
     * "specific" friendly will be returned.
     *
     * See the {@link OA_Admin_DaySpan::setSpanPresetValue()} method
     * for the pre-defined values.
     *
     * @return string The pre-defeined 'friendly' value, or the string
     *                "specific".
     */
    function getPreset()
    {
        // Ensure the span has been set correctly, otherwise return "specific"
        if (
            is_null(oStartDate) || is_null(oEndDate) ||
            !is_a(oStartDate, 'Date') || !is_a(oEndDate, 'Date')
        ) {
            return 'specific';
        }
        // Does the span match "today"?
        $aDates = _getSpanDates('today');
        if ($aDates['start'] == oStartDate && $aDates['end'] == oEndDate) {
            return 'today';
        }
        // Does the span match "yesterday"?
        $aDates = _getSpanDates('yesterday');
        if ($aDates['start'] == oStartDate && $aDates['end'] == oEndDate) {
            return 'yesterday';
        }
        // Does the span match "this_week"?
        $aDates = _getSpanDates('this_week');
        if ($aDates['start'] == oStartDate && $aDates['end'] == oEndDate) {
            return 'this_week';
        }
        // Does the span match "last_week"?
        $aDates = _getSpanDates('last_week');
        if ($aDates['start'] == oStartDate && $aDates['end'] == oEndDate) {
            return 'last_week';
        }
        // Does the span match "last_7_days"?
        $aDates = _getSpanDates('last_7_days');
        if ($aDates['start'] == oStartDate && $aDates['end'] == oEndDate) {
            return 'last_7_days';
        }
        // Does the span match "this_month"?
        $aDates = _getSpanDates('this_month');
        if ($aDates['start'] == oStartDate && $aDates['end'] == oEndDate) {
            return 'this_month';
        }
        // Does the span match "this_month_full"?
        $aDates = _getSpanDates('this_month_full');
        if ($aDates['start'] == oStartDate && $aDates['end'] == oEndDate) {
            return 'this_month_full';
        }
        // Does the span match "this_month_remainder"?
        $aDates = _getSpanDates('this_month_remainder');
        if ($aDates['start'] == oStartDate && $aDates['end'] == oEndDate) {
            return 'this_month_remainder';
        }
        // Does the span match "next_month"?
        $aDates = _getSpanDates('next_month');
        if ($aDates['start'] == oStartDate && $aDates['end'] == oEndDate) {
            return 'next_month';
        }
        // Does the span match "last_month"?
        $aDates = _getSpanDates('last_month');
        if ($aDates['start'] == oStartDate && $aDates['end'] == oEndDate) {
            return 'last_month';
        }
        // Does not match any of the above
        return 'specific';
    }
	
	
	
    /**
     * A private method that returns the start and end dates
     * that bound the span, based based on a pre-defined 'friendly'
     * value.
     *
     * See the {@link OA_Admin_DaySpan::setSpanPresetValue()} method
     * for the pre-defined values.
     *
     * @param string $presetValue The preset value string.
     * @return array An array of two elements, "start" and "end",
     *               representing the start and end dates of
     *               the span, respectively.
     */
	 
	 function getPresetWithDateRange(){
		$todayDates = _getSpanDates('today');
		$yesterdayDates = _getSpanDates('yesterday');
		//$this_weekDates = _getSpanDates('this_week');
		$this_monthDates = _getSpanDates('this_month');
		$all_statsDates = _getSpanDates('all_stats');
		$specificDates = _getSpanDates('specific');
		
		return array(
		'today'=>$todayDates,
		'yesterday'=>$yesterdayDates,
		//'this_week'=>$this_weekDates,
		'this_month'=>$this_monthDates,
		'all_stats'=>$all_statsDates,
		'specific'=>$specificDates
		
		);

	}
	
    function _getSpanDates($presetValue)
    {	
		$oDateStart = date("Y-m-d");
		$oDateEnd	= date("Y-m-d");
        switch ($presetValue) {
            case 'today':
                $oDateStart    = date("Y-m-d");
                $oDateEnd      = date("Y-m-d");
                break;
            case 'yesterday':
				$oDateStart    = prevDay('','','');
                $oDateEnd      = prevDay('','','');
                break;
            /* case 'this_week':
                $oDateStart    = new Date(beginOfWeek(oNowDate->format('%d'), oNowDate->format('%m'), oNowDate->format('%Y')));
                $oSixDaySpan   = new Date_Span();
                $oSixDaySpan->setFromDays(6);
                $oSevenDaySpan = new Date_Span();
                $oSevenDaySpan->setFromDays(7);
                // Now have week start and end when week starts on Sunday
                // Does the user want to start on a different day?
                $beginOfWeek   = getBeginOfWeek();
                if ($beginOfWeek > 0) {
                    $oRequiredDaysSpan = new Date_Span();
                    $oRequiredDaysSpan->setFromDays($beginOfWeek);
                    $oDateStart->addSpan($oRequiredDaysSpan);
                    $oDateToday = new Date(oNowDate->format('%Y-%m-%d'));
                    if ($oDateToday->getDayOfWeek() < $beginOfWeek) {
                        $oDateStart->subtractSpan($oSevenDaySpan);
                    }
                }
                $oDateEnd      = new Date($this->oNowDate->format('%Y-%m-%d'));
                break; */
            case 'this_month':
                $oDateStart    = beginOfMonth();
                $oDateEnd      = date('Y-m-d');
                break;
            
            
            case 'all_stats':
                $oDateStart = null;
                $oDateEnd   = null;
                break;
            case 'specific':
                /* $startDate  = 'startDate', date('Y-m-d');
                $oDateStart = new Date($startDate);
                $endDate    = 'endDate', date('Y-m-d');
                $oDateEnd   = new Date($endDate); */
                break;
        }
       
        $aDates = array(
            'start' => $oDateStart,
            'end'   => $oDateEnd
        ); 
        return $aDates;
    }
	
	function beginOfMonth($month='',$year='',$format='%Y%m%d')
    {
        if (empty($year)) {
            $year = dateNow('%Y');
        }
        if (empty($month)) {
            $month = dateNow('%m');
        }

        return(($year.'-'.$month.'-01'));
    } // end of func beginOfMonth 
	
	
    /**
     * Converts a date to number of days since a
     * distant unspecified epoch.
     *
     * @param string day in format DD
     * @param string month in format MM
     * @param string year in format CCYY
     *
     * @access public
     *
     * @return integer number of days
     */

    function dateToDays($day,$month,$year)
    {

        $century = (int) substr($year,0,2);
        $year = (int) substr($year,2,2);

        if ($month > 2) {
            $month -= 3;
        } else {
            $month += 9;
            if ($year) {
                $year--;
            } else {
                $year = 99;
                $century --;
            }
        }

        return (floor(( 146097 * $century) / 4 ) +
            floor(( 1461 * $year) / 4 ) +
            floor(( 153 * $month + 2) / 5 ) +
            $day + 1721119);
    } // end func dateToDays
	
	function daysToDate($days,$format='%Y%m%d')
    {

        $days       -=  1721119;
        $century    =   floor(( 4 * $days - 1) / 146097);
        $days       =   floor(4 * $days - 1 - 146097 * $century);
        $day        =   floor($days / 4);

        $year       =   floor(( 4 * $day +  3) / 1461);
        $day        =   floor(4 * $day +  3 - 1461 * $year);
        $day        =   floor(($day +  4) / 4);

        $month      =   floor(( 5 * $day - 3) / 153);
        $day        =   floor(5 * $day - 3 - 153 * $month);
        $day        =   floor(($day +  5) /  5);

        if ($month < 10) {
            $month +=3;
        } else {
            $month -=9;
            if ($year++ == 99) {
                $year = 0;
                $century++;
            }
        }

        $century = sprintf('%02d',$century);
        $year = sprintf('%02d',$year);
        return($century.$year.'-'.$month.'-'.$day);
    } // end func daysToDate

	
	function dateNow($format='%Y%m%d')
    {
        return(strftime($format,time()));

    } 
	function prevDay($day='',$month='',$year='',$format='%Y%m%d')
    {
		
        if (empty($year)) {
            $year = dateNow('%Y');
        }
        if (empty($month)) {
            $month = dateNow('%m');
        }
        if (empty($day)) {
            $day = dateNow('%d');
        }

		
        $days = dateToDays($day,$month,$year);
		
        return(daysToDate($days - 1,$format));
    } // end func prevDay
?>