<?php 
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    die();
  }
  require "detect_admin.php";
 ?>
 <html lang="en-IN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="IT-CMS: Thinking Ahead.">
<meta name="keywords" content="IT, CMS">
<meta name="author" content="Chandan Kumar Nayak">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add: Task | IT-CMS</title>
    <link rel="icon" type="image/png" href="../img/IT.png"/> <!-- page icon -->
<!-- SWEET ALERT JS -->
 <script src="../js/jquery-3.5.1.min.js"></script>
 <script src="../js/sweetalert2.all.min.js"></script>
</head>
<body>
 <?php 
require 'db.php';
if(isset($_POST['add'])) 
{
  $task_pre = mysqli_real_escape_string($db, $_POST['task']);
  $task = filter_var($task_pre, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  $reg_date_pre = mysqli_real_escape_string($db, $_POST['reg_date']);
  $reg_date = filter_var($reg_date_pre, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  $user_pre = mysqli_real_escape_string($db, $_POST['user']);
  $user = filter_var($user_pre, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
  if(empty($task) || empty($reg_date) || empty($user)){
    echo "<script>swal.fire ({
      type: 'error',
      title: 'Error',
      text: 'Please Fill All The Required Fields!',
      icon: 'error',
    }).then(function(){window.location = 'admin.php'})
    </script>";      
  }
  else{
  $sql="INSERT INTO `task` (task,user,reg_date,status) VALUES ('$task' ,'$user' ,'$reg_date','Active')";	
if($result = mysqli_query($db, $sql))
{
  header ("Location:admin.php?add=1");
  die();
}
else {
echo "<script>swal.fire ({
  type: 'error',
  title: 'Error',
  text: 'Something Went Wrong!',
  icon: 'error',
}).then(function(){window.location = 'admin.php'})
</script>";  
}
}
}
?>
<!-- RESUBMIT FORM PREVENT -->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>