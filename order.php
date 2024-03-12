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
    if("$id[OrderItemID]"> $highestID){
    $highestID = "$id[OrderItemID]";
    }
  }
}
$highestID+=1;

$orderItemID = "SELECT OrderID FROM Orders";
$result2 = $conn->query($orderItemID);
$orderID = 0;
if ($result2->num_rows > 0) {
    // output data of each row
    while($j = $result2->fetch_assoc()) {
      if("$j[OrderID]"> $orderID){
      $orderID = "$j[OrderID]";
      }
    }
  }
$orderID += 1;

$sql = "SELECT CartID, ProductIDs, Quantity, CurrentPrice FROM Cart where (UserID = '$userID')";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    $q = "$row[Quantity]";
    $p = "$row[ProductIDs]";
    $currP = "$row[CurrentPrice]";
    $sql2 = "SELECT Stock FROM Products where (ProductID = 'ProductIDs')";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
// output data of each row
while($row2 = $result2->fetch_assoc()) {
  $s = "$row2[Stock]";
  if($q > $s){
    header("Location: index.html");//redirect
    exit;
  }

}}
    $sql = "INSERT INTO OrderItems (OrderItemID, OrderID, ProductID, Quantity, Price) VALUES ('$highestID','$orderID','$p','$q','$currP')";
    $conn->query($sql);
    $query = "UPDATE Products SET Stock = Stock - $q WHERE ProductID = '$p'";
    $conn->query($query); 
    $highestID += 1;
}
}
$date = date("d/m-y");
$sql2 = "INSERT INTO Orders (OrderID, Cost, UserID, Date) VALUES ('$orderID','$totalcost','$userID', '$date')";
$conn->query($sql2);

$sql1 = "DELETE FROM Cart Where (UserID = '$userID')";
$conn->query($sql1);

header("Location: purchase.html");//redirect
    exit;
?>