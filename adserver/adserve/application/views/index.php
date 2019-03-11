<?php
 $CIs = & get_instance();
$settingstitle = $CIs->db->query("SELECT * FROM settings WHERE id=1")->row();   
?>
    <!--banner html-->
    	<section id="banner" class="column">
        	<div id="owl-demo" class="owl-carousel">
            <?php
					
					foreach ($homebanner->result() as $rows)  
         			{  
					?>
              <div class="item"><img src="<?php echo base_url();?>uploads/banners/<?php echo $rows->photo;?>" alt="Owl Image">
             <?php if($rows->title!='' || $rows->content!=''){?>
              	<div class="img-content">
              		<div class="heading column">
                    <?php if($rows->title!=''){?>
                    	<h3><?php echo $rows->title;?></h3>
                        <?php }?>
                        <?php if($rows->content!=''){?>
                        <div class="policy column">
                        	<!--<h4>Now, buy the best policy for you,<br />in 2 minutes</h4>
                            <h5>Insurance Type</h5>-->
                            <?php echo $rows->content;?>
                             
                            <form method="POST" action="<?php echo base_url();?>redirected" name="contactform" id="contactform">
                            <div class="select-style ch">
                              <select name="catname">
                              <?php
								foreach ($services->result() as $row)  
         						{  
								?>
                                <option value="<?php echo $row->slug;?>"><?php echo $row->cat_name;?></option>
                                <?php
								}
								?>
                              </select>
                            </div>
                            <input type="submit" name="submit" value="Obtenha a sua cotação" class="policybutton" />
                            <!--<a href="#">Get Quote and Buy</a>-->
                            </form>
                        
                        </div>
                        <?php }?>
                    </div>
                 </div>  
                 <?php }?> 
              </div>
              <?php
					}
					?>
            </div>
        </section>
    <?php echo link_tag('assets/front/css/owl.carousel.css');?>
    <?php echo link_tag('assets/front/css/owl.theme.css');?>
    <script src="<?php echo base_url();?>assets/front/js/owl.carousel.js"></script>
    <!-- Demo -->

    <style>
    #owl-demo .item{
        margin: 3px 0;
    }
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }
	 #owl-demo2 .item img{display: inline-block;height: auto;text-align: center;width: auto;}
	 #owl-demo2 .item {display: inline-block;margin: 3px;text-align: center;width: 100%;}
    </style>
    <script>
    $(document).ready(function() {
		var carousel = $("#owl-demo");
      $("#owl-demo").owlCarousel({
        autoPlay: false,
        items : 1,
        itemsDesktop : [1199,1],
        itemsDesktopSmall : [979,1],
		pagination : true,
		navigation : false,
      });
    });
    </script>
    <!--banner html end-->
    
    <!--container html-->
    	<section id="container" class="column">
        <?php if(count($services->result())>0){?>
        	<section id="service-part" data-speed="6" data-type="background">
        		<div class="wrapper">
            	<div class="service">
                	<h4 class="underline"><?php echo $settingstitle->h1title;?></h4>
                	<ul>
                    <?php
					foreach ($services->result() as $row)  
         			{  
					?>
                    	<li>
                        	<div class="img">
                            	 <a href="<?php echo base_url();?>products/<?php echo $row->slug;?>">
                                    <span>
                                        <figure>
                                            <img src="<?php echo base_url();?>uploads/<?php echo $row->photo;?>" alt="service" width="65" height="73" />
                                        </figure>
                                    </span>
                                	<small><?php echo $row->cat_name;?></small>
                                </a>
                            </div>
                        </li>
                    <?php
					}
					?>
                        
                    </ul>
                </div>
            </div>
            </section>
            <?php }?>
            <section class="ins column" data-speed="4" data-type="background">
            	<div class="parallex"></div>
                	<div class="content-area">
            			<div class="wrapper">
                	<div class="inner-ins">
                    	<h3><?php echo $settingstitle->h2title;?></h3>
                        <ul>
                        <?php
					
					foreach ($whytrevo->result() as $rows)  
         			{  
					?>
                        	<li>
                            	<div class="all">
                                  
                                    <div class="ins-detail">
                                    <img src="<?php echo base_url();?>uploads/<?php echo $rows->photo;?>" alt="<?php echo $rows->title;?>" />
                                    	<div class="ins-img">
                                        <h2><?php echo $rows->title;?></h2>
                                        <p><?php echo $rows->content;?></p>
                                    </div>    
                                    </div>
                                </div>
                            </li>
                            
                         <?php
					}
					?>
                      </ul>
                    </div>
                </div>
                	</div>
            </section>
            <div class="customer column">
            	<div class="wrapper">
                	<h4 class="underline none"><?php echo $settingstitle->h3title;?></h4>
                    <div class="testimonial">
                    	
                        
                        <ul id="og-grid" class="og-grid">
                             <?php
					
					foreach ($customersay->result() as $rows)  
         			{  
					?>
                            <li>
                                <a href="#" data-largesrc="<?php echo base_url();?>uploads/testi/<?php echo $rows->photo;?>" data-title="<?php echo $rows->title;?>" data-description="<?php echo $rows->content;?>">
                                    <img src="<?php echo base_url();?>uploads/testi/<?php echo $rows->photo;?>" width="135" height="131" alt="<?php echo $rows->slug;?>">
                                </a>
                            </li>
                    <?php
					}
					?>
						</ul>
                    </div>
                </div>
            </div>
            <div class="clients column">
            	<div class="wrapper">
                <h4 class="underline none"><?php echo $settingstitle->h4title;?></h4>
                	<div id="owl-demo2" class="owl-carousel">
                    <?php
					
					foreach ($clients->result() as $rows)  
         			{  
					if($rows->link!=''){
					?>
                    <a href="<?php echo $rows->link;?>" target="_blank"><div class="item"><img src="<?php echo base_url();?>uploads/clients/<?php echo $rows->icon;?>" alt="" /></div></a>
                    <?php } else{?>
                    <div class="item"><img src="<?php echo base_url();?>uploads/clients/<?php echo $rows->icon;?>" alt="" /></div>
                    <?php
					}
					}
					?>
                      <!--<div class="item"><img src="<?php echo base_url();?>assets/front/images/ancap.png" alt="" /></div>
                      <div class="item"><img src="<?php echo base_url();?>assets/front/images/state-farm.jpg" alt="" /></div>
                      <div class="item"><img src="<?php echo base_url();?>assets/front/images/co-operator.jpg" alt="" /></div>
                      <div class="item"><img src="<?php echo base_url();?>assets/front/images/polaroid.jpg" alt="" /></div>
                      <div class="item"><img src="<?php echo base_url();?>assets/front/images/ancap.png" alt="" /></div>-->
                    </div>
                </div>
            </div>
        </section>
        <script>
		$(document).ready(function() {
			var carousel = $("#owl-demo");
		  $("#owl-demo2").owlCarousel({
			autoPlay: false,
			items : 4,
			itemsDesktop : [1199,4],
			itemsDesktopSmall : [979,4],
			itemsTablet : [768, 3],
			pagination : false,
			navigation : true,
			itemsMobile : [479, 2],
		  });
		});
    </script>
    <?php echo link_tag("assets/front/css/component.css");?>
    <script src="<?php echo base_url();?>assets/front/js/grid.js"></script>
		<script>
			$(function() {
				Grid.init();
			});
		</script>
    <!--container html end-->
    
    
