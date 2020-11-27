<html>
    <head>
        <style>
        img {
    position: absolute;
    margin: auto;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
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
        <img src="Loading_icon.gif" width="300" />
    </body>
</html>