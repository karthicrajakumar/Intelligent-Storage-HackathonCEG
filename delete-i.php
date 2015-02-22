 <?php
 session_start();
$user = $_SESSION['username'];
$id = $_SESSION['id'];
require_once('dbconnect.php');
$con = dbconnect();
$fid = $_GET['fid'];
$q = mysqli_query($con, "SELECT * from files WHERE  fid= '$fid' and uid = '$id'");
$q = mysqli_fetch_array($q);
$name= $q['name'];
$query = mysqli_query($con,"DELETE FROM files WHERE fid= '$fid' and uid = '$id'");
//echo $name;
$query = mysqli_query($con,"SELECT * FROM files WHERE name = '$name'");
$r = mysqli_num_rows($query);

if($r == 0)
{	
	echo $name;
	unlink($name);
}

//if()
header('location: index.php');



 ?>