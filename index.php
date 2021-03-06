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
    <header>
        <?php include_once "funciones.php"; ?>
        <a href='index.php'><p>telo<span>COMPRO</span></p></a>
        <?php if (isset($_COOKIE["politica"])): ?>
            <div>
                <a href="carrito.php" class='icono_carro'>
                    <i class="fas fa-shopping-cart"></i>
                </a> 
                <?php
                if(isset($_SESSION["login"])){
                    echo "<button id='logout'>Logout</button>";
                }
                ?>
            </div>
            
        <?php endif ?>
    </header>
    <div class="wrapper">
        <?php 
            
            !isset($_COOKIE["politica"]) ? mostrarPoliticaCookies($POLITICA_COOKIES) :  crearProductos($PRODUCTOS); 
        ?>
        <aside>
            <article id="vistos">
                <?php isset($_COOKIE["politica"]) ? mostrarVistos($PRODUCTOS) : ''; ?>
            </article>
            <article id="favoritos">
                <?php isset($_COOKIE["politica"]) ? mostrarFavoritos($PRODUCTOS) : '';?>
            </article>
        </aside>
        
    </div>
    <div class="permisoDenegado">
        <h1>Acceso a la página denegado</h1>
        <p>
            Debe de aceptar la política de cookies si desea navegar en nuestro sitio web. 
            Si desea reconsiderar su decisión acerda de nuestra política de cookies 
            <span id='volverPantallaCookies'>pulse aquí</span>
        </p>
    </div>
    
    
</body>
</html>