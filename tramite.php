<?php
    include_once 'funciones.php';

    if(isset($_POST) && count($_POST) > 0){
        $cesta = $_POST;
        $comprobacion =  comprobarTotal($PRODUCTOS,$cesta);
        echo $comprobacion; // Esto devuelve a javaScript el total que debería de ser para comparar con el total que recibimos
    }
    
    

?>