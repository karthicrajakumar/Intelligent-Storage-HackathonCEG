<?php
session_start();
	ob_start();
	$reurl = $_SERVER['HTTP_REFERER'];
	if(isset($_SESSION['username']))
	{
		header("location:index.php");
	}
	require_once('dbconnect.php');
	$con = dbconnect();
	$username=  (isset($_POST['username']) ? $_POST['username'] : null);
	$password= (isset($_POST['password']) ? $_POST['password'] : null);
	
	// MYSQL INJECTION PREVENTION
	$username = stripslashes($username);
	$password = stripslashes($password);
	$username = mysqli_real_escape_string($con,$username);
	$password = mysqli_real_escape_string($con,$password);
	

	$password = md5($password);
	// Checking The Data 
	$sql="SELECT * FROM users WHERE username='$username' and password='$password'";
	$result = mysqli_query($con,$sql);
	$count = mysqli_num_rows($result);


	//Loggin the User in
	if($count ==1 ) {
		$sql=mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
		$id = mysqli_fetch_array($sql);
		$id= $id['id'];
		$hour=time()+3600;
		$_SESSION['password']=$password;
		$_SESSION['username']=$username;
		$_SESSION['id']= $id;
		setcookie("user",time()+3600);
		?> <script> alert("logged in") </script> <?php
		header("location: $reurl");

		}
	else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- META TAGS -->
	<meta charset="UTF-8"/>
	 <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8"/>
	<meta name="description" content="Buy/Sell  Second hand Books For Free Within your College" />
    <meta name="keywords" content="Buktab, second hand books for free, svce buktab, book trade, anna university free books , "/>
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<!-- FAVICON-->
    <link rel="shortcut icon" href="css/favicon.ico" type="image/x-icon">
	<link rel="icon" href="css/favicon.ico" type="image/x-icon">
	<!--CSS Files-->
	<link rel="stylesheet" href="css/style.css" type=''>
	<!-- CDN'S-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css"/>
	<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	<!--Fonts-->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans|Lobster' rel='stylesheet' type='text/css'>
	<title>Login</title>
</head>
<body>
	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Hackathon Project</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home<span class="sr-only">(current)</span></a></li>
        <li><a href="#"> Upload Files</a></li>
       	<li><a href="#"> Login</a></li>
      </ul>
     
     <br>
    </div><!-- /.navbar-collapse -->
    <br>
    <div class="well row">
			<form action="login.php" role="form" method="post">
				<div class="form-group">
					<label for="username"> Username </label>
					<input type="text" class="form-control" id="username" name="username" placeholder="Enter Username" required> 

				</div>
				<div class="form-group">
					<label for="username"> Password </label>
					<input type="password" class="form-control" id="pass" name="password" placeholder="Enter Password" required>

				</div>
				<input type="submit" class="btn btn-primary btn-lg " value="Login"> 
				
				<a href="forgot-password.php"><small> Forgot Password ? </small> </a><br><br>
				<a href="register.php"> <button type="button" class="btn btn-danger">Register on Buktab</button> </a>
				
			</form>
		</div>
    <br>
    <?php
    	}
    ?>
</body>
</html>