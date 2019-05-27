<?php

$Login_description = 'Admin';
$title_for_layout = 'Adserver'
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php echo $title_for_layout;?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
        type="text/css" />
    <!-- Theme style -->
    <link href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css">
    <!-- iCheck -->
    <link href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css" rel="stylesheet" type="text/css">

</head>

<body class="login-page">
    <nav class="navbar navbar-default" style="margin-bottom:0px;">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="" href="<?php echo base_url();?>"><img src="<?php echo base_url();?>assets/img/logo/logo.png"
                        alt="" srcset=""></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false">Login <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url();?>publisher/login">Publisher</a></li>
                            <li><a href="<?php echo base_url();?>advertiser/login">Advertiser</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo base_url();?>registration">Sign Up</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>