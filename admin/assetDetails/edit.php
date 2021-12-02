<?php 
 ob_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
    die();
  }
 ?>
<!-- UPDATE ASSET DETAILS -->
 <?php 
require '../db.php';
$error='';
if(isset($_POST['edit'])) 
{
  $id=$_POST['id'];    
  $system_type=$_POST['system_type'];
  $system_name = $_POST['system_name'];
  $brand=$_POST['brand'];
  $model_no = $_POST['model_no'];
  $serial_no = $_POST['serial_no'];
  $sqluser="SELECT serial_no FROM assetdetails WHERE serial_no='$serial_no' AND serial_no!='N/A' AND id!='$id'";
  $qresult=mysqli_query($db, $sqluser);
  $count=mysqli_num_rows($qresult);
  if($count > 0)
{
  echo "<script>swal.fire ({
  type: 'error',
  title: 'Error',
  text: 'Entered Serial Number Already Exists.',
  icon: 'error',
})
</script>";
}
  else
  { 
  $os=$_POST['os'];
  $processor = $_POST['processor'];
  $ram=$_POST['ram'];
  $hard_disk = $_POST['hard_disk'];
  $ip=$_POST['ip'];
  $sqluser="SELECT ip FROM assetdetails WHERE ip='$ip' AND ip!='N/A' AND id!='$id'";
  $qresult=mysqli_query($db, $sqluser);
  $count=mysqli_num_rows($qresult);
  if($count > 0)
{
  echo "<script>swal.fire ({
  type: 'error',
  title: 'Error',
  text: 'Entered IP Address Already Assigned To Another System.',
  icon: 'error',
})
</script>";
}
  else
  { 
  $antivirus = $_POST['antivirus'];
  $user=$_POST['user'];
  $designation = $_POST['designation'];
  $department = $_POST['department'];
  $location = $_POST['location'];
  if(empty($system_type) || empty($system_name) || empty($brand) || empty($model_no) || empty($serial_no) || empty($ip) || empty($user) || empty($designation) || empty($department) || empty($location)){
    echo "<script>swal.fire ({
      type: 'error',
      title: 'Error',
      text: 'Please Fill All The Required Fields!',
      icon: 'error',
    }).then(function(){window.location = 'index.php'})
    </script>";     
  }
  else{
$sql="UPDATE `assetdetails` SET system_type='$system_type' ,system_name='$system_name' ,brand='$brand' ,model_no='$model_no' ,serial_no='$serial_no' ,os='$os' ,processor='$processor',ram='$ram',hard_disk='$hard_disk',ip='$ip',antivirus='$antivirus',user='$user' ,designation='$designation' ,department='$department' ,location='$location' WHERE id='$id'"; 
if($result = mysqli_query($db, $sql))
if($result > 0)
{
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
}
}
?>
<!-- FORM -->
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
 <!-- FETCH DETAILS -->
<div class="modal fade" id="update_asset_details<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-xl">
<div class="modal-content">
  <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asset Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
  </div>
  </br>
<div id='tbl-modal-inline'>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
<?php $asset_details_id =  $row['id'];    ?>
<div class="form-row">
    <div class="form-group col-md-3">
    <label>System Type<span style="color:red;">*</span></label>
    <input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
    <select name="system_type" id="Change" onchange="MakeChange()" class="form-control" required>
<option value="<?php echo $row['system_type'];?>" selected="selected"><?php echo $row['system_type'];?></option>
  <?php
$getdata=("SELECT * FROM `system_type` ORDER BY system_type ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?>
<option value="<?php echo $row['system_type'];?>"><?php echo $row['system_type'];?></option>
<?php }
  ?> 
    </select> 
    </div>
 <?php
