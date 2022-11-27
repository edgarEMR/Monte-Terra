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
        include_once('modelos/Pago.php');
        include_once('php/conection.php');

        $idProyecto = 0;
        $idPago = 0;
        $nombreProyecto = '';
        $accion = 'registrar';
        $pago = new Pago(require 'php/config.php');
        $conection = new DB(require 'php/config.php');

        if (isset($_GET['id']) && !is_null($_GET['id'])) {
            $idProyecto = $_GET['id'];
            $proc = $conection->gestionProyecto($idProyecto, '', 0, 0, 0, 'S');
            $rows = $proc->fetch(PDO::FETCH_ASSOC);

            $nombreProyecto = $rows['nombre'];
        }

        if (isset($_GET['idPago'])) {
            $proc = $conection->gestionPago($_GET['idPago'], "", 0, "", 0, "", 0, 0, 0, 'S');

            while ($row = $proc->fetch(PDO::FETCH_ASSOC)) {
                $pago->setConcepto($row['concepto']);
                $pago->setImporte($row['importe']);
                $pago->setFechaPago($row['fechaPago']);
                $pago->setEsIngreso($row['esIngreso']);
                $pago->setArea($row['area']);
                $pago->setExtra($row['extra']);
                $pago->setIdTipoPago($row['idTipoPago']);
                $pago->setIdEtapa($row['idEtapa']);
                $pago->setIdProyecto($row['idProyecto']);
                $idPago = $_GET['idPago'];
                $idProyecto = $row['idProyecto'];   
            }

            $accion = 'editar';
        }

    ?>
    <div class="pago-form">
        <form id="nuevoPago" action="php/Pago_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
             <div class="form-group">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="esIngreso" id="esIngreso" value="1" <?php if($pago->getEsIngreso() == 1){?> checked <?php }?> >
                    <label class="form-check-label" for="esIngreso">Ingreso</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="esIngreso" id="esEgreso" value="0" <?php if($pago->getEsIngreso() == 0){?> checked <?php }?> >
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
                <label for="inputArea">Área</label>
                <input type="text" name="area" class="form-control" id="inputArea"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" maxlength="3" required value="<?php echo $pago->getArea();?>">
                <div class="invalid-feedback">
                    Ingrese un nombre válido.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputEtapa">Proyecto</label>
                <select class="form-select" name="proyecto" id="inputProyecto" required>
                    <option selected disabled value="">Elige...</option>
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
                <select class="form-select" name="etapa" id="inputEtapa" required>
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
            <div class="form-group col-md-4">
                <label for="inputTipoPago">Tipo de Pago</label>
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
                <input type="hidden" name="accion" value="<?php echo $accion;?>">
                <button class="btn btn-block btn-primary" type="submit">Agregar</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Detalle_Pago.js"></script>
</body>
</html>