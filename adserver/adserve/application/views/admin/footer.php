<!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url();?>public/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js" type="text/javascript"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script type="text/javascript">
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="<?php echo base_url();?>public/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="<?php echo base_url();?>public/plugins/morris/morris.min.js" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url();?>public/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
    <!-- jvectormap -->
    <!--<script src="<?php echo base_url();?>public/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
    --><script src="<?php echo base_url();?>public/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url();?>public/plugins/knob/jquery.knob.js" type="text/javascript"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>public/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    <!-- datepicker -->
    <script src="<?php echo base_url();?>public/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="<?php echo base_url();?>public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
    <!-- Slimscroll -->
    <script src="<?php echo base_url();?>public/plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>public/plugins/fastclick/fastclick.min.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url();?>public/dist/js/app.min.js" type="text/javascript"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="<?php echo base_url();?>public/dist/js/pages/dashboard.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url();?>public/dist/js/demo.js" type="text/javascript"></script>

	<script>
	
	$("#email_form").submit(function(){
		var email			= $("#email").val();
		var sub				= $("#sub").val();
		var msg				= $("textarea#msg").val();
		if(email	== ""){
			$("#msg").text("please enter email id");
			return false;
		}
		if(sub	== ""){
			$("#msg").text("please enter subject");
			return false;
		}
		if(msg	== ""){
			$("#msg").text("please enter message");
			return false;
		}
	});
	
	
	$("#login_form").submit(function(){
		var email			=$("#email").val();
		var pass			=$("#password").val();
		if(email	== ""){
			$("#msg").text("please enter email");
			return false;
		}
		if(pass	== ""){
			$("#msg").text("please enter password");
			return false;
		}
	});
	
	$("#register_form").submit(function(){
		var fname			=$("#name").val();
		var lname			=$("#lname").val();
		var email			=$("#email").val();
		var pass			=$("#password").val();
		if(fname	== ""){
			$("#msg").text("please enter first name");
			return false;
		}
		
		if(lname	== ""){
			$("#msg").text("please enter last name");
			return false;
		}
		
		if(email	== ""){
			$("#msg").text("please enter email");
			return false;
		}
		if(pass	== ""){
			$("#msg").text("please enter password");
			return false;
		}
	});
	
	
	
	
	$("#advertiser_form, #publisher_form").submit(function(){
		$("#msg2").text("");
		var name			=$("#name").val();
		var lname			=$("#lname").val();
		var address			=$("#address").val();
		var city			=$("#city").val();
		var state			=$("#state").val();
		var email			=$("#email").val();
		var url				=$("#url").val();
		var company			=$("#company_name").val();
		var phone			=$("#phone").val();
		if(name	== ""){
			$("#msg").text("please enter name");
			return false;
		}
		
		if(lname	== ""){
			$("#msg").text("please enter last name");
			return false;
		}
		
		if(address	== ""){
			$("#msg").text("please enter address");
			return false;
		}
		if(city	== ""){
			$("#msg").text("please enter city");
			return false;
		}
		if(state	== ""){
			$("#msg").text("please enter state");
			return false;
		}
		
		
		if(company	== ""){
			$("#msg").text("please enter company");
			return false;
		}
		if(url	== ""){
			$("#msg").text("please enter url");
			return false;
		}
		
		if(email	== ""){
			$("#msg").text("please enter email");
			return false;
		}
		
		if(phone	== ""){
			$("#msg").text("please enter phone");
			return false;
		}
		/*var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		if(!re.test(email)){
			$("#msg").text("email not valid");return false;
		}
		var re = 	/^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
		if(!re.test(url)){
			$("#msg").text("url is not valid");return false;
		}*/
	


		$("#msg").text("");

	}) 
		$(".delete").click(function(){
			var id=$(this).attr('id');
			if(confirm("Are you sure to delete ")){
				$.ajax({
					url:'deleteadvertiser',
					data:'id='+id,
					type:'post',
					success:function(response){
						$("#row_"+id).hide();
					}
				
				});
			}
		});
				
	</script>
  </body>
</html>