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
			css			=".banner-page-pusher { height: 90px; overflow: hidden; transition: height 0.50s; width: 728px; position: relative } .banner-page-pusher a.ad-hyperlink { overflow: auto; display: inline-block; } .banner-page-pusher img.banner-imgs { width: 100%; max-width: 100%; } .banner-page-pusher button.toggle-btn { position: absolute; top: 0; cursor : pointer; } .banner-page-pusher button.toggle-btn.toggle-btn-left { left: 0; }";


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

	div			+= '<div class="ad-wrapper" id="pagepushdown-12345">';
	div			+= '	<div class="banner-page-pusher banner-ad-id-10">';
	div			+= '		<button class="toggle-btn toggle-btn-left ad-toggle-id-10" type="button">Expand</button> ';
	div			+= '		<a class="ad-hyperlink" id="initial1" target="_blank" href="https://adclick.g.doubleclick.net/pcs/click?xai=AKAOjst5EiwvT5b4V5AJ07cVmZjqf44zLVcFEHHye_Q7PaSIwCyCWpzic6O-QZepPuzFdLOQw7KCdLx7bNR63gtuhJpKQqosuy4BFVyogZmyZCuxQ0Ys8hIv2dN-DSB1gnW9MLieaNc-TKGFPVIrO9ljMTdl-UmnfpXk1icFe0ytx3U6l2pqIxxoZPlVnk9MBdMnEy23Zk4qikyj6rhWONBshIXxaRAYqzI08JukOggGYU3m8AE4c4xWKPw7sH4lbg&sai=AMfl-YTyYT2KqYv_dzAupiMo8HI3vosmg5LxgPwENbpQZG3HpYJTNGlWDDvDjFEiMOK6QzaWkPqgYPVTg9g4hWljtqq9XQX8PLUI3EWpXR5hkxNA0zA5ntGWilxCb50&sig=Cg0ArKJSzOGD5BRTYmjaEAE&urlfix=1&adurl=http://localhost/adserver/delivery/core/ckvast.php?zoneid=23&bannerid=122"> ';
	div			+= '			<img class="banner-imgs ad-img-1-id-10" src="http://localhost/adserver/delivery/banners/images/728x90.jpeg" alt="">';
	div			+= '		</a>';
	div			+= '		<a class="ad-hyperlink" target="_blank" id="initial2" href="https://adclick.g.doubleclick.net/pcs/click?xai=AKAOjst5EiwvT5b4V5AJ07cVmZjqf44zLVcFEHHye_Q7PaSIwCyCWpzic6O-QZepPuzFdLOQw7KCdLx7bNR63gtuhJpKQqosuy4BFVyogZmyZCuxQ0Ys8hIv2dN-DSB1gnW9MLieaNc-TKGFPVIrO9ljMTdl-UmnfpXk1icFe0ytx3U6l2pqIxxoZPlVnk9MBdMnEy23Zk4qikyj6rhWONBshIXxaRAYqzI08JukOggGYU3m8AE4c4xWKPw7sH4lbg&sai=AMfl-YTyYT2KqYv_dzAupiMo8HI3vosmg5LxgPwENbpQZG3HpYJTNGlWDDvDjFEiMOK6QzaWkPqgYPVTg9g4hWljtqq9XQX8PLUI3EWpXR5hkxNA0zA5ntGWilxCb50&sig=Cg0ArKJSzOGD5BRTYmjaEAE&urlfix=1&adurl=http://localhost/adserver/delivery/core/ckvast.php?zoneid=23&bannerid=122">';
	div			+= '			<img class="banner-imgs ad-img-2-id-10" style="display: none;" src="http://localhost/adserver/delivery/banners/images/970x250.jpg" alt="">';
	div			+= '		</a>';
	div			+= '		<img src="http://localhost/adserver/delivery/core/lgimpr.php?bannerid=122&zoneid=23&cb=f03f4736" width="1" height="1" alt="">';
	div			+= '		<img src="http://localhost/jmm/trackers/impression.php/time=1223;ord=3344" width="1" height="1" alt="">';
	div			+= '	</div>';
	div			+= '</div>';
	
	
	

	reference	+= "			clearInterval(pppinterval);\n"; 
	reference	+= "				}	\n";			
	reference	+= "			}, 1000);\n";

	//reference	+= "});\n";
	reference	+= "</script>";

	
	
	
	script 	+= "<script>";
	script  += "(function (id) { var adBanner = parent.document.querySelector('.banner-ad-id-' + id);  if (adBanner) { var expanded = false; var adbtn = adBanner.querySelector('.ad-toggle-id-' + id); var img1 = adBanner.querySelector('img.ad-img-1-id-' + id); var img2 = adBanner.querySelector('img.ad-img-2-id-' + id); \n";
	script  += "if (adbtn) { adbtn.addEventListener('click', function (e) { e.stopPropagation(); e.preventDefault(); toggleAd(); }); } adBanner.addEventListener('mouseenter', function () { if (!expanded) { toggleAd(); } }); adBanner.addEventListener('mouseleave', function () { if (expanded) { toggleAd(); } }); function toggleAd() { if (expanded) { collpaseAdBanner(); } else { expandAdBanner(); } } function expandAdBanner(){ adBanner.style.height = '180px'; img1.style.display = 'none'; img2.style.display = 'initial'; expanded = true; adbtn.innerText = 'Close'; } function collpaseAdBanner(){ adBanner.style.height = '90px'; img1.style.display = 'initial'; img2.style.display = 'none'; expanded = false; adbtn.innerText = 'Expand'; } var count_1 = 0; var timer_1 = setInterval(function () { if (count_1 >= 1) { clearInterval(timer_1); } toggleAd(); count_1++; }, 2000); } })('10');";
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


   





 