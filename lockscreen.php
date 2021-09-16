<?php
    session_start();
    error_reporting(0);
    include_once('database/db_connection.php');
    include_once('includes/library_language.php');
    include_once('database/database_php_clases.php');
 
if(!isset($_SESSION['regnumber'])){
    
    header("Location: login.php"); 
    
}else{
    
    if((time() - $_SESSION['last_login_timestanp']) > 1200){
            header("location: logout.php");
    }
    else{

        $_SESSION['last_login_timestanp'] = time();
    
    
    if(isset($_POST['unlock_btn'])){
            
        if($_POST['passord'] == ""){
            
            $message ='EMPTY PASSWORD FIELD';
        }else{
            $sesion_pass = $_POST['passord'];
            //select from database
            $sql ="SELECT password,regnumber FROM tbluser WHERE password=:pass AND regnumber=:regno";
            $query= $dbh -> prepare($sql);
            $query-> bindParam(':pass', $sesion_pass, PDO::PARAM_STR);
            $query-> bindParam(':regno', $_SESSION['regnumber'], PDO::PARAM_STR);
            $query-> execute();
            $results=$query->fetchAll(PDO::FETCH_OBJ);

            if($query->rowCount() > 0){
                foreach($results as $result){
                    if(($result->regnumber == $_SESSION['regnumber']) && ($sesion_pass == $result->password)){
                        
                        $_SESSION['last_login_timestanp']  = time();
                                
                        $user_number = $result->regnumber;

                        $sub_query = "INSERT INTO  tbllogin_detail(user_ID) VALUES(:usernumber)";

                        $sub_query_1 = $dbh->prepare($sub_query);
                        $sub_query_1 ->bindParam(':usernumber',$user_number,PDO::PARAM_STR);
                        $sub_query_1 ->execute();
                        
                        
                        $_SESSION['login_detail_ID'] = $dbh->lastInsertId();
                        $_SESSION['regnumber'] = $result->regnumber;
                        header("location: index.php");
                    }else{
                        $message ='ACCEDD DINIED !!';
                    }
                }
            }else{
                $message ='WRONG PASSWORD';
            }
        }
    
    }
    
    
?>



<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $Translation['lockscreen']; ?> </title>
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
    .lockscreen{
        background-image: url(dist/img/background_o1.jpg);
        
        color: #CECED0;
    }
    .logo_screen a{
        color: #CECED0;
    }
</style>
<body class="hold-transition lockscreen" style="height: 300px">
<div class="lockscreen-wrapper"><br><br>
  <div class="lockscreen-logo logo_screen">
    <a href="index.php" class="text-white"><?php echo $Translation['Name'];?></a><br>
  </div>
  <div class="lockscreen-name"><?php echo $_SESSION['fulname_log']; ?></div>

  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="dist/img/<?php echo $_SESSION['img_log']; ?>" alt="User Image">
    </div>

    <form class="lockscreen-credentials" method="post">
      <div class="input-group">
        <input type="password" name="passord" class="form-control" placeholder="password">
        <div class="input-group-btn">
          <button type="submit" class="btn" name="unlock_btn" value="submit"><i class="fa fa-arrow-right text-muted"></i></button>
        </div>
      </div>
    </form>

  </div>
  <div class="help-block text-center">
  
      <?php if($message){?>
              <p class="text text-danger"><?php echo htmlentities($message); ?></p>
    <?php } 
        else {?>
              Enter your password to retrieve your session
     <?php } ?>
  
  </div>
  <div class="text-center">
    <a href="login.php">Or sign in as a different user</a>
  </div>
  <div class="lockscreen-footer text-center">
    &copy; <script>
                document.write(new Date().getFullYear())
        </script> <b><a href="" class="text-black"><?php echo $Translation['copyright'];?></a></b><br>
  </div>
</div>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });

   window.setTimeout(function(){
  $(".text").fadeTo(250,0).slideDown(250, function(){
        $(this).remove();
      });
    }, 4000);
  });
</script>
</body>
</html>

<?php  } }
?>