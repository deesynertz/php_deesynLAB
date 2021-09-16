<?php


/*FUNCTIONS*/
/*DISPLAY ALL COURSE*/
function display_course($dbh){
    $sql = "SELECT * FROM tblcourse";
    $query = $dbh->prepare($sql);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
						
    if($query->rowCount() > 0)
    {
        foreach($results as $result)
        {  ?>
            <option value="<?php echo htmlentities($result->ID); ?>"><?php echo htmlentities($result->course_code); ?></option>
        <?php }
    }
    
}  

function member_sice($member_sice) {

$member_array = explode("-", $member_sice);
$year   = $member_array[0];
$month  = $member_array[1];
$day    = $member_array[2];

$fmonth  = newMonthFormat($month);
$fday    = newDateFormat($day);

return $member_date = $day.$fday.' '.$fmonth.", ".$year;

}


function whenDatasent($dateUp){

  $Datasent_array = explode(" ", $dateUp);
  $Datasent = explode("-", $Datasent_array[0]);
  $year   = $Datasent[0];
  $month  = $Datasent[1];
  $day    = $Datasent[2];

  $fmonth  = newMonthFormat($month);
  $fday    = newDateFormat($day);

  return $Datasent_result = $day.$fday.' '.$fmonth.", ".$year;
}


    
function date_break($timestamp){
  $timestamparray = explode(" ", $timestamp);

  $date = explode("-", $timestamparray[0]);
  $time = explode(":", $timestamparray[1]);

  $year     = $date[0];
  $month    = $date[1];
  $day      = $date[2];


  $hour	=	$time[0];
  $min	=	$time[1];
  $sec 	=	$time[2];


  $fmonth  = newMonthFormat($month);
  $fday    = newDateFormat($day);

  $datcompare = date("d");
  $monthcompare = date("m");

  $diff_time = ($to_time - $hour);
  $diff_date = ($datcompare - $day);

  if($monthcompare == $month && $diff_date == 1 || $diff_date == -30 || $diff_date == "-29" || 
  	$diff_date == "-28" || $diff_date == "-27"){

  	$info_day = "yestaday";

  } else if($diff_date >="-26"  || $diff_date > 1){

  	$info_day = $day.$fday.' '.$fmonth;
  }

  return $info_day;
}


function newDateFormat($day){
  if ($day == 1 || $day == 21 || $day == 31) {
    $sup = "<sup>st</sup>";

  }else if($day == 2 || $day == 22){
    $sup = "<sup>nd</sup>";

  }else if($day == 3 || $day == 23){
    $sup = "<sup>rd</sup>";
  }else{
    $sup = "<sup>th</sup>";
  }
  return $sup;
}

function newMonthFormat($month) {
  if($month == 1){
    $mnth = Jan;
  }else if($month == 2){
    $mnth = Feb;
  }else if($month == 3){
    $mnth = Mar;
  }else if($month == 4){
    $mnth = Apr;
  }else if($month == 5){
    $mnth = May;
  }else if($month == 6){
    $mnth = Jun;
  }else if($month == 7){
    $mnth = Jul;
  }else if($month == 8){
    $mnth = Aug;
  }else if($month == 9){
    $mnth = Sep;
  }else if($month == 10){
    $mnth = Oct;
  }else if($month == 11){
    $mnth = Nov;
  }else {
    $mnth = Des;
  }

  return $mnth;
}




/*OTHER  RETRIVAL DATA*/

/*=====================================  all pages.php   ===============================================*/

#RETRIVE USER PROFFESIONAL LEVEL
$profesinal = "SELECT prof_name,tblpro_user.prof_ID FROM tblprofesional,tblpro_user,tbluser WHERE  tblprofesional.prof_ID = tblpro_user.prof_ID AND tblpro_user.regnumber = tbluser.regnumber AND tblpro_user.regnumber=:regno";
$prof_query = $dbh->prepare($profesinal);
$prof_query-> bindParam(':regno', $_SESSION['regnumber'], PDO::PARAM_STR);
$prof_query->execute();
$prof_results=$prof_query->fetchAll(PDO::FETCH_OBJ); 


#RETRIVE USER LOCATION & REGISTERD DATE IN OUR SYSTEM
$since_location = "SELECT location,regdate FROM  tbluser  WHERE regnumber =:regno";
$user_info_query = $dbh->prepare($since_location);
$user_info_query-> bindParam(':regno', $_SESSION['regnumber'], PDO::PARAM_STR);
$user_info_query->execute();
$results_info=$user_info_query->fetchAll(PDO::FETCH_OBJ);
if($user_info_query->rowCount() > 0){
    foreach($results_info as $result_info){
        $member_sice = $result_info->regdate;
    }
}
        

