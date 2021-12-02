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
$htmlsum='';
//TOTAL COST
$getsum=("SELECT SUM(cost) AS sum FROM `expense`");
$resultsum = mysqli_query($db, $getsum);
while($row= mysqli_fetch_assoc($resultsum))
{
  $final_sum = $row['sum'];
}
// COMPANY
$get=("SELECT * FROM `expense` ORDER BY id DESC LIMIT 1");
if($result = mysqli_query($db, $get))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{ 
$htmlsum.='<table border="1">
<tr>  
    <th>Company Name:</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th>Total Expense:</th>
    <th>' . number_format($final_sum, 2, '.', ',') . '</th>
</tr>';
  $htmlsum.='<tr>
              <td>' . $row['company'] . '</td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><b>From Date:</b></td>
              <td>' . $row['from_date'] . '</td>
              <td><b>Till Date:</b></td>
              <td>' . $date . '</td>
              </tr>';  
}
$htmlsum.='</table>';
// ALL EXPENSES
$getdata=('SELECT * FROM `expense` ORDER BY service_date DESC,id DESC');
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
$i=1;
$html.='<table border="1">
  <tr>
    <th>#</th>
    <th>Expense Details</th>
    <th>User</th>
    <th>Service Date</th>   
    <th>Vendor</th> 
    <th>Bill No</th>
    <th>Cheque No.</th>
    <th>Bill Clear Date</th>
    <th>Amount</th>
  </tr>';
while($row = mysqli_fetch_assoc($result))
{ 
  $html.='<tr><td>' . $i++ . '</td>
              <td>' . $row['details'] . '</td>
              <td>' . $row['user'] . '</td>
			        <td>' . $row['service_date'] . '</td>
              <td>' . $row['vendor'] . '</td>
              <td>' . $row['bill_no'] . '</td>
              <td>' . $row['cheque_no'] . '</td>
              <td>' . $row['bill_clear_date'] . '</td>
              <td style="text-align: right;font-weight:bold;">' . number_format($row['cost'], 2, '.', ',') . '</td>
          </tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=it expense_'.$date.'.xls');
echo $htmlsum;
echo $html;
exit;
?>