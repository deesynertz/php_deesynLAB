<?php 
	session_start();
	error_reporting(0);
    include_once('database/db_connection.php');
    include_once('includes/library_language.php');
    //include_once('database/database_php_clases.php');

if(isset($_SESSION['regnumber'])){
    header("Location: logout.php");
}else{
    


    if(isset($_POST['login_btn'])) {
      $message ='';
          
        $user_name =  $_POST['user_name'];
        $password = $_POST['password'];
    

        if(empty($_POST["user_name"]) || empty($_POST["password"]))
        {
            $message = "<div class='alert alert-warning'>Both Fields are required</div>";

        } else {

            //select from database
            $sql ="SELECT username,password,regnumber FROM tbluser WHERE username=:uname";
            $query= $dbh -> prepare($sql);
            $query-> bindParam(':uname', $user_name, PDO::PARAM_STR);
            $query-> execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);

            if($query->rowCount() > 0){
                foreach($results as $result){
                    if($password == $result->password){
                        
                        $sql_in ="SELECT regnumber,fname,email,username,image,typeID,parmision_status FROM tbluser WHERE username=:uname";
                        $query_in= $dbh -> prepare($sql_in);
                        $query_in-> bindParam(':uname', $user_name, PDO::PARAM_STR);
                        $query_in-> execute();
                        $results_in=$query_in->fetchAll(PDO::FETCH_OBJ);
                        
                        foreach($results_in as $result_in){
                            if($result_in->parmision_status == 1){
                            
                                $_SESSION['regnumber']      =   $result_in->regnumber;
                                $_SESSION['fulname_log']    =   $result_in->fname;
                                $_SESSION['email_log']      =   $result_in->email;
                                $_SESSION['username_log']   =   $result_in->username;
                                $_SESSION['img_log']        =   $result_in->image;
                                $_SESSION['usertype']       =   $result_in->typeID;
                                $_SESSION['status']         =   "yes";
                                
                                $_SESSION['last_login_timestanp']  = time();
                                
                                $user_number = $result_in->regnumber;
                                
                                $sub_query = "INSERT INTO  tbllogin_detail(user_ID) VALUES(:usernumber)";
                        
                                $sub_query_1 = $dbh->prepare($sub_query);
                                $sub_query_1 ->bindParam(':usernumber',$user_number,PDO::PARAM_STR);
                                $sub_query_1 ->execute();
                                $_SESSION['login_detail_ID'] = $dbh->lastInsertId();
                                
                                $message = '<div class="alert alert-success">ACCESS GRANTED</div>';
                                
                                header("location: index.php");

                            }else{
                                $message = '<div class="alert alert-danger">ACCESS DENIED</div>';
                            } 
                        }
   
                    }
                    else{
                        $message = '<div class="alert alert-warning">Wrong Password</div>';
                    }
                }
            } 
            else{
                $message = '<div class="alert alert-danger">Wrong Details</div>';
            }
        }   
 
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?php echo $Translation['login'];?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  
  
    <link rel="stylesheet" href="bower_components/customized_css/deesynertz_lab.css">
  
    <script src="bower_components/jquery/dist/jquery.js"></script>
     <script>
        $(function(){
            $(document).onmousemove(function(){
                var timeStamp = new Date();
                sessionStorage.setItem("lastTimeStamp", timeStamp);
            });
        });
    </script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
</head>
<style>
    .login-page{
        background-image: url(dist/img/background_o1.jpg);
    }
    #login-box{
        border-radius: 10px;
        background: rgba(199, 183, 183, 0.23);
        color: #CECED0;
    }
    .forgot a, .login_signup_p{
	    color: #CECED0;
    }
    .logo_now a{
         color: #CECED0;
    }
    .login_inputs input[type = "password"],.login_inputs input[type = "text"]{
      height: 40px;
    }
    .login_inputs input[type = "text"],.login_inputs input[type = "password"]{
    color: #111314;
    background: none;
    }
</style>
<body class="hold-transition login-page" style="height: 500px">
<div class="login-box">
    <div class="login-logo logo_now">
        <a href="index.php" class="text-white"><?php echo $Translation['Name'];?></a>
    </div>
    <div class="login-box-body" id="login-box">
        <p class="login-box-msg">Sign in to start your session</p>

        <form class="login_inputs" id="login_form" method="post">
            <span class="text-center" id="msg"><?php echo $message;  ?></span>
            <div class="form-group has-feedback">
                <input type="text" name="user_name" class="form-control" placeholder="Useneme" autocomplete="off" id="user_name" value="admin">
                <span class="form-control-feedback" id="us_msg"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="Password" value="12345">
                <span class="form-control-feedback" id="password"></span>
            </div>
            <div class="row"><!-- 
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> Remember Me
                        </label>
                    </div>
                </div> -->
                <div class="col-xs-12">
                    <input type="submit" class="btn btn-primary btn-block btn-flat" id="login_btn" name="login_btn" value="Login">
                </div>
            </div>
        </form>

        <a href="#">I forgot my password</a><br>
        <a href="registration.php" class="text-center">Register a new membership</a>

    </div>
</div>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.js"></script>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
    
</script>
<script>

  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });

   window.setTimeout(function(){
  $(".alert").fadeTo(250,0).slideDown(250, function(){
        $(this).remove();
      });
    }, 4000);
  });
</script>
</body>


<?php } ?>