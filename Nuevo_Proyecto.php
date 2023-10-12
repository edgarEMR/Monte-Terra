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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
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
            $proyecto->setPrototipos($row['prototipos']);

            $accion = 'editar';
        }

    ?>
    <div class="register-form">
        <form id="registroProyecto" action="php/Proyecto_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
            <div class="form-group col-md-8">
                <label for="nombreProyecto">Nombre de Proyecto</label>
                <input type="text" name="nombreProyecto" class="form-control" id="inputNombreProyecto"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="<?php echo $proyecto->getNombre();?>" required>
                <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                <div class="invalid-feedback">
                    Ingrese un nombre válido.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputTipoVivienda">Vivienda de interés</label>
                <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="tipoVivienda" id="inputTipoVivienda" multiple required>
                    <?php
                        $procedure = $conection->obtenerTipoVivienda();
                        while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=".$rows['idVivienda'].">".$rows['nombre']."</option>";
                        }
                    ?>
                    </select>
                <div class="invalid-feedback">
                    Elija una opción.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputTotalCasas">Total de Casas</label>
                <input type="number" name="totalCasas" class="form-control" id="inputTotalCasas" min="1" value="1" value="<?php echo $proyecto->getTotalCasas();?>" required>
                <div class="invalid-feedback">
                    Ingrese un número válido.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputTotalEtapas">Total de Etapas</label>
                <input type="number" name="totalEtapas" class="form-control" id="inputTotalEtapas" min="1" value="<?php echo $proyecto->getTotalEtapas();?>" required>
                <div class="invalid-feedback">
                    Ingrese un número válido.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputPrototipo">Prototipos</label>
                <input type="number" name="prototipos" class="form-control" id="inputPrototipo" min="1" value="<?php echo $proyecto->getPrototipos();?>" required>
                <div class="invalid-feedback">
                    Ingrese un número válido.
                </div>
            </div>
            <div id="divPrototipos" class="row">
                <?php
                    $procedure = $conection->gestionPrototipo(0, 0, 0, $idProyecto, 'S');
                    $i = 0;
                    while ($row = $procedure->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div class="form-group col-md-4">';
                        echo '<label for="inputMetros">' . $row['nombre'] .'</label>';
                        echo '<div class="input-group has-validation">';
                        echo '<input type="number" name="metros[]" class="form-control prototiposEnProyecto" id="inputMetros" min="1" value="'. $row['metros'] .'" required>';
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
                <button class="btn btn-block btn-primary" type="submit">Agregar</button>
            </div>
        </form>
    </div>
    <div id="liveAlert" class="alert alert-dismissible fade show position-fixed fixed-bottom mx-auto" role="alert">
        <p class="alert-body mb-0"></p>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/Nuevo_Proyecto.js"></script>
</body>
</html>