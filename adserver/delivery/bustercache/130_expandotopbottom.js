var randomId    = Math.random() + '';
randomId        = randomId.replace( '.', '' );

var split;
var key;
var value;


function toggle( bannerId, expandTo, width ){
	var i,ifcnt=window.parent.frames.length;
	var ifound=0;
	for(i=0;i<ifcnt;i++){
		try{
			if(window.parent.frames[i]==window.self){
				ifound=i;break;
			}
		}catch(e){}
	}
	
	if(window.frameElement){
		for(i=0;i<ifcnt;i++){
			try{
			 
				if(window.parent.frames[ifound].frameElement === parent.document.getElementsByTagName('IFRAME')[i]){
					ifound=i;break;
				}
			}catch(e){
			}
		}
	}
	var abc						= parent.document.getElementsByTagName('IFRAME')[ifound];
	var dfpiframe				= false;
	if( abc	){
		var parentDiv			= $(abc).parent().parent().parent();
		var iframeParent		= $(abc).parent().parent();
		var firstparagrapgh 	= $(parentDiv).children().first();
		dfpiframe				= true;
		
		var css			= '';
			css			=".ad-banner-page-over { height: 90px; width: 728px; position: relative; z-index: 999999; } .ad-banner-page-over a.ad-hyperlink { overflow: auto; display: inline-block; } .ad-banner-page-over a.ad-hyperlink.ad-hidden { display: none; } .ad-banner-page-over button.toggle-btn { position: absolute; top: 0; left: 0; } .ad-banner-page-over img.banner-imgs { width: 100%; max-width: 100%; } .ad-banner-page-over .ad-banner-wrap { overflow: hidden; height: 90px; transition: height 1s; }";


	style 			= parent.document.createElement('style');
	style.type 		= 'text/css';
	style.innerHTML = css;
	
	
	var div	 		= "";
	var reference 	= "";
	var script 		= "";
	
	//reference	+= "	<script>  jQuery(document).ready(function(){ \n";
	reference	+= "	<script>";

	reference 	+= "		pppinterval = setInterval(function(){\n";
	reference	+= "				if( referenceabc ) { \n";
	reference 	+= "					landingPageUrl= referenceabc; \n";

	div			+= '<div class="ad-wrapper" id="expandrighttoleft-11345">';
	div			+= '	<div class="ad-banner-page-over banner-ad-id-11">';
	div			+= '		<button class="toggle-btn ad-toggle-id-11" type="button">Expand</button> ';
	div			+= '		<div class="ad-banner-wrap img-wrap-id-11">';
	div			+= '			<a class="ad-hyperlink small-banner"  target="_blank" href="https://adclick.g.doubleclick.net/pcs/click?xai=AKAOjsu-ACBGHPLAeC2DUxeJyjxdIPFldBmOcXeMJ4aOyB4aqffhwz2DKbV8wjrOTgmBjN3z9D5OVY1VbMZMeht5h-j3VqYwX6Oae9a3nBGHtTPQ4wIpqE4xS3vp98sck4o9uQvdABVHvusTb3hvuyFf7ITXWB010_zWpehqZMdWwFjhxOrZEdfP8ud8vXlzFhLa5-veR4PiOVXpB3F_wL0e2lTRbyfd4rzIuoK0GbareAibfSO-41dD2eQPMRRSqWqkE7KFAw&sai=AMfl-YQ9mY6nY5vVok2FuBZulnQsWvCwn1C7OBCtGcZqR9k_VznzfUobpM40Dtfl7zDCPCLNwTCE4FW6fmfm4jb4KCtJZB9TmbbiE2QOixNfoXCNYcIhm1OOsmVRgRDp&sig=Cg0ArKJSzNJiNJ_vBFmGEAE&urlfix=1&adurl=http://localhost/adserver/delivery/core/ckvast.php?zoneid=33&bannerid=130"> ';
	div			+= '				<img class="ad-img-1-id-11 banner-imgs" src="http://localhost/adserver/delivery/banners/images/728x90.jpeg" alt="">';
	div			+= '			</a>';
	div			+= '			<a class="ad-hyperlink large-banner ad-hidden" target="_blank"  href="https://adclick.g.doubleclick.net/pcs/click?xai=AKAOjsu-ACBGHPLAeC2DUxeJyjxdIPFldBmOcXeMJ4aOyB4aqffhwz2DKbV8wjrOTgmBjN3z9D5OVY1VbMZMeht5h-j3VqYwX6Oae9a3nBGHtTPQ4wIpqE4xS3vp98sck4o9uQvdABVHvusTb3hvuyFf7ITXWB010_zWpehqZMdWwFjhxOrZEdfP8ud8vXlzFhLa5-veR4PiOVXpB3F_wL0e2lTRbyfd4rzIuoK0GbareAibfSO-41dD2eQPMRRSqWqkE7KFAw&sai=AMfl-YQ9mY6nY5vVok2FuBZulnQsWvCwn1C7OBCtGcZqR9k_VznzfUobpM40Dtfl7zDCPCLNwTCE4FW6fmfm4jb4KCtJZB9TmbbiE2QOixNfoXCNYcIhm1OOsmVRgRDp&sig=Cg0ArKJSzNJiNJ_vBFmGEAE&urlfix=1&adurl=http://localhost/adserver/delivery/core/ckvast.php?zoneid=33&bannerid=130">';
	div			+= '				<img class="ad-img-1-id-11 banner-imgs"  src="http://localhost/adserver/delivery/banners/images/728x180.gif" alt="">';
	div			+= '			</a>';
	div			+= '		</div>';
	div			+= '		<img src="http://localhost/adserver/delivery/core/lgimpr.php?bannerid=130&zoneid=33&cb=04f5e051" width="1" height="1" alt="">';
	div			+= '		<img src="http://localhost/jmm/trackers/impression.php/time=1223;ord=3344" width="1" height="1" alt="">';
	div			+= '	</div>';
	div			+= '</div>';
	
	
	

	reference	+= "			clearInterval(pppinterval);\n"; 
	reference	+= "				}	\n";			
	reference	+= "			}, 1000);\n";

	//reference	+= "});\n";
	reference	+= "</script>";

	
	
	
	script 	+= "<script>";
	script  += "(function (id) { var adBanner = parent.document.querySelector('.banner-ad-id-' + id); ";
	script  += "if (adBanner) { ";
	script  += "var expanded 		= false;";
	script  += "var bannerWrap_1 	= adBanner.querySelector('.img-wrap-id-' + id);";
	script  += "var adbtn 			= adBanner.querySelector('button.ad-toggle-id-' + id);";
	script  += "var adBannerLarge 	= adBanner.querySelector('.ad-hyperlink.large-banner');";
	script  += "var adBannerSmall 	= adBanner.querySelector('.ad-hyperlink.small-banner');"; 
	script  += "if (adbtn) { adbtn.addEventListener('click', function (e) {";
	script  += "	e.stopPropagation(); e.preventDefault(); toggleAd(); });";
	script  += "	adBanner.addEventListener('mouseenter', function () {";
	script  += "		if (!expanded) { toggleAd(); } });";
	script  += "		adBanner.addEventListener('mouseleave', function () { ";
	script  += "		if (expanded) { toggleAd(); } }); }";
	script  += "		var animTimer = null; ";
	script  += "		function toggleAd() { if (animTimer) {";
	script  += "			clearTimeout(animTimer); }";
	script  += "			if (expanded) {";
	script  += "				bannerWrap_1.style.height = '90px'; ";
	script  += "				expanded = false;";
	script  += "				adbtn.innerText = 'Expand'; ";
	script  += "				animTimer = setTimeout(function () {";
	script  += "					adBannerLarge.classList.add('ad-hidden'); ";
	script  += "					adBannerSmall.classList.remove('ad-hidden'); }, 1000); ";
	script  += "			} else {";
	script  += "				adBannerLarge.classList.remove('ad-hidden');";
	script  += "				bannerWrap_1.style.height = '180px'; ";
	script  += "				adbtn.innerText = 'Close'; ";
	script  += "				adBannerSmall.classList.add('ad-hidden');";
	script  += "				expanded = true; } }";
		script  += "			var count_2 = 0; ";
	script  += "				var timer_2 = setInterval(function () { if (count_2 >= 1) { ";
	script  += "				clearInterval(timer_2);";
	script  += "				} toggleAd(); count_2++; }, 2000); } })('11');";
	script 	+= "</script>";
	
	$(iframeParent).before(reference);
	$(iframeParent).before(div);
	$(iframeParent).before(style);
	$(iframeParent).before(script);
	}
}

try
{
	var bannerId    = 'media-ad-' + randomId;
    toggle( bannerId, 480,640);
  
}
catch(e)
{
    console.log(e);
} 


   





 