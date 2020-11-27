<?php

session_start();

$servername = "localhost";
$username = "id7956606_newdb";
$password = "misko777";
$dbname = "id7956606_newdb";

$usr = $_POST["Username"];
$pass = $_POST["Password"];

$mysqli = new mysqli($servername, $username, $password, $dbname);
$result = $mysqli->query("SELECT username, password, salt1, salt2, id FROM akaunti WHERE username = '" . $usr . "' ");
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
$pass=(string)hash("sha256", $row["salt1"] . $pass . $row["salt2"]);
$truepass=$row["password"];
       if($pass==$truepass){
$cookie = generateRandomString2() . $row["id"];
//echo "logged in as: " . $row["username"] . " " . $truepass . "<br>";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("UPDATE akaunti SET cookie=? WHERE username=?");
$stmt->bind_param("ss", $cookie, $usr);

// set parameters and execute

$stmt->execute();

//echo "<br>".$cookie;

           $_SESSION["cookie"] = $cookie;

}else{
header("Location: logIn.php?q=IP&u=" . $_POST['Username']); //incorrect password
exit; 
}
    }

} else {
    header("Location: logIn.php?q=AN&u=" . $_POST['Username']); //account name doesn't exist
    exit; 
}
$mysqli->close();

 if(isset($_POST["stayLogged"])){
$cookie_name = "cookie";
$cookie_value = $cookie;
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/", "", false, true); // 86400 = 1 day
} 


function generateRandomString2($length = 60) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if(!isset($_SESSION["cookie"])){

}else{
header("Location: index.php");
exit;
}

?>
