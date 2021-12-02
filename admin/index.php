<?php
ob_start();
session_start();
if (isset($_SESSION['email'])) {
    header('location: daily_routine.php');
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
    <title>Admin: Sign In | IT-CMS</title>
    <link rel="stylesheet" href="../css/login-style.css"> <!-- login style -->
    <link rel="stylesheet" href="../css/bootstrap.min.css"> <!-- login style -->
    <link rel="icon" type="image/png" href="../img/IT.png" /> <!-- page icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- ICONS -->
    <!-- PRELOADER -->
    <link href="../css/preloader.css" rel="stylesheet">
    <script>
    window.onload = function() {
        document.getElementById('loader').style.display = "none";
        document.getElementById('content').style.display = "block";
    };
    </script>
    <!-- SWEET ALERT JS -->
    <script src="../js/jquery-3.5.1.min.js"></script>
    <script src="../js/sweetalert2.all.min.js"></script>
</head>

<body>
    <!-- PRELOADER -->
    <div id="loader">
        <img src="../img/preloader.gif" />
    </div>
    <div id="content">
        <!-- PRELOADER -->
        <form method='POST' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            enctype="multipart/form-data">
            <div class="container-fluid px-1 px-md-5 px-lg-1 px-xl-5 py-5 mx-auto">
                <div class="card card0 border-0">
                    <div class="row d-flex">
                        <div class="col-lg-6">
                            <div class="card1 pb-1">
                                <div class="row"> <img src="../img/IT.png" class="image"> </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card2 card border-0 px-4 py-5">
                                <div class="row px-3"> <label class="mb-1">
                                        <h6 class="mb-0 text-sm">Email</h6>
                                    </label> <input class="mb-4" type="email"
                                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" name="email"
                                        placeholder="Enter email id" required> </div>
                                <div class="row px-3"> <label class="mb-1">
                                        <h6 class="mb-0 text-sm">Password</h6>
                                    </label> <input type="password" name="password" placeholder="Enter password"
                                        required> </div>
                                <div class="row px-3 mb-4">
                                    <!-- <a href="#" class="ml-auto mb-0 text-sm">Forgot Password?</a> -->
                                </div>
                                <div class="row mb-3 px-3"> <button type="submit" name="signin">Sign In&nbsp;<i
                                            class="fa fa-sign-in"></i></button> </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-blue py-4">
                        <div class="row px-3"> <small class="ml-4 ml-sm-5 mb-2">© 2021-<?php echo date("Y"); ?> | IT
                                Dept. Odisha</small>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- RESUBMIT FORM PREVENT -->
        <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
        </script>
    </div>
</body>

</html>
<!-- BACKEND -->
<?php
require 'db.php';
require '../detectUser/detectMe.php';
$email = "";
$password = "";
//LOGIN USER
if (isset($_POST['signin'])) {
    $email_pre = mysqli_real_escape_string($db, $_POST['email']);
    $email = filter_var($email_pre, FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_HIGH);
    $password_pre = mysqli_real_escape_string($db, $_POST['password']);
    $password = filter_var($password_pre, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    if (empty($email) || empty($password)) {
        echo "<script>swal.fire ({
      type: 'error',
      title: 'Error',
      text: 'Please Fill All The Required Fields!',
      icon: 'error',
    })
    </script>";
    } else {
        $query = "SELECT * FROM admin WHERE email ='$email' AND binary password = '$password' AND status = 'Active'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
            $unique_identifier = base64_encode(openssl_random_pseudo_bytes(32));
            $timeNow = time();
            $detectUser = mysqli_query($db, "INSERT INTO `admin_detect` (email,unique_identifier,browser_details,ip_address,check_time) VALUES ('$email','$unique_identifier','$browser_details','$ip_address','$timeNow')");
            while ($row = mysqli_fetch_assoc($results)) {
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['UI'] = $unique_identifier;
            }
            header("Location:daily_routine.php");
            die();
        } else {
            echo "<script>swal.fire ({
  type: 'error',
  title: 'Error',
  text: 'Authentication Failed!',
  icon: 'error',
})
</script>";
        }
    }
}
?>