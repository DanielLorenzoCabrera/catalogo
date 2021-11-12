const resumen = {
    subtotal : 0,
    total : 0,
    gastosEnvio : 0
};

const cesta ={

};

$(document).ready(function(){
    actualizarResumen();
    $(".cantidadProducto").change(actualizarResumen);
    $(".eliminarProducto").click(eliminarProducto);
    $("#tramitar").click(tramitarCesta);

});



function actualizarResumen(){
    let productos = document.querySelectorAll(".producto_carro");
    let precioInicial = 0;
    productos.forEach(element => {
    let precio = element.querySelector(".precio");
    let valorPrecio = (precio.textContent).substring(-1,(precio.textContent).length -1);
    let cantidad =  parseInt((element.querySelector("input")).value);
    precioInicial += parseInt(valorPrecio * cantidad);
    
    cesta[`${element.dataset.id}`] = cantidad;
    })
    resumen.subtotal = precioInicial;
    let subtotal =  document.querySelector("#subtotal");
    let gastosEnvio =  document.querySelector("#gastos_envio");
    let total =  document.querySelector("#total");
    subtotal.innerHTML = `${resumen.subtotal}€`;
    resumen.gastosEnvio =  resumen.subtotal >= 500 ? 0 : (resumen.subtotal *10)/100 ;
    gastosEnvio.innerHTML = `${resumen.gastosEnvio}€`;
    resumen.total = resumen.subtotal + resumen.gastosEnvio;
    total.innerHTML = `${resumen.total}€`;
    //console.table(cesta)
}


function eliminarProducto(){
    $.get( "carrito.php", { id: this.dataset.id, borrar : true});
    location.reload();
}


function tramitarCesta(){
    $.post( "tramite.php", cesta).done(function(data){
        let total =  (document.querySelector("#total")).textContent;
        total = total.substring(0, total.length -1);
        if(total === data.trim()){
            location.href = "tramite.php";
        }else{
            $("#carro").append("<p class='error'>El precio del producto ha sido modificado, por favor evite realizar esta acción</p>");
            
        }
      
    });
}

