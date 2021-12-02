
 setInterval (function(){
   checkAdminStatus();
 },5000);
 function checkAdminStatus(){
   
   jQuery.ajax({
   url:'auto_check_status.php',
   success:function(result){
    var result=result.trim();
    if(result=='Deactive'){
       window.location.href='../logout.php';

     }
   }

 });
 }