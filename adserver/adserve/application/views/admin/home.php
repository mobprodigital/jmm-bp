<?php
if(isset($_GET['all_period'])){
    $period_value = $_GET['all_period'];
  }else{
    $period_value = "today";
}
if($period_value == 'today'){
        $period = 'Hour';
        
 }elseif($period_value == 'yesterday'){
        $period  = 'Hour';
 }elseif($period_value == 'this_month'){
        $period  = 'Days';
}elseif($period_value == 'specific'){
        $period  = 'Days';
}
/*if(isset($_GET['currency'])){
    $currency_value = $_GET['currency'];
  }else{
    $currency_value = "USD";
}*/
if(isset($currency)){
    $currency_value = $currency;
  }else{
    $currency_value = '1';
}
if($currency_value=='1'){
   $currency_nm = "INR";  
   $currency_symb = "₹";
}elseif ($currency_value=='2') {
  $currency_nm = "USD";
  $currency_symb = "$"; 
}elseif ($currency_value=='3'){
  $currency_nm = "EUR";
  $currency_symb = "€";
}
  // for impressions 
              //  print_r($chart_data);
                // if(empty($chart_data)){
                //   $chart_data =array();
                // } //die;
                $new_arr = array();
                $count = count($chart_data);

              for($i=1; $i<=24; $i++){
                    $impressions =0;  
                for($j=0; $j<=$count-1; $j++){
                  if($chart_data[$j]->hour == $i){
                    $impressions = $chart_data[$j]->impressions;
                    break;
                  }else{
                    $impressions = 0;
                  } 
                  
                }
                    $new_arr[$i] = $impressions; 
                      
               }
                  
                 $implode_new_array = implode(",", $new_arr);
                 $array_val = array_values($new_arr);
                  $bighest_impression_value = max($new_arr);
                 if($bighest_impression_value>999){
                    $chart_impression_unit = "k";
                 }else if($bighest_impression_value>999999){
                    $chart_impression_unit = "m";
                 }else if($bighest_impression_value<999){
                    $chart_impression_unit = "";
                 }
                
        //  for clicks

                $new_clicks = array();
                $count = count($chart_data);

              for($i=1; $i<=24; $i++){
                    $clicks =0;  
                for($j=0; $j<=$count-1; $j++){
                  if($chart_data[$j]->hour == $i){
                    $clicks = $chart_data[$j]->clicks;
                    break;
                  }else{
                    $clicks = 0;
                  } 
                  
                }
                    $new_clicks[$i] = $clicks; 
                      
               }
                 
                $implode_new_click = implode(",", $new_clicks);
                 $bighest_value = max($new_clicks);
                 if($bighest_value>999){
                    $chart_click_unit = "k";
                 }else if($bighest_value>999999){
                    $chart_click_unit = "m";
                 }else if($bighest_value<999){
                    $chart_click_unit = "";
                 } 
                $array_click_val = array_values($new_clicks);
                //print_r($array_click_val); echo "hello";
                // if(empty($home_chart)){
                //   $home_chart =array();
                // }
                // if(empty($home_chart[0])){
                //   $home_chart[0]=array();
                // }
 ?>

<div class="content-wrapper" >
	<section class="content" >
		
 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/dist/css/home.css">
<section class="">
        <!-- Small boxes (Stat box) -->
<div class="">
  <div class="row ">
   <div class="col-md-12">
                 <div class="row" style="margin-top:60px;">
                  <div class="col-md-2">
                   <select class="form-select" id="all_period_report" onChange="all_period(this.value);">
                    <option value="today"<?php if($period_value == 'today'): ?> selected="selected"<?php endif; ?>>Today</option>
                    <option value="yesterday"<?php if($period_value == 'yesterday'): ?> selected="selected"<?php endif; ?>>Yesterday</option>
                    <option value="this_month"<?php if($period_value == 'this_month'): ?> selected="selected"<?php endif; ?>>This month</option>
                  <!--   <option value="all_stats"<?php if($period_value == 'all_stats'): ?> selected="selected"<?php endif; ?>>All statistics</option> -->
                    <option value="specific"<?php if($period_value == 'specific'): ?> selected="selected"<?php endif; ?>>Specific dates</option>
                   </select>
