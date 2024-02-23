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
if ($result->num_rows > 0) {
  // output data of each row
  while($id = $result->fetch_assoc()) {
    $highestID = "$id[CartID]"+1;
  }
}
if(isset($_POST['computer'])) 
    { 

        $sql = "INSERT INTO Cart (CartID, ProductIDs, CurrentPrice, Quantity, UserID) VALUES ($highestID,'0','1','1',$userID)";

        if ($conn->query($sql) === TRUE) {
         
          } else {
                
            $query = "UPDATE Cart SET Quantity = Quantity+1 WHERE (`ProductIDs` = '0' and 'UserID' = $userID)";

            $result = $conn->query($query); 
          }
          
          $conn->close();
    } 
    if(isset($_POST['nokia'])) 
    { 

        $sql = "INSERT INTO Cart (CartID, ProductIDs, CurrentPrice, Quantity, UserID) VALUES ($highestID,'1','1','1',$userID)";

        if ($conn->query($sql) === TRUE) {
            
          } else {
            $query = "UPDATE Cart SET Quantity = Quantity+1 WHERE (`ProductIDs` = '1' and 'UserID' = $userID)";

            $result = $conn->query($query);
          }
          
          $conn->close();
        
    } 
    if(isset($_POST['screen'])) 
    { 

        $sql = "INSERT INTO Cart (CartID, ProductIDs, CurrentPrice, Quantity, UserID) VALUES ($highestID,'2','1','1',$userID)";

        if ($conn->query($sql) === TRUE) {
      
          } else {
            $query = "UPDATE Cart SET Quantity = Quantity+1 WHERE (`ProductIDs` = '2' and 'UserID' = $userID)";

            $result = $conn->query($query);
          }
          
          $conn->close();
        
    } 

header("Location: checkout.php");//redirect 
    exit;
?>