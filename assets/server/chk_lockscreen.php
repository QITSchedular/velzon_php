<?php
// session_start();
    if($_SESSION['lock_screen'] == "true"){
        include("../Apps/lockscreen.php");
        exit();
    }
?>