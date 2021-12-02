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
    <title>Custom Export: IT Asset Repair Service | IT-CMS</title>
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
if(isset($_POST['export'])){
$vendor = $_POST['vendor'];
$getdata=("SELECT * FROM `assetrepair` WHERE vendor ='$vendor' ORDER BY service_date DESC,id DESC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
{
  $i=1;
$html.='<table border="1">
  <tr>
    <th>#</th>
    <th>Asset Type</th>
    <th>Serial No</th>
    <th>User</th>
    <th>Service Details</th>
    <th>Service Date</th>
    <th>Vendor Name</th>
    <th>Bill No</th>
    <th>Cheque No</th>
    <th>Bill Clear Date</th>
    <th>Total Cost</th>
  </tr>';
while($row = mysqli_fetch_assoc($result))
{ 
  $html.='<tr><td>' . $i++ . '</td>
              <td>' . $row['system_type'] . '</td>
              <td>' . $row['serial_no'] . '</td>
              <td>' . $row['user'] . '</td>
              <td>' . $row['repair_details'] . '</td>
			        <td>' . $row['service_date'] . '</td>
              <td>' . $row['vendor'] . '</td>
              <td>' . $row['bill_no'] . '</td>
              <td>' . $row['cheque_no'] . '</td>
              <td>' . $row['bill_clear_date'] . '</td>
              <td>' . number_format($row['total_cost'], 2, '.', ',') . '</td></tr>';
} 
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename='.$vendor.'_it asset repair service_'.$date.'.xls');
echo $html;
exit;
}
else {
echo "<script>swal.fire ({
  type: 'error',
  title: 'Error',
  text: 'No service found!',
  icon: 'error',
}).then(function(){window.location = 'index.php'})
</script>";
}
}
?>
</body>
</html>