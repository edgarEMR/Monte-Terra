<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos</title>
    <link rel="stylesheet" href="css/Nuevo_Proyecto.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</head>
<body>
    <div id="navigation" class="top">

    </div>
    <?php
    ob_start();
    include_once('modelos/Proyecto.php');
    include_once('php/conection.php');

        $idProyecto = 0;
        $nombreProyecto = '';
        $accion = 'registrar';
        $proyecto = new Proyecto(require 'php/config.php');
        $conection = new DB(require 'php/config.php');

        if (isset($_GET['id']) && !is_null($_GET['id'])) {
            $idProyecto = $_GET['id'];
            $proc = $conection->gestionProyecto($idProyecto, '', 0, 0, 0, 'S');
            $row = $proc->fetch(PDO::FETCH_ASSOC);

            $proyecto->setIdProyecto($idProyecto);
            $proyecto->setNombre($row['nombre']);
            $proyecto->setTotalCasas($row['totalCasas']);
            $proyecto->setTotalEtapas($row['totalEtapas']);
            $proyecto->setPresupuesto($row['presupuestoProyecto']);

            $accion = 'editar';
        }

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
        <form id="registroProyecto" action="php/Proyecto_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
            <div class="form-group">
                <label for="nombreProyecto">Nombre de Proyecto</label>
                <input type="text" name="nombreProyecto" class="form-control" id="inputNombreProyecto"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="<?php echo $proyecto->getNombre();?>" required>
                <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                <div class="invalid-feedback">
                    Ingrese un nombre válido.
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputTotalCasas">Total de Casas</label>
                <input type="number" name="totalCasas" class="form-control" id="inputTotalCasas" min="1" value="1" value="<?php echo $proyecto->getTotalCasas();?>" required>
                <div class="invalid-feedback">
                    Ingrese un número válido.
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputTotalEtapas">Total de Etapas</label>
                <input type="number" name="totalEtapas" class="form-control" id="inputTotalEtapas" min="1" value="<?php echo $proyecto->getTotalEtapas();?>" required>
                <div class="invalid-feedback">
                    Ingrese un número válido.
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPrototipo">Prototipos</label>
                <input type="number" name="prototipos" class="form-control" id="inputPrototipo" min="1" value="<?php echo $proyecto->getPrototipo();?>" required>
                <div class="invalid-feedback">
                    Ingrese un número válido.
                </div>
            </div>
            <div id="divPrototipos" class="row">
                <?php
                    $procedure = $conection->gestionEtapa(0, 0, 0, $idProyecto, 'S');
                    $i = 0;
                    while ($row = $procedure->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div class="form-group col-md-4">';
                        echo '<label for="inputMetros">Prototipo ' . $row['numeroEtapa'] .'</label>';
                        echo '<div class="input-group has-validation">';
                        echo '<input type="number" name="metros[]" class="form-control prototiposEnProyecto" id="inputMetros" min="1" value="'. $row['cantidadCasas'] .'" required>';
                        echo '<span class="input-group-text">metros</span>';
                        echo '<div class="invalid-feedback">';
                        echo 'Ingrese un número válido.';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                        $i += 1;
                    }
                ?>
            </div>
            <div class="form-group d-grid">
                <input type="hidden" name="accion" value="<?php echo $accion;?>">
                <button class="btn btn-block btn-primary btn-lg" type="submit">Agregar</button>
            </div>
        </form>

        <!-- Mensaje Modal -->
        <div class="modal fade" id="modalMensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Atencion</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Error al crear proyecto <br> Intente de nuevo
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Nuevo_Proyecto.js"></script>
</body>
</html>