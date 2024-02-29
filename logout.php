<?php
session_start(); 
session_destroy();

session_start(); 
$_SESSION['loggedin'] = false;
header("Location: login.php");
?>