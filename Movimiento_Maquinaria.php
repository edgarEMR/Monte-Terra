<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movimiento Maquinaria</title>
    <link rel="stylesheet" href="css/Movimiento_Maquinaria.css">
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
        session_start();
        include_once('php/conection.php');

        $nombreProyecto = '';
        $accion = 'pago';
        $conection = new DB(require 'php/config.php');
        $idUsuario = 0;

        $idUsuario = $_SESSION['idUsuario'];

    ?>
    <div class="pago-form">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ingreso-tab" data-bs-toggle="tab" data-bs-target="#ingreso-tab-pane" type="button" role="tab" aria-controls="ingreso-tab-pane" aria-selected="true">Ingreso</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="egreso-tab" data-bs-toggle="tab" data-bs-target="#egreso-tab-pane" type="button" role="tab" aria-controls="egreso-tab-pane" aria-selected="false">Egreso</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <label id="idTipoArea" hidden>0</label>
            <label id="idEsIngreso" hidden><?php ?></label>
            <!--INGRESO-->
            <div class="tab-pane fade" id="ingreso-tab-pane" role="tabpanel" aria-labelledby="ingreso-tab" tabindex="0">
                <form id="nuevoPagoIng" action="php/Maquinaria_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="form-group" hidden>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="esIngreso" id="esIngreso" value="1" checked>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputMaquina">Maquinaria</label>
                        <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="maquina" id="inputMaquina" onchange="" required>
                            <?php
                                $procedure = $conection->gestionMaquinaria(0, '', 0, 0, 'E');
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=".$rows['idMaquinaria'].">".$rows['nombre']."</option>";
                                }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputConcepto">Concepto</label>
                        <input type="text" name="concepto" class="form-control" id="inputConcepto"
                            pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" required value="<?php ?>">
                        <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                        <div class="invalid-feedback">
                            Ingrese un nombre válido.
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputProyecto">Proyecto</label>
                        <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="proyecto" id="inputProyecto" required>
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
                    <div class="form-group col-md-4">
                        <label for="inputCantidad">Cantidad</label>
                        <input type="number" name="cantidad" class="form-control" id="inputCantidad" min="1" value="<?php ?>" oninput="calcularImporte()" required>
                        <div class="invalid-feedback">
                            Ingrese un número válido.
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputPrecioUn">Precio Unitario</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">$</span>
                            <input type="number" name="precioUnitario" class="form-control" id="inputPrecioUn" min="0" step="0.01" value="<?php ?>" oninput="calcularImporte()" required>
                            <div class="invalid-feedback">
                                Ingrese un número válido.
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputModificacion">Modificación</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">$</span>
                            <input type="number" name="modificacion" class="form-control" id="inputModificacion" min="0" step="0.01" value="<?php ?>" oninput="calcularImporte()" required>
                            <div class="invalid-feedback">
                                Ingrese un número válido.
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputImporte">Importe Total</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">$</span>
                            <input type="number" name="importe" class="form-control" id="inputImporte" min="0" step="0.01" required value="<?php ?>">
                            <div class="invalid-feedback">
                                Ingrese un número válido.
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputTipoPago">Método de Pago</label>
                        <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="tipoPago" id="inputTipoPago" required>
                            <?php
                                $procedure = $conection->obtenerTipoPago();
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=".$rows['idTipoPago'].">".$rows['nombre']."</option>";
                                }
                            ?>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group d-grid">
                        <input id="idUsuario" type="hidden" name="usuarioID" value="<?php echo $idUsuario;?>">
                        <input id="idTipo" type="hidden" name="tipo" value="Ingreso">
                        <input type="hidden" name="accion" value="<?php echo $accion;?>">
                        <button class="btn btn-block btn-primary" type="submit">Agregar</button>
                    </div>
                </form>
            </div>
            <!-- EGRESO -->
            <div class="tab-pane fade" id="egreso-tab-pane" role="tabpanel" aria-labelledby="egreso-tab" tabindex="0">
                <form id="nuevoPagoEgr" action="php/Maquinaria_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="form-group" hidden>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="esIngreso" id="esEgreso" value="0" checked >
                            <label class="form-check-label" for="esEgreso">Egreso</label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputMaquinaEg">Maquinaria</label>
                        <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="maquina" id="inputMaquinaEg" onchange="" required>
                            <?php
                                $procedure = $conection->gestionMaquinaria(0, '', 0, 0, 'E');
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=".$rows['idMaquinaria'].">".$rows['nombre']."</option>";
                                }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group col-md-4" id="divConceptoEg">
                        <label for="inputConceptoEg">Concepto</label>
                        <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="concepto" id="inputConceptoA">
                            <?php
                                $procedure = $conection->gastoMaquinaria();
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=".$rows['nombre'].">".$rows['nombre']."</option>";
                                }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group col-md-4" id="divConceptoB">
                        <label for="inputConceptoB">Concepto - B</label>
                        <input type="text" name="conceptoB" class="form-control" id="inputConceptoB"
                            pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="<?php ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputImporte">Importe</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">$</span>
                            <input type="number" name="importe" class="form-control" id="inputImporte" min="0" step="0.01" required value="<?php ?>">
                            <div class="invalid-feedback">
                                Ingrese un número válido.
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputProyectoEg">Proyecto</label>
                        <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="proyecto" id="inputProyectoEg" required>
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
                    <div class="form-group col-md-4">
                        <label for="inputTipoPago">Método de Pago</label>
                        <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="tipoPago" id="inputTipoPago" required>
                            <?php
                                $procedure = $conection->obtenerTipoPago();
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=".$rows['idTipoPago'].">".$rows['nombre']."</option>";
                                }
                            ?>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group" id="divProveedor">
                        <label for="inputProveedor">Proveedor</label>
                        <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="proveedor" id="inputProveedorEg" required>
                            <?php
                                $procedure = $conection->obtenerProveedores();
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=".$rows['idProveedor'].">".$rows['nombre']."</option>";
                                }
                            ?>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group d-grid">
                        <input id="idUsuario" type="hidden" name="usuarioID" value="<?php echo $idUsuario;?>">
                        <input id="idTipo" type="hidden" name="tipo" value="Egreso">
                        <input type="hidden" name="accion" value="<?php echo $accion;?>">
                        <button class="btn btn-block btn-primary" type="submit">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="liveAlert" class="alert alert-dismissible fade show position-fixed fixed-bottom mx-auto" role="alert">
        <p class="alert-body mb-0"></p>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/Movimiento_Maquinaria.js"></script>
</body>
</html>