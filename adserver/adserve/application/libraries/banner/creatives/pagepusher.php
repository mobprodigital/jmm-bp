<!-- page pusher start -->
<style>
 .banner-page-pusher {
     height: 90px;
     overflow: hidden;
     transition: height 0.50s;
     width: 728px;
     position: relative
 }

 .banner-page-pusher a.ad-hyperlink {
     overflow: auto;
     display: block;
 }

 .banner-page-pusher img.banner-imgs {
     width: 100%;
     max-width: 100%;
 }

 .banner-page-pusher button.toggle-btn {
     position: absolute;
     top: 0;
	 cursor : pointer;
 }
 .banner-page-pusher button.toggle-btn.toggle-btn-left {
	 left: 0;
 }

</style>
 <!-- page pusher end -->

   <!-- ad page pusher start-->
	<div class="ad-wrapper">
		<div class="banner-page-pusher banner-ad-id-10">
			<button class="toggle-btn toggle-btn-left ad-toggle-id-10" type="button">Expand</button>
			<!-- <button class="toggle-btn toggle-btn-right ad-close-id-10" type="button">Close</button> -->

			<a class="ad-hyperlink" target="_blank" href="{clickurl}">
				<img class="banner-imgs ad-img-1-id-10" src="{image1}" alt="">
			</a>
			<a class="ad-hyperlink" target="_blank" href="{clickurl}">
				<img class="banner-imgs ad-img-2-id-10" style="display: none;" src="{image2}" alt="">
			</a>
		</div>

	</div>
	<!-- ad page pusher end-->
 
 <script>
 // page pusher start
    (function (id) {
        var adBanner = document.querySelector('.banner-ad-id-' + id);
        if (adBanner) {
            var expanded = false;
            var adbtn = adBanner.querySelector('.ad-toggle-id-' + id);
			//var closebtn = adBanner.querySelector('.ad-close-id-' + id);
            var img1 = adBanner.querySelector('img.ad-img-1-id-' + id);
            var img2 = adBanner.querySelector('img.ad-img-2-id-' + id);
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
            function toggleAd() {
                if (expanded) {
                    collpaseAdBanner();
                }
                else {
                    expandAdBanner();
                }
            }
			
			function expandAdBanner(){
				
				adBanner.style.height = '180px';
                    img1.style.display = 'none';
                    img2.style.display = 'initial';
                    expanded = true;
					adbtn.innerText = 'Close';
			}
			
			function collpaseAdBanner(){
					adBanner.style.height = '90px';
                    img1.style.display = 'initial';
                    img2.style.display = 'none';
                    expanded = false;
					adbtn.innerText = 'Expand';
			}
			
            var count_1 = 0;
            //autometically show ad after 2 seconds
            var timer_1 = setInterval(function () {
                if (count_1 >= 1) {
                    clearInterval(timer_1);
                }
                toggleAd();
                count_1++;
            }, 2000);
        }
    })('10');
    // page pusher end
</script>

