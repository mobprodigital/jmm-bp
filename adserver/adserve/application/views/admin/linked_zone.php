<style>
hr {
    margin-bottom:9px;
}



.zone-available {
     width: 30%;
	 
}
.zone-linked {
     width: 60%;
	 
}

#data {
     width: 1200px;
     margin: 0 auto;
}
#leftcolumn, #rightcolumn, #middlecolumn {
    border: 1px solid white;
    float: left;
    min-height: 450px;
}
#leftcolumn {
     width: 500px;
}
#rightcolumn {
     width: 500px;
}
#middlecolumn {
     width:100px;
	 margin-left:20px;
	 margin-right:20px;
}



</style>

<div class="content-wrapper">
    <section class="content-header">
		<h1>Add Compaign</h1>
    </section>
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="box box-default">
				<?php $this->load->view('admin_includes/campaign_header');?>
					<div class="zone-detail">
						<div class="zone-available" style="float:left;">
						<div id="filters-available">
						<h3 class="filter-panel-title">Available Zones</h3>
						<div class="filter-panel">
							<div class="bg-left"></div>
							<div class="bg-right"></div>

							<div class="filter-content">
								<div id="status-available">
									Available:
									<span class="status-value">2</span><br>

										Showing: <span class="status-value">2</span>
									</div>

									<label class="filter search-filter">
										Search<br>
											<input type="text" title="Search zones and websites by name" class="quick-search example-search" id="quick-search-available">
									</label>
							</div>
										&nbsp;
									</div>
								</div>
								
								
								
							</div>
							<div class="zone-linked">
							<div id="filters-linked">
									<h3 class="filter-panel-title">Linked Zones</h3>
									<div class="filter-panel">
										<div class="bg-left"></div>
										<div class="bg-right"></div>

										<div class="filter-content">
											<div id="status-linked">
												Linked:
												<span class="status-value">0</span><br>
													Showing: <span class="status-value">0</span>
											</div>

												<label class="filter search-filter">
													Search<br>
														<input type="text" title="Search zones and websites by name" class="quick-search example-search" id="quick-search-linked">
												</label>	      
										</div>
									</div>
								</div>
								

							</div>
					</div>
				
				<div id="data" style="margin-top:50px;">
					<div id='leftcolumn'>
						<table id="example" class="table table-bordered table-striped" >
							<thead>
								<tr>
									<th width="10%"><input type="checkbox" class="advertiser" id="main_0" value="adchk"></th>
									<th width="60%">Select / Unselect All</th>
									<th width="10%">CTR</th>
									<th width="10%">CR</th>
									<th width="10%">CPM</th>
								</tr>
							</thead>
								<tbody>
									<tr style="outline: thin solid #e6e6e6">

										<td><input type="checkbox" class="advertiser"	id="2"></td><td>www.cricmagic.com         </td>
										<td>1.000%</td>
										<td>0.000%</td>
										<td>1.000%</td>
									</tr>                 
									<tr style="outline: thin solid #ffffff">
										<td><input type="checkbox" class="advertiser"	id="2"></td><td>www.cricmagic.com         </td>
										<td>1.000%</td>
										<td>0.000%</td>
										<td>1.000%</td>
									</tr>                 
									<tr style="outline: thin solid #e6e6e6">
										<td><input type="checkbox" class="advertiser"	id="2"></td><td>www.cricmagic.com         </td>
										<td>1.000%</td>
										<td>0.000%</td>
										<td>1.000%</td>
									</tr>                 
								</tbody>
							</table>
						</div>

						<div id ='middlecolumn'>
							<div id="linking-buttons">
								<a  href="http://localhost/adserver/users/compaign?clientid=25"><div  style="width:100%;" class="btn bg-blue btn-xs">Link</div></a>
								<a  href="http://localhost/adserver/users/viewcompaign?clientid=25"><div style="width:100%;"  class="btn bg-purple btn-xs">Unlink</div></a>
										
								  <div style="margin-top: 2ex; text-align: center">
									<span class="ajax-loading-big hide" id="linking-indicator"></span>
									<span id="linking-status"></span>
									<span class="ajax-error hide" id="error-indicator">Linking not successful, please try again</span>
								  </div>
							</div>
						</div>


<div id='rightcolumn'>
<table id="example" class="table table-bordered table-striped" >
							<thead>
								<tr>
									<th width="10%"><input type="checkbox" class="advertiser" id="main_0" value="adchk"></th>
									<th width="60%">Select / Unselect All</th>
									<th width="10%">CTR</th>
									<th width="10%">CR</th>
									<th width="10%">CPM</th>
								</tr>
							</thead>
								<tbody>
									<tr style="outline: thin solid #e6e6e6">

										<td><input type="checkbox" class="advertiser"	id="2"></td><td>www.cricmagic.com         </td>
										<td>1.000%</td>
										<td>0.000%</td>
										<td>1.000%</td>
									</tr>                 
									<tr style="outline: thin solid #ffffff">
										<td><input type="checkbox" class="advertiser"	id="2"></td><td>www.cricmagic.com         </td>
										<td>1.000%</td>
										<td>0.000%</td>
										<td>1.000%</td>
									</tr>                 
									<tr style="outline: thin solid #e6e6e6">
										<td><input type="checkbox" class="advertiser"	id="2"></td><td>www.cricmagic.com         </td>
										<td>1.000%</td>
										<td>0.000%</td>
										<td>1.000%</td>
									</tr>                 
								</tbody>
							</table>
						</div>
					

					</div>
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







