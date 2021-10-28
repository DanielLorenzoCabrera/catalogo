<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Daniel Lorenzo">
    <meta name="keywords" content="PHP, Catalogo">
    <title>Catálogo</title>
    <link rel="stylesheet" href="estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="permisoDenegado">
        <h1>Acceso a la página denegado</h1>
        <p>Debe de aceptar la política de cookies si desea navegar en nuestro sitio web. 
            Si desea reconsiderar su decisión acerda de nuestra política de cookies <span id='volverPantallaCookies'>pulse aquí</span></p>
    </div>
    <div class="politica">
        <h1>Esta pagina web utiliza cookies</h1>
        <p>
            Las cookies de este sitio web se usan para personalizar el contenido y los anuncios, ofrecer funciones de redes sociales y analizar el tráfico.
            Además, compartimos información sobre el uso que haga del sitio web con nuestros partners de redes sociales, publicidad y análisis web, 
            quienes pueden combinarla con otra información que les haya proporcionado o que hayan recopilado a partir del uso que haya hecho de sus 
            servicios.
        </p>
        <a href="index.php?politica=true">Aceptar</a>
        <a href="permisoDenegado.php">Rechazar</a>
    </div>
    <?php include_once "controlador.php" ?>

<!--<i class="fas fa-heart"></i>
<i class="far fa-heart"></i>-->
    
</body>
</html>