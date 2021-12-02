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
<div class="modal fade" id="update_modal<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
<div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Admin Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form method="POST" action="" enctype="multipart/form-data">
<?php $admin_id =  $row['id'];    ?>
    <div class="form-group">
      <label>Name<span style="color:red;">*</span></label>
      <input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
      <input type="text" name="name" placeholder="Name" class="form-control" value="<?php echo $row['name'];?>" required />
    </div>
    <div class="form-group">
      <label>Email ID<span style="color:red;">*</span></label>
      <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" placeholder="Email" class="form-control" value="<?php echo $row['email'];?>" required />
    </div>
    <div class="form-group">
      <label>Phone No<span style="color:red;">*</span></label>
      <input type="tel" maxlength="10" pattern="^[6789]\d{9}$" name="phone" placeholder="Phone" class="form-control" value="<?php echo $row['phone'];?>" required />
    </div>
    <div class="form-group">
      <label>Designation<span style="color:red;">*</span></label>
      <select name="designation" class="form-control" required>
<option value="<?php echo $row['designation'];?>" selected="selected"><?php echo $row['designation'];?></option>
<?php
$designation = "";
$getdata=("SELECT * FROM `designation` ORDER BY designation ASC");
if($getresult = mysqli_query($db, $getdata))
if(mysqli_num_rows($getresult) > 0)
while($row = mysqli_fetch_assoc($getresult))
{
  $designation = $row['designation'];
  echo "<option value='$designation'>$designation</option>";
}
  ?> 
</select>
    </div>
    <div class="form-group">
      <label>Department<span style="color:red;">*</span></label>
      <select name="department" class="form-control" required>
 <?php
$getdata=("SELECT * FROM `admin` WHERE id = '$admin_id'");
if($getresult = mysqli_query($db, $getdata))
if(mysqli_num_rows($getresult) > 0)
while($row = mysqli_fetch_assoc($getresult))
{?>     
<option value="<?php echo $row['department'];?>" selected="selected"><?php echo $row['department'];?></option>
<?php } ?>
<?php
$department = "";
$getdata=("SELECT * FROM `department` ORDER BY department ASC");
if($getresult = mysqli_query($db, $getdata))
if(mysqli_num_rows($getresult) > 0)
while($row = mysqli_fetch_assoc($getresult))
{
  $department = $row['department'];
  echo "<option value='$department'>$department</option>";
}
  ?> 
</select>
</div>
<?php
$getdata=("SELECT * FROM `admin` WHERE id = '$admin_id'");
if($getresult = mysqli_query($db, $getdata))
if(mysqli_num_rows($getresult) > 0)
while($row = mysqli_fetch_assoc($getresult))
{?>  
    <div class="form-group">
      <label>Login Passcode<span style="color:red;">*</span></label>
      <input type="text" name="password" placeholder="Passcode" class="form-control" value="<?php echo $row['password'];?>" required />
    </div>
<?php } ?>
    <div class="modal-footer">
    <button type="submit" name="edit" class="btn btn-success">update</button>
    <button class="btn btn-danger" type="button" data-dismiss="modal">close</button>
  </div>
</form>
</div>
    </div>
  </div>
</div>
</body>
</html>
<!-- UPDATE ADMIN DETAILS -->
 <?php 
require '../db.php';
if(isset($_POST['edit'])) 
{
  $id=$_POST['id']; 
  $name=$_POST['name'];
  $email = $_POST['email'];
  $sqluser="SELECT email FROM admin WHERE email='$email' AND id!='$id'";
  $qresult=mysqli_query($db, $sqluser);
  $count=mysqli_num_rows($qresult);
  if($count > 0)
{
echo "<script>swal.fire ({
  type: 'error',
  title: 'Error',
  text: 'Duplicate email id entered!',
  icon: 'error',
})
</script>";
}
  else
  { 
  $phone = $_POST['phone'];
  $designation = $_POST['designation'];
  $department = $_POST['department'];
  $password = $_POST['password'];
  $sql="UPDATE `admin` SET name='$name',email='$email',phone='$phone',designation='$designation',department='$department',password='$password' WHERE id='$id'";
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
}
?>