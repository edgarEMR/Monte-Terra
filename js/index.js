$(document).ready(function () {
    $('#entrar').click(function () {
        if ($('#inputUser').val() == 'admin') {
            window.location.href = 'Proyectos.php';
        } else {
            window.location.href = 'Ventas.php';
        }
        
    });
});