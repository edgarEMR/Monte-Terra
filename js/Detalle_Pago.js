$('#navigation').load("Navbar.php", function() {
    $('#titulo').text('Pagos');

    $('#crearProyecto').toggle();
    $('#crearPresupuesto').toggle();
    $('#agregarPago').toggle();

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

function getParameterByName(name, url = window.location.search) {
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
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