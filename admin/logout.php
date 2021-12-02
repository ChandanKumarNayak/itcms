<?php

    session_start();

    require "db.php";

    if(isset($_SESSION['email']) && isset($_SESSION['UI'])){

    $sql = "DELETE FROM `admin_detect` WHERE unique_identifier='".$_SESSION['UI']."' ";

    if($result= mysqli_query($db,$sql))

  	unset($_SESSION['role']);

    unset($_SESSION['email']);

    session_destroy();

    header("location: ../index.php");

    die();

    }

    else {

    session_destroy();

    header("location: ../index.php");

    die();

    }

?>