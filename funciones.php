<?php

$POLITICA_COOKIES = "<p> Las cookies de este sitio web se usan para personalizar el contenido y los anuncios, ofrecer funciones de redes sociales y analizar el tráfico. Además, compartimos información sobre el uso que haga del sitio web con nuestros partners de redes sociales, publicidad y análisis web, quienes pueden combinarla con otra información que les haya proporcionado o que hayan recopilado a partir del uso que haya hecho de sus servicios.</p>";

$PRODUCTOS = getJSON('./productos.json');


   function crearProductos($PRODUCTOS){
       echo "<div class='productos'>";
        foreach($PRODUCTOS as $producto){
            echo "<div class='producto' >";
            echo "<a href='{$producto['nombre_ruta']}?id={$producto['id']}'><img src='{$producto['imagen_small']}' alt='{$producto['nombre']}'></a>";
            echo "<section>";
            echo "<p class='precio'>{$producto['precio']} € </p>";
            echo "<i class='far fa-heart'></i>";
            echo "</section>";
            echo "<a href='{$producto['nombre_ruta']}?id={$producto['id']}' class='nombre'>{$producto['nombre']}</a>";
            echo "<p class='descripcion'>{$producto['descripcion']}</p>";
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
     echo "<i class='far fa-heart'></i>";
     echo "<p class='nombre'>{$producto['nombre']}</p>";
     echo "<p class='descripcion'>{$producto['descripcion']}</p>";
     echo "</section>";
     echo "</article>";
     
 }

 function mostrarVistos($PRODUCTOS){
     //var_dump($PRODUCTOS);
    if(isset($_COOKIE["vistos"])){
        $vistos = array_unique(json_decode($_COOKIE["vistos"],true));
        foreach($vistos as $clave => $visto){
    
            echo "<img src='{$PRODUCTOS[$visto]['imagen_small']}'>";
        }
    }
 }
   

?>