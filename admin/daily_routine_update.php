<?php 
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    die();
  }
  require "detect_admin.php";
 ?>
<?php
require 'db.php';
$status ="";
$id="";
if(isset($_POST['id']) && $_POST['id'] !='' )
$id= $_POST['id'];
                $getDR=("SELECT * FROM daily_routine WHERE id='$id'");
                if($resultDR = mysqli_query($db, $getDR))
                if(mysqli_num_rows($resultDR) > 0) 
                while($row = mysqli_fetch_assoc($resultDR)) 
                {   
                $status=$row['status']; 
                }
                if ($status == 1) {
                    $status = 0;
                } else {
                    $status = 1;
                }
$updateDR="UPDATE daily_routine SET status='$status' WHERE id='$id'";
$resultUpdateDR = mysqli_query($db,$updateDR);
?>