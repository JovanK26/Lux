<?php
session_start();

$servername = "localhost";
$username = "id7956606_newdb";
$password = "misko777";
$dbname = "id7956606_newdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



  $sql = "SELECT username, image, id, cookie, account_type, title, info, tags FROM akaunti WHERE account_type=1";      

$result = $conn->query($sql);
echo '<div id="content">';
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        
     if(isset($_POST["search"]) && $_POST["search"]!=""){   
         $kategorije=$_POST["tags"];
         if($_POST["tags"]==""){
             $kategorije="Kategorije";
         }
         if (strpos(strtoupper($row["username"]), strtoupper($_POST["search"])) !== false || strpos(strtoupper($row["account_type"]), strtoupper($_POST["search"])) !== false || strpos(strtoupper($row["title"]), strtoupper($_POST["search"])) !== false) {
             
             if (strpos($row["tags"], $kategorije) !== false || $kategorije=="Kategorije"){
              if($row["cookie"]==$_SESSION["cookie"]){
             echo '<div class="in">Ime: ' . $row["username"] . '<br> <img src="images/' . $row["image"] . '.png"  class="inline"/><span class="inline" style="padding-left:10px;">' . $row['title'] . '</span><br>Kategorija: ' . $row['tags'] . '</div>';
         }else{
        echo '<div class="in" onclick="profil(' . $row["id"] . ');">Ime: ' . $row["username"] . '<br> <img src="images/' . $row["image"] . '.png"  class="inline"/><span class="inline" style="padding-left:10px;">' . $row['title'] . '</span><br>Kategorija: ' . $row['tags'] . '</div>';
         }
             }
         
         }

     }else if(isset($_POST["search"]) && $_POST["search"]==""){
         $kategorije=$_POST["tags"];
         if($_POST["tags"]==""){
             $kategorije="Kategorije";
         }
         if (strpos($row["tags"], $kategorije) !== false || $kategorije=="Kategorije"){
         if($row["cookie"]==$_SESSION["cookie"]){
             echo '<div class="in">Ime: ' . $row["username"] . '<br> <img src="images/' . $row["image"] . '.png"  class="inline"/><span class="inline" style="padding-left:10px;">' . $row['title'] . '</span><br>Kategorija: ' . $row['tags'] . '</div>';
         }else{
        echo '<div class="in" onclick="profil(' . $row["id"] . ');">Ime: ' . $row["username"] . '<br> <img src="images/' . $row["image"] . '.png" class="inline"/><span class="inline" style="padding-left:10px;">' . $row['title'] . '</span><br>Kategorija: ' . $row['tags'] . '</div>';
         }
         }
         
     }else{
         if($row["cookie"]==$_SESSION["cookie"]){
             echo '<div class="in">Ime: ' . $row["username"] . '<br> <img src="images/' . $row["image"] . '.png" class="inline"/><span class="inline" style="padding-left:10px;">' . $row['title'] . '</span><br>Kategorija: ' . $row['tags'] . '</div>';
         }else{
        echo '<div class="in" onclick="profil(' . $row["id"] . ');">Ime: ' . $row["username"] . '<br> <img src="images/' . $row["image"] . '.png" class="inline"/><span class="inline" style="padding-left:10px;">' . $row['title'] . '</span><br>Kategorija: ' . $row['tags'] . '</div>';
         }
     }   
         
    }
    
} else {
    echo "0 rezultata";
}
echo '</div>';
$conn->close();
?>

<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        #content{
        position:absolute;
        top:63px;
        left:0px;
        width:100%;
        }
        .in{
          padding-left:20px; 
          border-bottom:1px solid black;
        }
        
        .inline{
            vertical-align:middle;
            display:inline-block;
        }

           .image{
user-drag: none; 
user-select: none;
-moz-user-select: none;
-webkit-user-drag: none;
-webkit-user-select: none;
-ms-user-select: none;
}
        #navbar{
            position:fixed;
            top:0px;
            left:0px;
            height:60px;
            width:100%;
            background-color:black;
            color:white;
            line-height:60px;
        }
        #profileViewer{
            z-index:99999;
            position:absolute;
            top:0px;
            left:0px;
            width:100%;
            height:100%;
            display:none;
            background-color:white;
        }
        #profileNavbar{
            position:fixed;
            top:0px;
            left:0px;
            height:40px;
            width:100%;
            background-color:black;
        }
        #arrow{
        position:fixed;
        height:40px;
        top:0px;
        left:0px;
        z-index:5;
        }
        

        #arrow2{
        position:fixed;
        height:60px;
        top:0px;
        left:0px;
        z-index:5;
        }
        
        #settingsBtn{
            position:fixed;
            height:40px;
            top:10px;
            left:5px;
        }

        .str{
display:none;
}

