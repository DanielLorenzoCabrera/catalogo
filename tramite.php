<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilos.css">
    <title>Trámite</title>
</head>
<body>
<?php

    $CAMPOS_OBLIGATORIOS = [
        "nombre" => "",
        "apellido1" => "",
        "apellido2" => "",
        "telefono" => "",
        "codigo_postal" => "",
        "via" => "",
        "nombre_via" => ""
    ];


    include_once 'funciones.php';
    //Se elimina la comprobación de la modificación del precio por parte del usuario por interferir al crear el html
    /*if(isset($_POST) && count($_POST) > 0){
        $cesta = $_POST;
        $comprobacion =  comprobarTotal($PRODUCTOS,$cesta);
        echo $comprobacion; // Esto devuelve a javaScript el total que debería de ser para comparar con el total que recibimos
    }else */
    if(isset($_GET) && count($_GET) > 0){
        $camposVacios = camposObligatoriosVacios($CAMPOS_OBLIGATORIOS);
        if(count($camposVacios) > 0){
            mostrarTramite($PAISES, $PROVINCIAS, $MUNICIPIOS,$TIPOS_VIA);
            mostrarFallosCampos($camposVacios);
        }else{
            $camposErroneos = comprobarCamposObligatorios();
            if(count($camposErroneos) > 0){
                mostrarTramite($PAISES, $PROVINCIAS, $MUNICIPIOS,$TIPOS_VIA);
                mostrarFallosCampos($camposErroneos);
            }else{
                header('Location: index.php');
            } 
        }
    }else{
        mostrarTramite($PAISES, $PROVINCIAS, $MUNICIPIOS,$TIPOS_VIA);

    }
?>


    
</body>
</html>



