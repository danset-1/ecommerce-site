<?php
$servername = "utbweb.its.ltu.se:3306";
$username = "";
$password = "";
$dbName = "";
session_start(); 
$conn = new mysqli($servername, $username, $password, $dbName);
$usernam = $_POST["username"];
$name = $_POST["name"];
$passwd = $_POST["password"];
$adress = $_POST["adress"];
$city = $_POST["city"];
$postalcode = $_POST["postalcode"];
$country = $_POST["country"];

$sql = "INSERT INTO Users (UserID, UserType, FullName, Password, Adress, City, PostalCode, Country, Orders) VALUES ('$usernam','user','$name','$passwd' ,'$adress','$city','$postalcode','$country','test')";
if($conn->query($sql)== true){
    echo "success";
}else{
    echo "fuuuuuck";
}
$conn->close();

// header("Location: login.php");
?>