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
    <title>Custom Export: IT Expense | IT-CMS</title>
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
$vendor = '';
$html='';
$htmlsum='';
if(isset($_POST['export'])){
$vendor = $_POST['vendor'];
//COUNT SUM
$getsum=("SELECT SUM(cost) AS sum FROM `expense` WHERE vendor='$vendor'");
$resultsum = mysqli_query($db, $getsum);
if(mysqli_num_rows($resultsum) > 0)
while($row= mysqli_fetch_assoc($resultsum))
{
  $final_sum = $row['sum'];
}
// TOTAL EXPENSE SUM
$get=("SELECT * FROM `expense` WHERE vendor='$vendor' LIMIT 1");
if($result = mysqli_query($db, $get))
if(mysqli_num_rows($result) > 0)
while($row = mysqli_fetch_assoc($result))
{ 
$htmlsum.='<table border="1">
<tr>  
    <th>Vendor Name:</th>
    <th>' . $row['vendor'] . '</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th>Total Payment:</th>
    <th>' . number_format($final_sum, 2, '.', ',') . '</th>
</tr>';
}
$htmlsum.='</table>';
// ALL EXPENSES
$getdata=("SELECT * FROM `expense` WHERE vendor ='$vendor' ORDER BY service_date DESC,id DESC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
{
  $i=1;
$html.='<table border="1">
  <tr>
     <th>#</th>
    <th>Expense Details</th>
    <th>User</th>
    <th>Service Date</th>    
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
              <td>' . $row['bill_no'] . '</td>
              <td>' . $row['cheque_no'] . '</td>
              <td>' . $row['bill_clear_date'] . '</td>
              <td style="text-align: right;font-weight:bold;">' . number_format($row['cost'], 2, '.', ',') . '</td></tr>';
} 
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename='.$vendor.'_it expense_'.$date.'.xls');
echo $htmlsum;
echo $html;
exit;
}
else {
echo "<script>swal.fire ({
  type: 'error',
  title: 'Error',
  text: 'No Service Found!',
  icon: 'error',
}).then(function(){window.location = 'index.php'})
</script>";
}
}
?>
</body>
</html>