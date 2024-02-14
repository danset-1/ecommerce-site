<?php 



    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbName);

    $query = "UPDATE Cart SET Quantity = Quantity-1 WHERE (`ProductIDs` = '1')";

    $result = $conn->query($query); 

      header("Location: checkout.php");//redirect to your html with status
    exit;
?>