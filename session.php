<?php 
if (isset($_SESSION['timestamp']) && $_SESSION['timestamp']!="" && (time() - $_SESSION['timestamp'] > 600)) {
        session_unset();
        header("Location: portal.php");
        exit;
    }

    $_SESSION['timestamp'] = time();
     ?>