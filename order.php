<?php 
session_start(); 
$servername = "utbweb.its.ltu.se:3306";
$username = "";
$password = "";
$dbName = "";

$conn = new mysqli($servername, $username, $password, $dbName);
$userID = $_SESSION['username'];

$totalcost = $_POST['cost']; 

$orderItemID = "SELECT OrderItemID FROM OrderItems";
$result = $conn->query($orderItemID);
$highestID = 0;

if ($result->num_rows > 0) {
  // output data of each row
  while($id = $result->fetch_assoc()) {
    $highestID = "$id[OrderItemID]"+1;
  }
}

$orderItemID = "SELECT OrderID FROM Orders";
$result2 = $conn->query($orderItemID);
$orderID = 0;
if ($result2->num_rows > 0) {
    // output data of each row
    while($id = $result2->fetch_assoc()) {
      $orderID = "$id[OrderID]"+1;
    }
  }

$sql = "SELECT CartID, ProductIDs, Quantity FROM Cart where (UserID = '$userID')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    $q = "$row[Quantity]";
    $p = "$row[ProductIDs]";
    $sql = "INSERT INTO OrderItems (OrderItemID, OrderID, ProductID, Quantity) VALUES ('$highestID','$orderID','$p','$q')";
    $conn->query($sql);
    $highestID += 1;
}
}

$sql2 = "INSERT INTO Orders (OrderID, Cost, UserID) VALUES ('$orderID','$totalcost','$userID')";
$conn->query($sql2);

$sql1 = "DELETE FROM Cart Where (UserID = '$userID')";
$conn->query($sql1);

header("Location: purchase.html");//redirect
    exit;
?>