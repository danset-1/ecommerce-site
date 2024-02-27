<?php
session_start(); 
$servername = "utbweb.its.ltu.se:3306";

$conn = new mysqli($servername, $username, $password, $dbName);
$userID = $_SESSION['username'];

$review = $_POST["review"];

$reviewID = "SELECT ReviewID FROM Reviews";
$result = $conn->query($reviewID);
$highestID = 0;

if ($result->num_rows > 0) {
  // output data of each row
  while($id = $result->fetch_assoc()) {
    $highestID = "$id[ReviewID]"+1;
  }
}
if(isset($_POST['item'])) 
    { 
        // Getting the value of button 
        // in $plus variable 
        $val = 0; 
        
    } 

    $sql = "INSERT INTO Reviews (ReviewID, UserID, Review, Score, ProductID) VALUES ('$highestID','$userID','$review','1','$val')";
    $conn->query($sql);
    
    $conn->close();
?>