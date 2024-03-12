<?php
session_start(); 
$servername = "utbweb.its.ltu.se:3306";

$conn = new mysqli($servername, $username, $password, $dbName);
$userID = $_SESSION['username'];

$review = $_POST["review"];
$title = $_POST["title"];
$grade = $_POST["grade"];

$reviewID = "SELECT ReviewID FROM Reviews";
$result = $conn->query($reviewID);
$highestID = 0;

if ($result->num_rows > 0) {
  // output data of each row
  while($id = $result->fetch_assoc()) {
    $highestID = "$id[ReviewID]"+1;
  }
}
if(isset($_POST['item'])) { 
        // Getting the value of button 
        // in $plus variable 
        $val = 0; 
    } 
    if(isset($_POST['item1'])) { 
      // Getting the value of button 
      // in $plus variable 
      $val = 1; 
  } 
    if(isset($_POST['item2'])) { 
    // Getting the value of button 
    // in $plus variable 
    $val = 2; 
  } 
  if (!empty($title) and !empty($review)) {
    if($grade > 0 and $grade < 6){
    $sql = "INSERT INTO Reviews (ReviewID, UserID, Review, Score, ProductID, Title) VALUES ('$highestID','$userID','$review','$grade','$val','$title')";
    $conn->query($sql);
    }
  }
    $conn->close();
    if($val == 0){
      header("Location: item.php");
    }
    if($val == 1){
      header("Location: item2.php");
    }if($val == 2){
      header("Location: item3.php");
    }
?>