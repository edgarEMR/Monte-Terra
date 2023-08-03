<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Cliente</title>
    <link rel="stylesheet" href="css/Nuevo_Cliente.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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
    <!--EN QUE ESTA INTERESADO-->
    <!--NOMBRE-->
    <!--ECONOMICA-->
    <!--SOCIAL-->
    <!--MEDIO RESIDENCIAL-->
    <!--RESIDENCIAL-->
    <!--RESIDENCIAL PLUS-->   
    <!--INPUT INGRESOS--> 
    <!--INPUT MONTO CREDITO-->

    <!--PROSPECTOS PARA TODOS DESPUES DE UNO/DOS MESES-->
    <!--NOTIFICACION 15 DIAS ANTES DE SER LIBERADO A EUGENIO-->
    <!--NOTIFICACION A TODOS CUANDO SE LIBERE-->
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
        <form id="registroProyecto" action="php/Cliente_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
            <h6>Datos personales</h6>
            <div class="form-group input-group-sm col-md-3">
                <label for="inputPrimerNombre">Primer nombre *</label>
                <input type="text" name="primerNombre" class="form-control" id="inputPrimerNombre"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="<?php echo $proyecto->getNombre();?>" required>
                <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                <div class="invalid-feedback">
                    Ingrese un nombre válido.
                </div>
            </div>
            <div class="form-group input-group-sm col-md-3">
                <label for="inputSegundoNombre">Segundo Nombre</label>
                <input type="text" name="segundoNombre" class="form-control" id="inputSegundoNombre"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="<?php echo $proyecto->getNombre();?>">
                <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
            </div>
            <div class="form-group input-group-sm col-md-3">
                <label for="inputApPaterno">Apellido Paterno *</label>
                <input type="text" name="apPaterno" class="form-control" id="inputApPaterno"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="<?php echo $proyecto->getNombre();?>" required>
                <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                <div class="invalid-feedback">
                    Ingrese un texto válido.
                </div>
            </div>
            <div class="form-group input-group-sm col-md-3">
                <label for="inputApMaterno">Apellido Materno *</label>
                <input type="text" name="apMaterno" class="form-control" id="inputApMaterno"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="<?php echo $proyecto->getNombre();?>" required>
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
                <label for="inputFecha">Fecha de nacimiento *</label>
                <input type="date" name="fecha" class="form-control" id="inputFechaNac" required>
                <div class="invalid-feedback">
                    Ingrese la fecha de nacimiento.
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
                <label for="inputNSS">No. Seguro Social</label>
                <input type="number" name="NSS" class="form-control" id="inputNSS"
                    pattern="[0-9]{11}" value="<?php echo $proyecto->getNombre();?>" required>
                <div class="invalid-feedback">
                    Ingrese un numero válido.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputPuntaje">Puntaje INFONAVIT</label>
                <input type="number" name="puntaje" class="form-control" id="inputPuntaje" value="<?php echo $proyecto->getNombre();?>" required>
                <div class="invalid-feedback">
                    Ingrese un numero válido.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputContraseña">Contraseña</label>
                <input type="text" name="contraseña" class="form-control" id="inputContraseña"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="<?php echo $proyecto->getNombre();?>" required>
                <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                <div class="invalid-feedback">
                    Ingrese un dato válido.
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="inputTipoVivienda">Vivienda de interés*</label>
                <select class="form-select" name="tipoVivienda" id="inputTipoVivienda" required>
                    <option selected disabled value="">Elige...</option>
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
            <div class="form-group col-md-3">
                <label for="inputIngresos">Ingresos*</label>
                <input type="number" name="ingresos" class="form-control" id="inputIngresos" value="" required>
                <div class="invalid-feedback">
                    Ingrese un número válido.
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="inputCredito">Monto de Crédito*</label>
                <input type="number" name="credito" class="form-control" id="inputCredito" value="" required>
                <div class="invalid-feedback">
                    Ingrese un número válido.
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="inputMedio">Medio*</label>
                <select class="form-select" name="medio" id="inputMedio" required>
                    <option selected disabled value="">Elige...</option>
                    <option value="Redes sociales">Redes sociales</option>
                    <option value="Eventos">Eventos</option>
                    <option value="Volantes">Volantes</option>
                    <option value="Panoramicos">Panoramicos</option>
                    <option value="Recomendaciones">Recomendaciones</option>
                    <option value="Radio">Radio</option>
                    <option value="T.V.">T.V.</option>
                    <option value="Otro">Otro</option>
                    </select>
                <div class="invalid-feedback">
                    Elija una opción.
                </div>
            </div>
            <div class="form-group d-grid">
                <input type="hidden" name="accion" value="<?php echo $accion;?>">
                <button class="btn btn-block btn-primary btn-lg" type="submit">Guardar</button>
            </div>
        </form>
        <!-- Agregar tipo de vivienda -->
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
    <script src="js/Nuevo_Cliente.js"></script>
</body>
</html>