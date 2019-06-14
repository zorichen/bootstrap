<?php 

error_reporting( E_ALL & ~E_NOTICE );

// 接管session
include("session.php");
session_start();

if (isset($_SESSION['username'])) {
    
} else {
    echo "<script> window.location.href='login.php'; </script>";
    die ;
}

?>