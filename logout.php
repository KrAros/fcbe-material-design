<?php
session_start();
header("Cache-control: private");
if (isset($_COOKIE[session_name()])) setcookie(session_name(), '', time() - 90000);
$_SESSION=array();
session_destroy();
if (isset($logout)) header("location: ./index.php?logout=$logout");
else header("location: ./index.php?logout=1");
?>