<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cámara Nikon</title>
    <link rel="stylesheet" href="estilos/estilos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripts/index.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<header>
    <a href='index.php'><p>telo<span>COMPRO</span></p></a>
    <a href="carrito.php" class='icono_carro'><i class="fas fa-shopping-cart"></i></a> 
</header>
<a href="index.php"><i class="fas fa-chevron-left"></i></a>
    <section class="individual">
    <?php
        include_once "funciones.php";
        actualizarVistos();
        mostrarProducto($PRODUCTOS,$_REQUEST["id"]);
    ?>

    </section>
    
</body>
</html>