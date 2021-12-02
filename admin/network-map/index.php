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
	<title>Network Mapping | IT-CMS</title>
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
        <a href="../overall/" class="list-group-item list-group-item-action bg-light">Overall Summary</a>
        <a href="index.php" class="list-group-item list-group-item-action bg-light" style="color:blue;">Network Mapping <i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a>
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
<!-- SERVER ROOM -->
<div id='tbl-sml-all'>
<div class="all-header"> 
[ SERVER &nbsp;ROOM ]
</div>
<!-- Mini Nav -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2 mb-2 ml-2 mr-2">
  <form class="form-inline">
  <a class="nav-link btn-download" href="export-excel.php?location=server"><i class="fa fa-download"></i>&nbsp;export</a>
  <input class="filter-search" type="search" placeholder="&#xf002 Search here.." aria-label="Search" id="Search" style="font-family: FontAwesome;">
 </form> 
</nav>
<table id='Data'>
<thead>
  <tr>
    <th style="position: sticky;top: 2.5em;">#</th>
    <th style="position: sticky;top: 2.5em;">User</th>
    <th style="position: sticky;top: 2.5em;">Port No (IO Box)</th>
    <th style="position: sticky;top: 2.5em;">Port No (Switch)</th>
    <th style="position: sticky;top: 2.5em;">Edit</th>
  </tr>
  </thead>
  <?php 
 $getdata=("SELECT * FROM `network_map` ORDER BY id ASC LIMIT 24");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?> 
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['user']; ?></td>
<td><?php echo $row['iobox_port_no']; ?></td>
<td><?php echo $row['switch_port_no']; ?></td>
<td><a class="button-change button-blue" data-toggle="modal" type="button" data-target="#update_modal<?php echo $row['id']?>"><i class="fa fa-edit"></i>&nbsp;Edit</a></td>
</tr>
<?php  
          include 'update_map.php';   
          }
        ?>
</table>
</div>
<!-- FRONT OFFICE -->
<div id='tbl-sml-all'>
<div class="all-header"> 
[ FRONT &nbsp;OFFICE ]
</div>
<!-- Mini Nav -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2 mb-2 ml-2 mr-2">
  <form class="form-inline">
  <a class="nav-link btn-download" href="export-excel.php?location=front_office"><i class="fa fa-download"></i>&nbsp;export</a>
  <input class="filter-search" type="search" placeholder="&#xf002 Search here.." aria-label="Search" id="FrontSearch" style="font-family: FontAwesome;">
 </form> 
</nav>
<table id='FrontData'>
<thead>
  <tr>
    <th style="position: sticky;top: 2.5em;">#</th>
    <th style="position: sticky;top: 2.5em;">User</th>
    <th style="position: sticky;top: 2.5em;">Port No (IO Box)</th>
    <th style="position: sticky;top: 2.5em;">Port No (Switch)</th>
    <th style="position: sticky;top: 2.5em;">Edit</th>
  </tr>
  </thead>
  <?php 
 $getdata=("SELECT * FROM `network_map` ORDER BY id ASC LIMIT 24,24");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?> 
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['user']; ?></td>
<td><?php echo $row['iobox_port_no']; ?></td>
<td><?php echo $row['switch_port_no']; ?></td>
<td><a class="button-change button-blue" data-toggle="modal" type="button" data-target="#update_modal<?php echo $row['id']?>"><i class="fa fa-edit"></i>&nbsp;Edit</a></td>
</tr>
<?php  
          include 'update_map.php';   
          }
        ?>
</table>
</div>
<!-- SHOWROOM -->
<div id='tbl-sml-all'>
<div class="all-header"> 
[ SHOWROOM ]
</div>
<!-- Mini Nav -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2 mb-2 ml-2 mr-2">
  <form class="form-inline">
  <a class="nav-link btn-download" href="export-excel.php?location=showroom"><i class="fa fa-download"></i>&nbsp;export</a>
  <input class="filter-search" type="search" placeholder="&#xf002 Search here.." aria-label="Search" id="ShowSearch" style="font-family: FontAwesome;">
 </form> 
