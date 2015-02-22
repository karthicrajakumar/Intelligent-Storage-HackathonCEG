 <?php
session_start();
$user = $_SESSION['username'];
$id = $_SESSION['id'];
require_once('dbconnect.php');
$con = dbconnect();
$fid = $_GET['fid'];
$q = mysqli_query($con, "SELECT * from file WHERE  fid= '$fid' and id = '$id'");
$q = mysqli_fetch_array($q);
$name= $q['name'];
$fh = fopen($name,'r');
$data = fread($fh,filesize($name));
fclose($fh);
?>
<form action="edit-f.php?fid=<?php echo $fid ?>" method="get" >

<input type="text" value="<?php echo $data; ?>" style="width:500px;height:200px" name="text">
<input type="text" value="<?php echo $fid ?>" style="display:none" name="fid">
<input type="submit" value="edit">
</form>
<?php 
 ?>