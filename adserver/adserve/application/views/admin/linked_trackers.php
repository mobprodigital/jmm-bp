<style>
hr {
    margin-bottom: 9px;
}
</style>
<div class="content-wrapper">
    <section class="content-header">
		<h1>Add Compaign</h1>
    </section>
	<section class="content">
		<div class="row" >
			<div class="col-md-12">
				<div class="box box-default">
				<?php $this->load->view('admin_includes/campaign_header');?>

					<form method="post" name	= "addcampaign" id	= "addcampaign">
						<div class="box-body">
							<?php if(isset($msg)){?>
									<p id="msg2" style="color:green"><?php echo $msg;?></p>
							<?php }?>
							<h2 class="formfieldheading">Basic Information</h2>
							</br>
							<img width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" 	class="fieldlabel">View</label>
									<input type="text" 	name	= "hours" 	id	= "hours" 		class="smalltextbox" placeholder="-"/>&nbsp;&nbsp;Days
									<input type="text" 	name	= "mintues" id	= "mintues" 	class="smalltextbox" placeholder="-">&nbsp;&nbsp;Hours
									<input type="text" 	name	= "second" 	id	= "second" 		class="smalltextbox" placeholder="-"/>&nbsp;&nbsp;Mintues
									<input type="text" 	name	= "second" 	id	= "second" 		class="smalltextbox" placeholder="-"/>&nbsp;&nbsp;Seconds

								</div>
							</div>
							<div class="col-md-7">
								<div class="form-group">
									<label for="name" 	class="fieldlabel">Click</label>
									<input type="text" 	name	= "hours" 	id	= "hours" 		class="smalltextbox" placeholder="-"/>&nbsp;&nbsp;Days
									<input type="text" 	name	= "mintues" id	= "mintues" 	class="smalltextbox" placeholder="-">&nbsp;&nbsp;Hours
									<input type="text" 	name	= "second" 	id	= "second" 		class="smalltextbox" placeholder="-"/>&nbsp;&nbsp;Mintues
									<input type="text" 	name	= "second" 	id	= "second" 		class="smalltextbox" placeholder="-"/>&nbsp;&nbsp;Seconds

								</div>
							</div>
							<h2 class="formfieldheading">Linked Trackers</h2>
							</br>
							<img width="100%" style="height:1px;" src="<?php echo base_url()?>/assets/upimages/break.gif">
							
							
							<table id="example" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="25%">Name</th>
										<th width="60%">ID</th>
										<th width="15%">Default Status</th>
									</tr>
								</thead>
								<tbody>
									<?php if(isset($zones)){?>
									<?php foreach($zones as $key => $value){?>
									<tr>
										<td><?php echo $value->zonename;?></td>
										<td><?php echo $value->width."*".$value->width;?></td>
										<td><?php echo $value->description;?></td>

										<td>
											<a href="<?php echo base_url();?>users/zone_include"><div  		class="btn bg-maroon btn-xs">Linked Banners</div></a>
											<a href="<?php echo base_url();?>users/zone_probability" 		style="padding: 0px 30px;"><div  class="btn bg-purple btn-xs">Probability</div></a>
											<a href="<?php echo base_url();?>users/zone_invocation"><div  	class="btn bg-green btn-xs">Invocation Code</div></a>
										</td>
										<td><input type="checkbox" class="advertiser" id="main_0" value="adchk"></td>

									</tr>                 
									<?php } ?>
								</tbody>
									<?php }else{ ?>
									<tr>
										<th></th>
										<th>There are currently no trackers available which can be linked to this campaign</th>
										<th></th>
									
									</tr>
									<?php } ?>
							</table>
							
							<div class="box-footer">
								<input type="submit" class="btn btn-primary" name="submit" id="submit" value="submit">
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>

<?php $this->load->view('admin_includes/footer');?>
 <!-- Page script -->
    <script type="text/javascript">
      $(function () {
        $('#activate_time').datepicker();
		$('#expire_time').datepicker();
	});
    </script>







