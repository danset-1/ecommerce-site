<?php
session_start(); 
$servername = "utbweb.its.ltu.se:3306";
$conn = new mysqli($servername, $username, $password, $dbName);
// Initialize $val if it's not set in the session
if (!isset($_SESSION['temp'])) {
    $_SESSION['temp'] = 4;
}

// Check which button was clicked and update the session variable
if (isset($_POST['item'])) { 
    $_SESSION['temp'] = 0;
} 
if (isset($_POST['item1'])) { 
    $_SESSION['temp'] = 1; 
} 
if (isset($_POST['item2'])) { 
    $_SESSION['temp'] = 2; 
}
$test ="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed laoreet dapibus nibh in ullamcorper. Vivamus sollicitudin leo non nisl pretium pellentesque. Fusce condimentum ligula metus, vitae dignissim urna egestas interdum.Phasellus tincidunt, mi non accumsan aliquam, mauris quam convallis lacus, quis pharetra odio metus sit amet enim. 
            Pellentesque id tincidunt mi. Aenean condimentum lobortis ante vitae venenatis. Vestibulum ante ipsum primis in faucibus orci luctus et 
            ultrices posuere cubilia curae; Vivamus eu auctor tortor. Nam viverra cursus libero, in tristique ante sagittis sed. 
            Nunc id tellus a felis scelerisque interdum quis a magna.";

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the selected item ID from the session
    $val = $_SESSION['temp'];

    // Check if newStock is set
    if (isset($_POST["newStock"])) {
        $newStock = $_POST["newStock"];

        // Construct and execute SQL query
        $query = "UPDATE Products SET Stock = $newStock WHERE ProductID = '$val'";
        $conn->query($query);

    } 
    if (isset($_POST["newDesc"])) {
        $newDesc = $conn->real_escape_string($_POST["newDesc"]);
        $query = "UPDATE Products SET Description = '$newDesc' WHERE ProductID = '$val'";
        $conn->query($query);
    }
    if (isset($_POST["return"])) {
        if($val == 0){
            header("Location: item.php");
        }
        if($val == 1){
            header("Location: item2.php");
        }if($val == 2){
            header("Location: item3.php");
        }
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
    <form method="post" action="editProduct.php"> 
    Change Stock:<input type="text" name="newStock" value="">
    <input class="revBtn" type="submit" name="cStock" value="Change Stock">  
</form>
</div>
<div style="margin: 10px;">
    <form method="post" action="editProduct.php"> 
            <div class="rBox">
                <p>Change Description</p>
                <textarea class="rBox" name="newDesc" rows="6" cols="50"></textarea>
                </div>
                <input class="revBtn" type="submit" name="desc" value="Change Description">  
    </form>
</div>

    <div style="margin: 10px;"><form method="post" action="editProduct.php" ><button id="pBtn" class="button" name="return" >Return to Product</button></form></div>
</body>
</html>