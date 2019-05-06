<style>
.ad-banner-page-over {
     height: 90px;
     width: 728px;
     position: relative;
	 z-index: 999999;
 }

 .ad-banner-page-over a.ad-hyperlink {
     overflow: auto;
     display: inline-block;
 }
 .ad-banner-page-over a.ad-hyperlink.ad-hidden {
     display: none;
 }

 .ad-banner-page-over button.toggle-btn {
     position: absolute;
     top: 0;
     left: 0;
 }

 .ad-banner-page-over img.banner-imgs {
     width: 100%;
     max-width: 100%;
 }

 .ad-banner-page-over .ad-banner-wrap {
     overflow: hidden;
     height: 90px;
     transition: height 1s;
 }
</style>
    <div class="ad-wrapper">
		<div class="ad-banner-page-over banner-ad-id-11">
			<button class="toggle-btn ad-toggle-id-11" type="button">Expand</button>
			<div class="ad-banner-wrap img-wrap-id-11">
				<a class="ad-hyperlink small-banner" target="_blank" href="{clickurl}">
					<img class="ad-img-1-id-11 banner-imgs" src="{image1}" alt="">
				</a>
				<a class="ad-hyperlink large-banner ad-hidden" target="_blank" href="{clickurl}">
					<img class="ad-img-1-id-11 banner-imgs" src="{image2}" alt="">
				</a>
			</div>
		</div>
	</div>
	 <script>				
	(function (id) {
        var adBanner = document.querySelector('.banner-ad-id-' + id);
        if (adBanner) {
            var expanded = false;
            var bannerWrap_1 = adBanner.querySelector('.img-wrap-id-' + id);
            var adbtn = adBanner.querySelector('button.ad-toggle-id-' + id);

            var adBannerLarge = adBanner.querySelector('.ad-hyperlink.large-banner')
            var adBannerSmall = adBanner.querySelector('.ad-hyperlink.small-banner')

            if (adbtn) {
                adbtn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    e.preventDefault();
                    toggleAd();
                });
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
            }

            var animTimer = null;

            function toggleAd() {
                if (animTimer) {
                    clearTimeout(animTimer);
                }
                if (expanded) {
                    bannerWrap_1.style.height = '90px';
                    expanded = false;
                    adbtn.innerText = 'Expand';
                    animTimer = setTimeout(function () {
                        adBannerLarge.classList.add('ad-hidden');
                        adBannerSmall.classList.remove('ad-hidden');
                    }, 1000);
                    
                }
                else {
                    adBannerLarge.classList.remove('ad-hidden');
                    bannerWrap_1.style.height = '180px';
                    adbtn.innerText = 'Close';
                    adBannerSmall.classList.add('ad-hidden');
                    expanded = true;
                }
            }
            var count_2 = 0;
            var timer_2 = setInterval(function () {
                if (count_2 >= 1) {
                    clearInterval(timer_2);
                }
                toggleAd();
                count_2++;
            }, 2000);
        }
    })('11');
  
</script>