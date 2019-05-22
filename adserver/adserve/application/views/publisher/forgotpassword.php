
<?php
error_reporting(0);
$this->load->view('login/header');?>
<div style="margin: 1%;">   
<?php if(isset($msg)){echo $msg;}?>
<form action="<?php echo base_url();?>login/forgotPassword" method="post">

<input type="email" name="email" required>
<input type="submit" value="submit" name="submit">
</div>
</form>

  </body>
</html>