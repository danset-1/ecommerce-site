<?php
 $servername = "utbweb.its.ltu.se:3306";
 $username = "20020717";
 $password = "Daniel2002";
 $dbName = "db20020717";

session_start(); 
if (isset($_SESSION["loggedin"])){

}else{
    $_SESSION['loggedin'] = false;
}
if ($_SESSION["loggedin"] == true) { 
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
        $userID = $_SESSION['username'];
        $sql2 = "SELECT UserType FROM Users WHERE UserID = '$userID'";
        $result2 = $conn->query($sql2);
        while($row2 = $result2->fetch_assoc()) {
            $type = "$row2[UserType]";
            $_SESSION['usertype'] = $type;
        }
        
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

    <div class="wrap">
        <div>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        <div class="login">Username: <input type="text" name="name" value=""></div>
        <div class="login">Password: <input type="text" name="password" value=""></div>

        <br><br>
        <input id="pBtn"class="button"type="submit" name="submit" value="LogIn">  
    </form>
    <br><br>
    <div>
    <a href="createAcc.html"><button id="pBtn" class="button">Create Account</button></a>
    </div>
    </div>
    </div>
</body>
</html>