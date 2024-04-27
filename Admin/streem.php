<?php
include('../inc/topbar.php');
if(empty($_SESSION['admin-username']))
    {
      header("Location: login.php");
    }
 ?>
 <?php

if(isset($_POST['submit']))
{
  $title = $_POST['title'];

  $query = mysqli_query($conn, "INSERT INTO `posts`(`author`, `title`, `description`, `type`, `status`,`parent`) VALUES ('1','$title','description','section','publish',0)") or die('DB error');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Streem|<?php echo $sitename; ?></title>
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
<script type="text/javascript">
		function deldata(title){
if(confirm("ARE YOU SURE YOU WISH TO DELETE " + " " + title + " " + " FROM THE DATABASE?"))
{
return  true;
}
else {return false;
}

}

</script>

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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">&nbsp;</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Streem</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class='col-lg-8'>
            
            <!-- Info boxes -->
            <div class="card">
              <div class="card-header py-2">
                <h3 class="card-title">
                Streems
                </h3>
                <div class="card-tools">
                </div>
              </div>
              <div class="card-body">
                <div class="table-responsive bg-white">
                  <table width="85%" align="center" class="table table-bordered table-striped custom-table" id="example1">
                    <thead>
                      <tr>
                      <th ><div align="center"><span class="style1">S.No</span></div></th>
                      <th ><div align="center"><span class="style1">Title</span></div></th>
                      <th ><div align="center"><span class="style1">Action</span></div></th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php
                      // SQL query to select all sections
                      $count = 1;
                          $sql = "SELECT * FROM posts where type = 'section'";
                          $result = $conn->query($sql);

                          if ($result->num_rows > 0) {
                              // Output data of each row
                              while($row = $result->fetch_assoc()) {
                                  ?>
                                  <tr>
                                      <td><?= $count++ ?></td>
                                      <td><?= $row["title"] ?></td>
                                      <td>
                                      <a href="delete-streem.php?title=<?php echo $row['title'];?>" onClick="return deldata('<?php echo $row['title']; ?>');" class="delete-link">
                                      <button class='btn btn-danger'><i class='fa fa-trash'></i> Delete</button>
                                      </a>
                                         
                                      </td>
                                  </tr>
                                  <?php
                              }
                          } else {
                              echo "0 results";
                          }
                          $conn->close();
                          ?>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <!-- Info boxes -->
            <div class="card">
              <div class="card-header py-2">
                <h3 class="card-title">
                  Add New Streem
                </h3>
              </div>
              <div class="card-body">
                <form action="" method="POST">
                  <div class="form-group">
                    <label for="title">Streem Name</label>
                    <input type="text" name="title" placeholder="Name" required class="form-control">
                  </div>
                  
                  <button name="submit" class="btn btn-success float-right">
                    Submit
                  </button>
                </form>
              </div>
            </div>
          </div>
        </div>   

      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
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
