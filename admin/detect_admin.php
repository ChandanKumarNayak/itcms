<?php
if (!isset($_SESSION['email'])) {
    header('location: index.php');
    die();
}
require 'db.php';
require $_SERVER['DOCUMENT_ROOT'].'/detectUser/detectMe.php';

$sql_check = "SELECT id FROM `admin_detect` WHERE browser_details='$browser_details' AND ip_address='$ip_address' ";
$results_check = mysqli_query($db, $sql_check);
if (mysqli_num_rows($results_check) == 0) {
    session_destroy();
    header('location:index.php');
    die();
} else {
    $sqlTime = "SELECT * FROM `admin_detect` WHERE unique_identifier='" . $_SESSION['UI'] . "'";
    $resultTime = mysqli_query($db, $sqlTime);
    if (mysqli_num_rows($resultTime) == 1) {
        while ($row = mysqli_fetch_assoc($resultTime)) {
            $lastCheck = $row['check_time'];
        }
    }

    $timeNow = time();
    if ($timeNow >= ($lastCheck + 3600)) {
        $sql_time = mysqli_query($db, "DELETE FROM `admin_detect` WHERE unique_identifier='" . $_SESSION['UI'] . "' ");
        session_destroy();
        header("location: index.php");
        die();
    } else {
        $sqlUpdateTime = mysqli_query($db, "UPDATE `admin_detect` SET check_time='$timeNow' WHERE unique_identifier='" . $_SESSION['UI'] . "'");
    }
}
?>