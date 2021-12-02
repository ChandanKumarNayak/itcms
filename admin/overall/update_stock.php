<?php 
ob_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
    die();
  }
 ?>
<!-- UPDATE STOCK DETAILS -->
 <?php 
require '../db.php';
if(isset($_POST['edit'])) 
{
  $id=$_POST['id']; 
  $asset_name=$_POST['asset_name'];
  $quantity = $_POST['quantity'];
$sql="UPDATE `assetstock` SET asset_name='$asset_name' ,quantity='$quantity' WHERE id='$id'"; 
if ($db->query($sql) === TRUE) 
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
<div class="modal fade" id="update_modal<?php echo $row['id'];?>" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
 <form method="POST" action="#" enctype="multipart/form-data">
	<div class="modal-header">
		<h3 class="modal-title">Assets In Stock</h3>
	</div>
<div class="modal-body">
		<div class="form-group">
			<label>Asset Name<span style="color:red;">*</span></label>
			<input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
			<input type="text" name="asset_name" value="<?php echo $row['asset_name'];?>" placeholder="Asset name" class="form-control" required />
		</div>
		 <div class="form-group">
			 <label>Quantity<span style="color:red;">*</span></label>
			 <input type="number" name="quantity" value="<?php echo $row['quantity'];?>" placeholder="Quantity" class="form-control" required />
		 </div>
 </div>
	<div style="clear:both;"></div>
	<div class="modal-footer">
		<button type="submit" name="edit" class="btn btn-success">update</button>
		<button class="btn btn-danger" type="button" data-dismiss="modal">close</button>
	</div>
	</div>
</form>
		</div>
	</div>
</div>
</body>
</html>