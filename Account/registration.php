<?php 
include('../inc/topbar.php'); 

    if(isset($_POST["btnsubmit"])){
         
    $employeeID= 'STAFF/FKP/'.date("Y").'/'.rand(1000,5009);  
    $sql = 'INSERT INTO tblemployee(employeeID,fullname,password,sex,email,dob,phone,address,qualification,dept,employee_type,date_appointment,basic_salary,gross_pay,status,leave_status,photo) VALUES(:employeeID,:fullname,:password,:sex,:email,:dob,:phone,:address,:qualification,:dept,:employee_type,:date_appointment,:basic_salary,:gross_pay,:status,:leave_status,:photo)';
    $statement = $dbh->prepare($sql);
    $statement->execute([
	':employeeID' => $employeeID ,
	':fullname' => $_POST['txtfullname'],
	':password' => $_POST['txtpassword'],
    ':sex' => $_POST['cmdsex'],
	':email' => $_POST['txtemail'],
    ':dob' => '',
	':phone' => $_POST['txtphone'],
    ':address' => '',
	':qualification' => '',
    ':dept' => $_POST['cmddept'],
	':employee_type' => $_POST['cmdemployeetype'],
	':date_appointment' => '',
    ':basic_salary' => $_POST['txtbasic_salary'],
	':gross_pay' =>  $_POST['txtgross_pay'],
    ':leave_status' => 'Not Available',
    ':gross_pay' =>  $_POST['txtgross_pay'],
    ':photo' => 'uploadImage/Profile/default.png'
    ]);
    if ($statement){
      $_SESSION['success']='Registration was Successful';
    } else {
     $_SESSION['error']='Something went Wrong';

    }
}
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from verify.waeconline.org.ng/Individual/IndividualRegistration by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2023 15:21:15 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration - <?php echo $sitename ;?></title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="../css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="../css/iofrm-theme13.css">
    <link href="../css/auth.css" rel="stylesheet" />
    <link href="../plugin/TelPlugin/build/css/intlTelInput.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../app-assets/vendors/css/switchery.min.css">
    <link href="../css/doublesided.css" rel="stylesheet" />
    <link rel="icon" type="image/png" sizes="16x16" href="../image/logo.jpeg">

</head>

