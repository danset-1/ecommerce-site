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
} elseif (isset($_POST['item1'])) { 
    $_SESSION['temp'] = 1; 
} elseif (isset($_POST['item2'])) { 
    $_SESSION['temp'] = 2; 
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cStock"])) {
    // Retrieve the selected item ID from the session
    $val = $_SESSION['temp'];

    // Check if newStock is set
    if (isset($_POST["newStock"])) {
        $newStock = $_POST["newStock"];

        // Construct and execute SQL query
        $query = "UPDATE Products SET Stock = $newStock WHERE ProductID = '$val'";
        if ($conn->query($query) === TRUE) {
            echo "Stock updated successfully";
        } 
        
    } else {
        // Handle case where newStock is not set
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
    <form method="post" action="editProduct.php"> 
    Change Stock:<input type="text" name="newStock" value="">
    <input class="revBtn" type="submit" name="cStock" value="Change Stock">  
</form>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
            <div class="rBox">
                <p>Change Description</p>
                <textarea class="rBox" name="desc" rows="6" cols="50"></textarea>
                </div>
                <input class="revBtn" type="submit" name="desc" value="Change Description">  
            </form>
</body>
</html>