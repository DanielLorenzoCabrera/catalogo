<?php

$id_producto =  $_REQUEST["id"];

if(isset($_COOKIE["favoritos"]) && $_COOKIE["favoritos"] !== ""){
    $contenido = json_decode($_COOKIE["favoritos"],true) ;
    if(isset($contenido[$id_producto]) && !empty($contenido[$id_producto])){
        unset($contenido[$id_producto]);
    }else{
        $contenido[$id_producto] = "agregado";
    }
    $resultado = json_encode($contenido);
    setcookie("favoritos", $resultado, time() + 3600);
}else{
    $contenido[$id_producto] = "agregado";
    $resultado = json_encode($contenido);
    setcookie("favoritos", $resultado, time() + 3600);
}



?>