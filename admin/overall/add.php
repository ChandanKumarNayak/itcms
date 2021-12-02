<?php 
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
    die();
  }
 ?>
<!-- Add Stocks -->
 <?php 
require '../db.php';
if(isset($_POST['add'])) 
{
  $asset_name=$_POST['asset_name'];
  $quantity = $_POST['quantity'];
$sql="INSERT INTO `assetstock` (asset_name,quantity) VALUES ('$asset_name' ,'$quantity')";	
if($result = mysqli_query($db, $sql))
{
   header ("Location:index.php?add=1");
    die();
}
else {
echo "<script>swal.fire ({
  type: 'error',
  title: 'Error',
  text: 'Something Went Wrong!',
  icon: 'error',
}).then(function(){window.location = 'index.php'})
</script>";  
}
}
?>
<!-- RESUBMIT FORM PREVENT -->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>