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
	<title>Overall Summary | IT-CMS</title>
  <link rel="stylesheet" href="../../css/table.css"> <!-- table style -->
<link rel="stylesheet" href="../../css/button.css"> <!-- button style -->
<link rel="stylesheet" href="../../css/modal-form.css"> <!-- modal form style -->
<!-- RESPONSIVE DIV -->
  <link href="../../css/res-div.css" rel="stylesheet">
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
        <a href="index.php" class="list-group-item list-group-item-action bg-light" style="color:blue;">Overall Summary <i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a>
        <a href="../network-map/" class="list-group-item list-group-item-action bg-light">Network Mapping</a>
        <a href="../assetDetails/" class="list-group-item list-group-item-action bg-light">IT Asset Details</a>
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
</br>
<div class="container-fluid"> <!-- SHOW TABLE -->
<div class='header'>
<div class='row'>
<!-- Overall summary -->
<div id='tbl-sml-all'>
<div class="all-header">
[ OVERALL &nbsp;IT &nbsp;ASSET &nbsp;SUMMARY ]
</div>
<!-- Mini Nav -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2 mb-2 ml-2 mr-2">
  <form class="form-inline">
  <a class="nav-link btn-download" href="export-excel-overall.php"><i class="fa fa-download"></i>&nbsp;export</a>
  <input class="filter-search" type="search" placeholder="&#xf002 Search here.." aria-label="Search" id="sumSearch" style="font-family: FontAwesome;">
 </form> 
</nav>
<table id='sumData'>
<thead>
  <tr>
    <th style="position: sticky;top: 2.5em;">#</th>
    <th style="position: sticky;top: 2.5em;">Asset Type</th>
    <th style="position: sticky;top: 2.5em;">Quantity</th>
    <th style="position: sticky;top: 2.5em;">Export</th>
  </tr>
  </thead>
<?php 
  $getdata=("SELECT system_type, count(system_type) as total FROM assetdetails
        GROUP BY system_type");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
$i=1;
while($row = mysqli_fetch_assoc($result))
{ 
echo "<tr>";
echo "<td>" . $i++ . "</td>";
echo "<td>" . $row['system_type'] . "</td>";
echo "<td>" . $row['total'] . "</td>";
echo '<td><a class="button-change button-blue btn-download" title="Download '.$row['system_type'].' details." href="export-excel.php?system_type='.$row['system_type'].'"><i class="fa fa-download"></i>&nbsp;Export</a></td>';
echo "</tr>";
}
?>
</table>
</div>
<!-- Asset In stock -->
<div id='tbl-sml-all'>
<div class="all-header"> 
[ ASSETS &nbsp;IN &nbsp;STOCK ]
</div>
<!-- Mini Nav -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2 mb-2 ml-2 mr-2">
  <form class="form-inline">
  <a class="nav-link" data-toggle="modal" type="button" data-target="#addStock"><i class="fa fa-plus"></i>&nbsp;add</a>
  <a class="nav-link btn-download" href="export-excel.php?stock=1"><i class="fa fa-download"></i>&nbsp;export</a>
  <input class="filter-search" type="search" placeholder="&#xf002 Search here.." aria-label="Search" id="stoSearch" style="font-family: FontAwesome;">
 </form> 
</nav>
<table id='stoData'>
<thead>
  <tr>
    <th style="position: sticky;top: 2.5em;">#</th>
    <th style="position: sticky;top: 2.5em;">Asset Name</th>
    <th style="position: sticky;top: 2.5em;">Quantity</th>
    <th style="position: sticky;top: 2.5em;">Edit</th>
    <th style="position: sticky;top: 2.5em;">Delete</th>
  </tr>
  </thead>
  <?php 
 $getdata=("SELECT * FROM `assetstock` ORDER BY asset_name ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
$i=1;
while($row = mysqli_fetch_assoc($result))
{?> 
<tr>
<td><?php echo $i++; ?></td>
<td><?php echo $row['asset_name']; ?></td>
<td><?php echo $row['quantity']; ?></td>
<td><a class="button-change button-blue" data-toggle="modal" type="button" data-target="#update_modal<?php echo $row['id']?>"><i class="fa fa-edit"></i>&nbsp;Edit</a></td>
<td><a class="button-change button-red btn-del" href="delete.php?id=<?php echo $row['id']; ?>"><i class="fa fa-trash"></i>&nbsp;Delete</a></td>
</tr>
<?php  
          include 'update_stock.php';   
          }
        ?>
</table>
</div>
</div>
</div>
</div>
 <!--  here    -->    
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
 <!-- FLASH ADD -->
<?php if (isset($_GET['add'])) : ?>
<div class="flash-add" data-flashadd="<?=$_GET['add'];?>"></div>
<?php endif; ?>
<script>
const flashadd = $('.flash-add').data('flashadd')
if (flashadd) {
  swal.fire ({
  type: 'success',
  title: 'Added successfully!',
})
}
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
  title: 'Updated successfully!',
})
}
 </script>
 <!-- OVERALL FILTER SEARCH -->
  <script>  
      $('#sumSearch').on('keyup', function(e) {
      $("#noData").remove();
      var value = $(this).val();
      var spacesAndDashes = /\s|-/g;
      value = value.replace(spacesAndDashes, "");
      var patt = new RegExp(value, "i");
      var sw = 0;
      var counter = 0;
      $('#sumData tbody').find('tr').each(function() {
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
 <!-- STOCK FILTER SEARCH -->
 <script>  
     $('#stoSearch').on('keyup', function(e) {
    $("#noData").remove();
    var value = $(this).val();
    var spacesAndDashes = /\s|-/g;
    value = value.replace(spacesAndDashes, "");
    var patt = new RegExp(value, "i");
    var sw = 0;
    var counter = 0;
    $('#stoData tbody').find('tr').each(function() {
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
 <!-- Check Admin Status -->
 <script src="../../js/jquery-3.6.0.min.js"></script>
 <script src="auto_check_status.js"></script>
<!-- ADD stock MODAL FORM -->
<div class="modal fade" id="addStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
<div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="add.php" enctype="multipart/form-data">
  <div class='form-group'>
    <label>Asset Name<span style="color:red;">*</span></label>
    <input type="text" name="asset_name" placeholder="Asset name" class='form-control' required>
  </div>
  <div class='form-group'>
  <label>Quantity<span style="color:red;">*</span></label>
    <input type="number" name="quantity" placeholder="Quantity" class='form-control' required>
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
</div>
</body>
</html>