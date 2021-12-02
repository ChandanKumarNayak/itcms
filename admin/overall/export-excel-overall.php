<?php 
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
    die();
  }
 ?>
<!-- Export Overall Summary -->
<?php
require('../db.php');
$date = "";
// generate date
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$html='';
$getdata=("SELECT system_type, count(system_type) as total FROM assetdetails
        GROUP BY system_type");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
$i=1;
$html.='<table border="1">
  <tr>
    <th>#</th>
    <th>Asset Type</th>
    <th>Quantity</th>
  </tr>';
while($row = mysqli_fetch_assoc($result))
{ 
  $html.='<tr><td>' . $i++ . '</td>
              <td>' . $row['system_type'] . '</td>
              <td>' . $row['total'] . '</td>
          </tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=Overall IT Asset Summary_'.$date.'.xls');
echo $html;
exit;
?>