<!DOCTYPE html>
<html>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>

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

.header{
font-family:Impact, Charcoal, sans-serif;
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

.msg{
color:red;
}

a {
    color: black;
    text-decoration: underline;
}

.images{

display:inline-block;
max-width:64px;
margin-left:10px;
margin-right:10px;
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

.image{
user-drag: none; 
user-select: none;
-moz-user-select: none;
-webkit-user-drag: none;
-webkit-user-select: none;
-ms-user-select: none;
}

.str{
display:none;
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

#navBar{
position:absolute;
top:0px;
left:0px;
width:100%;
height:40px;
line-height:40px;
color:white;
background-color:black;
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

#content{
position:absolute;
bottom:60px;
top:40px;
left:0px;
width:100%;
overflow:auto;
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

#arrow{
position:absolute;
height:40px;
top:0px;
left:0px;
z-index:5;
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
    
    #kategorijaAlert{
        color:red;
        display:none;
        font-size:20px;
    }
    
</style>

</head>

<body onload="loadz(); load();">

<script>

var kategorija = "";

function imgChange(x){

if(x==1){
document.getElementById("img1").style.backgroundColor="lightgray";
document.getElementById("img2").style.backgroundColor="white";
document.getElementById("usluge").innerHTML="Tražim usluge";
document.getElementById("kat").style.display = "none";
document.getElementById("tipNum").value = 0;
}else if(x==2){
document.getElementById("img1").style.backgroundColor="white";
document.getElementById("img2").style.backgroundColor="lightgray";
document.getElementById("usluge").innerHTML="Nudim usluge";
document.getElementById("kat").style.display = "block";
document.getElementById("tipNum").value = 1;
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
              }else{
                document.getElementById("kategorija").innerHTML="Kategorije";
            document.getElementById(document.getElementById("kategorija").innerHTML).style.display="block";
              }
           
       }

}

function loadz(){
document.getElementById("Kategorije").style.display = "block";
}

    
function opnPage(){
        document.getElementById('page').style.display='block';
        if( document.getElementById('kat').innerHTML == "Izaberite kategoriju" ){
           document.getElementById('Kategorije').style.display='block';
           }else{
           document.getElementById(document.getElementById('kat').innerHTML).style.display='block';    
           }
}

    
function save(){
    document.getElementById('kat').innerHTML =  document.getElementById('kategorija').innerHTML;
document.getElementById('tags').value =  document.getElementById('kategorija').innerHTML;
    document.getElementById('page').style.display = "none";
    document.getElementById(document.getElementById('kategorija').innerHTML).style.display = "none";
}

function submit(){
if(document.getElementById('tipNum').value=="1" || document.getElementById('tipNum').value==1){
if(document.getElementById('tags').value=="" || document.getElementById('tags').value==null || document.getElementById('tags').value=="Kategorije"){
document.getElementById("kategorijaAlert").style.display="block";
}else{
document.getElementById('submit').click();
}
}else{
document.getElementById('submit').click();
}
}
    
        function load(){
    var elements = document.getElementsByTagName('div');

    for (var i = 0; i < elements.length; i++) {
    if(elements[i].style.position="fixed" && elements[i].style.cursor=="pointer")
    elements[i].style.display="none";
    }
    }
</script>

<center>

<i><h1 class="unselectable header">Lux</h1></i>

<form action="create.php" method="post">
<p><input type="text" name="Username" class="textBox" placeholder="Korisničko ime" value="<?php if(isset($_GET['u'])){ echo $_GET['u']; }else{ echo ''; } ?>"/></p>
<p><input type="text" class="textBox" name="Email" placeholder="Email"/></p>
<p><input type="password" name="Password" class="textBox" placeholder="Lozinka"/></p>
<input type="submit" name="Submit" id="submit" value="Create" style="display:none;"/>
<p><img id="img1" onclick="imgChange(1);" draggable="false" (dragstart)="false;" src="money.png" class="images" style="background-color:lightgray;"/><img draggable="false" (dragstart)="false;" src="worker.png" class="images" id="img2" onclick="imgChange(2);"/></p>
<p><span class="texts" id="usluge">Tražim usluge</span></p>
    <p><div class="text unselectable" id="kat" onclick="opnPage();">Izaberite kategoriju</div></p>
    <div id="kategorijaAlert"><p>Molimo vas da izaberete kategoriju</p></div>
<p><div class="unselectable button" onclick="submit();">Napravi nalog!</div></p>
<input type="number" name="tipNum" id="tipNum" value="0" style="display:none;"/>
<input type="text" id="tags" name="tags" value="" style="display:none;"/>
</form>

<p><a href="logIn.php" class="texts unselectable">Prijavi se na postojeći nalog</a></p>

<?php
if(isset($_GET["q"])){

if($_GET["q"]=="ANAE"){
echo '<span class="msg text unselectable">Korisničko ime je zauzeto.</span>';
}

}
?>

</center>

<div id="page">

<img src="arrowW.png" id="arrow" class="image" draggable="false" (dragstart)="false;" onclick="nazad();"/><div id="navBar"><center><span class="text unselectable iBlock" id="kategorija">Kategorije</span></center></div>
<div id="content">


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

</div>

</body>
</html>