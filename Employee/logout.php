<?php 
 include('../inc/topbar.php'); 
if(empty($_SESSION['login_email']))
    {   
      header("Location: ../Account/login.php"); 
    } ?>

<?php
//Automatic logout
$t=time();
if (isset($_SESSION['logged']) && ($t - $_SESSION['logged'] > 36000)) {
	
	session_destroy();
    session_unset();
	echo ("<script LANGUAGE='JavaScript'>
    window.alert('Sorry , You have been Logout because of inactivity. Try Again');
    window.location.href='../Account/login.php';
    </script>");
	}else {
    $_SESSION['logged'] = time();
}   



session_destroy(); //destroy the session
?>

<script>
window.location="../Account/login.php";
</script>
<?php
//to redirect back to "index.php" after logging out
  exit;
?>