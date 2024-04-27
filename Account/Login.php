<?php
include('../inc/topbar.php'); 


if(isset($_POST['btnlogin'])){


//Get Date
date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d h:i:s');


$email = $_POST['txtemail'];
$password = $_POST['txtpassword'];
$status = '1';


 $sql = "SELECT * FROM tblemployee WHERE email='" .$email. "' and password = '".$password."'  and status = '".$status."'";
  $result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
 ($row = mysqli_fetch_assoc($result));
	 $_SESSION["login_email"] = $row['email'];
		
header("Location: ../Employee/index.php"); 
}else { 
$_SESSION['error']=' Wrong Email Address and Password';
}
}
?>

<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from verify.waeconline.org.ng/Individual/Login by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2023 15:20:35 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Login - Foundation Polytechnic, Ikot Ekpene</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="../css/iofrm-theme13.css">
    <link href="../css/auth.css" rel="stylesheet" />
    <link href="../css/singlesided.css" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="16x16" href="../image/logo.jpeg">

</head>
<body style="height:100vh;overflow-y:auto;" class="d-flex flex-column">
        <div class="form-body">
            <div class="row">

                <div class="form-holder">
                    <div class="aa"></div>
                    <div class="bb"></div>

                    <div class="form-content h-100">
                        <div class="form-items card" style="z-index:100">
                            <img class="logo-size card-img-top w-auto" src="../image/logo.png" height="100" alt="">
                            <div class="card-header d-flex flex-wrap">
                                <a href="../index.php" style="z-index: 3;" class="btn p-2 btn-outline-primary mr-auto d-inline-flex align-items-center"><i class="fas fa-home fa-2x" title="home"></i></a><h2 class="mr-auto">Employee Login</h2><div class="ml-auto"></div>
                            </div>
                            <div class="card-body">
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-control" type="email" placeholder="Email Address" required id="txtemail" name="txtemail" value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input class="form-control" type="password" placeholder="Password" required id="txtpassword" name="txtpassword">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap">
                                    <div class="form-button d-flex flex-wrap">
                                        <button name="btnlogin" type="submit" class="btn btn-dark">Login</button>
                                    </div>
                                    <div>
                                        <p>Not an Employee Yet? <a href="registration.php">Register Here</a></p>
                                    </div>
                                </div>

                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <section class="footer pt-0 mt-auto bg-dark">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center footer-alt my-1">
                        <p class="f-15">
                        <?php include('../inc/footer2.php') ; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/main.js"></script>




    <link rel="stylesheet" href="../css/popup_style.css">
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