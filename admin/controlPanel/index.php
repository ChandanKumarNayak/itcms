<?php 
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
    die();
  }
if ($_SESSION['role'] != '1') {
    header('location: ../admin.php');
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
	<title>Admin: Control Panel | IT-CMS</title>
<link rel="stylesheet" type="text/css" href="../../css/flip-style.css"> <!-- FLIP CARD STYLE -->
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
        <a href="index.php" class="list-group-item list-group-item-action bg-light" style="color:blue;">Control Panel&nbsp;<i class="fa fa-star"></i></a>
        <?php } ?>
        <a href="../overall/" class="list-group-item list-group-item-action bg-light">Overall Summary</a>
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
 <div class="container-fluid"> <!-- SHOW CONTENT -->
<div class="flip-card-CP" data-toggle="modal" type="button" data-target="#administrator">
<div class="flip-card-inner">
<div class="flip-card-front">
<img src="../img/admin.png" alt="Administrator" class="card-image-CP" >
<h6 class="person-name"><u>Administrator</u></h6>
</div>
</div>
</div>
<?php  
include 'administrator.php';   
?>
<div class="flip-card-CP" data-toggle="modal" type="button" data-target="#itAsset">
<div class="flip-card-inner">
<div class="flip-card-front">
<img src="../img/system.png" alt="IT Assets" class="card-image-CP" >
<h6 class="person-name"><u>IT Assets</u></h6>
</div>
</div>
</div>
<?php  
include 'it-asset.php';   
?>
<div class="flip-card-CP" data-toggle="modal" type="button" data-target="#noticeBoard">
<div class="flip-card-inner">
<div class="flip-card-front">
<img src="../img/notice-board.png" alt="Notice Board" class="card-image-CP" >
<h6 class="person-name"><u>Notice Board</u></h6>
</div>
</div>
</div>
<?php  
include 'notice-board.php';   
?>
<div class="flip-card-CP" data-toggle="modal" type="button" data-target="#employee">
<div class="flip-card-inner">
<div class="flip-card-front">
<img src="../img/user.png" alt="Employees" class="card-image-CP" >
<h6 class="person-name"><u>Employees</u></h6>
</div>
</div>
</div>
<?php  
include 'employee.php';   
?>
<div class="flip-card-CP" data-toggle="modal" type="button" data-target="#vendor">
<div class="flip-card-inner">
<div class="flip-card-front">
<img src="../img/vendor.png" alt="Vendors" class="card-image-CP" >
<h6 class="person-name"><u>Vendors</u></h6>
</div>
</div>
</div>
<?php  
include 'vendor.php';   
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
  icon: 'success',
})
}
 </script>
 <!-- FLASH DELETE -->
<?php if (isset($_GET['d'])) : ?>
<div class="flash-data" data-flashdata="<?=$_GET['d'];?>"></div>
<?php endif; ?>
<script>
const flashdata = $('.flash-data').data('flashdata')
if (flashdata) {
  swal.fire ({
  type: 'success',
  title: 'Deleted Successfully!',
})
}
 </script>
 <!-- FLASH STATUS -->
<?php if (isset($_GET['status'])) : ?>
<div class="flash-status" data-flashstatus="<?=$_GET['status'];?>"></div>
<?php endif; ?>
<script>
$('.btn-status').on('click', function(e) {
e.preventDefault();
const href = $(this).attr('href')
swal.fire({
  title: 'Sure to change?',
  type: 'warning',
  showDenyButton: true,
  confirmButtonColor: '#d3085d6',
  denyButtonColor: '#d33',
  confirmButtonText: 'Yes, Change',
  denyButtonText: 'No, Back',
  }).then((result)=>{
    if (result.value){
           document.location.href=href;
}
// else if (result.isDenied) {
//     Swal.fire('No changes made!', '', '')
//   }
})
})
const flashstatus = $('.flash-status').data('flashstatus')
if (flashstatus) {
  swal.fire ({
  type: 'success',
  title: 'Status Changed Successfully!',
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
  title: 'Updated Successfully!',
})
}
 </script>
 <!-- Check Admin Status -->
 <script src="../../js/jquery-3.6.0.min.js"></script>
 <script src="auto_check_status.js"></script>
</div> <!-- Preloader -->
</body>
</html>