<body style="height:100vh;overflow-y:auto;" class="d-flex flex-column">

    <div class="form-body">
        <div class="row">
            <div class="img-holder d-flex flex-column">
                <div class="aa"></div>
                <div class="bb"></div>
                <div class="info-holder" style="z-index:4;">
                    <br />
                    <a class=" btn btn-outline-light text-white" style="z-index: 10000;position: relative;" href="../index.php">← Home</a>

                </div>
                <section class="footer pt-0 mt-auto bg-dark" style="z-index:1000">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center footer-alt my-1">
                                    <p class="f-15">
                                        <?php include('../inc/footer2.php'); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="form-holder" style="height: 100%;overflow-y: auto; max-height:unset;">
                <div class="aa"></div>
                <div class="bb"></div>

                <div class="form-content" style="max-height: unset;">

                    <div class="form-items card" style="z-index:100">
                    <img src="../image/logo.png" alt="" class="logo-light" height="81">

                        <div class="card-header d-flex flex-wrap">
                            
                            <a href="../index.php" style="z-index: 3;" class="btn p-2 btn-outline-primary mr-auto d-inline-flex align-items-center"><i class="fas fa-home fa-2x" title="home"></i></a>
                            <h4 class="mr-auto my-auto text-center">Employee Registration</h4>
                            <div class="ml-auto"></div>
                        </div>

                        <div class="card-body">
                            <form method="post" id="regForm" class="form form-horizontal" novalidate autocomplete="off" action="">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 form-group mb-2">
                                            <div class="controls">
                                                <input class="form-control" type="text" placeholder="Fullname" required data-validation-required-message="Fullname is required" data-val="true" data-val-required="The Fullname field is required." id="txtsurname" name="txtfullname" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 form-group mb-2">
                                            <div class="controls">
                                            <input class="form-control" type="text" placeholder="Mobile Number" required data-validation-required-message="Mobile Number is required" data-val="true" data-val-required="The Phone field is required." id="txtphone" name="txtphone" value="">
                                                <span id="error-msg" class="hide"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 form-group mb-2">
                                            <div class="controls">
                                            <select class="form-control" required data-validation-required-message="Select Sex " data-val="true" data-val-required="The Sex field is required." id="cmdsex" name="cmdsex">
                                                    <option value="">Select Sex</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 form-group mb-2">
                                            <div class="controls">
                                            <input type="text" autocomplete="off" class="form-control" required data-validation-required-message="Email Address is required" data-validation-regex-regex="([a-zA-Z0-9_\.-]+)@([\da-zA-Z\.-]+)\.([a-zA-Z\.]{2,6})" data-validation-regex-message="Email Address not valid" placeholder="Email Address" data-val="true" data-val-required="The Email field is required." id="txtemail" name="txtemail" value="">
                                                <span id="error-msg" class="hide"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 form-group mb-2">

                                            <div class="controls">
                                                <input class="form-control" type="Password" placeholder="Password" autocomplete="off" required data-validation-regex-regex="^(?=.*[A-z])(?=.*[A-Z])(?=.*[0-9])\S{6,12}$" data-validation-regex-message="Password must contain at least an Uppercase, Lowercase and a Number and must be between 6 and 12 digits" data-val="true" data-val-length="You must specify a password between 6 and 12 characters" data-val-length-max="12" data-val-length-min="6" data-val-required="The Password field is required." id="txtpassword" maxlength="12" name="txtpassword">
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-6 col-md-12 form-group mb-2">
                                            <div class="controls">

                                            <select class="form-control" required data-validation-required-message="Select Employee Department" data-val="true" data-val-required="The Employee Department field is required." id="cmddept" name="cmddept">
                                                    <option value="">... Select Department ...</option>
                                                    <option value="Security">Security</option>
                                                    <option value="Bursary">Bursary</option>
                                                    <option value="Student Affairs">Student Affairs</option>
                                                    <option value="Clinic">Clinic</option>
                                                    <option value="ICT">ICT</option>
                                                    <option value="Admin">Admin</option>
                                                    <option value="Science & Technology">Science & Technology</option>
                                                    <option value="Management Technolgy">Management Technolgy</option>
                                                    <option value="Engineering Technology">Engineering Technology</option>
                                                    

                                                    </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 form-group mb-2">
                                            <div class="controls">
                                            <select class="form-control" required data-validation-required-message="Select Emplooyee Type" data-val="true" data-val-required="The Employee Type field is required." id="cmdemployeetype" name="cmdemployeetype">
                                                    <option value="">Select Employee Type</option>
                                                    <option value="Academic">Academic</option>
                                                    <option value="Non-Academic">Non-Academic</option>
                                                    </select>
                                         </div>
                                        </div>
                                       
                                        <div class="col-lg-6 col-md-12 form-group mb-2">
                                            <div class="controls">
                                            <input class="form-control" type="number" placeholder="Basic Salary" required data-validation-required-message="Basic Salary is required" data-val="true" data-val-required="The Basic Salary field is required." id="txtbasic_salary" name="txtbasic_salary" value="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 form-group mb-2">
                                            <div class="controls">
                                            <input class="form-control" type="number" placeholder="Gross Pass" required data-validation-required-message="Gross Pay is required" data-val="true" data-val-required="The Gross Pay field is required." id="txtgross_pay" name="txtgross_pay" value="">

                                            </div>
                                        </div>

                                    
                                        </div>
                                    </div>
                                    <div class="row">

                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group mb-2">

                                        </div>
                                    </div>
                                    <div class="row d-flex flex-wrap">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <button name="btnsubmit" type="submit" class="btn btn-dark">Submit</button>
                                            </div>
                                        </div>
                                        <p>or click<a href="Login.php"> here to login</a> if you have an account</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script type="text/javascript" src="../js/jquery.min.js"></script>
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script src="../app-assets/vendors/js/jquery.validate.min.js" type="text/javascript"></script>
    <script src="../app-assets/vendors/js/jqBootstrapValidation.js" type="text/javascript"></script>
    <script src="../app-assets/js/form-validation.js" type="text/javascript"></script>
    <script src="../../www.google.com/recaptcha/api6979.js?render=6Lf3z9wUAAAAAPTC6tPRnbU73Vnq_OGvNHzEgFxi"></script>
    <script src="../plugin/TelPlugin/build/js/intlTelInput.min.js"></script>
    <script src="../plugin/TelPlugin/build/js/intlTelInput-jquery.min.js"></script>
    <script src="../app-assets/vendors/js/switchery.min.js" type="text/javascript"></script>
    <script src="../app-assets/js/switch.min.js" type="text/javascript"></script>
    <script src="../js/doublesided.js"></script>
    
    <script src="../js/IndividualRegistration.js"></script>



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

<!-- Mirrored from verify.waeconline.org.ng/Individual/IndividualRegistration by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 16 Nov 2023 15:21:31 GMT -->

</html>