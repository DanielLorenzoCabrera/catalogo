<?php
    include_once "funciones.php";

    
    if(isset($_COOKIE["politica"])){
        crearProductos();
        
    }else{
        mostrarPoliticaCookies($POLITICA_COOKIES);
        setcookie("politica","aceptada", time() + 3600);
        

    }

    



?>