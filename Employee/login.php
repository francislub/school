<?php
session_start();
error_reporting(1);
include('../connect.php');

//Get website details
$sql_website = "select * from website_setting"; 
$result_website = $conn->query($sql_website);
$row_website = mysqli_fetch_array($result_website);


if(isset($_POST['btnlogin'])){


//Get Date
date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d h:i:s');


$email = $_POST['txtemail'];
$password = $_POST['txtpassword'];
$status = 'Active';


 $sql = "SELECT * FROM users WHERE email='" .$email. "' and password = '".$password."'  and status = '".$status."'";
  $result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
 ($row = mysqli_fetch_assoc($result));
	 $_SESSION["email"] = $row['email'];
   $_SESSION["password"] = $row['password'];
 $_SESSION["phone"] = $row['phone'];
 	 $firstname = $row['firstname'];
 	  $_SESSION["firstname"] = $row['firstname'];

		 $fa = $row['2FA'];

	}
if (($fa) =='1') {




// generate OTP
$_SESSION["vcode"] = rand(100000,999999);
$phone=$_SESSION["phone"];

//SEnd Verification code Via SMS
//$username='udgems@gmail.com';//Note: urlencodemust be added forusernameand 
//$password='Godrules55';// passwordas encryption code for security purpose.

//$sender='AMARITRADE';

//$url = "http://portal.nigeriabulksms.com/api/?username=".$username."&password=".$password."&message="."Your OTP Code is :  ".$_SESSION["vcode"]."&sender=".$sender."&mobiles=".$phone;

//$ch = curl_init();
//curl_setopt($ch,CURLOPT_URL, $url);
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//curl_setopt($ch, CURLOPT_HEADER, 0);
//$resp = curl_exec($ch);

//SEnd Verification code Via email
$to = $username;
			$subject = "OTP|AMARITRADE";
			$message = "
				<html>
				<head>
				<title>OTP|AMARITRADE t</title>
				</head>
				<body>
				 <img src=\"https://www.amari-trade.com/user/images/favicon.png\">
			
			<p>Hello $firstname,</p>
                            
							------------------------------------------------------------------------
                            <p>Here is your OTP : <h2> ".$_SESSION["vcode"]." </h2></p>
						     ------------------------------------------------------------------------
			  			
						<p>It will expire in the next 15 minutes</p>
			  			
						<p>Thanks</p>



				</body>
				</html>
				";
			 //dont forget to include content-type on header if your sending html
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= "From: support@amari-trade.com". "\r\n" ;
		mail($to,$subject,$message,$headers);



if($resp){

//save otp
$query = "INSERT into `verification_code` (v_code, phone, datetime_created)
VALUES ( '".$_SESSION["vcode"]."', '$phone','$current_date')";
$result = mysqli_query($conn,$query);
}

		
header("Location: 2FA-verification.php"); 
}elseif(($fa) =='0') { 
header("Location: index.php"); 
}else { 
$_SESSION['error']=' Wrong Email Address and Password or Account is Not Activated ';
}
}
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>login Form| <?php echo $row_website['websitename'];?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="../<?php echo $logo;?>">
 <style type="text/css">
<!--
.style3 {
	color: #FF0000;
	font-weight: bold;
	font-size: 24px;
}
.style4 {color: #FF0000}
-->

</style>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h2 class="style3"><?php echo $row_website['url'];?></h2>
                <h1 class="logo-name"><a href="../index.php"><img src="../img/favicon.png" alt="Amitrade" width="246" height="161" border="0"></a></h1>
            </div>
            <h3 class="style4">Login Form </h3>
            <form class="m-t" role="form" method= "POST" action="">
                <div class="form-group">
                    <input type="text" name="txtemail" class="form-control" placeholder="Email" required="">
                </div>
                <div class="form-group">
                    <input type="password" name="txtpassword" class="form-control" placeholder="Password" required="">
                </div>

                <button type="submit" name="btnlogin" class="btn btn-primary block full-width m-b">Login</button>




                <a href="forgot_password.php"><small>Forgot password?</small></a>
			
				
                <p class="text-muted text-center">&nbsp;</p>
          </form>
            <p class="m-t"></p>
			
        </div>
    </div>
	
    <?php include('../inc/footer.php');  ?>
    <!-- Mainly scripts -->
    <script src="js/jquery-2.1.1.js"></script>
    <script src="js/bootstrap.min.js"></script>
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
