<?php

   function crearProductos(){
       $PRODUCTOS = getJSON('./productos.json');
        foreach($PRODUCTOS as $producto){
            echo "<a class='producto' href='#'>";
            echo "<img src='{$producto['imagen_small']}' alt='{$producto['nombre']}'>";
            echo "<p class='nombre'>{$producto['nombre']}</p>";
            echo "<p class='descripcion'>{$producto['descripcion']}</p>";
            echo "<p class='precio'>{$producto['precio']} €</p>";
            echo "</a>";
        }
   }

   function getJSON($file){
        $DATOS = file_get_contents($file);
        return json_decode($DATOS,true);
   }

   

   
   



?>