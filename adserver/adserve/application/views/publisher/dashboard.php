<?php $this->load->view('publisher/header');?>
<?php $this->load->view('publisher/leftsidebar');?>
<div class="content-wrapper" style="min-height: 368px;">
	<section class="content-header">
		<label><input name="clients" id="clients" class="search form-control" style="width:295px;" placeholder="Search" value=""></label>
		<input type="submit" class="btn btn-primary" name="submit" id="submit" value="search">
		<div class="dropdown-content">
		</div>
		<small class="btn btn-large btn-primary" style=" float:right;"><a href="http://localhost/adserver/adserve/admin/users/advertisement">Add new advertiser</a></small>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<img src="http://localhost/adserver/adserve/assets/upimages/icon-websites-large.png" style="float:left"><span>Websites</span>
						<a href="#" id="delete-advertiser"><img src="http://localhost/adserver/adserve/assets/img/1011.png" style="margin-left:54px;margin-right:10px;">Delete</a>
					</div>
					<div class="box-body">
						<div>
							<?php if(isset($affiliates) && !empty($affiliates)){ ?>
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr class="header-row">
										<th width="2%"><input type="checkbox" class="advertiser" id="main_0" value="adchk"></th>
										<th width="50%">Name</th>
										<th width="18%">Updated</th>
										<th width="13%" class="center-align">Links</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($affiliates as $key => $value){ ?>
									<tr style="background-color: <?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
										<td><input type="checkbox" class="advertiser" id="<?php echo $value->affiliateid;?>"></td>
										<td><img src="<?php echo base_url();?>/assets/upimages/icon-website.png">&nbsp;&nbsp;<a href="<?php echo base_url();?>users/website?affiliateid=<?php echo $value->affiliateid;?>"><?php echo $value->name;?></a></td>
										<td>
										
									<?php echo date("d M Y",strtotime($value->updated));?>

										
										</td>

										<td>
											<a href="<?php echo base_url();?>publisher/zone?affiliateid=<?php echo $value->affiliateid;?>"><div  class="btn bg-maroon btn-xs">Add new zone</div></a>
											<a href="<?php echo base_url();?>publisher/viewzone?affiliateid=<?php echo $value->affiliateid;?>" style="padding: 0px 5px;"><div  class="btn bg-purple btn-xs">Zones</div></a>
										</td>
									</tr>
							<?php } ?>
									                 
								</tbody>
							</table>
							<?php }else{ ?>
								<div class="errormessage" style="margin-top: 2em"><img class="errormessage" src="<?php echo base_url();?>assets/upimages/info.gif" width="16" height="16" border="0" align="absmiddle">There are currently no site available</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	
</div>
<?php $this->load->view('admin_includes/footer');?>

		



			