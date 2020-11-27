<?php
session_start();

if(!isset($_COOKIE["cookie"])) {

}else{

$cookie_name = "cookie";
$cookie_value = "";
setcookie($cookie_name, $cookie_value, time() - (86400 * 30), "/", "", false, true);

}


session_unset(); 

session_destroy();

header("Location: logIn.php");
    exit;

?>
