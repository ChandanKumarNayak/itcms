<?php 
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
    die();
  }
 ?>
<?php
require('../db.php');
$date = "";
// generate date
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$html='';
$getdata=('SELECT * FROM `catriedge` ORDER BY service_date DESC,id DESC');
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
$i=1;
$html.='<table border="1">
  <tr>
    <th>#</th>
    <th>Catriedge Type</th>
    <th>User</th>
    <th>Vendor Name</th>
    <th>Service Date</th>
    <th>Refill Amount</th>
    <th>Repair Type</th>
    <th>Repair Amount</th>
    <th>Bill No</th>
    <th>Cheque No</th>
    <th>Bill Clear Date</th>
    <th>Total Cost</th>
  </tr>';
while($row = mysqli_fetch_assoc($result))
{ 
  $html.='<tr><td>' . $i++ . '</td>
              <td>' . $row['type'] . '</td>
              <td>' . $row['user'] . '</td>
              <td>' . $row['vendor'] . '</td>
			        <td>' . $row['service_date'] . '</td>
              <td>' . number_format($row['refill_amount'], 2, '.', ',') . '</td>
              <td>' . $row['repair_details'] . '</td>
              <td>' . number_format($row['repair_amount'], 2, '.', ',') . '</td>
              <td>' . $row['bill_no'] . '</td>
              <td>' . $row['cheque_no'] . '</td>
              <td>' . $row['bill_clear_date'] . '</td>
              <td>' . $row['total_cost'] . '</td></tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=catriedge service_'.$date.'.xls');
echo $html;
exit;
?>