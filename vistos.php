<?php

    include_once "funciones.php";
    var_dump($PRODUCTOS);

    function actualizarVistos(){
        $id_producto = "id" . $_REQUEST["id"];

        if(isset($_COOKIE["vistos"]) && $_COOKIE["vistos"] !== ""){
            $contenido = json_decode($_COOKIE["vistos"],true) ;
            isset($contenido[$id_producto]) && !empty($contenido[$id_producto]) ? $contenido[$id_producto]++ : $contenido[$id_producto] = 1;
            $resultado = json_encode($contenido);
            setcookie("vistos", $resultado, time() + 3600);
            var_dump($_COOKIE["vistos"]);
        }else{
            $contenido[$id_producto] = "1";
            $resultado = json_encode($contenido);
            setcookie("vistos", $resultado, time() + 3600);
        }

    }
/*
    $id_producto = "id" . $_REQUEST["id"];

    if(isset($_COOKIE["vistos"]) && $_COOKIE["vistos"] !== ""){
        $contenido = json_decode($_COOKIE["vistos"],true) ;
        isset($contenido[$id_producto]) && !empty($contenido[$id_producto]) ? $contenido[$id_producto]++ : $contenido[$id_producto] = 1;
        $resultado = json_encode($contenido);
        setcookie("vistos", $resultado, time() + 3600);
        var_dump($_COOKIE["vistos"]);
    }else{
        $contenido[$id_producto] = "1";
        $resultado = json_encode($contenido);
        setcookie("vistos", $resultado, time() + 3600);
    }

    

    mostrarProducto($PRODUCTOS,$_REQUEST["id"]);
    */

?>