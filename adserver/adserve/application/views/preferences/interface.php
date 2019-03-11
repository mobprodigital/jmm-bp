	<div class="content-wrapper">
	<section class="content" >
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<form onsubmit="return max_formValidate(this);" action="/reviveadserver/www/admin/account-user-name-language.php" method="post" enctype="multipart/form-data" name="settingsform" id="settingsform">
						<h3 class="middle-heading">User Interface Preferences</h3>
						<table width="100%" cellspacing="0" cellpadding="0" border="0">
							<tbody>
								<tr>
									<td  colspan="2">
										<input type="hidden" value="true" name="submitok">
										<img width="16" height="16" align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-settings.gif">&nbsp;
										<b>Inventory</b>
									</td>
								</tr>
								<tr height="1"><td  colspan="2"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td></tr>
								<tr>
									<td width="100%" valign="top" >
										<input type="checkbox" tabindex="1" onclick="phpAds_refreshEnabled(); " id="campaign_ecpm_enabled" name="campaign_ecpm_enabled">
											Show extra campaign info on
											<i>Campaigns</i>
											page
									</td>
								</tr>
								<tr>
									<td width="100%" valign="top" >
										<input type="checkbox" tabindex="1" onclick="phpAds_refreshEnabled(); " id="campaign_ecpm_enabled" name="campaign_ecpm_enabled">
										Show extra banner info on
										<i>Banners</i>
										page
									</td>
								</tr>
								<tr>
									<td width="100%" valign="top" >
										<input type="checkbox" tabindex="1" onclick="phpAds_refreshEnabled(); " id="campaign_ecpm_enabled" name="campaign_ecpm_enabled">
										Show preview of all banners on banners page									</td>
								</tr>
								<tr>
									
									<td style="width: 250px; height: 20px;"><div style="height:2px;background-color: #bbbbbb;">&nbsp;</div></td>
									
								</tr>
								<tr>
									<td width="100%" valign="top" >
										<input type="checkbox" tabindex="1" onclick="phpAds_refreshEnabled(); " id="campaign_ecpm_enabled" name="campaign_ecpm_enabled">
										Show actual banner instead of plain HTML code for HTML banner preview								</td>
								</tr>
								<tr>
									<td width="100%" valign="top" >
										<input type="checkbox" tabindex="1" onclick="phpAds_refreshEnabled(); " id="campaign_ecpm_enabled" name="campaign_ecpm_enabled">
										Show banner preview at the top of pages which deal with banners									</td>
								</tr>
								<tr>
									
									<td style="width: 250px; height: 20px;"><div style="height:2px;background-color: #bbbbbb;">&nbsp;</div></td>
									
								</tr>
								<tr>
									<td width="100%" valign="top" >
										<input type="checkbox" tabindex="1" onclick="phpAds_refreshEnabled(); " id="campaign_ecpm_enabled" name="campaign_ecpm_enabled">
										Hide inactive items from all overview pages									</td>
								</tr>
								<tr>
									
									<td style="width: 250px; height: 20px;"><div style="height:1px;background-color: #bbbbbb;">&nbsp;</div></td>
									
								</tr>
								<tr>
									<td width="100%" valign="top" >
										<input type="checkbox" tabindex="1" onclick="phpAds_refreshEnabled(); " id="campaign_ecpm_enabled" name="campaign_ecpm_enabled">
										Show matching banners on the
										<i>Linked banner</i>
										pages
									</td>
								</tr>
								<tr>
									<td width="100%" valign="top" >
										<input type="checkbox" tabindex="1" onclick="phpAds_refreshEnabled(); " id="campaign_ecpm_enabled" name="campaign_ecpm_enabled">
										Show parent campaigns on the
										<i>Linked banner</i>
										pages									
									</td>
								</tr>
								
								<tr>
									<td style="width: 250px; height: 20px;"><div style="height:1px;background-color: #bbbbbb;">&nbsp;</div></td>
									
								</tr>
								<tr>
									<td width="100%" valign="top" >
										<input type="checkbox" tabindex="1" onclick="phpAds_refreshEnabled(); " id="campaign_ecpm_enabled" name="campaign_ecpm_enabled">
										Show entity identifiers									
									</td>
								</tr>
								</tr>
								<tr class="break">
									<td colspan="4">
									</td>
								</tr>
								<tr height="1"><td  colspan="4"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td></tr>
							</tbody>
						</table>
						
						<table class="margin-table" width="100%" cellspacing="0" cellpadding="0" border="0">
							<tbody>
								<tr>
									<td  colspan="2">
										<input type="hidden" value="true" name="submitok">
										<img width="16" height="16" align="absmiddle" src="<?php echo base_url();?>assets/upimages/icon-settings.gif">&nbsp;
										<b>Confirmation in User Interface</b>
									</td>
								</tr>
								<tr height="1"><td  colspan="2"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td></tr>
								<tr>
									<td width="100%" valign="top" >
										<input type="checkbox" tabindex="1" onclick="phpAds_refreshEnabled(); " id="campaign_ecpm_enabled" name="campaign_ecpm_enabled">
										Delete actions require confirmation for safety
									</td>
								</tr>
								<tr class="break">
									<td colspan="4">
									</td>
								</tr>
								<tr height="1"><td  colspan="4"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td></tr>
							</tbody>
						</table>
						<table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tbody><tr>
            <td height="25" colspan="4">
                                <input type="hidden" value="true" name="submitok">
                              <img align="absmiddle" width="16" height="16" src="<?php echo base_url();?>assets/upimages/icon-settings.gif">&nbsp;
                <b>Statistics</b>
            </td>
        </tr>
        <tr height="1" >
	        <td  width="100%" colspan="4"><img width="100%" height="1" src="<?php echo base_url();?>assets/upimages/break.gif"></td>
        </tr>
        <tr>
            <td height="10" colspan="4"><img width="30" height="1" src="<?php echo base_url();?>assets/upimages/spacer.gif"></td>
        </tr>
            	            <tr><td>&nbsp;</td>
        <td class="cellenabled" id="cell_ui_week_start_day">Beginning of Week
                </td>
        <td width="100%">
            <select tabindex="11" onchange="phpAds_refreshEnabled();
		        		        " id="ui_week_start_day" name="ui_week_start_day">
            <option value="0">Sunday</option>
