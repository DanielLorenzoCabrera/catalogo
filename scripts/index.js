
$(document).ready(function(){

    // Ocultar la política de cookies y mostrar un error al rechazar las cookies
    
    $("#rechazar").click(function(event){
        event.preventDefault();
        $(".permisoDenegado").css("display","initial");
        $(".politica").css("display","none");
    }) 


    // Ocultar el error y mostrar la política de cookies

    $("#volverPantallaCookies").click(function(event){
        //event.preventDefault();
        $(".permisoDenegado").css("display","none");
        $(".politica").css("display","initial");
    }) 

    // mostrar contenido al aceptar cookies desde el fichero php
    
    $("#aceptar").click(function(event){
        //event.preventDefault();
        $.get("controlador.php").done(function(data){
            $(".politica").css("display","none");
            $(".wrapper").append(data);
            location.reload();
           
        })
    })
    

    $(".fa-heart").click(function(event){
        //event.preventDefault();
        $(this).toggleClass("far fas");
        $.post( "favoritos.php", { id: this.dataset.id} );
    })


    $(".agregarProducto").click(function(event){
        $.post("carrito.php", { id: this.dataset.id});
        $(this).addClass("productoAgregado");
        if($(this).hasClass("productoAgregado")){
            $(this).text("En carrito");
        }


    })


    


    


})

