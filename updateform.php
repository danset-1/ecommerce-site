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

    $sql = "SELECT ProductIDs, Quantity FROM Cart where (UserID = '$userID')";
    $result = $conn->query($sql);
    $stockGood = true;

    if ($result->num_rows > 0) {
      // output data of each row
      while($row = $result->fetch_assoc()) {
        $q = "$row[Quantity]";
        $p = "$row[ProductIDs]";

        $sql5 = "SELECT Stock FROM Products where (ProductID = '$p')";
        $result2 = $conn->query($sql5);
        if ($result2->num_rows > 0) {
          // output data of each row
          while($row3 = $result2->fetch_assoc()) {
            $stock = "$row3[Stock]";
            if($stock <= $q){
              $stockGood = false;
            }
          }
        }
      }
    }
    if($stockGood == true){
    $query = "UPDATE Cart SET Quantity = Quantity+1 WHERE (ProductIDs = '$val' AND UserID = '$userID')";

    $result = $conn->query($query); 
    }
    header("Location: checkout.php");//redirect
    exit;
?>