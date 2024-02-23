<?php
 $servername = "utbweb.its.ltu.se:3306";
 $username = "20020717";
 $password = "Daniel2002";
 $dbName = "db20020717";

session_start(); 
if (isset($_SESSION["loggedin"])) { 
    header("Location: profile.php");
} 
 // Create connection
 $conn = new mysqli($servername, $username, $password, $dbName);

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $sql = "SELECT UserID, Password FROM Users";
 $name = $_POST["name"];
 $passwd = $_POST["password"];

 $result = $conn->query($sql);
 while($row = $result->fetch_assoc()) {

 $a = "$row[UserID]";
 $b = "$row[Password]";
 
 if($a == $name){
    if($b == $passwd){
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $name;
        header("Location: profile.php");//redirect
    }else{
        header("Location: login.php");
    }
 }else{
    header("Location: login.php");
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

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        Name: <input type="text" name="name" value="">
        Password: <input type="text" name="password" value="">

        <br><br>
        <input type="submit" name="submit" value="Submit">  
    </form>
    <a href="createAcc.html"><button class="button">Create Account</button></a>
</body>
</html>