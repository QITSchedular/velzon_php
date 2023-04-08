<?php
 $fp = @fsockopen("www.google.com", 80, $errno, $errstr, 30);
 if (!$fp) {
     include("../Apps/404.php");
     exit();
 }
?>