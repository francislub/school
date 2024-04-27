<?php 
session_start();
error_reporting(1);
include('../database/connect.php'); 
include('../database/connect2.php'); 

//set time
date_default_timezone_set('Africa/Lagos');
$current_date = date('Y-m-d H:i:s');

//fetch user data
$email = $_SESSION["login_email"];
$stmt = $dbh->query("SELECT * FROM tblemployee where email='$email'");
$rowaccess = $stmt->fetch();
$fullname=$rowaccess['fullname'];  
$phone=$rowaccess['phone'];  
$photo=$rowaccess['photo'];  
$email=$rowaccess['email'];  
$employeeID=$rowaccess['employeeID'];  
$leave_status=$rowaccess['leave_status'];  
$basic_salary=$rowaccess['basic_salary']; 
$gross_pay=$rowaccess['gross_pay']; 


$logo='image/logo.png';
$logo2='image/logo.jpeg';

//system setting
$sitename='School Management system';

//admin
$username = $_SESSION["admin-username"];
$stmt = $dbh->query("SELECT * FROM users where username='$username'");
$row_admin = $stmt->fetch();
$admin_fullname=$row_admin['fullname'];  
$admin_photo=$row_admin['photo'];  

?>