<?php 
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
  <title>IT Support | IT-CMS</title>
  <link rel="stylesheet" type="text/css" href="../../css/flip-style.css"> <!-- SUPPORT CARD STYLE -->
 <link rel="icon" type="image/png" href="../../img/IT.png"/> <!-- page icon -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <!-- ICONS -->
 <!-- PRELOADER -->
  <link href="../../css/preloader.css" rel="stylesheet">
   <script>
    window.onload=function(){
      document.getElementById('loader').style.display="none";
      document.getElementById('content').style.display="block";
    };
    </script>
  <!-- NAV BAR -->
  <link href="../../nav-style/bootstrap.min.css" rel="stylesheet">
  <link href="../../nav-style/simple-sidebar.css" rel="stylesheet">
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
        <a href="../assetDetails/" class="list-group-item list-group-item-action bg-light">IT Asset Details</a>
        <a href="../purchase/" class="list-group-item list-group-item-action bg-light">Purchase History</a>
        <a href="../assetRepair/" class="list-group-item list-group-item-action bg-light">IT Asset Repair Service</a>
        <a href="../catriedge/" class="list-group-item list-group-item-action bg-light">Catriedge Service</a>
        <a href="../expense/" class="list-group-item list-group-item-action bg-light">IT Expense</a>
        <a href="index.php" class="list-group-item list-group-item-action bg-light" style="color:blue;">IT Support <i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i></a>
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
 <div class="container-fluid">
