<?php 
	$date = date('Y-m-d');
	echo date('Y-m-d',strtotime('+1 days',strtotime(date('Y-m-d'))));
 ?>