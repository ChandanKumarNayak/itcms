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
<link rel="stylesheet" href="../../css/table.css"> <!-- table style -->
<link rel="stylesheet" href="../../css/button.css"> <!-- button style -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <!-- ICONS -->
 <!-- SWEET ALERT JS -->
 <script src="../../js/jquery-3.5.1.min.js"></script>
 <script src="../../js/sweetalert2.all.min.js"></script>
</head>
<body>
<div class="modal fade" id="administrator" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-xl">
<div class="modal-content">
  <!-- close btn -->
  <button class="btn btn-danger" style="display:block;position:relative;top:2px;left:2px;width:40px;" type="button" data-dismiss="modal"><i class="fa fa-times"></i></button>
  <!-- mini nav  --> 
  <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2 mb-2 ml-2 mr-2">
  <form class="form-inline">
  <a class="nav-link" data-toggle="modal" type="button" data-target="#addAdmin"><i class="fa fa-plus"></i>&nbsp;new</a>
  <input class="filter-search" type="search" placeholder="&#xf002 Search here.." aria-label="Search" id="search-attorneys" style="font-family: FontAwesome;">
 </form> 
</nav>
 <!--  admin table --> 
<?php
$getdata=("SELECT * FROM `admin` ORDER BY role DESC,id DESC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
$i=1;
echo "<div id='tbl-modal'>";
echo "<table id='attorneys'>";
echo "<thead>";
  echo "<tr>
    <th>#</th>
    <th>Avatar</th>
    <th>Name</th>
    <th>Email ID</th>
    <th>Phone No.</th>
    <th>Designation</th>
    <th>Department</th>
    <th>Login Passcode</th>
    <th>Account Status</th>
    <th>Edit Details</th>
  </tr>";
   echo "</thead>";
while($row = mysqli_fetch_assoc($result))
{ 
  echo "<tr>";
echo "<td>" . $i++ . "</td>";
echo "<td><img src='../img/".$row['image']."' style='width:50px;height:50px;border-radius:50%;'></td>";
echo "<td>" . $row['name'] . "</td>";
echo "<td>" . $row['email'] . "</td>";
echo "<td>" . $row['phone'] . "</td>";
echo "<td>" . $row['designation'] . "</td>";
echo "<td>" . $row['department'] . "</td>";
echo "<td>" . $row['password'] . "</td>";
echo '<td><a class="button-change-status button-'.$row['status'].' btn-status" href="administrator-status.php?id='.$row['id'].'">'.$row['status'].'</a></td>';
echo '<td><a class="button-change button-blue" data-toggle="modal" type="button" data-target="#update_modal'.$row['id'].'"><i class="fa fa-edit"></i>&nbsp;Edit</a></td>';
  echo "</tr>";
  include 'administrator-edit.php';
}
echo "</table>";
echo "</div>";
?>
    </div>
  </div>
</div>
<!-- ADD ADMIN MODAL -->
<div class="modal fade" id="addAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
<div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Admin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
      <label>Name<span style="color:red;">*</span></label>
      <input type="text" name="name" placeholder="Name" class="form-control" required />
    </div>
    <div class="form-group">
      <label>Email ID<span style="color:red;">*</span></label>
      <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email" placeholder="Email" class="form-control" required />
    </div>
    <div class="form-group">
      <label>Phone No<span style="color:red;">*</span></label>
      <input type="tel" maxlength="10" pattern="^[6789]\d{9}$" name="phone" placeholder="Phone" class="form-control" required />
    </div>
    <div class="form-group">
      <label>Designation<span style="color:red;">*</span></label>
      <select name="designation" class="form-control" required>
<option value="" selected="selected">--SELECT--</option>
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
    <div class="form-group">
      <label>Department<span style="color:red;">*</span></label>
      <select name="department" class="form-control" required>
<option value="" selected="selected">--SELECT--</option>
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
    <div class="form-group">
      <label>Login Passcode<span style="color:red;">*</span></label>
      <input type="text" name="password" placeholder="Passcode" class="form-control" required />
    </div>
    <div class="form-group">
      <label>Account Status<span style="color:red;">*</span></label>
      <select name="status" class="form-control" required>
   <option value="Active" selected>Active</option>
   <option value="Deactive">Deactive</option>
   </select>
    </div>
    <div class="modal-footer">
    <button type="submit" name="add" class="btn btn-success">create account</button>
    <button class="btn btn-danger" type="button" data-dismiss="modal">close</button>
  </div>
</form>
</div>
    </div>
  </div>
</div>
<!-- FILTER SEARCH -->
<script>  
     $(document).ready(function(){
  $('#search-attorneys').on('keyup', function(){
    var input, filter, table, tr, td, i;
    input = $("#search-attorneys");
    filter = $("#search-attorneys").val().toUpperCase();
    table = $("#attorneys");
    tr = $("tbody tr"); // CHANGED
    for (i = 0; i < tr.length; i++) {
      tds = tr[i].getElementsByTagName("td");
      var found = false;
      for (j = 0; j < tds.length; j++) {
        td = tds[j];
        if (td) {
          if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
            found = true;
            break;
          }
        }
      }
      if (found) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  });
});
 </script>  
<!-- RESUBMIT FORM PREVENT -->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>
<!-- Insert Admin Details --> 
<?php
require "../db.php";
if(isset($_POST['add'])) 
{
  $name=$_POST['name'];
  $email = $_POST['email'];
  $sqluser="SELECT email FROM admin WHERE email='$email'";
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
  $status = $_POST['status'];
  $sql="INSERT INTO `admin` (name,email,phone,designation,department,password,status,image) VALUES ('$name','$email','$phone','$designation','$department','$password','$status',0)";
  if($result = mysqli_query($db, $sql)) {
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
?>