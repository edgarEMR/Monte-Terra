$(document).ready(function () {
    const toastLiveExample = $('#liveToast')

    $('#entrar').click(function () {
        if ($('#inputUser').val() == 'admin') {
            window.location.href = 'Proyectos.php';
        } else {
            window.location.href = 'Ventas.php';
        }
        
    });

    if (location.hash == '#error') {
        console.log(location.hash);
        $('.toast-body').text("Usuario o contraseña incorrectos, intente nuevamente");
        toastLiveExample.addClass("text-bg-danger");
        const toast = new bootstrap.Toast(toastLiveExample);
        toast.show();

        $('#inputUser').empty();
        $('#inputPassword').empty();
      }
});