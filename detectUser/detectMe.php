<?php
include('BrowserDetection.php');
$browser_details ="";
$ip_address ="";
$browser=new Wolfcast\BrowserDetection;

$browser_details=$browser->getUserAgent(); //get user browser details

//USER IP ADDRESS
//whether ip is from share internet
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
  {
    $ip_address = htmlspecialchars($_SERVER['HTTP_CLIENT_IP'], ENT_QUOTES);
  }
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
  {
    $ip_address = htmlspecialchars($_SERVER['HTTP_X_FORWARDED_FOR'], ENT_QUOTES);
  }
//whether ip is from remote address
else
  {
    $ip_address = htmlspecialchars($_SERVER['REMOTE_ADDR'], ENT_QUOTES);
  }


?>