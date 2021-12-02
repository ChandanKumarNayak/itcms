<?php 
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
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
    <title>Custom Export: IT Asset Details | IT-CMS</title>
    <link rel="icon" type="image/png" href="../../img/IT.png"/> <!-- page icon -->
<!-- SWEET ALERT JS -->
 <script src="../../js/jquery-3.5.1.min.js"></script>
 <script src="../../js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php
require('../db.php');
$date = "";
// generate date
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$department = '';
$html='';
if(isset($_POST['export'])){
$department = $_POST['department'];
$getdata=("SELECT * FROM `assetdetails` WHERE department ='$department' ORDER BY system_type ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
{
  $i=1;
$html.='<table border="1">
  <tr>
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
  </tr>';
while($row = mysqli_fetch_assoc($result))
{ 
  $html.='<tr><td>' . $i++ . '</td>
              <td>' . $row['system_type'] . '</td>
              <td>' . $row['system_name'] . '</td>
              <td>' . $row['brand'] . '</td>
              <td>' . $row['model_no'] . '</td>
              <td>' . $row['serial_no'] . '</td>
              <td>' . $row['os'] . '</td>
              <td>' . $row['processor'] . '</td>
              <td>' . $row['ram'] . '</td>
              <td>' . $row['hard_disk'] . '</td>
              <td>' . $row['ip'] . '</td>
              <td>' . $row['antivirus'] . '</td>
              <td>' . $row['user'] . '</td>
              <td>' . $row['designation'] . '</td>
              <td>' . $row['department'] . '</td>
              <td>' . $row['location'] . '</td>
          </tr>';
} 
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename='.$department.'_IT Asset Details_'.$date.'.xls');
echo $html;
exit;
}
else {
echo "<script>swal.fire ({
  type: 'error',
  title: 'Error',
  text: 'No Record Found!',
  icon: 'error',
}).then(function(){window.location = 'index.php'})
</script>";
}
}
?>
</body>
</html>