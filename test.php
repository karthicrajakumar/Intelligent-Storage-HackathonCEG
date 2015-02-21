<?php
	
	$r = exec('python test.py',$output,$ret_code);
	echo $output[0];
?>