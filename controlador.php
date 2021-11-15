<?php
    include_once "funciones.php";

    if(!isset($_COOKIE["politica"])){
        setcookie("politica","aceptada", time() + 3600);
    }
    crearProductos($PRODUCTOS);

?>