$(document).ready(function(){
    
    $.getJSON("json/provincias.json", function (data) { 
        provincias = data;
    });
    
    $.getJSON("json/municipios.json", function (data) { 
        municipios = data;
    });
    
    
    
    $("#paises").change(function () {
        $('#provincias').empty(); 
        $('#municipios').empty();
    
        $.each(provincias, function (indice, dato) {
            if ($("#paises").val() == "ES") {
                $('#provincias').append($('<option></option>').attr('value', dato.id).text(dato.nm));
            }
        })
    })
    
    
    
    
    $("#provincias").change(function () {
        $('#municipios').empty(); // Vaciamos el contenido de municipios
    
        $.each(municipios, function (indice, dato) {
            if ($("#provincias").val() == dato.provincia_id) {
                $('#municipios').append($('<option></option>').attr('value', dato.municipio_id).text(dato.nombre));
            }
        })
    })






})



