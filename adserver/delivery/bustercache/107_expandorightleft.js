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
			css			=".ad-banner-page-over-left { position: relative; height: 250px; width: 300px; } .ad-banner-page-over-left a.ad-hyperlink { overflow: auto; display: inline-block; } .ad-banner-page-over-left a.ad-hyperlink.hidden-ad{ display: none; } .ad-banner-page-over-left button.toggle-btn { position: absolute; top: 0; right: 0; z-index: 10; } .ad-banner-page-over-left .ad-banner-wrap { overflow: hidden; position: absolute; top: 0; right: 0; width: 100%; transition: width 0.50s; } .ad-banner-page-over-left .banner-imgs { width: auto; }";


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

	div			+= '<div class="ad-wrapper" id="expandrighttoleft-12345">';
	div			+= '	<div class="ad-banner-page-over-left banner-ad-id-12">';
	div			+= '		<button class="toggle-btn ad-toggle-id-12" type="button">Expand</button> ';
	div			+= '		<div class="ad-banner-wrap img-wrap-id-12">';
	div			+= '			<a class="ad-hyperlink small"  target="_blank" href="https://adclick.g.doubleclick.net/pcs/click?xai=AKAOjstJkZru1u-vq2iQNzftX4jsASfWL3ga7bIp-2qclNAdgSTGr_P1W8jgI48BED8rfd-U-zPa4N72ow7uLGFy2KcXtquyGHpgKKGxUvxyH67-6QD2PoeoBqLnDqcRnTjsfik_otElo7cqoSDruYDIfnVuyGyrFyAhdOfcNCHzmawPvCMTqqJdRFmPklSD2CW-HBWWvjYv_AWkOibrf3EnGwi4zLcD7jM-Bh0uIj_CsqIKZNYX1TralKmK34nMhygubbFL&sai=AMfl-YTRp5d5_Mb47c9KtpQo5Ca8D4kuVypURaNxnTDX16ox399xxZvJYAPpRwabzoTRpTn7q2KH1WlcWMk-hjBcYQmA9uE_ylfq8M9olzB8STHKqbVBpceb0qmtSBs&sig=Cg0ArKJSzNqNA0bgGvH6EAE&urlfix=1&adurl=http://localhost/adserver/delivery/core/ckvast.php?zoneid=5&bannerid=107"> ';
	div			+= '				<img class="banner-imgs ad-img-1-id-12" src="http://localhost/adserver/delivery/banners/images/" alt="">';
	div			+= '			</a>';
	div			+= '			<a class="ad-hyperlink large hidden-ad" target="_blank"  href="https://adclick.g.doubleclick.net/pcs/click?xai=AKAOjstJkZru1u-vq2iQNzftX4jsASfWL3ga7bIp-2qclNAdgSTGr_P1W8jgI48BED8rfd-U-zPa4N72ow7uLGFy2KcXtquyGHpgKKGxUvxyH67-6QD2PoeoBqLnDqcRnTjsfik_otElo7cqoSDruYDIfnVuyGyrFyAhdOfcNCHzmawPvCMTqqJdRFmPklSD2CW-HBWWvjYv_AWkOibrf3EnGwi4zLcD7jM-Bh0uIj_CsqIKZNYX1TralKmK34nMhygubbFL&sai=AMfl-YTRp5d5_Mb47c9KtpQo5Ca8D4kuVypURaNxnTDX16ox399xxZvJYAPpRwabzoTRpTn7q2KH1WlcWMk-hjBcYQmA9uE_ylfq8M9olzB8STHKqbVBpceb0qmtSBs&sig=Cg0ArKJSzNqNA0bgGvH6EAE&urlfix=1&adurl=http://localhost/adserver/delivery/core/ckvast.php?zoneid=5&bannerid=107">';
	div			+= '				<img class="banner-imgs ad-img-1-id-12"  src="http://localhost/adserver/delivery/banners/images/" alt="">';
	div			+= '			</a>';
	div			+= '		</div>';
	div			+= '		<img src="http://localhost/adserver/delivery/core/lgimpr.php?bannerid=107&zoneid=5&cb=772ef777" width="1" height="1" alt="">';
	div			+= '		<img src="http://localhost/jmm/trackers/impression.php/time=1223;ord=3344" width="1" height="1" alt="">';
	div			+= '	</div>';
	div			+= '</div>';
	
	
	

	reference	+= "			clearInterval(pppinterval);\n"; 
	reference	+= "				}	\n";			
	reference	+= "			}, 1000);\n";

	//reference	+= "});\n";
	reference	+= "</script>";

	
	
	
	script 	+= "<script>";
	script  += "(function (id) { var adBanner = parent.document.querySelector('.banner-ad-id-' + id); console.log(adBanner);if (adBanner) { var expanded = false; var bannerWrap_2 = adBanner.querySelector('.img-wrap-id-' + id); var adbtn = adBanner.querySelector('button.ad-toggle-id-' + id); var adBannerLarge = bannerWrap_2.querySelector('.ad-hyperlink.large'); var adBannerSmall = bannerWrap_2.querySelector('.ad-hyperlink.small'); if (adbtn) { adbtn.addEventListener('click', function (e) { e.stopPropagation(); e.preventDefault(); toggleAd(); }); } adBanner.addEventListener('mouseenter', function () { if (!expanded) { toggleAd(); } }); adBanner.addEventListener('mouseleave', function () { if (expanded) { toggleAd(); } }); var timer = null; function toggleAd() { if(timer){ clearTimeout(timer); } if (expanded) { bannerWrap_2.style.width = '100%'; timer = setTimeout(function(){ adBannerLarge.classList.add('hidden-ad'); adBannerSmall.classList.remove('hidden-ad'); expanded = false; adbtn.innerText = 'Expand'; }, 500); } else { bannerWrap_2.style.width = '500px'; adBannerLarge.classList.remove('hidden-ad'); adBannerSmall.classList.add('hidden-ad'); adbtn.innerText = 'Close'; expanded = true; } } var count_3 = 0;  var timer_3 = setInterval(function () { if (count_3 >= 1) { clearInterval(timer_3); } toggleAd(); count_3++; }, 2000); } })('12');";
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
    console.log( e );
} 


   





 