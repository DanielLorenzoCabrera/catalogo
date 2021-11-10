const resumen = {
    subtotal : 0,
    total : 0,
    gastosEnvio : 0
}

$(document).ready(function(){

    actualizarResumen();
    $(".cantidadProducto").change(actualizarResumen);
    $(".eliminarProducto").click(eliminarProducto);

});





function actualizarResumen(){
    let productos = document.querySelectorAll(".producto_carro");
    let precioInicial = 0;
    productos.forEach(element => {
    let precio = element.querySelector(".precio");
    let valorPrecio = (precio.textContent).substring(-1,(precio.textContent).length -1);
    let cantidad =  parseInt((element.querySelector("input")).value);
    precioInicial += parseInt(valorPrecio * cantidad);

    })
    resumen.subtotal = precioInicial;
    let subtotal =  document.querySelector("#subtotal");
    let gastosEnvio =  document.querySelector("#gastos_envio");
    let total =  document.querySelector("#total");
    subtotal.innerHTML = `${resumen.subtotal}€`;
    resumen.gastosEnvio =  resumen.subtotal >= 500 ? 0 : 20 ;
    gastosEnvio.innerHTML = `${resumen.gastosEnvio}€`;
    resumen.total = resumen.subtotal + resumen.gastosEnvio;
    total.innerHTML = `${resumen.total}€`;

}


function eliminarProducto(){
    $.post( "carrito.php", { id: this.dataset.id, borrar : true});
    location.reload();
}

