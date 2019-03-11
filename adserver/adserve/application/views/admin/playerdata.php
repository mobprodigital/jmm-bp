<div class="content-wrapper">
	<section class="content-header">
		<label> <input  class="form-control" style="width:295px;" placeholder="Search"></label><small class="btn btn-large btn-primary" style=" float:right;"><?php echo anchor('users/uploadvideo','Upload Video');?></small>
	</section>
	<section class="content">
		<span>Playing Status of <?php echo $videos[0]->name;?></span>
		<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	
	<script language="javascript">AC_FL_RunContent = 0;</script>
	<script src="https://www.mediaconversion.com/report/video/AC_RunActiveContent.js" language="javascript"></script>
	<style type="text/css">
		#flashContent {
			position:	absolute;

			width:		50%;
			height:		50%;
		}
	</style>

    <script language="javascript">

	function getTime(timeg, dure){
     console.log(timeg + "  - " + dure);
}

	function getCampaignData(event, duration){
     console.log(event + "  - " + duration);
	 }

function jsAdd(value1,value2)
{
       return ('ans:'+value1+value2);
}

	</script>

</head>
<body bgcolor="#fff">
<div id="flashContent">
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" width="100%" height="100%" id="videoplayer.prt1" align="middle">
		<param name="allowScriptAccess" value="always" />
		<param name="allowFullScreen" value="false" />

		<param name="VIDEO_AUTOPLAY" value="true" />

		<!--
        <param name="flashvars" value="Vcontent1=content1.mp4&Vcontent2=content2.mp4&Vcontent3=content3.mp4&Vcontent4=content4.mp4&Vcontent5=content5.mp4&skipOption=true&adscontent1=ad1.mp4&adscontent2=no_ad&adscontent3=ad3.mp4&adscontent4=ad4.mp4&adscontent5=ad5.mp4&skipAddTime=5&unmuteSound=true&adsStartTime=8&playerAutoPlay=0&clickTargetUrl=0&start=http://www.mediaconversion.com />
		
		<param name="movie" value="video.swf?37" />-->
        <param name="quality" value="high" />
        <param name="bgcolor" value="#fff" />
		
        <embed src="https://www.mediaconversion.com/report/video/video.swf?37" quality="high" bgcolor="#fff" width="100%" height="100%" name="video" align="middle" allowScriptAccess="always" allowFullScreen="true" type="application/x-shockwave-flash" FlashVars="&Vcontent1=<?php echo base_url().'assets/videos/'.$videos[0]->name;?>&Vcontent2=content2.mp4&Vcontent3=content3.mp4&Vcontent4=content4.mp4&Vcontent5=content5.mp4&skipOption=false&adscontent1=no_ad&adscontent2=no_ad&adscontent3=no_ad&adscontent4=no_ad&adscontent5=no_ad&skipAddTime=5&unmuteSound=true&adsStartTime=8&playerAutoPlay=0&Fmute=false&clickTargetUrl=0&VideoClicks=https://www.cricbuzz.com/" pluginspage="http://www.macromedia.com/go/getflashplayer" />
		</object>
</div>
</body>
</html>
				
</section>
</div>
<?php $this->load->view('admin_includes/footer');?>


      
 