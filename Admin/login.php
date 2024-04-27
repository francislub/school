<?php
include('../inc/topbar.php');

if(isset($_POST['btnlogin']))
{

$username = $_POST['txtusername'];
$password = $_POST['txtpassword'];

$sql = "SELECT * FROM users WHERE username='".$username."' and password = '".$password."'";
$result = mysqli_query($conn,$sql);
$row  = mysqli_fetch_array($result);

 $_SESSION["admin-username"] = $row['username'];

 $count=mysqli_num_rows($result);
 if(isset($_SESSION["admin-username"])) {
{

header("Location: index.php");
}
}
else {
$_SESSION['error']=' Wrong Username and Password';
     }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin login|<?php echo $sitename; ?></title>

  <link rel="icon" type="image/png" sizes="16x16" href="../image/logo.jpeg">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style type="text/css">
.body {
    <?php
      // PHP code to dynamically generate the background image URL
      $image_path = '../image/bg.jpeg'; // Adjust the path to your image accordingly
    ?>
    background-image: url('<?php echo $image_path; ?>');
    background-size: cover;
    background-repeat: no-repeat;
    backdrop-filter: contrast(1);
  }
<!--
.style2 {
	color: #000099;
	font-weight: bold;
}
.style4 {color: #0000FF; font-size: 16px; }
-->
  </style>
</head>
<body class="hold-transition body login-page ">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b><img src="../<?php echo $logo ; ?>" width="100" height="100"><span class="style4"><?php echo $sitename ; ?>  </span></b></a>  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg style2">ADMIN LOGIN FORM </p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="txtusername" placeholder="Enter Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="txtpassword" placeholder="Enter Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="btnlogin" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- /.social-auth-links -->
<p class="mb-1">&nbsp;</p>
    </div>
    <!-- /.login-card-body -->
  </div>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
<p align="center">&nbsp;</p>
</div>
<!-- /.login-box -->


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<link rel="stylesheet" href="popup_style.css">
<?php if(!empty($_SESSION['success'])) {  ?>
<div class="popup popup--icon -success js_success-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Success</strong>
    </h1>
    <p><?php echo $_SESSION['success']; ?></p>
    <p>
      <button class="button button--success" data-for="js_success-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["success"]);
} ?>
<?php if(!empty($_SESSION['error'])) {  ?>
<div class="popup popup--icon -error js_error-popup popup--visible">
  <div class="popup__background"></div>
  <div class="popup__content">
    <h3 class="popup__content__title">
      <strong>Error</strong>
    </h1>
    <p><?php echo $_SESSION['error']; ?></p>
    <p>
      <button class="button button--error" data-for="js_error-popup">Close</button>
    </p>
  </div>
</div>
<?php unset($_SESSION["error"]);  } ?>
    <script>
      var addButtonTrigger = function addButtonTrigger(el) {
  el.addEventListener('click', function () {
    var popupEl = document.querySelector('.' + el.dataset.for);
    popupEl.classList.toggle('popup--visible');
  });
};

Array.from(document.querySelectorAll('button[data-for]')).
forEach(addButtonTrigger);
    </script>
</body>
</html>
