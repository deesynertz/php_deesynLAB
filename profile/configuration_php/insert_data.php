<?php
	include_once('../../database/db_connection.php');

	session_start();
	error_reporting(0);


	//==========INSERT DATA TO THE DATABASE==========//


	
	    if(isset($_POST['actions_all']) && $_POST['actions_all']=='register') {

        $users = validateRegForm();
        
        $reg_no    =  $users['reg_no'];
        $full_name =  $users['full_name'];
        $email     =  $users['email'];
        $user_name =  $users['user_name'];
        $cpassword =  $users['cpassword'];
        $dfimage   =  "default.jpg";
        $user_type =  "1";
            
        save_user($reg_no,$full_name,$email,$user_name,$cpassword,$dfimage,$user_type);
        
    }		

 ?>