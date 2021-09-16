<?php

	session_start();
	error_reporting(0);


	$message ='';


if(isset($_POST['upload_btn'])){

  $courseID 	= $_POST['course_id'];
  $file 		= $_FILES['file'];

  if(empty($_POST['course_id'])){
    $message = "<div class='alert alert-warning'>Course required</div>";
       
        
  }elseif(empty($_FILES['file'])){
    $message = "<div class='alert alert-warning'>file required</div>";
  }else{
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array('jpg','jpeg','png','gif','zip','doc','docx','pdf','txt','rar','sql','jar','ppt');
		
			if(in_array($fileActualExt,$allowed)){
				
				if($fileError === 0){
					if($fileSize <1000000){
						$fileDestination = 'database/uploaded_files/'.$fileName;
						
						if(file_exists($fileDestination) === false){
							move_uploaded_file($fileTmpName,$fileDestination);
								
							$sql = "INSERT INTO tblfile (filename,regnumber,ID) VALUES(:finem,:regno,:id)";
							$query = $dbh->prepare($sql);
							$query->bindParam(':finem',$fileName,PDO::PARAM_STR);
							$query->bindParam(':regno',$_SESSION['regnumber'],PDO::PARAM_STR);
							$query->bindParam(':id',$courseID,PDO::PARAM_STR);
								
							if($query->execute()){
                $message = "<div class='alert alert-success'>File Uploaded Successfully done</div>";
            }else{
              $message = "<div class='alert alert-danger'>File do not Uploaded ".$fileName." Exist</div>";
            }
          }else{
            $message = "<div class='alert alert-danger'>The file with this name  ".$fileName." Exist</div>";
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
