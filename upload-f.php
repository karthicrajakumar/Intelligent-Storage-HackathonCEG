<?php
session__start();
$user = $_SESSION['username'];
$id = $_SESSION['id'];
if( $_FILES['file']['name'] != "" )
{	$name = $_FILES['file']['name'];
   copy($_FILES['file']['name'], "/var/www/html/hackathon/files/.'$name'" ) or 
           die( "Could not copy file!");
}
else
{
    die("No file specified!");
}
$name = $_FILES['file']['name'];
$size = $_FILES['file']['size'];
$type = $_FILES['file']['type'];  



require_once('dbconnect.php');
	$con = dbconnect();
	$query= mysqli_query($con,"INSERT INTO files values ('")

?>
