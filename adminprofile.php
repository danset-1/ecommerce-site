<?php
 $servername = "utbweb.its.ltu.se:3306";
 $username = "20020717";
 $password = "Daniel2002";
 $dbName = "db20020717";

session_start(); 
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

    <div class="wrap" style="margin: 10px;"><form method="post" action="logout.php" ><button id="pBtn" class="button">LogOut</button></form></div>

    <div>
        <?php
            $sql = "SELECT UserID FROM Users";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $userID = "$row[UserID]";
                ?>
                <div class="profileWrap">
                    <div class="c">
                        <div><h2>User: <?= $userID ?></h2></div>
                        <form method="post" action="editUser.php" ><button id="pBtn" class="button" name="user" value="<?= $userID ?>">Edit User</button></form>
                    </div>
                </div>
                <?php
            }}
        ?>
    </div>

