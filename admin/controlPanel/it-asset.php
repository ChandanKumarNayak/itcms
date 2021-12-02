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
<div class="modal fade" id="itAsset" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable modal-xl">
<div class="modal-content">
  <!-- close btn -->
  <button class="btn btn-danger" style="display:block;position:relative;top:2px;left:2px;width:40px;" type="button" data-dismiss="modal"><i class="fa fa-times"></i></button>
  <!-- mini nav  --> 
  <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2 mb-2 ml-2 mr-2">
  <form class="form-inline">
  <a class="nav-link" data-toggle="modal" type="button" data-target="#addAsset"><i class="fa fa-plus"></i>&nbsp;new</a>
  <input class="filter-search" type="search" placeholder="&#xf002 Search here.." aria-label="Search" id="search-asset" style="font-family: FontAwesome;">
 </form> 
</nav>
 <!--  asset table --> 
<?php
$getdata=("SELECT * FROM `system_type` ORDER BY system_type ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
$i=1;
echo "<div id='tbl-modal'>";
echo "<table id='table-asset'>";
echo "<thead>";
  echo "<tr>
    <th>#</th>
    <th>Asset Name</th>
    <th>Description</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>";
   echo "</thead>";
while($row = mysqli_fetch_assoc($result))
{ 
  echo "<tr>";
echo "<td>" . $i++ . "</td>";
echo "<td>" . $row['system_type'] . "</td>";
echo "<td>" . $row['description'] . "</td>";
echo '<td><a class="button-change button-blue" data-toggle="modal" type="button" data-target="#update_asset'.$row['id'].'"><i class="fa fa-edit"></i>&nbsp;Edit</a></td>';
echo '<td><a class="button-change button-red btn-del-asset" href="it-asset-delete.php?id='.$row['id'].'"><i class="fa fa-trash"></i>&nbsp;Delete</a></td>';
  echo "</tr>";
  include 'it-asset-edit.php';
}
echo "</table>";
echo "</div>";
?>
    </div>
  </div>
</div>
<!-- ADD ASSET MODAL -->
<div class="modal fade" id="addAsset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
<div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New IT Asset</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
<form method="POST" action="" enctype="multipart/form-data">
    <div class="form-group">
      <label>Asset Name<span style="color:red;">*</span></label>
      <input type="text" name="system_type" placeholder="Asset name" class="form-control" required />
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea type="textarea" name="description" placeholder="Description..." title="Leave it blank if no data available at this moment." class="form-control" ></textarea>
    </div>
    <div class="modal-footer">
    <button type="submit" name="newasset" class="btn btn-success">add asset</button>
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
  $('#search-asset').on('keyup', function(){
    var input, filter, table, tr, td, i;
    input = $("#search-asset");
    filter = $("#search-asset").val().toUpperCase();
    table = $("#table-asset");
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
 <!-- FLASH DELETE -->
 <script>
$('.btn-del-asset').on('click', function(e) {
e.preventDefault();
const href = $(this).attr('href')
swal.fire({
  title: 'Are you sure?',
  type: 'warning',
  showDenyButton: true,
  confirmButtonColor: '#d3085d6',
  denyButtonColor: '#d33',
  confirmButtonText: 'Delete Asset',
  denyButtonText: 'Cancel',
  }).then((result)=>{
    if (result.value){
           document.location.href=href;
}
// else if (result.isDenied) {
//     Swal.fire('No changes made!', '', '')
//   }
})
})
</script>
<!-- RESUBMIT FORM PREVENT -->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>
<!-- Insert Asset Details --> 
<?php 
require '../db.php';
if(isset($_POST['newasset'])) 
{
  $system_type=$_POST['system_type'];
  $description=$_POST['description'];
$sql="INSERT INTO `system_type` (system_type,description) VALUES ('$system_type','$description')";  
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
?>