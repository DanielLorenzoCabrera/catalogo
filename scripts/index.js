
$(document).ready(function(){

    
    $("#rechazar").click(function(event){
        event.preventDefault();
        $(".permisoDenegado").css("display","initial");
        $(".politica").css("display","none");
    }) 

    $("#volverPantallaCookies").click(function(event){
        event.preventDefault();
        $(".permisoDenegado").css("display","none");
        $(".politica").css("display","initial");
    }) 
    
    $("#aceptar").click(function(event){
        event.preventDefault();
        $.get("controlador.php").done(function(data){
           $("#contenido").append(data);
           $(".politica").css("display","none");
        })


    })
    



})

