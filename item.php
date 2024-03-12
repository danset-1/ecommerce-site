<?php
session_start(); 
$servername = "utbweb.its.ltu.se:3306";
$username = "";
$password = "";
$dbName = "";
$conn = new mysqli($servername, $username, $password, $dbName);
if (isset($_SESSION["loggedin"])){

}else{
    $_SESSION['loggedin'] = false;
    $_SESSION['usertype'] = "user";
}
if($_SESSION["loggedin"] == true){
    $userID = $_SESSION['username'];
    $type = $_SESSION['usertype'];
}
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
    <?php
    if($_SESSION['usertype'] == "admin"){
    ?>
    <form method="post" action="editProduct.php" ><button class="button" id="pBtn" type="submit" name="item">Edit this page</button></form>
    <?php
    }
    ?>
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
            <?php
            $buy = true;
            $sq = "SELECT Stock FROM Products where ProductID = '0'";
            $result3 = $conn->query($sq);
        
            if ($result3->num_rows > 0) {
            // output data of each row
            while($row = $result3->fetch_assoc()) {
                $stock = "$row[Stock]";
                if($stock<1){
                    $buy = false;
                }
            }}
            if($buy == true){
            ?>
            <form method="post" action="addProduct.php" ><button class="button" id="pBtn" type="submit" name="computer">Purchase</button></form>
            <?php
            }else{
                ?>
                <button class="graybutton" >Purchase</button>
                <?php
            }
                ?>
            <h2>In Stock: <?= $stock ?></h2>
        </div>
        </div>

        <div class="description" id="desc0">
            <h1>Description</h1>
            <?php
             $sq = "SELECT Description FROM Products where ProductID = '0'";
             $result3 = $conn->query($sq);
         
             if ($result3->num_rows > 0) {
             // output data of each row
             while($row = $result3->fetch_assoc()) {
                 $desc = "$row[Description]";
                ?>
                <p><?= $desc ?></p>
                <?php
             }}
            ?>
        </div>
        <?php

        if($_SESSION['loggedin'] == false){

        }
        
        else{
            
                ?>
        <div style="margin: 10px;">
        <h1>Add Review</h1>
        <form method="post" action="addReview.php">  
            Title:<input type="text" name="title" value="">
            Grade 1-5:<input type="text" name="grade" value="">
                <div class="rBox">
                <textarea class="rBox" name="review" rows="6" cols="50"></textarea>
                </div>
                <input class="revBtn" type="submit" name="item" value="Add Review">  
            </form>
        </div>
            <?php
            }
        
            ?>
        <div class="review">
            <div><h1>Reviews</h1></div>
            <?php
            $sql = "SELECT ReviewID, UserID, Review, Score, ProductID, Title FROM Reviews where ProductID = '0'";
            $result = $conn->query($sql);            
        
            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
            $r = "$row[Review]";
            $rID = "$row[ReviewID]";
            $s = "$row[Score]";
            $t = "$row[Title]";
            $user = "$row[UserID]";
            ?>
            <div class="rUsers">
                <?php
                    if($type == "admin"){
                    ?>
                    <form method="post" action="removeReview.php" ><button id="pBtn" class="button" name="delRev" value="<?= $rID ?>">Delete Review</button></form>
                    <?php
                    }
                ?>
                <h2><?= $t ?></h2>
                <p>Grading: <?= $s ?>/5</p>
                <p><?= $r ?></p> 
                <p>Written by: <?= $user ?></p>
            </div>
            <?php
            }
            }
            ?>

        </div>

    </div>

</body>
</html>