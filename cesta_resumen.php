<?php
include_once 'funciones.php';

$cesta =  $_POST;

foreach($cesta as $idProducto => $cantidad){
    $_SESSION["productos_carro"][$idProducto] = $cantidad;
}






?>