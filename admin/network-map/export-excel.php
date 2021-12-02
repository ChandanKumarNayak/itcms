<?php 
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
    die();
  }
 ?>
<!-- Export NETMAP Details -->
<?php
require('../db.php');
$date = "";
// generate date
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$location = "";
$html='';
if(isset($_GET['location']) && $_GET['location'] !='' )
{
    $location=mysqli_real_escape_string($db, $_GET['location']);
$getdata=("SELECT * FROM `network_map` WHERE location='$location' ORDER BY id ASC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
$i=1;
$html.='<table border="1">
  <tr>
    <th>#</th>
    <th>User</th>
    <th>Port No (IO Box)</th>
    <th>Port No (Switch)</th>
  </tr>';
while($row = mysqli_fetch_assoc($result))
{ 
  $html.='<tr><td>' . $i++ . '</td>
              <td>' . $row['user'] . '</td>
              <td>' . $row['iobox_port_no'] . '</td>
              <td>' . $row['switch_port_no'] . '</td>
          </tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename='.$location.'_Network Mapping_'.$date.'.xls');
echo $html;
exit;
}
?>