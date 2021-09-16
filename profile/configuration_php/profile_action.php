<?php
	include_once('../../database/db_connection.php');
	include_once('../../database/database_php_clases.php');


	session_start();
	error_reporting(0);

if($_POST['action'] == 'unseen_msg'){

    $to_user_ID = $_SESSION['regnumber'];
    $ststus = "1";
    $unseen_notfy = "SELECT * FROM  tblchat_message WHERE to_user_ID=:regno AND status =:stst GROUP BY from_user_ID";
    $notfy_query = $dbh->prepare($unseen_notfy);
    $notfy_query-> bindParam(':regno', $to_user_ID, PDO::PARAM_STR);
    $notfy_query-> bindParam(':stst', $ststus, PDO::PARAM_STR);
    $notfy_query ->execute();

    $results = $notfy_query->fetchAll(PDO::FETCH_OBJ);
		
		$output_msg ='';
		if($count_notfy = $notfy_query->rowCount()){
            
        $output_msg .='<a href="#" class="dropdown-toggle" data-toggle="dropdown" >
                <i class="fa fa-envelope-o"></i><span class="label label-success">'.$count_notfy.'</span></a>
            <ul class="dropdown-menu">
              <li class="header">You have '.$count_notfy.' messages</li>
              <li><ul class="menu">';
            
            foreach($results as $result){
                
                $from_user_ID = $result->from_user_ID;
                $chat_sms = $result->chat_sms;
                $last_time = $result->last_time;

            
                
                $find_who = "SELECT fname,image FROM tbluser WHERE regnumber=:fromregno";
                $who_query = $dbh->prepare($find_who);
                $who_query-> bindParam(':fromregno', $from_user_ID, PDO::PARAM_STR);
                $who_query ->execute();
                $who_results = $who_query->fetchAll(PDO::FETCH_OBJ);
                
                foreach($who_results as $who_result){
                    
                    $output_msg .='<li>
                            <a href="#">
                              <div class="pull-left">
                                <img src="../dist/img/'.$who_result->image.'" class="img-circle" alt="User Image">
                              </div>
                              <h4>'.$who_result->fname.'
                                <small><i class="fa fa-clock-o"> '.date_break($last_time).'</i></small>
                              </h4>
                            </a>
                          </li>';   
                }
            }
             $output_msg .='</ul></li><li class="footer"><a href="index.php?contact">See All Messages</a></li></ul>';
            
		}else{
            $output_msg .='<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-envelope-o"></i><span class="label label-success"></span></a>';  
        }
	echo $output_msg;
}


if ($_POST['action'] == 'fetch_user_profile') {

	$output ='';
	$user_number = $_POST['to_user_id'];

	$sql_user = "SELECT * FROM  tbluser WHERE regnumber =:regnumber";
	$query= $dbh -> prepare($sql_user);
	$query-> bindParam(':regnumber', $user_number, PDO::PARAM_STR);
	$query-> execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	if($query->rowCount() > 0){
		foreach($results as $result){

			$output ='<div class="box box-primary">
                      <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="../dist/img/'.$result->image.'" alt="" style="height:90px;width:90px;">
                        <h3 class="profile-username text-center">@'.$result->username.'<br>
                        <small class="text-muted text-center">'.user_skills($dbh,$result->regnumber).'</small></h3>
                        <p>'.$result->fname.'</p>
                        <p>'.$result->bio.','.$result->email.'</p>
                        <ul class="list-group list-group-unbordered">
                          <li class="list-group-item">
                            <b>Followers</b> <a class="pull-right">'.$result->follower_number.'</a>
                          </li>
                          <li class="list-group-item">
                            <b>Following</b> <a class="pull-right">'.following_people($dbh,$result->regnumber).'</a>
                          </li>
                          <li class="list-group-item">
                            <b>Post</b> <a class="pull-right"></a>
                          </li>
                        </ul>
                        <div class="row">
                            '.Follow_unfollow_button($dbh,$_SESSION['regnumber'],$user_number).'
                            <button class="btn btn-primary btn-block pull-right start_chart" data-touserid="'.$result->regnumber.'" data-tousername="'.$result->username.'" data-userimage="'.$result->image.'" data-userstatus="'.$status_number.'"><b>Message</b></button>
                        </div>
                      </div>
                    </div>';
        }
	}
	echo $output;
}


