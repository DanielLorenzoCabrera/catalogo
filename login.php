<?php
include_once 'funciones.php';

if(isset($_POST["logout"])){
    unset($_SESSION['login']);
    unset($_SESSION['productos_carro']);
    
    
}











?>