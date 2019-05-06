<style>
.ad-banner-interstitial-full-desktop {
  position: fixed;
  z-index: 99999;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.58);
  display: flex;
  justify-content: center;
  align-items: center;
}

.ad-banner-interstitial-full-desktop.hidden-ad {
  display: none;
}

.ad-banner-interstitial-full-desktop .ad-banner-wrap {
  width: 40%;
  height: 65%;
  position: relative;
}
.ad-banner-interstitial-full-desktop .ad-banner-wrap .toggle-btn {
  position: absolute;
  top: 0;
  right: 0;
  z-index: 4;
  color: white;
  background-color: #000000;
  border: 0 none;
  font-size: 32px;
  width: 40px;
  height: 40px;
  line-height: 0;
  cursor: pointer;
}
.ad-banner-interstitial-full-desktop .ad-banner-wrap a.ad-hyperlink {
  display: block;
}
.ad-banner-interstitial-full-desktop .ad-banner-wrap a.ad-hyperlink .banner-imgs {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>
	<div class="ad-banner-interstitial-full-desktop banner-ad-id-14">
        <div class="ad-banner-wrap">
            <button class="toggle-btn ad-toggle-id-14" type="button">&times;</button>
            <a class="ad-hyperlink" target="_blank" href="{clickurl}">
                <img class="banner-imgs ad-img-1-id-14" src="{image1}" alt="interstitial ad banner">
            </a>
        </div>
    </div>
	<script>
	(function (id) {
        var adBannerWrap = document.querySelector('.banner-ad-id-14');
        if (adBannerWrap) {
            var adBtn = adBannerWrap.querySelector('.toggle-btn');
            if (adBtn) {
                adBtn.addEventListener('click', function () {
                    toggleAd();
                });
            }
        }

        var visible = false;
        function toggleAd() {
            if (visible) {
                adBannerWrap.classList.add('hidden-ad');
                visible = false;
            } else {
                adBannerWrap.classList.remove('hidden-ad');
                visible = true;
            }
        }
		setTimeout(function(){
            toggleAd();
        }, 0)

    })('14');

</script>