<option selected="selected" value="1">Monday</option>

            </select>
		            </td>
        <td>&nbsp;</td>
    </tr>
    	        <tr>
    <td style="width: 30px; height: 1px;">&nbsp;</td>
    <td style="width: 250px; height: 20px;"><div style="height:1px;background-color: #bbbbbb;">&nbsp;</div></td>
    <td>&nbsp;</td>
    <td style="width: 30px; height: 1px;">&nbsp;</td>
</tr>
    	            <tr><td>&nbsp;</td>
        <td class="cellenabled" id="cell_ui_percentage_decimals">Percentage Decimals
                </td>
        <td width="100%">
            <select tabindex="12" onchange="phpAds_refreshEnabled();
		        		        " id="ui_percentage_decimals" name="ui_percentage_decimals">
            <option value="0">0</option>
<option value="1">1</option>
<option selected="selected" value="2">2</option>
<option value="3">3</option>

            </select>
		            </td>
        <td>&nbsp;</td>
    </tr>
    	        <tr>
    <td style="width: 30px; height: 1px;">&nbsp;</td>
    <td style="width: 250px;"><div style="height:1px;background-color: #bbbbbb;">&nbsp;</div></td>
    <td>&nbsp;</td>
    <td style="width: 30px; height: 1px;">&nbsp;</td>
