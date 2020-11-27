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
-webkit-user-select: none; /* Safari */        
-moz-user-select: none; /* Firefox */
-ms-user-select: none; /* IE10+/Edge */
user-select: none; /* Standard */
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

#sve{
    margin-top:100px;
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
    
    }
</script>

<center>

<div id="sve">
<i><h1 class="unselectable header">Lux</h1></i>

<form action="checkLogIn.php" method="post" autocomplete="off">
<p><input type="text" name="Username" placeholder="Korisničko ime" class="textBox" value="<?php if(isset($_GET['u'])){ echo $_GET['u']; }else{ echo ''; } ?>"/></p>
<p><input type="password" name="Password" placeholder="Lozinka" class="textBox"/></p>
<p><div style="display:none;"><input type="checkbox" name="stayLogged" id="logged" value="logged" checked/><span class="text unselectable" unselectable="on" onclick="document.getElementById('logged').click();"> Zapamti nalog</span></div></p>
<input type="submit" name="Submit" id="Submit" value="Create" style="display:none;"/>
<p><div class="button unselectable" onclick="document.getElementById('Submit').click();"><span>Prijavi se!</span></div></p>
</form>

<p><a href="signUp.php" class="texts">Napravi nalog</a><br>
<a href="changePass.php" class="texts">Zaboravljena lozinka</a></p>
</div>

</center>

</body>
</html>

<?php

if(isset($_GET["q"])){

if($_GET["q"]=="IP"){
echo '<center><p><span class="msg texts unselectable">Unijeli ste pogrešan pasvord.</span></p></center>';
}else if($_GET["q"]=="AN"){
echo '<center><p><span class="msg texts unselectable">Unijeli ste nepostojeće korisničko ime.</span></p></center>';
}

}

?>