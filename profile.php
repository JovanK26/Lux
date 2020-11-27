<?php
session_start();

$servername = "localhost";
$username = "id7956606_newdb";
$password = "misko777";
$dbname = "id7956606_newdb";

$id = $_GET["q"];
$info = "";
$title = "";
$usernamez="";
$image=30;
$klik=0;
$pocOcjena = 3;

$mysqli = new mysqli($servername, $username, $password, $dbname);
$result = $mysqli->query("SELECT username, image, cookie, title, info FROM akaunti WHERE id = '" . $id . "' ");
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        if($row["cookie"]==$_SESSION["cookie"]){
            header("Location: index.php");
            exit;
        }else{
            $title = $row["title"];
            $info = $row["info"];
            $usernamez = $row["username"];
            $image=$row['image'];
        }
    }
    
}

$myusername="";
$result = $mysqli->query("SELECT username FROM akaunti WHERE cookie = '" . $_SESSION["cookie"] . "' ");
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $myusername=$row["username"];
    }
    
}

$result = $mysqli->query("SELECT allow, ocjena FROM " . $usernamez . " WHERE username = '" . $myusername . "' ");
if ($result->num_rows > 0) {
if(isset($_POST["povuci"])){
    
    $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// sql to delete a record
$sql = "DELETE FROM " . $usernamez . " WHERE username= '" . $myusername . "'";

if ($conn->query($sql) === TRUE) {
    header("Refresh:0");
} else {
    echo $usernamez . "<br>";
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
    
}else{
    while($row = $result->fetch_assoc()) {
        //echo $row["allow"] . ":allow)<br>(ocjena:" . $row["ocjena"];
        if($row["allow"]==0){
            echo '<form method="post" action="#"><input type="submit" name="povuci" id="klik" value="Povuci zahtjev za usluge"/></form>'; 
            $klik = 2;
        }else{
            $klik=3;
            if($row["ocjena"]>0){
            $pocOcjena = $row["ocjena"]; 
            if(isset($_POST["ocjena"])){
            $pocOcjena = $_POST["ocjena"];
            }
            }
            echo '<form method="post" action="#"><input type="number" onchange="if(this.value < 1){ this.value = 1; } if(this.value > 5){ this.value = 5; }" name="ocjena" id="ocjena" max="5" min="1" value="' . $pocOcjena . '"/><input type="submit" name="ocijeni" id="ocijeni" value="ocijeni"/></form>'; 
        }
    }
}
    
}else{
    if(isset($_POST["submit"])){
        $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("INSERT INTO " . $usernamez . " (username, allow, ocjena) VALUES (?, ?, ?)");
$stmt->bind_param("sii", $myusername, $allow, $ocjena);
$allow = 0;
$ocjena = 0;
$stmt->execute();
$conn->close();
 header("Refresh:0");       
    }else{
    echo '<form method="post" action="#"><input type="submit" name="submit" id="klik" value="Pošalji zahtjev za usluge"/></form>';   
    $klik=1;
    }
} 

if(isset($_POST["ocjena"])){
       $conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
$stmt = $conn->prepare("UPDATE  " . $usernamez . " SET ocjena=? WHERE username='" . $myusername . "'");
$stmt->bind_param("i", $ocjena);
$ocjena = $_POST["ocjena"];
$stmt->execute();
$conn->close();
}

echo '<center><p><span class="text">Ime: ' . $usernamez . '</span></p>';
echo '<img src="images/' . $image . '.png" class="image" id="profilePic"/></center>';

   $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT username, allow, ocjena FROM " . $usernamez;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
        $br=0;
        $ukupno=0;
        $oc=0;
    while($row = $result->fetch_assoc()) {
     
        if($row["ocjena"]>0){
            $br++;
            $ukupno+=$row["ocjena"];
        }
        
    }
    if($br>0){
    (float)$oc=$ukupno/$br;
    echo '<center><p><span class="text">Ocjena:</span> <b><span id="ocjenaDa" class="unselectable">' . number_format((float)$oc, 1, '.', '') .  "</span></b></p></center>";
    }else{
        echo '<center><p><span class="text">Nema ocjena</span></p></center>';
    }
    
} else {
    echo '<center><p><span class="text">Nema ocjena</span></p></center>';
}
$conn->close();

?>
    <html>
        <head>
             <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                    .button{
display:inline-block;
padding-left:25px;
padding-right:25px;
height:30px;
line-height:30px;
background-color:black;
color:white;
font-size:15px;
border-radius:25px;
text-align:center;
cursor:pointer;
}

.unselectable{
        -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}
#profilePic{
    padding-top:5px;
    padding-bottom:5px;
    padding-left:15px;
    padding-right:15px;
    border:1px solid black;
    border-radius:25px;
    background-color:lightgray;
}
           .image{
user-drag: none; 
user-select: none;
-moz-user-select: none;
-webkit-user-drag: none;
-webkit-user-select: none;
-ms-user-select: none;
}
.text{
    font-size:20px;
}
.texts{
    font-size:18px;
}
#ocjenaDa{
    font-size:25px;
    color:gold;
    background-color:black;
    border-radius:25px;
    padding-left:10px;
    padding-right:10px;
    padding-top:5px;
    padding-bottom:5px;
}
form{
    display:none;
}
#ocijeniR{
    display:inline-block;
    border:1px solid black;
    border-radius:25px;
    height:30px;
    width:60px;
    font-size:15px;
    padding-left:20px;
}
#ocijeniBtnR{
    display:inline-block;
    margin-left:7px;
}
#ocjR{
    display:inline-block;
}
            </style>
        </head>
        
<body onload="load();">
            <script>
               function load(){
    var elements = document.getElementsByTagName('div');

    for (var i = 0; i < elements.length; i++) {
    if(elements[i].style.position="fixed" && elements[i].style.cursor=="pointer")
    elements[i].style.display="none";
    }
    var element =  document.getElementById('ocijeniR');
if (typeof(element) != 'undefined' && element != null)
{
 document.getElementById('ocijeniR').value = document.getElementById('ocjena').value;
}
    
    
    }
        </script>
    <center>
    <?php if($klik==1){ echo  '<div class="button unselectable" onclick="document.getElementById(\'klik\').click()">Pošalji zahtjev za usluge</div>'; }else if($klik==2){ echo  '<div class="button unselectable" onclick="document.getElementById(\'klik\').click()">Povuci zahtjev za usluge</div>'; }else if($klik==3){ echo '<span class="text" id="ocjR">Vaša ocjena: </span><input type="number" id="ocijeniR" onchange="if(this.value < 1){ this.value = 1; } if(this.value > 5){ this.value = 5; }" max="5" min="1" /><div class="button unselectable" onclick="document.getElementById(\'ocjena\').value = document.getElementById(\'ocijeniR\').value; document.getElementById(\'ocijeni\').click();" id="ocijeniBtnR">Ocijeni</div>'; }?>
    <p><span><?php echo '<b><span class="text">' .  $title . '</span></b>'; ?></span></p>
    <p><pre><?php echo '<span class="texts">' . $info . '</span>'; ?></pre></p>
    </center>
</body>
    </html>    
    <?php
    $mysqli->close();
    ?>