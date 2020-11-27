<?php

$servername = "localhost";
$username = "id7956606_newdb";
$password = "misko777";
$dbname = "id7956606_newdb";

//echo $_POST["Username"];
$mysqli = new mysqli($servername, $username, $password, $dbname);
$result = $mysqli->query("SELECT username FROM akaunti WHERE username = '" . $_POST['Username'] . "' ");
if ($result->num_rows > 0) {

//echo "Account name already exists";
header("Location: signUp.php?q=ANAE&u=" . $_POST['Username']);
exit;

}else{

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO akaunti (username, password, email, salt1, salt2, cookie, account_type, tags, image, title, info) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssisiss", $username, $password, $email, $salt1, $salt2, $cookie, $account_type, $tags, $image, $naslov, $info);

// set parameters and execute
$salt1=generateRandomString();
$salt2=generateRandomString();
$username = $_POST["Username"];
$password = (string)hash("sha256", $salt1 . $_POST["Password"] . $salt2);
$email = $_POST['Email'];
$cookie="";
$account_type = $_POST['tipNum'];
$tags=$_POST['tags'];
$image=0;
$naslov = "Naslov";
$info = "Informacije";

//echo $salt1 . $_POST["Password"] . $salt1;

$stmt->execute();

if($account_type==1){
$sql = "CREATE TABLE " . $username . " (
username VARCHAR(300) NOT NULL,
allow INT,
ocjena INT,
reg_date TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo '<center><div id="odvoji"><p><span class="text">Uspješno ste se registrovali.</span></p> <p><div class="button unselectable" onclick="window.location.href=\'logIn.php\';"> Prijavi se </div></p></div></center>';
} else {
    echo "Error creating table: " . $conn->error;
}


}else{

echo '<center><div id="odvoji"><p><span class="text">Uspješno ste se registrovali.</span></p> <p><div class="button unselectable" onclick="window.location.href=\'logIn.php\';"> Prijavi se </div></p></div></center>';
}

}
$mysqli->close();
$conn->close();



function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


?>

<html>
    <head>
        <style>
            .button{
padding-left:20px;
padding-right:20px;
display:inline-block;
height:40px;
line-height:40px;
background-color:black;
color:white;
font-size:20px;
border-radius:25px;
cursor:pointer;
white-space:nowrap;
text-align:center;
}
.text{
    font-size:20px;
}
#odvoji{
    margin-top:100px;
}
        </style>
    </head>
    <body>
        
    </body>
</html>