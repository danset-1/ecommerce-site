<?php 

$servername = "utbweb.its.ltu.se:3306";
$username = "";
$password = "";
$dbName = "";

$conn = new mysqli($servername, $username, $password, $dbName);

$sql1 = "DELETE FROM `Cart` Where (`ProductIDs` = '0')";
$conn->query($sql1);
$sql2 = "DELETE FROM `Cart` Where (`ProductIDs` = '1')";
$conn->query($sql2);
$sql3 = "DELETE FROM `Cart` Where (`ProductIDs` = '2')";
$conn->query($sql3);

header("Location: purchase.html");//redirect
    exit;
?>