<?php
$servername = "localhost";
$username = "id7956606_newdb";
$password = "misko777";
$dbname = "id7956606_newdb";

$mysqli = new mysqli($servername, $username, $password, $dbname);
$result = $mysqli->query("SELECT salt1, salt2 FROM akaunti WHERE password = '" . $_GET['q'] . "' ");
$salt1="";
$salt2="";
if ($result->num_rows > 0) {
    if(isset($_POST["pass"])){
    while($row = $result->fetch_assoc()) {
        $salt1=$row["salt1"];
        $salt2=$row["salt2"];
    }
    $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("UPDATE akaunti SET password=? WHERE password = ?");
$stmt->bind_param("ss", $password, $oldpass);
$password = (string)hash("sha256", $salt1 . $_POST["pass"] . $salt2);
$oldpass = $_GET["q"];
$stmt->execute();

$stmt->close();
$conn->close();
    }else{
    echo '<form method="post" action="#" autocomplete="off"><input type="password" class="textBox" name="pass"/></form>';
    }
}


?>