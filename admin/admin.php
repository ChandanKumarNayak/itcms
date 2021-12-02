<?php 
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
  	header('location: index.php');
    die();
  }
  require "detect_admin.php";
 ?>
<html lang="en-IN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="IT-CMS: Thinking Ahead.">
<meta name="keywords" content="IT, CMS">
<meta name="author" content="Chandan Kumar Nayak">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin: Dashboard | IT-CMS</title>
<link rel="icon" type="image/png" href="../img/IT.png"/> <!-- page icon -->
<link rel="stylesheet" href="../css/table.css"> <!-- table style -->
<link rel="stylesheet" href="../css/button.css"> <!-- button style -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <!-- ICONS -->
  <!-- NAV BAR -->
  <link href="../nav-style/bootstrap.min.css" rel="stylesheet">
  <link href="../nav-style/simple-sidebar.css" rel="stylesheet">
<!-- RESPONSIVE DIV -->
  <link href="../css/res-div.css" rel="stylesheet">
  <!-- MULTI SELECT DROPDOWN -->
  <link href="../css/multiselect.css" rel="stylesheet"/>
  <script src="../js/multiselect.min.js"></script>
  <!-- SWEET ALERT JS -->
 <script src="../js/jquery-3.5.1.min.js"></script>
 <script src="../js/sweetalert2.all.min.js"></script>
 <!-- PRELOADER -->
  <link href="../css/preloader.css" rel="stylesheet">
   <script>
    window.onload=function(){
      document.getElementById('loader').style.display="none";
      document.getElementById('content').style.display="block";
    };
    </script>
<!--  LIVE TIME -->
<script>function display_ct7() {
var x = new Date()
var ampm = x.getHours( ) >= 12 ? ' PM' : ' AM';
hours = x.getHours( ) % 12;
hours = hours ? hours : 12;
hours=hours.toString().length==1? 0+hours.toString() : hours;
var minutes=x.getMinutes().toString()
minutes=minutes.length==1 ? 0+minutes : minutes;
var seconds=x.getSeconds().toString()
seconds=seconds.length==1 ? 0+seconds : seconds;
var month=(x.getMonth() +1).toString();
month=month.length==1 ? 0+month : month;
var dt=x.getDate().toString();
dt=dt.length==1 ? 0+dt : dt;
var x1=dt + "/" + month + "/" + x.getFullYear(); 
x1 = x1 + " - " +  hours + ":" +  minutes + ":" +  seconds + " " + ampm;
document.getElementById('ct7').innerHTML = x1;
display_c7();
 }
 function display_c7(){
var refresh=1000; // Refresh rate in milli seconds
mytime=setTimeout('display_ct7()',refresh)
}
display_c7()
</script>
</head>
<body>
<!-- PRELOADER -->
<div id="loader">
      <img src="../img/preloader.gif"/>
</div>
    <div id="content">
<!-- PRELOADER -->  
<div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-logo"><a href="../index.php"><img src="../img/cms.png" alt="Logo"></a></div>
      <div class="list-group list-group-flush">
        <?php if($_SESSION['role']==1){?>
        <a href="controlPanel/" class="list-group-item list-group-item-action bg-light">Control Panel&nbsp;<i class="fa fa-star"></i></a>
        <?php } ?>
        <a href="overall/" class="list-group-item list-group-item-action bg-light">Overall Summary</a>
        <a href="network-map/" class="list-group-item list-group-item-action bg-light">Network Mapping</a>
        <a href="assetDetails/" class="list-group-item list-group-item-action bg-light">IT Asset Details</a>
        <a href="purchase/" class="list-group-item list-group-item-action bg-light">Purchase History</a>
        <a href="assetRepair/" class="list-group-item list-group-item-action bg-light">IT Asset Repair Service</a>
        <a href="catriedge/" class="list-group-item list-group-item-action bg-light">Catriedge Service</a>
        <a href="expense/" class="list-group-item list-group-item-action bg-light">IT Expense</a>
        <a href="support/" class="list-group-item list-group-item-action bg-light">IT Support</a>
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
              <a class="nav-link" href="admin.php" style="color:blue;"><i class="fa fa-home"></i>&nbsp;Home</a>
            </li>
            <li class="nav-item dropdown">
            <!--FETCH DETAILS-->
