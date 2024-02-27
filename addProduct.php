<?php 
session_start(); 
$servername = "utbweb.its.ltu.se:3306";
$username = "";
$password = "";
$dbName = "";

$userID = $_SESSION['username'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);
$cartid = "SELECT CartID FROM Cart";
$result = $conn->query($cartid);
$highestID = 0;
// $row = $result->fetch_assoc();
// $highestID = "$row[max_id]" + 1;

if ($result->num_rows > 0) {
  // output data of each row
  while($id = $result->fetch_assoc()) {
    $highestID = "$id[CartID]"+1;
  }
}
if(isset($_POST['computer'])) { 
    // Check if there's already a row with ProductIDs = '0' and UserID = '$userID'
    $query = "SELECT * FROM Cart WHERE ProductIDs = '0' AND UserID = '$userID'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // If a row exists, update the quantity
        $sql = "UPDATE Cart SET Quantity = Quantity+1 WHERE ProductIDs = '0' AND UserID = '$userID'";
        $conn->query($sql);
    } else {
        // If no such row exists, insert a new row
        $sql = "INSERT INTO Cart (CartID, ProductIDs, CurrentPrice, Quantity, UserID) VALUES ('$highestID','0','1','1','$userID')";
        $conn->query($sql);
    }
      
      $conn->close();
} 
if(isset($_POST['nokia'])) { 

  $query = "SELECT * FROM Cart WHERE ProductIDs = '1' AND UserID = '$userID'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
      // If a row exists, update the quantity
      $sql = "UPDATE Cart SET Quantity = Quantity+1 WHERE ProductIDs = '1' AND UserID = '$userID'";
      $conn->query($sql);
  } else {
      // If no such row exists, insert a new row
      $sql = "INSERT INTO Cart (CartID, ProductIDs, CurrentPrice, Quantity, UserID) VALUES ('$highestID','1','1','1','$userID')";
      $conn->query($sql);
  }
      
      $conn->close();
    
} 
if(isset($_POST['screen'])) { 

  $query = "SELECT * FROM Cart WHERE ProductIDs = '2' AND UserID = '$userID'";
  $result = $conn->query($query);

  if ($result->num_rows > 0) {
      // If a row exists, update the quantity
      $sql = "UPDATE Cart SET Quantity = Quantity+1 WHERE ProductIDs = '2' AND UserID = '$userID'";
      $conn->query($sql);
  } else {
      // If no such row exists, insert a new row
      $sql = "INSERT INTO Cart (CartID, ProductIDs, CurrentPrice, Quantity, UserID) VALUES ('$highestID','2','1','1','$userID')";
      $conn->query($sql);
  }
      
      $conn->close();
    
} 

header("Location: checkout.php");//redirect 
    exit;
?>