if($_POST['action'] == 'follow'){

	$query = "INSERT INTO tblfollow(sender_id,receiver_id ) VALUES ('".$_SESSION['regnumber']."', '".$_POST['receiver_id']."')";
	$startment = $dbh->prepare($query);
	if($startment->execute()){

		$sub_query = "UPDATE tbluser SET follower_number = follower_number + 1 WHERE regnumber = '".$_POST['receiver_id']."'";
		$startment = $dbh->prepare($sub_query);
		$startment->execute();
	}
}

if($_POST['action'] == 'unfollow'){

	$query = "DELETE FROM tblfollow WHERE sender_id = '".$_SESSION['regnumber']."' AND receiver_id = '".$_POST['receiver_id']."'";

	$startment = $dbh->prepare($query);
	if($startment->execute()){

		$sub_query = "UPDATE tbluser SET follower_number = follower_number - 1 WHERE regnumber = '".$_POST['receiver_id']."'";
		$startment = $dbh->prepare($sub_query);
		$startment->execute();
	}
}


if($_POST['my_follower'] == 'action'){

	$follower = my_following($dbh,$_SESSION['regnumber']);
	echo $follower;
}

if($_POST['my_following'] == 'action'){

	$following = my_followers($dbh,$_SESSION['regnumber']);
	echo $following;
}



if($_POST['action'] == "chart_history"){

	$output ='';
	$reciver_id = $_POST['reciver_id'];
	$sender_id =  $_SESSION['regnumber'];

	$query = "SELECT * FROM tblchat_message WHERE (from_user_ID = '".$sender_id."' AND 
	to_user_ID = '".$reciver_id."') OR (from_user_ID = '".$reciver_id."' 
	AND to_user_ID = '".$sender_id."')";


	$statement = $dbh->prepare($query);
	$statement->execute();
	$results = $statement->fetchAll(PDO::FETCH_OBJ);

	foreach($results as $result)
	{


	 	if($result->from_user_ID ==$_SESSION['regnumber']){
	        
	        $output .= '
	        <div class="direct-chat-msg right">
	            <div class="direct-chat-info clearfix">
	                     
	                  </div>
	                  <img class="direct-chat-img" src="../dist/img/'.$_SESSION['img_log'].'" alt="user image">
	            <div class="direct-chat-text">'.$result->chat_sms.'
	          </div>
	        </div>';
	 	
				
		}else{

	        $select = "SELECT image FROM tbluser WHERE regnumber = '".$reciver_id."'";
	        $statement_query = $dbh->prepare($select);
	        $statement_query->execute();
	        $statement_results = $statement_query->fetchAll(PDO::FETCH_OBJ);

	        foreach ($statement_results as $statement_result) {
	          	$output .= '<div class="direct-chat-msg">
	              		<div class="direct-chat-info clearfix">

	                    </div>
	                    <img class="direct-chat-img" src="../dist/img/'.$statement_result->image.'" alt="user image">
	                  <div class="direct-chat-text">'.$result->chat_sms.'
	                </div>
	              </div>';
	    	}    
		}
	}

	echo $output;

}


if($_POST['action']== "contact"){
	$contact ='';

	$user_number = $_SESSION['regnumber'];
	$sql_user = "SELECT * FROM  tbluser u WHERE u.regnumber !=:regnumber";
	$query= $dbh -> prepare($sql_user);
	$query-> bindParam(':regnumber', $user_number, PDO::PARAM_STR);
	$query-> execute();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	if($query->rowCount() > 0){
		foreach($results as $result){

			$status ='';
			$current_timestamp = strtotime(date('Y-m-d H:i:s') . '-10 second');
			$current_timestamp = date('Y-m-d H:i:s',$current_timestamp);
			
			$user_last_activity = fetch_user_last_activity($result->regnumber,$dbh);
			
			if($user_last_activity > $current_timestamp){

				$status_number = 'Online';
				$status .='
					<small><span class="text text-success fa fa-circle"> Online</span></small>';
				
			}else{

				$status_number = '';
				$statu ='
					<small><span class="text">offline</span></small>
				';


			}
			$user_image = $result->image;
            
			$contact .='
            <div class="direct-chat">
                  <ul class="contacts-list">
                      <li class="">
                          <a href="#">
                              <img class="contacts-list-img" src="../dist/img/'.$user_image.'" alt="User Image" style="height:32px;width:32px;">
                              <div class="contacts-list-info">
                                  <span class="contacts-list-name">
                                      <small class="contacts-list-date pull-right">&nbsp</small>
                                  </span>
                                  <span class="contacts-list-msg friend_profile" style="cursor: pointer"  data-touserid="'.$result->regnumber.'" data-tousername="'.$result->username.'" data-userimage="'.$result->image.'" data-userstatus="'.$status_number.'">@'.$result->username.'&nbsp;&nbsp;'.count_unseen_message($result->regnumber,$_SESSION['regnumber'], $dbh).'&nbsp;&nbsp;'.fetch_is_type_status($result->regnumber,$dbh).'<br>&nbsp;<small class="contacts-list-date">'.$status.'</small></span>
                                  
                              </div>
                          </a>
                      </li>
                  </ul>
              </div>
			';
		}

	}

	echo $contact;
}


