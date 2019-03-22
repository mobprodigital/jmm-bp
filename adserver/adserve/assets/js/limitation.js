$("document").ready(function(){
	
		 /*  $("#session_capping,#cap,#min_impressions")
      .keypress(maskNonNumeric)
      .focus(prepareForText)
      .blur(enableResetCounterConditionally); */
	if(aclplugins){
	 
	//	console.log(limitationType);
		$("#limitationheader").show();
		$("#nolimitdialogue1").hide();
		$("#nolimitdialogue2").hide();

		if(aclplugins	== 'deliveryLimitations:Device:Screen'){
			$("#devicelist1").show();
			$("#devicelist2").show();
								
			
		}
	}
									
  
  

  function prepareForText(event)
  {
    if (this.value == '-')  {
      this.value = '';
    }
  }


  function enableResetCounterConditionally()
  {
    var cappingSet = false;
    $('#session_capping,#cap').each(function()
    {
      if (this.value == '-' || this.value == '' || this.value == '0') {
        this.value = '-';
      }
      else {
        cappingSet = true;
      }
    });

    if (isResetCounterEnabled(this.form) != cappingSet) {
      setResetCounterEnabled(this.form, cappingSet);
    }
  }


  function isResetCounterEnabled(form)
  {
    var $timeHourField = $("#timehour");

    if ($timeHourField.length == 0) {
        return false;
    }

    return !$timeHourField.attr("disabled");
  }


  function setResetCounterEnabled(form, cappingSet)
  {
      var disable = !cappingSet;
      if (form.timehour) {
        form.timehour.disabled = disable;
      }
      if (form.timeminute) {
        form.timeminute.disabled = disable;
      }
      if (form.timesecond) {
        form.timesecond.disabled = disable;
      }
  }


	/*function phpAds_formCapBlur(i)
	{
		if (i.value == '-' || i.value == '' || i.value == '0') {
		  i.value = '-';
		} else {
      oa_formSetTimeDisabled(i, false);
		}
	}*/


	function phpAds_formLimitBlur (i)
	{
		f = i.form;

		if (f.timehour.value == '') f.timehour.value = '0';
		if (f.timeminute.value == '') f.timeminute.value = '0';
		if (f.timesecond.value == '') f.timesecond.value = '0';

		phpAds_formLimitUpdate (i);
	}


	function phpAds_formLimitUpdate (i)
	{
		f = i.form;

		// Set -
		if (f.timeminute.value == '-' && f.timehour.value != '-') f.timeminute.value = '0';
		if (f.timesecond.value == '-' && f.timeminute.value != '-') f.timesecond.value = '0';

		// Set 0
		if (f.timehour.value == '0') f.timehour.value = '-';
		if (f.timehour.value == '-' && f.timeminute.value == '0') f.timeminute.value = '-';
		if (f.timeminute.value == '-' && f.timesecond.value == '0') f.timesecond.value = '-';
	}


  /*function oa_formEnableTime(i)
  {
      f = i.form;
      f.timehour.disabled = false;
      f.timeminute.disabled = false;
      f.timesecond.disabled = false;
  }*/
// ]]> -->

	$(".deletelimitation").click(function(){
		//var deleteLimitationId	=	
		
	});

	
	
	$("#adlimit").click(function(){
		var limitationType	= $("#limittype").val();
		console.log(limitationType);
		$("#limitationheader").show();
		$("#nolimitdialogue1").hide();
		$("#nolimitdialogue2").hide();


		 if(limitationType	== 'deliveryLimitations:Device:Screen'){
			$("#devicelist1").show();
			$("#devicelist2").show();
								
			
		}
		
		 if(limitationType	== 'deliveryLimitations:Client:Browser'){
			$("#browserlist1").show();
			$("#browserlist2").show();
								
			
		}if(limitationType	== 'deliveryLimitations:Client:Domain'){
			$("#domainlist1").show();	
			$("#domainlist2").show();	

			
		}if(limitationType	== 'deliveryLimitations:Client:Ip'){
			$("#iplist1").show();	
			$("#iplist2").show();

			
			
		}if(limitationType	== 'deliveryLimitations:Client:Os'){
			$("#oslist1").show();
			$("#oslist2").show();
								
			
		}
		
		if(limitationType	== 'deliveryLimitations:Client:Useragent'){
			$("#useragentlist1").show();
			$("#useragentlist2").show();
        
			
		}
		if(limitationType	== 'deliveryLimitations:Time:Day'){
			$("#daylist1").show();
			$("#daylist2").show();
        
			
		}
		
		if(limitationType	== 'deliveryLimitations:Time:Date'){
			$("#datelist1").show();
			$("#datelist2").show();
        
			
		}
		if(limitationType	== 'deliveryLimitations:Time:Hour'){
			$("#hourlist1").show();
			$("#hourlist2").show();
        
			
		}
		if(limitationType	== 'deliveryLimitations:Geo:Location'){
			
			$(".geo-div").show();
			
								
			
		}
	})
	
	
});