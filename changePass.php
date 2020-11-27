<?php
if(isset($_POST["cpAcc"])){

$servername = "localhost";
$username = "id7956606_newdb";
$password = "misko777";
$dbname = "id7956606_newdb";

$usr = $_POST["cpAcc"];

$mysqli = new mysqli($servername, $username, $password, $dbname);
$result = $mysqli->query("SELECT password, email FROM akaunti WHERE username = '" . $usr . "' ");
if ($result->num_rows > 0) {
    $id=0;
    $email="";
     while($row = $result->fetch_assoc()) {
         $id=$row["password"];
         $email=$row["email"];
     }
$msg = "Dobili smo zahtjev za promjenu vaše lozinke,\nAko ste vi poslali zahtjev, možete promijeniti vašu lozinku klikom na sledeći link: https://lux-escanor12.000webhostapp.com/changePass2.php?q=" . $id;

// use wordwrap() if lines are longer than 70 characters
$msg = wordwrap($msg,70);

// send email

$success = mail($email,"Lux - promjena lozinke",$msg);
if (!$success) {
    $errorMessage = error_get_last()['message'];
    echo '<center><span class="text" id="red">Došlo je do greške!</span></center>';
}else{
    echo '<center><span class="text">Mail sa uputstvom za promjenu pasvorda je poslat!</span></center>';
}
}else{
    echo '<center><span class="text" id="red">Nepostojeće korisničko ime!</span></center>';
}
}
?>

<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .button{
width:60%;
max-width:300px;
height:40px;
line-height:40px;
background-color:black;
color:white;
font-size:16px;
border-radius:25px;
cursor:pointer;
}
.textBox{
border-radius:25px;
height:40px;
width:80%; 
max-width:450px;
border:solid 1px black;
padding-left:25px;
padding-right:25px;
font-size:20px;
}
form{
    margin-top:70px;
}
.text{
    font-size:20px;
}
.unselectable{
        -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
#red{
    color:red;
}
    </style>
    </head>
    <body bgcolor="beige" onload="load();">
                <script>
               function load(){
    var elements = document.getElementsByTagName('div');

    for (var i = 0; i < elements.length; i++) {
    if(elements[i].style.position="fixed" && elements[i].style.cursor=="pointer")
    elements[i].style.display="none";
    }
    }
        </script>
        <center>
        <form method="post" action="#">
            <p><input type="text" name="cpAcc" class="textBox" placeholder="Vaše korisničko ime"/></p>
            <input type="submit" id="submit" style="display:none;"/>
            <p><div class="button unselectable" onclick="document.getElementById('submit').click();">Promijeni lozinku</div></p>
        </form>
        <br><p><img src="home-icon.png" onclick="window.location.href='index.php';"/></p>
        </center>
        
    </body>
</html>