<?php

$CAMPOS_OBLIGATORIOS = [
    "nombre" => "",
    "apellido1" => "",
    "telefono" => "",
    "pais" => "",
    "provincia" => "",
    "municipio" => "",
    "codigo_postal" => "",
    "via" => "",
    "nombre_via" => ""
];


    include_once 'funciones.php';

    if(isset($_POST) && count($_POST) > 0){
        $cesta = $_POST;
        $comprobacion =  comprobarTotal($PRODUCTOS,$cesta);
        echo $comprobacion; // Esto devuelve a javaScript el total que debería de ser para comparar con el total que recibimos
    }else if(isset($_GET) && count($_GET) > 0){
        $camposVacios = camposObligatoriosVacios($CAMPOS_OBLIGATORIOS);
        if(count($camposVacios) > 0){
            foreach($camposVacios as $campo){
                echo $campo;
            }
        }
         
        
    }else{
        isset($_GET) ? comprobarCamposObligatorios() :  mostrarTramite($PAISES, $PROVINCIAS, $MUNICIPIOS,$TIPOS_VIA);

    }
    
    

?>