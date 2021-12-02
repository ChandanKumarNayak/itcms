<?php 
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
    die();
  }
  require "../detect_admin.php";
 ?>
<html lang="en-IN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="IT-CMS: Thinking Ahead.">
<meta name="keywords" content="IT, CMS">
<meta name="author" content="Chandan Kumar Nayak">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>IT Asset Details | IT-CMS</title>
  <link rel="stylesheet" href="../../css/table.css"> <!-- table style -->
<link rel="stylesheet" href="../../css/button.css"> <!-- button style -->
<link rel="stylesheet" href="../../css/modal-form.css"> <!-- modal form style -->
 <link rel="icon" type="image/png" href="../../img/IT.png"/> <!-- page icon -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <!-- ICONS -->
  <!-- NAV BAR -->
  <link href="../../nav-style/bootstrap.min.css" rel="stylesheet">
  <link href="../../nav-style/simple-sidebar.css" rel="stylesheet">
  <!-- PRELOADER -->
  <link href="../../css/preloader.css" rel="stylesheet">
   <script>
    window.onload=function(){
      document.getElementById('loader').style.display="none";
      document.getElementById('content').style.display="block";
    };
    </script>
<!-- SWEET ALERT JS -->
 <script src="../../js/jquery-3.5.1.min.js"></script>
 <script src="../../js/sweetalert2.all.min.js"></script>
</head>
<body>
<!-- PRELOADER -->
<div id="loader">
      <img src="../../img/preloader.gif"/>
</div>
    <div id="content">
<!-- PRELOADER -->   
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-logo"><a href="../../index.php"><img src="../../img/cms.png" alt="Logo"></a></div>
      <div class="list-group list-group-flush">
        <?php if($_SESSION['role']==1){?>
        <a href="../controlPanel/" class="list-group-item list-group-item-action bg-light">Control Panel&nbsp;<i class="fa fa-star"></i></a>
        <?php } ?>
        <a href="../overall/" class="list-group-item list-group-item-action bg-light">Overall Summary</a>
        <a href="../network-map/" class="list-group-item list-group-item-action bg-light">Network Mapping</a>
        <a href="index.php" class="list-group-item list-group-item-action bg-light" style="color:blue;">IT Asset Details <i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a>
        <a href="../purchase/" class="list-group-item list-group-item-action bg-light">Purchase History</a>
        <a href="../assetRepair/" class="list-group-item list-group-item-action bg-light">IT Asset Repair Service</a>
        <a href="../catriedge/" class="list-group-item list-group-item-action bg-light">Catriedge Service</a>
        <a href="../expense/" class="list-group-item list-group-item-action bg-light">IT Expense</a>
        <a href="../support/" class="list-group-item list-group-item-action bg-light">IT Support</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
        <button class="btn btn-primary" id="menu-toggle"><i class="fa fa-bars"></i></button>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <!-- <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li> -->
            <li class="nav-item">
              <a class="nav-link" href="../admin.php"><i class="fa fa-home"></i>&nbsp;Home</a>
            </li>
            <li class="nav-item dropdown">
            <!--FETCH DETAILS-->
<?php
require('../db.php');
$getdata=("SELECT * FROM admin WHERE email='".$_SESSION['email']."' ");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{
?>
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user"></i>
                <?php echo $row['name']?>
              </a>
<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" data-toggle="modal" type="button" data-target="#update_profile<?php echo $row['id'];?>"><i class="fa fa-user-circle"></i>&nbsp;Edit Profile</a>
                <a class="dropdown-item" href="../setting.php"><i class="fa fa-cog"></i>&nbsp;Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../logout.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a>
              </div>
<?php
include '../profile.php';
}
?>
<!--END FETCH-->        
            </li>
          </ul>
        </div>
      </nav>
      <!-- FILTER SEARCH BY DATE & CREATE BUTTON -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2 mb-2 ml-2 mr-2">
  <form class="form-inline">
  <a class="nav-link" data-toggle="modal" type="button" data-target="#addAsset"><i class="fa fa-plus"></i>&nbsp;add</a>