<?php
require 'db.php';
$getdata=("SELECT * FROM admin WHERE email='".$_SESSION['email']."' ");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{
?>
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-user"></i>
                <?php echo htmlspecialchars($row['name'], ENT_QUOTES); ?>
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" data-toggle="modal" type="button" data-target="#update_profile<?php echo htmlspecialchars($row['id'], ENT_QUOTES); ?>"><i class="fa fa-user-circle"></i>&nbsp;Edit Profile</a>
                <a class="dropdown-item" href="setting.php"><i class="fa fa-cog"></i>&nbsp;Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out"></i>&nbsp;Logout</a>
              </div>
<?php
include 'profile.php';
}
?>
<!--END FETCH-->              
            </li> 
          </ul>
        </div>
      </nav>
 <!--  TASK MANAGER    -->
<div class="header">
  <div class="row">
&nbsp;
  <div class="column">
    <div class="card" onclick="location.href='admin.php?status_all=valid';">
      <u class='link'>Total Tasks</u>
      <?php $count = mysqli_num_rows(mysqli_query($db, "SELECT * FROM task WHERE status_all='valid'")); 
echo "<b><p class='task-p'>$count</p></b>";  ?>
    </div>
  </div>
  <div class="column">
    <div class="card" onclick="location.href='admin.php?status=Completed';">
     <u class='link'>Completed</u>
     <?php $count = mysqli_num_rows(mysqli_query($db, "SELECT * FROM task WHERE status='Completed'")); 
echo "<b><p class='task-p'>$count</p></b>";  ?>
    </div>
  </div>
  <div class="column">
    <div class="card" onclick="location.href='admin.php?status=Active';">
     <u class='link'>Active</u>
     <?php $count = mysqli_num_rows(mysqli_query($db, "SELECT * FROM task WHERE status='Active'")); 
echo "<b><p class='task-p'>$count</p></b>";  ?>
    </div>
  </div>
  <div class="column2">
    <div class="card1"> 
    <u class='link'>| Reminder |</u> 
    <b><p class='task-p' id="loadDiv"></p></b>
    </div>
  </div>
  <div class="column2 showhide">
    <div class="card1">
    <u class='link'></u> 
    <b><p class='task-p'></p></b>
    </div>
  </div>
  <div class="column2 showhide">
    <div class="card1">
    <u class='link'>| Date - Time |</u> 
    <b><p class='task-p' id='ct7'></p></b>
    </div>
  </div>
</div>
</div>
<!-- FILTER SEARCH BY DATE & CREATE BUTTON -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light mt-2 mb-2 ml-2 mr-2">
  <form class="form-inline">
  <a class="nav-link" data-toggle="modal" type="button" data-target="#addTask"><i class="fa fa-plus"></i>&nbsp;add</a>
  <div class="dropdown">
  <a class="nav-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-download"></i>&nbsp;export
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item btn-download" href="export-excel.php?status_all=valid"><i class="fa fa-file-excel-o"></i>&nbsp;Total Tasks</a>
    <a class="dropdown-item btn-download" href="export-excel.php?status=Completed"><i class="fa fa-file-excel-o"></i>&nbsp;Task Completed</a>
    <a class="dropdown-item btn-download" href="export-excel.php?status=Active"><i class="fa fa-file-excel-o"></i>&nbsp;Task Active</a>
  </div>
</div>
  <input class="filter-search" type="search" placeholder="&#xf002 Search here.." aria-label="Search" id="Search" style="font-family: FontAwesome;">
 </form> 
</nav>
<div class="container-fluid"> <!-- SHOW TABLE -->
    <!-- TASK STATUS-->       
