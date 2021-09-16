<?php
    session_start();
    error_reporting(0);
    include_once('../database/db_connection.php');

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
                    $cnt_ofcourse=$cnt_ofcourse+1;}
    }else {   
        $output .='<div class="alert alert-warning" role="alert">
                      NO COURSE
                </div>
              </tr>';    
        }

        $output .='</table></div>
              </div>';
echo $output;
?>


                         





                      

						  
			
                      
        