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
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>

<body>
    <div id="navigation" class="top">

    </div>
    <?php
    ob_start();
    include_once('modelos/Cliente.php');
    include_once('php/conection.php');

        $idProyecto = 0;
        $idCliente = 0;
        $accion = 'registrarC';
        $cliente = new Cliente(require 'php/config.php');
        $conection = new DB(require 'php/config.php');

        if (isset($_GET['id'])) {
            $idCliente = $_GET['id'];
            $cliente = new Cliente(require 'php/config.php');
            $procedure = $conection->gestionCliente($idCliente, '', '', '', '', '', '', '', '', 0, '', 0, 0, 0, 0, 0, 'S');
            $row = $procedure->fetch(PDO::FETCH_ASSOC);

            $cliente->setIdCliente($idCliente);
            $cliente->setNombre($row['nombre']);
            $cliente->setSegundoNombre($row['segundoNombre']);
            $cliente->setApellidoPaterno($row['apellidoPaterno']);
            $cliente->setApellidoMaterno($row['apellidoMaterno']);
            $cliente->setEmail($row['email']);
            $cliente->setTelefono($row['telefono']);
            $cliente->setTipoVivienda($row['tipoVivienda']);
            $cliente->setTipoCredito($row['tipoCredito']);
            $cliente->setCredito($row['credito']);
            $cliente->setEsProspecto($row['esProspecto']);
            $cliente->setIdProyecto($row['idProyecto']);
            $cliente->setIdEtapa($row['idEtapa']);
            $cliente->setIdPrototipo($row['idPrototipo']);
        }
    ?>

    <!--PROSPECTOS PARA TODOS DESPUES DE UNO/DOS MESES-->
    <!--NOTIFICACION 15 DIAS ANTES DE SER LIBERADO A EUGENIO-->
    <!--NOTIFICACION A TODOS CUANDO SE LIBERE-->
    <div class="container d-flex">
        <div class="register-form">
            <form id="registroProyecto" action="php/Cliente_Procesos.php" class="row needs-validation" method="POST"
                enctype="multipart/form-data" novalidate>
                <div class="form-group col-md-4">
                    <label for="inputProyecto">Proyecto</label>
                    <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="proyecto"
                        id="inputProyecto" required>
                        <?php
                        $procedure = $conection->obtenerProyectos();
                        while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                            if ($rows['idProyecto'] == $cliente->getIdProyecto()) {
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
                    <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="etapa"
                        id="inputEtapa" required>
                        <?php
                        if ($cliente->getIdEtapa()) {
                            $procedure = $conection->gestionEtapa(0, 0, 0, 0, 0, $cliente->getIdProyecto(), 'S');
                            while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                if ($rows['idEtapa'] == $cliente->getIdEtapa()) {
                                    echo "<option value=".$rows['idEtapa']." selected>".$rows['numeroEtapa']."</option>";
                                } else {
                                    echo "<option value=".$rows['idEtapa'].">".$rows['numeroEtapa']."</option>";
                                }
                                
                            }
                        }
                    ?>
                    </select>
                    <div class="invalid-feedback">
                        Elija una opción.
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputCalle">Calle</label>
                    <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="calle"
                        id="inputCalle" required>
                    </select>
                    <div class="invalid-feedback">
                        Elija una opción.
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputManzana">Manzana</label>
                    <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="manzana"
                        id="inputManzana" required>
                    </select>
                    <div class="invalid-feedback">
                        Elija una opción.
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputLote">Lote</label>
                    <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="lote"
                        id="inputLote" required>
                    </select>
                    <div class="invalid-feedback">
                        Elija una opción.
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputPrototipo">Prototipo</label>
                    <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="prototipo"
                        id="inputPrototipo" required disabled>
                        <?php
                        if ($cliente->getIdPrototipo()) {
                            $procProto = $conection->gestionPrototipo(0, '', 0, $cliente->getIdProyecto(), 'S');
                            while ($rowProto = $procProto->fetch(PDO::FETCH_ASSOC)) {
                                if ($rowProto['idPrototipo'] == $cliente->getIdPrototipo()) {
                                    echo "<option value=".$rowProto['idPrototipo']." selected>".$rowProto['nombre']." - ".$rowProto['metros']."</option>";
                                } else {
                                    echo "<option value=".$rowProto['idPrototipo'].">".$rowProto['nombre']." - ".$rowProto['metros']."</option>";
                                }
                            }
                        }
                    ?>
                    </select>
                    <div class="invalid-feedback">
                        Elija una opción.
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputExcedente">M2 Excedente</label>
                    <input type="number" name="m2Excedente" class="form-control" id="inputExcedente" value="<?php ?>"
                        required disabled>
                    <div class="invalid-feedback">
                        Ingrese un numero válido.
                    </div>
                </div>
                <div class="form-group col-md-3" hidden>
                    <label for="inputPrecioExcedente">M2 Excedente</label>
                    <input type="number" name="precioExcedente" class="form-control" id="inputPrecioExcedente"
                        value="<?php ?>">
                    <div class="invalid-feedback">
                        Ingrese un numero válido.
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputPrecioVenta">Precio de Venta</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text">$</span>
                        <input type="number" name="precioVenta" class="form-control" id="inputPrecioVenta" min="0"
                            step="0.01" oninput="calcularImporte()" required value="<?php ?>">
                        <div class="invalid-feedback">
                            Ingrese un número válido.
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputPrecioFinal">Precio Final</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text">$</span>
                        <input type="number" name="precioFinal" class="form-control" id="inputPrecioFinal" min="0"
                            step="0.01">
                        <div class="invalid-feedback">
                            Ingrese un número válido.
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-3">
                    <label for="inputSeparacion">Monto Separación</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text">$</span>
                        <input type="number" name="separacion" class="form-control" id="inputSeparacion" min="0"
                            step="0.01">
                        <div class="invalid-feedback">
                            Ingrese un número válido.
                        </div>
                    </div>
                </div>
                <div class="form-group input-group-sm col-md-3">
                    <label for="inputPrimerNombre">Primer nombre</label>
                    <input type="text" name="primerNombre" class="form-control" id="inputPrimerNombre"
                        pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="<?php echo $cliente->getNombre();?>" required>
                    <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                    <div class="invalid-feedback">
                        Ingrese un nombre válido.
                    </div>
                </div>
                <div class="form-group input-group-sm col-md-3">
                    <label for="inputSegundoNombre">Segundo Nombre</label>
                    <input type="text" name="segundoNombre" class="form-control" id="inputSegundoNombre"
                        pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="<?php echo $cliente->getSegundoNombre();?>">
                    <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                </div>
                <div class="form-group input-group-sm col-md-3">
                    <label for="inputApPaterno">Apellido Paterno</label>
                    <input type="text" name="apPaterno" class="form-control" id="inputApPaterno"
                        pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="<?php echo $cliente->getApellidoPaterno();?>"
                        required>
                    <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                    <div class="invalid-feedback">
                        Ingrese un texto válido.
                    </div>
                </div>
                <div class="form-group input-group-sm col-md-3">
                    <label for="inputApMaterno">Apellido Materno</label>
                    <input type="text" name="apMaterno" class="form-control" id="inputApMaterno"
                        pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="<?php echo $cliente->getApellidoMaterno();?>">
                    <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                    <div class="invalid-feedback">
                        Ingrese un texto válido.
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputTelefono">Teléfono</label>
                    <input type="tel" name="telefono" class="form-control" id="inputTelefono"
                        aria-describedby="emailHelp" pattern="[0-9]{10}" value="<?php echo $cliente->getTelefono();?>"
                        placeholder="8114567123" required>
                    <div class="invalid-feedback">
                        Ingrese un telefono válido.
                    </div>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputMetodoPago">Método de Pago</label>
                    <select class="form-control selectpicker" data-live-search="true" title="Elige..."
                        name="tipoCredito" id="inputMetodoPago" required>
                        <option <?php echo $cliente->getTipoCredito() == "FOVISSSTE"? 'selected' : ''; ?>
                            value="FOVISSSTE">FOVISSSTE</option>
                        <option <?php echo $cliente->getTipoCredito() == "BANCARIO"? 'selected' : ''; ?>
                            value="BANCARIO">BANCARIO</option>
                        <option <?php echo $cliente->getTipoCredito() == "INFONAVIT"? 'selected' : ''; ?>
                            value="INFONAVIT">INFONAVIT</option>
                    </select>
                    <div class="invalid-feedback">
                        Elija una opción.
                    </div>
                </div>
                <!-- <div class="form-group col-md-4">
                <label for="inputTipoPago">Forma de Pago</label>
                <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="tipoPago" id="inputTipoPago" required>
                    <?php
                        // $procedure = $conection->obtenerTipoPago();
                        // while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                        //     echo "<option value=".$rows['idTipoPago'].">".$rows['nombre']."</option>";
                        // }
                    ?>
                    </select>
                <div class="invalid-feedback">
                    Elija una opción.
                </div>
            </div> -->
                <div class="form-group col-md-4">
                    <label for="inputMedio">Fuente</label>
                    <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="medio"
                        id="inputMedio" required>
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
                    <input type="hidden" name="clienteID" value="<?php echo $idCliente;?>">
                    <input type="hidden" name="accion" value="<?php echo $accion;?>">
                    <button class="btn btn-block btn-primary" type="submit">Guardar</button>
                </div>
            </form>
        </div>
        <div class="more-info text-center">
            <div>
                <label><strong>Precio de Lista</strong></label><br>
                <label id="precioLista" class="editable-label text-dark">-</label>
            </div>
            <div>
                <label><strong>Fecha Estimada de Entrega</strong></label><br>
                <label id="fechaEntrega" class="editable-label text-dark">Por determinar</label>
            </div>
            <div>
                <label><strong>Fecha de Firma</strong></label><br>
                <label id="fechaFirma" class="editable-label text-dark"></label>
            </div>
        </div>
    </div>
    <div id="liveAlert" class="alert alert-dismissible fade show position-fixed fixed-bottom mx-auto" role="alert">
        <p class="alert-body mb-0"></p>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/Nuevo_Cliente.js"></script>
</body>

</html>