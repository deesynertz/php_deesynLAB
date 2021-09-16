<?php
	include_once('db_connection.php');

	session_start();
	error_reporting(0);


if($_POST['action'] == 'chech_username'){
	$message ='';
	$chech_username = $_POST['username']

	$select = "SELECT * FROM  tbluser WHERE username ='".$chech_username."'";
    $query = $dbh->prepare($select);
    $query->execute();

    if ($query->rowCount() > 0) {
    	$message = "<div class='alert alert-danger'>User Taken</div>";
    } else {
    	$message = "<div class='alert alert-success'>Use it</div>";
    }
    

     echo $message;

}


?>