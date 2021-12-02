<?php 
session_start();
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    die();
  }
 ?>
<?php
require('db.php');
$date = "";
// generate date
date_default_timezone_set('Asia/Kolkata');
$date = date('Y-m-d');
$html='';
$status = ''; 
$status_all = ''; 
if(isset($_GET['status']) && $_GET['status'] !='' )
{
$status=mysqli_real_escape_string($db, $_GET['status']);
$getdata=("SELECT * FROM `task` WHERE status='$status' ORDER BY reg_date DESC,id DESC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
$i=1;
$html.='<table border="1">
  <tr>
    <th>#</th>
    <th>Task</th>
    <th>Registered On</th>
    <th>User</th>
    <th>Status</th>
  </tr>';
while($row = mysqli_fetch_assoc($result))
{ 
  $html.='<tr><td>' . $i++ . '</td>
              <td>' . htmlspecialchars($row['task'], ENT_QUOTES) . '</td>
              <td>' . htmlspecialchars($row['reg_date'], ENT_QUOTES) . '</td>
			        <td>' . htmlspecialchars($row['user'], ENT_QUOTES) . '</td>
              <td>' . htmlspecialchars($row['status'], ENT_QUOTES) . '</td>
              </tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=task_'.$status.'_'.$date.'.xls');
echo $html;
exit;
}
 elseif(isset($_GET['status_all']) && $_GET['status_all']>0 )
{
$status_all=mysqli_real_escape_string($db, $_GET['status_all']);
  $getdata=("SELECT * FROM `task` WHERE status_all='$status_all' ORDER BY reg_date DESC,id DESC");
if($result = mysqli_query($db, $getdata))
if(mysqli_num_rows($result) > 0)
$i=1;
$html.='<table border="1">
  <tr>
    <th>#</th>
    <th>Task</th>
    <th>Registered On</th>
    <th>User</th>
    <th>Status</th>
  </tr>';
while($row = mysqli_fetch_assoc($result))
{ 
  $html.='<tr><td>' . $i++ . '</td>
              <td>' . htmlspecialchars($row['task'], ENT_QUOTES) . '</td>
              <td>' . htmlspecialchars($row['reg_date'], ENT_QUOTES) . '</td>
              <td>' . htmlspecialchars($row['user'], ENT_QUOTES) . '</td>
              <td>' . htmlspecialchars($row['status'], ENT_QUOTES) . '</td>
              </tr>';
}
$html.='</table>';
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=all_tasks_'.$date.'.xls');
echo $html;
exit;
}
?>