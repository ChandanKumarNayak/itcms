<?php 
session_start();
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    die();
  } 
  require('db.php');
$row=mysqli_fetch_assoc(mysqli_query($db, "SELECT status FROM `admin` WHERE email='".$_SESSION['email']."' "));
    echo $row["status"];
 ?>