<?php
session_start();
$servername = "localhost";
$username = "id7956606_newdb";
$password = "misko777";
$dbname = "id7956606_newdb";

//echo $_POST["imgNum"];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("UPDATE akaunti SET image=? WHERE cookie = ?");
$stmt->bind_param("is", $image, $cookie);

// set parameters and execute
$image = $_POST["imgNum"];
$cookie = $_SESSION["cookie"];
$stmt->execute();


$stmt->close();
$conn->close();

header("Location: index.php");
exit;

?>