if($_POST['action'] == 'send_message'){
	$data = array(
				 ':to_user_id'  => $_POST['reciverId'],
				 ':from_user_id'  => $_SESSION['regnumber'],
				 ':chat_message'  => $_POST['messagetxt'],
				 ':status'   => '1');

	$query = "INSERT INTO tblchat_message(to_user_ID, from_user_ID, chat_sms, status) 
	VALUES (:to_user_id, :from_user_id, :chat_message, :status)";
	$statement = $dbh->prepare($query);

	if($statement->execute($data))
	{
	  $acess = fetch_user_chat_history($_SESSION['regnumber'], $_POST['to_user_id'], $dbh); 
	}
	
	echo $acess;
}


//==========UPDATE DATA TO THE DATABASE==========//
$update_activity = "UPDATE tbllogin_detail SET last_activity = now() WHERE ID='".$_SESSION['login_detail_ID']."'";
$update_activity_query= $dbh -> prepare($update_activity);
$update_activity_query-> execute();

$is_typing = "UPDATE tbllogin_detail SET is_type = '".$_POST['is_type']."' WHERE ID = '".$_SESSION['login_detail_ID']."' ";
$is_typing_query = $dbh->prepare($is_typing);
$is_typing_query->execute();

$update_sta = "UPDATE tblchat_message SET status = '0' WHERE from_user_ID = '".$reciver_id."' AND to_user_ID = '".$sender_id."' AND status = '1'";

$update_sta_query = $dbh->prepare($update_sta);
$update_sta_query->execute();



/*================ FUNCTION PARTS ======================*/
function my_following($dbh,$my_id){
	$query = "SELECT * FROM tblfollow WHERE receiver_id = '".$my_id."'";
	$startment = $dbh->prepare($query);
	$startment->execute();
	$total_row = $startment->rowCount();
	$output = $total_row;
	return $output;
}

function my_followers($dbh,$my_id){
	$query = "SELECT * FROM tblfollow WHERE sender_id = '".$my_id."'";
	$startment = $dbh->prepare($query);
	$startment->execute();
	$total_row = $startment->rowCount();
	$output = $total_row;
	return $output;
}

function user_skills($dbh,$user_id){
	$skil = "SELECT skill_name,tblskills_user.skill_ID FROM tblskills,tblskills_user,tbluser WHERE  tblskills_user.skill_ID = tblskills.skill_ID AND tblskills_user.regnumber = tbluser.regnumber AND tbluser.regnumber=:regno";

	$skil_query = $dbh->prepare($skil);
	$skil_query-> bindParam(':regno', $user_id, PDO::PARAM_STR);
	$skil_query->execute();
	$skil_results=$skil_query->fetchAll(PDO::FETCH_OBJ); 

	if($skil_query->rowCount() > 0){
		foreach($skil_results as $skil_result){
			$output ='';
		    $output = '<span">'.$skil_result->skill_name.'</span>&nbsp;';
		}
	}

	return $output;
}

function following_people($dbh,$receiver_id){
	$query = "SELECT * FROM tblfollow WHERE sender_id = '".$receiver_id."'";
	$startment = $dbh->prepare($query);
	$startment->execute();
	$total_row = $startment->rowCount();
	$output = $total_row;
	return $output;
}


function Follow_unfollow_button($dbh,$sender_id,$receiver_id){
	$query = "SELECT * FROM tblfollow WHERE sender_id = '".$sender_id."' AND receiver_id = '".$receiver_id."'";
	$startment = $dbh->prepare($query);
	$startment->execute();
	$total_row = $startment->rowCount();
	$output = '';

	if($total_row > 0){

		$output = '<button type="button" name="follow_button" class="btn btn-default btn-block action_button" data-action="unfollow" data-sender_id="'.$sender_id.'" data-receiver_id="'.$receiver_id.'"> Following </button>';
		
	}else{

		$output = '<button type="button" name="follow_button" class="btn btn-primary btn-block action_button" data-action="follow" data-sender_id="'.$sender_id.'" data-receiver_id="'.$receiver_id.'"><small><i class="fa fa-plus"></i></small>  Follow</button>';

	}

	return $output;
}



?>