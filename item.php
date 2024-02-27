<?php
session_start(); 
$servername = "utbweb.its.ltu.se:3306";
$conn = new mysqli($servername, $username, $password, $dbName);
?>

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

    <div class="container">

        <div class="top">
            <div class="product">
            <div class="text">
                <h1>Electramix Super Computer</h1>
            </div>
            <div class="pic"><img src="pic/comp.png" alt="Funny"></div>
        </div>

        <div class="purchase">
            <h1>0.99:-</h1>
            <form method="post" action="addProduct.php" ><button class="button" id="pBtn" type="submit" name="computer">Purchase</button></form>
        </div>
        </div>

        <div class="description">
            <h1>Description</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed laoreet dapibus nibh in ullamcorper. 
            Vivamus sollicitudin leo non nisl pretium pellentesque. Fusce condimentum ligula metus, vitae dignissim urna egestas interdum.
            Phasellus tincidunt, mi non accumsan aliquam, mauris quam convallis lacus, quis pharetra odio metus sit amet enim. 
            Pellentesque id tincidunt mi. Aenean condimentum lobortis ante vitae venenatis. Vestibulum ante ipsum primis in faucibus orci luctus et 
            ultrices posuere cubilia curae; Vivamus eu auctor tortor. Nam viverra cursus libero, in tristique ante sagittis sed. 
            Nunc id tellus a felis scelerisque interdum quis a magna.</p>
        </div>
        <form method="post" action="addReview.php">  
                <div class="rBox">
                <textarea class="rBox" name="review" rows="6" cols="50"></textarea>
                </div>
                <input type="submit" name="item" value="Submit">  
            </form>
        <div class="review">
            <div><h1>Reviews</h1></div>
            <?php
            $sql = "SELECT ReviewID, UserID, Review, Score, ProductID FROM Reviews where ProductID = '0'";
            $result = $conn->query($sql);            
        
            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            $r = "$row[Review]";
            ?>
            <div class="rUsers">
                <p><?= $r ?></p>
            </div>
            <?php
            }
            }
            ?>

        </div>

    </div>

</body>
</html>