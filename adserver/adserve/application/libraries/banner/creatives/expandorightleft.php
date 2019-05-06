 <style>
.ad-banner-page-over-left {
     position: relative;
     height: 250px;
     width: 300px;
 }

 .ad-banner-page-over-left a.ad-hyperlink {
     overflow: auto;
     display: inline-block;
 }
 .ad-banner-page-over-left a.ad-hyperlink.hidden-ad{
    display: none;
 }
 .ad-banner-page-over-left button.toggle-btn {
     position: absolute;
     top: 0;
     right: 0;
     z-index: 10;
 }

 .ad-banner-page-over-left .ad-banner-wrap {
     overflow: hidden;
     position: absolute;
     top: 0;
     right: 0;
     width: 100%;
     transition: width 0.50s;
 }

 .ad-banner-page-over-left .banner-imgs {
     width: auto;
 }

 </style>
<div class="ad-wrapper">
	<div class="ad-banner-page-over-left banner-ad-id-12">
		<button class="toggle-btn ad-toggle-id-12" type="button">Click</button>
		<div class="ad-banner-wrap img-wrap-id-12">
			<a class="ad-hyperlink small" target="_blank" href="{clickurl}">
				<img class="banner-imgs ad-img-1-id-12" src="{image1}"
					alt="page over left banner">
			</a>
			<a class="ad-hyperlink large hidden-ad" target="_blank" href="{clickurl}">
				<img class="banner-imgs ad-img-1-id-12" src="{image2}"
					alt="page over left banner">
			</a>

		</div>

	</div>
</div>
<script>

    (function (id) {
        var adBanner = document.querySelector('.banner-ad-id-' + id);
        if (adBanner) {
            var expanded = false;
            var bannerWrap_2 = adBanner.querySelector('.img-wrap-id-' + id);
            var adbtn = adBanner.querySelector('button.ad-toggle-id-' + id);
            var adBannerLarge = bannerWrap_2.querySelector('.ad-hyperlink.large');
            var adBannerSmall = bannerWrap_2.querySelector('.ad-hyperlink.small');
            if (adbtn) {
                adbtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    e.preventDefault();
                    toggleAd();
                });
            }
            adBanner.addEventListener('mouseenter', function () {
                if (!expanded) {
                    toggleAd();
                }
            });
            adBanner.addEventListener('mouseleave', function () {
                if (expanded) {
                    toggleAd();
                }
            });
            var timer = null;
            function toggleAd() {
                if(timer){
                    clearTimeout(timer);
                }
                if (expanded) {
                    bannerWrap_2.style.width = '100%';
                    timer = setTimeout(function(){
                        adBannerLarge.classList.add('hidden-ad');
                        adBannerSmall.classList.remove('hidden-ad');
                        expanded = false;
                        adbtn.innerText = 'Expand';
                    }, 500);
                }
                else {
                    bannerWrap_2.style.width = '500px';
                    adBannerLarge.classList.remove('hidden-ad');
                    adBannerSmall.classList.add('hidden-ad');
                    adbtn.innerText = 'Close';
                    expanded = true;
                }
            }
            var count_3 = 0;
           
            var timer_3 = setInterval(function () {
                if (count_3 >= 1) {
                    clearInterval(timer_3);
                }
                toggleAd();
                count_3++;
            }, 2000);
        }
    })('12');
</script>