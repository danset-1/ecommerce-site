<?php 

$servername = "utbweb.its.ltu.se:3306";
$username = "";
$password = "";
$dbName = "";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);
if(isset($_POST['computer'])) 
    { 

        $sql = "INSERT INTO Cart (CartID, ProductIDs, CurrentPrice, Quantity) VALUES ('0','0','1','1')";

        if ($conn->query($sql) === TRUE) {
         
          } else {
                
            $query = "UPDATE Cart SET Quantity = Quantity+1 WHERE (`ProductIDs` = '0')";

            $result = $conn->query($query); 
          }
          
          $conn->close();
    } 
    if(isset($_POST['nokia'])) 
    { 

        $sql = "INSERT INTO Cart (CartID, ProductIDs, CurrentPrice, Quantity) VALUES ('0','1','1','1')";

        if ($conn->query($sql) === TRUE) {
            
          } else {
            $query = "UPDATE Cart SET Quantity = Quantity+1 WHERE (`ProductIDs` = '1')";

            $result = $conn->query($query);
          }
          
          $conn->close();
        
    } 
    if(isset($_POST['screen'])) 
    { 

        $sql = "INSERT INTO Cart (CartID, ProductIDs, CurrentPrice, Quantity) VALUES ('0','2','1','1')";

        if ($conn->query($sql) === TRUE) {
      
          } else {
            $query = "UPDATE Cart SET Quantity = Quantity+1 WHERE (`ProductIDs` = '2')";

            $result = $conn->query($query);
          }
          
          $conn->close();
        
    } 

header("Location: checkout.php");//redirect 
    exit;
?>