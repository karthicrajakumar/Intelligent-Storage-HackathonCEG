<?php

function dbconnect(){

	$sql=mysqli_connect('localhost','root','delta2345','hack');
		mysqli_connect('localhost','root','delta2345','hack');
		date_default_timezone_set("Asia/Kolkata");
		return $sql;
}
?>