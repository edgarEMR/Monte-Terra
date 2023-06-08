<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Aportador</title>
    <link rel="stylesheet" href="css/Nuevo_Aportador.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    <div id="navigation" class="top">

    </div>
    <?php
    ob_start();
    include_once('php/conection.php');

    
        $idProyecto = 0;
        $nombreProyecto = '';
        $accion = 'registrar';
        $conection = new DB(require 'php/config.php');

    ?>
    <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <rect width="100%" height="100%" fill="#007aff"></rect>
                </svg>
                <strong class="me-auto">MonteTerra</strong>
                <small>Justo ahora</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Usuario registrado exitosamente.
            </div>
        </div>
    </div>
    <div class="register-form">
        <form id="registroProyecto" action="php/Aportador_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
            <!-- <div class="form-group input-group-sm col-md-6">
                <label for="nombreProyecto">RFC</label>
                <input type="text" name="RFCAportador" class="form-control" id="inputRFC" placeholder="XAXX010101000"
                    pattern="[A-Z0-9]{12,13}" value="" required>
                <small id="RFCUHelp" class="form-text text-muted">Máximo 13 caracteres.</small>
                <div class="invalid-feedback">
                    Ingrese un nombre válido.
                </div>
            </div> -->
            <div class="form-group input-group-sm col-md-6">
                <label for="nombreProyecto">Nombre</label>
                <input type="text" name="nombreAportador" class="form-control" id="inputNombre"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="" required>
                <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                <div class="invalid-feedback">
                    Ingrese un nombre válido.
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputProyecto">Proyecto</label>
                <select class="form-select" name="proyecto" id="inputProyecto" required>
                    <option selected disabled value="">Elige...</option>
                    <option value="0">General</option>
                    <?php
                        $procedure = $conection->obtenerProyectos();
                        while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                            if ($rows['idProyecto'] == $idProyecto) {
                                echo "<option value=".$rows['idProyecto']." selected>".$rows['nombre']."</option>";
                            } else {
                                echo "<option value=".$rows['idProyecto'].">".$rows['nombre']."</option>";
                            }
                            
                        }
                    ?>
                    </select>
                <div class="invalid-feedback">
                    Elija una opción.
                </div>
            </div>
            <div class="form-group d-grid mt-3">
                <input type="hidden" name="accion" value="<?php echo $accion;?>">
                <button class="btn btn-block btn-primary" type="submit">Agregar</button>
            </div>
        </form>
    </div>
    <div id="tabla-desglose-aportador" class="table-responsive">    
        <table id="tabla-aportador" class="table table-hover table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>Nombre</th>
                    <th>Proyecto</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $procedure = $conection->gestionAportador(0, '', '', 0, 'S');
                    while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $rows['nombre'] . "</td>";
                        echo "<td>" . $rows['nombreProyecto'] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Nuevo_Aportador.js"></script>
</body>
</html>