#RETRIVE USER SKILLS LEVEL
$skil = "SELECT skill_name,tblskills_user.skill_ID FROM tblskills,tblskills_user,tbluser WHERE  tblskills_user.skill_ID = tblskills.skill_ID AND tblskills_user.regnumber = tbluser.regnumber AND tbluser.regnumber=:regno";
$skil_query = $dbh->prepare($skil);
$skil_query-> bindParam(':regno', $_SESSION['regnumber'], PDO::PARAM_STR);
$skil_query->execute();
$skil_results=$skil_query->fetchAll(PDO::FETCH_OBJ); 
if($skil_query->rowCount() > 0){
    foreach($skil_results as $skil_result){
        $distinct_one = $skil_result->skill_name;
    }
}


#RETRIVE USER EDUCATION LEVEL
$education = "SELECT ed_description FROM  tbleducation  WHERE tbleducation.regnumber =:regno";
$user_edcation_query = $dbh->prepare($education);
$user_edcation_query-> bindParam(':regno', $_SESSION['regnumber'], PDO::PARAM_STR);
$user_edcation_query->execute();
$results_edcation=$user_edcation_query->fetchAll(PDO::FETCH_OBJ);




/*=====================================  profile/index.php   ==========================================*/
#INSERT OR UPDATE USER EDUCATION LEVEL