<?php
$status = ''; 
$status_all = ''; 
if( isset( $_GET['status']) && $_GET['status'] !='' ) {
    $status = mysqli_real_escape_string($db, $_GET['status']);
$getdata=("SELECT * FROM `task` WHERE status='$status' ORDER BY reg_date DESC,id DESC");
if($result_status = mysqli_query($db, $getdata))
if(mysqli_num_rows($result_status) > 0)
$i=1;
echo "<div class='header'> ";
    echo "<div class='row'> ";
echo "<div id='tbl-sml'>";
echo "<div class='all-header' style = 'text-transform:uppercase;'>
[ $status ]
</div>";
echo "<table id='Data'>";
 echo "<thead>";
  echo "<tr>
    <th style='position: sticky;top: 2.5em;'>#</th>
    <th style='position: sticky;top: 2.5em;'>Task</th>
    <th style='position: sticky;top: 2.5em;'>Registered On</th>
    <th style='position: sticky;top: 2.5em;'>User/ Department</th>
    <th style='position: sticky;top: 2.5em;'>Status</th>
    <th style='position: sticky;top: 2.5em;'>Edit</th>
    <th style='position: sticky;top: 2.5em;'>Delete</th>
  </tr>";
  echo "</thead>";
while($row = mysqli_fetch_assoc($result_status))
{ 
 $reg_date =  $row['reg_date'];
 $reg_date_IN= date("d-m-Y", strtotime($reg_date));
  echo "<tr>";
echo "<td>" . $i++ . "</td>";
echo "<td>" . htmlspecialchars($row['task'], ENT_QUOTES) . "</td>";
echo "<td>" . htmlspecialchars($reg_date_IN, ENT_QUOTES) . "</td>";
echo "<td>" . htmlspecialchars($row['user'], ENT_QUOTES) . "</td>";
echo '<td><a class="button-change-status button-'.htmlspecialchars($row['status'], ENT_QUOTES).' btn-status" href="task-status.php?id='.htmlspecialchars($row['id'], ENT_QUOTES).'">'.htmlspecialchars($row['status'], ENT_QUOTES).'</a></td>';
echo '<td><a class="button-change button-blue" data-toggle="modal" type="button" data-target="#update_task'.htmlspecialchars($row['id'], ENT_QUOTES).'"><i class="fa fa-edit"></i>&nbsp;Edit</a></td>';
echo '<td><a class="button-change button-red btn-del" href="delete.php?id='.htmlspecialchars($row['id'], ENT_QUOTES).'"><i class="fa fa-trash"></i>&nbsp;Delete</a></td>';
  echo "</tr>";
  include 'edit.php';
}
echo "</table>";
echo "</div>";
$getdata=("SELECT * FROM `admin` WHERE email='".$_SESSION['email']."'");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0) 
while($row = mysqli_fetch_assoc($result))
{
echo "<div class='column-profile'>";
    echo "<div class='card2'>";
echo "<div class='all-header'>
[ PROFILE ]
</div>";
   echo"<form method='POST' action='admin.php' enctype='multipart/form-data'>";
   echo "<div class='picture-container'>";
     echo "<div class='picture'>";
        echo "<img src='img/".htmlspecialchars($row['image'], ENT_QUOTES)."' class='picture-src'>";
        echo "<input type='file' name='image' accept='image/*' title='JPEG,PNG & GIF format is allowed. Upload limit is 3MB.' required>";
      echo "</div>";
  echo "</div>";
echo "<button class='button-upload' type='submit' name='change'><i class='fa fa-upload'></i>&nbsp;upload</button>";
echo "</form>";
$getdata1=("SELECT * FROM `company`");
if($result1 = mysqli_query($db, $getdata1))
if(mysqli_num_rows($result1) > 0)
while($row = mysqli_fetch_assoc($result1))
{
  echo "<h3 class='company-header'>".htmlspecialchars($row['company'], ENT_QUOTES)."</h3>";
}
$getdata=("SELECT * FROM `admin` WHERE email='".$_SESSION['email']."'");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0) 
while($row = mysqli_fetch_assoc($result))
{
  echo "<div class='profile-info'>";
  echo "<div class='profile-fetch'>";
  echo "<label class='profile-label'>Name:</label>".htmlspecialchars($row['name'], ENT_QUOTES)."";
  echo "</div>";
  echo "<div class='profile-fetch'>";
  echo "<label class='profile-label'>Designation:</label>".htmlspecialchars($row['designation'], ENT_QUOTES)."";
  echo "</div>";
  echo "<div class='profile-fetch'>";
  echo "<label class='profile-label'>Department:</label>".htmlspecialchars($row['department'], ENT_QUOTES)."";
  echo "</div>";
  echo "<div class='profile-fetch'>";
  echo "<label class='profile-label'>Phone:</label>".htmlspecialchars($row['phone'], ENT_QUOTES)."";
  echo "</div>";
  echo "<div class='profile-fetch'>";
  echo "<label class='profile-label'>Email:</label>".htmlspecialchars($row['email'], ENT_QUOTES)."";
  echo "</div>";
  echo "</div>";
}
// notice board
echo "<div class='column1'>";
echo "<div class='all-header'>
[ NOTICE &nbsp;BOARD ]
</div>";
echo "<div class='card-board'>";
echo "<div class='typewriter'>";
$getdata=("SELECT * FROM notice_board ORDER BY added_on DESC,id DESC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0) 
$i=1;
while($row = mysqli_fetch_assoc($result))
{
  echo "<h1>" . $i++ . ". ".htmlspecialchars($row['added_on'], ENT_QUOTES).": ".htmlspecialchars($row['subject'], ENT_QUOTES)."</h1>";
  echo "</br>";
}
echo "</div>";
echo "</div>";
echo "</div>";
  echo "</div>";
  echo "</div>";
}
  echo "</div>";
  echo "</div>";
}
// ALL TASK
  elseif ( isset( $_GET['status_all']) && $_GET['status_all'] !='' ) {
    $status_all = mysqli_real_escape_string($db, $_GET['status_all']);
  $getdata=("SELECT * FROM `task` WHERE status_all='$status_all' ORDER BY reg_date DESC,id DESC");
if($result_status_all = mysqli_query($db, $getdata))
if(mysqli_num_rows($result_status_all) > 0)
$i=1;
echo "<div class='header'> ";
    echo "<div class='row'> ";
echo "<div id='tbl-sml'>";
echo "<div class='all-header'>
[ ALL &nbsp;TASKS ]
</div>";
echo "<table id='Data'>";
 echo "<thead>";
  echo "<tr>
    <th style='position: sticky;top: 2.5em;'>#</th>
    <th style='position: sticky;top: 2.5em;'>Task</th>
    <th style='position: sticky;top: 2.5em;'>Registered On</th>
    <th style='position: sticky;top: 2.5em;'>User/ Department</th>
    <th style='position: sticky;top: 2.5em;'>Status</th>
    <th style='position: sticky;top: 2.5em;'>Edit</th>
    <th style='position: sticky;top: 2.5em;'>Delete</th>
  </tr>";
  echo "</thead>";
while($row = mysqli_fetch_assoc($result_status_all))
{ 
 $reg_date =  $row['reg_date'];
 $reg_date_IN= date("d-m-Y", strtotime($reg_date));    
  echo "<tr>";
echo "<td>" . $i++ . "</td>";
echo "<td>" . htmlspecialchars($row['task'], ENT_QUOTES) . "</td>";
echo "<td>" . htmlspecialchars($reg_date_IN, ENT_QUOTES) . "</td>";
echo "<td>" . htmlspecialchars($row['user'], ENT_QUOTES) . "</td>";
echo '<td><a class="button-change-status button-'.htmlspecialchars($row['status'], ENT_QUOTES).' btn-status" href="task-status.php?id='.htmlspecialchars($row['id'], ENT_QUOTES).'">'.htmlspecialchars($row['status'], ENT_QUOTES).'</a></td>';
echo '<td><a class="button-change button-blue" data-toggle="modal" type="button" data-target="#update_task'.htmlspecialchars($row['id'], ENT_QUOTES).'"><i class="fa fa-edit"></i>&nbsp;Edit</a></td>';
echo '<td><a class="button-change button-red btn-del" href="delete.php?id='.htmlspecialchars($row['id'], ENT_QUOTES).'"><i class="fa fa-trash"></i>&nbsp;Delete</a></td>';
  echo "</tr>";
  include 'edit.php';
}
echo "</table>";
echo "</div>";
$getdata=("SELECT * FROM `admin` WHERE email='".$_SESSION['email']."'");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0) 
while($row = mysqli_fetch_assoc($result))
{
echo "<div class='column-profile'>";
    echo "<div class='card2'>";
echo "<div class='all-header'>
[ PROFILE ]
</div>";
   echo"<form method='POST' action='admin.php' enctype='multipart/form-data'>";
   echo "<div class='picture-container'>";
     echo "<div class='picture'>";
        echo "<img src='img/".htmlspecialchars($row['image'], ENT_QUOTES)."' class='picture-src'>";
        echo "<input type='file' name='image' accept='image/*' title='JPEG,PNG & GIF format is allowed. Upload limit is 3MB.' required>";
      echo "</div>";
  echo "</div>";
echo "<button class='button-upload' type='submit' name='change'><i class='fa fa-upload'></i>&nbsp;upload</button>";
echo "</form>";
$getdata1=("SELECT * FROM `company`");
if($result1 = mysqli_query($db, $getdata1))
if(mysqli_num_rows($result1) > 0)
while($row = mysqli_fetch_assoc($result1))
{
  echo "<h3 class='company-header'>".htmlspecialchars($row['company'], ENT_QUOTES)."</h3>";
}
$getdata=("SELECT * FROM `admin` WHERE email='".$_SESSION['email']."'");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0) 
while($row = mysqli_fetch_assoc($result))
{
  echo "<div class='profile-info'>";
  echo "<div class='profile-fetch'>";
  echo "<label class='profile-label'>Name:</label>".htmlspecialchars($row['name'], ENT_QUOTES)."";
  echo "</div>";
  echo "<div class='profile-fetch'>";
  echo "<label class='profile-label'>Designation:</label>".htmlspecialchars($row['designation'], ENT_QUOTES)."";
  echo "</div>";
  echo "<div class='profile-fetch'>";
  echo "<label class='profile-label'>Department:</label>".htmlspecialchars($row['department'], ENT_QUOTES)."";
  echo "</div>";
  echo "<div class='profile-fetch'>";
  echo "<label class='profile-label'>Phone:</label>".htmlspecialchars($row['phone'], ENT_QUOTES)."";
  echo "</div>";
  echo "<div class='profile-fetch'>";
  echo "<label class='profile-label'>Email:</label>".htmlspecialchars($row['email'], ENT_QUOTES)."";
  echo "</div>";
  echo "</div>";
}
// notice board
echo "<div class='column1'>";
echo "<div class='all-header'>
[ NOTICE &nbsp;BOARD ]
</div>";
echo "<div class='card-board'>";
echo "<div class='typewriter'>";
$getdata=("SELECT * FROM notice_board ORDER BY added_on DESC,id DESC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0) 
$i=1;
while($row = mysqli_fetch_assoc($result))
{
  echo "<h1>" . $i++ . ". ".htmlspecialchars($row['added_on'], ENT_QUOTES).": ".htmlspecialchars($row['subject'], ENT_QUOTES)."</h1>";
  echo "</br>";
}
echo "</div>";
echo "</div>";
echo "</div>";
  echo "</div>";
  echo "</div>";
}
  echo "</div>";
  echo "</div>";
}
else {
  $getdata=("SELECT * FROM `task` WHERE status_all='valid' ORDER BY reg_date DESC,id DESC");
if($result_valid = mysqli_query($db, $getdata))
if(mysqli_num_rows($result_valid) > 0)
$i=1;
echo "<div class='header'> ";
    echo "<div class='row'> ";
echo "<div id='tbl-sml'>";
echo "<div class='all-header'>
[ ALL &nbsp;TASKS ]
</div>";
echo "<table id='Data'>";
 echo "<thead>";
  echo "<tr>
    <th style='position: sticky;top: 2.5em;'>#</th>
    <th style='position: sticky;top: 2.5em;'>Task</th>
    <th style='position: sticky;top: 2.5em;'>Registered On</th>
    <th style='position: sticky;top: 2.5em;'>User/ Department</th>
    <th style='position: sticky;top: 2.5em;'>Status</th>
    <th style='position: sticky;top: 2.5em;'>Edit</th>
    <th style='position: sticky;top: 2.5em;'>Delete</th>
  </tr>";
  echo "</thead>";
while($row = mysqli_fetch_assoc($result_valid))
{ 
 $reg_date =  $row['reg_date'];
 $reg_date_IN= date("d-m-Y", strtotime($reg_date));
  echo "<tr>";
echo "<td>" . $i++ . "</td>";
echo "<td>" . htmlspecialchars($row['task'], ENT_QUOTES) . "</td>";
echo "<td>" . htmlspecialchars($reg_date_IN, ENT_QUOTES) . "</td>";
echo "<td>" . htmlspecialchars($row['user'], ENT_QUOTES) . "</td>";
echo '<td><a class="button-change-status button-'.htmlspecialchars($row['status'], ENT_QUOTES).' btn-status" href="task-status.php?id='.htmlspecialchars($row['id'], ENT_QUOTES).'">'.htmlspecialchars($row['status'], ENT_QUOTES).'</a></td>';
echo '<td><a class="button-change button-blue" data-toggle="modal" type="button" data-target="#update_task'.htmlspecialchars($row['id'], ENT_QUOTES).'"><i class="fa fa-edit"></i>&nbsp;Edit</a></td>';
echo '<td><a class="button-change button-red btn-del" href="delete.php?id='.htmlspecialchars($row['id'], ENT_QUOTES).'"><i class="fa fa-trash"></i>&nbsp;Delete</a></td>';
  echo "</tr>";
  include 'edit.php';
}
echo "</table>";
echo "</div>";
$getdata=("SELECT * FROM `admin` WHERE email='".$_SESSION['email']."'");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0) 
while($row = mysqli_fetch_assoc($result))
{
echo "<div class='column-profile'>";
    echo "<div class='card2'>";
echo "<div class='all-header'>
[ PROFILE ]
</div>";
   echo"<form method='POST' action='admin.php' enctype='multipart/form-data'>";
   echo "<div class='picture-container'>";
     echo "<div class='picture'>";
        echo "<img src='img/".htmlspecialchars($row['image'], ENT_QUOTES)."' class='picture-src'>";
        echo "<input type='file' name='image' accept='image/*' title='JPEG,PNG & GIF format is allowed. Upload limit is 3MB.' required>";
      echo "</div>";
  echo "</div>";
echo "<button class='button-upload' type='submit' name='change'><i class='fa fa-upload'></i>&nbsp;upload</button>";
echo "</form>";
$getdata1=("SELECT * FROM `company`");
if($result1 = mysqli_query($db, $getdata1))
if(mysqli_num_rows($result1) > 0)
while($row = mysqli_fetch_assoc($result1))
{
  echo "<h3 class='company-header'>".htmlspecialchars($row['company'], ENT_QUOTES)."</h3>";
}
$getdata=("SELECT * FROM `admin` WHERE email='".$_SESSION['email']."'");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0) 
while($row = mysqli_fetch_assoc($result))
{
  echo "<div class='profile-info'>";
  echo "<div class='profile-fetch'>";
  echo "<label class='profile-label'>Name:</label>".htmlspecialchars($row['name'], ENT_QUOTES)."";
  echo "</div>";
  echo "<div class='profile-fetch'>";
  echo "<label class='profile-label'>Designation:</label>".htmlspecialchars($row['designation'], ENT_QUOTES)."";
  echo "</div>";
  echo "<div class='profile-fetch'>";
  echo "<label class='profile-label'>Department:</label>".htmlspecialchars($row['department'], ENT_QUOTES)."";
  echo "</div>";
  echo "<div class='profile-fetch'>";
  echo "<label class='profile-label'>Phone:</label>".htmlspecialchars($row['phone'], ENT_QUOTES)."";
  echo "</div>";
  echo "<div class='profile-fetch'>";
  echo "<label class='profile-label'>Email:</label>".htmlspecialchars($row['email'], ENT_QUOTES)."";
  echo "</div>";
  echo "</div>";
}
// notice board
echo "<div class='column1'>";
echo "<div class='all-header'>
[ NOTICE &nbsp;BOARD ]
</div>";
echo "<div class='card-board'>";
echo "<div class='typewriter'>";
$getdata=("SELECT * FROM notice_board ORDER BY added_on DESC,id DESC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0) 
$i=1;
while($row = mysqli_fetch_assoc($result))
{
  echo "<h1>" . $i++ . ". ".htmlspecialchars($row['added_on'], ENT_QUOTES).": ".htmlspecialchars($row['subject'], ENT_QUOTES)."</h1>";
  echo "</br>";
}
echo "</div>";
echo "</div>";
echo "</div>";
  echo "</div>";
  echo "</div>";
}
  echo "</div>";
  echo "</div>";
 } 
 ?>     
  </div>
 <!--  here    -->    
    </div>
  </div>