<div class="dropdown">
  <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-download"></i>&nbsp;export
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item btn-download" href="export-excel.php"><i class="fa fa-file-excel-o"></i>&nbsp;export all</a>
     <div class="dropdown-divider"></div>
    <a class="dropdown-item" href="#" id="myExport"><i class="fa fa-file-excel-o"></i>&nbsp;custom export</a>
  </div>
</div>
  <input class="filter-search" type="search" placeholder="&#xf002 Search here.." aria-label="Search" id="Search" style="font-family: FontAwesome;">
 </form> 
 <?php include 'add.php'; ?>
</nav>
      <div class="container-fluid"> <!-- SHOW TABLE -->
<?php
$getdata=("SELECT * FROM `assetdetails` ORDER BY system_type ASC");
if($result_asset_details = mysqli_query($db, $getdata))
if(mysqli_num_rows($result_asset_details) > 0)
$i=1;
echo "<div id='tbl'>";
echo "<table id='Data'>";
 echo "<thead>";
  echo "<tr>
    <th>#</th>
    <th>System Type</th>
    <th>System Name</th>
    <th>Brand</th>
    <th>Model No</th>
    <th>Serial No</th>
    <th>OS</th>
    <th>Processor</th>
    <th>RAM</th>
    <th>Hard Disk</th>
    <th>IP Address</th>
    <th>Antivirus Details</th>
    <th>User</th>
    <th>Designation</th>
    <th>Department</th>
    <th>Location</th>
    <th>Edit</th>
    <th>Delete</th>
  </tr>";
  echo "</thead>";
while($row = mysqli_fetch_assoc($result_asset_details))
{ 
  echo "<tr>";
echo "<td>" . $i++ . "</td>";
echo "<td>" . $row['system_type'] . "</td>";
echo "<td>" . $row['system_name'] . "</td>";
echo "<td>" . $row['brand'] . "</td>";
echo "<td>" . $row['model_no'] . "</td>";
echo "<td>" . $row['serial_no'] . "</td>";
echo "<td>" . $row['os'] . "</td>";
echo "<td>" . $row['processor'] . "</td>";
echo "<td>" . $row['ram'] . "</td>";
echo "<td>" . $row['hard_disk'] . "</td>";
echo "<td>" . $row['ip'] . "</td>";
echo "<td>" . $row['antivirus'] . "</td>";
echo "<td>" . $row['user'] . "</td>";
echo "<td>" . $row['designation'] . "</td>";
echo "<td>" . $row['department'] . "</td>";
echo "<td>" . $row['location'] . "</td>";
echo '<td><a class="button-change button-blue" data-toggle="modal" type="button" data-target="#update_asset_details'.$row['id'].'"><i class="fa fa-edit"></i>&nbsp;Edit</a></td>';
echo '<td><a class="button-change button-red btn-del" href="delete.php?id='.$row['id'].'"><i class="fa fa-trash"></i>&nbsp;Delete</a></td>';
  echo "</tr>";
  include 'edit.php';
}
echo "</table>";
echo "</div>";
?>
      </div>
    </div>
  </div>
<!--FOOTER-->
<?php include "../src/footer.php"; ?>
<!-- navbar -->
  <script src="../../nav-style/jquery.min.js"></script>
  <script src="../../nav-style/bootstrap.bundle.min.js"></script>
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
<!-- FLASH DELETE -->
<?php if (isset($_GET['d'])) : ?>
<div class="flash-data" data-flashdata="<?=$_GET['d'];?>"></div>
<?php endif; ?>
<script>
$('.btn-del').on('click', function(e) {
e.preventDefault();
const href = $(this).attr('href')
swal.fire({
  title: 'Are you sure?',
  type: 'warning',
  showDenyButton: true,
  confirmButtonColor: '#d3085d6',
  denyButtonColor: '#d33',
  confirmButtonText: 'Yes, Delete',
  denyButtonText: 'No, Cancel',
  }).then((result)=>{
    if (result.value){
           document.location.href=href;
}
// else if (result.isDenied) {
//     Swal.fire('No changes made!', '', '')
//   }
})
})
const flashdata = $('.flash-data').data('flashdata')
if (flashdata) {
  swal.fire ({
  type: 'success',
  title: 'Deleted successfully!',
})
}
 </script>
 <!-- FLASH DOWNLOAD -->
