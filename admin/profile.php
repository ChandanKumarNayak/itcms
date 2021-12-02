<?php 
ob_start();
if (!isset($_SESSION['email'])) {
    header('location: index.php');
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
<title>Edit: Admin Details | IT-CMS</title>
    <link rel="icon" type="image/png" href="../img/IT.png"/> <!-- page icon -->
 	<!-- SWEET ALERT JS -->
 <script src="../js/jquery-3.5.1.min.js"></script>
 <script src="../js/sweetalert2.all.min.js"></script>
 </head>
 <body>
 <!-- FETCH ADMIN DETAILS -->
 <div class="modal fade" id="update_profile<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
<div class="modal-content">
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Admin Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
  <div class="form-group">
    <label>Name<span style="color:red;">*</span></label>
    <input type="text" name="name" placeholder="Name" value="<?php echo $row['name']; ?>" class="form-control" required>
  </div>
  <div class="form-group">
    <label>Designation<span style="color:red;">*</span></label>
    <select name="designation" class="form-control" required>
<option value="<?php echo $row['designation'];?>" selected="selected"><?php echo $row['designation'];?></option>
  <?php
require "db.php";
$getdata=("SELECT * FROM `designation` ORDER BY designation ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?>
<option value="<?php echo $row['designation'];?>"><?php echo $row['designation'];?></option> 
<?php 
}
  ?> 
</select>
  </div>
<?php 
$getdata=("SELECT * FROM `admin` WHERE email='".$_SESSION['email']."'");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?>
  <div class="form-group">
  <label>Department<span style="color:red;">*</span></label>
    <select name="department" class="form-control" required>
<option value="<?php echo $row['department']; ?>" selected="selected"><?php echo $row['department']; ?></option>
<?php }
  ?> 
  <?php
$getdata=("SELECT * FROM `department` ORDER BY department ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?>
<option value="<?php echo $row['department'];?>"><?php echo $row['department'];?></option>
<?php 
}
  ?> 
</select>
 </div> 
  <?php 
$getdata=("SELECT * FROM `admin` WHERE email='".$_SESSION['email']."'");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?>
  <div class="form-group">
  <label>Phone<span style="color:red;">*</span></label>
    <input type="tel" maxlength="10" pattern="^[6789]\d{9}$" name="phone" placeholder="Phone" value="<?php echo $row['phone']; ?>" class="form-control" required>
  </div>
  <?php }
  ?>
  </br>
  <div class="modal-footer">
    <button type="submit" name="update" class="btn btn-success">update</button>
    <button class="btn btn-danger" type="button" data-dismiss="modal">close</button>
  </div>
</form>
</div>
    </div>
  </div>
</div>
</body>
</html>
<!-- UPDATE DETAILS -->
<?php 
if(isset($_POST['update'])) 
{
  $name_pre= mysqli_real_escape_string($db, $_POST['name']);
  $name=$_POST['name'];
  $phone_pre = mysqli_real_escape_string($db, $_POST['phone']);
  $phone = $_POST['phone'];
  $designation_pre = mysqli_real_escape_string($db, $_POST['designation']);
  $designation = $_POST['designation'];
  $department_pre = mysqli_real_escape_string($db, $_POST['department']);
  $department = $_POST['department'];
  if(empty($name) || empty($phone) || empty($designation) || empty($department)){
    echo "<script>swal.fire ({
      type: 'error',
      title: 'Error',
      text: 'Please Fill All The Required Fields!',
      icon: 'error',
    }).then(function(){window.location = 'admin.php'})
    </script>";     
  }
  else{
$sql="UPDATE `admin` SET name='$name' ,phone='$phone' ,designation='$designation',department='$department' WHERE email='".$_SESSION['email']."'";  
if($result = mysqli_query($db, $sql))
if(($result) > 0)
{
    header ("Location:".htmlspecialchars($_SERVER["PHP_SELF"])."?s=1");
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