<?php
session_start();

$POLITICA_COOKIES = "<p> Las cookies de este sitio web se usan para personalizar el contenido y los anuncios, ofrecer funciones de redes sociales y analizar el tráfico. Además, compartimos información sobre el uso que haga del sitio web con nuestros partners de redes sociales, publicidad y análisis web, quienes pueden combinarla con otra información que les haya proporcionado o que hayan recopilado a partir del uso que haya hecho de sus servicios.</p>";

$PRODUCTOS = getJSON('./productos.json');


   function crearProductos($PRODUCTOS){
       echo "<div class='productos'>";
       echo "<h1>Productos</h1>";
        foreach($PRODUCTOS as $producto){
            echo "<div class='producto' >";
            echo "<a href='{$producto['nombre_ruta']}?id={$producto['id']}'><img src='{$producto['imagen_small']}' alt='{$producto['nombre']}'></a>";
            echo "<section>";
            echo "<p class='precio'>{$producto['precio']} € </p>";
            $clase_corazon = actualizarCorazon($producto['id']);
            echo "<i class='fa-heart {$clase_corazon}' data-id='{$producto['id']}'></i>";
            echo "</section>";
            echo "<a href='{$producto['nombre_ruta']}?id={$producto['id']}' class='nombre'>{$producto['nombre']}</a>";
            echo "<p class='descripcion'>{$producto['descripcion']}</p>";
            $clase_agregado =  actualizarAgregados($producto["id"]);
            $agregado = actualizarAgregados($producto["id"]) === "" ? "Agregar producto" : "En carrito";
            echo "<button class='agregarProducto {$clase_agregado}' data-id='{$producto['id']}' >{$agregado}</button>";
            echo "</div>";
        }
        echo "</div>";
   }

   function getJSON($file){
        $DATOS = file_get_contents($file);
        return json_decode($DATOS,true);
   }

   function mostrarPoliticaCookies($POLITICA_COOKIES){
        echo "<div class='politica'>";
        echo "<h1>Esta pagina web utiliza cookies</h1>";
        echo $POLITICA_COOKIES;
        echo "<a href='index.php?politica=true' id='aceptar'>Aceptar</a>";
        echo "<a href='permisoDenegado.php' id='rechazar'>Rechazar</a>";
        echo "</div>";
   }


   function actualizarVistos(){
     $id_producto = "id" . $_REQUEST["id"];

     if(isset($_COOKIE["vistos"]) && $_COOKIE["vistos"] !== ""){
         $contenido = json_decode($_COOKIE["vistos"],true) ;
         isset($contenido[$id_producto]) && !empty($contenido[$id_producto]) ? $contenido[$id_producto]++ : $contenido[$id_producto] = 1;
         $resultado = json_encode($contenido);
         setcookie("vistos", $resultado, time() + 3600);
     }else{
         $contenido[$id_producto] = "1";
         $resultado = json_encode($contenido);
         setcookie("vistos", $resultado, time() + 3600);
     }

 }

   
   function mostrarProducto($PRODUCTOS,$id_producto){
     $producto = $PRODUCTOS[$id_producto];
    
     echo "<article id='articulo_{$id_producto}' >";
     echo "<img src='{$producto['imagen_small']}' alt='{$producto['nombre']}'>";
     echo "<section class='descripcion'>";
     echo "<p class='precio'>{$producto['precio']} € </p>";
     $clase_corazon = actualizarCorazon($producto['id']);
     echo "<i class='fa-heart {$clase_corazon}' data-id='{$producto['id']}'></i>";
     echo "<p class='nombre'>{$producto['nombre']}</p>";
     echo "<p class='descripcion'>{$producto['descripcion']}</p>";
     echo "</section>";
     echo "</article>";
     
 }

 function mostrarVistos($PRODUCTOS){
    if(isset($_COOKIE["vistos"])){
        $vistos = json_decode($_COOKIE["vistos"],true);
        echo "<h2>Productos vistos</h2>";
        foreach($vistos as $clave => $visto){
            echo "<section>";
            $producto= $PRODUCTOS[substr($clave,-1,1)];
            echo "<a href='{$producto['nombre_ruta']}?id={$producto['id']}'><img src='{$producto['imagen_small']}'></a>";
            echo "<a href='{$producto['nombre_ruta']}?id={$producto['id']}'>{$producto['nombre']}</a>";
            echo "<span class='precio'>{$producto['precio']} €</span>";
            echo "<span class='numero_vistas'>Veces visto: {$visto}</span>";
            echo "</section>";
        }
    }
 }


 function mostrarFavoritos($PRODUCTOS){
   if(isset($_COOKIE["favoritos"])){
       $favoritos = json_decode($_COOKIE["favoritos"],true);
       echo "<h2>Productos favoritos</h2>";
       foreach($favoritos as $clave => $favorito){
           echo "<section>";
           $producto = $PRODUCTOS[$clave];
           echo "<a href='{$producto['nombre_ruta']}?id={$producto['id']}'><img src='{$producto['imagen_small']}'></a>";
           echo "<a href='{$producto['nombre_ruta']}?id={$producto['id']}'>{$producto['nombre']}</a>";
           echo "<span>{$producto['precio']} €</span>";
           echo "</section>";
       }
   }
}
   

