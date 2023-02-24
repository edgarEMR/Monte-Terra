<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TotalShop</title>
    <link rel="icon" href="assets/totalshop-icon.png">
    <link rel="stylesheet" href="css/Navbar.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar">
        <div class="container-fluid d-flex">
            <div class="navbar-brand">
                <a href="Proyectos.php"><i class="bi bi-building"></i>
                MonteTerra</a>
            </div>
            
            <h6 id="titulo">Titulo</h6>
            
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Menu
                </button>
                <ul class="dropdown-menu dropdown-menu-end text-center">
                    <li><button id="crearProyecto" type="button" class="btn btn-link" onclick="location.href='Nuevo_Proyecto.php'" style="text-decoration: none;">Nuevo Proyecto</button></li>
                    <li><button id="agregarPago" type="button" class="btn btn-link" onclick="sendVariables('Detalle_Pago.php', $('#inputProyectoID').val(), 'id')" style="text-decoration: none;">Agregar Movimiento</button></li>
                    <li><button id="crearPresupuesto" type="button" class="btn btn-link" onclick="sendVariables('Presupuestos.php', $('#inputProyectoID').val(), 'id')" style="text-decoration: none;">Agregar Presupuesto</button></li>
                    <li><button id="crearCotizacion" type="button" class="btn btn-link" onclick="location.href='Nueva_Cotizacion.php'" style="text-decoration: none;">Agregar Cotización</button></li>
                    <li><button id="crearCliente" type="button" class="btn btn-link" onclick="location.href='Nuevo_Cliente.php'" style="text-decoration: none;">Agregar Cliente</button></li>
                    <li hidden><button id="agregarAbono" type="button" class="btn btn-link" onclick="location.href='Detalle_Abono.php'" style="text-decoration: none;">Agregar Abono</button></li>
                    <li><hr id="dividerTop" class="dropdown-divider"></li>
                    <li><button id="agregarAportador" type="button" class="btn btn-link" onclick="location.href='Nuevo_Aportador.php'" style="text-decoration: none;">Agregar Aportador</button></li>
                    <li><button id="agregarCredito" type="button" class="btn btn-link" onclick="location.href='Nuevo_Banco.php'" style="text-decoration: none;">Agregar Crédito</button></li>
                    <li><button id="agregarProveedor" type="button" class="btn btn-link" onclick="location.href='Nuevo_Proveedor.php'" style="text-decoration: none;">Agregar Proveedor</button></li>
                    <li><button id="agregarPrestamo" type="button" class="btn btn-link" onclick="location.href='Detalle_Abono.php'" style="text-decoration: none;">Agregar Préstamo</button></li>
                    <li><hr id="dividerBottom" class="dropdown-divider"></li>
                    <li><button id="atras" type="button" class="btn btn-link" onclick="location.href='Proyectos.php'" style="text-decoration: none;"><i class="bi bi-arrow-return-left"></i> Atrás</button></li>
                </ul>
            </div>
    </nav>
    <div id="variables">
        <input id="inputProyectoID" type="number" hidden>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</body>

</html>