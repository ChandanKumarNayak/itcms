<?php 
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
    die();
  }
 ?>
<!-- DELETE RECORD -->
<?php
 require "../db.php";
$id = "";
if(isset($_GET['id']) && $_GET['id'] !='' )
{
$id=mysqli_real_escape_string($db, $_GET['id']);
$query = "DELETE FROM `assetstock` WHERE id=$id"; 
if($result = mysqli_query($db, $query))
{
	header ("location: index.php?d=1");
	die();
}
else {
	echo "Something went wrong!";
}
}
?>