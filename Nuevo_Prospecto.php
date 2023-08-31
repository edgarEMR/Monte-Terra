<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Prospecto</title>
    <link rel="stylesheet" href="css/Nuevo_Prospecto.css">
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
        $accion = 'registrarP';
        $proyecto = new Proyecto(require 'php/config.php');
        $conection = new DB(require 'php/config.php');

    ?>

    <!--PROSPECTOS PARA TODOS DESPUES DE UNO/DOS MESES-->
    <!--NOTIFICACION 15 DIAS ANTES DE SER LIBERADO A EUGENIO-->
    <!--NOTIFICACION A TODOS CUANDO SE LIBERE-->
    <div class="register-form">
        <form id="registroProyecto" action="php/Cliente_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
            <div class="form-group input-group-sm col-md-3">
                <label for="inputPrimerNombre">Primer nombre *</label>
                <input type="text" name="primerNombre" class="form-control" id="inputPrimerNombre"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="<?php ?>" required>
                <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                <div class="invalid-feedback">
                    Ingrese un nombre válido.
                </div>
            </div>
            <div class="form-group input-group-sm col-md-3">
                <label for="inputSegundoNombre">Segundo Nombre</label>
                <input type="text" name="segundoNombre" class="form-control" id="inputSegundoNombre"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="<?php ?>">
                <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
            </div>
            <div class="form-group input-group-sm col-md-3">
                <label for="inputApPaterno">Apellido Paterno *</label>
                <input type="text" name="apPaterno" class="form-control" id="inputApPaterno"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="<?php ?>" required>
                <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                <div class="invalid-feedback">
                    Ingrese un texto válido.
                </div>
            </div>
            <div class="form-group input-group-sm col-md-3">
                <label for="inputApMaterno">Apellido Materno *</label>
                <input type="text" name="apMaterno" class="form-control" id="inputApMaterno"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="<?php ?>" required>
                <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                <div class="invalid-feedback">
                    Ingrese un texto válido.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputEmail">Correo electrónico *</label>
                <input type="email" name="email" class="form-control" id="inputEmail"
                    pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$" aria-describedby="emailHelp"
                    placeholder="nombre@ejemplo.com" required>
                <div class="invalid-feedback">
                    Ingrese un correo válido.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputTelefono">Teléfono *</label>
                <input type="tel" name="telefono" class="form-control" id="inputTelefono"
                    aria-describedby="emailHelp" pattern="[0-9]{10}"
                    placeholder="8114567123" required>
                <div class="invalid-feedback">
                    Ingrese un telefono válido.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputProyecto">Proyecto</label>
                <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="proyecto" id="inputProyecto" required>
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
            <div class="form-group col-md-4">
                <label for="inputEtapa">Etapa</label>
                <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="etapa" id="inputEtapa" required>
                </select>
                <div class="invalid-feedback">
                    Elija una opción.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputPrototipo">Prototipo</label>
                <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="prototipo" id="inputPrototipo" required>
                </select>
                <div class="invalid-feedback">
                    Elija una opción.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputCredito">Monto de Crédito*</label>
                <input type="number" name="credito" class="form-control" id="inputCredito" value="" required>
                <div class="invalid-feedback">
                    Ingrese un número válido.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputTipoCredito">Tipo de Crédito*</label>
                <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="tipoCredito" id="inputTipoCredito" required>
                    <option value="FOVISSSTE">FOVISSSTE</option>
                    <option value="BANCARIO">BANCARIO</option>
                    <option value="INFONAVIT">INFONAVIT</option>
                    </select>
                <div class="invalid-feedback">
                    Elija una opción.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputTipoVivienda">Vivienda de interés*</label>
                <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="tipoVivienda" id="inputTipoVivienda" required>
                    <option value="SOCIAL">SOCIAL</option>
                    <option value="MEDIO RESIDENCIAL">MEDIO RESIDENCIAL</option>
                    <option value="RESIDENCIAL">RESIDENCIAL</option>
                    <option value="RESIDENCIAL PLUS">RESIDENCIAL PLUS</option>
                    <option value="CAMPESTRE">CAMPESTRE</option>
                    <option value="TERRENO">TERRENO</option>
                    </select>
                <div class="invalid-feedback">
                    Elija una opción.
                </div>
            </div>
            <div class="form-group d-grid">
                <input type="hidden" name="accion" value="<?php echo $accion;?>">
                <button class="btn btn-block btn-primary" type="submit">Guardar</button>
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
    <script src="js/Nuevo_Prospecto.js"></script>
</body>
</html>