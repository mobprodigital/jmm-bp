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
			css			=".ad-banner-interstitial-full-desktop { position: fixed; z-index: 99999; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.58); display: flex; justify-content: center; align-items: center; } .ad-banner-interstitial-full-desktop.hidden-ad { display: none; } .ad-banner-interstitial-full-desktop .ad-banner-wrap { width: 40%; height: 65%; position: relative; } .ad-banner-interstitial-full-desktop .ad-banner-wrap .toggle-btn { position: absolute; top: 0; right: 0; z-index: 4; color: white; background-color: #000000; border: 0 none; font-size: 32px; width: 40px; height: 40px; line-height: 0; cursor: pointer; } .ad-banner-interstitial-full-desktop .ad-banner-wrap a.ad-hyperlink { display: block; } .ad-banner-interstitial-full-desktop .ad-banner-wrap a.ad-hyperlink .banner-imgs { position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; }";


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

	div			+= '<div class="ad-banner-interstitial-full-desktop banner-ad-id-14">';
	div			+= '	<div class="ad-banner-wrap" id="expandrighttoleft-11345">';
	div			+= '		<button class="toggle-btn ad-toggle-id-14" type="button">&times;</button> ';
	div			+= '			<a class="ad-hyperlink"  target="_blank" href="https://adclick.g.doubleclick.net/pcs/click?xai=AKAOjsvRTsa1AmRWb4FYA5PiSxZGt2QFphObBDliMnZKKEuqn3NmAIdNrNoY4whUrt49I8bdy930H4lDV4qxtIWOHRT6DZP5a01fy8TmJTl0iS7wJLg1g_DaqxT8sVsIe2lfryPn_73N1_ggznP3AiBm8So4tvDQcpeuNmn2AMnzg6_MSmKNFfySD8PwccUyfYqawYrdjm4idpFKPIZU17-1rmM4ek_H1aebgRQti2jxTP9aI-5KuNyVGfwiEg&sai=AMfl-YQ7krZB_yrIWERUIZR6KeKBFHV15ycnigDLmt9wSpIVUs3xMDWXfuNncZgM02dGp4_4iLgcowjO1TSk3lL8DKEVx0MizB4yl5zU1QLL3r0hhEOXCOxJhOaoxg4&sig=Cg0ArKJSzEvH8gKxn1C8EAE&urlfix=1&adurl=http://localhost/adserver/delivery/core/ckvast.php?zoneid=34&bannerid=131"> ';
	div			+= '				<img class="ad-img-1-id-11 banner-imgs" src="http://localhost/adserver/delivery/banners/images/ad_banner_full_desktop.jpg" alt="">';
	div			+= '			</a>';

	div			+= '		<img src="http://localhost/adserver/delivery/core/lgimpr.php?bannerid=131&zoneid=34&cb=d34ea3e9" width="1" height="1" alt="">';
	div			+= '		<img src="http://localhost/jmm/trackers/impression.php/time=1223;ord=3344" width="1" height="1" alt="">';
	div			+= '	</div>';
	div			+= '</div>';
	
	reference	+= "			clearInterval(pppinterval);\n"; 
	reference	+= "				}	\n";			
	reference	+= "			}, 1000);\n";

	//reference	+= "});\n";
	reference	+= "</script>";

	
	
	
	script 	+= "<script>";
	script  += "(function (id) { var adBannerWrap = parent.document.querySelector('.banner-ad-id-14'); if (adBannerWrap) { var adBtn = adBannerWrap.querySelector('.toggle-btn'); if (adBtn) { adBtn.addEventListener('click', function () { toggleAd(); }); } } var visible = false; function toggleAd() { if (visible) { adBannerWrap.classList.add('hidden-ad'); visible = false; } else { adBannerWrap.classList.remove('hidden-ad'); visible = true; } } setTimeout(function(){ toggleAd(); }, 0) })('14');";
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


   





 