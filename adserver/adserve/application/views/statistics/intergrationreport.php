<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<?php $this->load->view('admin_includes/report_header');?>
							<a  style="float:right;padding-bottom: 10px;" href="<?php echo base_url().'users/adcampstats';if(isset($_GET['bannerid'])){echo '?bannerid='.$_GET['bannerid'].'&export=true';}?>">
								<img border="0" alt="" src="<?php echo base_url();?>assets/upimages/excel.gif"> <u>E</u>xport Statistics to Excel
							</a>
							
							
							
							
							<table id="example" style="margin-top:10px;" class="table table-striped" >
								<thead class="header-row">
									<tr>
										<th width="52%">Days</th>
										<th width="12%" style="text-align:center;">Requests</th>
										<th width="12%" style="text-align:center;">Conversion</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach($reportData as $key => $values){ //echo '<pre>';print_r($values);die;?>
									<tr style="background-color: <?php if($key % 2 == 0){echo '#ffffff';}else{echo '#e6e6e6';}?>">
										<td><img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-date.gif">&nbsp;&nbsp;&nbsp;&nbsp;
											<?php 
										$date = DateTime::createFromFormat("Y-m-d", $values['cdate']);
										echo date("F", strtotime($values['cdate']))." ".$date->format("d");echo ", ".date("Y", strtotime($values['cdate']));
										?>
										</td>
										<td style="text-align:center;"><?php  echo $values['reqst'];?></td>
										<td style="text-align:center;"><?php  echo $values['conversion'];?></td>
									</tr>                 
									<?php } ?>
								</tbody>
							</table>
							
						
						
						
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<?php $this->load->view('admin_includes/footer');?>
	
	
	


													