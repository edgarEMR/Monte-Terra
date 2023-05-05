$('#navigation').load("Navbar.php", function() {
    $('#titulo').text('Movimientos');

    $('#crearProyecto').toggle();
    $('#agregarPago').toggle();
    $('#crearPresupuesto').toggle();
    $('#crearCotizacion').toggle();
    $('#crearCliente').toggle();
    $('#agregarAbono').toggle();
    $('#dividerTop').toggle();

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

    $("#inputProyectoEg").change(function () {
        var idProyecto = $('#inputProyectoEg').val();
        $.ajax({
            method: "POST",
            url: "php/Etapa_Procesos.php",
            cache: false,
            data: { accion: "obtener", id: idProyecto }
        }).done(function( result ) {
            $("#inputEtapaEg").empty().html(result);
        });
    });

    $("#inputProyectoMaq").change(function () {
        var idProyecto = $('#inputProyectoMaq').val();
        $.ajax({
            method: "POST",
            url: "php/Etapa_Procesos.php",
            cache: false,
            data: { accion: "obtener", id: idProyecto }
        }).done(function( result ) {
            $("#inputEtapaMaq").empty().html(result);
        });
    });

    $("#divAportador").hide();
    $("#divCliente").hide();

    $("#divProveedor").hide();
    $("#divAportadorEg").hide();
    $("#divClienteEg").hide();
    
    switch ($("#idTipoArea").text()) {
        case '0':
            $("#ingreso-tab").addClass('active');
            $("#ingreso-tab-pane").addClass('show active');
            break;

        case '1':
            if ($("#idEsIngreso").text() === '1') {
                $("#ingreso-tab").addClass('active');
                $("#ingreso-tab-pane").addClass('show active');

                $("#egreso-tab").prop('disabled', true);
                $("#general-tab").prop('disabled', true);
                
                checkIngreso();
            } else {
                $("#egreso-tab").addClass('active');
                $("#egreso-tab-pane").addClass('show active');

                $("#ingreso-tab").prop('disabled', true);
                $("#general-tab").prop('disabled', true);
                
                checkEgreso();
            }
            break;
            
        case '2':
            $("#general-tab").addClass('active');
            $("#general-tab-pane").addClass('show active');

            $("#ingreso-tab").prop('disabled', true);
            $("#egreso-tab").prop('disabled', true);
            break;
            
        default:
            break;
    }

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

function getParameterByName(name, url = window.location.search) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

function checkIngreso() {
    if(document.getElementById('esBanco').checked) {
        console.log('Banco checked');
        $("#divAportador").hide();
        $("#divCliente").hide();
    }

    if(document.getElementById('esAportacion').checked) {
        console.log('Aportacion checked');
        $("#divAportador").show();
        $("#divCliente").hide();
    }

    if(document.getElementById('esVenta').checked) {
        console.log('Venta checked');
        $("#divAportador").hide();
        $("#divCliente").show();
    }
}

function checkEgreso() {
    if(document.getElementById('esBancoEg').checked) {
        console.log('Banco checked');
        $("#divProveedor").hide();
        $("#divAportadorEg").hide();
        $("#divClienteEg").hide();
        $("#inputAreaEg").prop('disabled', true);
        $("#inputAreaEg").prop('required', false);
        $("#inputAreaEg").addClass('is-valid');

        $("#inputProveedorEg").prop('required', false);
        $("#inputAportadorEg").prop('required', false);
        $("#inputClienteEg").prop('required', false);
        $("#inputProveedorEg").addClass('is-valid');
        $("#inputAportadorEg").addClass('is-valid');
        $("#inputClienteEg").addClass('is-valid');
    }

    if(document.getElementById('esAportacionEg').checked) {
        console.log('Aportacion checked');
        $("#divProveedor").hide();
        $("#divAportadorEg").show();
        $("#divClienteEg").hide();
        $("#inputAreaEg").prop('disabled', true);
        $("#inputAreaEg").prop('required', false);
        $("#inputAreaEg").addClass('is-valid');

        $("#inputProveedorEg").prop('required', false);
        $("#inputAportadorEg").prop('required', true);
        $("#inputClienteEg").prop('required', false);
        $("#inputProveedorEg").addClass('is-valid');
        $("#inputAportadorEg").removeClass('is-valid');
        $("#inputClienteEg").addClass('is-valid');
    }

    if(document.getElementById('esPagoEg').checked) {
        console.log('Pago checked');
        $("#divProveedor").show();
        $("#divAportadorEg").hide();
        $("#divClienteEg").hide();
        $("#inputAreaEg").prop('disabled', false);
        $("#inputAreaEg").prop('required', true);
        $("#inputAreaEg").removeClass('is-valid');

        $("#inputProveedorEg").prop('required', true);
        $("#inputAportadorEg").prop('required', false);
        $("#inputClienteEg").prop('required', false);
        $("#inputProveedorEg").removeClass('is-valid');
        $("#inputAportadorEg").addClass('is-valid');
        $("#inputClienteEg").addClass('is-valid');
    }

    if(document.getElementById('esDevolucionEg').checked) {
        console.log('Devolucion checked');
        $("#divProveedor").hide();
        $("#divAportadorEg").hide();
        $("#divClienteEg").show();
        $("#inputAreaEg").prop('disabled', true);
        $("#inputAreaEg").prop('required', false);
        $("#inputAreaEg").addClass('is-valid');

        $("#inputProveedorEg").prop('required', false);
        $("#inputAportadorEg").prop('required', false);
        $("#inputClienteEg").prop('required', true);
        $("#inputProveedorEg").addClass('is-valid');
        $("#inputAportadorEg").addClass('is-valid');
        $("#inputClienteEg").removeClass('is-valid');
    }
}

// var today = new Date();
// var dd = today.getDate();
// var mm = today.getMonth()+1; //January is 0!
// var yyyy = today.getFullYear();
//  if(dd<10){
//         dd='0'+dd;
//     } 
//     if(mm<10){
//         mm='0'+mm;
//     } 

// today = yyyy+'-'+mm+'-'+dd;
// document.getElementById("inputFecha").setAttribute("max", today);