<?php 
ob_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
    die();
  }
 ?>
<!-- ADD CATRIEDGE DETAILS -->
 <?php 
require '../db.php';
$error='';
$date = "";
// generate date
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
// Get Company details
$getdata1=("SELECT * FROM `company`");
if($result1 = mysqli_query($db, $getdata1))
if(mysqli_num_rows($result1) > 0)
while($row = mysqli_fetch_assoc($result1))
{
  $company = $row['company'];
}
// Get From Date
$getdata_fd=("SELECT * FROM `expense`");
if($result_fd = mysqli_query($db, $getdata_fd))
if(mysqli_num_rows($result_fd) > 0)
while($row = mysqli_fetch_assoc($result_fd))
{
  $from_date = $row['from_date'];
}
if(isset($_POST['add'])) 
{
  $type=$_POST['type'];
  $user = $_POST['user'];
  $vendor = $_POST['vendor'];
  $service_date=$_POST['service_date'];
  $refill_amount = $_POST['refill_amount'];
  $repair_details=$_POST['repair_details'];
  $repair_amount = $_POST['repair_amount'];
  $bill_no = $_POST['bill_no'];
  $cheque_no=$_POST['cheque_no'];
  $bill_clear_date = $_POST['bill_clear_date'];
  $total_cost=$_POST['total_cost'];
$sql="INSERT INTO `catriedge` (type,user,vendor,service_date,refill_amount,repair_details,repair_amount,bill_no,cheque_no,bill_clear_date,total_cost) VALUES ('$type' ,'$user' ,'$vendor' ,'$service_date' ,'$refill_amount' ,'$repair_details' ,'$repair_amount' ,'$bill_no' ,'$cheque_no' ,'$bill_clear_date' ,'$total_cost')"; 
if($result = mysqli_query($db, $sql))
$catriedge_id = mysqli_insert_id($db);
// Expense
$sql_expense="INSERT INTO `expense` (details,user,vendor,service_date,bill_no,cheque_no,bill_clear_date,cost,catriedge_id,company,from_date,till_date,assetrepair_id,purchase_id) VALUES ('Catriedge refill/repair.','$user' ,'$vendor' ,'$service_date' ,'$bill_no' ,'$cheque_no' ,'$bill_clear_date' ,'$total_cost','$catriedge_id','$company','$from_date','$date',0,0)"; 
if($result_expense = mysqli_query($db, $sql_expense))
{
    header ("Location:index.php?add=1");
    die();
}
else{
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
<!-- AUTO ADDITION AMOUNT -->
<script>
function sum() {
       var amountFirstNumberValue = document.getElementById('amount1').value;
       var amountSecondNumberValue = document.getElementById('amount2').value;
       if (amountFirstNumberValue == "")
           amountFirstNumberValue = 0;
       if (amountSecondNumberValue == "")
           amountSecondNumberValue = 0;
       var result = parseInt(amountFirstNumberValue) + parseInt(amountSecondNumberValue);
       if (!isNaN(result)) {
           document.getElementById('amount3').value = result;
       }
   }</script>
 </head>
 <body>
 <!-- ADD CATRIEDGE SERVICE DETAILS -->
 <div class="modal fade" id="addCatriedge" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-xl">
<div class="modal-content">
  <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Catriedge Service Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
  </div>
  </br>
<div id='tbl-modal-inline'>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
<div class="form-row">
  <div class="form-group col-md-3">
    <label>Catriedge Type<span style="color:red;">*</span></label>
    <select name="type" class="form-control" required>
<option value="" selected="selected">--SELECT--</option>
  <?php
$getdata=("SELECT * FROM `catriedge_type` ORDER BY type ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?>
<option value="<?php echo $row['type'];?>"><?php echo $row['type'];?></option>
<?php 
}
  ?> 
</select>
  </div>
  <div class="form-group col-md-3">
  <label>User/Department<span style="color:red;">*</span></label>
    <select name="user" class="form-control" required>
<option value="" selected="selected">--SELECT--</option>
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
  <div class="form-group col-md-3">
  <label>Vendor Name<span style="color:red;">*</span></label>
   <select name="vendor" class="form-control" required>
<option value="" selected="selected">--SELECT--</option>
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
  <div class="form-group col-md-3">
  <label>Service Date<span style="color:red;">*</span></label>
    <input type="date" name="service_date" placeholder="Service date" class="form-control" required>
 </div> 
  <div class="form-group col-md-3">
  <label>Refill Amount<span style="color:red;">*</span></label>
    <input type="number" name="refill_amount" placeholder="Refill amount" id="amount1"  onkeyup="sum();" class="form-control" required>
  </div>
  <div class="form-group col-md-3">
  <label>Repair Details<span style="color:red;">*</span></label>
  <textarea type="textarea" name="repair_details" placeholder="Repair details..." class="form-control" required></textarea>
  </div>
  <div class="form-group col-md-3">
  <label>Repair Amount<span style="color:red;">*</span></label>
    <input type="number" name="repair_amount" placeholder="Repair amount" id="amount2"  onkeyup="sum();" class="form-control" required>
  </div>
  <div class="form-group col-md-3">  
  <label>Bill Number<span style="color:red;">*</span></label>
    <input type="text" name="bill_no" placeholder="Bill number" class="form-control" required>
  </div>
  <div class="form-group col-md-3"> 
  <label>Cheque Number</label>
    <input type="text" name="cheque_no" placeholder="Cheque number" title="Leave it blank if no data available at this moment." class="form-control">
   </div>
  <div class="form-group col-md-3"> 
  <label>Bill Clear Date</label>
    <input type="date" name="bill_clear_date" placeholder="Bill clear date" title="Leave it blank if no data available at this moment." class="form-control">
  </div> 
  <div class="form-group col-md-3"> 
  <label>Total Cost<span style="color:red;">*</span></label> 
    <input type="number" name="total_cost" placeholder="Total cost" id="amount3" class="form-control" readonly>
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