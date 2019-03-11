<div class="content-wrapper">
	<section class="content-header">
		<label><input  name="campaigns"  id="campaigns" class="search form-control" style="width:295px;" placeholder="Search" value="<?php if(isset($searchInput)){echo $searchInput;}?>"></label>
		<input type="submit" class="btn btn-primary" name="submit" id="submit" value="search" >
		<div class="dropdown-content">
		</div>
		</label><small class="btn btn-large btn-primary" style=" float:right;"><?php echo anchor('users/compaign','Add new campaign');?></small>
	</section>
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-default">
					<?php if(isset($_GET['campaignid'])){ ?>
				<?php $this->load->view('admin_includes/campaign_header');?>
				<?php } ?>
					<form method="post" name = "addbanner" id = "addbanner">
						<div class="box-body">
							<?php if(isset($msg)){ ?>
							<p id="msg2" style="color:green"><?php echo $msg;?></p>
							<?php }?>
									<div class="col-md-6">
										<div class="form-group">
											<label for="targeting"></label>
											<select  name="targeting" id="targeting" class="form-control location-select">
												<?php if(isset($type)){ ?>
												<option value="<?php echo $type;?>"><?php echo ucfirst($type);?></option>
												<?php } ?>
												<option value="">Select Targeting Type</option>
												<option value="location">Location</option>
												<option value="browser">Browser</option>
												<option value="devices">Device category</option>
												<option value="os">Operating system</option>
											</select>&nbsp;
										</div>
									</div>
									<!--  Lets display all countries in an drop down list-->
									<div class="">
									<div class="col-md-6">
										<div class="form-group">
											<label for="country"></label>
											<select class="location-select form-control" name="country" id="country" onchange="ajax_call('ajaxCall',{location_id:this.value,location_type:1}, 'state')">
											<?php if(isset($country)){ ?>
												<option value="<?php echo $country[0]->location_id;?>"><?php echo ucfirst($country[0]->name);?></option>
											<?php } ?>
											<option value="">Select Country</option>
											<?php foreach ($objAllCountries AS $CountryDetails) {echo '<option value="' . $CountryDetails->location_id . '">' . $CountryDetails->name . '</option>';}?>
										</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<select class="location-select form-control" name="state" id="state" onchange="ajax_call('ajaxCall',{location_id:this.value,location_type:2}, 'city')">
											<?php if(isset($state)){ ?>
												<option value="<?php echo $state[0]->location_id;?>"><?php echo ucfirst($state[0]->name);?></option>
											<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<select class="location-select form-control" name="city" id="city">
											<?php if(isset($city)){ ?>
												<option value="<?php echo $city[0]->location_id;?>"><?php echo ucfirst($city[0]->name);?></option>
											<?php } ?>
											</select>
										</div>
									</div>
									
								</div>

							</div>
								<div class="box-footer">
							<input type="submit" class="btn btn-primary" name="submit" id="submit" value="submit">
						</div>
						</div>
					</div>
				</section>
			</div>
			<?php $this->load->view('admin_includes/footer');?>

<script type="text/javascript">
            
            
            /* *
             *     fileName - ajax file name to be called by ajax method.
             *     data - pass the infromation(like location-id , location-type) via data variable.
             *     loadDataToDiv - id of the div to which the ajax responce is to be loaded.
             * */
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

				 <style>
				 .col-md-6{width:51%;}
            .location{
             /*    background: none repeat scroll 0 0 #CCCCCC;
                border: 1px solid #5E822E;
                margin: 10% 0px 0px;
                padding: 25px 26px;
                width: 310px; */
            }
            .location-select {
                border: 1px double #008080;
                color: #008080;
                font-family: Georgia;
                font-weight: bolder;
               /*  height: 39px;
                padding: 7px 8px;
				width:258px; */ 
            }
        </style>