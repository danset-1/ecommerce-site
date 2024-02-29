<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electramix</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="script/app.js"></script>
</head>
<body>
    
    <div class="nav">
        <div class="flex">
            <div id="menuBtn"><a id="open"onclick="openNav()">&equiv;</a></div>
            <div id="title"><a href="index.html"><h1>Electramix</h1></a></div>
            <div id="searchBar"><input id="t" type="text" placeholder="Search.."></div>
            <a href="login.php"><img src="pic/usr.png" width="50px" height="50px" alt=""></a>
            <a href="checkout.php"><img src="pic/cart.svg" id="cartIcon" width="50px" height="50px" alt=""></a>
        </div>

    <div id="menu" class="menu">
        <a class="close" onclick="closeNav()">&times;</a>
        <a href="#">Phones</a>
        <a href="#">Computers</a>
        <a href="#">Tv & Sound</a>
    </div>  
    </div>
    <div class="wrapper3">

    <?php
    // header("Location: purchase.html");//redirect to your html with status
    // exit;
    session_start(); 
    $servername = "utbweb.its.ltu.se:3306";
    $username = "";
    $password = "";
    $dbName = "";

    
    if(!(isset($_SESSION['username']))){
    ?>
    <h2>Not Logged In</h2>
    <h3>In order to use checkout you need to be logged in!</h3>
    <a href="login.php"><button class="button">Go to Login</button></a>
    <?php
    }else{
        $userID = $_SESSION['username'];
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbName);

    $sql = "SELECT CartID, ProductIDs, Quantity FROM Cart where (UserID = '$userID')";

    $result = $conn->query($sql);
    $totalsum = 0;
    

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $sql2 = "SELECT ProductName, Price, Images FROM Products Where ($row[ProductIDs] = ProductID)";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();
        $a = "$row2[Price]";
        $b = "$row[Quantity]";
        $totalsum = $totalsum + ($a*$b);
        ?>
        <div class="checkoutWrap">
            <div class="c">
            <div><img src="<?= $row2['Images']; ?>" height="150px" width="150px" alt=""></div>
            <div><h2><?= $row2['ProductName']; ?></h2></div>
            <div><h2><?= $row2['Price']; ?>:-</h2></div>
            </div>
            <div class="qBtn">
            <form method="post" action="updateformMin.php" ><button type="submit" name="minus" value="<?= $row['ProductIDs']; ?>">-</button></form>
                <div class="quantity"><h2>Quantity: <?= $row['Quantity']; ?></h2></div>
            <form method="post" action="updateform.php" ><button type="submit" name="plus" value="<?= $row['ProductIDs']; ?>">+</button></form>
            </div>
        </div>

    <?php
    }
    }
    ?>
    <div class="checkOutBtn">
        <div>
            <h1>Total price: <?= $totalsum ?>:-</h1>
            <form method="post" action="order.php" ><button name="cost" value="<?= $totalsum?>" class="button">Purchase</button></form>
        </div>
    </div>

    </div>



</body>
</html>
<?php
    }
?>