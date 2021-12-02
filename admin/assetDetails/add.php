<?php 
ob_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
    die();
  }
 ?>
<!-- ADD DETAILS -->
 <?php 
require '../db.php';
$error='';
$system_type="";
$system_name="";
$brand="";
$model_no="";
$serial_no="";
$os="";
$processor="";
$ram="";
$hard_disk="";
$ip="";
$antivirus="";
$user="";
$designation="";
$department="";
$location="";
if(isset($_POST['add'])) 
{
  $system_type=$_POST['system_type'];
  $system_name = $_POST['system_name'];
  $brand=$_POST['brand'];
  $model_no = $_POST['model_no'];
  $serial_no = $_POST['serial_no'];
  $os=$_POST['os'];
  $processor = $_POST['processor'];
  $ram=$_POST['ram'];
  $hard_disk = $_POST['hard_disk'];
  $ip=$_POST['ip'];
  $antivirus = $_POST['antivirus'];
  $user=$_POST['user'];
  $designation = $_POST['designation'];
  $department = $_POST['department'];
  $location = $_POST['location'];
  $sqluser="SELECT serial_no FROM assetdetails WHERE serial_no='$serial_no' AND serial_no!='N/A'";
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
  $sqluser="SELECT ip FROM assetdetails WHERE ip='$ip' AND ip!='N/A'";
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
$sql="INSERT INTO `assetdetails` (system_type,system_name,brand,model_no,serial_no,os,processor,ram,hard_disk,ip,antivirus,user,designation,department,location) VALUES ('$system_type' ,'$system_name' ,'$brand' ,'$model_no' ,'$serial_no' ,'$os' ,'$processor' ,'$ram','$hard_disk','$ip','$antivirus','$user' ,'$designation' ,'$department' ,'$location')"; 
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
 <!-- SHOW/Hide -->
<!-- //  function MakeChange()
//  {
//  var status = document.getElementById("Change");
//  if(status.value == "Desktop" || status.value == "Laptop" || status.value == "Laptop (Personal)" || status.value == "IMIB" || status.value == "Server")
//  {
//   document.getElementById("OS").style.display="block"; 
//   document.getElementById("Processor").style.display="block";
//   document.getElementById("RAM").style.display="block";
//   document.getElementById("HardDisk").style.display="block";
//   document.getElementById("Antivirus").style.display="block";  
//  }
//  else
//  {
//   document.getElementById("OS").style.display="none"; 
//   document.getElementById("Processor").style.display="none";
//   document.getElementById("RAM").style.display="none";
//   document.getElementById("HardDisk").style.display="none";
//   document.getElementById("Antivirus").style.display="none";
//  }
// } -->
 </head>
 <body>
 <!-- ADD DETAILS -->
 <div class="modal fade" id="addAsset" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
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
<div class="form-row">
    <div class="form-group col-md-3">
    <label>System Type<span style="color:red;">*</span></label>
    <select name="system_type" id="Change" onchange="MakeChange()" class="form-control" required>
<option value="<?php echo $system_type ?>" selected="selected"><?php echo $system_type ?></option>
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
  <div class="form-group col-md-3">
  <label>System Name<span style="color:red;">*</span></label>
    <input type="textarea" name="system_name" placeholder="System name" value="<?php echo $system_name ?>" class="form-control" required>
   </div>
  <div class="form-group col-md-3"> 
  <label>Brand<span style="color:red;">*</span></label>
    <input type="text" name="brand" placeholder="Brand" value="<?php echo $brand ?>" class="form-control" required>
  </div> 
  <div class="form-group col-md-3"> 
  <label>Model No<span style="color:red;">*</span></label> 
    <input type="text" name="model_no" placeholder="Model no" value="<?php echo $model_no ?>" class="form-control" required>
  </div> 
  <div class="form-group col-md-3"> 
  <label>Serial No<span style="color:red;">*</span></label> 
    <input type="text" name="serial_no" placeholder="Serial no" value="<?php echo $serial_no ?>" class="form-control" required>
    <span style="color:red;font-size:13px;">Enter "<b>N/A</b>" if no serial no. available.</span>
  </div> 
  <div id="OS" class="form-group col-md-3"> 
  <label>OS</label> 
    <input type="text" name="os" placeholder="Operating system" value="<?php echo $os ?>" class="form-control">
  </div> 
  <div id="Processor" class="form-group col-md-3"> 
  <label>Processor</label> 
    <input type="text" name="processor" placeholder="Processor" value="<?php echo $processor ?>" class="form-control">
  </div> 
  <div id="RAM" class="form-group col-md-3"> 
  <label>RAM</label> 
    <input type="text" name="ram" placeholder="RAM" value="<?php echo $ram ?>" class="form-control">
  </div> 
  <div id="HardDisk" class="form-group col-md-3"> 
  <label>Hard Disk</label> 
    <input type="text" name="hard_disk" placeholder="Hard disk" value="<?php echo $hard_disk ?>" class="form-control">
  </div> 
  <div class="form-group col-md-3"> 
  <label>IP Address<span style="color:red;">*</span></label> 
    <input type="text" name="ip" placeholder="IP address" value="<?php echo $ip ?>" class="form-control" required>
    <span style="color:red;font-size:13px;">Enter "<b>N/A</b>" if no IP assigned.</span>
  </div> 
  <div id="Antivirus" class="form-group col-md-3">
    <label>Antivirus Details</label>
    <textarea type="textarea" name="antivirus" placeholder="Antivirus details..." class="form-control"><?php echo $antivirus ?></textarea>
  </div>
  <div class="form-group col-md-3">
  <label>User<span style="color:red;">*</span></label>
   <select name="user" class="form-control" required>
<option value="<?php echo $user ?>" selected="selected"><?php echo $user ?></option>
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
  <div class="form-group col-md-3">
  <label>Designation<span style="color:red;">*</span></label>
    <select name="designation" class="form-control" required>
<option value="<?php echo $designation ?>" selected="selected"><?php echo $designation ?></option>
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
  <div class="form-group col-md-3">
  <label>Department<span style="color:red;">*</span></label>
    <select name="department" class="form-control" required>
<option value="<?php echo $department ?>" selected="selected"><?php echo $department ?></option>
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
  <div class="form-group col-md-3">
  <label>Location<span style="color:red;">*</span></label>
    <select name="location" class="form-control" required>
<option value="<?php echo $location ?>" selected="selected"><?php echo $location ?></option>
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
    <button type="submit" name="add" class="btn btn-success">add</button>
    <button class="btn btn-danger" type="button" data-dismiss="modal">close</button>
  </div>
</form>
</div>
</div>
</div>
</div>
<!-- RESUBMIT FORM PREVENT -->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>