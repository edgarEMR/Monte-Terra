$('#navigation').load("Navbar.php", function() {
    $('#titulo').text('Ventas');
    
    $('#crearProyecto').toggle();
    $('#crearPresupuesto').toggle();
    $('#agregarPago').toggle();
    $('#crearCotizacion').toggle();
    $('#dividerTop').toggle();
    $('#agregarAportador').toggle();
    $('#agregarCredito').toggle();
    $('#agregarProveedor').toggle();
    $('#agregarPrestamo').toggle();

    /*$('#crearCliente').on("click", function () {
        location.href = 'Detalle_Abono.php';
    });
    $('#agregarAbono').on("click", function () {
        location.href = 'Detalle_Abono.php';
    });*/
});