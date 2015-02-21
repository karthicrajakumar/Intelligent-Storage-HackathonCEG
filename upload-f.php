<?php
session_start();
$user = $_SESSION['username'];
$id = $_SESSION['id'];
require_once('dbconnect.php');
$con = dbconnect();
if( $_FILES['file']['name'] != "" )
{	           $name = $_FILES['file']['name'];

   copy($_FILES['file']['name'], "/var/www/html/hackathon/.$name" ) or 
           die( "Could not copy file!");
           //$name = $_FILES['file']['name'];

   //$query= mysqli_query($con,"INSERT INTO files values ('','$name','$id')");

}
else
{
    die("No file specified!");
}
$name = $_FILES['file']['name'];

$size = $_FILES['file']['size'];
$type = $_FILES['file']['type'];  
$name = $name;

$query= mysqli_query($con,"SELECT * from file ");
//$query = mysqli_fetch_array($query);

while($query = mysqli_fetch_assoc($query))
{
	$q = $query['name'];
	//echo $q;
	
	$result = exec("./txt $name $q ");
	//echo $result;
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
	mysqli_query($con,"INSERT INTO file values ('','$name','$id')");


?> <button class="btn btn-lg btn-primary"> <a href="<?php echo $name ?>">View File </a> </button><?php
	}




//PUSH INTO THE DB  FINALLY ! 
//require_once('dbconnect.php');
/*	$con = dbconnect();
	$query= mysqli_query($con,"INSERT INTO files values ('")
*/
?>
