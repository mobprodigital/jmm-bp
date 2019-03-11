<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Profile</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/animate.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body>
	<div class="container">
		<h2>Hello <?php echo $this->session->userdata("name");?></h2>
		<a href="profile">Profile</a>
		<a href="logout">Logout</a>
	</div>
</body>
</html>