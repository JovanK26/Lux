<?php
session_start();

$servername = "localhost";
$username = "id7956606_newdb";
$password = "misko777";
$dbname = "id7956606_newdb";

$daLi = true;
    
$image = 0; 
$title="";
$info="";

$con=mysqli_connect($servername,$username,$password,$dbname);

if(!isset($_COOKIE["cookie"])) {
   
} else {
    $_SESSION["cookie"]=$_COOKIE["cookie"];
    $daLi=true;
}

if(!isset($_SESSION["cookie"])){
header("Location: logOut.php");
    exit;
}else{

//$mysqli = new mysqli($servername, $username, $password, $dbname);
$result = mysqli_query($con, "SELECT username, image, title, info, account_type FROM akaunti WHERE cookie = '" . $_SESSION["cookie"] . "' ");
if ($result->num_rows > 0) {
$row = mysqli_fetch_assoc($result);
$usernamez = $row["username"];
$image = $row["image"];  
$title = $row["title"];
$info = $row["info"];
$accType = $row["account_type"];

}else{
if($daLi==true){
header("Location: logOut.php");
    exit;
}
}
    
}

$con->close(); 

if(isset($_POST["allowUser"])){
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "UPDATE " . $usernamez . " SET allow=1 WHERE username='" . $_POST["allowUser"] . "'";

if ($conn->query($sql) === TRUE) {
    //echo "Record updated successfully";
} else {
    //echo "Error updating record: " . $conn->error;
}

$conn->close();
}

?>
<!DOCTYPE html>

<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
    .image{
user-drag: none; 
user-select: none;
-moz-user-select: none;
-webkit-user-drag: none;
-webkit-user-select: none;
-ms-user-select: none;
}

.unselectable{
-webkit-user-select: none; /* Safari */        
-moz-user-select: none; /* Firefox */
-ms-user-select: none; /* IE10+/Edge */
user-select: none; /* Standard */
}
        
.images{

display:inline-block;
max-width:64px;
margin-left:10px;
margin-right:10px;
margin-top:10px;
padding-left:10px;
padding-right:10px;
padding-top:5px;
padding-bottom:5px;
border:black solid 1px;
border-radius:25px;   

user-drag: none; 
user-select: none;
-moz-user-select: none;
-webkit-user-drag: none;
-webkit-user-select: none;
-ms-user-select: none;
}

.textBox{
border-radius:25px;
width:80%; 
max-width:450px;
border:solid 1px black;
padding-left:25px;
padding-right:25px;
font-size:20px;
}

.text{
    font-size:20px;
}

#pickImg{
display:none;
position:fixed;
top:40px;
left:0px;
width:100%;
bottom: 0px;
    background-color:beige;
    overflow: auto;
}   

#navBar{
position:fixed;
top:0px;
left:0px;
width:100%;
height:40px;
line-height:40px;
color:white;
background-color:black;
}        

#arrow{
position:fixed;
height:40px;
top:0px;
left:0px;
z-index:5;
}        
    
.button{
width:60%;
max-width:300px;
height:40px;
line-height:40px;
background-color:black;
color:white;
font-size:20px;
border-radius:25px;
cursor:pointer;
white-space:nowrap;
}

.buttonz{
height:30px;
line-height:30px;
background-color:black;
color:white;
font-size:14px;
border-radius:25px;
cursor:pointer;
white-space:nowrap;
text-decoration: none;
border:none;
padding-left:15px;
padding-right:15px;
}
        
#footBar{
position:fixed;
bottom:0px;
left:0px;
width:100%;
height:60px;
background-color:lightgray;
border-top:1px solid black;
}
        
#save{
margin-top:10px;
}        
#slike{
    position:absolute;
    top:0px;
    bottom:60px;
    width:100%;
    left:0px;
    overflow:auto;
}
a{
  color:lightgray;  
}
#profilePic{
    margin-top:40px;
    padding-top:5px;
    padding-bottom:5px;
    padding-left:15px;
    padding-right:15px;
    border:1px solid black;
    border-radius:25px;
    background-color:lightgray;
}
.inline{
    display:inline-block;
    white-space:nowrap;
    vertical-align: middle;
}
#search{
    background-color:black;
    width:60%;
    max-width:300px;
    border-radius:25px;
    color:white;
    font-size:20px;
}

