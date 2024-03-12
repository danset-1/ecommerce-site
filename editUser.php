<?php

$servername = "utbweb.its.ltu.se:3306";

session_start(); 
$conn = new mysqli($servername, $username, $password, $dbName);
if (isset($_POST['user'])) { 
    $_SESSION['editUser'] = $_POST['user'];
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_SESSION['editUser'];

    if (isset($_POST["delete"])) {
        $sql1 = "DELETE FROM Users Where UserID = '$user'";
        $conn->query($sql1);
        header("Location: adminprofile.php");
    }
    if (isset($_POST["changeName"])) {
        $newName = $_POST["newName"];
        $query = "UPDATE Users SET UserID = $newName WHERE UserID = '$user'";
        $conn->query($query);
        $query = "UPDATE Cart SET UserID = $newName WHERE UserID = '$user'";
        $conn->query($query);
        $query = "UPDATE Reviews SET UserID = $newName WHERE UserID = '$user'";
        $conn->query($query);
        $query = "UPDATE Orders SET UserID = $newName WHERE UserID = '$user'";
        $conn->query($query);
        $_SESSION['editUser'] = $newName;
    }
    if (isset($_POST["changePassword"])) {
        $newPassword = $_POST["newPassword"];
        $query = "UPDATE Users SET Password = $newPassword WHERE UserID = '$user'";
        $conn->query($query);
    }
    if (isset($_POST["changeInfo"])) {
        $newFName = $conn->real_escape_string($_POST["newFName"]);
        $newAddress = $conn->real_escape_string($_POST["newAddress"]);
        $newCity = $conn->real_escape_string($_POST["newCity"]);
        $newPcode = $conn->real_escape_string($_POST["newPcode"]);
        $newCountry = $conn->real_escape_string($_POST["newCountry"]);
        if (!empty($newFName) && !empty($newAddress) && !empty($newCity) && !empty($newPcode) && !empty($newCountry)) {
        $query = "UPDATE Users SET FullName = '$newFName', Adress = '$newAddress', City = '$newCity', PostalCode = '$newPcode', Country = '$newCountry' WHERE UserID = '$user'";
        $conn->query($query);
    }
    }
    if (isset($_POST["return"])) {
        header("Location: adminprofile.php");
    }
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
   <div style="margin: 10px;">
   <form method="post" action="editUser.php"> 
    Change Username:<input type="text" name="newName" value="">
    <input class="revBtn" type="submit" name="changeName" value="Update Username">  
    </form>
    <form method="post" action="editUser.php"> 
    Change Password:<input type="text" name="newPassword" value="">
    <input class="revBtn" type="submit" name="changePassword" value="Update Password">  
    </form>
    <form method="post" action="editUser.php"> 
    Full Name:<input type="text" name="newFName" value="">
    Adress:<input type="text" name="newAddress" value="">
    City:<input type="text" name="newCity" value="">
    Postal Code:<input type="text" name="newPcode" value="">
    Country:<input type="text" name="newCountry" value="">
    <input class="revBtn" type="submit" name="changeInfo" value="Update Info">  
    </form>
   <form method="post" action="editUser.php" ><button id="pBtn" class="button" name="delete">Delete this Account</button></form>
</div>


<div style="margin: 10px;"><form method="post" action="editUser.php" ><button id="pBtn" class="button" name="return" >Back</button></form></div>
