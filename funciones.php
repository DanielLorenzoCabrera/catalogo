<?php

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

   function politicaCookies(){

   }

   

   
   



?>