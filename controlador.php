<?php
    include_once "funciones.php";

    
    !isset($_COOKIE["politica"]) ? setcookie("politica","aceptada", time() + 3600) : '';
    crearProductos($PRODUCTOS);

?>