<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripts/select.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Trámite</title>
</head>
<header>
    <a href='index.php'><p>telo<span>COMPRO</span></p></a>
</header>
<a href="carrito.php"><i class="fas fa-chevron-left"></i></a>
<body>
    <main id='tramite'>
        <?php
            include_once 'funciones.php';
            $CAMPOS_OBLIGATORIOS = [
                "nombre" => "",
                "apellido1" => "",
                "apellido2" => "",
                "telefono" => "",
                "codigo_postal" => "",
                "via" => "",
                "nombre_via" => ""
            ];
            
            
            if(isset($_GET) && count($_GET) > 0){
                $camposVacios = camposObligatoriosVacios($CAMPOS_OBLIGATORIOS);
                if(count($camposVacios) > 0){
                    crearCestaResumen($PRODUCTOS);
                    mostrarTramite($PAISES, $PROVINCIAS, $MUNICIPIOS,$TIPOS_VIA);
                    mostrarFallosCampos($camposVacios);
                }else{
                    $camposErroneos = comprobarCamposObligatorios();
                    if(count($camposErroneos) > 0){
                        crearCestaResumen($PRODUCTOS);
                        mostrarTramite($PAISES, $PROVINCIAS, $MUNICIPIOS,$TIPOS_VIA);
                        mostrarFallosCampos($camposErroneos);
                    }else{
                        vaciarCarrito();
                        compraRealizada();
                    } 
                }
            }else{
                crearCestaResumen($PRODUCTOS);
                mostrarTramite($PAISES, $PROVINCIAS, $MUNICIPIOS,$TIPOS_VIA);
            }
        ?>

</main>
    
</body>
</html>



