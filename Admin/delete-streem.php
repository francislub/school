<?php
include('../inc/topbar.php');
if(empty($_SESSION['admin-username']))
    {
      header("Location: login.php");
    }

$id= $_GET['title'];
$sql = "DELETE FROM posts WHERE title=? and type='section'";
$stmt= $dbh->prepare($sql);
$stmt->execute([$id]);

header("Location: streem.php");
 ?>
