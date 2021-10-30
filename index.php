<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Daniel Lorenzo">
    <meta name="keywords" content="PHP, Catalogo">
    <title>Catálogo</title>
    <link rel="stylesheet" href="estilos/estilos.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="scripts/index.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="wrapper">
        <?php  
        
            include_once "funciones.php" ;
            
            !isset($_COOKIE["politica"]) ? mostrarPoliticaCookies($POLITICA_COOKIES) :  crearProductos($PRODUCTOS);

            
        ?>
        <div id="contenido"></div>
        <div id="vistos"></div>
        <div class="permisoDenegado">
            <h1>Acceso a la página denegado</h1>
            <p>Debe de aceptar la política de cookies si desea navegar en nuestro sitio web. 
            Si desea reconsiderar su decisión acerda de nuestra política de cookies <span id='volverPantallaCookies'>pulse aquí</span></p>
        </div>

    </div>

    
</body>
</html>