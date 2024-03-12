<?php
$servername = "utbweb.its.ltu.se:3306";

session_start(); 
$conn = new mysqli($servername, $username, $password, $dbName);
if (isset($_POST['delRev'])) { 
    $num = $_POST['delRev'];
}
if (isset($_POST['delRev1'])) { 
    $num = $_POST['delRev1'];
}
if (isset($_POST['delRev2'])) { 
    $num = $_POST['delRev2'];
}


$sql1 = "DELETE FROM Reviews Where ReviewID = '$num'";
$conn->query($sql1);

if (isset($_POST['delRev'])) { 
    header("Location: item.php");
}
if (isset($_POST['delRev1'])) { 
    header("Location: item2.php");
}
if (isset($_POST['delRev2'])) { 
    header("Location: item3.php");
}

?>