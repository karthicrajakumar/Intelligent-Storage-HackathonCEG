<?php
	session_start();
	$user = $_SESSION['username'];

	$id = $_SESSION['id'];
	require_once('dbconnect.php');
	$con = dbconnect();
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
	<title>Hackathon- Project</title>
</head>
<body>
	<div class="container-fluid">
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
       	 <li><a href="#">Logged in as <?php echo $user ?></a></li>

      </ul>
     
     
    </div><!-- /.navbar-collapse -->
  <!-- /.container-fluid -->
</nav>
	
	<div class="jumbotron ">
		<h1>Upload Files</h1>
		<p>	
			<button class="btn btn-primary btn-lg"> <a href="file.php" style="color:white;"> Upload A File </a></button> 
			<button class="btn btn-danger btn-lg"> <a href="image.php" style="color:white;">Upload A Image </a></button>
			<button class="btn btn-warning btn-lg"> Upload an Audio file</button>

		</p>

	</div>
	<div class="panel panel-primary">
		<div class="panel-heading">
			<h2>My Files and Images</h2>
		</div>
		<div class="panel-body">
			<?php
				$query = mysqli_query($con, "SELECT * FROM file where id = '$id'");
				//$r = mysqli_num_rows($query);
				while($result = mysqli_fetch_assoc($query))
				{
					echo $result['name']; ?> 
					<button calss="btn btn-danger"><a href="delete.php?fid=<?php echo $result['fid'] ?>">Delete </a></button>
					<button calss="btn btn-danger"><a href="edit.php?fid=<?php echo $result['fid'] ?>">edit </a></button><br>

					 <?php

				}
				$query = mysqli_query($con, "SELECT * FROM files where uid = '$id'");
				//$r = mysqli_num_rows($query);
				while($result = mysqli_fetch_assoc($query))
				{
					echo $result['name']; ?> 
					<button calss="btn btn-danger"><a href="delete-i.php?fid=<?php echo $result['fid'] ?>">Delete </a></button><br>
					

					 <?php

				}


			?>
		</div>
	</div>
	

	</div>

	
	<!--Google JQuery-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</body>
</html>