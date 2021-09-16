<?php
    session_start();
    error_reporting(0);
    include_once('../database/db_connection.php');


	    $regnumber = $_POST['getreg_no'];
	    $select = "SELECT * FROM tbluser WHERE regnumber =:reg";
	    $statment_query = $dbh->prepare($select);
	    $statment_query-> bindParam(':reg', $regnumber, PDO::PARAM_STR);
	    $statment_query-> execute();

	    if ($statment_query->rowCount() > 0) {
	      echo '<p class="text text-danger">Registration Exist</p>';
	    }

	    
 

 ?>