<!-- BMW Support Team -->
<span class="company-header">BMW &nbsp;IT&nbsp; SUPPORT&nbsp;TEAM [ INDIA ]</span>
<!-- IT -->
<center>
<div class="flip-card">
<div class="flip-card-inner">
<div class="flip-card-front">
<img src="../img/no-avatar.jpg" alt="" class="card-image" >
<h4 class="person-name"><a href="#">Sashank Tyagi</a></h4>
<div class="designation">[ BMW IT Support Partner ]</div>
</div>
<div class="flip-card-back">
<p>Name: Sashank Tyagi</p> 
<div class="dropdown-divider"></div>
<p>Designation: BMW IT Support Partner</p>
<div class="dropdown-divider"></div>
<p>Phone: <a href="tel:9891682809">+91 9891682809 </a></p> 
<div class="dropdown-divider"></div> 
<p>Email: <a href="mailto:tusar.mb.mukherjee@bmw-oslprestige.in" target="_blank">Shashank.Tyagi@partner.bmw.in</a></p>
<div class="dropdown-divider"></div>
<p>Web: <a href="https://www.bmw.in/en/index.html" target="_blank">https://www.bmw.in/en/index.html</a></p>
<div class="dropdown-divider"></div>
<p>Location: Delhi, India</p>
</div>
</div>
</div>
</center>
<!-- IT EXECUTIVE  -->
<div class="flip-card-junior">
<div class="flip-card-inner">
<div class="flip-card-front">
<img src="../img/no-avatar.jpg" alt="" class="card-image-junior" >
<h4 class="person-name"><a href="#">Mr. Sanjib</a></h4>
<div class="designation">[ Support-IT ]</div>
</div>
<div class="flip-card-back">
<p>Name: Sanjib</p> 
<div class="dropdown-divider"></div>
<p>Designation: Support-IT</p>
<div class="dropdown-divider"></div>
<p>Phone: <a href="tel:9964454669">+91 9964454669</a></p> 
<div class="dropdown-divider"></div> 
<p>Email: <a href="mailto:tusar.mb.mukherjee@bmw-oslprestige.in" target="_blank">tusar.mb.mukherjee@bmw-oslprestige.in</a></p>
<div class="dropdown-divider"></div>
<p>Location: Kolkata</p>
</div>
</div>
</div>
<!-- IT EXECUTIVE-2  -->
<div class="flip-card-junior">
<div class="flip-card-inner">
<div class="flip-card-front">
<img src="../img/no-avatar.jpg" alt="" class="card-image-junior" >
<h4 class="person-name"><a href="#">Mr. B</a></h4>
<div class="designation">[ Support-IT ]</div>
</div>
<div class="flip-card-back">
<p>Name: Tusar Mukherjee</p> 
<div class="dropdown-divider"></div>
<p>Designation: Support-IT</p>
<div class="dropdown-divider"></div>
<p>Phone: <a href="tel:9874814738">+91 9874814738</a></p> 
<div class="dropdown-divider"></div> 
<p>Email: <a href="mailto:tusar.mb.mukherjee@bmw-oslprestige.in" target="_blank">tusar.mb.mukherjee@bmw-oslprestige.in</a></p>
<div class="dropdown-divider"></div>
<p>Location: Kolkata</p>
</div>
</div>
</div>
<!-- IT EXECUTIVE-3  -->
<div class="flip-card-junior">
<div class="flip-card-inner">
<div class="flip-card-front">
<img src="../img/no-avatar.jpg" alt="" class="card-image-junior" >
<h4 class="person-name"><a href="#">Mr. C</a></h4>
<div class="designation">[ Support-IT ]</div>
</div>
<div class="flip-card-back">
<p>Name: Tusar Mukherjee</p> 
<div class="dropdown-divider"></div>
<p>Designation: Support-IT</p>
<div class="dropdown-divider"></div>
<p>Phone: <a href="tel:9874814738">+91 9874814738</a></p> 
<div class="dropdown-divider"></div> 
<p>Email: <a href="mailto:tusar.mb.mukherjee@bmw-oslprestige.in" target="_blank">tusar.mb.mukherjee@bmw-oslprestige.in</a></p>
<div class="dropdown-divider"></div>
<p>Location: Kolkata</p>
</div>
</div>
</div>
<!-- IT EXECUTIVE-4  -->
<div class="flip-card-junior">
<div class="flip-card-inner">
<div class="flip-card-front">
<img src="../img/no-avatar.jpg" alt="" class="card-image-junior" >
<h4 class="person-name"><a href="#">Mr. D</a></h4>
<div class="designation">[ Support-IT ]</div>
</div>
<div class="flip-card-back">
<p>Name: Tusar Mukherjee</p> 
<div class="dropdown-divider"></div>
<p>Designation: Support-IT</p>
<div class="dropdown-divider"></div>
<p>Phone: <a href="tel:9874814738">+91 9874814738</a></p> 
<div class="dropdown-divider"></div> 
<p>Email: <a href="mailto:tusar.mb.mukherjee@bmw-oslprestige.in" target="_blank">tusar.mb.mukherjee@bmw-oslprestige.in</a></p>
<div class="dropdown-divider"></div>
<p>Location: Kolkata</p>
</div>
</div>
</div>
<!-- Dealer Group -->
<span class="company-header">OSL&nbsp; PRESTIGE&nbsp; PVT.&nbsp; LTD.&nbsp;IT &nbsp;SUPPORT &nbsp;TEAM [ KOLKATA & ODISHA ]</span>
<!-- MANAGER IT -->
<center>
<div class="flip-card">
<div class="flip-card-inner">
<div class="flip-card-front">
<img src="../img/ItManager.jpeg" alt="" class="card-image" >
<h4 class="person-name"><a href="#">Tusar Mukherjee</a></h4>
<div class="designation">[ Manager-IT ]</div>
</div>
<div class="flip-card-back">
<p>Name: Tusar Mukherjee</p> 
<div class="dropdown-divider"></div>
<p>Designation: Manager-IT</p>
<div class="dropdown-divider"></div>
<p>Phone: <a href="tel:9874814738">+91 9874814738</a></p> 
<div class="dropdown-divider"></div> 
<p>Email: <a href="mailto:tusar.mb.mukherjee@bmw-oslprestige.in" target="_blank">tusar.mb.mukherjee@bmw-oslprestige.in</a></p>
<div class="dropdown-divider"></div>
<p>Web: <a href="https://www.bmw-oslprestige.in/" target="_blank">https://www.bmw-oslprestige.in/</a></p>
<div class="dropdown-divider"></div>
<p>Location: Kolkata, India</p>
</div>
</div>
</div>
</center>
<!-- IT EXECUTIVE  -->
<div class="flip-card-junior">
<div class="flip-card-inner">
<div class="flip-card-front">
<img src="../img/no-avatar.jpg" alt="" class="card-image-junior" >
<h4 class="person-name"><a href="#">Saidul Haque</a></h4>
<div class="designation">[ Executive-IT ]</div>
</div>
<div class="flip-card-back">
<p>Name: Tusar Mukherjee</p> 
<div class="dropdown-divider"></div>
<p>Designation: Support-IT</p>
<div class="dropdown-divider"></div>
<p>Phone: <a href="tel:9874814738">+91 9874814738</a></p> 
<div class="dropdown-divider"></div> 
<p>Email: <a href="mailto:tusar.mb.mukherjee@bmw-oslprestige.in" target="_blank">tusar.mb.mukherjee@bmw-oslprestige.in</a></p>
<div class="dropdown-divider"></div>
<p>Location: Kolkata</p>
</div>
</div>
</div>
<!-- IT EXECUTIVE-2  -->
<div class="flip-card-junior">
<div class="flip-card-inner">
<div class="flip-card-front">
<img src="../img/no-avatar.jpg" alt="" class="card-image-junior" >
<h4 class="person-name"><a href="#">Mr. A</a></h4>
<div class="designation">[ Support-IT ]</div>
</div>
<div class="flip-card-back">
<p>Name: Tusar Mukherjee</p> 
<div class="dropdown-divider"></div>
<p>Designation: Support-IT</p>
<div class="dropdown-divider"></div>
<p>Phone: <a href="tel:9874814738">+91 9874814738</a></p> 
<div class="dropdown-divider"></div> 
<p>Email: <a href="mailto:tusar.mb.mukherjee@bmw-oslprestige.in" target="_blank">tusar.mb.mukherjee@bmw-oslprestige.in</a></p>
<div class="dropdown-divider"></div>
<p>Location: Kolkata</p>
</div>
</div>
</div>
<!-- IT EXECUTIVE-3  -->
<div class="flip-card-junior">
<div class="flip-card-inner">
<div class="flip-card-front">
<img src="../img/no-avatar.jpg" alt="" class="card-image-junior" >
<h4 class="person-name"><a href="#">Mr. B</a></h4>
<div class="designation">[ Support-IT ]</div>
</div>
<div class="flip-card-back">
<p>Name: Tusar Mukherjee</p> 
<div class="dropdown-divider"></div>
<p>Designation: Support-IT</p>
<div class="dropdown-divider"></div>
<p>Phone: <a href="tel:9874814738">+91 9874814738</a></p> 
<div class="dropdown-divider"></div> 
<p>Email: <a href="mailto:tusar.mb.mukherjee@bmw-oslprestige.in" target="_blank">tusar.mb.mukherjee@bmw-oslprestige.in</a></p>
<div class="dropdown-divider"></div>
<p>Location: Kolkata</p>
</div>
</div>
</div>
<!-- IT EXECUTIVE-4  -->
<div class="flip-card-junior">
<div class="flip-card-inner">
<div class="flip-card-front">
<img src="../img/no-avatar.jpg" alt="" class="card-image-junior" >
<h4 class="person-name"><a href="#">Mr. C</a></h4>
<div class="designation">[ Support-IT ]</div>
</div>
<div class="flip-card-back">
<p>Name: Tusar Mukherjee</p> 
<div class="dropdown-divider"></div>
<p>Designation: Support-IT</p>
<div class="dropdown-divider"></div>
<p>Phone: <a href="tel:9874814738">+91 9874814738</a></p> 
<div class="dropdown-divider"></div> 
<p>Email: <a href="mailto:tusar.mb.mukherjee@bmw-oslprestige.in" target="_blank">tusar.mb.mukherjee@bmw-oslprestige.in</a></p>
<div class="dropdown-divider"></div>
<p>Location: Kolkata</p>
</div>
</div>
</div>
<!--  ISP SUPPORT  -->   
<span class="accordion company-header">ISP &nbsp;SUPPORT&nbsp; TEAM</span>
<div class="panel">
  <div class="support-container">
  <div class="support-item-left">
  <?php
