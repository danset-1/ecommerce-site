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
            <img src="pic/cart.svg" id="cartIcon" width="50px" height="50px" alt="">
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


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbName);

    $sql = "SELECT CartID, ProductIDs, Quantity FROM Cart";

    $result = $conn->query($sql);
    

    if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $sql2 = "SELECT ProductName, Price, Images FROM Products Where ($row[ProductIDs] = ProductID)";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc()
        ?>
        <div class="checkoutWrap">
            <div class="c">
            <div><img src="<?= $row2['Images']; ?>" height="150px" width="150px" alt=""></div>
            <div><h2><?= $row2['ProductName']; ?></h2></div>
            <div><h2><?= $row2['Price']; ?>:-</h2></div>
            </div>
            <div class="qBtn">
            <form method="post" action="updateformMin.php" ><button>-</button></form>
                <div class="quantity"><h2>Quantity: <?= $row['Quantity']; ?></h2></div>
            <form method="post" action="updateform.php" ><button>+</button></form>
            </div>
        </div>

    <?php
    }
    }
    ?>
        
    </div>


</body>
</html>