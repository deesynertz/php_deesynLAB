<?php
    session_start();
    error_reporting(0);
    include_once('database/db_connection.php');
    include_once('includes/library_language.php');
    
if(!isset($_SESSION['regnumber'])){
    header("Location: login.php");
}
else{
    if((time() - $_SESSION['last_login_timestanp']) > 300){
            header("location: lockscreen.php");
    }
    else{

        $_SESSION['last_login_timestanp'] = time();
        include_once('database/database_php_clases.php');
            
        if(isset($_POST['send_cont'])) {
            
        $sms_masage='';
      
        $cont_sms = filter_input($_POST['send_sms'], FILTER_SANITIZE_STRING);
        $cont_name = filter_input($_POST['send_name'], FILTER_SANITIZE_STRING);
        $cont_subj = filter_input($_POST['send_subject'], FILTER_SANITIZE_STRING);
        
/*        if($cont_name == false){
            $sms_masage='<div class="alert alert-danger"><small>suplied name contain SQL ENJECTION</small></div>';
                
        } else if ($cont_sms == false) {
            $sms_masage='<div class="alert alert-danger"><small>Invalid Email</small></div>';
            
        } else if ($cont_subj == false) {
            $sms_masage='<div class="alert alert-danger"><small>Subject contain SQL ENJECTION</small></div>';
            
        } else*/ if(empty($_POST['send_sms'])){
            $sms_masage='<div class="alert alert-warning"><small>No message providede</small></div>';
            
        }else{
            
            $sms_cntct_us = array(':send_name' => $_POST['send_name'],':send_email' => $_POST['send_email'],':send_subject' => $_POST['send_subject'],':send_sms' => $_POST['send_sms']);

            $send_cntct_us ="INSERT INTO tblcontact(name,email,subject,sms) VALUES(:send_name,:send_email,:send_subject,:send_sms)";
            $cntct_us_query = $dbh->prepare($send_cntct_us);			

            if($cntct_us_query->execute($sms_cntct_us))
            {
                $sms_masage='<div class="alert alert-success"><small>Email sent successfully</small></div>';
            }else{
                $sms_masage='<div class="alert alert-danger"><small>Something went wrong</small></div>';
            }
            
        }
    }    
            
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
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>d</b>LB</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>dee'syn</b>LAB</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <?php include_once('includes/main_header.php'); ?> 
  </header>
  
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
        <?php include_once('includes/aside_prof.php'); ?>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <?php if($_SESSION['usertype'] == 0){ ?>
            <li>
            <a href="admin_panel.php">
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
            <li><a href="adobe_ph.php"><i class="fa fa-circle-o"></i> Adobe Photoshop</a></li>
            <li><a href="adobe_ill.php"><i class="fa fa-circle-o"></i> Adobe Illustrator</a></li>
            <li><a href="adobe_prm.php"><i class="fa fa-circle-o"></i> Adobe Premier</a></li>
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
            <li><a href="download_manager.php"><i class="glyphicon glyphicon-download-alt"></i> Download</a></li>
            <li><a href="upload_manager.php"><i class="glyphicon glyphicon-open"></i> Upload</a></li>
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
            <li><a href="graphics.php"><i class="fa fa-circle-o"></i> Graphics</a></li>
            <li><a href="techical.php"><i class="fa fa-circle-o"></i> Techical</a></li>
            <li><a href="software.php"><i class="fa fa-circle-o"></i> Software</a></li>
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
          <a href="settings.php">
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
            <li><a href="lockscreen.php"><i class="fa fa-lock"></i> Lock</a></li>
            <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main section -->
    <section class="content">
     <span id="responce" class="text-center">
         <?php echo $sms_masage; ?>
     </span>
     <div class="row">
         <!-- Main box-staus -->
             <div class="panel-body p-20">
                 <div style="font-family:arial,helvetica,sans-serif,verdana,'Open Sans'">
                     <?php include("slides.php"); ?>
                 </div>
             </div>
         </div>
     
     
     
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>
              <p>New Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>
              <p>Bounce Rate</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
           
            <div class="inner">
              <h3>44</h3>
              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>
              <p>Unique Visitors</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      
    <!-- Calendar -->
    <!--<div class="row">
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
    
      
          <!-- Abot Us -->
       <div class="row">
        <div class="col-md-12">
          <div class="box box-widget">
            <div class="box-header with-border bg-gray-light">
              <div class="user-block">
                <img class="img-circle" src="dist/img/log_image.png" alt="log_img">
                <span class="username"><a href="#">ABOUT US</a></span>
              </div>
              <!-- /.user-block -->
              <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
				<div class="box-body">
                <div class="">
                  <div class="row margin-bottom">
                    <div class="col-sm-4">
                      <img class="img-responsive" src="dist/img/abt_01.png" alt="Photo">
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-8">
                     <h3><a href="#">Who we are?</a></h3>
                	<p style="text-align: justify; padding-right: 10px;line-height: 30px">We are Deesyn Technology  and Solution Lab. Making Us <b>DeesynLAB</b>. Focusing on Graphic design, File sharing, HelpDesk services and Technical support.  Woooow ... we are The SOLUTION LAB.</p>
                	
                    <h3><a href="#">What We Do for You?</a></h3>
                	<p style="text-align: justify; padding-right: 10px; line-height: 30px">We offering access to digital information or resources, including documents, multimedia (Audio/Video), graphics, computer progarms, images and books. 
                	<br>
                	A large number of user can access as thought on their own local computer any where through the network 
                	<br>
                	Create visual concept, by using computer software to comunicate ideas that inform or captivate consumer...
                
                	<br>Mathematical aptitude and strong problem solving skills, Excelent organisational and time management skills...That what we do.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

       <div class="row">
           <div class="col-md-12">
               <div class="box box-widget bg-gray-light">
                   <div class="box-header with-border bg-gray">
                       <div class="user-block">
                           <img class="img-circle" src="dist/img/log_image.png" alt="log_img">
                           <h4 class="username"><a href="#">CONTACT US</a></h4>
                       </div>
                       <span>We are here for you 24/7</span>
                       <!-- /.user-block -->
                       <div class="box-tools">
                           <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                           </button>
                       </div>
                   </div>
                   <div class="box-body">
                       <div class="row">
                           <div class="col-md-6">
                               <div class="row">
                                   <div class="col-lg-5">
                                       <div class="margin-left-60">
                                           <h3 class="text-size-20 margin-bottom-10 text-strong">Address</h3>
                                           <p>P.o.Box 01 mzumbe <br>Morogoro, Tanzania</p>
                                       </div>
                                   </div>

                                   <div class="col-lg-6">
                                       <div class="margin-left-60">
                                           <h3 class="text-size-20 margin-bottom-10 text-strong">E-mail</h3>
                                           <p><a class="text-primary-hover" href="mailto:deesynertz@gmail.com">deesynertz@gmail.com</a><br><a class="text-primary-hover" href="mailto:deesynertz@gmail.com">deogbad995@gmail.com</a></p>
                                       </div>
                                   </div>
                               </div>

                               <div class="row">
                                   <div class="col-lg-12 col-12">
                                       <div class="margin-left-60">
                                           <h3 class="text-size-20 margin-bottom-0 text-strong">Phone Numbers</h3>
                                           <p>+255 744 004 897, +255 654 004 897,<br>+255 734 004 897</p>
                                       </div>
                                   </div>
                               </div>
                           </div>

                           <div class="col-md-6">
                               <div class="card bg-gray-light">
                                   <div class="card-header">
                                       <h3 class="card-title">Contact Form</h3>
                                   </div>
                                   <form action="" id="contact_form" method="post">
                                       <div class="card-body bg-gray-light">

                                           <div>
                                               <div class="form-group">
                                                   <div class="input-group">
                                                       <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                       <input type="text" name="send_name" id="send_name" class="form-control send_name" placeholder="Your Name" autocomplete="off" required>
                                                   </div>  
                                               </div>

                                               <div class="form-group">
                                                   <div class="input-group">
                                                       <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                                       <input type="email" name="send_email" id="send_email" class="form-control send_email" placeholder="Your Email." autocomplete="off" required>
                                                   </div>
                                               </div>

                                               <div class="form-group">
                                                   <div class="input-group">
                                                       <span class="input-group-addon"><i class="fa fa-comment"></i></span>
                                                       <input type="text" name="send_subject" id="send_subject" class="form-control send_subject" placeholder="Subject" autocomplete="off" required>
                                                   </div>
                                               </div>

                                               <div class="form-group">
                                                   <textarea class="form-control send_sms" name="send_sms" id="send_sms" rows="3" placeholder="Message"></textarea>
                                               </div>
                                           </div>
                                           <div class="card-footer">
                                               <button type="submit" name="send_cont" id="send_cont" class="btn btn-primary send_cont pull-right">Submit</button>
                                           </div>
                                       </div>
                                   </form>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
           </div>
       </div>
    </section>

  </div>
  
  
  <?php include_once('includes/footer.php');?>
  
  <!-- Control Sidebar -->
  <?php include_once('includes/aside_panel.php');?> 

  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<script>
    $(document).ready(function(){
        unseen_msg();
        notification_msg();
        
        
    setInterval(function(){
        remove_alert();
        unseen_msg();
        notification_msg();
        update_last_activity();
        Update_chat_history();
    }, 1000);
        
    function unseen_msg(){
      var action = "unseen_msg";
        $.ajax({
            url: "fetch_data_folder/action_data.php",
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
            url: "fetch_data_folder/action_data.php",
            method:"POST",
            data:{action:action},
            success: function(data){
        $('#notification_id').html(data).fadeIn("slow");
            }
        });
    }
        
	    
    function update_last_activity(){
        $.ajax({
            url: "profile/configuration_php/profile_action.php",
            success: function(){
            }
        })
    }
        
    function remove_alert(){
         $(".alert").fadeTo(250,0).slideDown(250, function(){
            $(this).remove();
        }); 
    }    
        
    });
    
    $('#calendar').datepicker().fadeIn("slow");
    $('#calendar2').datepicker().fadeIn("slow");
</script>

</body>
</html>
<?php  } } ?>