function actualizarCorazon($id_producto){
    $resultado = 'far';
    if(isset($_COOKIE["favoritos"])){
        $favoritos = json_decode($_COOKIE["favoritos"],true);
        $resultado = array_key_exists($id_producto,$favoritos) ? "fas" : "far";
    }
    return $resultado;
}



function actualizarAgregados($id_producto){
    $resultado = '';
    if(isset($_SESSION["productos_carro"])){
        array_key_exists($id_producto, $_SESSION["productos_carro"]) ? $resultado = "productoAgregado" : "";
    }
    return $resultado;
}




function solicitarLogin(){
    echo "<form action='{$_SERVER['PHP_SELF']}' method='post'>";
    echo "<h1>Iniciar sesión</h1>";
    echo "<input type='text' name='usuario' placeholder='usuario'>";
    echo "<input type='text' name='password' placeholder='password'>";
    echo "<input type='submit'>";
    echo "</form>";
}


function mostrarProductosCarro($PRODUCTOS){
    $hayProductosCarro =  isset($_SESSION["productos_carro"]) && count($_SESSION["productos_carro"]) > 0 ? true : false;
    if($hayProductosCarro){
        echo "<div id='productos_carro'>";
        echo "<h1>Carrito de la compra</h1>";
        $productosCarro =  $_SESSION["productos_carro"];
        foreach($productosCarro as $clave => $producto){
            echo "<article class='producto_carro'>";
            echo "<img src='{$PRODUCTOS[$clave]['imagen_small']}'>";
            echo "<p class='nombre'>{$PRODUCTOS[$clave]['nombre']}</p>";
            echo "<section>";
            echo "<p class='precio'>{$PRODUCTOS[$clave]['precio']}€</p>";
            echo "<input type='number' name='cantidadProducto{$clave}' min='1' value='1' required>";
            echo "</section>";
            echo "</article>";
        }
        echo "</div>";
        echo "<div id='resumen'>";
        echo "<p>Subtotal : <span id='subtotal'></span></p>";
        echo "<p>Gastos de envío : <span id='gastos_envio'></span> </p>";
        echo "<p>Total: <span id='total'></span></p>";


        echo "</div>";
        
    }else{
        echo "<div class='carro_vacio'>";
        echo "<p>No hay productos en el carro</p>";
        echo "</div>";
    }

    

}



function validarFormulario(){
    if(isset($_REQUEST) && !empty($_REQUEST)){
        if($_REQUEST["usuario"] === "usuario" && $_REQUEST["password"] === "clave"){
            $_SESSION["login"] = true;
            header("Location: carrito.php");
        }else{
            echo "<p class='error'>Usuario o contraseña erróneos</p>";
        }
    }
}

?>

