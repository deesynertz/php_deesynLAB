<?php
	session_start();
    unset($_SESSION['regnumber']);     
    unset($_SESSION['fulname_log']); 
    unset($_SESSION['email_log']); 
    unset($_SESSION['username_log']);
    unset($_SESSION['img_log']);
    unset($_SESSION['usertype']);
    unset($_SESSION['status']);
	session_destroy(); // destroy session
	header("location: login.php"); 
?>
