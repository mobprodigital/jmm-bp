<style>
hr {margin-bottom: 9px;}

.listtable{width:100%;}
.btn{padding:0px 12px;}
form{margin-top: 20px;}
table td,th{font-size:12px;}
table td:not(:last-child) { padding: 0 10px 0 0; }
</style>
<div class="content-wrapper">
    <section class="content-header">
	<div class="hasIcon iconTargetingChannelsLarge" style="margin-bottom:20px;">
			<div id="thirdLevelHeader" class="hasTabs">
				<?php if(!empty($bannerData)){ ?>
				<div class=" hasIcon iconTargetingChannelsLarge">
					<h3>
						<img src="<?php echo base_url()?>assets/upimages/icon-banner-large.png">
						<span>Banner : <?php echo $bannerData->description;?></span>            
					</h3>
						<img src="<?php echo base_url()?>assets/upimages/icon-advertiser.png">
							 Advertiser : <?php echo $bannerData->clientname;?> &nbsp;&nbsp;&nbsp; &gt; &nbsp;&nbsp;
						<img src="<?php echo base_url()?>assets/upimages/icon-campaign.png">
							 Campaign : <?php echo $bannerData->campaignname;?>	
				</div>
				<?php } ?>
	  
				<div class="corner left"></div>
				<div class="corner right"></div>
			</div>
			</div>
	</section>
	<section class="content">
		<div class="row" >
			<div class="col-md-12"> 
				<div class="box box-default">
				<?php $this->load->view("admin_includes/banner_header");?>
				<?php echo $aclselect;?>
				</div>
			</div>
		</div>	
	</section>
</div>
















<?php $this->load->view('admin_includes/footer');?>
<script src="<?php echo base_url();?>assets/js/limitation.js" type="text/javascript"></script>



<script>
<?php if(isset($aclplugins[0]->acl_plugins)){ ?>
var aclplugins				= "<?php echo $aclplugins[0]->acl_plugins;?>";

<?php }else{ ?>
	var aclplugins			= '';
<?php } ?>

$("#codetype").change(function(){
		var codetype	= $(this).val();
		window.location.href="invocation?bannerid=<?php echo $_GET['bannerid'];?>&campaignid=<?php echo $_GET['campaignid'];?>&clientid=<?php echo $_GET['clientid'];?>&codetype="+codetype;});
</script>

<script type="text/javascript">
            
            function ajax_call(fileName,data, loadDataToDiv) {
                jQuery("#"+loadDataToDiv).html('<option selected="selected">-- -- -- Loding Data -- -- --</option>');

                //  If you are changing counrty, make the state and city fields blank
                if(loadDataToDiv=='state'){
                    jQuery('#city').html('');
                    jQuery('#state').html('');
					home_url = "<?php echo base_url();?>users/getstate";
                    
                }
                //  If you are changing state, make the city fields blank
                if(loadDataToDiv=='city'){
                    jQuery('#city').html('');
					home_url = "<?php echo base_url();?>users/getcity";

                }
                
				jQuery.post(home_url, data, function(result) {
                    jQuery('#' + loadDataToDiv).html(result);
                });
            }
        </script>




<script type='text/javascript'>
       $(function () {
		$('#activate_time').datepicker({
			format: 'dd-mm-yyyy',
			autoclose:true
		});
	});

        //-->
        </script>


