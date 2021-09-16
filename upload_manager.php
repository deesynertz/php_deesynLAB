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
   <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
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
<style>
    .form-group input[type='file'], .form-group select{
        border-radius: 5px;
    }
</style>

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
        <li class="treeview active">
          <a href="#">
            <i class="fa fa-file-archive-o"></i>
            <span>Files</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="download_manager.php"><i class="glyphicon glyphicon-download-alt"></i> Download</a></li>
            <li class="active"><a href="upload_manager.php"><i class="glyphicon glyphicon-open"></i> Upload</a></li>
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
          <h1>
              File
              <small>Upload panel</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Upload Panel</li>
          </ol>
      </section>

      <section class="content">
          <div class="row">
            <div class="col-md-12">
                <div class="callout callout-info" id="warning_user">
                    <h4>Warning!</h4>
                    <p> 1:Do not use long long fine name; <br>
                        2:use allowable extension type <b style="color:black;">(<?php echo $Translation['filetype'];?>)</b> to avoid error in uploading file
                    </p>
                </div>
            </div>
              
              <div class="col-md-12">
                  <div class="row">
                      <div class="col-md-7">
                          <span><?php echo $message; ?></span>
                          <div class="box box-info">
                              <div class="box-header with-border">
                                  <i class="fa  fa-share-alt"></i>
                                  <h3 class="box-title">share file</h3>

                                  <div class="box-tools pull-right">
                                      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                      </button>
                                  </div>
                              </div>
                              <!-- /.box-header -->
                            <form class="form-horizontal" method="post" enctype="multipart/form-data">
                               <div class="box-body">
                               
                               <div class="form-group">
                                  <label for="course_id" class="col-sm-2 control-label">Course</label>

                                  <div class="col-sm-10">
                                    <select class="form-control select2" style="width: 100%;" id="course_id" name="course_id" onChange="(this.value);">
                                            <option value="">--choose--</option>
                                            <?php 
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
                                                } ?>
                                        </select>
                                  </div>
                                </div>
                                
                                
                                <div class="form-group">
                                  <label for="file" class="col-sm-2 control-label">Files</label>
                                  <div class="col-sm-10">
                                    <input type="file" class="form-control" id="file" name="file">
                                  </div>
                                </div>
                                
                                </div>
                                <div class="box-footer">
                                <button type="submit" name="upload_btn" id="file" class="btn btn-info pull-right">Sign in</button>
                                </div>
                            </form>
                          </div>
                      </div>
                      <div class="col-md-5">
                      
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
<!-- Select2 -->
<script src="../../bower_components/select2/dist/js/select2.full.min.js"></script>
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
        unseen_msg();
        notification_msg();
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
        
    function remove_alert(){
         $(".alert").fadeTo(250,0).slideDown(250, function(){
            $(this).remove();
        }); 
    }    
        
    });
    
    $('#calendar').datepicker();
    $('#calendar2').datepicker();
    $('.select2').select2();
</script>
</body>
</html>
<?php } } ?>