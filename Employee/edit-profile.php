<?php
include('../inc/topbar.php');
if (empty($_SESSION['login_email'])) {
    header("Location: ../Account/login.php");
}

if (isset($_POST["btnedit"])) {
    $sql = " update tblemployee set fullname='".$_POST['txtfullname']."',sex='".$_POST['cmdsex']."',dob='".$_POST['txtdob']."',phone='".$_POST['txtphone']."',address='".$_POST['txtaddress']."',qualification='".$_POST['txtqualification']."',dept='".$_POST['cmddept']."',employee_type='".$_POST['cmdemployeetype']."',date_appointment='".$_POST['txtappointment']."',basic_salary='".$_POST['txtbasic_salary']."',gross_pay='".$_POST['txtgross_pay']."' where email='$email'";
    if (mysqli_query($conn, $sql)) {
        header("Location: profile.php");
    } else {
        $_SESSION['error'] = 'Editing Was Not Successful';
    }
}
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Employee Profile| <?php echo $sitename; ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Morris -->
    <link href="css/plugins/morris/morris-0.4.3.min.css" rel="stylesheet">
    <!-- Gritter -->
    <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="../<?php echo $logo; ?>">

</head>

<body>
    <div id="wrapper">

        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                                <img src="../<?php echo $rowaccess['photo'];  ?>" alt="image" width="142" height="153" class="img-circle" />
                            </span>


                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear"><span class="text-muted text-xs block"><?php echo $rowaccess['email'];  ?> <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">

                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                        <?php
                        include('sidebar.php');

                        ?>

                </ul>

            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg">
            <div class="row border-bottom">
                <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
                    <div class="navbar-header">
                        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>

                    </div>
                    <ul class="nav navbar-top-links navbar-right">
                        <li>

                            <span class="m-r-sm text-muted welcome-message">Welcome to <?php echo $row_website['websitename']; ?></span>
                        </li>
                        <li class="dropdown">




                        <li>
                            <a href="logout.php">
                                <i class="fa fa-sign-out"></i> Log out
                            </a>
                        </li>

                    </ul>

                </nav>


            </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.php">Home</a>
                        </li>

                        <li class="active">
                            <strong>Edit Employee Profile</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5></h5>
                                <div class="ibox-tools">
                                    <a class="collapse-link">
                                        <i class="fa fa-chevron-up"></i>
                                    </a>
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-user">
                                        <li><a href="#">Config option 1</a>
                                        </li>
                                        <li><a href="#">Config option 2</a>
                                        </li>
                                    </ul>
                                    <a class="close-link">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </div>
                            </div>


                            <?php
                            $sql = "select * from tblemployee where email='$email'";
                            $result = $conn->query($sql);
                            $row = mysqli_fetch_array($result);

                            ?>
                            <div class="ibox-content">
                                <div class="row">
                                    <div class="col-sm-6 b-r">
                                        <h3 class="m-t-none m-b">Edit Employee Profile</h3>
                                        <form action="" method="POST">
                                            <div class="form-group"><strong>
                                                    <label>Fullname</label></strong>
                                                <input type="text" size="77" name="txtfullname" value="<?php echo $row['fullname'];   ?>" class="form-control" required="">
                                            </div>

                                           
                                            <div class="form-group"><label>Sex</label>
                                                <select name="cmdsex" id="cmdsex" class="form-control" required="">
                                                    <option value="<?php echo $row['sex'];   ?>"><?php echo $row['sex'];   ?></option>
                                                    <option value="Afganistan">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Phone</label> 
                                                <input type="text" size="77" name="txtphone" value="<?php echo $row['phone'];   ?>" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Date of Birth</label> 
                                                <input type="text" size="77" name="txtdob" value="<?php echo $row['dob'];   ?>" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Address</label> 
                                                <input type="text" size="77" name="txtaddress" value="<?php echo $row['address'];   ?>" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Date of Birth</label> 
                                                <input type="text" size="77" name="txtqualification" value="<?php echo $row['qualification'];   ?>" class="form-control">
                                            </div>
                                            <div class="form-group"><label>Department</label>
                                                <select name="cmddept" id="cmddept" class="form-control" required="">
                                                    <option value="<?php echo $row['dept'];   ?>"><?php echo $row['dept'];   ?></option>
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

                                            <div class="form-group"><label>Employee Type</label>
                                                <select name="cmdemployeetype" id="cmdemployeetype" class="form-control" required="">
                                                <option value="<?php echo $row['employee_type'];   ?>"><?php echo $row['employee_type'];   ?></option>
                                                <option value="Academic">Academic</option>
                                                <option value="Non-Academic">Non-Academic</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Date of Appointment</label> 
                                                <input type="text" size="77" name="txtappointment" value="<?php echo $row['date_appointment'];   ?>" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Basic Salary</label> 
                                                <input type="number" size="77" name="txtbasic_salary" value="<?php echo $row['basic_salary'];   ?>" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label>Gross Pay</label> 
                                                <input type="number" size="77" name="txtgross_pay" value="<?php echo $row['gross_pay'];   ?>" class="form-control">
                                            </div>
                                            <div>

                                                <p>&nbsp;</p>
                                                <p>&nbsp;</p>
                                                <p>&nbsp;</p>
                                                <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit" name="btnedit">
                                                    <div align="centre"><strong><i class="fa fa-paste"></i> Edit</strong></div>
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5"></div>
                </div>
                <div class="row"></div>
            </div>
            <div class="footer">
                <div class="pull-right"></div>
                <div><?php include('../inc/footer.php');  ?></div>
            </div>

        </div>
    </div>


    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>

    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
    <link rel="stylesheet" href="../css/popup_style.css">
    <?php if (!empty($_SESSION['success'])) {  ?>
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
    <?php if (!empty($_SESSION['error'])) {  ?>
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
    <?php unset($_SESSION["error"]);
    } ?>
    <script>
        var addButtonTrigger = function addButtonTrigger(el) {
            el.addEventListener('click', function() {
                var popupEl = document.querySelector('.' + el.dataset.for);
                popupEl.classList.toggle('popup--visible');
            });
        };

        Array.from(document.querySelectorAll('button[data-for]')).
        forEach(addButtonTrigger);
    </script>
</body>

</html>