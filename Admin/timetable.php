<?php
include('../inc/topbar.php');
if(empty($_SESSION['admin-username']))
    {
      header("Location: login.php");
    }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Periods|<?php echo $sitename; ?></title>
  <link rel="icon" type="image/png" sizes="16x16" href="../<?php echo $logo; ?>">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->

  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

  
  <style type="text/css">
<!--
.style7 {vertical-align:middle; cursor:pointer; -webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none; border:1px solid transparent; padding:.375rem .75rem; line-height:1.5; border-radius:.25rem;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out; display: inline-block; color: #212529; text-align: center;}
-->
/* Styles for Edit Link */
.edit-link {
    color: #007bff;
}

/* Styles for Delete Link */
.delete-link {
    color: #dc3545; 
}

/* Styles for Icons */
i.fas {
    margin-right: 5px; /* Adjust spacing between icon and text */
}
/* Define alternate row colors */
.custom-table tbody tr:nth-child(even) {
        background-color: #f2f2f2; /* Light gray */
}
.custom-table tbody tr:nth-child(odd) {
    background-color: #ffffff; /* White */
}

/* Add hover effect */
.custom-table tbody tr:hover {
    background-color: #e9ecef; /* Light gray */
}
thead {
        background-color: white;
        color: white; /* Set text color to white for better contrast */
}
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Home</a>      </li>

    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="../<?php echo $row_admin['photo'];    ?>" alt="User Image" width="140" height="141" class="img-circle elevation-2">        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $row_admin['fullname'];  ?></a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <?php
if(isset($_POST['submit']))
{
    $class_id = isset($_POST['class_id'])?$_POST['class_id']:'';
    $section_id = isset($_POST['section_id'])?$_POST['section_id']:'';
    $teacher_id = isset($_POST['teacher_id'])?$_POST['teacher_id']:'';
    $period_id = isset($_POST['period_id'])?$_POST['period_id']:'';
    $day_name = isset($_POST['day_name'])?$_POST['day_name']:'';
    $subject_id = isset($_POST['subject_id'])?$_POST['subject_id']:'';
    $date_add = date('Y-m-d g:i:s');
    $status = 'publish';
    $author = 1;
    $type = 'timetable';
    // $title = 
    // $query = mysqli_query($db_conn, "INSERT INTO posts (`type`,`author`,`status`,`publish_date`) VALUES ('$type','$author','$status','$date_add')");
    $query = mysqli_query($conn, "INSERT INTO `posts`(`author`, `title`, `description`, `type`, `status`,`parent`) VALUES ('1','$type','description','timetable','publish',0)") or die('DB error');
    if($query)
    {
        $item_id = mysqli_insert_id($conn);
    }
    $metadata = array(
        'class_id' => $class_id,
        'section_id' => $section_id,
        'teacher_id' => $teacher_id,
        'period_id' => $period_id,
        'day_name' => $day_name,
        'subject_id' => $subject_id,
    );
    
    foreach ($metadata as $key => $value) {
        mysqli_query($conn, "INSERT INTO metadata (`item_id`,`meta_key`,`meta_value`) VALUES ('$item_id','$key','$value')");
    }

    header('Location: timetable.php');
}
?>
		 <?php
			   include('sidebar.php');

			   ?>


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
      <div class="row ">
          <div class="col-sm-8">
            <h1 class="m-0 text-dark">Manage Time Table 
            <a href="?action=add" class="btn btn-success btn-sm"> Add New</a>
            <a href="?action=add" class="btn btn-success btn-sm"> Edit</a>
            <a href="?action=add" class="btn btn-success btn-sm"> Delete</a>
            <a href="?action=add" class="btn btn-success btn-sm"> View All Timetable</a>
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Timetable</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">&nbsp;</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <?php if(isset($_GET['action']) && $_GET['action'] == 'add') {?>
        
        <div class="card">
            <div class="card-body">
                <form action="" method="post">
                <div class="row">
                        <div class="col-lg">
                            <div class="form-group">
                                <label for="class_id">Select Class</label>
                                <select require name="class_id" id="class_id" class="form-control">
                                    <option value="">-Select Class-</option>
                                    <?php
                                    $args = array(
                                      'type' => 'class',
                                      'status' => 'publish',
                                    );
                                    $classes = get_posts($args); 
                                    foreach ($classes as $key => $class) { ?>
                                    <option value="<?php echo $class->id ?>"><?php echo $class->title ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group" id="section-container">
                                <label for="section_id">Select Section</label>
                                <select require name="section_id" id="section_id" class="form-control">
                                    <option value="">-Select Section-</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group" id="section-container">
                                <label for="teacher_id">Select Teacher</label>
                                <select require name="teacher_id" id="teacher_id" class="form-control">
                                    <option value="">-Select Teacher-</option>
                                    <option value="1">Teacher 1</option>
                                    <option value="2">Teacher 2</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group" id="section-container">
                                <label for="period_id">Select Period</label>
                                <select require name="period_id" id="period_id" class="form-control">
                                    <option value="">-Select Period-</option>
                                    <?php
                                    $args = array(
                                        'type' => 'period',
                                        'status' => 'publish',
                                      );
                                      $periods = get_posts($args); 
                                      foreach ($periods as $key => $period) { ?>
                                      <option value="<?php echo $period->id ?>"><?php echo $period->title ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group" id="section-container">
                                <label for="day_name">Select Day</label>
                                <select require name="day_name" id="day_name" class="form-control">
                                    <option value="">-Select Day-</option>

                                    <?php
                                     $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
                                     foreach ($days as $key => $day) { ?>
                                        <option value="<?php echo $day ?>"><?php echo ucwords($day)?></option>
                                      <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="form-group" id="section-container">
                                <label for="subject_id">Select Subject</label>
                                <select require name="subject_id" id="subject_id" class="form-control">
                                    <option value="">-Select Subject-</option>
                                    <option value="19">Mathematics</option>
                                    <option value="20">English</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="from-group">
                            <label for="">&nbsp;</label>
                            <input type="submit" value="submit" name="submit" class="btn btn-success form-control">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php } else {?>

        <form action="" method="get">
            <?php
            $class_id = isset($_GET['class'])?$_GET['class']:43;
            $section_id = isset($_GET['section'])?$_GET['section']:3;
            ?>
            <div class="row">
                <div class="col-auto">
                    <div class="form-group">
                        <select name="class" id="class" class="form-control">
                            <option value="">Select Class</option>
                            <?php
                            $args = array(
                            'type' => 'class',
                            'status' => 'publish',
                            );
                            $classes = get_posts($args);
                            foreach ($classes as $class) {
                                $selected = ($class_id ==  $class->id)? 'selected': '';
                                echo '<option value="' . $class->id . '" '.$selected.'>' . $class->title . '</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="form-group" id="section-container">
                        <select name="section" id="section" class="form-control">
                            <option value="">Select Section</option>
                            <?php
                            $args = array(
                            'type' => 'section',
                            'status' => 'publish',
                            );
                            $sections = get_posts($args);
                            foreach ($sections as $section) {
                                $selected = ($section_id ==  $section->id)? 'selected': '';
                            echo '<option value="' . $section->id . '" '.$selected.'>' . $section->title . '</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Apply</button>
                </div>
            </div>

        </form>

        <div class="card-body">
              <div class="table-responsive bg-white">
                  <!-- <table class="table table-bordered"> -->
                <table width="85%" align="center" class="table table-bordered table-striped custom-table" id="example1">  
                    <thead>
                        <tr>
                            <th>Timing</th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                            <th>Sunday</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $args = array(
                            'type' => 'period',
                            'status' => 'publish',
                        );
                        $periods = get_posts($args);

                        foreach($periods as $period){ 
                            $from = get_metadata($period->id, 'from')[0]->meta_value;

                            $to = get_metadata($period->id, 'to')[0]->meta_value;
                            ?>
                        <tr>
                            <td><?php echo date('h:i A',strtotime($from)) ?> - <?php echo date('h:i A',strtotime($to)) ?></td>
                            <?php 

                            $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];
                            
                            foreach($days as $day){ 
                                $query = mysqli_query($conn, "SELECT * FROM posts as p 
                                INNER JOIN metadata as md ON (md.item_id = p.id) 
                                INNER JOIN metadata as mp ON (mp.item_id = p.id) 
                                INNER JOIN metadata as mc ON (mc.item_id = p.id) 
                                INNER JOIN metadata as ms ON (ms.item_id = p.id) 
                                WHERE p.type = 'timetable' AND p.status = 'publish' AND md.meta_key = 'day_name' AND md.meta_value = '$day' AND mp.meta_key = 'period_id' AND mp.meta_value = $period->id AND mc.meta_key = 'class_id' AND mc.meta_value = $class_id AND ms.meta_key = 'section_id' AND ms.meta_value = $section_id");

                
                                
                                if(mysqli_num_rows($query) > 0)
                                {
                                    while($timetable = mysqli_fetch_object($query)) {
                                        
                                        
                                        ?>
                                        <td>
                                            <p>
                                                <b>Teacher: </b> 
                                                <?php 
                                                $teacher_id = get_metadata($timetable->item_id,'teacher_id')[0]->meta_value;
                                                
                                                echo get_user_data($teacher_id)->name;
                                                ?> 
                                                
                                                
                                                <br>
                                                <b>Class: </b> 
                                                <?php 
                                                $class_id = get_metadata($timetable->item_id,'class_id',)[0]->meta_value;
                                                echo get_post(array('id'=>$class_id))->title;
                                                ?>
                                                <br>
                                                <b>Section: </b>
                                                <?php 
                                                $section_id = get_metadata($timetable->item_id,'section_id',)[0]->meta_value;
                                                echo get_post(array('id'=>$section_id))->title;
                                                ?>
                                                <br>
                                                <b>Subject: </b> 
                                                <?php 
                                                $subject_id = get_metadata($timetable->item_id,'subject_id',)[0]->meta_value;
                                                echo get_post(array('id'=>$subject_id))->title;
                                                ?>
                                                <br>
                                            </p>
                                        </td>
                                    <?php } 
                                }else { ?>
                                    <td>
                                        Unscheduled 
                                    </td>     
                                
                                <?php }  
                            }?>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php } ?>
      </div><!--/. container-fluid -->
    </section>
            <p>
            <!-- /.card -->
          </p>  
        </div>
          <!-- /.col -->
    </div>
        <!-- /.row -->
  </div>
      <!-- /.container-fluid --><!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">

    </div>
 <?php  include('../inc/footer.php');   ?>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
jQuery(document).ready(function(){

  jQuery('#class_id').change(function(){
    // alert(jQuery(this).val());

    jQuery.ajax({
      url:'ajax.php',
      type : 'POST',
      data  : {'class_id':jQuery(this).val()},
      dataType : 'json',
      success: function(response){
        if(response.count > 0)
        {
          jQuery('#section-container').show();        
        }
        else
        {
          jQuery('#section-container').hide();
        }
        jQuery('#section_id').html(response.options); 
      }
    });
  });

})
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
