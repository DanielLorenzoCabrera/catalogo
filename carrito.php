<?php
session_start();

$id = $_REQUEST["id"];

if(!isset($_SESSION["productos"])){
    $_SESSION["productos_carro"] = [];
}

$_SESSION["productos_carro"][$id] = [];









?>