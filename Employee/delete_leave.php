<?php
include('../inc/topbar.php'); 
if(empty($_SESSION['login_email']))
{   
header("Location: ../Account/login.php"); 
}


$id=$_GET['id'];
$sql = "DELETE From `tblleave` where leaveID ='$id'";
$result = mysqli_query($conn, $sql);
//$row = mysqli_num_rows($result);
if ($result >0){

header("location: leave_history.php");
}
?>