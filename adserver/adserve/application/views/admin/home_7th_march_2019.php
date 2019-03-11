<div class="content-wrapper" style="background:#fff;">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12" style="padding: 12px;">
				<h2>Welcome to Media Ads</h2>
			</div>
			<div style="width: 100%;">
				<div style="float: left; width: 34%; margin-left: 14px;"><b>See your statistics</b>
					<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
					<script src="<?php echo base_url().'assets/js/';?>topup.js"></script>
					<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
						<div style="margin-left:20px">
							<canvas id="graph" width="300" height="200" align="left"></canvas>
						</div>
						<script>		
							$( document ).ready(function() {
							var chartData = {
							node: "graph",
							dataset: [122, 65, 80, 84, 33, 55, 95, 15, 268, 47, 72, 69],
							labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
							pathcolor: "#288ed4",
							fillcolor: "#8e8e8e",
							xPadding: 0,
							yPadding: 0,
							ybreakperiod: 50
							};
							drawlineChart(chartData);
							});
						</script>
					</div>
					</div>
					<div style="float: left; width: 30%;"><b>Campaign Overview</b>
						<div class="content-listing;">
							<table id="example" class="table table-striped" style="width: 90%;">
								<thead>
									<tr  class="center-align">
										<th width="60%"></th>
										<th width="40%" class="center-align"></th>
									</tr>
								</thead>
								<tbody>
									<?php for($i=0;$i<=8;$i++){?>
									<tr style="background-color: <?php if($i % 2 == 0){echo '#ffffff';}else{echo '#ffffff';}?>">
										<td style="padding: 2px;">Media Converison</td>
										<td style="padding-left: 65px;"><a href="#">View</a></td>
									</tr>                 
									<?php } ?>
								</tbody>
							</table>
							<a href="<?php echo base_url();?>users/compaign/">Go to Campaign page</a>
						</div>
					</div>
					<div style="float: left; width: 30%;"><b>Audit Trial</b>
						<p style="padding:4px;">No user activity has been recorded during the timeframe you have selected.</p>
					</div>
					<br style="clear:left;"/>
				</div>
			</section>
		</div>
		<?php $this->load->view('admin_includes/footer');?>

		



			