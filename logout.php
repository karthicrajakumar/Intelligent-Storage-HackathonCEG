<?php
session_start();
session_destroy();
setcookie("user",time()-3600);
$reurl = (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : null );
if($reurl == null)
{
	header('location:../index.php');

}
else {
header ("location: $reurl");
}
?>