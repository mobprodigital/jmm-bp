<div class="content-wrapper">
	<section class="content-header">
		<label> <input  class="form-control" style="width:295px;" placeholder="Search"></label><small class="btn btn-large btn-primary" style=" float:right;"><?php echo anchor('users/zone','Add new zones');?></small>
	</section>
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header"><img src="<?php echo base_url()?>assets/upimages/icon-zones-large.png"/><span>Zones</span>
						<a href="#" id="zone-delete"><img src="<?php echo base_url()?>assets/img/1011.png" style="margin-left:54px;margin-right: 10px;"/>Delete</a>
					</div>
					<div class="box-body">
					<!---------------------------- Filter Section Starts ---------------------------------------------------------------->
					<?php if(isset($zonenew))
					{  $zoneName = $zonenew; } else { $zoneName = '';}?>
						<form action="<?php echo base_url()?>users/zoneFilterByName" method="post" name="filter_form" id="filter_form" autocomplete="off">
						
						
						<div class="text-right">
                                <label><input name="zone_name" id="zone_name" class="search form-control"
                                        style="width:295px;" placeholder="Search Zone"
                                        value="<?php echo $zoneName;?>"></label>
                                <input type="submit" class="btn btn-success" name="submit" id="submit" value="search">
                            </div>
						
							
						</form>
					<!---------------------------- Filter Section Ends ---------------------------------------------------------------->




						<div>
						<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr class="header-row">
										<th	width="2%"><input type="checkbox" class="advertiser" id="main_0" value="adchk"></th>
										<th width="20%">Name</th>
										<th width="20%">Size</th>
										<th width="20%" >Description</th>
										<th width="36%" class="center-align">Links</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($zones as $key => $value){ ?>
									<tr style="background-color: <?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
										<td><input type="checkbox" class="advertiser" id="<?php echo $value->zoneid;?>"></td>
										<td>
										<img src="<?php echo base_url();?>/assets/upimages/
										<?php 
										if($value->delivery=='html'){
											echo 'icon-banner-html.png';
										}else if($value->delivery=='html5'){
											echo 'html5.png';
										}else{
											?>icon-banner.png<?php } ?>">
										&nbsp;&nbsp;<a href="<?php echo base_url();?>users/zone?affiliateid=<?php echo $value->affiliateid;?>&zoneid=<?php echo $value->zoneid;?>"><?php echo $value->zonename;?></td>
										<td><?php echo $value->width."*".$value->height;?></td>
										<td><?php $desc = $value->description;if(strlen($desc)>40){$sub = substr($desc, 0, 40); $lastSpace=strrpos($sub,' ');echo substr($sub,0,$lastSpace-1);echo ' ...';}else{echo $desc;}?></td>
										<td style="text-align:right;">
											<a href="<?php echo base_url();?>users/zone_include?affiliateid=<?php echo $value->affiliateid;?>&zoneid=<?php echo $value->zoneid;?>"><div  class="btn bg-maroon btn-xs">Linked Banners</div></a>
											<a href="<?php echo base_url();?>users/zone_probability?affiliateid=<?php echo $value->affiliateid;?>&zoneid=<?php echo $value->zoneid;?>" style="padding: 0px 30px;"><div  class="btn bg-purple btn-xs">Probability</div></a>
											<a href="<?php echo base_url();?>users/zone_invocation?affiliateid=<?php echo $value->affiliateid;?>&zoneid=<?php echo $value->zoneid;?>"><div  class="btn bg-green btn-xs">Invocation Code</div></a>
										</td>
									</tr>                 
									<?php } ?>
								</tbody>
							</table>
							<!--<script src="<?php echo base_url();?>assets/common/angular.min.js"></script>
								<script src="<?php echo base_url();?>assets/common/user-app.js"></script>
							-->
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('admin_includes/footer');?>




      
 