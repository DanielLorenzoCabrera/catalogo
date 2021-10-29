<?php

$POLITICA_COOKIES = "<p> Las cookies de este sitio web se usan para personalizar el contenido y los anuncios, ofrecer funciones de redes sociales y analizar el tráfico. Además, compartimos información sobre el uso que haga del sitio web con nuestros partners de redes sociales, publicidad y análisis web, quienes pueden combinarla con otra información que les haya proporcionado o que hayan recopilado a partir del uso que haya hecho de sus servicios.</p>";

   function crearProductos(){
       $PRODUCTOS = getJSON('./productos.json');
       echo "<div class='wrapper'>";
        foreach($PRODUCTOS as $producto){
            echo "<div class='producto' >";
            echo "<img src='{$producto['imagen_small']}' alt='{$producto['nombre']}'>";
            echo "<p class='precio'>{$producto['precio']} € </p>";
            echo "<i class='far fa-heart'></i>";
            echo "<p class='nombre'>{$producto['nombre']}</p>";
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

   

?>