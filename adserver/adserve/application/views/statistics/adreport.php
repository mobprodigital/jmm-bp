<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
					<b>Standard Reports</b>
						<table cellspacing="0" cellpadding="0" border="0" width="100%">
						<tbody>
							<tr><td height="25" colspan="3"><img align="absmiddle" src="http://localhost/reviveadserver/www/admin/assets/images/excel.gif">&nbsp;&nbsp;<b>Advertising Analysis Report</b></td></tr>
							<tr height="1"><td  colspan="3"><img width="100%" height="1" src="http://localhost/reviveadserver/www/admin/assets/images/break.gif"></td></tr><tr><td height="10" colspan="3">&nbsp;</td></tr><tr><td width="30">&nbsp;</td><td height="25" colspan="2">This report shows a breakdown of advertising for a particular advertiser or website, by day, campaign, and zone.</td></tr><tr><td height="10" colspan="3">&nbsp;</td></tr>
							<form method="get" action="report-generate.php"></form>
							<tr height="10"><td width="30"><img width="100%" height="1" src="http://localhost/reviveadserver/www/admin/assets/images/spacer.gif"></td>
								<td><img width="200" vspace="6" height="1" src="http://localhost/reviveadserver/www/admin/assets/images/break-l.gif"></td>
							</tr>
							<tr><td width="30">&nbsp;</td><td>Period</td><td>
								<select tabindex="1" onchange="periodFormChange(0)" id="period_preset" name="period_preset">
									<option value="today">Today</option>
									<option value="yesterday">Yesterday</option>
									<option value="this_week">This week</option>
									<option value="last_week">Last week</option>
									<option value="last_7_days">Last 7 days</option>
									<option value="this_month">This month</option>
									<option selected="selected" value="last_month">Last month</option>
									<option value="all_stats">All statistics</option>
									<option value="specific">Specific dates</option>
								</select>
									<label style="margin-left: 1em" for="period_start"></label>
									<input type="text" tabindex="0" value="01 March 2016 " id="period_start" name="period_start" class="date" readonly="" style="background-color: rgb(204, 204, 204);">
									<input border="0" align="absmiddle" type="image" tabindex="0" id="period_start_button" src="http://localhost/reviveadserver/www/admin/assets/images/icon-calendar-d.gif" disabled="" readonly="" style="cursor: default;">
									<label style="margin-left: 1em" for="period_end"> </label>
									<input type="text" tabindex="0" value="31 March 2016" id="period_end" name="period_end" class="date" readonly="" style="background-color: rgb(204, 204, 204);">
									<input border="0" align="absmiddle" type="image" tabindex="0" id="period_end_button" src="http://localhost/reviveadserver/www/admin/assets/images/icon-calendar-d.gif" disabled="" readonly="" style="cursor: default;">
        <script type="text/javascript">
        &lt;!--
        Calendar.setup({
            inputField : 'period_start',
            ifFormat   : '%d %B %Y',
            button     : 'period_start_button',
            align      : 'Bl',
            weekNumbers: false,
            firstDay   : 1,
            electric   : false
        });
        Calendar.setup({
            inputField : 'period_end',
            ifFormat   : '%d %B %Y',
            button     : 'period_end_button',
            align      : 'Bl',
            weekNumbers: false,
            firstDay   : 1,
            electric   : false
        });

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

          if (!startField.disabled &amp;&amp; startField.value != '') {
            var start = Date.parseDate(startField.value, '%d %B %Y');
          }
          if (!startField.disabled &amp;&amp; endField.value != '') {
            var end = Date.parseDate(endField.value, '%d %B %Y');
          }

          if ((start != undefined &amp;&amp; end != undefined) &amp;&amp; (start.getTime() &gt; end.getTime())) {
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
            document.getElementById('period_start').value = '01 March 2016 ';
            document.getElementById('period_start').value = '31 March 2016';
            document.getElementById('period_preset').value = 'last_month';
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
                document.getElementById('period_start').value = '19 April 2016';
                document.getElementById('period_end').value = '19 April 2016';
            }
                
            if (periodSelectName == 'yesterday') {
                document.getElementById('period_start').value = '18 April 2016';
                document.getElementById('period_end').value = '18 April 2016';
            }
                
            if (periodSelectName == 'this_week') {
                document.getElementById('period_start').value = '18 April 2016';
                document.getElementById('period_end').value = '19 April 2016';
            }
                
            if (periodSelectName == 'last_week') {
                document.getElementById('period_start').value = '11 April 2016';
                document.getElementById('period_end').value = '17 April 2016';
            }
                
            if (periodSelectName == 'last_7_days') {
                document.getElementById('period_start').value = '12 April 2016';
                document.getElementById('period_end').value = '18 April 2016';
            }
                
            if (periodSelectName == 'this_month') {
                document.getElementById('period_start').value = '01 April 2016';
                document.getElementById('period_end').value = '19 April 2016';
            }
                
            if (periodSelectName == 'last_month') {
                document.getElementById('period_start').value = '01 March 2016';
                document.getElementById('period_end').value = '31 March 2016';
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
                document.getElementById('period_start').style.backgroundColor = '#CCCCCC';
                document.getElementById('period_end').style.backgroundColor = '#CCCCCC';
                document.getElementById('period_start').tabIndex = null;
                document.getElementById('period_start_button').tabIndex = null;
                document.getElementById('period_end').tabIndex = null;
                document.getElementById('period_end_button').tabIndex = null;
            } else {
                document.getElementById('period_start').style.backgroundColor = '#FFFFFF';
                document.getElementById('period_end').style.backgroundColor = '#FFFFFF';
                document.getElementById('period_start').tabIndex = periodTabIndex;
                document.getElementById('period_start_button').tabIndex = periodTabIndex + 1;
                document.getElementById('period_end').tabIndex = periodTabIndex + 2;
                document.getElementById('period_end_button').tabIndex = periodTabIndex + 3;
            }

            document.getElementById('period_start_button').readOnly = !specific;
            document.getElementById('period_end_button').readOnly = !specific;
            document.getElementById('period_start_button').src = specific ? 'http://localhost/reviveadserver/www/admin/assets/images/icon-calendar.gif' : 'http://localhost/reviveadserver/www/admin/assets/images/icon-calendar-d.gif';
            document.getElementById('period_end_button').src = specific ? 'http://localhost/reviveadserver/www/admin/assets/images/icon-calendar.gif' : 'http://localhost/reviveadserver/www/admin/assets/images/icon-calendar-d.gif';
            document.getElementById('period_start_button').style.cursor = specific ? 'auto' : 'default';
            document.getElementById('period_end_button').style.cursor = specific ? 'auto' : 'default';

            if (!specific &amp;&amp; bAutoSubmit) {
                o.form.submit();
            }
        }
        periodFormChange(0);
        //--&gt;
        </script></td></tr>
        <tr height="10">
            <td width="30"><img width="100%" height="1" src="http://localhost/reviveadserver/www/admin/assets/images/spacer.gif"></td>
            <td><img width="200" vspace="6" height="1" src="http://localhost/reviveadserver/www/admin/assets/images/break-l.gif"></td>
        </tr><tr><td width="30">&nbsp;</td><td>Limitations</td><td>
        <select tabindex="6" id="scope_advertiser" name="scope_advertiser">
            <option value="all">-- All advertisers --</option>
            <option value="2">bablu</option>
            <option value="1">prince</option>
            <option value="4">Rohit</option>
        </select>
        <br><br>
        <select tabindex="7" id="scope_publisher" name="scope_publisher">
            <option value="all">-- All websites --</option>
            <option value="3">www.cricmagic.com</option>
            <option value="4">www.mediaconversion.com</option>
        </select></td></tr>
        <tr height="10">
            <td width="30"><img width="100%" height="1" src="http://localhost/reviveadserver/www/admin/assets/images/spacer.gif"></td>
            <td><img width="200" vspace="6" height="1" src="http://localhost/reviveadserver/www/admin/assets/images/break-l.gif"></td>
        </tr><tr><td width="30">&nbsp;</td><td>Worksheets</td><td>
                <input type="checkbox" checked="checked" value="1" name="sheets[daily_breakdown]" id="sheets_daily_breakdown"><label for="sheets_daily_breakdown">Daily Breakdown</label><br>
                <input type="checkbox" checked="checked" value="1" name="sheets[campaign_breakdown]" id="sheets_campaign_breakdown"><label for="sheets_campaign_breakdown">Campaign Breakdown</label><br>
                <input type="checkbox" checked="checked" value="1" name="sheets[zone_breakdown]" id="sheets_zone_breakdown"><label for="sheets_zone_breakdown">Zone Breakdown</label><br></td></tr>
        <tr height="10">
            <td width="30"><img width="100%" height="1" src="http://localhost/reviveadserver/www/admin/assets/images/spacer.gif"></td>
            <td><img width="200" vspace="6" height="1" src="http://localhost/reviveadserver/www/admin/assets/images/break-l.gif"></td>
        </tr>
        <tr>
          <td height="25" colspan="3">
            <br><br>
            <input type="hidden" value="reports:oxReportsStandard:advertisingAnalysisReport" name="plugin">
            <input type="button" tabindex="9" onclick="javascript:document.location.href=&quot;report-index.php&quot;" value="Go back to report list">
            &nbsp;&nbsp;
            <input type="submit" tabindex="8" value="Generate">
          </td>
        </tr>
        </tbody></table></br></br></br></br></br>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php $this->load->view('admin_includes/footer');?>
<script src="<?php echo base_url();?>assets/js/adserver.js"></script>



													