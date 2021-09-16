<?php
	include_once('../database/db_connection.php');
  include_once('../database/database_php_clases.php');

	session_start();
	error_reporting(0);


	/*we want to count unseen mssage*/ 

if($_POST['action'] == 'unseen_msg'){

    $unseen_notfy = "SELECT * FROM  tblchat_message WHERE to_user_ID='".$_SESSION['regnumber']."' AND status = 1 GROUP BY from_user_ID ORDER BY last_time DESC";
    $notfy_query = $dbh->prepare($unseen_notfy);
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

                  $break_name = explode(" ", $who_result->fname);
                  
                    
                    $output_msg .='<li>
                            <a href="#">
                              <div class="pull-left">
                                <img src="dist/img/'.$who_result->image.'" class="img-circle" alt="User Image">
                              </div>
                              <h4>'.$break_name[0].'
                                <small><i class="fa fa-clock-o"> '.date_break($last_time).'</i></small>
                              </h4>
                              <p>'.$result->chat_sms.'</p>
                            </a>
                          </li>';   
                }
            }
             $output_msg .='</ul></li><li class="footer"><a href="profile/index.php?contact">See All Messages</a></li></ul>';
            
    }else{
            $output_msg .='<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><i class="fa fa-envelope-o"></i><span class="label label-success"></span></a>';  
        }
  echo $output_msg;
}




if($_POST['action'] == 'unseen_notfication'){

    $notifications = "SELECT userfile_ID,tbluser_file.fileID,tblfile.fileID,filename,dateUp,ID  FROM  tbluser_file  JOIN tblfile ON tbluser_file.fileID = tblfile.fileID WHERE read_in = 1 ORDER BY dateUp  DESC";
    $notfy_query = $dbh->prepare($notifications);
    $notfy_query ->execute();

    $results = $notfy_query->fetchAll(PDO::FETCH_OBJ);
    
    $output ='';
    if($count_notfy = $notfy_query->rowCount()){
            
        $output .='<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                    <span class="label label-warning">'.$count_notfy.'</span>
                  </a>
                  <ul class="dropdown-menu">
                    <li class="header">You have '.$count_notfy.' notifications</li>
                    <li>
                    <ul class="menu">';
            
            foreach($results as $result){
                
                $regnumber  = $result->regnumber;
                $filename   = $result->$filename;
                $dateUp     = $result->dateUp;
                $output .='<li>
                            <a href="#">
                              <i class="fa fa-warning text-yellow"></i><span class="notfy_me" data-file_user_id="'.$result->regnumber.'" data-file_ID="'.$result->ID.'" data-file_fileID="'.$result->fileID.'" data-file_userfile_ID="'.$result->userfile_ID.'">'.$result->filename.'</span>
                            </a>
                          </li>';   
                
            }
             $output .='</ul><li class="footer"><a href="download_manager.php">View all</a></li></ul>';
            
    }else{
            $output .='<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-bell-o"></i>
                        </a>';  
        }
  echo $output;
}


if($_POST['action'] == 'all_courses'){
  $output = '';

  $sql_ofcourse = "SELECT tblcourse.ID,tblcourse.course_code,tblcourse.coursename FROM tblcourse";
  $query_ofcourse = $dbh->prepare($sql_ofcourse);
  $query_ofcourse->execute();
  $results_ofcourse=$query_ofcourse->fetchAll(PDO::FETCH_OBJ);
  $cnt_ofcourse=1;
  $data = $query_ofcourse->rowCount();

  $output .='<div class="box box-widget widget-user-2">
                      <div class="box box-default collapsed-box box-solid">       
                      <table class="table table-striped">
                        <tr>
                        <th>#</th>
                        <th>Course Name</th>
                        </tr>';

  if($query_ofcourse->rowCount() > 0){
    foreach($results_ofcourse as $result_ofcourse){ 
        $output .=' 
                <tr>
                  <td>'.$cnt_ofcourse.'</td>
                  <td><a href="view_selected_course.php?viewfiles='.$result_ofcourse->ID.'" id="viewfiles">'.$result_ofcourse->coursename.'</a></td>';
                      $cnt_ofcourse=$cnt_ofcourse+1;
      }
    }else {   
        $output .='<div class="alert alert-warning" role="alert">
                        NO COURSE
                  </div>
                </tr>';    
    }
        $output .='</table></div></div>';
        
    echo $output;
}


?>