#save{
margin-top:10px;
}

#page{
position:fixed;
top:0px;
left:0px;
width:100%;
height:100%;
background-color:white;
display:none;
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
.btn{
width:100%;
height:30px;
line-height:30px;
background: linear-gradient(to top, #d3d3d3 47%, #808080 102%);
text-align:center;
padding-top:5px;
padding-bottom:5px;
}

#contentz{
position:absolute;
bottom:60px;
top:60px;
left:0px;
width:100%;
overflow:auto;
}

    #kat{
        text-align: center;
        border-radius:25px;
height:30px;
width:80%; 
max-width:450px;
border:solid 1px black;
font-size:18px;
        line-height:30px;
        display:none;
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
}

.text{
font-size:20px;
}

.texts{
font-size:18px;
}

.unselectable{
        -webkit-touch-callout: none;
    -webkit-user-select: none;
    -khtml-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

#profileViewer{
    position:absolute;
    left:0px;
    top:0px;
    height:100%;
    width:100%;
}
#iframe{
    width:100%;
    height:100%;
}
#frameI{
    position:absolute;
    top:40px;
    bottom:0px;
    width:100%;
}

#searchBox{
border-radius:25px;
height:40px;
border:solid 1px black;
padding-left:25px;
padding-right:25px;
font-size:20px;
width:100%;
}
#searchBox2{
    position:absolute;
    left:50px;
    right:50px;
    top:10px;
}
#searchBtn2{
    position:absolute;
    right:5px;
    top:10px;
}
        </style>
    </head>
    <body onload="load();">
        
        <script>
            function profil(x){
                document.getElementById("iframe").src = "https://lux-escanor12.000webhostapp.com/profile.php?q=" + x;
                document.getElementById("profileViewer").style.display="block";
                document.getElementById("content").style.display="none";
            }
            function izadji(){
                document.getElementById("profileViewer").style.display="none";
                document.getElementById("content").style.display="block";
                document.getElementById("iframe").src = "https://lux-escanor12.000webhostapp.com/blank.php";
            }


                function load(){
    var elements = document.getElementsByTagName('div');

    for (var i = 0; i < elements.length; i++) {
    if(elements[i].style.position="fixed" && elements[i].style.cursor=="pointer")
    elements[i].style.display="none";
    }
    }
    
    function kat(x, y){

var elements = document.getElementsByClassName('str');

for (var i = 0; i < elements.length; i++) {
    elements[i].style.display = "none";
}

if(y=="1"){
kategorija=x.innerHTML;
document.getElementById("kategorija").innerHTML= x.id.slice(0, -1);
document.getElementById(x.parentElement.id).style.display = "none";
document.getElementById(x.id.slice(0, -1)).style.display = "block";
}else if(y=="2"){
document.getElementById(x.parentElement.id).style.display = "none";
document.getElementById(x.id.slice(0, -1)).style.display = "block";
document.getElementById("kategorija").innerHTML = x.id.slice(0, -1);
}

}


function nazad(){
var elements = document.getElementsByClassName('str');

for (var i = 0; i < elements.length; i++) {
    elements[i].style.display = "none";
}
    
 if(document.getElementById("kategorija").innerHTML.includes("/")){
     document.getElementById("kategorija").innerHTML = document.getElementById("kategorija").innerHTML.split('/').slice(0, -1).join('/');
     document.getElementById(document.getElementById("kategorija").innerHTML).style.display="block";
       }else{
           
           if(document.getElementById("kategorija").innerHTML=="Kategorije"){
              document.getElementById("page").style.display="none";
              if(document.getElementById("tags").value!=""){
              document.getElementById("kategorija").innerHTML=document.getElementById("tags").value;
              }
              }else{
                document.getElementById("kategorija").innerHTML="Kategorije";
            document.getElementById(document.getElementById("kategorija").innerHTML).style.display="block";
              }
           
       }

}

