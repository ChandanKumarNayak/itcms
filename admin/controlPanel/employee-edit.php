<?php 
ob_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
    die();
  }
  if ($_SESSION['role'] != '1') {
    header('location: ../admin.php');
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
<div class="modal fade" id="update_employee<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
<div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Employee Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
      <label>Employee Name<span style="color:red;">*</span></label>
      <input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
      <input type="text" name="user" placeholder="Employee name" class="form-control" value="<?php echo $row['user'];?>" required />
    </div>
    <div class="modal-footer">
    <button type="submit" name="edit-employee" class="btn btn-success">update</button>
    <button class="btn btn-danger" type="button" data-dismiss="modal">close</button>
  </div>
</form>
</div>
    </div>
  </div>
</div>
</body>
</html>
<!-- UPDATE EMPLOYEE DETAILS -->
 <?php 
require '../db.php';
if(isset($_POST['edit-employee'])) 
{
  $id=$_POST['id']; 
  $user=$_POST['user'];
  $sql="UPDATE `user` SET user='$user' WHERE id='$id'";
  if($result = mysqli_query($db, $sql)) {
   header ("Location:index.php?s=1");
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