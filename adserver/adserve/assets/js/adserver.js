$("document").ready(function(){
	$("#submitsettings").click(function(){
		var pass1		= $("#new_pass").val();
		var pass2		= $("#confirm_pass").val();
	
	if (pass1 != pass2) {
			$(".validation").hide();
			$(".validation").show();
			return false;  
			
		} else {
			
			 $(".validation").hide(); // remove it
			 
		}
	});
	
	$(".clientlist").click(function(){
		
		$(".success-msg").text("");
		var clientid	= $(this).attr("id");
		$("#curr-client").val(clientid);
		$.ajax({
			type	:"POST",
			url		:script+"users/getclientaccess",
			data	:"clientid="+clientid,
			dataType:"JSON",
			success:function(response){
				/* console.log(response);
				console.log(response.users); */
				var users 	= response.users;
				if(users){
					$(".users:checkbox").each(function(){
						userid = $(this).val();
						/* console.log(userid);
						console.log(users); */
						var a = users.indexOf(userid);
						console.log(a);
						 if(a != -1 && a > -1){
							 console.log("sfasdhfas");
							$(this).attr("checked","checked");
						}else{
							$(this).removeAttr('checked');
						} 
					});

				}
			}
		});
	});
	
	$("#access").click(function(){
		$(".success-msg").text("");
		var userid			= "";
		var clientid		= $("#curr-client").val();
		$(".users:checkbox:checked").each(function(){
			userid += ","+$(this).val();
		});
		
		$.ajax({
			type	:"POST",
			url		:script+"users/updateclientaccess",
			data	:"userid="+userid+"&clientid="+clientid,
			dataType: "JSON",
			success:function(response){
				if(response.msg){
					$(".success-msg").text(response.msg);

				}
			}
		});
	})
	
	// $(".bannerstatus").click(function(){
	// 	var banneridString		= $(this).attr("id");
	// 	var bannerid = banneridString.substring(7);
	// 	$.ajax({
	// 		type	:"POST",
	// 		url		:script+"users/changebannerstatus",
	// 		data	:"bannerid="+bannerid,
	// 		success :function(response){
	// 			//console.log(response);
				
	// 			var parse=JSON.parse(response);
	// 			console.log(parse.newstatus);//return false;
	// 			if(parse.newstatus){
	// 				console.log('green');
	// 				$("#banner_"+bannerid).css("color","green");
	// 				$("#banner_"+bannerid).text("activate");
					
	// 			}else{
	// 				console.log('yellow');
	// 				$("#banner_"+bannerid).css("color","#eb7e23");
	// 				$("#banner_"+bannerid).text("deactivate");
	// 			}
				
	// 			$(".box-body").append('<p class="message_p"><b>Campaign is successfully updated</b></p>');
				
	// 		}
	// 	});
	// })
	
	// $(".camstatus").click(function(){
	// var campaignid		= $(this).attr("id");
	// var choice = confirm('Do you really want to do this?');
	// if(choice === true) {
	// 	$.ajax({
	// 		type	:"POST",
	// 		url		:script+"users/changecampaignstatus",
	// 		data	:"campaignid="+campaignid,
	// 		success:function(response){
	// 			//console.log(response);
				
	// 			var parse=JSON.parse(response);
	// 			console.log(parse.newstatus);
	// 			if(parse.newstatus){
	// 				console.log('green');
	// 				$("#"+campaignid).css("color","green");
	// 				$("#"+campaignid).text("active");
					
	// 			}else{
	// 				console.log('yellow');
	// 				$("#"+campaignid).css("color","#eb7e23");
	// 				$("#"+campaignid).text("inactive");
	// 			}
				
	// 			$(".box-body").append('<p class="message_p"><b>Campaign is successfully updated</b></p>');
				
	// 		}
	// 	});
	// }
	// return false;
		
		
	// });

	$("#savebanner").click(function(){
		var vast		= $("#vastinput").val();
		var bannerid	= $("#ext_bannerid").val();
		$.ajax({
			type	:"POST",
			url		:script+"users/savevastreplacementbanner",
			data	:"tag="+vast+'&'+"bannerid="+bannerid,
			success:function(response){
				$("#vastinput").hide();
				$("#myModalLabel").hide();
				$("#savebanner").hide();
				$(".active_banner").show();
				var parse=JSON.parse(response)
				$("#vastbanner").val(parse.id);
				//$('#myModal').modal('toggle');
			}
		});
	});
	
	$("#changebanner").click(function(){
		$("#vastinput").hide();
		$("#myModalLabel").hide();
		$("#savebanner").hide();
		$(".active_banner").show();
		$('#myModal').modal('toggle');
	});
	
	$("#saveactivebanner").click(function(){
		var activeid			= $('input[name=activebanner]:checked', '#banner_replace').val();
		var activetype			= $('input[name=activebanner]:checked', '#banner_replace').attr("id");
		
		if(activetype == 'videobanner'){
			ext_bannertype			= 'create_video';
			var inactiveid			= $("#vastbanner").val();
			
			
		}else{
			ext_bannertype				= 'upload_video';
			var inactiveid				= $("#videobanner").val();
		
		}
		
		//alert(activeid+"vsfa"+inactiveid);return false;
		
		var bannerid				= $("#bannerid").val();
		var campaignid				= $("#campaignid").val();
		var clientid				= $("#clientid").val();
		$.ajax({
			type	:"POST",
			url		:script+"users/activevideobanner",
			data	: "ext_bannertype="+ext_bannertype+"&activeid="+activeid+"&inactiveid="+inactiveid+"&bannerid="+bannerid,
			success:function(response){
				//console.log(response);return false;
				window.location.href		= script+"users/banner?bannerid="+bannerid+"&campaignid="+campaignid+"&clientid="+clientid;
				//$('#myModal').modal('toggle');
			}
		});
	})
	
	
	$("#savelinkedsites").click(function(){
		var contentid	= $("#savecontentid").val();
		$.ajax({
			type	:"POST",
			url		:script+"users/savelinkedsites",
			data	: "contentid="+contentid+'&'+$('.ids:checked').serialize(),
			success:function(response){
				console.log(response);
				   $('#myModal').modal('toggle');
			}
		});
	})
	
	$(".addcontent").click(function(){
		var contentid	= $(this).attr("id");
		$("#savecontentid").val(contentid);
		$('.ids').attr('checked', false);
		
	})
	$(".select-video").click(function(){
		if(confirm("Are you sure to change status")){
			var id	= $(this).attr("id");
			$.ajax({
				type	:"POST",
				url		:script+"users/setvideocontent",
				data	:"id="+id,
				success:function(response){
					var parseResponse		= JSON.parse(response);
					$("#"+parseResponse.active+"_"+parseResponse.id).show();
					$("#"+parseResponse.inactive+"_"+parseResponse.id).hide();
					return false;
				}
			});
		}
	})
	
	
	
	$("#addcampaign").submit(function(){
		//alert('in_function');
		var	campaignName	= $("#campaign").val();
		var	campaignRevenue	= $("#revenue").val();
		var	avtivateTime	= $("#activate_time").val();
		var	expireTime		= $("#expire_time").val();
		//alert(avtivateTime);
		//alert(expireTime);

		if(campaign == 'new'){
			
			// Validation For Campaign Name
			var nameReg = /^[a-zA-Z 0-9]*$/;
			if(!campaignName.match(nameReg))
			{
				$("#span_campaign").text("Please Enter Only Alphabets,Number And Space");
				return false;
			}
			// Ends

			// Validation For Campaign Price
			var priceReg = /^[0-9.]*$/;
			//alert(priceReg);
			if(!campaignRevenue.match(priceReg))
			{
				$("#span_revenue").text("Please Enter Only Number");
				return false;
			}
			// Ends
		
			if(avtivateTime != "" && expireTime !=""){
				var array 			= avtivateTime.split('-');
				var date1			= array[1]+'/'+array[0]+'/'+array[2]; 
				
				var array 			= expireTime.split('-');
				var date2			= array[1]+'/'+array[0]+'/'+array[2];
				
				var today 			= new Date();
				var dd 				= today.getDate();
				var mm 				= today.getMonth()+1; //January is 0!
				var yyyy 			= today.getFullYear();
				today 				= mm+'/'+dd+'/'+yyyy;
				
				var todayparseDate			= Date.parse(today);
				var inputstartparseDate		= Date.parse(date1);
				var inputendparseDate		= Date.parse(date2);

				if(inputstartparseDate < todayparseDate){
					alert("campaign starts date must be later  or same as  today date");
					return false;

				}
				if(inputstartparseDate > inputendparseDate){
					alert("campaign end date must be later  or same as  start date");
					return false;

				}
			}
		}
		if(campaign == 'exist')
		{
			//alert('exist');
			// Validation For Campaign Name
			var nameReg = /^[a-zA-Z 0-9]*$/
			if(!campaignName.match(nameReg))
			{
				$("#span_campaign").text("Please Enter Only Alphabets,Number And Space");
				return false;
			}
			// Ends

			// Validation For Campaign Price
			var priceReg = /^[0-9.]*$/
			//alert(priceReg);
			//alert(campaignRevenue);
			if(!campaignRevenue.match(priceReg))
			{
				$("#span_revenue").text("Please Enter Only Number");
				return false;
			}
			// Ends
		
			// if(avtivateTime != "" && expireTime !="")
			// {
			// 	var array 			= avtivateTime.split('-');
			// 	var date1			= array[1]+'/'+array[0]+'/'+array[2]; 
				
			// 	var array 			= expireTime.split('-');
			// 	var date2			= array[1]+'/'+array[0]+'/'+array[2];
				
			// 	var today 			= new Date();
			// 	var dd 				= today.getDate();
			// 	var mm 				= today.getMonth()+1; //January is 0!
			// 	var yyyy 			= today.getFullYear();
			// 	today 				= mm+'/'+dd+'/'+yyyy;
				
			// 	var todayparseDate			= Date.parse(today);
			// 	var inputstartparseDate		= Date.parse(date1);
			// 	var inputendparseDate		= Date.parse(date2);

			// 	if(inputstartparseDate < todayparseDate){
			// 		alert("campaign starts date must be later  or same as  today date");
			// 		return false;

			// 	}
			// 	if(inputstartparseDate > inputendparseDate){
			// 		alert("campaign end date must be later  or same as  start date");
			// 		return false;

			// 	}
			// }
		}
	});
	
	$(".search").keyup(function(){
		$(".dropdown-content").html("");
		var key	= $(this).val();
		var id	= $(this).attr("id");
		//console.log(key+id);

		
		$.ajax({
			type	:"POST",
			url		:"getsearchsuggestion",
			data	:"id="+id+"&key="+key,
			success:function(response){
				//console.log(id+key);return false;
				$(".dropdown-content").html("");
				//console.log(response);
				var list 	= "<ul class='search-result'>";
				$.each(JSON.parse(response), function(index, value){
					//console.log(value);
					//console.log(value.clientid);
					
					
					if(id=='clients'){
						list	= list+"<li id="+value.clientid+">"+value.clientname+"</li>";
					}
					if(id=='campaigns'){
						list	= list+"<li id="+value.campaignid+">"+value.campaignname+"</li>";
					}
					if(id=='banners'){
						list	= list+"<li id="+value.clientid+">"+value.clientname+"</li>";
					}
				});
				list 	= list+"</ul>";
				$(".dropdown-content").append(list);
				$(".dropdown-content").show();
				//console.log(list);
			}
		});
	});
	
	
	
	$(".dropdown-content").on("click", "li", function(){
		var id			= $(this).attr('id');
		var text		= $(this).text();
		var host		= window.location.href.split( '/' );
		var type		= host[host.length-1];	
		console.log(type);		
		 if(type.indexOf('viewcompaign')==0){	
			window.location.href		= 'viewcompaign?campaignid='+id+"&key="+text;
		}
		if(type.indexOf('viewadvertiser')==0){
			window.location.href		= 'viewadvertiser?clientid='+id+"&key="+text;
		}
	});
	
	$("#views").click(function(){
		console.log($(this).attr('checked'));
		if($(this).attr('checked')){
			$(this).removeAttr('checked');
			$("#impressions").removeAttr('disabled');
		}else{
			$(this).attr('checked','checked');
			$("#impressions").val('');
			$("#impressions").attr('disabled','disabled');
		}
	});
	
	// $("#advertiserlist").change(function(){
	// 	var clientid	= $(this).val();
	// 	window.location.href='viewcompaign?clientid='+clientid;
	// });
	
	$(".campaign-radio").click(function(){
		var  activeTypeRadio			= $(this).attr('id');
		$(".campaign-type").hide();
		$("#campaign_"+activeTypeRadio).show();
		
	});
	
	
	$(".close").click(function(){
		$(".localMessage").hide()	;
	});
	
	$("#addwebsite").submit(function(){
		var url				= $("#website").val();
		var name			= $("#name").val();
		var email			= $("#email").val();
		var contact			= $("#contact").val();

		if(url		== '') {
			$("#span_website").text("Website Url is required");
			$("#website").addClass("has-error");return false;
		}if(name		== '') {
			$("#span_name").text("Name is required");
			$("#name").addClass("has-error");return false;
		}if(email		== '') {
			$("#span_email").text("Email is required");
			$("#email").addClass("has-error");return false;
		}if(contact		== '') {
			$("#span_contact").text("Contact is required");
			$("#contact").addClass("has-error");return false;
		}
		
	});
	
	$("#zoneform").submit(function(){
		var zonename			= $("#zonename").val();
		if(zonename		== '') {
			$("#span_zonename").text("Enter zone name");
			$("#zonename").addClass("has-error");return false;
		}
	});
	
	$(".zone").change(function(){
		var zoneType	= $(this).val();
		console.log(zoneType);
		if(zoneType == 'web' || zoneType == 'html5'){
			$("#size-d").removeAttr("disabled");
			$("#size-c").removeAttr("disabled");
			$("#size").removeAttr("disabled");
			$("#width").removeAttr("disabled");
			$("#height").removeAttr("disabled");
		}else{
			$("#size-d").attr("disabled", "disabled");
			$("#size-c").attr("disabled", "disabled");
			$("#size").attr("disabled", "disabled");
			$("#width").attr("disabled", "disabled");
			$("#height").attr("disabled", "disabled");
		}
	})
	
	$("#size").change(function(){
		var bannerType	= $(this).val();
		if(bannerType	== '-'){
			$("#size-d").removeAttr("checked");
			$("#size-c").attr("checked", "checked");
		}else{
			$("#size-c").removeAttr("checked");
			$("#size-d").attr("checked", "checked");
		}
	});
	
	$(".report-period").change(function(){
		var bannerType			= $(this).attr('id');
		var periodSelectName	= $(this).val();
		var today 				= new Date();
		var	dd 					= today.getDate();
		var mm 					= today.getMonth()+1;
		var yyyy 				= today.getFullYear();
		
		var today = yyyy+'-'+mm+'-'+dd;
		//console.log(today);return false;
		if (periodSelectName == 'today') {
			document.getElementById('period_start').value = today;
			document.getElementById('period_end').value = today;
			$("#period_start").attr('disabled','disabled');
			$("#period_end").attr('disabled','disabled');
        }
                
		if (periodSelectName == 'yesterday') {
			$today 			= new Date();
			$yesterday 		= new Date($today);
			$yesterday.setDate($today.getDate() - 1);
			var $dd 		= $yesterday.getDate();
			var $mm 		= $yesterday.getMonth()+1;
			var $yyyy 		= $yesterday.getFullYear();
			
			$yesterday = $yyyy+'-'+$mm+'-'+$dd;
			if($dd<10){$dd='0'+$dd} if($mm<10){$mm='0'+$mm} 
			
			$yesterday = $yyyy+'-'+$mm+'-'+$dd;
			//console.log($yesterday);return false;
			document.getElementById('period_start').value = $yesterday;
			document.getElementById('period_end').value = $yesterday;
			$("#period_start").attr('disabled','disabled');
			$("#period_end").attr('disabled','disabled');
		}
                
		 /* if (periodSelectName == 'this_week') {
			day			= dd-1;
			curweek		= yyyy+'-'+mm+'-'+day;
			
			var curr 	= new Date; // get current date
			var first	= curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
			var last 	= first + 6; // last day is the first day + 6

			var firstday = new Date(curr.setDate(first)).toUTCString();
			var lastday = new Date(curr.setDate(last)).toUTCString();
			console.log(curr+"."+curweek+firstday+lastday);return false;
			
			document.getElementById('period_start').value = curweek;
			document.getElementById('period_end').value = '19 May 2016';
		} */
			
		/* if (periodSelectName == 'last_week') {
			document.getElementById('period_start').value = '09 May 2016';
			document.getElementById('period_end').value = '15 May 2016';
		} */ 
			
		/* if (periodSelectName == 'last_7_days') {
			day			= dd-7;
			last_7_days	= yyyy+'-'+mm+'-'+day;
			document.getElementById('period_start').value 	= last_7_days;
			document.getElementById('period_end').value 	= today;
		} */
			
		if (periodSelectName == 'this_month') {
			day			= 1;
			this_month	= yyyy+'-'+mm+'-'+day;;
			document.getElementById('period_start').value 	= this_month;
			document.getElementById('period_end').value 	= today;
			$("#period_start").attr('disabled','disabled');
			$("#period_end").attr('disabled','disabled');
		}
			
		/* if (periodSelectName == 'last_month') {
			document.getElementById('period_start').value = '01 April 2016';
			document.getElementById('period_end').value = '30 April 2016';
		}*/
			
		if (periodSelectName == 'all_stats') {
			document.getElementById('period_start').value = '';
			document.getElementById('period_end').value	  = '';
		} 
		
		if(periodSelectName == 'specific'){
			$("#period-form-submit").removeAttr('disabled');

			$("#period_start").removeAttr('disabled');
			$("#period_start").removeAttr("value");
			$("#period_start").removeAttr("style");
			$("#period_start").css("background-color", "white");
			
			$("#period_end").removeAttr('disabled');
			$("#period_end").removeAttr("value");
			$("#period_end").removeAttr("style");
			$("#period_end").css("background-color","white");
			
		}else{
			
			var bannerid	= getParameterByName('bannerid');
			var duration 	= $(this).val();
			var start_date	= $("#period_start").val();
			var end_date	= $("#period_end").val();
			//console.log(start_date+end_date);return false;
			if(bannerType == 'period_preset'){
				var scriptName				= $("#scriptName").val();
				console.log(scriptName);
				window.location.href		= scriptName+'?bannerid='+bannerid+'&period='+periodSelectName+"&start_date="+start_date+"&end_date="+end_date;
			
			}else if(bannerType == 'affiliate_period_preset'){
				var affiliateid				= getParameterByName('affiliateid');
				window.location.href		= 'stats?breakthrough=placements&affiliateid='+affiliateid+'&bannerid='+bannerid+'&period='+periodSelectName+"&start_date="+start_date+"&end_date="+end_date;

			}else{
				window.location.href		= 'adcampstats?bannerid='+bannerid+'&period='+periodSelectName+"&start_date="+start_date+"&end_date="+end_date;
			}
		}
	});
	
	
	
	
	
	$("#viewby").change(function(){
		var viewby		= $(this).val();
		window.location.href		= 'adcampstats?bannerid='+bannerid+'&period='+periodSelectName+"&start_date="+start_date+"&end_date="+end_date+"&viewby="+viewby;
	})
	
	
	
	function getParameterByName(name, url) {
		if (!url) url = window.location.href;
		name = name.replace(/[\[\]]/g, "\\$&");
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
			results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, " "));
}
	
	
	
	
	$("#specific_date_sel").click(function(){
		//$("#period_form").submit();
		var start_date				= $("#period_start").val();
		var end_date				= $("#period_end").val();

	});
	
	$("#startSet_specific").click(function(){
		if($(this).is(':checked')){
			$("#specificStartDateSpan").show();
		}
		$("#activate_time").val("");
		
	});
	$("#startSet_immediate").click(function(){
		$("#specificStartDateSpan").hide();

	});
	$("#endSet_immediate").click(function(){
		$("#specificEndDateSpan").hide();

	});
	
	$("#endSet_specific").click(function(){
		if($(this).is(':checked')){
			$("#specificEndDateSpan").show();
		}
				$("#expire_time").val("");

	});
	
	
	
	
	$("#skip").click(function(){
		if($(this).is(':checked')){
			$("#skip_time").show();
		}else{
			$("#skip_time").hide();
		}
	});
	
	$(".video-chk").click(function(){
		$(".video-banner").hide();
		var	id	= $(this).attr('id');
		$("#"+id+"_ad").show();
		if(id == 'upload_video'){
			$("#generic-field").hide();
		}
	});
	
	$("#video-type").change(function(){
		var	 videoType	= $(this).val();
		if(videoType == 'flv' || videoType == 'mp4' || videoType == 'webm'){
			$("#generic-video-field").show();
		}
		if(videoType == 'vast_transfer'){
			$("#vast-transfer").show();
		}
		
		if(videoType	== 'vast_creation'){
			$("#vast-creation").show();
		}
	});
	
	
	
	
	$("#type").change(function(){
		$("#extagdiv").hide();
		$("#html5div").hide();
		$(".bannertype").hide();
		var bannerType	= $(this).val();
		//console.log(bannerType);return false;
		
		
		if(bannerType	== 'web'){
			$("#imagebanner").show();
			$("#localbanner").show();
			$("#externalbanner").show();
		}
		if(bannerType	== 'sql'){
			$("#sqlbanner").show();
		}
		if(bannerType	== 'url'){
			$("#externalbanner").show();
			
		}
		if(bannerType	== 'genericHtml'){
			$("#htmlbanner").show();
			
		}
		if(bannerType	== 'html'){
			$("#videoadbanner").show();
		}
		
		if(bannerType	== 'vast'){
			$("#vastadbanner").show();
		}
		
		
		if(bannerType	== 'vastOverlayHtml'){
			$("#overlaybanner").show();
			
		}
		
		console.log(bannerType);
		if(bannerType	== 'bannerTypeText'){
			$("#textbanner").show();
		}
		
		if(bannerType	== 'exscrpt'){
			$("#extagdiv").show();
		}
		if(bannerType	== 'exiframe'){
			$("#extagdiv").show();
		}
		
		if(bannerType	== 'html5'){
			$("#html5div").show();
		}
	})
	
	
	$("#campaign").focus(function(){
		var id			= $(this).attr("id"); 
		$("#span_campaign").text("");
	});
	
	$("#addbanner").submit(function(){
		var banner	= $("#description").val();
		var type	= $("#type").val();
		if(type=='web'){
		if(banner	== '') {
		$("#span_description").text("Banner name is required");
		$("#description").addClass("has-error");
		var banner	= $("#upload").val();
		return false;
		}
		
		var b_image	= $("#upload").val();
		if(b_image	== '') {
		$("#span_description1").text("Banner Image is required");
		$("#upload").addClass("has-error");
		return false;
		}
		var url	= $("#url").val();
		if(url	== '') {
		$("#url_span").text("Destination url is required");
		$("#url").addClass("has-error");
		return false;
		}
		
		
		}
		///web
		
		if(type=='html'){
		var vdo	= $("#videofilename").val();
		var radioValue = $("input[name='upload_video']:checked").val();
		if(banner	== '') {
		$("#span_description").text("Banner name is required");
		$("#description").addClass("has-error");
		var banner	= $("#upload").val();
		return false;
		}
		if(radioValue=='create_video'){
		
		/*if(vdo	== '') {
		$("#video_span").text("Video is required");
		$("#videofilename").addClass("has-error");
		return false;
		}*/
		
		var vast_dest_url	= $("#vast_dest_url").val();
		if(vast_dest_url	== '') {
		$("#video_dest_url_span").text("Destination url is required");
		$("#vast_dest_url").addClass("has-error");
		return false;
		} 
		
		
		
		
		
		}
		
		
		}
		//html
		
		if(type=='html5'){
		var banner	= $("#description").val();
		if(banner	== '') {
		$("#span_description").text("Banner name is required");
		$("#description").addClass("has-error");
		var banner	= $("#upload").val();
		return false;
		}
		
		var url	= $("#html_url").val();
		if(url	== '') {
		$("#html_url_span").text("Destination url is required");
		$("#html_url").addClass("has-error");
		return false;
		}
		
		var hwidth	= $("#hwidth").val();
		if(hwidth	== '') {
		$("#width_span").text("Width required");
		$("#hwidth").addClass("has-error");
		return false;
		}
		
		var hheight	= $("#hheight").val();
		if(hheight	== '') {
		$("#height_span").text("Height required");
		$("#hheight").addClass("has-error");
		return false;
		}
		
		
		}
		
		
		});
 


	// $("#addcampaign").submit(function(){
	// 	var campaign			= $("#campaign").val();
	// 	console.log(campaign);
	// 	if(campaign		== '') {$("#span_campaign").text("Compaing name required");return false;}
	// });
	
	$(".removeusers").click(function(){
		var id 			= $(this).attr("id");
		if(confirm("Are you sure to delete")){
			$(this).parents('tr').fadeOut(function(){
			$(this).remove(); //remove row when animation is finished
		});
		
		$.ajax({
			url		: 'deleteuser',
			data	: 'id='+id,
			type	: 'post',
			success	: function(response){
				console.log(response);
			}
		});
		}else{
			return false;
			
		}
	});
	
	$(".userstatus").click(function(){
		var id 			= $(this).attr("id");
		if(confirm("Are you sure to change status")){
		}
		$.ajax({
			url		: 'userstatus',
			data	: 'id='+id,
			type	: 'post',
			success	: function(response){
				var parseResponse		= JSON.parse(response);
				if(parseResponse.status == 1){
					$("#"+id).text("Inactive");
					$("#"+id).addClass("bg-green");
					$("#"+id).removeClass("bg-red");
				}else{
					$("#"+id).text("Actvie");
					$("#"+id).addClass("bg-red");
					$("#"+id).removeClass("bg-green");
				}
				return false;
			}
		});
	});
	 
	$("#delete-website").click(function(){
		//console.log("hello india");return false;
		var ids		= '';
		if(confirm("Are you sure to delete website and all it zone will automatically ")){
		}
		$(".website").each(function(){
			if($(this).is(':checked')){
				ids		= ids + ","+$(this).attr("id");
				$(this).parents('tr').fadeOut(function(){
					$(this).remove(); //remove row when animation is finished
				});
			}
		});
		$.ajax({
			url		: script+'users/deletewebsite',
			data	: 'id='+ids,
			type	: 'post',
			success	: function(response){
				console.log(response);
			}
		});
	});
	
	
		$("#delete-advertiser").click(function(){
		//console.log("hello india");return false;
		var ids		= '';
		if(confirm("Are you sure to delete")){
			$(".advertiser").each(function(){
			if($(this).is(':checked')){
				ids		= ids + ","+$(this).attr("id");
				$(this).parents('tr').fadeOut(function(){
					$(this).remove(); //remove row when animation is finished
				});
			}
		});
		//alert(ids);
		window.location = script+'users/deleteadvertiser?advertiser_ids=' + ids;
		// $.ajax({
		// 	url		: 'deleteadvertiser',
		// 	data	: 'id='+ids,
		// 	type	: 'post',
		// 	success	: function(response){
		// 		console.log(response);
		// 	}
		// });
		}
		return false;
		
	});
	
			$("#delete-banner").click(function(){
		//console.log("hello india");return false;
		var ids		= '';
		if(confirm("Are you sure to delete")){
			$(".banner").each(function(){
			if($(this).is(':checked')){
				ids		= ids + ","+$(this).attr("id");

				$(this).parents('tr').fadeOut(function(){
					$(this).remove(); //remove row when animation is finished
				});
			}
		});
		//alert(ids);
		window.location = script+'users/deletebannercheckbox?banner_ids=' + ids;
		// $.ajax({
		// 	url		: 'deletebannercheckbox',
		// 	data	: 'id='+ids,
		// 	type	: 'post',
		// 	success	: function(response){
		// 		console.log(response);
		// 	}
		// });
		}
		return false;
		
	});
	
			$("#delete-campaign").click(function(){
		//console.log("hello india");return false;
		var ids		= '';
		if(confirm("Are you sure to delete")){
			$(".campaign").each(function(){
			if($(this).is(':checked')){
				ids		= ids + ","+$(this).attr("id");
                $(this).parents('tr').fadeOut(function(){
					$(this).remove(); //remove row when animation is finished
				});
			}
		});
		console.log(ids);
        window.location = script+'users/deletecampaigncheckbox?campaign_ids=' + ids;

        // alert(ids);
		 //document.getElementById('campaign_ids').value=ids;
		// $.ajax({
		// 	url		: 'deletecampaigncheckbox',
		// 	data	: 'id='+ids,
		// 	type	: 'post',
		// 	success	: function(response){
		// 		console.log(response);
		// 	}
		// });
		}
		return false;
		
	});
	
	
	
	
	$(".formfield").focus(function(){
		var id			= $(this).attr("id"); 
		$("#span_"+id).text("");
		$("#"+id).removeClass("has-error");
		
	});
	$("#addadvertiser").submit(function(){
		var name			= $("#name").val();
		var contact			= $("#contact").val();
		//var contactlen      = contact.toString().length;
		//alert(contactlen);
		var email			= $("#email").val();
		
		// Validation For Name

		//var nameReg = /^[a-zA-Z-,]+(\s{0,1}[a-zA-Z-, ])*$/;
		var nameReg = /^[a-zA-Z 0-9]*$/;
		if(!name.match(nameReg))
		{
			$("#span_name").text("Please Enter Only Alphabets,Number And Space");
			return false;
		}
		// Ends

		// Validation For Numbers Only
		var numericReg = /^[0-9]*$/;
		if(!contact.match(numericReg))
		{
			$("#span_contact").text("Please Enter Only Numbers");
			return false;
		}
		if(contact.length > 15)
		{
			$("#span_contact").text("Please Enter Correct Numbers");
			return false;
		}
		// Ends

		//Validation For Email
		var emailReg = /^([a-z0-9\+_]+)(\.[a-z0-9\+_]+)*@([a-z0-9]+\.)+[a-z]{2,6}$/;
		if(!email.match(emailReg))
		{
			$("#span_email").text("Please Enter Valid Email Address");
			return false;
		}
		// Ends
		

		
		//if(name		== '') {$("#span_name").text("Please Enter name dcf");return false;}
		//if(contact	== '') {$("#span_contact").text("Please Enter contact dc");return false;}
		//if(email	== '') {$("#span_email").text("Please Enter email zsd");return false;}
	});
	
	$("#adduser").submit(function(){
		var username	= $("#username").val();
		var password	= $("#password").val();
		var firstname	= $("#firstname").val();
		var lastname	= $("#lastname").val();
		var role		= $("#role").val();
		
		if(username		== '') {$("#span_username").text("Please Enter email");
			$("#username").addClass("has-error");return false;
		}
		if(password		== '') {$("#span_password").text("Please Enter password");return false;}
		if(firstname	== '') {$("#span_firstname").text("Please Enter firstname");return false;}
		if(lastname		== '') {$("#span_lastname").text("Please Enter lastname");return false;}
		if(role			== '') {$("#span_role").text("Please Enter role");return false;}
	});
	
	$("#main_0").change(function(){
		$(".advertiser").prop('checked', $(this).prop("checked"));
	});




