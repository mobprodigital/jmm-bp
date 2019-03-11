
    
    <!--banner html-->
    	<section id="banner" class="blog-page column">
        	<?php if($subs['value']!=''){ $path=base_url().'uploads/banners/'.$subs['value'];} else { $path=base_url().'assets/front/images/inner-banner.jpg';}?>
        	<section class="inner-banner" style="background-image: url('<?php echo $path;?>');">
            	<div class="wrapper">
            		<h4 class="text-center"><?php echo $title['value'];?></h4>
                </div>
            </section>
        </section>
    
    <!--banner html end-->
    
    <!--container html-->
    	<section id="container" class="column">
        	<div class="wrapper">
            	
                <div class="vision column">
                	<h4 class="text-center">Page Not Found</h4>
                    <?php //echo stripslashes($ocontent['value']);?>
                    Oops!  This page content is not found in our database.
                    
                    <script src="js/waypoint.js"></script>
					<script src="js/jquery.counterup.js"></script>
                    <script>
						jQuery(document).ready(function( $ ) {
							$('.counter').counterUp({
								delay: 10,
								time: 1000
							});
						});
					</script>
                </div>
            </div>
            
        </section>    
       
    
   