<?php 
	session_start();
	error_reporting(0);
    include_once('database/db_connection.php');
    include_once('includes/library_language.php');
    //include_once('database/database_php_clases.php');

    if(isset($_POST['register'])) {
  $message ='';
      
  $user_name  = $_POST['user_name'];
  $reg_no     = $_POST['reg_no'];
  $full_name  = $_POST['full_name'];
  $email      = $_POST['email'];
  $password   = $_POST['password'];
  $cpassword  = $_POST['cpassword'];

  if (empty($user_name) || empty($reg_no) || empty($full_name) || empty($email)) {

    $message =  "<div class='alert alert-warning'>Both Fields are required</div>";
  } else{
    $image    = "default.jpg";
    $typeID   = "1";
    $regdate  = date("y-m-d");


    $user_sql ="INSERT INTO tbluser(regnumber,fname,email,username,password,image,typeID,regdate) VALUES(:regno,:fnme,:eml,:uname,:pass,:img,:tyid,:regd)";
      
    $user_query = $dbh->prepare($user_sql);
    
    $user_query->bindparam(':regno',$reg_no,PDO::PARAM_STR);
    $user_query->bindparam(':fnme', $full_name,PDO::PARAM_STR);
    $user_query->bindparam(':eml', $email,PDO::PARAM_STR);
    $user_query->bindparam(':uname', $user_name,PDO::PARAM_STR);
    $user_query->bindparam(':pass', $cpassword,PDO::PARAM_STR);
    $user_query->bindparam(':img', $image,PDO::PARAM_STR);
    $user_query->bindparam(':tyid', $typeID,PDO::PARAM_STR);
    $user_query->bindparam(':regd', $regdate,PDO::PARAM_STR);            

    if($user_query->execute())
    {
      header("Location: login.php");
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
    <script>
      $(document).ready(function(){
          $("form").submit(function(event){
            event.prventDefault();
              var full_name = $('#full_name').val();
              var email     = $('#email').val();
              var reg_no    = $('#reg_no').val();
              var user_name = $('#user_name').val();
              var password  = $('#password').val();
              var cpassword = $('#cpassword').val();
              var submit    = $('#register').val();

              $('.reg_all_msg').load("database/database_php_clases.php",{
                full_name:full_name, email:email,
                reg_no:reg_no,user_name:user_name,
                password:password,cpassword:cpassword,
                submit:submit
              });

          });
      });
    </script>


  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
</head>
<style>
    .login-page{
        background-image: url(dist/img/background_o1.jpg);
    }
    #register-box{
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

    .register_inputs input[type = "password"],.register_inputs input[type = "text"]{
      height: 40px;
    }
    .register_inputs input[type = "text"],.register_inputs input[type = "password"],.register_inputs input[type = "email"]{
    color: #111314;
    background: none;
}
</style>
<body class="hold-transition login-page" style="height: 400px">
    <div class="login-box">
        <div class="login-logo logo_now">
            <a href="index.php" class="text-white"><?php echo $Translation['Name'];?></a>
        </div>
        <div class="register-box-body" id="register-box">
            <p class="login-box-msg">Register a new membership</p>

            <form class="register_inputs" action="" method="post">
                <span class="text-center reg_all_msg text text-danger" id="reg_all_msg"></span>
                <span class="text-center" id="msg"><?php echo $message;  ?></span>
                     <div class="form-group">
                         <input type="text" name="reg_no" id="reg_no" placeholder="Registration No" class="form-control" autocomplete="off" />
                         <span class="" id="regnumber_msg"></span>
                     </div>

                     <div class="form-group">
                         <input type="text" name="full_name" id="full_name" placeholder="Full Name" class="form-control" autocomplete="off" />
                         <span class="" id="fname_msg"></span>
                     </div>

                     <div class="form-group">
                         <input type="text" name="user_name" id="user_name" placeholder="User Name" class="form-control" autocomplete="off" />
                         <span class="" id="username_msg"></span>
                     </div>
                     <div class="form-group">
                         <input type="text" name="email" id="email" placeholder="Email" class="form-control" autocomplete="off" />
                         <span class="" id="email_msg"></span>
                     </div>

                     <div class="form-group">
                         <input type="password" name="password" id="password" placeholder="Password" class="form-control" autocomplete="off" />
                         <span class="" id="password_msg"></span>
                     </div>
                     <div class="form-group">
                         <input type="password" name="cpassword" id="cpassword" placeholder="Confirm Password" class="form-control" autocomplete="off" />
                         <span class="" id="cpassword_msg"></span>
                     </div>
                <div class="row">
                    <div class="col-xs-12">
                        <input type="submit" class="btn btn-primary btn-block btn-flat" id="register" name="register" value="Register" />
                    </div>
                </div>
            </form>

            <a href="login.php" class="text-center">I already have a membership</a>
        </div>
    </div>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
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



  $("#fname_msg").hide(); $("#email_msg").hide(); $("#regnumber_msg").hide(); $("#username_msg").hide();
  $("#password_msg").hide(); $("#cpassword_msg").hide();
  
  var fname_msg = false; var email_msg = false; var regnumber_msg = false; var username_msg = false; 
  var password_msg  = false; var cpassword_msg = false;
 
  $('#full_name').keyup(function() { check_fname(); });
  $('#email').keyup(function() { check_email(); });
  $('#reg_no').keyup(function() { check_regnumber(); });
  $("#user_name").keyup(function() { check_username(); });
  $('#password').keyup(function() { check_password(); });
  $('#cpassword').keyup(function() { check_cpassword(); });


  //defining some function of registration validation
  function check_fname() {
    var f_name = new RegExp(/^[a-zA-Z ]+$/);
    if(f_name.test($("#full_name").val())){
      $("#fname_msg").closest('.form-group').removeClass('has-error');
      $("#fname_msg").closest('.form-group').addClass('has-success');
      $("#fname_msg").hide();
    }else{
      $("#fname_msg").closest('.form-group').addClass('has-error');
      $("#fname_msg").show();
      fname_msg = true;
    }
  }
  
  function check_email() {
    var email = $("#email").val();

    $.ajax({
      url: 'actions_all.php',
      method: 'POST',
      data: email
    }).done(function(result) {

      $("#email_msg").show();
      $("#email_msg").html(result);
      email_msg = true ;
    })
  }
  
  function check_regnumber() {
    var regnumber = $("#reg_no").val().length;

    if(regnumber < 13){
      $("#regnumber_msg").closest('.form-group').removeClass('has-error');
      $("#regnumber_msg").closest('.form-group').removeClass('has-success');
      $("#regnumber_msg").closest('.form-group').addClass('has-warning');
      regnumber_msg = true; 
    }else if(regnumber > 13){
      $("#regnumber_msg").closest('.form-group').addClass('has-error');
      $("#regnumber_msg").closest('.form-group').removeClass('has-success');
      $("#regnumber_msg").closest('.form-group').removeClass('has-warning');
      $("#regnumber_msg").html("<p class='text-danger'>Reg-number is too large<p>");
      $("#regnumber_msg").show();
      regnumber_msg = true;

    }else{
      $("#regnumber_msg").hide();
      $("#regnumber_msg").closest('.form-group').removeClass('has-error');
      $("#regnumber_msg").closest('.form-group').removeClass('has-warning');
      $("#regnumber_msg").closest('.form-group').addClass('has-success');
      regnumber_msg = false; 
    }
  }


  function check_username() {
    var u_name = new RegExp(/^[a-zA-Z ]+$/);
    if(u_name.test($("#user_name").val())){
      $("#username_msg").closest('.form-group').removeClass('has-error');
      $("#username_msg").closest('.form-group').addClass('has-success');
      $("#username_msg").hide();
    }else{
      $("#username_msg").closest('.form-group').addClass('has-error');
      $("#username_msg").show();
      username_msg = true;
    }
  }
    
  
  function check_password() {
    var password = $("#password").val().length;
    if(password < 5){
        $("#password_msg").closest('.form-group').addClass('has-error');
        $("#password_msg").closest('.form-group').removeClass('has-warning');
        $("#password_msg").closest('.form-group').removeClass('has-success');
        $("#password_msg").hide();
        password_msg = true; 

    } else if(password >= 8){
        $("#password_msg").closest('.form-group').removeClass('has-error');
        $("#password_msg").closest('.form-group').removeClass('has-warning');
        $("#password_msg").closest('.form-group').addClass('has-success');
        $("#password_msg").hide();
        password_msg = false; 
    } else{
        $("#password_msg").closest('.form-group').removeClass('has-error');
        $("#password_msg").closest('.form-group').addClass('has-warning');
        $("#password_msg").closest('.form-group').removeClass('has-success');
        $("#password_msg").html('Your passowrd is weak');
        $("#password_msg").show();
        password_msg = false;
    }     
  }
  
  function check_cpassword() {
        var password = $("#password").val();
        var cpassword = $("#cpassword").val();
      
     if(cpassword != password){
        $("#cpassword_msg").closest('.form-group').addClass('has-error');
        $("#cpassword_msg").closest('.form-group').removeClass('has-success');
        $("#cpassword_msg").html("Password do not match");
        $("#cpassword_msg").show();
        cpassword_msg = true; 
    } else{
        $("#cpassword_msg").closest('.form-group').removeClass('has-error');
        $("#cpassword_msg").closest('.form-group').addClass('has-success');
        $("#cpassword_msg").hide();
        cpassword_msg = false;
    } 
  }


  $(document).on('click', '#register', function () {
        var full_name = $('#full_name').val().length();
        var email     = $('#email').val();
        var reg_no    = $('#reg_no').val();
        var user_name = $('#user_name').val();
        var password  = $('#password').val();
        var cpassword = $('#cpassword').val();

        if(cpassword_msg == true || password_msg == true || regnumber_msg == true || 
          email_msg == true || fname_msg == true) {
         $('#reg_all_msg').html("Fix all errors in form");
         $('#reg_all_msg').show();

        }else if(full_name < 7){

          $("#full_name").closest('.form-group').addClass('has-error');
          $('#full_name').show();
        }



      /* else {
            $.ajax({
                url: "insert_data.php",
                method: "POST",
                data:{full_name:full_name, email:email,reg_no:reg_no,user_name:user_name,cpassword:cpassword},
                success:function (responce) {
                    $('#full_name').val('');
                    $('#email').val('');
                    $('#reg_no').val('');
                    $('#user_name').val('');
                    $('#password').val('');
                    $('#cpassword').val('');
                }
            });
        }*/
    });

    $("#user_name").blur(function() { 
      var username  = $("#user_name").val();
      var action    = "chech_username";

      $.ajax({
        url: "database/reg_log_action.php",
        method: "POST",
        data:{action:action,username:username},
        dataType: "text",
        success:function(data){
          $('#fname_msg').html(data);
        }
      }); 

    });


  });
</script>
</body>

<?php  

if ($_POST['getreg_no']) {
  $regnumber = $_POST['getreg_no'];
  $select = "SELECT * FROM tbluser WHERE regnumber =:reg";
  $statment_query = $dbh->prepare($select);
  $statment_query-> bindParam(':reg', $regnumber, PDO::PARAM_STR);
  $statment_query-> execute();

  if ($statment_query->rowCount() > 0) {
    $erro = "0";
  }

  echo $erro;
}






?>