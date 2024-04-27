<?php
include('../inc/topbar.php');
if(empty($_SESSION['admin-username']))
{
header("Location: login.php");
}

//approve leave
if(isset($_GET['id']))
{
$id=intval($_GET['id']);

$sql = "UPDATE tblleave SET status=? where leaveID=?";
$stmt= $dbh->prepare($sql);
$stmt->execute(["Approved", $id]);
header("location: leave_record.php");
}

//decline leave
if(isset($_GET['did']))
{
$did=intval($_GET['did']);

$sql = "UPDATE tblleave SET status=? where leaveID=?";
$stmt= $dbh->prepare($sql);
$stmt->execute(["Declined", $did]);
header("location: leave_record.php");


}

?>
