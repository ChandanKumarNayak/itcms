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
$getdata=('SELECT * FROM `purchase` ORDER BY date_of_purchase DESC,id DESC');
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
$i=1;
$html.='<table border="1">
  <tr>
    <th>#</th>
    <th>Asset Details</th>
    <th>Serial No</th>
    <th>User</th>
    <th>Purchase Date</th>
    <th>Vendor Name</th>
    <th>Bill No</th>
    <th>Cheque No</th>
    <th>Bill Clear Date</th>
    <th>Total Cost</th>
  </tr>';
while($row = mysqli_fetch_assoc($result))
{ 
  $html.='<tr><td>' . $i++ . '</td>
              <td>' . $row['asset_details'] . '</td>
              <td>' . $row['serial_no'] . '</td>
              <td>' . $row['user'] . '</td>
			        <td>' . $row['date_of_purchase'] . '</td>
              <td>' . $row['vendor'] . '</td>
              <td>' . $row['bill_no'] . '</td>
              <td>' . $row['cheque_no'] . '</td>
            <td>' . $row['bill_clear_date'] . '</td>
              <td>' . number_format($row['total_cost'], 2, '.', ',') . '</td></tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=it asset purchase_'.$date.'.xls');
echo $html;
exit;
?>