</tr>
    	        <tr>
  <td>
    &nbsp;
  </td>
  <td colspan="3">
    <table>
      <tbody><tr>
        <td>
          <b>Column Name</b>
        </td>
        <td>
          &nbsp;
        </td>
        <td>
          <b>Show Column</b>
        </td>
        <td>
          &nbsp;
        </td>
        <td>
          <b>Custom Column Name</b>
        </td>
        <td>
          &nbsp;
        </td>
        <td>
          <b>Column Rank</b>
        </td>
      </tr>
                                                              <tr>
            <td>
              <label for="ui_column_revenue">Revenue</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_revenue">
              <input type="checkbox" tabindex="13" onclick="phpAds_refreshEnabled();" checked="checked" value="true" id="ui_column_revenue" name="ui_column_revenue">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_revenue_label" class="cellenabled">
              <input type="text" tabindex="14" value="" name="ui_column_revenue_label" size="10">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_revenue_rank" class="cellenabled">
              <input type="text" tabindex="15" value="4" name="ui_column_revenue_rank" size="10" onblur="max_formValidateElement(this);">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_bv">Basket value</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_bv">
              <input type="checkbox" tabindex="16" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_bv" name="ui_column_bv">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_bv_label" class="celldisabled">
              <input type="text" tabindex="17" value="" name="ui_column_bv_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_bv_rank" class="celldisabled">
              <input type="text" tabindex="18" value="0" name="ui_column_bv_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_num_items">Number of items</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_num_items">
              <input type="checkbox" tabindex="19" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_num_items" name="ui_column_num_items">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_num_items_label" class="celldisabled">
              <input type="text" tabindex="20" value="" name="ui_column_num_items_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_num_items_rank" class="celldisabled">
              <input type="text" tabindex="21" value="0" name="ui_column_num_items_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_revcpc">Revenue CPC</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_revcpc">
              <input type="checkbox" tabindex="22" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_revcpc" name="ui_column_revcpc">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_revcpc_label" class="celldisabled">
              <input type="text" tabindex="23" value="" name="ui_column_revcpc_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_revcpc_rank" class="celldisabled">
              <input type="text" tabindex="24" value="0" name="ui_column_revcpc_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_erpm">ERPM</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_erpm">
              <input type="checkbox" tabindex="25" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_erpm" name="ui_column_erpm">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_erpm_label" class="celldisabled">
              <input type="text" tabindex="26" value="" name="ui_column_erpm_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_erpm_rank" class="celldisabled">
              <input type="text" tabindex="27" value="0" name="ui_column_erpm_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_erpc">ERPC</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_erpc">
              <input type="checkbox" tabindex="28" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_erpc" name="ui_column_erpc">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_erpc_label" class="celldisabled">
              <input type="text" tabindex="29" value="" name="ui_column_erpc_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_erpc_rank" class="celldisabled">
              <input type="text" tabindex="30" value="0" name="ui_column_erpc_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_erps">ERPS</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_erps">
              <input type="checkbox" tabindex="31" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_erps" name="ui_column_erps">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_erps_label" class="celldisabled">
              <input type="text" tabindex="32" value="" name="ui_column_erps_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_erps_rank" class="celldisabled">
              <input type="text" tabindex="33" value="0" name="ui_column_erps_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_eipm">EIPM</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_eipm">
              <input type="checkbox" tabindex="34" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_eipm" name="ui_column_eipm">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_eipm_label" class="celldisabled">
              <input type="text" tabindex="35" value="" name="ui_column_eipm_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_eipm_rank" class="celldisabled">
              <input type="text" tabindex="36" value="0" name="ui_column_eipm_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_eipc">EIPC</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_eipc">
              <input type="checkbox" tabindex="37" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_eipc" name="ui_column_eipc">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_eipc_label" class="celldisabled">
              <input type="text" tabindex="38" value="" name="ui_column_eipc_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_eipc_rank" class="celldisabled">
              <input type="text" tabindex="39" value="0" name="ui_column_eipc_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_eips">EIPS</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_eips">
              <input type="checkbox" tabindex="40" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_eips" name="ui_column_eips">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_eips_label" class="celldisabled">
              <input type="text" tabindex="41" value="" name="ui_column_eips_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_eips_rank" class="celldisabled">
              <input type="text" tabindex="42" value="0" name="ui_column_eips_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_ecpm">eCPM</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_ecpm">
              <input type="checkbox" tabindex="43" onclick="phpAds_refreshEnabled();" checked="checked" value="true" id="ui_column_ecpm" name="ui_column_ecpm">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_ecpm_label" class="cellenabled">
              <input type="text" tabindex="44" value="" name="ui_column_ecpm_label" size="10">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_ecpm_rank" class="cellenabled">
              <input type="text" tabindex="45" value="5" name="ui_column_ecpm_rank" size="10" onblur="max_formValidateElement(this);">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_ecpc">ECPC</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_ecpc">
              <input type="checkbox" tabindex="46" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_ecpc" name="ui_column_ecpc">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_ecpc_label" class="celldisabled">
              <input type="text" tabindex="47" value="" name="ui_column_ecpc_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_ecpc_rank" class="celldisabled">
              <input type="text" tabindex="48" value="0" name="ui_column_ecpc_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_ecps">ECPS</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_ecps">
              <input type="checkbox" tabindex="49" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_ecps" name="ui_column_ecps">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_ecps_label" class="celldisabled">
              <input type="text" tabindex="50" value="" name="ui_column_ecps_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_ecps_rank" class="celldisabled">
              <input type="text" tabindex="51" value="0" name="ui_column_ecps_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_id">ID</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_id">
              <input type="checkbox" tabindex="52" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_id" name="ui_column_id">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_id_label" class="celldisabled">
              <input type="text" tabindex="53" value="" name="ui_column_id_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_id_rank" class="celldisabled">
              <input type="text" tabindex="54" value="0" name="ui_column_id_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_requests">Requests</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_requests">
              <input type="checkbox" tabindex="55" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_requests" name="ui_column_requests">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_requests_label" class="celldisabled">
              <input type="text" tabindex="56" value="" name="ui_column_requests_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_requests_rank" class="celldisabled">
              <input type="text" tabindex="57" value="0" name="ui_column_requests_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_impressions">Impressions</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_impressions">
              <input type="checkbox" tabindex="58" onclick="phpAds_refreshEnabled();" checked="checked" value="true" id="ui_column_impressions" name="ui_column_impressions">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_impressions_label" class="cellenabled">
              <input type="text" tabindex="59" value="" name="ui_column_impressions_label" size="10">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_impressions_rank" class="cellenabled">
              <input type="text" tabindex="60" value="1" name="ui_column_impressions_rank" size="10" onblur="max_formValidateElement(this);">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_clicks">Clicks</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_clicks">
              <input type="checkbox" tabindex="61" onclick="phpAds_refreshEnabled();" checked="checked" value="true" id="ui_column_clicks" name="ui_column_clicks">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_clicks_label" class="cellenabled">
              <input type="text" tabindex="62" value="" name="ui_column_clicks_label" size="10">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_clicks_rank" class="cellenabled">
              <input type="text" tabindex="63" value="2" name="ui_column_clicks_rank" size="10" onblur="max_formValidateElement(this);">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_ctr">Click-Through Ratio</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_ctr">
              <input type="checkbox" tabindex="64" onclick="phpAds_refreshEnabled();" checked="checked" value="true" id="ui_column_ctr" name="ui_column_ctr">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_ctr_label" class="cellenabled">
              <input type="text" tabindex="65" value="" name="ui_column_ctr_label" size="10">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_ctr_rank" class="cellenabled">
              <input type="text" tabindex="66" value="3" name="ui_column_ctr_rank" size="10" onblur="max_formValidateElement(this);">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_conversions">Conversions</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_conversions">
              <input type="checkbox" tabindex="67" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_conversions" name="ui_column_conversions">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_conversions_label" class="celldisabled">
              <input type="text" tabindex="68" value="" name="ui_column_conversions_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_conversions_rank" class="celldisabled">
              <input type="text" tabindex="69" value="0" name="ui_column_conversions_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_conversions_pending">Pending conversions</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_conversions_pending">
              <input type="checkbox" tabindex="70" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_conversions_pending" name="ui_column_conversions_pending">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_conversions_pending_label" class="celldisabled">
              <input type="text" tabindex="71" value="" name="ui_column_conversions_pending_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_conversions_pending_rank" class="celldisabled">
              <input type="text" tabindex="72" value="0" name="ui_column_conversions_pending_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_sr_views">Impression SR</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_sr_views">
              <input type="checkbox" tabindex="73" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_sr_views" name="ui_column_sr_views">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_sr_views_label" class="celldisabled">
              <input type="text" tabindex="74" value="" name="ui_column_sr_views_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_sr_views_rank" class="celldisabled">
              <input type="text" tabindex="75" value="0" name="ui_column_sr_views_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                    <tr>
            <td>
              <label for="ui_column_sr_clicks">Click SR</label>
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_sr_clicks">
              <input type="checkbox" tabindex="76" onclick="phpAds_refreshEnabled();" value="true" id="ui_column_sr_clicks" name="ui_column_sr_clicks">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_sr_clicks_label" class="celldisabled">
              <input type="text" tabindex="77" value="" name="ui_column_sr_clicks_label" size="10" disabled="">
            </td>
            <td>
              &nbsp;
            </td>
            <td id="cell_ui_column_sr_clicks_rank" class="celldisabled">
              <input type="text" tabindex="78" value="0" name="ui_column_sr_clicks_rank" size="10" onblur="max_formValidateElement(this);" disabled="">
            </td>
          </tr>
                                          </tbody></table>
  </td>
</tr>
    	            <tr>
        <td height="10" colspan="4">&nbsp;</td>
    </tr>
        <tr class="break">
        <td colspan="4">
        </td>
    </tr>
</tbody></table>
						
						<input type="hidden" value="15237771589c4ab7dab0d9e7e9cd7e83" id="token" name="token">    
						<input type="submit" class="btn btn-primary" tabindex="4" value="Save Changes" name="submitsettings"></form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
			<?php $this->load->view('admin_includes/footer');?>
			<script src="<?php echo base_url();?>assets/js/adserver.js"></script>



																												