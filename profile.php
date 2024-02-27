<?php
$servername = "utbweb.its.ltu.se:3306";
session_start(); 
    $conn = mysqli_connect($servername, $username, $password, $dbName);
if(!$conn) {
    die("Connection To Database Failed:".mysqli_connect_error());
}
$userID = $_SESSION['username'];

    $dbinfo = "SELECT UserID, FullName, Adress, City, PostalCode, Country, Orders FROM Users WHERE UserID='$userID'";
    $dbresult = mysqli_query($conn, $dbinfo);
    $rt = mysqli_fetch_array($dbresult);


    $id = $rt['UserID'];
    $name = $rt['FullName'];
    $adress = $rt['Adress'];
    $city = $rt['City'];
    $postalcode = $rt['PostalCode'];
    $country = $rt['Country'];
    $orders = $rt['Orders'];



?>
<!DOCTYPE html>
<html lang="en">
<style>
    table, th {
  border:1px solid black;
  }
</style>
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
    
    <div>
        <table>
        <tr>
            <th>UserID: <span><?php echo $id; ?></span></th>
        </tr>
        <tr>
        <th>FullName: <span><?php echo $name; ?></span></th>
        </tr>
        <tr>
            <th>Adress: <span><?php echo $adress; ?></span></th>
        </tr>
        <tr>
            <th>City: <span><?php echo $city; ?></span></th>
        </tr>
        <tr>
            <th>PostalCode: <span><?php echo $postalcode; ?></span></th>
        </tr>
        <tr>
            <th>Country: <span><?php echo $country; ?></span></th>
        </tr>
        <tr>
            <th>Orders: <span><?php echo $orders; ?></span></th>
        </tr>
        </table>
    </div>


    <form method="post" action="logout.php" ><button>LogOut</button></form>
</body>
</html>