<?php $this->load->view('publisher/header');?>
<style>
.content-wrapper,.main-footer{margin-left:0px;}
div.stats {
    display: block;
    padding: 0;
    margin: 10px 0 15px 0;
}
.stats ul {
    margin: 0;
    padding: 0 0 0 15px;
    list-style-type: none;
    width: 100%;
}

ol, ul {
    list-style: none;
}
.stats ul li:first-child {
    border-left: none;
}

.stats ul li {
    float: left;
    margin: 0;
    padding: 12px 5% 0 0;
}
.stats ul li span {
    display: block;
    margin: 0 0 6px;
    font-size: 21px;
    color: #434343;
    line-height: 100%;
    letter-spacing: -.5px;
}
.stats ul li em {
    text-transform: uppercase;
    font-size: 11px;
    font-style: normal;
    color: #898F9C;
    font-family: "proximanova-semibold","Helvetica Neue",Helvetica,Arial,sans-serif;
}
.stats ul li.clicks em:before {
    color: #85d564;
}

.stats ul li em:before {
    font-family: fontawesome;
    content: '\f111';
    margin: 0 5px 0 0;
}


</style>
<div class="content-wrapper" style="min-height: 368px;">
	
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
					</div>
					<div class="box-body">
					
						<form action="<?php echo base_url()?>publisher/home" name="period_form" id="period_form" autocomplete="off">
							<select tabindex="1" onchange="periodFormChange(1)" id="period_preset" name="period_preset">
								<option  value="today" <?php if(isset($period_preset) && $period_preset=='today'){echo 'selected';} ?>>Today</option>
								<option value="yesterday" <?php if(isset($period_preset) && $period_preset=='yesterday'){echo 'selected';} ?>>Yesterday</option>
								<option value="this_month" <?php if(isset($period_preset) && $period_preset=='this_month'){echo 'selected';} ?>>This month</option>
								<option value="all_stats" <?php if(isset($period_preset) && $period_preset=='all_stats'){echo 'selected';} ?>>All statistics</option>
								<option value="specific" <?php if(isset($period_preset) && $period_preset=='specific'){echo 'selected';} ?>>Specific dates</option>
							</select>
							<label style="margin-left: 1em" for="period_start"></label>
							<input type="text" tabindex="0" value="<?php if(isset($period_start)){echo $period_start;} ?>"  id="period_start" name="period_start" class="date" readonly="" style="background-color: rgb(204, 204, 204);"/>
							<input type="image" border="0" align="absmiddle" tabindex="0" id="period_start_button" src="<?php echo base_url();?>assets/upimages/icon-calendar-d.gif" disabled="" readonly="" style="cursor: default;">
							<label style="margin-left: 1em" for="period_end"> </label>
							<input type="text" tabindex="0" value="<?php if(isset($period_end)){echo $period_end;} ?>"  id="period_end" name="period_end" class="date" readonly="" style="background-color: rgb(204, 204, 204);"/>
							<input type="image" border="0" align="absmiddle" tabindex="0" id="period_end_button" src="<?php echo base_url();?>assets/upimages/icon-calendar-d.gif" disabled="" readonly="" style="cursor: default;">
											
							<a onclick="return periodFormSubmit()" href="#">
								<img border="0" tabindex="6" src="<?php echo base_url();?>assets/upimages/ltr/go_blue.gif"></a>
							
							</form>
							
							
							
							<div class="stats cf">
								<ul>
								<?php if(isset($publisherStats) && ($publisherStats->impressions)){ ?>
									<li class="impressions">
										<span><?php echo $publisherStats->impressions;?></span>
										<em>impressions</em>
									</li>
									<li class="clicks">
										<span><?php echo $publisherStats->clicks;?></span>
										<em>clicks</em>
									</li>
									<li class="ctr">
										<span><?php echo round(($publisherStats->clicks / $publisherStats->impressions*100),2) ;?>%</span>
										<em>click through rate</em>
									</li>
								<?php }else{ ?>
									<li class="impressions">
										<span>0</span>
										<em>impressions</em>
									</li>
									<li class="clicks">
										<span>0</span>
										<em>clicks</em>
									</li>
									<li class="ctr">
										<span>0.00%</span>
										<em>click through rate</em>
									</li>
								<?php } ?>
								</ul>
							</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	
