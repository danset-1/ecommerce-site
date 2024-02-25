<?php 
session_start(); 

$servername = "utbweb.its.ltu.se:3306";
$username = "";
$password = "";
$dbName = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbName);

    if(isset($_POST['plus'])) 
    { 
        // Getting the value of button 
        // in $plus variable 
        $val = $_POST['plus']; 
        
    } 

    $query = "UPDATE Cart SET Quantity = Quantity+1 WHERE (ProductIDs = '$val' AND UserID = '$userID')";

    $result = $conn->query($query); 

      header("Location: checkout.php");//redirect
    exit;
?>