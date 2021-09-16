<?php
        include_once('../database/db_connection.php');
           
        $profesinal = "SELECT prof_name,tblpro_user.prof_ID FROM tblprofesional,tblpro_user,tbluser WHERE  tblprofesional.prof_ID = tblpro_user.prof_ID AND tblpro_user.regnumber = tbluser.regnumber AND tblpro_user.regnumber=:regno";
        $prof_query = $dbh->prepare($profesinal);
        $prof_query-> bindParam(':regno', $_SESSION['regnumber'], PDO::PARAM_STR);
        $prof_query->execute();
        $prof_results=$prof_query->fetchAll(PDO::FETCH_OBJ); 
  
        
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
        
        
    
        $education = "SELECT ed_description FROM  tbleducation  WHERE tbleducation.regnumber =:regno";
        $user_edcation_query = $dbh->prepare($education);
        $user_edcation_query-> bindParam(':regno', $_SESSION['regnumber'], PDO::PARAM_STR);
        $user_edcation_query->execute();
        $results_edcation=$user_edcation_query->fetchAll(PDO::FETCH_OBJ);





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

           

?>