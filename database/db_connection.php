<?php 
// DB credentials.
	define('DB_HOST','');
	define('DB_USER','');
	define('DB_PASS','');
	define('DB_NAME','');
// Establish database connection.
	try
	{
		$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USER, DB_PASS,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4'"));
        
        //$connection = 'conected';
	}
	catch (PDOException $e)
	{
		exit("Error: " . $e->getMessage());
        
        //$connection ='Not connected';
	}



	date_default_timezone_set('Africa/Nairobi');

	function fetch_user_last_activity($user_id, $dbh){
		$user_last = "SELECT * FROM tbllogin_detail WHERE user_ID= '$user_id' 
		ORDER BY last_activity DESC LIMIT 1";
		
		$activity_query = $dbh->prepare($user_last);
		$activity_query ->execute();
		$activity_results = $activity_query->fetchAll(PDO::FETCH_OBJ);
		foreach($activity_results as $activity_result){
			return $activity_result->last_activity;
		}
	}

	/*we want to count unseen mssage*/ 
    function count_unseen_message($from_user_id, $to_user_id, $dbh){
		$unseen = "SELECT * FROM  tblchat_message WHERE from_user_ID='$from_user_id' AND to_user_ID ='$to_user_id' AND status = '1'";

		$unseen_query = $dbh->prepare($unseen);
		$unseen_query ->execute();
		$count_query = $unseen_query->rowCount();

		$output ='';
		if($count_query > 0){
			$output ='<span class="label label-success pull-right">'.$count_query.'</span>';
		}

		return $output;
    }


    function fetch_is_type_status($user_id,$dbh){
    	
    	$typing = "SELECT is_type FROM  tbllogin_detail WHERE user_ID='".$user_id."'";

     	$typing_query = $dbh->prepare($typing);
	 	$typing_query ->execute();
	 	$typing_results=$typing_query->fetchAll(PDO::FETCH_OBJ);

	 	foreach ($typing_results as $typing_result){

	 		if ($typing_result->is_type == 'yes') {

	 			$output ='<small><em><span class="text-muted">Typing . . .</span></em></small>';
	 			return $output;
	 		}

	 		

    	}
    }



?>


