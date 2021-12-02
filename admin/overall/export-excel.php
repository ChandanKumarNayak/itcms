<?php 
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
    die();
  }
 ?>
<!-- Export Asset Details -->
<?php
require('../db.php');
$date = "";
// generate date
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$system_type = "";
$html='';
if( isset( $_GET['system_type']) && $_GET['system_type'] !='' ) 
{
    $system_type=mysqli_real_escape_string($db, $_GET['system_type']);
$getdata=("SELECT * FROM `assetdetails` WHERE system_type='$system_type' ORDER BY user ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
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
header('Content-Disposition:attachment;filename='.$system_type.'_Details_'.$date.'.xls');
echo $html;
exit;
}
 elseif(isset($_GET['stock']) && $_GET['stock']>0 )
{
$stock=mysqli_real_escape_string($db, $_GET['stock']); 
$getdata=("SELECT * FROM `assetstock` ORDER BY asset_name ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
$i=1;
$html.='<table border="1">
  <tr>
    <th>#</th>
    <th>Asset Name</th>
    <th>Quantity</th>
  </tr>';
while($row = mysqli_fetch_assoc($result))
{ 
  $html.='<tr>
  <td>' . $i++ . '</td>
  <td>' . $row['asset_name'] . '</td>
   <td>' . $row['quantity'] . '</td>
          </tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=Stock_Assets_'.$date.'.xls');
echo $html;
exit;
}
?>