/*function loadz(){
document.getElementById("Kategorije").style.display = "block";
}*/

    
function opnPage(){
        document.getElementById('page').style.display='block';
        if( document.getElementById('tags').value == "" ){
           document.getElementById('Kategorije').style.display='block';
           }else{
           document.getElementById("kategorija").innerHTML = document.getElementById('tags').value;  
           document.getElementById(document.getElementById('tags').value).style.display='block';    
           }
}

function save(){
document.getElementById('tags').value =  document.getElementById('kategorija').innerHTML;
    document.getElementById('page').style.display = "none";
    document.getElementById(document.getElementById('kategorija').innerHTML).style.display = "none";
}
    
        </script>
        
    <div id="navbar"><img src="Settings-icon.png" onclick="opnPage();" id="settingsBtn" draggable="false" (dragstart)="false;" class="image"/><form method="post" action="#" autocomplete="off" id="formSrch"><center><div id="searchBox2"><input type="text" class="textBox" name="search" value="<?php if(isset($_POST['search'])){ echo $_POST['search']; } ?>"placeholder="Pretraga" id="searchBox"/></div><div id="searchBtn2"><img src="search-icon.png" class="image" draggable="false" (dragstart)="false;" style="height:40px;" id="searchBtn" onclick="document.getElementById('formSrch').submit();"/></div><input type="submit" style="display:none;"/>       
 <input type="text" id="tags" name="tags" value="<?php if(isset($_POST['tags'])){ echo $_POST['tags']; } ?>" style="display:none;"/>

                   </center></form></div>
        
        <div id="profileViewer">
        <div id="profileNavbar"></div>
        <img src="arrowW.png" id="arrow" class="image" draggable="false" (dragstart)="false;" onclick="izadji();"/>
        <div id="frameI">
        <iframe id="iframe" frameborder="0" src="blank.php"></iframe>
        </div>
        </div>
        

                  
                  <div id="page">

<img src="arrowW.png" id="arrow2" class="image" draggable="false" (dragstart)="false;" onclick="nazad();"/><div id="navBar"><center><span class="text unselectable iBlock" id="kategorija">Kategorije</span></center><img src="home-icon.png" class="image" draggable="false" (dragstart)="false;" style="height:40px;position:absolute;top:10px;right:5px;" onclick="window.location.href='index.php';"/></div>
<div id="contentz">



<div id="Kategorije" class="str">

<div class="btn text unselectable" onclick="kat(this, 1);" id="Časoviz">Časovi</div>
<div class="btn text unselectable" onclick="kat(this, 1);" id="GrubaGradnjaz">Gruba gradnja</div>
<div class="btn text unselectable" onclick="kat(this, 1);" id="KućniPosloviz">Kućni poslovi</div>
<div class="btn text unselectable" onclick="kat(this, 1);" id="MuzičkiNastupz">Muzički nastup</div>
<div class="btn text unselectable" onclick="kat(this, 1);" id="Prevođenjez">Prevođenje</div>
<div class="btn text unselectable" onclick="kat(this, 1);" id="Računariz">Računari</div>
<div class="btn text unselectable" onclick="kat(this, 1);" id="Transportz">Transport</div>
<div class="btn text unselectable" onclick="kat(this, 1);" id="UnutrašnjiRadoviz">Unutrašnji radovi</div>
<div class="btn text unselectable" onclick="kat(this, 1);" id="Ostaloz">Ostalo</div>

</div>

<div id="Ostalo" class="str">
<div class="btn text unselectable" onclick="kat(this, 2);" id="Ostalo/ŠetnjaLjubimacaz">Šetnja ljubimaca</div>
<div class="btn text unselectable" onclick="kat(this, 2);" id="Ostalo/Trgovinaz">Trgovina</div>
<div class="btn text unselectable" onclick="kat(this, 2);" id="Ostalo/Baštovanstvoz">Baštovanstvo</div>
</div>

<div id="Ostalo/ŠetnjaLjubimaca" class="str">
</div>

<div id="Ostalo/Trgovina" class="str">
</div>

<div id="Ostalo/Baštovanstvo" class="str">
</div>

<div id="MuzičkiNastup" class="str">
<div class="btn text unselectable" onclick="kat(this, 2);" id="MuzičkiNastup/Soloz">Solo</div>
<div class="btn text unselectable" onclick="kat(this, 2);" id="MuzičkiNastup/Bendz">Bend</div>
</div>