/*************************Added By Roiccha ******************************/
// $("#revenue_type").change(function(){
// 	//alert("hi");
	
// 	var banner	= $(this).val();
	
// 	//alert(banner);
// 	if(banner != '') { window.location.href='viewbanner?status='+banner; }
// 	else{ window.location.href='viewbanner';}
	
// });

// Set Banner Status In Dropdown On View Banner Page
$(".bannerstatus").change(function(){
	//alert('in function');
	var banneridString		= $(this).attr("id");
	var bannerid = banneridString.substring(7);
	//alert(bannerid);
	var banner_stat	= $(this).val();
	//alert(banner_stat);
	if(banner_stat == 1){
		var choice = confirm('Do you really want to activate this banner?');
	}else{
		var choice = confirm('Do you really want to deactivate this banner?');
	}
	if(choice === true) {
		$.ajax({
			type	:"POST",
			url		:script+"users/changebannerstatus",
			data	:"bannerid="+bannerid+"&banner_stat="+banner_stat,
			success :function(response){
				console.log(response);
				//alert(response);
				var parse=JSON.parse(response);
				var status = parse.status;
				//alert(status);
				if(status == 'true')
				{
					alert('Banner is successfully updated');
					$(".bannerstatus_"+bannerid).val(banner_stat);
				}else
				{
					alert('Something Goes Wrong.');
					//$(".bannerstatus_"+bannerid).val(banner_stat);
				}
				//alert(parse.newstatus);
				//console.log(parse.newstatus);//return false;
			}
		});
	}
	return false;
});