<script>
$('.btn-download').on('click', function(e) {
e.preventDefault();
const href = $(this).attr('href')
swal.fire({
  title: 'Do you want to Download?',
  type: 'warning',
  showDenyButton: true,
  confirmButtonColor: '#d3085d6',
  denyButtonColor: '#d33',
  confirmButtonText: 'Yes, Download',
  denyButtonText: 'No, Cancel',
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
<!-- FLASH EDIT -->
<?php if (isset($_GET['s'])) : ?>
<div class="flash-edit" data-flashedit="<?=$_GET['s'];?>"></div>
<?php endif; ?>
<script>
const flashedit = $('.flash-edit').data('flashedit')
if (flashedit) {
  swal.fire ({
  type: 'success',
  title: 'Updated Successfully!',
})
}
 </script>
 <!-- FLASH ADD -->
<?php if (isset($_GET['add'])) : ?>
<div class="flash-add" data-flashadd="<?=$_GET['add'];?>"></div>
<?php endif; ?>
<script>
const flashadd = $('.flash-add').data('flashadd')
if (flashadd) {
  swal.fire ({
  type: 'success',
  title: 'Added Successfully!',
})
}
 </script>
<!-- FILTER SEARCH -->
<script>  
     $('#Search').on('keyup', function(e) {
    $("#noData").remove();
    var value = $(this).val();
    var spacesAndDashes = /\s|-/g;
    value = value.replace(spacesAndDashes, "");
    var patt = new RegExp(value, "i");
    var sw = 0;
    var counter = 0;
    $('#Data tbody').find('tr').each(function() {
        counter++;
        if (!($(this).find('td').text().replace(spacesAndDashes, "").search(patt) >= 0)) {
            $(this).not('#header').hide();
            sw++;
        } else if (($(this).find('td').text().replace(spacesAndDashes, "").search(patt) >= 0)) {
            $(this).show();
        }
    });
})
 </script>  
<!-- EXPORT BY DEPT MODAL FORM -->
<div id="myModal" class="addmodal">
  <!-- Modal content -->
  <div class="add-modal-content">
    <div class="add-modal-header">
      <span class="addclose">&times;</span>
    </div>
      <form method="POST" action="export-excel-custom.php" enctype="multipart/form-data" class="add-modal">
 <div class='add-div'>
  <label>Department:</label>
  <select name="department" required>
<option value="" selected="selected">--SELECT--</option>
  <?php
$getdata=("SELECT * FROM `department` ORDER BY department ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?>
<option value="<?php echo $row['department'];?>"><?php echo $row['department'];?></option>
<?php }
  ?> 
</select> 
  </div> 
  <div class='add-div'>
  <button type="submit" name="export"><i class="fa fa-download"></i>&nbsp;export</button>
  </div>
</form>
  </div>
</div>
<script>
// Get the modal
var addmodal = document.getElementById("myModal");
// Get the button that opens the modal
var btn = document.getElementById("myExport");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("addclose")[0];
// When the user clicks the button, open the modal 
btn.onclick = function() {
  addmodal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  addmodal.style.display = "none";
}
// close modal on click outside
window.onclick = function(event) {
   if (event.target == addmodal) {
      addmodal.style.display = "none";
    }
}
</script>
<!-- Check Admin Status -->
 <script src="../../js/jquery-3.6.0.min.js"></script>
 <script src="auto_check_status.js"></script>
</div>
</body>
</html>