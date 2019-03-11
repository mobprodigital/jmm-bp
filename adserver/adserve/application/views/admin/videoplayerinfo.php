<div class="content-wrapper">
	<section class="content-header">
		<label> <input  class="form-control" style="width:295px;" placeholder="Search"></label><small class="btn btn-large btn-primary" style=" float:right;"><?php echo anchor('users/uploadvideo','Upload Video');?></small>
	</section>
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
					<img width="40px" height="40px" src="<?php echo base_url()?>assets/upimages/Video-Icon.jpg"/><span>Videos</span>
						<a href="#" id="delete-advertiser"><img class="delete-text" src="<?php echo base_url()?>assets/img/1011.png"/>Delete</a>
					</div>
					<!--<select  name="revenue_type" id="revenue_type"  class="search-box"/>
						<option>All banners</option>		
						<option>Active banners</option>
					</select>
					-->
					<div class="box-body">
						<div>
					
						
							<table id="example" class="table table-bordered table-striped" >
								<thead>
									<tr class="header-row" class="center-align">
										<th width="2%"><input type="checkbox" class="advertiser" id="main_0" value="adchk"></th>
										<th width="60%">Title</th>
										<th width="35%" class="center-align">Details</th>
									</tr>
								</thead>
								<tbody>
									<?php if(isset($videos)){ ?>
									<?php foreach($videos as $key => $value){ ?>
									<tr style="background-color: <?php if($key % 2 == 0){echo '#f1f1f1';}else{echo '#ffffff';}?>">
										<td><input type="checkbox" class="advertiser" id="<?php echo $value->id;?>"></td>
										<td><img width="30px" height="30px" src="<?php echo base_url();?>/assets/upimages/Video-Icon.jpg">&nbsp;&nbsp;<a href="<?php echo base_url();?>users/uploadvideo?videoid=<?php echo $value->id;?>"><?php echo $value->title;?></td>
										<td style="text-align:right;" >
											<a style="display:<?php if($value->status == '1'){ echo 'inline';}else{echo 'none';}?>" href="javascript:void(0);" class="select-video" id="active_<?php echo $value->id;?>"><div class="btn bg-green btn-xs vidclass" id="19_1">Inactive</div></a>&nbsp;&nbsp;
											<a style="display:<?php if($value->status == '0'){ echo 'inline';}else{echo 'none';}?>" href="javascript:void(0);" class="select-video" id="inactive_<?php echo $value->id;?>"><div class="btn bg-maroon btn-xs vidclass" id="19_1">Active</div></a>&nbsp;&nbsp;
											<a href="<?php echo base_url();?>users/getplayerdata?videoid=<?php echo $value->id;?>"><div class="btn bg-blue btn-xs">Preview</div></a>

											<!-- Button trigger modal -->
											&nbsp;&nbsp;&nbsp;<button type="button" class="btn bg-blue btn-xs addcontent" id="<?php echo $value->id;?>" data-toggle="modal" data-target="#myModal">
											  Add Sites
											</button>
											<!--&nbsp;&nbsp;&nbsp;<button type="button" class="btn bg-blue btn-xs addcontent" id="<?php echo $value->id;?>" data-toggle="modal" data-target="#myModal">
											  View Sites
											</button>
											-->
										
										
										</td>
									</tr>                 
									<?php } ?>
									
									<?php }else{ ?>
									<tr  class="center-align">
										<td width="2%"></td>
										<td width="60%"><b>No Video Exist</b></td>
										<td width="10%" class="center-align"></td>
										<td width="25%" class="center-align"></td>
									</tr>
									<?php } ?>
								</tbody>
							</table>
								

								<!-- Modal -->
								<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title" id="myModalLabel">Website List</h4>
									  </div>
									  <div class="modal-body">
										<form method="post" action="" name="addsites" id="addsites">
											<?php if(!empty($sitelist)){ ?>
											<?php foreach($sitelist as $key => $value){ ?>
												<input type="checkbox" class="ids" value="<?php echo $value->affiliateid;?>" name="placementlist[]" id="<?php echo $value->affiliateid;?>">&nbsp;&nbsp;&nbsp;<?php echo $value->name;?></br>
												
											<?php }} ?>
											
											<input type="hidden" name="savecontentid" id="savecontentid">
										</form>
									  </div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										<button type="button" class="btn btn-primary" name="savelinkedsites" id="savelinkedsites">Save</button>
									  </div>
									</div>
								  </div>
								</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('admin_includes/footer');?>
<style>
.vidclass{width: 62px;}

</style>


      
 