<?php 
session_start();
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    die();
  }
 ?>
<?php
echo "* Send ITools working condition checklist of Cuttack Setup to Kolkata.";
?>