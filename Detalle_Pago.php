<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Pago</title>
    <link rel="stylesheet" href="css/Detalle_Pago.css">
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
        include_once('modelos/Pago.php');
        include_once('php/conection.php');

        $idProyecto = 0;
        $idPago = 0;
        $idTipoArea = 0;
        $nombreProyecto = '';
        $accion = 'registrar';
        $pago = new Pago(require 'php/config.php');
        $conection = new DB(require 'php/config.php');

        if (isset($_GET['idPago'])) {
            $proc = $conection->gestionPago($_GET['idPago'], "", 0, "", 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'S');

            while ($row = $proc->fetch(PDO::FETCH_ASSOC)) {
                $pago->setConcepto($row['concepto']);
                $pago->setImporte($row['importe']);
                $pago->setFechaPago($row['fechaPago']);
                $pago->setEsIngreso($row['esIngreso']);
                $pago->setIdTipoPago($row['idTipoPago']);
                $pago->setIdEtapa($row['idEtapa']);
                $pago->setIdProyecto($row['idProyecto']);
                $pago->setIdArea($row['idArea']);
                $pago->setIdProveedor($row['idProveedor']);
                $pago->setIdCliente($row['idCliente']);
                $pago->setIdAportador($row['idAportador']);
                $pago->setIdBanco($row['idBanco']);
                
                $idPago = $_GET['idPago'];
                $idProyecto = $row['idProyecto'];
                $idTipoArea = $row['tipoArea'];
            }

            $accion = 'editar';
        }

    ?>
    <div class="pago-form">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="ingreso-tab" data-bs-toggle="tab" data-bs-target="#ingreso-tab-pane" type="button" role="tab" aria-controls="ingreso-tab-pane" aria-selected="true">Ingreso</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="egreso-tab" data-bs-toggle="tab" data-bs-target="#egreso-tab-pane" type="button" role="tab" aria-controls="egreso-tab-pane" aria-selected="false">Egreso</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="general-tab" data-bs-toggle="tab" data-bs-target="#general-tab-pane" type="button" role="tab" aria-controls="general-tab-pane" aria-selected="false">General</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="maquinaria-tab" data-bs-toggle="tab" data-bs-target="#maquinaria-tab-pane" type="button" role="tab" aria-controls="general-tab-pane" aria-selected="false">Maquinaria</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <label id="idTipoArea" hidden><?php echo $idTipoArea;?></label>
            <label id="idEsIngreso" hidden><?php echo $pago->getEsIngreso();?></label>
            <div class="tab-pane fade" id="ingreso-tab-pane" role="tabpanel" aria-labelledby="ingreso-tab" tabindex="0">
                <form id="nuevoPagoIng" action="php/Pago_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="form-group" hidden>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="esIngreso" id="esIngreso" value="1" checked>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputOgIngreso">Área</label>
                        <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="origenIngreso" id="inputOgIngreso" onchange="checkIngreso()" required>
                            <option value="1">Crédito</option>
                            <option value="2">Aportación</option>
                            <option value="3">Préstamo</option>
                            <option value="4">Venta</option>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputConcepto">Concepto</label>
                        <input type="text" name="concepto" class="form-control" id="inputConcepto"
                            pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" required value="<?php echo $pago->getConcepto();?>">
                        <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                        <div class="invalid-feedback">
                            Ingrese un nombre válido.
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputImporte">Importe</label>
                        <div class="input-group has-validation">
                            <span class="input-group-text">$</span>
                            <input type="number" name="importe" class="form-control" id="inputImporte" min="0" step="0.01" required value="<?php echo $pago->getImporte();?>">
                            <div class="invalid-feedback">
                                Ingrese un número válido.
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputTipoPago">Método de Pago</label>
                        <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="tipoPago" id="inputTipoPago" required>
                            <?php
                                $procedure = $conection->obtenerTipoPago();
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rows['idTipoPago'] == $pago->getIdTipoPago()) {
                                        echo "<option value=".$rows['idTipoPago']." selected>".$rows['nombre']."</option>";
                                    } else {
                                        echo "<option value=".$rows['idTipoPago'].">".$rows['nombre']."</option>";
                                    }
                                    
                                }
                            ?>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group col-md-3">
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
                    <div class="form-group col-md-3">
                        <label for="inputEtapa">Etapa</label>
                        <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="etapa" id="inputEtapa" required>
                            <option value="0">Todas</option>
                            <?php
                                $procedure = $conection->gestionEtapa(0, 0, 0, $idProyecto, 'S');
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rows['idEtapa'] == $pago->getIdEtapa()) {
                                        echo "<option value=".$rows['idEtapa']." selected>".$rows['numeroEtapa']."</option>";
                                    } else {
                                        echo "<option value=".$rows['idEtapa'].">".$rows['numeroEtapa']."</option>";
                                    }
                                    
                                }
                            ?>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group" id="divAportador">
                        <label for="inputAportador">Aportador</label>
                        <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="aportador" id="inputAportador">
                            <?php
                                $procedure = $conection->gestionAportador(0, '', '', 0, 'S');
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rows['idAportador'] == $pago->getIdAportador()) {
                                        echo "<option value=".$rows['idAportador'].">".$rows['nombre']."</option>";
                                    } else {
                                        echo "<option value=".$rows['idAportador'].">".$rows['nombre']."</option>";
                                    }
                                    
                                }
                            ?>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group" id="divCliente">
                        <label for="inputCliente">Cliente</label>
                        <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="cliente" id="inputCliente">
                            <?php
                                $procedure = $conection->obtenerProspectos();
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rows['idCliente'] == $pago->getIdProveedor()) {
                                        echo "<option value=".$rows['idCliente']." selected>".$rows['nombre']."</option>";
                                    } else {
                                        echo "<option value=".$rows['idCliente'].">".$rows['nombre']."</option>";
                                    }
                                    
                                }
                            ?>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group d-grid">
                        <input id="idProyecto" type="hidden" name="proyectoID" value="<?php echo $idProyecto;?>">
                        <input id="idPago" type="hidden" name="pagoID" value="<?php echo $idPago;?>">
                        <input id="idTipo" type="hidden" name="tipo" value="Ingreso">
                        <input type="hidden" name="accion" value="<?php echo $accion;?>">
                        <button class="btn btn-block btn-primary" type="submit">Agregar</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="egreso-tab-pane" role="tabpanel" aria-labelledby="egreso-tab" tabindex="0">
                <form id="nuevoPagoEgr" action="php/Pago_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="form-group" hidden>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="esIngreso" id="esEgreso" value="0" checked >
                            <label class="form-check-label" for="esEgreso">Egreso</label>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="inputConcepto">Concepto</label>
                        <input type="text" name="concepto" class="form-control" id="inputConcepto"
                            pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" required value="<?php echo $pago->getConcepto();?>">
                        <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                        <div class="invalid-feedback">
                            Ingrese un nombre válido.
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputImporte">Importe</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="importe" class="form-control" id="inputImporte" min="0" step="0.01" required value="<?php echo $pago->getImporte();?>">
                            <div class="invalid-feedback">
                                Ingrese un número válido.
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-4">
                        <label for="inputProyectoEg">Proyecto</label>
                        <select class="form-select" name="proyecto" id="inputProyectoEg" required>
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
                    <div class="form-group col-md-4">
                        <label for="inputEtapaEg">Etapa</label>
                        <select class="form-select" name="etapa" id="inputEtapaEg" required>
                            <option selected disabled value="">Elige...</option>
                            <option value="NULL">Todas</option>
                            <?php
                                $procedure = $conection->gestionEtapa(0, 0, 0, $idProyecto, 'S');
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rows['idEtapa'] == $pago->getIdEtapa()) {
                                        echo "<option value=".$rows['idEtapa']." selected>".$rows['numeroEtapa']."</option>";
                                    } else {
                                        echo "<option value=".$rows['idEtapa'].">".$rows['numeroEtapa']."</option>";
                                    }
                                    
                                }
                            ?>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group col-md-4" id="Areadiv">
                        <label for="inputAreaEg">Área</label>
                        <select class="form-select" name="area" id="inputAreaEg">
                            <option selected disabled value="NULL">Elige...</option>
                            <?php
                                $procedure = $conection->obtenerAreas();
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rows['tipoArea'] == 1) {
                                        if ($rows['idArea'] == $pago->getIdArea()) {
                                            echo "<option value=".$rows['idArea']." selected>".$rows['nombre']."</option>";
                                        } else {
                                            echo "<option value=".$rows['idArea'].">".$rows['nombre']."</option>";
                                        }
                                    }
                                    
                                }
                            ?>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group col-md-8" style="align-self: center;">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="origenEgreso" id="esBancoEg" value="Banco" onclick="checkEgreso()" <?php if(!is_null($pago->getIdBanco())){?> checked <?php }?>>
                            <label class="form-check-label" for="esBancoEg">Créditos</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="origenEgreso" id="esAportacionEg" value="Aportacion" onclick="checkEgreso()" <?php if(!is_null($pago->getIdAportador())){?> checked <?php }?>>
                            <label class="form-check-label" for="esAportacionEg">Aportación</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="origenEgreso" id="esPagoEg" value="Pago" onclick="checkEgreso()" <?php if(!is_null($pago->getIdProveedor())){?> checked <?php }?>>
                            <label class="form-check-label" for="esPagoEg">Pago</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="origenEgreso" id="esDevolucionEg" value="Devolucion" onclick="checkEgreso()" <?php if(!is_null($pago->getIdCliente())){?> checked <?php }?>>
                            <label class="form-check-label" for="esDevolucionEg">Devolución</label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputTipoPago">Método</label>
                        <select class="form-select" name="tipoPago" id="inputTipoPago" required>
                            <option selected disabled value="">Elige...</option>
                            <?php
                                $procedure = $conection->obtenerTipoPago();
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rows['idTipoPago'] == $pago->getIdTipoPago()) {
                                        echo "<option value=".$rows['idTipoPago']." selected>".$rows['nombre']."</option>";
                                    } else {
                                        echo "<option value=".$rows['idTipoPago'].">".$rows['nombre']."</option>";
                                    }
                                    
                                }
                            ?>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group" id="divProveedor">
                        <label for="inputProveedor">Proveedor</label>
                        <select class="form-select" name="proveedor" id="inputProveedorEg" required>
                            <option selected disabled value="">Elige...</option>
                            <?php
                                $procedure = $conection->obtenerProveedores();
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rows['idProveedor'] == $pago->getIdProveedor()) {
                                        echo "<option value=".$rows['idProveedor']." selected>".$rows['nombre']."</option>";
                                    } else {
                                        echo "<option value=".$rows['idProveedor'].">".$rows['nombre']."</option>";
                                    }
                                    
                                }
                            ?>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group" id="divAportadorEg">
                        <label for="inputAportador">Aportador</label>
                        <select class="form-select" name="aportador" id="inputAportadorEg" required>
                            <option selected disabled value="">Elige...</option>
                            <?php
                                $procedure = $conection->gestionAportador(0, '', '', 0, 'S');
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rows['idAportador'] == $pago->getIdAportador()) {
                                        echo "<option value=".$rows['idAportador'].">".$rows['nombre']."</option>";
                                    } else {
                                        echo "<option value=".$rows['idAportador'].">".$rows['nombre']."</option>";
                                    }
                                    
                                }
                            ?>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group" id="divClienteEg">
                        <label for="inputProveedor">Cliente</label>
                        <select class="form-select" name="cliente" id="inputClienteEg" required>
                            <option selected disabled value="">Elige...</option>
                            <?php
                                $procedure = $conection->obtenerProspectos();
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rows['idCliente'] == $pago->getIdProveedor()) {
                                        echo "<option value=".$rows['idCliente']." selected>".$rows['nombre']."</option>";
                                    } else {
                                        echo "<option value=".$rows['idCliente'].">".$rows['nombre']."</option>";
                                    }
                                    
                                }
                            ?>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group d-grid">
                        <input id="idProyecto" type="hidden" name="proyectoID" value="<?php echo $idProyecto;?>">
                        <input id="idPago" type="hidden" name="pagoID" value="<?php echo $idPago;?>">
                        <input id="idTipo" type="hidden" name="tipo" value="Egreso">
                        <input type="hidden" name="accion" value="<?php echo $accion;?>">
                        <button class="btn btn-block btn-primary" type="submit">Agregar</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="general-tab-pane" role="tabpanel" aria-labelledby="general-tab" tabindex="0">
                <form id="nuevoPagoGen" action="php/Pago_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="form-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="esIngreso" id="esIngreso" value="1" <?php if($pago->getEsIngreso() == 1){?> checked <?php }?> required>
                            <label class="form-check-label" for="esIngreso">Ingreso</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="esIngreso" id="esEgreso" value="0" <?php if($pago->getEsIngreso() == 0){?> checked <?php }?> required>
                            <label class="form-check-label" for="esEgreso">Egreso</label>
                        </div>
                    </div>
                    
                    <div class="form-group col-md-6">
                        <label for="inputConcepto">Concepto</label>
                        <input type="text" name="concepto" class="form-control" id="inputConcepto"
                            pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" required value="<?php echo $pago->getConcepto();?>">
                        <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                        <div class="invalid-feedback">
                            Ingrese un nombre válido.
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputImporte">Importe</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="importe" class="form-control" id="inputImporte" min="0" step="0.01" required value="<?php echo $pago->getImporte();?>">
                            <div class="invalid-feedback">
                                Ingrese un número válido.
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputArea">Área</label>
                        <select class="form-select" name="area" id="inputAreaG" onchange="" required>
                            <option selected disabled value="">Elige...</option>
                            <?php
                                $procedure = $conection->obtenerAreas();
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rows['tipoArea'] == 2) {
                                        if ($rows['idArea'] == $pago->getIdArea()) {
                                            echo "<option value=".$rows['idArea']." selected>".$rows['nombre']."</option>";
                                        } else {
                                            echo "<option value=".$rows['idArea'].">".$rows['nombre']."</option>";
                                        }
                                    }
                                    
                                }
                            ?>
                        </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputTipoPago">Método</label>
                        <select class="form-select" name="tipoPago" id="inputTipoPago" required>
                            <option selected disabled value="">Elige...</option>
                            <?php
                                $procedure = $conection->obtenerTipoPago();
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rows['idTipoPago'] == $pago->getIdTipoPago()) {
                                        echo "<option value=".$rows['idTipoPago']." selected>".$rows['nombre']."</option>";
                                    } else {
                                        echo "<option value=".$rows['idTipoPago'].">".$rows['nombre']."</option>";
                                    }
                                    
                                }
                            ?>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group d-grid">
                        <input id="idProyecto" type="hidden" name="proyectoID" value="<?php echo $idProyecto;?>">
                        <input id="idPago" type="hidden" name="pagoID" value="<?php echo $idPago;?>">
                        <input id="idTipo" type="hidden" name="tipo" value="General">
                        <input type="hidden" name="accion" value="<?php echo $accion;?>">
                        <button class="btn btn-block btn-primary" type="submit">Agregar</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="maquinaria-tab-pane" role="tabpanel" aria-labelledby="general-tab" tabindex="0">
                <form id="nuevoPagoGen" action="php/Pago_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                    <div class="form-group col-md-12">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="esIngreso" id="esIngresoMaq" value="1" <?php if($pago->getEsIngreso() == 1){?> checked <?php }?> required>
                            <label class="form-check-label" for="esIngreso">Ingreso</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="esIngreso" id="esEgresoMaq" value="0" <?php if($pago->getEsIngreso() == 0){?> checked <?php }?> required>
                            <label class="form-check-label" for="esEgreso">Egreso</label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputArea">Concepto</label>
                        <select class="form-select" name="concepto" id="inputConcepto" onchange="" required>
                            <option selected disabled value="">Elige...</option>
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
                    <div class="form-group col-md-4">
                        <label for="inputImporte">Importe</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number" name="importe" class="form-control" id="inputImporte" min="0" step="0.01" required value="<?php echo $pago->getImporte();?>">
                            <div class="invalid-feedback">
                                Ingrese un número válido.
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputMaquina">Maquinaria</label>
                        <select class="form-select" name="maquina" id="inputMaquina" onchange="" required>
                            <option selected disabled value="">Elige...</option>
                            <?php
                                $procedure = $conection->obtenerMaquinaria();
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
                        <label for="inputProyectoMaq">Proyecto</label>
                        <select class="form-select" name="proyecto" id="inputProyectoMaq" required>
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
                    <div class="form-group col-md-4">
                        <label for="inputEtapaMaq">Etapa</label>
                        <select class="form-select" name="etapa" id="inputEtapaMaq" required>
                            <option selected disabled value="">Elige...</option>
                            <option value="0">Todas</option>
                            <?php
                                $procedure = $conection->gestionEtapa(0, 0, 0, $idProyecto, 'S');
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rows['idEtapa'] == $pago->getIdEtapa()) {
                                        echo "<option value=".$rows['idEtapa']." selected>".$rows['numeroEtapa']."</option>";
                                    } else {
                                        echo "<option value=".$rows['idEtapa'].">".$rows['numeroEtapa']."</option>";
                                    }
                                    
                                }
                            ?>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputTipoPago">Método</label>
                        <select class="form-select" name="tipoPago" id="inputTipoPago" required>
                            <option selected disabled value="">Elige...</option>
                            <?php
                                $procedure = $conection->obtenerTipoPago();
                                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rows['idTipoPago'] == $pago->getIdTipoPago()) {
                                        echo "<option value=".$rows['idTipoPago']." selected>".$rows['nombre']."</option>";
                                    } else {
                                        echo "<option value=".$rows['idTipoPago'].">".$rows['nombre']."</option>";
                                    }
                                    
                                }
                            ?>
                            </select>
                        <div class="invalid-feedback">
                            Elija una opción.
                        </div>
                    </div>
                    <div class="form-group d-grid">
                        <input id="idProyecto" type="hidden" name="proyectoID" value="<?php echo $idProyecto;?>">
                        <input id="idPago" type="hidden" name="pagoID" value="<?php echo $idPago;?>">
                        <input id="idTipo" type="hidden" name="tipo" value="Maquinaria">
                        <input type="hidden" name="accion" value="<?php echo $accion;?>">
                        <button class="btn btn-block btn-primary" type="submit">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/Detalle_Pago.js"></script>
</body>
</html>