</div>
<script type="text/javascript">
        <!--
        

        var field = document.getElementById('period_start');
        var oldOnSubmit = field.form.onsubmit;

        field.form.onsubmit = function() {
          if(oldOnSubmit) {
            oldOnSubmit();
          }

          return checkDates(this);
        }

        function checkDates(form)
        {
          var startField = form.period_start;
          var endField = form.period_end;

          if (!startField.disabled && startField.value != '') {
            var start = parseDate(startField.value, '%d %B %Y');
          }
          if (!startField.disabled && endField.value != '') {
            var end = parseDate(endField.value, '%d %B %Y');
          }

          if ((start != undefined && end != undefined) && (start.getTime() > end.getTime())) {
            alert('\'From\' date must be earlier then \'To\' date');
            return false;
          }
          return true;
        }

        // Tabindex handling
        periodTabIndex = 2;
        // Functions
        function periodReset()
        {
            document.getElementById('period_start').value = '04 February 2019 ';
            document.getElementById('period_start').value = '10 February 2019';
            document.getElementById('period_preset').value = 'last_week';
        }

        function periodFormSubmit() {
            var form = document.getElementById('period_preset').form;
            if (checkDates(form)) {
              form.submit();
            }
            return false;
        }

        function periodFormChange(bAutoSubmit)
        {
            var o = document.getElementById('period_preset');
            var periodSelectName = o.options[o.selectedIndex].value;
            var specific = periodSelectName == 'specific';
            if (periodSelectName == 'today') {
                document.getElementById('period_start').value = "<?php echo $date['today']['start'];?>"	;
                document.getElementById('period_end').value = "<?php echo $date['today']['end'];?>";
            }
                
            if (periodSelectName == 'yesterday') {
                document.getElementById('period_start').value = "<?php echo $date['yesterday']['start'];?>";
                document.getElementById('period_end').value = "<?php echo $date['yesterday']['end'];?>";
            }
			
            if (periodSelectName == 'this_month') {
                document.getElementById('period_start').value = "<?php echo $date['this_month']['start'];?>";
                document.getElementById('period_end').value = "<?php echo $date['this_month']['end'];?>";
            }
                
            
                
            if (periodSelectName == 'all_stats') {
                document.getElementById('period_start').value = '';
                document.getElementById('period_end').value = '';
            }
                

            document.getElementById('period_start').readOnly = !specific;
            document.getElementById('period_start_button').disabled = !specific;
            document.getElementById('period_end').readOnly = !specific;
            document.getElementById('period_end_button').disabled = !specific;

            if (!specific) {
				console.log("not specific");
                document.getElementById('period_start').style.backgroundColor = '#CCCCCC';
                document.getElementById('period_end').style.backgroundColor = '#CCCCCC';
                document.getElementById('period_start').tabIndex = null;
                document.getElementById('period_start_button').tabIndex = null;
                document.getElementById('period_end').tabIndex = null;
                document.getElementById('period_end_button').tabIndex = null;
            } else {
				$('#period_start').datepicker({
			
			format: 'yyyy-mm-dd',
			autoclose:true

		});
		$('#period_end').datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true

		});

                document.getElementById('period_start').style.backgroundColor = '#FFFFFF';
                document.getElementById('period_end').style.backgroundColor = '#FFFFFF';
                document.getElementById('period_start').tabIndex = periodTabIndex;
                document.getElementById('period_start_button').tabIndex = periodTabIndex + 1;
                document.getElementById('period_end').tabIndex = periodTabIndex + 2;
                document.getElementById('period_end_button').tabIndex = periodTabIndex + 3;
            }

            document.getElementById('period_start_button').readOnly = !specific;
            document.getElementById('period_end_button').readOnly = !specific;
            document.getElementById('period_start_button').src = specific ? 'http://localhost/adserver/adserve/assets/upimages/icon-calendar-d.gif' : 'http://localhost/adserver/adserve/assets/upimages/icon-calendar-d.gif';
            document.getElementById('period_end_button').src = specific ? 'http://localhost/adserver/adserve/assets/upimages/icon-calendar-d.gif' : 'http://localhost/adserver/adserve/assets/upimages/icon-calendar-d.gif';
            document.getElementById('period_start_button').style.cursor = specific ? 'auto' : 'default';
            document.getElementById('period_end_button').style.cursor = specific ? 'auto' : 'default';

            if (!specific && bAutoSubmit) {
                o.form.submit();
            }
        }
		
		
        periodFormChange(0);
        //-->
		
		function parseDate(input) {
			var parts = input.match(/(\d+)/g);
			return new Date(parts[0], parts[1]-1, parts[2]); // months are 0-based
		}
        </script>
<?php $this->load->view('admin_includes/footer');?>

		



			