</div>
              <div class="col-md-10">
                 <div id="specific_date" <?php if(isset($period_value) && $period_value != 'specific'){ ?> style="display: none;"<?php }else{ ?> style="display: block;"<?php }?>>
                   <form action="<?php echo base_url()?>users/home" name="period_form" id="period_form" autocomplete="off">
                    <div class="row">
                      
                    
                   <input type="hidden" tabindex="0" value="specific" id="specific" name="all_period" /> 
                   <div class="col-md-3 p-lr-5">
                    <input type="text"  id="period_start" name="period_start" class="date" value="<?php if(isset($_GET['period_start'])){ echo $_GET['period_start']; } ?>" required />
                  </div>
<div class="col-md-3 p-lr-5">  
                   <input type="text" id="period_end" name="period_end" class="date" value="<?php if(isset($_GET['period_start'])){ echo $_GET['period_end']; } ?>" required />
                 </div>
                   <div class="col-md-3 p-lr-5"> <button class="btn-submit"><img class="btn-icon" border="0" tabindex="6" src="<?php echo base_url();?>assets/upimages/ltr/go_blue.gif"></button></div>
                   
                   
                
                   <!-- <input type="hidden" tabindex="0" value="specific"   id="specific" name="all_period" class="date" /> -->
                  <!--  <a onclick="return periodFormSubmit()" href="#"> -->
                  <!-- </a> -->
                  </div>
                </form>
                </div>
              </div>
                 
              </div>
 <!--   <div class="row mt-15">
                  <div class="col-md-2 float-right">
                   <select class="form-select" id="currency" onChange="select_currency('<?php echo $period_value?>',this.value);">
                    <option value="USD"<?php if($currency_value == 'USD'): ?> selected="selected"<?php endif; ?>>USD</option>
                    <option value="INR"<?php if($currency_value == 'INR'): ?> selected="selected"<?php endif; ?>>INR</option>
                    <option value="EUR"<?php if($currency_value == 'EUR'): ?> selected="selected"<?php endif; ?>>EUR</option>
                  </select>
                  </div>
                 
              </div> -->
              <h3 class="box-title">
              <?php 
                 
              $undr_replace = str_replace('_', ' ', $period_value);
              echo ucwords($undr_replace)." Statistics";
              ?>
              </h3>
              <h5><?php if(!empty($date['start'])){ echo date('d F  Y', strtotime($date['start']));}else{} ?> -  <?php if(!empty($date['start'])){echo date('d F  Y', strtotime($date['end']));}else{}  ?> <span><br><br> All Inventory</span> </h5>
             <div class="row">
                  <div class="col-md-3">
                    <div class="inner-box">
                    <h4 class="color-yello">Impression</h4>
                    <h2  class="color-blue"><?php if(empty($home_chart[0]->impressions) || $home_chart[0]->impressions==0){ echo "NA";}else{ echo $home_chart[0]->impressions; }  ?> </h2>
                    <input type="hidden" name="" id="impressions" value="<?php echo !empty($home_chart[0]->impressions)?$home_chart[0]->impressions:"";  ?>"> 
                    <input type="hidden" name="" id="hour" value="<?php echo !empty($home_chart[0]->hour)?$home_chart[0]->hour:""; ?>">
                    <!-- <h5 class="color-green">-9(38%)</h5> -->
                    </div>
                  </div>
                  
                  <div class="col-md-3">
                   <div class="inner-box">
                    <h4 class="color-yello">Clicks</h4>
                    <h2  class="color-blue"> </i><?php  if(empty($home_chart[0]->clicks) || $home_chart[0]->clicks==0){ echo "NA"; }else{ echo $home_chart[0]->clicks; } ?>
                    
                   </h2>
                    <!-- <h5  class="color-green"> <i class="fa fa-rupee"></i>+6.36(778%)</h5> -->
                   </div>
                  </div>
                  <div class="col-md-3">
                   <div class="inner-box">
                    <h4 class="color-yello">CTR</h4>
                    <h2 class="color-blue">
                     <?php 
                        $clicks      =  !empty($home_chart[0]->clicks)?$home_chart[0]->clicks:"0";
                        $impressions =  !empty($home_chart[0]->impressions)?$home_chart[0]->impressions:"0";

                        if($impressions=='0'){ $impressions=1;}
                          $ctr = ($clicks/$impressions)*100;  
                        if($ctr==0){ echo "NA";}else{ echo round($ctr,2)."%";} 
                     ?> 
                   </h2>
                    <!-- <h5  class="color-green">+6.36(778%)</h5> -->
                   </div>
                  </div>
                  <div class="col-md-3">
                   <div class="inner-box">
                    <h4 class="color-yello">Revenue</h4>
 <h2  class="color-blue">
                      <?php

                          $rev =  !empty($home_chart[0]->revenue)?$home_chart[0]->revenue:array();
                          //$rev = 200;
                          if($currency_value=='2'){  $rev = $rev/68; }elseif ($currency_value=='1') { $rev = $rev;}elseif ($currency_value=='3') { $rev = $rev/78; }
                          
                      if(empty($rev) || $rev=='0'){ echo "NA"; }else{ echo $currency_symb."".round($rev,2); } ?>
                        
                    </h2>
                  </div>
                  </div>
          </div>
  </div>
  </div>
   <div class="row ">
  <div class="col-md-12">
     <h3 class="box-title">Demand Comparison</h3>
     <div class="row">
       <div class="col-md-6">
         <div class=" home-box" style=" width:100%; height:100%;">
