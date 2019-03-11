<?php
include_once $_SERVER['DOCUMENT_ROOT']."/adserver/delivery/config/delivery_config.php";
function renderVastOutput(){
	
	$bannerid		= $_GET['bannerid'];
	$my_file		= $GLOBALS['cachePath']."file_".$bannerid.".php";
	$completeArr 	= json_decode(file_get_contents($my_file), true);
	$banner				= $completeArr[0];
	$vast				= $completeArr[1];
	
	$adSystem 			= 'media adserver';
	$adName   			= $banner['description'];
	$vastAdDescription	= 'Inline Video Ad';
	//echo '<pre>';print_r($vast);die;
	
	$rand				= substr(md5(uniqid(time(), true)), 0, 10);
	
	
	$deliveryPath	= $GLOBALS['deliveryPath'];
	$vast['vast_thirdparty_erorr']		= $deliveryPath.'core/error/vast-error.php?bannerid='.$bannerid."&event=none&cb=".$rand;;
	$vast['vast_thirdparty_impression']	= $deliveryPath.'core/lgimpr.php?bannerid='.$bannerid."&event=impression&cb=".$rand;
	$vast['third_party_click']			= $deliveryPath.'core/ckvast.php?bannerid='.$bannerid."&event=clicks&cb=".$rand;
	$vast['start_pixel']				= $deliveryPath.'core/lgvast.php?bannerid='.$bannerid."&event=start";
	$vast['quater_pixel']				= $deliveryPath.'core/lgvast.php?bannerid='.$bannerid."&event=firstquartile";
	$vast['mid_pixel']					= $deliveryPath.'core/lgvast.php?bannerid='.$bannerid."&event=midpoint";
	$vast['third_quater']				= $deliveryPath.'core/lgvast.php?bannerid='.$bannerid."&event=thirdquartile";
	$vast['end_pixel']					= $deliveryPath.'core/lgvast.php?bannerid='.$bannerid."&event=complete";
	$vast['generalUrl']					= $deliveryPath.'core?bannerid='.$bannerid."&event=none"; 	
	$vast['mute']						= $deliveryPath.'core?bannerid='.$bannerid."&event=mute"; 	
	$vast['unmute']						= $deliveryPath.'core?bannerid='.$bannerid."&event=unmute"; 	
	$vast['skip']						= $deliveryPath.'core/lgvast.php?bannerid='.$bannerid."&event=skip"; 	
	
	if($banner['ext_bannertype']=='create_video'){
		$vast['vast_video_outgoing_filename']	= $deliveryPath."banners/videos/".$vast['vast_video_outgoing_filename'];
	}
	
	
	
	//echo '<pre>';print_r($vast);die;
	if (array_key_exists('HTTP_ORIGIN', $_SERVER)) {
		$origin = $_SERVER['HTTP_ORIGIN'];
	}
	else if (array_key_exists('HTTP_REFERER', $_SERVER)) {
		$origin = $_SERVER['HTTP_REFERER'];
	} else {
		$origin = $_SERVER['REMOTE_ADDR'];
	}
	
	$player   = "";
	header("Content-type: text/xml");
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Origin: *");
	
	$player	  = "<?xml version=\"1.0\"  encoding='UTF-8'?>";
	
	$player	  = "<VAST version=\"3.0\">
	<Ad id=\"697200496\">";
	
	if($banner['ext_bannertype']=='create_video'){
		$player	  .= "<InLine>";
		$player	  .= "<AdSystem>MediaConverison</AdSystem>
			<AdTitle>Media Ads</AdTitle>
			<Description>MediaConverison Vast Tag</Description>";
	}else{
		$player	  .= "<Wrapper>";
		$player	  .= "<AdSystem>MediaConverison</AdSystem>
						<AdTitle>Media Ads</AdTitle>
						<Description>MediaConverison Vast Tag</Description>";
		$player	  .= "<VASTAdTagURI><![CDATA[${vast['vast_tag']}]]></VASTAdTagURI>";
	}
	
	
	
	$player	  .="
	<Error><![CDATA[${vast['vast_thirdparty_erorr']}]]></Error>
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
	<Tracking event=\"mute\"><![CDATA[${vast['mute']}]]></Tracking>
	<Tracking event=\"unmute\"><![CDATA[${vast['unmute']}]]></Tracking>
	<Tracking event=\"rewind\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"pause\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"resume\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"fullscreen\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"creativeView\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"exitFullscreen\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"acceptInvitationLinear\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"closeLinear\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"skip\"><![CDATA[${vast['skip']}]]></Tracking>
	<Tracking event=\"progress\" offset=\"00:00:05\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"progress\" offset=\"00:00:30\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	</TrackingEvents>";
	if($banner['ext_bannertype']=='create_video'){
		$player	  .="<VideoClicks>
			<ClickThrough><![CDATA[${banner['url']}]]></ClickThrough>
			<ClickTracking><![CDATA[${vast['third_party_click']}]]></ClickTracking>
		</VideoClicks>		
		<MediaFiles>
			<MediaFile id=\"GDFP\" delivery=\"progressive\" width=\"1280\" height=\"720\" type=\"video/mp4\" bitrate=\"533\" scalable=\"true\" maintainAspectRatio=\"true\"><![CDATA[${vast['vast_video_outgoing_filename']}]]></MediaFile>
		</MediaFiles>";
	
	}else{
		$player	  .="<VideoClicks>
			<ClickTracking><![CDATA[${vast['third_party_click']}]]></ClickTracking>
		</VideoClicks>";
		
	}
	
	$player	  .="</Linear>
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
	</Creatives>";
	
	if($banner['ext_bannertype']=='create_video'){
		$player	  .= "</InLine>";
	}else{
		$player	  .= "</Wrapper>";
	}
	
	$player	  .= "</Ad>
	</VAST>"; 
	
	/* $player	  = "<?xml version=\"1.0\"  encoding='UTF-8'?>";
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
	<Tracking event=\"mute\"><![CDATA[${vast['mute']}]]></Tracking>
	<Tracking event=\"unmute\"><![CDATA[${vast['unmute']}]]></Tracking>
	<Tracking event=\"rewind\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"pause\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"resume\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"fullscreen\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"creativeView\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"exitFullscreen\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"acceptInvitationLinear\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"closeLinear\"><![CDATA[${vast['generalUrl']}]]></Tracking>
	<Tracking event=\"skip\"><![CDATA[${vast['skip']}]]></Tracking>
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
	</VAST>";  */
	echo  $player;
}

renderVastOutput();
?>