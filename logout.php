<?php 

error_reporting( E_ALL & ~E_NOTICE );

// 接管session
include("session.php");
session_start();

$_SESSION["username"] = null;

echo "<script>window.location.href='index.php';</script>";

?>