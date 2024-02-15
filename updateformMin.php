<?php 


$servername = "utbweb.its.ltu.se:3306";
$username = "";
$password = "";
$dbName = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbName);
    
    if(isset($_POST['minus'])) 
    { 
        // Getting the value of button 
        // in $minus variable 
        $val = $_POST['minus']; 
        
    } 

    $query = "UPDATE Cart SET Quantity = Quantity-1 WHERE (`ProductIDs` = $val)";

    $result = $conn->query($query); 

    $sql2 = "SELECT Quantity FROM Cart Where (`ProductIDs` = $val)";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    $x = "$row2[Quantity]";
    $y = 0;
    if($x == $y){
      $sql3 = "DELETE FROM `Cart` Where (`ProductIDs` = $val)";
      if ($conn->query($sql3) === TRUE) {
        header("Location: checkout.php");//redirect
        exit;
      } else {
        echo "Error deleting record: " . $conn->error;
      }
    }
    header("Location: checkout.php");//redirect
    exit;
    
?>