<hr>
  <!-- Bootstrap core JavaScript -->
  <script src="../nav-style/jquery.min.js"></script>
  <script src="../nav-style/bootstrap.bundle.min.js"></script>
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
<!--FOOTER-->
<?php include "src/footer.php"; ?> 
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
  title: 'Deleted Successfully!',
})
}
 </script>
 <!-- FLASH STATUS -->
<?php if (isset($_GET['task'])) : ?>
<div class="flash-task" data-flashtask="<?=$_GET['task'];?>"></div>
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
const flashtask = $('.flash-task').data('flashtask')
if (flashtask) {
  swal.fire ({
  type: 'success',
  title: 'Status Changed Successfully!',
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
<?php if (isset($_GET['edit'])) : ?>
<div class="flash-edit" data-flashedit="<?=$_GET['edit'];?>"></div>
<?php endif; ?>
<script>
const flashedit = $('.flash-edit').data('flashedit')
if (flashedit) {
  swal.fire ({
  type: 'success',
  title: 'Task Updated Successfully!',
})
}
 </script>
 <!-- FLASH PROFILE DETAILS -->
<?php if (isset($_GET['s'])) : ?>
<div class="flash-profile" data-flashprofile="<?=$_GET['s'];?>"></div>
<?php endif; ?>
<script>
const flashprofile = $('.flash-profile').data('flashprofile')
if (flashprofile) {
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
  title: 'Task Added Successfully!',
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
<!-- TASK ADD MODAL FORM -->
<div class="modal fade" id="addTask" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
<div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Task</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="POST" action="add.php" enctype="multipart/form-data">
  <div class='form-group'>
    <label>Task<span style="color:red;">*</span></label>
    <textarea type="textarea" name="task" placeholder="Enter a task" class="form-control" required></textarea>
  </div>
  <div class='form-group'>
  <label>Register On<span style="color:red;">*</span></label>
    <input type="date" name="reg_date" placeholder="Task register date" class="form-control" required>
 </div> 
 <div class='form-group'>
  <label>User/Department<span style="color:red;">*</span></label>
  <select name="user" id='testSelect1' class="form-control" required>
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
<!-- Check Admin Status -->
 <script src="../js/jquery-3.6.0.min.js"></script>
 <script src="auto_check_status.js"></script>
 <!-- Auto load div -->
 <script> 
var auto_refresh = setInterval(function() { 
 $('#loadDiv').load('auto_load_div.php').fadeIn("slow"); 
}, 518400000);  // 6 days time interval
var refresh = setInterval(function() { 
 $('#loadDiv').fadeOut("slow"); 
}, 86400000);  // 1 day time interval
</script>
</div> <!-- Preloader DIV END-->
<!-- RESUBMIT FORM PREVENT -->
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>
<!-- UPLOAD AVATAR -->
<?php
if(isset($_POST['change'])){
	$file=$_FILES['image']['tmp_name'];
  if(empty($file)){
    echo "<script>swal.fire ({
      type: 'error',
      title: 'Error',
      text: 'Please Select a Avatar!',
      icon: 'error',
    })
    </script>";      
  }
  if ($_FILES['image']['size'] > 3000000) {
    echo "<script>swal.fire ({
      type: 'error',
      title: 'Error',
      text: 'File Size Is Greater Than 3MB!',
      icon: 'error',
    })
    </script>";
  } 
  else{
	list($width,$height)=getimagesize($file);
	$nwidth=$width/4;
	$nheight=$height/4;
	$newimage=imagecreatetruecolor($nwidth,$nheight);
	if($_FILES['image']['type']=='image/jpeg'){
		$source=imagecreatefromjpeg($file);
		imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
		$file_name=time().'.jpg';
    $sql="UPDATE `admin` SET image='$file_name' WHERE email='".$_SESSION['email']."'";  
    if($result = mysqli_query($db, $sql))
		imagejpeg($newimage,'img/'.$file_name);
    header ("Location:admin.php");
    die();
	}elseif($_FILES['image']['type']=='image/png'){
		$source=imagecreatefrompng($file);
		imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
		$file_name=time().'.png';
    $sql="UPDATE `admin` SET image='$file_name' WHERE email='".$_SESSION['email']."'";  
    if($result = mysqli_query($db, $sql))
		imagepng($newimage,'img/'.$file_name);
    header ("Location:admin.php");
    die();
	}elseif($_FILES['image']['type']=='image/gif'){
		$source=imagecreatefromgif($file);
		imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
		$file_name=time().'.gif';
    $sql="UPDATE `admin` SET image='$file_name' WHERE email='".$_SESSION['email']."'";  
    if($result = mysqli_query($db, $sql))
		imagegif($newimage,'img/'.$file_name);
    header ("Location:admin.php");
    die();
	}else{
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