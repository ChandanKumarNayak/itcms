<?php
ob_start();
if (!isset($_SESSION['email'])) {
    header('location: ../index.php');
    die();
}
?>
<!-- UPDATE NETMAP DETAILS -->
<?php
require '../db.php';
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $location = $_POST['location'];
    $user = $_POST['user'];
    $sqluser = "SELECT user FROM `network_map` WHERE user='$user' AND user!= 'N/A' AND id != '$id'";
    $qresult = mysqli_query($db, $sqluser);
    $count = mysqli_num_rows($qresult);
    if ($count > 0) {
        echo "<script>swal.fire ({
  type: 'error',
  title: 'Error',
  text: 'Update Failed Due To Duplicate User Entry!',
  icon: 'error',
})
</script>";
    } else {
        $switch_port_no = $_POST['switch_port_no'];
        $sqluser = "SELECT switch_port_no FROM `network_map` WHERE switch_port_no='$switch_port_no' AND location = '$location' AND id != '$id'";
        $qresult = mysqli_query($db, $sqluser);
        $count = mysqli_num_rows($qresult);
        if ($count > 0) {
            echo "<script>swal.fire ({
  type: 'error',
  title: 'Error',
  text: 'Update Failed Due To Duplicate Port Number Entry!',
  icon: 'error',
})
</script>";
        } else {
            $sql = "UPDATE `network_map` SET user='$user' ,switch_port_no='$switch_port_no' WHERE id='$id'";
            if ($db->query($sql) === true) {
                header("Location:index.php?s=1");
                die();
            } else {
                echo "<script>swal.fire ({
  type: 'error',
  title: 'Error',
  text: 'Something Went Wrong!',
  icon: 'error',
}).then(function(){window.location = 'index.php'})
</script>";
            }
        }
    }
}
?>
<html lang="en-IN">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="IT-CMS: Thinking Ahead.">
    <meta name="keywords" content="IT, CMS">
    <meta name="author" content="Chandan Kumar Nayak">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- SWEET ALERT JS -->
    <script src="../../js/jquery-3.5.1.min.js"></script>
    <script src="../../js/sweetalert2.all.min.js"></script>
</head>

<body>
    <div class="modal fade" id="update_modal<?php echo $row['id']; ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                    enctype="multipart/form-data">
                    <div class="modal-header">
                        <h3 class="modal-title">Network Mapping</h3>
                    </div>
                    <?php $nm_id = $row['id'];?>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
                            <input type="hidden" name="location" value="<?php echo $row['location']; ?>" />
                            <label>User<span style="color:red;">*</span></label>
                            <select name="user" class="form-control" required>
                                <option value="<?php echo $row['user']; ?>" selected><?php echo $row['user']; ?>
                                </option>
                                <?php
$getuser = ("SELECT * FROM `user` ORDER BY user ASC");
if ($result_user = mysqli_query($db, $getuser)) {
    if (mysqli_num_rows($result_user) > 0) {
        while ($row = mysqli_fetch_assoc($result_user)) {?>
                                <option value="<?php echo $row['user']; ?>"><?php echo $row['user']; ?></option>
                                <?php
}
    }
}

?>
                            </select>
                        </div>
                        <?php
$get_nm = ("SELECT * FROM `network_map` WHERE id = '$nm_id'");
if ($get_nm_res = mysqli_query($db, $get_nm)) {
    if (mysqli_num_rows($get_nm_res) > 0) {
        while ($row = mysqli_fetch_assoc($get_nm_res)) {?>
                        <div class="form-group">
                            <label>Port No (IO Box)<span style="color:red;">*</span></label>
                            <input type="number" name="iobox_port_no" value="<?php echo $row['iobox_port_no']; ?>"
                                placeholder="IO box port no" class="form-control" readonly />
                        </div>
                        <div class="form-group">
                            <label>Port No (Switch)<span style="color:red;">*</span></label>
                            <input type="number" name="switch_port_no" value="<?php echo $row['switch_port_no']; ?>"
                                placeholder="Switch port no" class="form-control" required />
                        </div>
                        <?php }
    }
}

?>
                    </div>
                    <div style="clear:both;"></div>
                    <div class="modal-footer">
                        <button type="submit" name="edit" class="btn btn-success">update</button>
                        <button class="btn btn-danger" type="button" data-dismiss="modal">close</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>