if(isset($_POST['up_edbtn'])){

$ed_level=$_POST['up_edinput'];

if(!empty($_POST['up_edinput'])){
    
    $sql="SELECT * FROM  tbleducation WHERE  regnumber=:regnumber AND ed_description=:ed_description";
    $query = $dbh->prepare($sql);
    $query->bindParam(':regnumber',$_SESSION['regnumber'],PDO::PARAM_STR);
    $query->bindParam(':ed_description',$ed_level,PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;

    if($query->rowCount() > 0)
    {
        $error=("This <b>".$ed_level."</b> Already Exist in yourEducation Rows");
        
    }else{
        $sql="INSERT INTO  tbleducation(regnumber,ed_description) VALUES(:regnumber, :ed_description)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':regnumber',$_SESSION['regnumber'],PDO::PARAM_STR);
        $query->bindParam(':ed_description',$ed_level,PDO::PARAM_STR);
        
        if($query->execute())
        {
            $msg="Education level submited successfuly";
            header("location: index.php");
        }
        else 
        {
            $error="Something went wrong. Please try again";
        }
    }
}else{
    $error="Field was Empty";
}

}



#INSERT OR UPDATE USER SKILLS IN DATABASE;  
if(isset($_POST['up_skilbtn'])){

$skills=$_POST['up_skillinput'];

if(!empty($_POST['up_skillinput'])){
    
    $sql="SELECT * FROM  tblskills_user WHERE skill_ID=:skill_ID AND regnumber=:regnumber";
    $query = $dbh->prepare($sql);
    $query->bindParam(':skill_ID',$skills,PDO::PARAM_STR);
    $query->bindParam(':regnumber',$_SESSION['regnumber'],PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;

    if($query->rowCount() > 0)
    {
        $error=("This Skill Already Exist in Your skills Row");
        
    }else{
        $sql="INSERT INTO  tblskills_user(skill_ID,regnumber) VALUES(:skill_ID,:regnumber)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':skill_ID',$skills,PDO::PARAM_STR);
        $query->bindParam(':regnumber',$_SESSION['regnumber'],PDO::PARAM_STR);
        
        if($query->execute())
        {
            $msg="Skill submited successfuly";
            header("location: index.php");
        }
        else 
        {
            $error="Something went wrong. Please try again";
        }
    }
}else{
    $error="Field was Empty";
}

}


#INSERT OR UPDATE USER LOCATION IN DATABASE;
if(isset($_POST['up_locationbtn'])){

$location=$_POST['up_location'];

if(!empty($_POST['up_location'])){
    
    $sql="SELECT location,regnumber FROM  tbluser WHERE location=:location AND regnumber=:regnumber";
    $query = $dbh->prepare($sql);
    $query->bindParam(':location',$location,PDO::PARAM_STR);
    $query->bindParam(':regnumber',$_SESSION['regnumber'],PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;

    if($query->rowCount() > 0)
    {
        $error=("This location".$location." Already Exist in Your Details");
        
    }else{
        $sql="UPDATE tbluser SET location=:location WHERE regnumber=:regnumber";
        $query = $dbh->prepare($sql);
        $query->bindParam(':location',$location,PDO::PARAM_STR);
        $query->bindParam(':regnumber',$_SESSION['regnumber'],PDO::PARAM_STR);
        
        if($query->execute())
        {
            $msg="Location submited successfuly";
            header("location: index.php");
        }
        else 
        {
            $error="Something went wrong. Please try again";
        }
    }
}else{
    $error="Field was Empty";
}

}

    
    
#UPDATE USER FULL NAME IN DATABASE;
if(isset($_POST['up_namebtn'])){

$fname=$_POST['up_nameinput'];

if(!empty($_POST['up_nameinput'])){
    
    $sql="SELECT fname,regnumber FROM  tbluser WHERE fname=:fname AND regnumber=:regnumber";
    $query = $dbh->prepare($sql);
    $query->bindParam(':fname',$fname,PDO::PARAM_STR);
    $query->bindParam(':regnumber',$_SESSION['regnumber'],PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;

    if($query->rowCount() > 0)
    {
        $error=("This name ".$fname." Already Exist in Your Details");
        
    }else{
        $sql="UPDATE tbluser SET fname=:fname WHERE regnumber=:regnumber";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fname',$fname,PDO::PARAM_STR);
        $query->bindParam(':regnumber',$_SESSION['regnumber'],PDO::PARAM_STR);
        
        if($query->execute())
        {
            $msg="Name submited successfuly";
            header("location: ../logout.php");
        }
        else 
        {
            $error="Something went wrong. Please try again";
        }
    }
}else{
    $error="Field was Empty";
}

}




/*=====================================  upload_manager.php   ==========================================*/



if(isset($_POST['upload_btn'])){

  $courseID   = $_POST['course_id'];
  $file     = $_FILES['file'];
  $doneby   = $_SESSION['regnumber'];
  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  if(empty($_POST['course_id'])){
    $message = "<div class='alert alert-warning'>Course required</div>";
        
  }elseif(empty($_FILES['file'])){
    $message = "<div class='alert alert-warning'>file required</div>";

  }else{

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png','gif','zip','doc','docx','pdf','txt','rar','sql','jar','ppt');
    
      if(in_array($fileActualExt,$allowed)){
        
        if($fileError === 0){
          if($fileSize <1000000){
            $fileDestination = 'database/uploaded_files/'.$fileName;
            
            if(file_exists($fileDestination) === false){

              $sql ="SELECT tbluser.regnumber FROM tbluser WHERE regnumber=:ureg_no";
              $query = $dbh->prepare($sql);
              $query->bindParam(':ureg_no',$doneby,PDO::PARAM_STR);
              $query->execute();
              $results=$query->fetchAll(PDO::FETCH_OBJ);

              if($query->rowCount() > 0){
                foreach($results as $result){
                  $userupload  = $result->regnumber;
                }
                
                $sql = "INSERT INTO tblfile (filename,ID) VALUES(:finem,:id)";
                $query = $dbh->prepare($sql);
                $query->bindParam(':finem',$fileName,PDO::PARAM_STR);
                $query->bindParam(':id',$courseID,PDO::PARAM_STR);
                $query->execute();
                $file_id = $dbh->lastInsertId();
                
                if($file_id){

                    $sub_sql = "INSERT INTO  tbluser_file(fileID,regnumber) VALUES(:finem,:regno)";
                    $query = $dbh->prepare($sub_sql);
                    $query->bindParam(':finem',$file_id,PDO::PARAM_STR);
                    $query->bindParam(':regno',$userupload,PDO::PARAM_STR);

                    if($query->execute()){

                      $message = "<div class='alert alert-success'>File Uploaded Successfully done</div>";

                      move_uploaded_file($fileTmpName,$fileDestination);

                    }else{
                      $message = "<div class='alert alert-danger'>Does not fill in userfile table '".$doneby."'</div>";
                    }
                }else{
                  $message = "<div class='alert alert-danger'>File do not Uploaded</div>";
                }
            }else{
                $message = "<div class='alert alert-danger'>Something Went wrong to find user regnumber</div>";
            }
          }else{
            $message = "<div class='alert alert-danger'>The file with this name  ".$fileName." Exist in Folder</div>";
          }
        }else{
          $message = "<div class='alert alert-danger'>Your File is Too big</div>";
        }
      }else{
        $message = "<div class='alert alert-danger'>There was an error Uploading file.</div>";
      }
    }else{
      $message = "<div class='alert alert-danger'>sorry, file is not allowed</div>";
    }
  }
}

?>