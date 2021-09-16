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
    }else{

      $_SESSION['last_login_timestanp'] = time();
      include_once('database/database_php_clases.php');
      include_once('admin_panel/admin_configuration/data_manipulation.php');
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
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  
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
        <li>
          <a href="index.php">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <?php if($_SESSION['usertype'] == 0){ ?>
            <li class="treeview active">
            <a href="">
                <i class="fa fa-th"></i> <span>Admin Panel</span>
                <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i> Working on it</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Working on it</a></li>
            <li><a href="#"><i class="fa fa-circle-o"></i> Working on it</a></li>
          </ul>
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
      <section class="content-header">
          <h1>Admin<small>Control panel</small></h1>
          <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">admin Panel</li>
          </ol>
      </section>
      <section class="content">
            <div class="row"> <!--FIRST ROW START-->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">UI Designer</span>
                            <span class="info-box-number">1<small>%</small></span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">DB Designer</span>
                            <span class="info-box-number">2</span>
                        </div>
                    </div>
                </div>

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Security Designer<br>&amp; Network
	 	                    </span>
                            <span class="info-box-number">4/5</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Graphics  Designer<br>System Developer</span>
                            <span class="info-box-number">3/6</span>
                        </div>
                    </div>
                </div>
            </div>
            
            
    <!--FIRST ROW END-->
    <!--SECOND ROW START-->
            
          <div class="row">
              <div class="col-md-12">
                  <!-- Custom Tabs -->
                  <div class="nav-tabs-custom">
                      <ul class="nav nav-tabs">
                          <li class="active"><a href="#tab_1" data-toggle="tab">USERS TAB</a></li>
                          <li><a href="#tab_2" data-toggle="tab">SMS</a></li>
                          <li><a href="#tab_3" data-toggle="tab">OTHERS</a></li>
                          <li class="dropdown">
                              <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                  Dropdown <span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu">
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Action</a></li>
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Another action</a></li>
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Something else here</a></li>
                                  <li role="presentation" class="divider"></li>
                                  <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Separated link</a></li>
                              </ul>
                          </li>
                          <li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
                      </ul>
                      
                      <div class="tab-content">
                          <div class="tab-pane active" id="tab_1">
                              <div class="row">
                                  <section class="col-lg-8 connectedSortable"> <!-- Left col -->
                                     
                                      <!-- FIRST BOX-->
                                      <div class="nav-tabs-custom">
                                          <!-- Tabs within a box -->
                                          <ul class="nav nav-tabs pull-right">
                                              <li class="active"><a href="#normal_user" data-toggle="tab">Normal User</a></li>
                                              <li><a href="#admin_user" data-toggle="tab">Admin</a></li>
                                          </ul>
                                          <div class="tab-content no-padding">
                                              <div class="tab-pane active" style="position: relative;">
                                                  <div class="box-body">
                                                      <div class="box">
                                                          <div class="box-body">
                                                            <table id="example2" class="table table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th>RegNo</th>
                                                                    <th>Fullname</th>
                                                                    <th>Eamil</th>
                                                                    <th style="width:50px;">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody id="normal_user">
                                                            
                                                            </tbody></table>
                                                          </div>
                                                      </div>
                                                  </div>
                                              
                                              </div>
                                              
                                              <div class="tab-pane" id="admin_user" style="position: relative; height: 400px;">
                                                  
                                                  
                                              </div>
                                          </div>
                                      </div>
                                     
                                      <!-- SECOND BOX -->
                                      <div class="box box-info">
                                          <div class="box-header">
                                              <i class="fa fa-envelope"></i>

                                              <h3 class="box-title">Quick Email</h3>
                                          </div>
                                          <div class="box-body">
                                              <form action="#" method="post">
                                                  <div class="form-group">
                                                      <input type="email" class="form-control" name="emailto" placeholder="Email to:">
                                                  </div>
                                                  <div class="form-group">
                                                      <input type="text" class="form-control" name="subject" placeholder="Subject">
                                                  </div>
                                                  <div>
                                                      <textarea class="textarea" placeholder="Message" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                                                  </div>
                                              </form>
                                          </div>
                                          <div class="box-footer clearfix">
                                              <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
                                                  <i class="fa fa-arrow-circle-right"></i></button>
                                          </div>
                                      </div>
                                  </section>
                                  
                                  
                                  
                                  <!-- right col (We are only adding the ID to make the widgets sortable)-->
                                  <section class="col-lg-4 connectedSortable"><!-- right col -->

                                      <!-- Add user box -->
                                      <div class="box box-solid bg-light-blue-gradient collapsed-box">
                                          <div class="box-header">
                                              <div class="pull-right box-tools">
                                                  <button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
                                                      <i class="fa fa-minus"></i></button>
                                              </div>
                                              <i class="fa fa-user"></i> <h3 class="box-title">Add user</h3>
                                          </div>
                                          <div class="box-body">
                                              <div id="" style="height: 250px; width: 100%;">
                                                  
                                                  
                                              </div>
                                          </div>
                                      </div>

                                      <!-- Calendar -->
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
                                              <!--The calendar -->
                                              <div id="calendar" style="width: 100%">
                                                  
                                              </div>
                                          </div>
                                      </div>

                                  </section>
                                  <!-- right col -->
                              </div>
                              <!-- /.row (main row) -->
                          </div>
                          
                          <div class="tab-pane" id="tab_2">
                            
                          </div>
                          
                          <div class="tab-pane" id="tab_3">
                              
                          </div>
                      </div>
                  </div>
              </div>
          </div>
    <!--SECOND ROW END-->
      </section>

  </div>
  
  <?php include_once('includes/footer.php');?>
  
  <!-- Control Sidebar -->
  <?php include_once('includes/aside_panel.php');?> 

  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
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
    fetch_user_all();
    unseen_msg();
    notification_msg();
        
    setInterval(function(){
        fetch_user_all();
        notification_msg();
        unseen_msg();
        remove_alert();
        update_last_activity();
    }, 1000);
        
    function update_last_activity(){
        $.ajax({
            url: "profile/configuration_php/profile_action.php",
            success: function(){
            }
        })
    }
        
   $(document).on('click', '.action_button', function(){
    var to_user_id = $(this).data('touserid');
    var action     = $(this).data('action');
       
    $.ajax({
        url: "admin_panel/admin_configuration/data_manipulation.php",
        method: "POST",
        data: {action:action, to_user_id: to_user_id},
        success:function(){
          fetch_user_all();
        }
      })
    });
    
    function remove_alert(){
         $(".alert").fadeTo(250,0).slideDown(250, function(){
            $(this).remove();
        }); 
    } 
        
    function fetch_user_all(){

      var action = "all_users";

      $.ajax({
        url: "admin_panel/admin_configuration/data_manipulation.php",
        method:"POST",
        data:{action:action},
        success: function(responce){
          $('#normal_user').html('<tr>'+responce+'<tr>').fadeIn("slow");
        }
      });
    }
        
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
        
    });
    
</script>
<script>
    $(function () {
        
    $('#example1').DataTable();
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
    $('#calendar').datepicker();
    $('#calendar2').datepicker();
        
    });
</script>
</body>
</html>
<?php } } ?>