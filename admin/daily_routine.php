<?php 
ob_start();
session_start();
if (!isset($_SESSION['email'])) {
  	header('location: index.php');
    die();
  }
  require "detect_admin.php";
 ?>
<html lang="en-IN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="IT-CMS: Thinking Ahead.">
<meta name="keywords" content="IT, CMS">
<meta name="author" content="Chandan Kumar Nayak">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin: Daily Checklist | IT-CMS</title>
    <link rel="icon" type="image/png" href="../img/IT.png"/> <!-- page icon -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<!-- PRELOADER -->
<link href="../css/preloader.css" rel="stylesheet">
   <script>
    window.onload=function(){
      document.getElementById('loader').style.display="none";
      document.getElementById('content').style.display="block";
    };
    </script>
<script>
	$(document).ready(function(){
		$("#myDailyRoutine").modal('show');
	});
</script>
</head>
<body>
    <!-- PRELOADER -->
<div id="loader">
      <img src="../img/preloader.gif"/>
</div>
    <div id="content">
<!-- PRELOADER -->  
            <?php 
            require 'db.php';
            $getDR="SELECT * FROM daily_routine WHERE status='0'";
                          if($resultDR = mysqli_query($db, $getDR))
                          if(mysqli_num_rows($resultDR) > 0){?>

            <div class="modal fade" id="myDailyRoutine" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Daily Checklist</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form>
                <?php 
                $getDR=("SELECT * FROM daily_routine ORDER BY task ASC");
                if($resultDR = mysqli_query($db, $getDR))
                if(mysqli_num_rows($resultDR) > 0) 
                while($row = mysqli_fetch_assoc($resultDR)) 
                {?>    
                <?php 
                $status=$row['status']; 
                if ($status == 1) {
                    $check = 'checked';
                } else {
                    $check = '';
                }
                ?>
                <div class="form-group form-check"> 
                <a href="javascript:void(0)" onclick="task('<?php echo $row['id'] ?>')"><input type="checkbox" class="form-check-input" id="task<?php echo $row['id'] ?>" <?php echo $check ?> > </a>
                <label class="form-check-label" for="task<?php echo $row['id'] ?>"><?php echo $row['task'] ?></label>
                </div>
                <hr>
                <?php } ?>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } else {
    header("Location:admin.php");
    die();
}?>
</div>

<!-- Check Admin Status -->
 <script src="auto_check_status.js"></script>

<!-- update in db -->
 <script>
     function task(id){
     jQuery.ajax({
         url: 'daily_routine_update.php',
         type: 'post',
         data: 'id='+id,
         success: function(result){
    
         }
     });
     }
 </script>   
 
</body>
</html>