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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>

</head>

<body>
    <nav class="navbar">
        <div class="container-fluid d-flex">
            <div class="navbar-brand">
                <a href="Proyectos.php"><i class="bi bi-building"></i>
                MonteTerra</a>
            </div>
            
            <h6 id="titulo">Titulo</h6>
            
            <div class="derecha">
                <button id="crearProyecto" type="button" class="btn btn-outline-primary ms-1" onclick="location.href='Nuevo_Proyecto.php'">Nuevo Proyecto</button>
                <button id="agregarPago" type="button" class="btn btn-outline-primary ms-1" onclick="sendVariables('Detalle_Pago.php', $('#inputProyectoID').val(), 'id')">Agregar Pago</button>
                <button id="crearPresupuesto" type="button" class="btn btn-outline-primary ms-1" onclick="sendVariables('Presupuestos.php', $('#inputProyectoID').val(), 'id')">Crear Presupuesto</button>
                <button id="crearCliente" type="button" class="btn btn-outline-primary ms-1" onclick="location.href='Nuevo_Cliente.php'">Agregar Cliente</button>
                <button id="agregarAbono" type="button" class="btn btn-outline-primary ms-1" onclick="location.href='Detalle_Abono.php'">Agregar Abono</button>
                
                <button id="atras" type="button" class="btn btn-outline-primary ms-1" onclick="location.href='Proyectos.php'"><i class="bi bi-arrow-return-left"></i> Atrás</button>
            </div>

        </div>
    </nav>
    <div id="variables">
        <input id="inputProyectoID" type="number" hidden>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>