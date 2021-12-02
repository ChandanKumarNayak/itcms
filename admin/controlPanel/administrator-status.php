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
<?php
require '../db.php';
$id="";
if(isset($_GET['id']) && $_GET['id'] !='' )
{
$id=mysqli_real_escape_string($db, $_GET['id']);
$query1 = "SELECT * FROM admin WHERE id = '$id'";
$qresult=mysqli_query($db, $query1);
  $count=mysqli_num_rows($qresult);
while ($row = mysqli_fetch_assoc($qresult)) {
    $status = $row ["status"];
}
if ($status == 'Active') {
    $status = 'Deactive';
} else {
    $status = 'Active';
}
echo $status;
    $query1 = "UPDATE admin SET status = '$status'
                WHERE id = '$id'";              
    if($qresult=mysqli_query($db, $query1)) {
    header ("location: index.php?status=1");
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
</form>
</body>
</html>