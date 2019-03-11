<?php if(isset($banner[0]->bannerid) && $banner[0]->storagetype =='html'){ ?>
<button type="button" class="btn btn-primary" style="float:right;" id="10" data-toggle="modal" data-target="#myModal">
	More Banner
</button>
<?php } ?>
<div <?php if(isset($banner[0]->bannerid) && $banner[0]->storagetype =='html'){ ?>style="width:500px;height:400px;" <?php } ?>>

<?php if(isset($banner[0]->bannerid) && $banner[0]->storagetype =='html'){ ?>
			<!-- Modal -->
			<?php if($banner[0]->multiple_banner_existence =='yes'){?>
			<button type="button" class="btn btn-primary" style="float:right;margin-right:2%;" id="changebanner">
				Change Banner
			</button>
			<?php } ?>
			<!--<a href="<?php  echo base_url().'users/banner?type=newbanner&bannerid='.$banner[0]->bannerid.'&campaignid='.$banner[0]->campaignid.'&clientid='.$banner[0]->clientid;?>" class="btn btn-primary" style="float:right;margin-right:25%;">More Banner</a>-->
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
									  
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Enter Vast Tag</h4>
										<h4 class="modal-title" class="active_banner" style="display:none">Activate Banner</h4>
									  </div>
									  <div class="modal-body">
										<form method="post" action="" name="banner_replace" id="banner_replace">
											<textarea name="vastinput" id="vastinput" style="margin: 0px; width: 518px; height: 87px;"> </textarea>
											<div class="active_banner" style="display:none;"> 
												<input  type="radio" style="margin-left: 46px;" class="video-chk" name="activebanner" id="videobanner" value="<?php if(isset($videos[0]->banner_vast_element_id)&& $banner[0]->ext_bannertype == 'create_video'){echo $videos[0]->banner_vast_element_id;}else{if(isset($inactivevideoid)){echo $inactivevideoid;}}?>">
												<span >Video Ad Banner<span>
												<input type="radio" style="margin-left: 46px;" class="video-chk" name="activebanner"  id="vastbanner" value="<?php if(isset($videos[0]->banner_vast_element_id)&& $banner[0]->ext_bannertype == 'upload_video'){echo $videos[0]->banner_vast_element_id;}else{if(isset($inactivevideoid)){echo $inactivevideoid;}}?>">
												<span>Vast Input  Ad Banner<span>
											</div>
										</form>
										<input type="hidden" name="ext_bannerid" id="ext_bannerid" value="<?php  if(isset($_GET['bannerid'])){echo $_GET['bannerid'];}?>">
										<input type="hidden" name="vast_bannerid" id="vast_bannerid">
									</div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary" name="savebanner" id="savebanner">Save</button>
										<button type="button" class="btn btn-primary active_banner" style="display:none;" name="saveactivebanner" id="saveactivebanner">Save</button>
									  </div>
									</div>
								  </div>
								</div>
								
								<!-- player code with html5 as control-->
<script>


var unmuteSound			= "<?php if($videos[0]->mute == '1'){echo 'false';}else{echo 'true';}?>";
var source1				= "<?php if(isset($videos[0]->content_video) && $videos[0]->content_video !=0 && isset($source) && $source !=''){ echo $source; }?>";


var playingName			= 'ad';
var adDuration			= 1;
var counter 			= "<?php if($videos[0]->skip_time	!='0' ){ echo $videos[0]->skip_time;?><?php }else{echo '0';}?>";
var displaySkipBtn		= "<?php if($videos[0]->skip=='1' ){ echo 'true';?><?php }else{echo 'false';}?>";
var contentSource		= "<?php echo $deliveryPath;?>assets/content/swach bharat.mp4<?php //if($vidcontent1){echo base_url().'assets/videos/'.$vidcontent1;}?>";
var landingPageUrl		= "<?php if(isset($videoclickurl)){echo $videoclickurl;}else{echo 'http://www.mediaconversion.com';}?>";

</script>
		<script src="<?php echo $deliveryPath;?>assets/js/jquery.js"></script>
		<script src="<?php echo $deliveryPath;?>assets/js/mediaelement-and-player.min.js"></script>
		<link href="<?php echo $deliveryPath;?>assets/css/mediaelementplayer.min.css" rel="stylesheet"/>
		<style>
			#skipBtn { background-color: rgba(0, 0, 0, .5); bottom: 30%; color: #fff; cursor: pointer; height: 30px; line-height: 30px; position: absolute;right:0; text-align: center; width: 100px;font-family:verdana;margin-bottom:-80px;top:0;}
			#mask {position: absolute; width:100%;width: 100%;z-index: 9999999;}
		</style>
		<div style="width:100%;height:100%;position:relative;margin-top:10px;">
		<?php //echo $videos[0]->vast_video_outgoing_filename;die;?>
			<video controls autoplay loop muted playsinline width="100%" height="100%"  onclick="window.open(landingPageUrl)" src="
			<?php if($banner[0]->ext_bannertype == 'create_video'){ 
			if($videos[0]->vast_video_outgoing_filename != ""){
				echo $deliveryPath."banners/videos/".$videos[0]->vast_video_outgoing_filename;
			}else{
				echo 'no_ad';
			}
			}else{
				echo $videos[0]->vast_video_outgoing_filename;
			}?>" type="video/mp4" id="player1" controls preload="no">
			</video>
			
			<div id="skipBtn"></div>
			<div id="disableSlider"></div>
		</div>
		
		<script type='text/javascript'>
			$('#player1').mediaelementplayer({
				success: function(player, node) {
					$('#' + node.id + '-mode').html('mode: ' + player.pluginType);
				}
			});
			
			if(displaySkipBtn=="true"){
			   $('#skipBtn').css('display','block');
			}else{
			   $('#skipBtn').css('display','none');
			}

			new MediaElement('player1', {success: function (mediaElement, domObject) { 
				if(playingName=='ad'){
					$('.mejs-mediaelement').css('cursor','pointer');
					$('.mejs-button.mejs-playpause-button.mejs-play').find('button').attr('title','Pause').css('display','none');
					$('.mejs-time-rail').prepend('<div id=mask></div>');
				}
				if($('.mejs-controls').css('display')=='block'){
				}
				 
				mediaElement.addEventListener('ended', function(e) {
					mediaElement.setSrc(contentSource);
					mediaElement.play();
					playingName		='content';
					  
					if(playingName=='content'){
						$('.mejs-button.mejs-playpause-button.mejs-play').find('button').attr('title','Pause').css('display','block');
						$('#disableSlider').css('display', 'none');
					}
					document.getElementById('skipBtn').style.display = 'none';
				 
				}, false);
				
				
				mediaElement.addEventListener('loadeddata', function(e) {}, false);
				var link 	= document.getElementById('skipBtn');
				var host	= window.location.hostname;
				
				link.onclick = function () { mediaElement.setSrc(contentSource);
					$('.mejs-button.mejs-playpause-button.mejs-play').find('button').attr('title','Pause').css('display','block');
					$('#disableSlider').css('display', 'none');
					
					mediaElement.play();
					adDuration	=0;
					document.getElementById('skipBtn').style.display = 'none';
					playingName='content';
				};
				
				mediaElement.addEventListener('timeupdate', function(e) {
					if(playingName=='ad'){
						var durationBrake = Math.round(Math.round(mediaElement.duration)/4);
						var duration		= durationBrake;
						var event			= '';
					}
				  
				}, false);
				
				var interval = setInterval(function() {
					if(Math.round(mediaElement.currentTime)>0){
						if(counter!=0){
							counter--;
							document.getElementById('skipBtn').onclick = null;
						}
						
						if (counter == 0) {
							clearInterval(interval);
						}
					
					document.getElementById('skipBtn').innerHTML = 'Ad 00:0' + counter;
					if(counter==0){
						document.getElementById('skipBtn').innerHTML = 'Skip Ad';
						$('#skipBtn').click(function(){
							console.log(Math.round(mediaElement.currentTime)); 
							playingName='content';
							if(playingName=='content'){
								$('.mejs-button.mejs-playpause-button.mejs-play').find('button').attr('title','Pause').css('display','block');
								$('#disableSlider').css('display', 'none');
							}
							if(document.getElementById('skipBtn').innerHTML==='Skip Ad'){
								mediaElement.setSrc(contentSource);
								mediaElement.play();
								$(this).hide();
								$('.mejs-controls.mejs-offscreen').find('button').attr('title','Pause').css('display','block');
								document.getElementById('player1').onclick = null;
								$('#disableSlider').css('display', 'none');
							}
						});

					}
				}}, 1000);
				mediaElement.play();
			},
			error: function () { 
			 
		}
	});

</script>

<?php } ?>