$getdata=("SELECT * FROM `assetdetails` WHERE id='$asset_details_id'");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?> 
  <div class="form-group col-md-3">
  <label>System Name<span style="color:red;">*</span></label>
    <input type="textarea" name="system_name" placeholder="System name" class="form-control" value="<?php echo $row['system_name'];?>" required>
   </div>
  <div class="form-group col-md-3"> 
  <label>Brand<span style="color:red;">*</span></label>
    <input type="text" name="brand" placeholder="Brand" class="form-control" value="<?php echo $row['brand'];?>" required>
  </div> 
  <div class="form-group col-md-3"> 
  <label>Model No<span style="color:red;">*</span></label> 
    <input type="text" name="model_no" placeholder="Model no" class="form-control" value="<?php echo $row['model_no'];?>" required>
  </div> 
  <div class="form-group col-md-3"> 
  <label>Serial No<span style="color:red;">*</span></label> 
    <input type="text" name="serial_no" placeholder="Serial no" class="form-control" value="<?php echo $row['serial_no'];?>" required>
  </div> 
  <div id="OS" class="form-group col-md-3"> 
  <label>OS</label> 
    <input type="text" name="os" placeholder="Operating system" class="form-control" value="<?php echo $row['os'];?>">
  </div> 
  <div id="Processor" class="form-group col-md-3"> 
  <label>Processor</label> 
    <input type="text" name="processor" placeholder="Processor" class="form-control" value="<?php echo $row['processor'];?>">
  </div> 
  <div id="RAM" class="form-group col-md-3"> 
  <label>RAM</label> 
    <input type="text" name="ram" placeholder="RAM" class="form-control" value="<?php echo $row['ram'];?>">
  </div> 
  <div id="HardDisk" class="form-group col-md-3"> 
  <label>Hard Disk</label> 
    <input type="text" name="hard_disk" placeholder="Hard disk" class="form-control" value="<?php echo $row['hard_disk'];?>">
  </div> 
  <div class="form-group col-md-3"> 
  <label>IP Address<span style="color:red;">*</span></label> 
    <input type="text" name="ip" placeholder="IP address" class="form-control" value="<?php echo $row['ip'];?>" required>
  </div> 
  <div id="Antivirus" class="form-group col-md-3">
    <label>Antivirus Details</label>
    <textarea type="textarea" name="antivirus" placeholder="Antivirus details..." class="form-control"><?php echo $row['antivirus'];?></textarea>
  </div>
  <div class="form-group col-md-3">
  <label>User<span style="color:red;">*</span></label>
   <select name="user" class="form-control" required>
<option value="<?php echo $row['user'];?>" selected="selected"><?php echo $row['user'];?></option>
<?php 
}
  ?>
  <?php
$getdata=("SELECT * FROM `user` ORDER BY user ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?>
<option value="<?php echo $row['user'];?>"><?php echo $row['user'];?></option> 
<?php 
}
  ?> 
</select>
  </div>
<?php
$getdata=("SELECT * FROM `assetdetails` WHERE id='$asset_details_id'");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?>
  <div class="form-group col-md-3">
  <label>Designation<span style="color:red;">*</span></label>
    <select name="designation" class="form-control" required>
<option value="<?php echo $row['designation'];?>" selected="selected"><?php echo $row['designation'];?></option>
<?php 
}
  ?> 
  <?php
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
$getdata=("SELECT * FROM `assetdetails` WHERE id='$asset_details_id'");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?>
  <div class="form-group col-md-3">
  <label>Department<span style="color:red;">*</span></label>
    <select name="department" class="form-control" required>
<option value="<?php echo $row['department'];?>" selected="selected"><?php echo $row['department'];?></option>
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
  $getdata=("SELECT * FROM `assetdetails` WHERE id='$asset_details_id'");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?> 
  <div class="form-group col-md-3">
  <label>Location<span style="color:red;">*</span></label>
    <select name="location" class="form-control" required>
<option value="<?php echo $row['location'];?>" selected="selected"><?php echo $row['location'];?></option>
<?php }
  ?>
  <?php
$getdata=("SELECT * FROM `location` ORDER BY location ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?>
<option value="<?php echo $row['location'];?>"><?php echo $row['location'];?></option>
<?php 
}
  ?> 
</select>
  </div> 
</div>  
  </br>
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