$('#navigation').load("Navbar.php", function() {
    $('#titulo').text('Ventas');
    
    $('#crearProyecto').toggle();
    $('#crearPresupuesto').toggle();
    $('#agregarPago').toggle();
    $('#atras').toggle();

    /*$('#crearCliente').on("click", function () {
        location.href = 'Detalle_Abono.php';
    });
    $('#agregarAbono').on("click", function () {
        location.href = 'Detalle_Abono.php';
    });*/
});