</nav>
<table id='ShowData'>
<thead>
  <tr>
    <th style="position: sticky;top: 2.5em;">#</th>
    <th style="position: sticky;top: 2.5em;">User</th>
    <th style="position: sticky;top: 2.5em;">Port No (IO Box)</th>
    <th style="position: sticky;top: 2.5em;">Port No (Switch)</th>
    <th style="position: sticky;top: 2.5em;">Edit</th>
  </tr>
  </thead>
  <?php 
 $getdata=("SELECT * FROM `network_map` ORDER BY id ASC LIMIT 48,24");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?> 
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['user']; ?></td>
<td><?php echo $row['iobox_port_no']; ?></td>
<td><?php echo $row['switch_port_no']; ?></td>
<td><a class="button-change button-blue" data-toggle="modal" type="button" data-target="#update_modal<?php echo $row['id']?>"><i class="fa fa-edit"></i>&nbsp;Edit</a></td>
</tr>
<?php  
          include 'update_map.php';   
          }
        ?>
</table>
</div>
<!-- SECOND FLOOR -->
<div id='tbl-sml-all'>
<div class="all-header"> 
[ SECOND &nbsp;FLOOR ]
</div>
<!-- Mini Nav -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2 mb-2 ml-2 mr-2">
  <form class="form-inline">
  <a class="nav-link btn-download" href="export-excel.php?location=sec_floor"><i class="fa fa-download"></i>&nbsp;export</a>
  <input class="filter-search" type="search" placeholder="&#xf002 Search here.." aria-label="Search" id="SecSearch" style="font-family: FontAwesome;">
 </form> 
</nav>
<table id='SecData'>
<thead>
  <tr>
    <th style="position: sticky;top: 2.5em;">#</th>
    <th style="position: sticky;top: 2.5em;">User</th>
    <th style="position: sticky;top: 2.5em;">Port No (IO Box)</th>
    <th style="position: sticky;top: 2.5em;">Port No (Switch)</th>
    <th style="position: sticky;top: 2.5em;">Edit</th>
  </tr>
  </thead>
  <?php 
 $getdata=("SELECT * FROM `network_map` ORDER BY id ASC LIMIT 72,24");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?> 
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['user']; ?></td>
<td><?php echo $row['iobox_port_no']; ?></td>
<td><?php echo $row['switch_port_no']; ?></td>
<td><a class="button-change button-blue" data-toggle="modal" type="button" data-target="#update_modal<?php echo $row['id']?>"><i class="fa fa-edit"></i>&nbsp;Edit</a></td>
</tr>
<?php  
          include 'update_map.php';   
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
  title: 'Updated successfully!',
})
}
 </script>
 <!-- SERVER ROOM SEARCH -->
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
 <!-- FRONT OFFICE SEARCH -->
 <script>  
     $('#FrontSearch').on('keyup', function(e) {
    $("#noData").remove();
    var value = $(this).val();
    var spacesAndDashes = /\s|-/g;
    value = value.replace(spacesAndDashes, "");
    var patt = new RegExp(value, "i");
    var sw = 0;
    var counter = 0;
    $('#FrontData tbody').find('tr').each(function() {
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
 <!-- SHOWROOM SEARCH -->
 <script>  
     $('#ShowSearch').on('keyup', function(e) {
    $("#noData").remove();
    var value = $(this).val();
    var spacesAndDashes = /\s|-/g;
    value = value.replace(spacesAndDashes, "");
    var patt = new RegExp(value, "i");
    var sw = 0;
    var counter = 0;
    $('#ShowData tbody').find('tr').each(function() {
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
 <!-- SECOND FLOOR SEARCH -->
 <script>  
     $('#SecSearch').on('keyup', function(e) {
    $("#noData").remove();
    var value = $(this).val();
    var spacesAndDashes = /\s|-/g;
    value = value.replace(spacesAndDashes, "");
    var patt = new RegExp(value, "i");
    var sw = 0;
    var counter = 0;
    $('#SecData tbody').find('tr').each(function() {
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
</div> <!-- Preloader DIV END-->
</body>
</html>