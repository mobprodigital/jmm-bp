<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dist/css/home.css">
<?php 
if(isset($_GET['pglmt'])){
$limt_value = $_GET['pglmt'];}else{$limt_value = "";} ?>
<div class="content-wrapper">
	<section class="content-header">
		<label> <input  class="form-control" style="width:295px;" placeholder="Search"></label><small class="btn btn-large btn-primary" style=" float:right;"><?php echo anchor('users/website','Add new website');?></small>
	</section>
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<img src="<?php echo base_url()?>assets/upimages/icon-websites-large.png" style="float:left"/><span>Websites</span>
						<a href="#" id="website-delete"><img src="<?php echo base_url()?>assets/img/1011.png" style="margin-left:54px;margin-right:10px;"/>Delete</a>
					</div>
					<div class="box-body">
					<!---------------------------- Filter Section Starts ---------------------------------------------------------------->
					<?php if(isset($webnew))
						{  $websiteName = $webnew; } else { $websiteName = '';}?>
						<form action="<?php echo base_url()?>users/websiteFilterByName" method="post" name="filter_form" id="filter_form" autocomplete="off">
							<div class="row ">
								<div class="col-md-2 form-group">
									Website Name :<input type="text" name="website_name" id="website_name" value="<?php echo $websiteName;?> ">
								</div>
								
								<div class="col-md-2 form-group">
									<input class="btn btn-sm btn-info" type="submit" value="Submit" name="submit" id="submit" style="margin-left: 637px;">
								</div>
							</div>
						</form>
					<!---------------------------- Filter Section Ends ---------------------------------------------------------------->



						<div>
							<table id="example" class="table table-bordered table-striped" >
								<thead>
									<tr class="header-row">
										<th	width="2%"><input type="checkbox" class="advertiser" id="main_0" value="adchk"></th>
										<th width="50%">Name</th>
										<th width="18%">Updated</th>
										<th width="31%" class="center-align">Links</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($affiliates as $key => $value){ ?>
									<tr style="background-color: <?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
										<td><input type="checkbox" class="advertiser" id="<?php echo $value->affiliateid;?>"></td>
										<td><img src="<?php echo base_url();?>/assets/upimages/icon-website.png">&nbsp;&nbsp;<a href="<?php echo base_url();?>users/website?affiliateid=<?php echo $value->affiliateid;?>"><?php echo $value->name;?></a></td>
										<td><?php echo $value->updated;?></td>

										<td>
											<a href="<?php echo base_url();?>users/zone?affiliateid=<?php echo $value->affiliateid;?>"><div  class="btn bg-maroon btn-xs">Add new zone</div></a>
											<a href="<?php echo base_url();?>users/viewzone?affiliateid=<?php echo $value->affiliateid;?>" style="padding: 0px 5px;"><div  class="btn bg-purple btn-xs">Zones</div></a>
											<a href="<?php echo base_url();?>users/viewtargetchannel?affiliateid=<?php echo $value->affiliateid;?>"><div  class="btn bg-green btn-xs">Targeting Channels</div></a>
										</td>
									</tr>                 
									<?php } ?>
								</tbody>
							</table>
							<div class="pagination-container">
							<?php echo $this->pagination->create_links(); ?>
							
							<select id="page_limit" onChange="pageLimits(this.value);" class="page-limit">
							<option value="10"<?php if($limt_value == '10'): ?> selected="selected"<?php endif; ?>>10</option>
							<option value="20"<?php if($limt_value == '20'): ?> selected="selected"<?php endif; ?>>20</option>
							<option value="30"<?php if($limt_value == '30'): ?> selected="selected"<?php endif; ?>>30</option>
							</select>
</div>
							 
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('admin_includes/footer');?>
<script type="text/javascript">
	function pageLimits(limit_value) {
		 window.location = '<?php echo base_url(); ?>users/viewwebsite?pglmt=' + limit_value;


};


</script>



      
 