<?php
session_start();

$POLITICA_COOKIES = "<p> Las cookies de este sitio web se usan para personalizar el contenido y los anuncios, ofrecer funciones de redes sociales y analizar el tráfico. Además, compartimos información sobre el uso que haga del sitio web con nuestros partners de redes sociales, publicidad y análisis web, quienes pueden combinarla con otra información que les haya proporcionado o que hayan recopilado a partir del uso que haya hecho de sus servicios.</p>";

$PRODUCTOS = getJSON('./json/productos.json');
$PAISES =  getJSON('./json/paises.json');
$PROVINCIAS = getJSON('./json/provincias.json');
$MUNICIPIOS = getJSON('./json/municipios.json');
$TIPOS_VIA = getJSON('./json/tipos_via.json');


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
    echo "<input type='password' name='password' placeholder='password'>";
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
            echo "<article class='producto_carro' data-id='{$clave}'>";
            echo "<img src='{$PRODUCTOS[$clave]['imagen_small']}'>";
            echo "<p class='nombre'>{$PRODUCTOS[$clave]['nombre']}</p>";
            echo "<section>";
            echo "<p class='precio'>{$PRODUCTOS[$clave]['precio']}€</p>";
            echo "Cantidad:<input type='number' class='cantidadProducto' min='1' value='1' required>";
            echo "<button class='eliminarProducto' data-id='{$clave}'>eliminar</button>";
            echo "</section>";
            echo "</article>";
        }
        echo "</div>";
        echo "<div id='resumen'>";
        echo "<p>Subtotal : <span id='subtotal'></span></p>";
        echo "<p>Gastos de envío : <span id='gastos_envio'></span> </p>";
        echo "<p>Total: <span id='total'></span></p>";
        echo "</div>";
        echo "<a href='tramite.php' id='tramitar'>Tramitar pedido</a>";
        
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


function comprobarTotal($PRODUCTOS,$cesta){
    $total = 0;
    foreach($cesta as $id => $cantidad){
        $total += ($PRODUCTOS[$id]['precio'] * $cantidad);
        
    }
    $total < 500 ? $total += ($total * 0.1) : '';
    return $total;
}



function mostrarTramite($PAISES, $PROVINCIAS, $MUNICIPIOS, $TIPOS_VIA){
    echo "<form action='{$_SERVER['PHP_SELF']}' method='GET'>";
    echo "<fieldset> <legend>Persona de contacto</legend>";
    echo "<p>Nombre* <input type='text' name='nombre' value='".devolverValorAnterior('nombre') ."' required></p>";
    echo "<p>Primer Apellido* <input type='text' name='apellido1' value='".devolverValorAnterior('apellido1') ."' required></p>";
    echo "<p>Segundo Apellido* <input type='text' name='apellido2' value='".devolverValorAnterior('apellido2') ."' required></p>";
    echo "<p>Teléfono *<input type='text' name='telefono' value='".devolverValorAnterior('telefono') ."'></p>";
    echo "<p>Indicaciones extra <textarea name='indicaciones' rows='10' cols='50'></textarea> </p>";
    echo "</fieldset><fieldset> <legend>Datos principales</legend>";
    crearSelect($PAISES,'paises', 'name_es', 'code','País');
    crearSelect($PROVINCIAS,'provincias', 'nm' , 'id' ,'Provincia');
    crearSelect($MUNICIPIOS,'municipios', 'nombre','municipio_id' ,'Municipio');
    echo "<p>Código Postal* <input type='text' name='codigo_postal' value='".devolverValorAnterior('codigo_postal') ."''></p>";
    crearSelect($TIPOS_VIA,'via', 'tipo','tipo' ,'Tipo via');
    echo "<p>Nombre via* <input type='text' name='nombre_via' value='".devolverValorAnterior('nombre_via') ."''></p>";
    echo "<div class='botones'>";
    echo "<a href='carrito.php'><input type='button' value='volver'></a>";
    echo "<input type='submit' value='comprar'>";
    echo "</div>";
    echo "</fieldset></form>";

}

function devolverValorAnterior($campo){
    if(isset($_REQUEST[$campo])){
        return $_REQUEST[$campo];
    }
    return '';
}


function crearSelect($array, $nombreSelect, $nombreOption, $idOption, $label){
    echo "<section>";
    echo "<label for='{$nombreSelect}'>{$label}*</label>";
    echo "<select name='{$nombreSelect}' id='{$nombreSelect}'>";
    foreach($array as $elemento) { 
        echo "<option value='{$elemento[$idOption]}'> {$elemento[$nombreOption]}</option>"; 
    }
    echo "</select>";
    echo "</section>";
}
   

function camposObligatoriosVacios($campos){
    $datosRecibidos =  $_GET;
    $camposVacios = [];
    foreach($campos as $clave => $campo){
       if(!array_key_exists($clave,$datosRecibidos) || empty($datosRecibidos[$clave]) ){
           array_push($camposVacios,"<p class='error'>El campo <span>{$clave}</span> esta vacío</p>");
       }
    }
    return $camposVacios;
}

function comprobarCamposObligatorios(){
    $datosRecibidos =  $_GET;
    $camposErroneos = [];
    foreach($datosRecibidos as $clave => $dato){
        $dato = htmlspecialchars(trim($dato));
        switch($clave){
            case "nombre":
                comprobarString($dato,3,20) ? '' : array_push($camposErroneos,"<p class='error'>El campo <span>{$clave}</span> es incorrecto</p>");
                break;
            case "apellido1":
                comprobarString($dato,3,20) ? '' : array_push($camposErroneos,"<p class='error'>El campo <span>{$clave}</span> es incorrecto</p>");
                break;
            case "telefono":
                is_numeric($dato) && strlen($dato) >= 7 && strlen($dato) <= 15  ? '' : array_push($camposErroneos,"<p class='error'>Introduce un <span>{$clave}</span> correcto</p>");
                break;
            case "codigo_postal":
                is_numeric($dato) && ctype_digit($dato) && strlen($dato) === 5 ? ' ' : array_push($camposErroneos,"<p class='error'>Introduce un <span>{$clave}</span> válido</p>");
                break;
            case "nombre_via":
                comprobarString($dato,3,20) ? '' : array_push($camposErroneos,"<p class='error'>El campo <span>{$clave}</span> es incorrecto</p>");
                break;
        }
    }
    return $camposErroneos;
    
}



function comprobarString($texto,$minLength,$maxLength){

    if(strlen($texto) < $minLength || strlen($texto) > $maxLength){
        return false;
    }
    
    for($i = 0 ; $i < strlen($texto); $i++){
        if(ctype_digit($texto[$i])){
            return false;
        }
    }
    return true;
}



function mostrarFallosCampos($array){
    foreach($array as $elemento){
        echo $elemento;
    }
}


function vaciarCarrito(){
    if(isset($_SESSION["productos_carro"])){
        unset($_SESSION["productos_carro"]);
    }
}

function compraRealizada(){
    echo "<div class='compra_realizada'>";
    echo "<p> Su compra se ha tramitado satisfactoriamente </p>";
    echo "<a href='index.php'>Volver a la página principal</a>";
    echo "</div>";
}

?>

