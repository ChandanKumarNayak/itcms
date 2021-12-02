<?php 
ob_start();
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    die();
  }
  require_once "detect_admin.php";
 ?>
<html lang="en-IN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="IT-CMS: Thinking Ahead.">
<meta name="keywords" content="IT, CMS">
<meta name="author" content="Chandan Kumar Nayak">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit: Task | IT-CMS</title>
    <link rel="icon" type="image/png" href="../img/IT.png"/> <!-- page icon -->
<!-- SWEET ALERT JS -->
 <script src="../js/jquery-3.5.1.min.js"></script>
 <script src="../js/sweetalert2.all.min.js"></script>
</head>
<body>
<div class="modal fade" id="update_task<?php echo htmlspecialchars($row['id'], ENT_QUOTES); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
<div class="modal-content">
<div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Task Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
  <div class="form-group">
      <label>Task<span style="color:red;">*</span></label>
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id'], ENT_QUOTES); ?>"/>
      <input type="hidden" name="status" value="<?php echo htmlspecialchars($row['status'], ENT_QUOTES); ?>"/>
    <textarea type="textarea" class="form-control" name="task" placeholder="Enter a task" required><?php echo htmlspecialchars($row['task'], ENT_QUOTES); ?></textarea>
  </div>
  <div class="form-group">
  <label>Register On<span style="color:red;">*</span></label>
    <input type="date" class="form-control" name="reg_date" placeholder="Task register date" value="<?php echo htmlspecialchars($row['reg_date'], ENT_QUOTES); ?>" required>
  </div>
  <div class="form-group">
  <label>User/Department<span style="color:red;">*</span></label>
    <select name="user" id='testSelect1' class="form-control" required>
<option value="<?php echo htmlspecialchars($row['user'], ENT_QUOTES); ?>" selected="selected"><?php echo htmlspecialchars($row['user'], ENT_QUOTES); ?></option>
<!-- Select User -->
  <optgroup label="Employees">
  <?php
$getdata=("SELECT * FROM `user` ORDER BY user ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?>
<option value="<?php echo htmlspecialchars($row['user'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($row['user'], ENT_QUOTES); ?></option>
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
<option value="<?php echo htmlspecialchars($row['department'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($row['department'], ENT_QUOTES); ?></option>
<?php }
  ?> 
  </optgroup>
</select>
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
 <!-- UPDATE TASK DETAILS -->
 <?php 
require 'db.php';
if(isset($_POST['edit'])) 
{
  $id_pre= mysqli_real_escape_string($db, $_POST['id']);  
  $id = filter_var($id_pre, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
  $status_pre= mysqli_real_escape_string($db, $_POST['status']);  
  $status = filter_var($status_pre, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
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
  $sql="UPDATE `task` SET task='$task' ,user='$user' ,reg_date='$reg_date' WHERE id='$id'";  
if($result = mysqli_query($db, $sql)) {
  header ("Location:admin.php?status=$status&edit=1");
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