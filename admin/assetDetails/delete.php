<?php 
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
    die();
  }
 ?>
<html lang="en-IN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="IT-CMS: Thinking Ahead.">
<meta name="keywords" content="IT, CMS">
<meta name="author" content="Chandan Kumar Nayak">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- SWEET ALERT JS -->
 <script src="../../js/jquery-3.5.1.min.js"></script>
 <script src="../../js/sweetalert2.all.min.js"></script>
</head>
<body>
<!-- DELETE RECORD -->
<?php
 require "../db.php";
$id = "";
if(isset($_GET['id']) && $_GET['id'] !='' )
{
$id=mysqli_real_escape_string($db, $_GET['id']);
$query = "DELETE FROM `assetdetails` WHERE id=$id"; 
if($result = mysqli_query($db, $query)) {
	header ("location: index.php?d=1");
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
</body>
</html>