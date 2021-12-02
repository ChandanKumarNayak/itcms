<?php
require 'db.php';
$defaultDR="UPDATE daily_routine SET status='0'";
$resultDefaultDR = mysqli_query($db,$defaultDR);
?>