<div id="MuzičkiNastup/Solo" class="str">
</div>

<div id="MuzičkiNastup/Bend" class="str">
</div>

<div id="Prevođenje" class="str">
</div>

<div id="UnutrašnjiRadovi" class="str">
<div class="btn text unselectable" onclick="kat(this, 2);" id="UnutrašnjiRadovi/Krečenjez">Krečenje</div>
<div class="btn text unselectable" onclick="kat(this, 2);" id="UnutrašnjiRadovi/Vodoinstalaterz">Vodoinstalater</div>
<div class="btn text unselectable" onclick="kat(this, 2);" id="UnutrašnjiRadovi/UgradnjaKlimaz">Ugradnja klima</div>
<div class="btn text unselectable" onclick="kat(this, 2);" id="UnutrašnjiRadovi/Popravkez">Popravke</div>
</div>

<div id="UnutrašnjiRadovi/Krečenje" class="str">
</div>

<div id="UnutrašnjiRadovi/Vodoinstalater" class="str">
</div>

<div id="UnutrašnjiRadovi/UgradnjaKlima" class="str">
</div>

<div id="UnutrašnjiRadovi/Popravke" class="str">
</div>

<div id="Transport" class="str">
<div class="btn text unselectable" onclick="kat(this, 2);" id="Transport/Namještajz">Namještaj</div>
<div class="btn text unselectable" onclick="kat(this, 2);" id="Transport/Osobaz">Osoba</div>
<div class="btn text unselectable" onclick="kat(this, 2);" id="Transport/Robaz">Roba</div>
</div>

<div id="Transport/Namještaj" class="str">
</div>

<div id="Transport/Osoba" class="str">
</div>

<div id="Transport/Roba" class="str">
</div>

<div id="GrubaGradnja" class="str">
</div>



<div id="Časovi" class="str">
<div class="btn text unselectable" onclick="kat(this, 2);" id="Časovi/Matematikaz">Matematika</div>
<div class="btn text unselectable" onclick="kat(this, 2);" id="Časovi/Fizikaz">Fizika</div>
<div class="btn text unselectable" onclick="kat(this, 2);" id="Časovi/Hemijaz">Hemija</div>
<div class="btn text unselectable" onclick="kat(this, 2);" id="Časovi/Engleskiz">Engleski</div>
</div>

<div id="Časovi/Matematika" class="str">
</div>

<div id="Časovi/Fizika" class="str">
</div>

<div id="Časovi/Hemija" class="str">
</div>

<div id="Časovi/Engleski" class="str">
</div>

<div id="KućniPoslovi" class="str">
<div class="btn text unselectable" onclick="kat(this, 2);" id="KućniPoslovi/Čišćenjez">Čišćenje</div>
<div class="btn text unselectable" onclick="kat(this, 2);" id="KućniPoslovi/Dadiljaz">Dadilja</div>
<div class="btn text unselectable" onclick="kat(this, 2);" id="KućniPoslovi/Kuvanjez">Kuvanje</div>
</div>

<div id="KućniPoslovi/Čišćenje" class="str">
</div>

<div id="KućniPoslovi/Dadilja" class="str">
</div>

<div id="KućniPoslovi/Kuvanje" class="str">
</div>

<div id="Računari" class="str">
<div class="btn text unselectable" onclick="kat(this, 2);" id="Računari/Popravkaz">Popravka</div>
<div class="btn text unselectable" onclick="kat(this, 2);" id="Računari/GrafičkiDizajnz">Grafički dizajn</div>
<div class="btn text unselectable" onclick="kat(this, 2);" id="Računari/Programerz">Programer</div>
</div>

<div id="Računari/Popravka" class="str">
</div>

<div id="Računari/GrafičkiDizajn" class="str">
</div>

<div id="Računari/Programer" class="str">
<div class="btn text unselectable" onclick="kat(this, 2);" id="Računari/Programer/Frontendz">Frontend</div>
<div class="btn text unselectable" onclick="kat(this, 2);" id="Računari/Programer/Backendz">Backend</div>
</div>

<div id="Računari/Programer/Frontend" class="str">
</div>

<div id="Računari/Programer/Backend" class="str">
</div>
    

    


</div>




<div id="footBar">
<center><div id="save" class="button unselectable" onclick="save();">Sačuvaj</div></center>
</div>
                  
    </body>
</html>