//Sort Name And Date Wise On View Advertiser Page
$("#sort_type").change(function(){
	//alert("hiiiiii");
	var sort	= $(this).val();
	//alert(sort);
	if(sort != '') { window.location.href='viewadvertiser?sortBy='+sort; }
	else{ window.location.href='viewadvertiser'; }

	
});

// Change campaign status on dropdown change
$(".camstatus").change(function(){
	//alert('hii');
	var campidString		= $(this).attr("id");
	var campaignid = campidString.substring(9);
	//alert(campaignid);
	var camp_stat	= $(this).val();
	//alert(camp_stat);
	if(camp_stat == 1){
		var choice = confirm('Do you really want to activate this campaign?');
	}else{
		var choice = confirm('Do you really want to deactivate this campaign?');
	}
	if(choice === true) {
		$.ajax({
			type	:"POST",
			url		:script+"users/changecampaignstatus",
			data	:"campaignid="+campaignid,
			success:function(response){
				console.log(response);
				//alert(response);
				var parse=JSON.parse(response);
				var status = parse.status;
				//alert(status);
				if(status == 'true')
				{
					alert('Campaign is successfully updated');
					$(".camstatus"+campaignid).val(camp_stat);
				}else
				{
					alert('Something Goes Wrong.');
				}
				}
		});
	}
	return false;
		
		
	});

// Delete Website List on users/viewwebsite page
$("#website-delete").click(function(){
//alert('In website');
//console.log("hello india");return false;
var ids		= '';
if(confirm("Are you sure to delete")){
	$(".advertiser").each(function(){
	if($(this).is(':checked')){
		ids		= ids + ","+$(this).attr("id");
		$(this).parents('tr').fadeOut(function(){
			$(this).remove(); //remove row when animation is finished
		});
	}
});
//alert(ids);
window.location = script+'users/deletewebsite?website_ids=' + ids;
}
return false;

});

// Delete Zones List on users/viewzone page
$("#zone-delete").click(function(){
	//alert('In zones');
	//console.log("hello india");return false;
	var ids		= '';
	if(confirm("Are you sure to delete")){
		$(".advertiser").each(function(){
		if($(this).is(':checked')){
			ids		= ids + ","+$(this).attr("id");
			$(this).parents('tr').fadeOut(function(){
				$(this).remove(); //remove row when animation is finished
			});
		}
	});
	//alert(ids);
	window.location = script+'users/deletezone?zone_ids=' + ids;
	}
	return false;
	
	});

/******************************* Ends ************************************/

});
