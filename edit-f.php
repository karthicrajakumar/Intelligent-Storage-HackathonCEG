 <?php
session_start();
$user = $_SESSION['username'];
$id = $_SESSION['id'];
require_once('dbconnect.php');
$con = dbconnect();
$fid = $_GET['fid'];
$text = $_GET['text'];

$q = mysqli_query($con, "SELECT * from file WHERE fid= '$fid' and id = '$id'");

$q = mysqli_fetch_array($q);
$name= $q['name'];
$name = $name . $id;
$newfile = fopen($name,"w");
fwrite($newfile,$text);
fclose($newfile);

$query= mysqli_query($con,"SELECT * from file ");
//$query = mysqli_fetch_array($query);

while($query = mysqli_fetch_assoc($query))
{
	$q = $query['name'];
	//echo $q;
	
	$result = exec("./txt $name $q ");
	echo $result;
	if($result == 1){
		echo "We will not insert";
		echo "We Will change your Path";
		mysqli_query($con,"INSERT INTO file values ('','$q','$id')"); ?>
		<button class="btn btn-lg btn-primary"> <a href="<?php echo $q ?>"> View file </a></button>
		<?php
		break;
	}
}
if($result == 0){
	//echo "abcd";
	mysqli_query($con,"INSERT INTO file values ('','$name','$id')");


?> <button class="btn btn-lg btn-primary"> <a href="<?php echo $name ?>">View File </a> </button><?php
	}


?>