<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito de la compra</title>
  <link rel="stylesheet" href="estilos/estilos.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="scripts/index.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
<header>
    <a href='index.php'><p>telo<span>COMPRO</span></p></a>
</header>
<a href="index.php"><i class="fas fa-chevron-left"></i></a>
  <main>
  <?php
    session_start();
    include_once 'funciones.php';
    // Entra en el if cuando llamamos a carrito.php desde el boton de añadir al carrito
    if(isset($_REQUEST["id"])){ 
      $id = $_REQUEST["id"];
      $_SESSION["productos_carro"][$id] = $id;
    }else{ // aquí entra cuando accedemos desde el carrito de la compra
      $haIniciadoSesion = isset($_SESSION["login"]) && $_SESSION["login"] === true ? true : false;
      validarFormulario();
      if(!$haIniciadoSesion){
        solicitarLogin();
      }else{
        mostrarProductosCarro($PRODUCTOS);
      }


    }
    



  ?>


  </main>
  



  
</body>
</html>
