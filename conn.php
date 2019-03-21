<?php
	$user = 'cringyuser';
	$pass = 'weirdpassword';
	$db = 'trovelnama';
	$conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect to server".$db);
?>