<h6 class="chart-unit"><?php echo $chart_impression_unit; ?></h6>
                <canvas id="Impression"></canvas>
<h6 class="text-center chart-labal">( <?php echo $period; ?> ) </h6>
              </div>
       </div>
         <div class="col-md-6">
         <div class=" home-box" style=" width:100%; height:100%;">
<h6 class="chart-unit"><?php echo $chart_click_unit; ?></h6>
                <canvas id="clicks"></canvas>
 <h6 class="text-center chart-labal">( <?php echo $period; ?> ) </h6>
              </div>
       </div>
         <div class="col-md-6">
         <div class=" home-box" style=" width:100%; height:100%;">
<h6 class="chart-unit"><?php echo $chart_click_unit; ?></h6>
                <canvas id="CTR"></canvas>
 <h6 class="text-center chart-labal">( <?php echo $period; ?> ) </h6>
              </div>
       </div>
       <div class="col-md-6">
         <div class=" home-box" style=" width:100%; height:100%;">
 <h6 class="chart-unit">k</h6>
                <canvas id="Revenue"></canvas>
<h6 class="text-center chart-labal">( <?php echo $period; ?> ) </h6>
              </div>
       </div>
     </div>
    
  </div>
  </div>

</div>
        
      </section>
			</section>
		</div>







  <script>
 
          var e = document.getElementById("all_period_report");
          var periodVal = e.options[e.selectedIndex].value;
          var impression = document.getElementById('impressions').value;
          var hour = document.getElementById('hour').value;
           
          if(periodVal==='today')
          {
              //var labels_val =['','12 AM','2 AM','4 AM','6 AM','8 AM','10 AM','12 PM','2 PM','4 PM','6 PM','8 PM','10 PM'];
                var labels_val = ['','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23' ];
              

          }
          else if(periodVal==='yesterday')
          {
             //var labels_val =['','12 AM','2 AM','4 AM','6 AM','8 AM','10 AM','12 PM','2 PM','4 PM','6 PM','8 PM','10 PM'];
                var labels_val = ['','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23' ];
          }
          else if(periodVal==='this_month')
          {
             //var labels_val=['','1-3 days','4-6 days','7-9 days','10-12 days','13-15 days','16-18 days','19-21 days','22-24 days','25-27 days','28-30 days'];
             var labels_val = ['','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30' ];
          }
 else if(periodVal==='specific')
          {
             //var labels_val=['','1-3 days','4-6 days','7-9 days','10-12 days','13-15 days','16-18 days','19-21 days','22-24 days','25-27 days','28-30 days'];
             var labels_val = ['','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30' ];
          }

          var Impression = document.getElementById('Impression').getContext('2d');
          var chart = new Chart(Impression, {

              // The type of chart we want to create
              type: 'line',
              // The data for our dataset
              data: {
                labels: labels_val,
                datasets: [{
                    label: "Impression",
                    backgroundColor: 'rgba(255,255,255,0.1)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [0,<?php echo $implode_new_array; ?>],
                    lineTension: 0,
                    borderWidth: '20px',
                    pointRadius: 1.5,
                    pointHoverRadius:1.5
                  }
                ],
              },
        
              // Configuration options go here
              options: {
                scales: {
                  xAxes: [{
                    gridLines: {
                      display: false
                    }
                  }]
                }
              }
            });

             var clicks = document.getElementById('clicks').getContext('2d');
             var chart = new Chart(clicks, {
             // The type of chart we want to create
              type: 'line',
              // The data for our dataset
              data: {
                labels: labels_val,
                datasets: [{
                    label: "clicks",
                    backgroundColor: 'rgba(200,200,200,0.1)',
                    borderColor: 'rgb(0, 128, 128)',
                    data: [0,<?php echo $implode_new_click; ?>],
                    lineTension: 0,
                    borderWidth: '20px',
                    pointRadius: 1.5,
                    pointHoverRadius:1.5
                  }
                ],
              },
        
              // Configuration options go here
              options: {
                scales: {
                  xAxes: [{
                    gridLines: {
                      display: false
                    }
                  }]
                }
              }
            });

            var CTR = document.getElementById('CTR').getContext('2d');
            
            var chart = new Chart(CTR, {
              // The type of chart we want to create
              type: 'line',
              // The data for our dataset "January", "February", "March", "April", "May", "June", "July", "aug", "sep", "oct", "nov", "dec"
              data: {
                labels: labels_val,
                datasets: [
                  {
                    label: "CTR",
                    backgroundColor: 'rgba(255,255,255,0.1)',
                    borderColor: 'rgb(0, 0,128)',
                    data: [0,2],
                    lineTension: 0,
                    borderWidth: '20px',
                    pointRadius: 1.5,
                    pointHoverRadius: 1.5
                  }
                ],
              },
        
              // Configuration options go here
              options: {
                scales: {
                  xAxes: [{
                    gridLines: {
                      display: false
                    }
                  }]
                }
              }
            });
            var Revenue = document.getElementById('Revenue').getContext('2d');
            
            var chart = new Chart(Revenue, {
              // The type of chart we want to create
              type: 'line',
              // The data for our dataset "January", "February", "March", "April", "May", "June", "July", "aug", "sep", "oct", "nov", "dec"
              data: {
                labels: labels_val,
                datasets: [
                  {
                    label: "Revenue",
                    backgroundColor: 'rgba(255,255,255,0.1)',
                    borderColor: 'rgb(0, 128, 0)',
                    data: [0,2],
                    lineTension: 0,
                    borderWidth: '20px',
                    pointRadius: 1.5,
                    pointHoverRadius: 1.5
                  }
                ],
              },
        
              // Configuration options go here
              options: {
                scales: {
                  xAxes: [{
                    gridLines: {
                      display: false
                    }
                  }]
                }
              }
            });
          

          </script>

<script type="text/javascript">
/*$('select').on('change', function() {
  var period_value = (this.value);
 // alert(period_value);
    $.ajax({
        url : "<?php echo base_url(); ?>users/dashboard",
        type : "GET",
        dataType : "json",
        data : {"period_value" : period_value},
        success : function(data) {
            // do something
            alert(data);
        },
        error : function(data) {
            // do something
        }
    });




});
*/



function all_period(period_value) {
        
         window.location = '<?php echo base_url(); ?>users/home?all_period=' + period_value;


};

function select_currency(period_value=null,currency_value) {
         
         window.location = '<?php echo base_url(); ?>users/home?all_period=' + period_value +'&currency=' +currency_value;


};

function periodFormSubmit() {
            var form = document.getElementById('period_preset').form;
            if (checkDates(form)) {
              form.submit();
            }
            return false;
        }
</script>


		<?php $this->load->view('admin_includes/footer');?>
<script type="text/javascript">
			$('#period_start').datepicker({
      
      format: 'yyyy-mm-dd',
      autoclose:true

    });
    $('#period_end').datepicker({
      format: 'yyyy-mm-dd',
      autoclose:true

    });
</script>
		



			