<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonteTerra</title>
    <link rel="stylesheet" href="css/Menu.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
    <div id="navigation" class="top">

    </div>
    
    <h2 class="text-primary">Bienvenido</h2>
    
    <div id="menuItems">    
        <button id="redAdministracion" type="button" class="btn btn-outline-primary" onclick="location.href='Proyectos.php'" style="text-decoration: none;"><i class="bi bi-building-check"></i> <br> Administración</button>
        <button id="redVentas" type="button" class="btn btn-outline-success" onclick="location.href='Ventas.php'" style="text-decoration: none;" style="text-decoration: none;"><i class="bi bi-house-check-fill"></i> <br> Ventas</button>
        <button id="redMaqui" type="button" class="btn btn-outline-danger" onclick="location.href='Maquinaria.php'" style="text-decoration: none;" style="text-decoration: none;"><i class="bi bi-truck-flatbed"></i> <br> Maquinaria</button>
        <!-- <button id="redConstru" type="button" class="btn btn-outline-warning" onclick="location.href='Construccion.php'" style="text-decoration: none;" style="text-decoration: none;"><i class="bi bi-cone-striped"></i> <br> Construcción</button> -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Menu.js"></script>
</body>
</html>