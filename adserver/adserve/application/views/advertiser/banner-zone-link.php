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
	
	</section>
	<section class="content">
		<div class="row" >
			<div class="col-md-12"> 
				<div class="box box-default">
				<?php $this->load->view("advertiser/banner_header");?>
				<div class="bannercode">
				<?php if(isset($bannerDetails) && !empty($bannerDetails)){ ?></p>
					<p>Banner Name : <?php echo $bannerDetails->description;?></p>
					<p>Banner Type : <?php if($bannerDetails->storagetype == 'html'){echo 'Video Ad Type';}?></p>
					<p>Banner Size : <?php echo $bannerDetails->width;?> * <?php echo $bannerDetails->height;?></p>
				<?php } ?>
					
				</div>
				<?php if(!empty($zoneAffiliate)){ ?>
				<input type="checkbox" id="selectAllField" onclick='toggleAllZones("2|5|");'>
				<label for="selectAllField">Select / Unselect All</label>
					<table border="0" width="100%" cellpadding="0" cellspacing="0">
						<form name="zones" action="<?php echo base_url();?>advertiser/linked_zone" method="post">
						<input type="hidden" name="clientid" value="<?php if(isset($_GET['clientid'])){echo $_GET['clientid'];} ?>">
						<input type="hidden" name="campaignid" value="<?php if(isset($_GET['campaignid'])){echo $_GET['campaignid'];} ?>">
						<input type="hidden" name="bannerid" value="<?php if(isset($_GET['bannerid'])){echo $_GET['bannerid'];} ?>">
						<input type="hidden" name="token" value="fb806ee9a733b29934c9d47f502ccede">
							<tbody>
							<tr height="1">
								<td><img src="<?php echo base_url();?>assets/upimages/spacer.gif" width="300" height="1" border="0" alt="" title=""></td>
								<td><img src="<?php echo base_url();?>assets/upimages/spacer.gif" width="80" height="1" border="0" alt="" title=""></td>
								<td width="100%"><img src="<?php echo base_url();?>assets/upimages/spacer.gif" width="80" height="1" border="0" alt="" title=""></td>
							</tr>
							<tr height="25">
								<td><b><a href="#">Name</a><a href="#"><img src="<?php echo base_url();?>assets/upimages/caret-u.gif" border="0" alt="" title=""></a></b></td>
								<td><b><a href="#">ID</a></b></td>
								<td><b><a href="#">Description</a></b></td>
							</tr>
						<?php foreach($zoneAffiliate as $key=>$value){$checked = ''; ?>
						<tr height="50" bgcolor="#F6F6F6">
							<td>
								<table>
									<tbody><tr>
										<td>&nbsp;</td>
										<!--<td valign="top"><input id="affiliate<?php echo $value->affiliateid;?>" name="affiliate[<?php echo $value->affiliateid;?>]" type="checkbox" value="t"  onclick="toggleZones(<?php echo $value->affiliateid;?>);" tabindex="1">&nbsp;&nbsp;</td>
										--><td valign="top"><img src="<?php echo base_url();?>assets/upimages/icon-affiliate.gif" align="absmiddle">&nbsp;</td>
										<td><a href="#"><?php echo $value->name;?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									</tr>
								</tbody></table>
							</td>
							<td><?php echo $value->affiliateid;?></td>
							<td height="25"><?php echo $value->affiliatedescription;?></td>
						</tr>
						<tr height="50" bgcolor="#ddd">
							<td>
								<table>
									<tbody>
									<tr>
										<td width="28">&nbsp;</td>
										<?php if(isset($linkedZones) && !empty($linkedZones)){ ?>
										<?php foreach($linkedZones as $linkedZoneKey => $linkedZone){ 
										
										if($linkedZone->zone_id == $value->zoneid){
											$checked = 'checked';
											break;
										}
										}
										
										?>

										
										<?php } ?>
										
										<td valign="top"><input name="includezone[<?php echo $value->zoneid;?>]" <?php echo $checked;?> id="a<?php echo $value->affiliateid;?>" type="checkbox" value="t"  onclick="toggleAffiliate(<?php echo $value->affiliateid;?>);" tabindex="2">&nbsp;&nbsp;</td>
										
										
										<td valign="top"><img src="<?php echo base_url();?>assets/upimages/icon-zone.gif" align="absmiddle">&nbsp;</td>
										<td><a href="#"><?php echo $value->zonename;?></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									</tr>
								</tbody></table>
							</td>
							<td><?php echo $value->zoneid;?></td>
							<td><?php echo $value->zonedescription;?></td>
						</tr>
						<tr height="1">
							<td colspan="3" bgcolor="#888888">
							</td>
						</tr>
						<?php } ?>
						
					
						
					</tbody>
				</table>
				<div class="box-footer">
					<input class="btn btn-primary" name="submit" id="submit" value="Save Changes" type="submit">
				</div>
				</form>
				<?php }else{ ?>
				<div class="errormessage" style="margin-top: 2em"><img class="errormessage" src="<?php echo base_url();?>assets/upimages/info.gif" width="16" height="16" border="0" align="absmiddle">No Sites with given with this ad unit exists</div>

				<?php } ?>
				
				</div>
			</div>
		</div>	
	</section>
</div>
<?php $this->load->view('admin_includes/footer');?>

 <script language='Javascript'>
    <!--
        affiliates = new Array();
    
        function toggleAffiliate(affiliateid)
        {
            var count = 0;
            var affiliate;

            for (var i=0; i<document.zones.elements.length; i++)
            {
                if (document.zones.elements[i].name == 'affiliate[' + affiliateid + ']')
                    affiliate = i;

                if (document.zones.elements[i].id == 'a' + affiliateid + '' &&
                    document.zones.elements[i].checked)
                    count++;
            }

            document.zones.elements[affiliate].checked = (count == affiliates[affiliateid]);
        }

        function toggleZones(affiliateid)
        {
            var checked

            for (var i=0; i<document.zones.elements.length; i++)
            {
                if (document.zones.elements[i].name == 'affiliate[' + affiliateid + ']')
                    checked = document.zones.elements[i].checked;

                if (document.zones.elements[i].id == 'a' + affiliateid + '')
                    document.zones.elements[i].checked = checked;
            }
        }

        function toggleAllZones(zonesList)
        {
            var zonesArray, checked, selectAllField;

            selectAllField = document.getElementById('selectAllField');

            zonesArray = zonesList.split('|');

            for (var i=0; i<document.zones.elements.length; i++) {

                if (selectAllField.checked == true) {
                    document.zones.elements[i].checked = true;
                } else {
                    document.zones.elements[i].checked = false;
                }
            }
        }

    //-->
    </script>











