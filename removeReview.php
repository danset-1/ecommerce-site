<?php
$servername = "utbweb.its.ltu.se:3306";

session_start(); 
$conn = new mysqli($servername, $username, $password, $dbName);

$num = $_POST['delRev'];

$sql1 = "DELETE FROM Reviews Where ReviewID = '$num'";
$conn->query($sql1);

header("Location: item.php");
?>