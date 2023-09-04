<?php 
    session_start();

    $nombreUsuario = "";
    $correo = "";

    if(isset($_SESSION["nombre"]) && isset($_SESSION["correo"])) {
        $nombreUsuario = $_SESSION["nombre"];
        $correo = $_SESSION["correo"];
        $idUsuario = $_SESSION["idUsuario"];
        $rol = $_SESSION["rol"];
    }
?>
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
                <a id="logo" href="Proyectos.php"><i class="bi bi-building"></i>
                MonteTerra</a>
            </div>
            
            <h6 id="titulo">Titulo</h6>
            
            <div class="dropdown">
                <button class="btn btn-outline-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end text-center">
                    <li><h6 class="dropdown-header"><?php echo $nombreUsuario . '</br>' . $correo;?></h6></li>
                    <li><button id="perfil" type="button" class="btn btn-link" onclick="location.href='Perfil.php?id=<?php echo $idUsuario;?>'" style="text-decoration: none;"><i class="bi bi-person-circle"></i> Perfil</button></li> 
                    <li><button id="cerrarSesion" type="button" class="btn btn-link" onclick="location.href='index.php'" style="text-decoration: none;"><i class="bi bi-power"></i> Cerrar sesión</button></li> 
                </ul>
            </div>
        </div>
    </nav>
    <div id="navMenu" class="bg-primary d-flex justify-content-center">
        <button id="crearProyecto" type="button" class="btn btn-link" onclick="location.href='Nuevo_Proyecto.php'" style="text-decoration: none;">Nuevo Proyecto</button>
        <button id="crearEtapa" type="button" class="btn btn-link" onclick="sendVariables('Nueva_Etapa.php', $('#inputProyectoID').val(), 'id')" style="text-decoration: none;">Agregar Etapa</button>
        <button id="agregarPago" type="button" class="btn btn-link" onclick="sendVariables('Detalle_Pago.php', $('#inputProyectoID').val(), 'id')" style="text-decoration: none;">Agregar Movimiento</button>
        <button id="crearPresupuesto" type="button" class="btn btn-link" onclick="sendVariables('Presupuestos.php', $('#inputProyectoID').val(), 'id')" style="text-decoration: none;">Agregar Presupuesto</button>
        <button id="crearCotizacion" type="button" class="btn btn-link" onclick="location.href='Nueva_Cotizacion.php'" style="text-decoration: none;">Agregar Cotización</button>
        <button id="crearCliente" type="button" class="btn btn-link" onclick="location.href='Nuevo_Cliente.php'" style="text-decoration: none;">Agregar Cliente</button>
        <button id="crearProspecto" type="button" class="btn btn-link" onclick="location.href='Nuevo_Prospecto.php'" style="text-decoration: none;">Agregar Prospecto</button>
        <button hidden id="agregarAbono" type="button" class="btn btn-link" onclick="location.href='Detalle_Abono.php'" style="text-decoration: none;">Agregar Abono</button>
        <button id="agregarAportador" type="button" class="btn btn-link" onclick="location.href='Nuevo_Aportador.php'" style="text-decoration: none;">Agregar Aportador</button>
        <button id="agregarCredito" type="button" class="btn btn-link" onclick="location.href='Nuevo_Credito.php'" style="text-decoration: none;">Agregar Crédito</button>
        <button id="agregarProveedor" type="button" class="btn btn-link" onclick="location.href='Nuevo_Proveedor.php'" style="text-decoration: none;">Agregar Proveedor</button>
        <button id="agregarPrestamo" type="button" class="btn btn-link" onclick="location.href='Detalle_Abono.php'" style="text-decoration: none;">Agregar Préstamo</button>
        <button id="gestionProrrateo" type="button" class="btn btn-link" onclick="location.href='Gestion_Prorrateo.php'" style="text-decoration: none;">Prorrateo</button>
        <button id="atras" type="button" class="btn btn-link" onclick="location.href='Proyectos.php'" style="text-decoration: none;"><i class="bi bi-arrow-left-circle-fill"></i> Atrás</button>
    </div>
    <div id="navConst" class="bg-primary d-flex justify-content-center">
        <button id="agregarMovimiento" type="button" class="btn btn-link" onclick="location.href='Movimiento_Maquinaria.php'" style="text-decoration: none;">Agregar Movimiento</button>
        <button id="agregarMaquina" type="button" class="btn btn-link" onclick="location.href='Nueva_Maquina.php'" style="text-decoration: none;">Agregar Maquina</button>
        <button id="agregarOperador" type="button" class="btn btn-link" onclick="location.href='Nuevo_Operador.php'" style="text-decoration: none;">Agregar Operador</button>
        <button id="atrasMaquinaria" type="button" class="btn btn-link" onclick="location.href='Menu.php'" style="text-decoration: none;"><i class="bi bi-arrow-left-circle-fill"></i> Atrás</button>
    </div>
    <div id="variables">
        <input id="inputProyectoID" type="number" hidden>
        <input id="inputRolID" type="hidden" value="<?php echo $rol;?>">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</body>

</html>