$getdata=("SELECT * FROM `support` ");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?> 
  <p>ISP: <?php echo $row['isp']; ?></p>
  <p>CIRCUIT ID: <?php echo $row['circuit_id']; ?></p>
  <p>SR NO: <?php echo $row['sr_no']; ?></p>
  <p>MAIN IP: <?php echo $row['main_ip']; ?></p>
<?php } ?> 
  </div>
 <div class="vertical-line"></div>
  <div class="support-item-right">
  <?php
$getdata=("SELECT * FROM `support` ");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{?> 
  <p>CUSTOMER CARE: <a href="tel:<?php echo $row['cc_no_charge']; ?>">+91 <?php echo $row['cc_no_charge']; ?> </a> (toll-free) </p>
  <p><span style="color:#f1f1f1;">CUSTOMER CARE</span> : <a href="tel:<?php echo $row['cc_charge']; ?>">+91 <?php echo $row['cc_charge']; ?> </a> (chargeable)
  </p>
  <div class="dropdown-divider"></div>
  <p>CRM: <?php echo $row['crm']; ?></p>
  <p>PHONE: <a href="tel:<?php echo $row['crm_phone']; ?>">+91 <?php echo $row['crm_phone']; ?> </a></p>
  <p>EMAIL: <a href="mailto:<?php echo $row['crm_email']; ?>"><?php echo $row['crm_email']; ?> </a></p>
  <?php } ?>
  </div>
  </div>
</div>
<script>
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>
<!-- END ACCORDION -->
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
}).then(function(){window.location = 'index.php'})
}
 </script>
 <!-- Check Admin Status -->
 <script src="../../js/jquery-3.6.0.min.js"></script>
 <script src="auto_check_status.js"></script>
 </div>
</body>
</html>