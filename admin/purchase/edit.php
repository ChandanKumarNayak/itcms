<?php 
ob_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
    die();
  }
 ?>
<!-- UPDATE PURCHASE DETAILS -->
 <?php 
require '../db.php';
$error='';
if(isset($_POST['edit'])) 
{
  $id=$_POST['id']; 
  $asset_details=$_POST['asset_details'];
  $serial_no=$_POST['serial_no'];
  $user = $_POST['user'];
  $date_of_purchase=$_POST['date_of_purchase'];
  $vendor = $_POST['vendor'];
  $bill_no = $_POST['bill_no'];
  $cheque_no=$_POST['cheque_no'];
  $bill_clear_date = $_POST['bill_clear_date'];
  $total_cost=$_POST['total_cost'];
$sql="UPDATE `purchase` SET asset_details='$asset_details' ,serial_no='$serial_no',user='$user' ,vendor='$vendor' ,date_of_purchase='$date_of_purchase' ,bill_no='$bill_no' ,cheque_no='$cheque_no' ,bill_clear_date='$bill_clear_date' ,total_cost='$total_cost' WHERE id='$id'"; 
if($result = mysqli_query($db, $sql))
if($result > 0)
// Expense
$sql_expense="UPDATE `expense` SET details='$asset_details' ,user='$user' ,vendor='$vendor' ,service_date='$date_of_purchase' ,bill_no='$bill_no' ,cheque_no='$cheque_no' ,bill_clear_date='$bill_clear_date' ,cost='$total_cost' ,company='$company' ,from_date='$from_date' ,till_date='$date' ,catriedge_id=0 ,assetrepair_id=0 WHERE purchase_id='$id'"; 
if($result_expense = mysqli_query($db, $sql_expense))
if($result_expense > 0)
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
 <!-- FETCH PURCHASE DETAILS -->
<div class="modal fade" id="update_purchase<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-xl">
<div class="modal-content">
  <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Purchase Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
  </div>
  </br>
<div id='tbl-modal-inline'>
<form method="POST" action="" enctype="multipart/form-data">
<?php $purchase_id =  $row['id'];    ?>
<div class="form-row">
  <div class="form-group col-md-3">
    <label>Asset Details<span style="color:red;">*</span></label>
    <input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
    <textarea type="textarea" name="asset_details" placeholder="Asset details..." class="form-control" required><?php echo $row['asset_details'];?></textarea>
  </div>
  <div class="form-group col-md-3">
    <label>Serial No<span style="color:red;">*</span></label>
    <input type="text" name="serial_no" placeholder="Serial no" class="form-control" value="<?php echo $row['serial_no'];?>" required>
  </div>
  <div class="form-group col-md-3">
  <label>User/Department<span style="color:red;">*</span></label>
    <select name="user" class="form-control" required>
<option value="<?php echo $row['user'];?>" selected="selected"><?php echo $row['user'];?></option>
  <!-- Select User -->
  <optgroup label="Employees">
  <?php
$getdata=("SELECT * FROM `user` ORDER BY user ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?>
<option value="<?php echo htmlspecialchars($row['user'], ENT_QUOTES);?>"><?php echo htmlspecialchars($row['user'], ENT_QUOTES);?></option>
<?php }
  ?> 
  </optgroup>
  <!-- Select Department -->
  <optgroup label="Departments">
  <?php
$getdata=("SELECT * FROM `department` ORDER BY department ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?>
<option value="<?php echo htmlspecialchars($row['department'], ENT_QUOTES);?>"><?php echo htmlspecialchars($row['department'], ENT_QUOTES);?></option>
<?php }
  ?> 
  </optgroup> 
</select>
  </div>
<?php
$getdata=("SELECT * FROM `purchase` WHERE id='$purchase_id'");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?> 
  <div class="form-group col-md-3">
  <label>Purchase Date<span style="color:red;">*</span></label>
    <input type="date" name="date_of_purchase" placeholder="Date Of Purchase" class="form-control" value="<?php echo $row['date_of_purchase'];?>" required>
 </div> 
 <div class="form-group col-md-3">
  <label>Vendor Name<span style="color:red;">*</span></label>
    <select name="vendor" class="form-control" required>
<option value="<?php echo $row['vendor'];?>" selected="selected"><?php echo $row['vendor'];?></option>
<?php }
  ?>
  <?php
$getdata=("SELECT * FROM `vendor` ORDER BY vendor ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?>
<option value="<?php echo $row['vendor'];?>"><?php echo $row['vendor'];?></option>
<?php }
  ?> 
</select> 
  </div>
  <?php
$getdata=("SELECT * FROM `purchase` WHERE id='$purchase_id'");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?>
  <div class="form-group col-md-3">  
  <label>Bill Number<span style="color:red;">*</span></label>
    <input type="text" name="bill_no" placeholder="Bill number" class="form-control" value="<?php echo $row['bill_no'];?>" required>
  </div>
  <div class="form-group col-md-3"> 
  <label>Cheque Number</label>
    <input type="text" name="cheque_no" placeholder="Cheque number" title="Leave it blank if no data available at this moment." class="form-control" value="<?php echo $row['cheque_no'];?>">
   </div>
  <div class="form-group col-md-3"> 
  <label>Bill Clear Date</label>
    <input type="date" name="bill_clear_date" placeholder="Bill clear date" title="Leave it blank if no data available at this moment." class="form-control" value="<?php echo $row['bill_clear_date'];?>">
  </div> 
  <div class="form-group col-md-3"> 
  <label>Total Cost<span style="color:red;">*</span></label> 
    <input type="number" name="total_cost" placeholder="Total cost" class="form-control" value="<?php echo $row['total_cost'];?>" required>
  </div> 
  <?php }
  ?>  
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