<?php
    session_start();
    error_reporting(0);
    include_once('../database/db_connection.php');
    include_once('../includes/library_language.php');
    include_once('../database/database_php_clases.php');
    
if(!isset($_SESSION['regnumber'])){
    header("Location: ../login.php");
}
else{
    if((time() - $_SESSION['last_login_timestanp']) > 300){
            header("location: ../lockscreen.php");
    }
    else{

        $_SESSION['last_login_timestanp'] = time();
        
        include_once('configuration_php/user_info.php');
    
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $Translation['main']; ?> </title>
  
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="../bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="../bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

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
    .chat_history{
        background-color: #6a6666;
        border-radius: 5px;
    }
</style>
<!-- ADD THE CLASS sidebar-collapse TO HIDE THE SIDEBAR PRIOR TO LOADING THE SITE -->
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  
    <?php include_once('insert_update.php'); ?> 
    

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>d</b>LB</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>dee'syn</b>LAB</span>
    </a>
    
   <!-- Header Navbar: style can be found in header.less -->
    <?php include_once('main_header.php'); ?> 
  </header>

  <!-- =============================================== -->
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
        <?php include_once('aside_prof.php'); ?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li>
          <a href="../index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="active">
          <a href="index.php">
            <i class="fa fa-user"></i> <span>Profile</span>
          </a>
        </li>
        <?php if($_SESSION['usertype'] == 0){ ?>
            <li>
            <a href="../admin_panel.php">
                <i class="fa fa-th"></i> <span>Admin Panel</span>
                <span class="pull-right-container">
                    <!--              <small class="label pull-right bg-green">new</small>-->
                </span>
            </a>
        </li><?php } ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-desktop"></i>
            <span>Graphics</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../adobe_ph.php"><i class="fa fa-circle-o"></i> Adobe Photoshop</a></li>
            <li><a href="../adobe_ill.php"><i class="fa fa-circle-o"></i> Adobe Illustrator</a></li>
            <li><a href="../adobe_prm.php"><i class="fa fa-circle-o"></i> Adobe Premier</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-archive-o"></i>
            <span>Files</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../download_manager.php"><i class="glyphicon glyphicon-download-alt"></i> Download</a></li>
            <li><a href="../upload_manager.php"><i class="glyphicon glyphicon-open"></i> Upload</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>Suport</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../graphics.php"><i class="fa fa-circle-o"></i> Graphics</a></li>
            <li><a href="../techical.php"><i class="fa fa-circle-o"></i> Techical</a></li>
            <li><a href="../software.php"><i class="fa fa-circle-o"></i> Software</a></li>
          </ul>
        </li>
        <li>
          <a href="pages/mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">16</small>
            </span>
          </a>
        </li>
        <li>
          <a href="index.php?#settings">
            <i class="fa fa-cogs"></i> <span>Settings</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-sun-o"></i> <span>Tools</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../lockscreen.php"><i class="fa fa-lock"></i> Lock</a></li>
            <li><a href="../logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <h1>
          Profile
          <small> panel</small>
      </h1>
      <ol class="breadcrumb">
          <li><a href="../index.php"><i class="fa fa-home"></i> Home</a></li>
          <li class="active">profile</li>
      </ol>
  </section>

      <!-- Main section -->
  <section class="content">
     
		
    <?php if($msg){?>
         <div class="alert alert-success left-icon-alert" role="alert" id="alert">
            <strong>Well done!</strong><?php echo htmlentities($msg); ?>
        </div>
    <?php } 
        else if($error){?>
                <div class="alert alert-danger left-icon-alert" role="alert" id="alert">
             <strong>Oh snap!</strong> <?php echo htmlentities($error); ?>
         </div>
     <?php } ?>

      

      <div class="row">
          <!-- Main box-staus -->
      <div class="col-xs-12">
          <div class="nav-tabs-custom ">
              <ul class="nav nav-tabs">
                  <li class="active"><a href="#about_me" data-toggle="tab">About Me</a></li>
                  <li><a href="#cont" data-toggle="tab">Contact</a></li>
              </ul>
              <div class="tab-content">
                  <div class="tab-pane active" id="about_me">
                      <!-- about me-->
                      <div class="row">
                          <div class="col-md-4">
                              <h2 class="page-header">Social Widgets</h2>
                              <div class="box box-widget widget-user-2">
                                  <div class="widget-user-header bg-black" style="background: url('../dist/img/profile_user_bg1.png') center center;">
                                      <div class="widget-user-image">
                                          <img class="img-circle" src="../dist/img/<?php echo $_SESSION['img_log'];?>" alt="User Avatar" style="height:60px;width:60px;">
                                      </div>
                                      <h3 class="widget-user-username"><?php echo $_SESSION['fulname_log']; ?></h3>
                                      
                                      <?php
                                        if($prof_query->rowCount() > 0){
                                            foreach($prof_results as $prof_result){
                                                
                                                echo '<h5 class="widget-user-desc">'.$prof_result->prof_name.'</h5>';
                                            }
                                        } ?>
                                    <a style="color: #ffffff;" data-toggle="modal" title="Edit" data-target="#Modal_name"><small><span class="glyphicon glyphicon-edit pull-right"></span></small></a>
                                  </div>
                                  <div class="box-footer no-padding">
                                      <ul class="nav nav-stacked">
                                          <li><a href="#">Contacts <span class="pull-right badge bg-yellow">We are workng on it!!</span></a></li>
                                          <li id="my_follower"></li>
                                          <li id="my_following"></li>
                                      </ul>
                                  </div>
                              </div>
                          </div>


                          <div class="col-md-4">
                              <h2 class="page-header">&nbsp;</h2>
                              <div class="box box-widget widget-user">
                                  <div class="box-body">
                                      <strong><i class="fa fa-book margin-r-5"></i> Education <a data-toggle="modal" data-target="#Modal_education"><span class="glyphicon glyphicon-edit pull-right"></span></a></strong>
                                      
                                       <?php
                                        if($user_edcation_query->rowCount() > 0){
                                            foreach($results_edcation as $result_edcation){ 
                                                    echo '
                                            <p class="text-muted">&#9679; '.$result_edcation->ed_description.'&#44;</p>';
                                          }  
                                        }else{
                                            echo '
                                            <p class="alert alert-danger"> Please Update you Education level </p>';
                                          } ?>
                                      
                                      <hr>
                                      <strong><i class="fa fa-map-marker margin-r-5"></i> Location <a data-toggle="modal" data-target="#Modal_location"><span class="glyphicon glyphicon-edit pull-right"></span></a></strong>
                                    <?php
                                        if($user_info_query->rowCount() > 0){
                                            foreach($results_info as $result_info){ 
                                                if($result_info->location != "Null"){
                                                    echo '
                                            <p class="text-muted">'.$result_info->location.'</p>';
                                                    
                                                }else{
                                                    echo '
                                            <p class="alert alert-warning"> Please Update you Location </p>';
                                                }
                                                    
                                          }  
                                        }else{
                                            echo '
                                            <p class="alert alert-danger"> Please Update your Location </p>';
                                    } ?>
                                     

                                  </div>
                              </div>
                          </div> 

                          <div class="col-md-4">
                              <h2 class="page-header">&nbsp;</h2>
                              <div class="box box-widget widget-user-2">
                                  <div class="widget-user-header bg-black" style="background: url('../dist/img/profile_user_bg1.png') center center;">
                                  </div>

                                  <div class="box-footer no-padding">
                                      <hr>
                                      <strong><i class="fa fa-pencil margin-r-5"></i> Skills <a data-toggle="modal" data-target="#Modal_skill"><span class="glyphicon glyphicon-edit pull-right"></span></a></strong>
                                      <p><br>
                                       <?php
                                        if($skil_query->rowCount() > 0){
                                            foreach($skil_results as $skil_result){ 
                                                if($skil_result->skill_ID == 1){
                                                    echo '<span class="label label-info">'.$skil_result->skill_name.'</span>&nbsp;';
                                                    
                                                }else if($skil_result->skill_ID == 2){
                                                    echo '<span class="label label-warning">'.$skil_result->skill_name.'</span>&nbsp;';
                                                    
                                                }else if($skil_result->skill_ID == 3){
                                                    echo '<span class="label label-primary">'.$skil_result->skill_name.'</span>&nbsp;';
                                                    
                                                }else if($skil_result->skill_ID == 4){
                                                    echo '<span class="label label-danger">'.$skil_result->skill_name.'</span>&nbsp;';
                                                    
                                                }else if($skil_result->skill_ID == 5){
                                                    echo '<span class="label label-danger">'.$skil_result->skill_name.'</span>&nbsp;';
                                                    
                                                }else if($skil_result->skill_ID == 6){
                                                    echo '<span class="label label-success">'.$skil_result->skill_name.'</span>&nbsp;';
                                                    
                                                }
                                          }  
                                        }else{
                                            echo '
                                            <p class="alert alert-danger"> Please Update your skils </p>';
                                          } ?>
                                      </p>
                                      <hr>

                                      <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>
                                      <p class="label label-warning">We are workng on it!!</p>
                                      
                                      <p>
                                          <span>Member since: <?php echo $member_sice ; ?></span> <br>
                                      
                                          <span>Email: <a class="text-primary-hover" href="mailto:<?php echo $_SESSION['email_log'] ; ?>"><?php echo $_SESSION['email_log']; ?></a></span>
                                      </p>
                                  </div>
                              </div>
                          </div>
                      </div>

                      <!-- Calendar 
                  <div class="row">
                      <div class="col-md-12">
                          <div class="box box-solid bg-green-gradient">
                          <div class="box-header">
                              <i class="fa fa-calendar"></i>
                              <h3 class="box-title">Calendar</h3>
                              <div class="pull-right box-tools">
                                  <div class="btn-group">
                                      <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                                          <i class="fa fa-bars"></i></button>
                                      <ul class="dropdown-menu pull-right" role="menu">
                                          <li><a href="#">Add new event</a></li>
                                          <li><a href="#">Clear events</a></li>
                                          <li class="divider"></li>
                                          <li><a href="#">View calendar</a></li>
                                      </ul>
                                  </div>
                                  <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                                  </button>
                              </div>
                          </div>
                          <div class="box-body no-padding">
                              <div id="calendar" style="width: 90%"></div>
                          </div>
                      </div>
                      </div>
                  </div>-->

                  </div>

                  <div class="tab-pane" id="cont">
                      <div class="row">

                          <div class="col-md-4">
                              <div class="box box-widget widget-user-2">
                                   <div class="box-body" style="height: 270px">
                                       <div class="direct-chat-messages bg-gray" id="contact"><!--HERE WI GET CONTACTS-->
                                       
                                      </div>
                                  </div>
                              </div>
                          </div>

                          <div class="col-md-4" id="friend_profile">
                              
                          </div>


                          <div class="col-md-4" id="dummpy">
                              
                              
                          </div>
                      </div>
                  </div>
                  </div>
              </div>
          </div>
      </div>

      <div class="row">
          <div class="col-md-12">

          </div>
      </div>

      <div class="row">
          <div class="col-md-12">


          </div>
      </div>
      
  </section>
</div>
  
  
  <?php include_once('../includes/footer.php');?>

  <!-- Control Sidebar -->
  <?php include_once('../includes/aside_panel.php');?> 

  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>


<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script src="../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="../bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<!-- dashboard demo (This is only for demo purposes) -->
<script src="../dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>

<script>
    $(document).ready(function(){
        
		  fetch_contacts();
      add_field();
      unseen_msg();
      notification_msg();
      folowing();
      folowers();
		
		setInterval(function(){
      unseen_msg();
      notification_msg();
      update_last_activity();
      Update_chat_history();
      load_user_info();
      remove_alert();
      fetch_contacts();
      folowing();
      folowers();
		}, 1000);
        
        
      function remove_alert(){
         $(".alert").fadeTo(250,0).slideDown(250, function(){
            $(this).remove();
        }); 
      }
        
    function unseen_msg(){
      var action = "unseen_msg";
        $.ajax({
            url: "configuration_php/profile_action.php",
            method:"POST",
            data:{action:action},
            success: function(data){
        $('#unseen_id').html(data).fadeIn("slow");
            }
        });
    }

    function notification_msg(){
      var action = "unseen_notfication";
        $.ajax({
            url: "../fetch_data_folder/action_data.php",
            method:"POST",
            data:{action:action},
            success: function(data){
        $('#notification_id').html(data).fadeIn("slow");
            }
        });
    }
        
    function fetch_contacts(){

      var action = "contact";

			$.ajax({
				url: "configuration_php/profile_action.php",
				method:"POST",
        data:{action:action},
				success: function(data){
					$('#contact').html(data).fadeIn("slow");
				}
			})
		};

    
    $(document).on('click', '.friend_profile', function(){
      var to_user_id = $(this).data('touserid');
        show_friend_profile(to_user_id);
    });
        
    $(document).on('click', '.start_chart', function(){
        var to_user_id = $(this).data('touserid');
        var to_user_name = $(this).data('tousername');
        var user_image = $(this).data('userimage');
        var user_status = $(this).data('userstatus');
        
          make_chat_dialog(to_user_id,to_user_name,user_image,user_status);
		});  
        
        
    function update_last_activity(){
			$.ajax({
				url: "configuration_php/profile_action.php",
				success: function(){
				}
			})
		}
        
    function add_field(){
        
        var i = 1;
        $('#add_edd_field').click(function(){
           i++;
            $('#up_edinput').append('<button type="submit" class="btn btn-danger btn-remove" id="'+i+'"><i class="fa fa-remove"></i></button>');
        });
        
      $(document).on('click', '.btn-remove', function(){
          var button_id = $(this).attr("id");
          $('button_id').remove();
      });
    }


    function show_friend_profile(to_user_id){
        var action = "fetch_user_profile";

        $.ajax({
            url:"configuration_php/profile_action.php",
            method:"POST",
            data:{action:action,to_user_id:to_user_id},
            success:function(data) {
              $('#friend_profile').html(data);
            }
        });
    }
        
      function make_chat_dialog(to_user_id,to_user_name,user_image,user_status){
          
           var modal_content ='<div class="row">';
           modal_content +='<div class="col-md-12">';
           modal_content +='<div class="box box-warning direct-chat direct-chat-warning">';

           modal_content +='<div class="box-header with-border">';
           modal_content +='<h5>@'+to_user_name+'</h5>&nbsp;';//<img class="direct-chat-img" src="../dist/img/'+user_image+'" alt="user image">';
           //modal_content +='<div class="box-tools pull-right">';
           //modal_content +='<span data-toggle="tooltip" title="new sms" class="badge bg-yellow">3</span>&nbsp;';
           //modal_content +='<button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Contacts" data-widget="chat-pane-toggle"><i class="fa fa-comments"></i></button>';
          //modal_content +='<a href="index.php?#contact" data-toggle="tab"><button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button></a>';
          
           modal_content +='</div>';
          
           modal_content +='<div class="box-body">';
           modal_content +='<div style="backgroung-color:black;" id="chat_history" class="direct-chat-messages chat_history" data-touserid="'+to_user_id+'">';
          
          
            modal_content += get_history(to_user_id);
          
          
            modal_content +='</div>';
            modal_content +='</div>';
          
            modal_content +='<div class="box-footer">';
            modal_content +='<form action="#" method="post">';
            modal_content +='<div class="input-group">';
            modal_content +='<input type="hidden" id="reciverId" value="'+to_user_id+'">';
            modal_content +='<input type="text" name="message" id="sendmessage_'+to_user_id+'" placeholder="Type Message ..." class="form-control message is_message" value="" autocomplete="off">';
            modal_content +='<span class="input-group-btn"><button type="button" class="btn btn-warning btn-flat btnSend" id="send">Send</button></span>';
            modal_content +='</div>';
            modal_content +='</form>';
            modal_content +='</div>';
            modal_content +=' </div></div></div>';

      $('#dummpy').html(modal_content).fadeIn("slow");
    }
        

        
        
    function get_history(user_to){

      var action = "chart_history";

        $.ajax({
        url: "configuration_php/profile_action.php",
        method: "POST",
        data: {action:action, reciver_id: user_to},
        success:function(status){
          $("#chat_history").html(status).fadeIn("slow");
        }
      });
    }

    function Update_chat_history() {
      $('.chat_history').each(function(){
        var to_user_id = $(this).data('touserid');
        get_history(to_user_id);
        
      });
    }
        
    $(document).on('click', '.btnSend', function(){
      var messagetxt  = $('.message').val();
      var reciverId   = $('#reciverId').val();
      var action      = "send_message";
      if(messagetxt!=''){
          $.ajax({
              dataType: "json",
              url: "configuration_php/profile_action.php",
              method: "POST",
              data: {action:action,reciverId: reciverId, messagetxt: messagetxt},
              success:function(data){
                $(".chat_history").slimscroll({start: 'botton'});
              }
          }),

          $('.message').val('');
          $('.message').focus();

        }else{
          $('.message').focus();
        }
    });


$(document).on('click','.btnSend',function(event){
   $('html,body').animate({
    slimscroll: $('.chat_history').offset().top
   }, 'slow');
});

    function load_user_info(){
        $.ajax({
            url: "configuration_php/user_info.php",
            success: function(){
            }
        })
    }


  $(document).on('click','.action_button', function(){
      var receiver_id = $(this).data('receiver_id');
      var action    = $(this).data('action');

        $.ajax({
          url:"configuration_php/profile_action.php",
          method:"POST",
          data:{action:action,receiver_id:receiver_id},
          success:function(data) {
            show_friend_profile(receiver_id);
          }
        });
    });


    /*FOLLOWING IN ABOUT TAB*/
  function folowing() {
    var my_following = "action";
    $.ajax({
        url:"configuration_php/profile_action.php",
        method:"POST",
        data:{my_following:my_following},
        success:function(data) {
          $('#my_following').html('<a href="#">Following <span class="pull-right badge bg-aqua" >'+data+'</span></a>');
        }
    });
  }

    /*FOLLOWERS IN ABOUT TAB*/
  function folowers() {
    var my_follower = "action";
    $.ajax({
        url:"configuration_php/profile_action.php",
        method:"POST",
        data:{my_follower:my_follower},
        success:function(data) {
          $('#my_follower').html('<a href="#">Followers <span class="pull-right badge bg-green" >'+data+'</span></a>');
        }
    });
  }

  });
</script>
</body>
</html>


<?php } } ?>