#opisiinfo{
display:none;
position:fixed;
top:40px;
left:0px;
width:100%;
bottom: 0px;
    background-color:beige;
    overflow: auto;
}  

#arrowOI{
    display:none;
    float:left;
}

#finalOcjena2{
    font-size:25px;
    color:gold;
    background-color:black;
    border-radius:25px;
    padding-left:10px;
    padding-right:10px;
    padding-top:5px;
    padding-bottom:5px;
    display:inline-block;
}

.stavka{
    border-bottom:1px solid black;
    padding-top:10px;
    padding-bottom:10px;
    font-size:20px;
}
.stavka:first-child{
    border-top:1px solid black;
}

input[type=number]{
    display:inline-block;
    border:1px solid black;
    border-radius:25px;
    height:30px;
    width:80px;
    font-size:15px;
    padding-left:15px;
    padding-right:15px;
    margin-left:10px;
    margin-right:10px;
}

    </style>
    
</head>

<body onload="load();loado();">

    
    <script>
        
    function changeImg(){
        document.getElementById("pickImg").style.display = "block";
    }
        
    function changeImgNum(x, y){
        
    var elements = document.getElementsByClassName('klasa');

    for (var i = 0; i < elements.length; i++) {
        elements[i].style.backgroundColor = "";
    }
        
        document.getElementById("imgNum").value = x;
        y.style.backgroundColor = "lightgray";
    }    
        
    function nazad(){
        document.getElementById("pickImg").style.display="none";
    }    
    
    function load(){
     
    var elements = document.getElementsByTagName('div');

    for (var i = 0; i < elements.length; i++) {
    if(elements[i].style.position="fixed" && elements[i].style.cursor=="pointer")
    elements[i].style.display="none";
    }
    } 
    

    </script>

    <div id="navBar"><img src="arrowW.png" id="arrowOI" style="height:40px;" onclick="document.getElementById('opisiinfo').style.display = 'none'; document.getElementById('arrowOI').style.display = 'none';"/><?php echo '<div style="padding-right:20px;float:right;"><span style="padding-right:5px;">' . $usernamez . '</span> <a href="logOut.php"> log out</a></div>'; ?></div>

    
    <center>
        
    <p><img src="<?php echo 'images/' . $image . '.png' ?>" onclick="changeImg();" class="image" id="profilePic"/></p>
    
    <p><div id="finalOcjena"></div></p>
    
    <p><div id="search" onclick='window.location.href="/search.php";'><img src="search-icon.png" height="40" class="inline image"/><span class="inline unselectable" style="padding-left:10px;">Pretraga</span></div><p>
    
    <p><div class="button unselectable" onclick="document.getElementById('opisiinfo').style.display = 'block'; document.getElementById('arrowOI').style.display = 'block';">Naslov / Opis</div></p>
    
    <p><b><span style="font-size:20px;"><?php echo  $title; ?></span></b></p>
    
    <p><pre style="font-size:16px;"><?php echo  $info; ?></pre></p>
    
    </center>
    
    <div id="pickImg">
    <center>
   <div id="slike">
    <img src="arrowW.png" id="arrow" class="image" draggable="false" (dragstart)="false;" onclick="nazad();"/>
    <img src="images/0.png" class="images klasa" onclick="changeImgNum(0, this);" style="background-color:lightgray;"/>
    <img src="images/1.png" class="images klasa" onclick="changeImgNum(1, this);"/>
    <img src="images/2.png" class="images klasa" onclick="changeImgNum(2, this);"/>
    <img src="images/3.png" class="images klasa" onclick="changeImgNum(3, this);"/>
    <img src="images/4.png" class="images klasa" onclick="changeImgNum(4, this);"/>  
    <img src="images/5.png" class="images klasa" onclick="changeImgNum(5, this);"/>
    <img src="images/6.png" class="images klasa" onclick="changeImgNum(6, this);"/>
    <img src="images/7.png" class="images klasa" onclick="changeImgNum(7, this);"/>
    <img src="images/8.png" class="images klasa" onclick="changeImgNum(8, this);"/>
    <img src="images/9.png" class="images klasa" onclick="changeImgNum(9, this);"/>
    <img src="images/10.png" class="images klasa" onclick="changeImgNum(10, this);"/>
    <img src="images/11.png" class="images klasa" onclick="changeImgNum(11, this);"/>
    <img src="images/12.png" class="images klasa" onclick="changeImgNum(12, this);"/>
    <img src="images/13.png" class="images klasa" onclick="changeImgNum(13, this);"/>
    <img src="images/14.png" class="images klasa" onclick="changeImgNum(14, this);"/>
    </div>
    
    <div id="footBar">    
    <div class="button" id="save" onclick="document.getElementById('imgForm').submit();">Sačuvaj</div> 
    </div>    
 
   
    </center> 
        <form method="post" action="changeImg.php" id="imgForm">
            <input type="number" value="0" id="imgNum" name="imgNum" style="display:none;"/>
        </form>
    </div>
  
  <div id="opisiinfo">
    <p>
        <center>
        <form method="post" action="changeInfo.php" id="formaA">
        <p><input type="text" name="title" id="title" class="textBox" style="height:40px;" placeholder="Naslov" value="<?php echo $title; ?>"/></p><p>
        <textarea name="info" id="info" rows="5" cols="40" class="textBox" placeholder="Opis i informacije" style="height:80px;font-size:16px;"><?php echo $info; ?></textarea></p>
        <p><input type="submit" style="display:none;" /></p>
        <p><div class="button" onclick="document.getElementById('formaA').submit();">Sačuvaj</div></p>
        </form>
        </center>
    </p>
    </div>  
    
    <center>
    <div id="ocjene">
        <?php 
            if($accType==1){
        $conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT username, allow, ocjena FROM " . $usernamez . " ORDER BY allow ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
        $br=0;
        $ukupno=0;
        $oc=0;
    while($row = $result->fetch_assoc()) {

        if($row["allow"]==1){
            if($row["ocjena"]>0){
        echo '<div class="stavka"> ' . $row["username"]. " - Ocjena: " . $row["ocjena"]. "<br></div>";
            }else{
        echo '<div class="stavka"> ' . $row["username"]. " - Nije vas ocijenio/la<br></div>";        
            }
        }else{
        echo '<div class="stavka"> ' . $row["username"]. ' -  <form method="post" action="#" class="inline"><input type="submit" class="buttonz inline" value="Prihvati saradnju" /><input type="text" style="display:none;" name="allowUser" value="' . $row["username"]. '"/></form><br></div>';    
        }
        
        if($row["ocjena"]>0){
            $br++;
            $ukupno+=$row["ocjena"];
        }
        
    }
    if($br>0){
    (float)$oc=$ukupno/$br;
    echo '<span id="ocjena" class="ima" style="display:none;">' . number_format((float)$oc, 1, '.', '') . "</span>";
    }else{
        echo '<span id="ocjena" class="nema">Nema ocjena</span>';
    }
    
} else {
    echo '<span id="ocjena" class="nema">Nema zahtjeva i ocjena</span>';
}
$conn->close();
}
        ?>
    </div>
    </center>
    
    <script>
        function loado(){
                var element =  document.getElementById('ocjena');
if (typeof(element) != 'undefined' && element != null)
{
    
      if(document.getElementById("ocjena").className=="ima"){
        document.getElementById("finalOcjena").innerHTML = '<span class="text">Ocjena: </span><div id="finalOcjena2" class="unselectable">' + document.getElementById("ocjena").innerHTML + '</div>';
    }  
}    
  
        
        }
    </script>
    
</body>
</html>
