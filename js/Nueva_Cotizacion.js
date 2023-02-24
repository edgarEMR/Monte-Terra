$('#navigation').load("Navbar.php", function() {
    $('#titulo').text('Agregar Cotización');

    $('#crearProyecto').toggle();
    $('#crearPresupuesto').toggle();
    $('#crearCotizacion').toggle();
    $('#agregarPago').toggle();
    $('#crearCliente').toggle();
    $('#agregarAbono').toggle();
    $('#dividerTop').toggle();
    $('#agregarAportador').toggle();
    $('#agregarCredito').toggle();
    $('#agregarProveedor').toggle();
    $('#agregarPrestamo').toggle();
    $('#dividerBottom').toggle();

    $('#atras').on("click", function () {
        history.back();
    });
});

$(document).ready(function () {
    $("#inputProyecto").change(function () {
        var idProyecto = $('#inputProyecto').val();
        $.ajax({
            method: "POST",
            url: "php/Etapa_Procesos.php",
            cache: false,
            data: { accion: "obtener", id: idProyecto }
        }).done(function( result ) {
            $("#inputEtapa").empty().html(result);
        });
    });
});

(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
        }, false)
    })
})()

function sendVariables(pagina, id, name){
    var body = document.getElementsByTagName('body')[0];
    var sendID = id;
    //var sessionImagen = document.getElementById('sessionImagen').value;
    var form = document.createElement('form'); //CREATE FORM
    form.setAttribute('method','get'); //SET FORM ATTRIBUTES
    form.setAttribute('style','display:none');
    form.setAttribute('action',pagina);
    body.appendChild(form); //APPEND FORM TO BODY
    var proyectoID = document.createElement('input'); //CREATE INPUT
    proyectoID.setAttribute('type','hidden'); //SET INPUT ATTRIBUTES
    proyectoID.setAttribute('name', name);
    proyectoID.setAttribute('value',sendID);
    form.appendChild(proyectoID); //APPEND INPUT TO FORM
    form.submit(); //SUBMIT FORM
}

function getParameterByName(name, url = window.location.search) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}