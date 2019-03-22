<?php
	session_start();
	session_unset();
    header("Location: portal.php");
?>