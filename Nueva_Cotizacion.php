<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cotización</title>
    <link rel="stylesheet" href="css/Nueva_Cotizacion.css">
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
        include_once('modelos/Presupuesto.php');
        include_once('php/conection.php');

        $idProyecto = 0;
        $idPresupuesto = 0;
        $nombreProyecto = '';
        $presupuestoProyecto = 0;
        $accion = 'registrar';
        $presupuesto = new Presupuesto(require 'php/config.php');
        $conection = new DB(require 'php/config.php');
        
    ?>
    
    <div class="presupuesto-form">
        <form id="nuevoPresupuesto" action="php/Cotizacion_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
            <div class="form-group col-md-4">
                <label for="inputEtapa">Proyecto</label>
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
                    <option value="-1">Todas</option>
                    <?php
                        $procedure = $conection->gestionEtapa(0, 0, 0, 0, 0, $idProyecto, 'S');
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
                <label for="inputFamilia">Familia</label>
                <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="familia" id="inputFamilia" onchange="checkCotizacion()" required>
                    <?php
                        $procedure = $conection->obtenerFamilias();
                        while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                            if ($rows['idFamilia'] == 5 || $rows['idFamilia'] == 11) {
                                echo "<option value=".$rows['idFamilia'].">".$rows['nombre']."</option>";
                                
                            }
                        }
                    ?>
                    </select>
                <div class="invalid-feedback">
                    Elija una opción.
                </div>
            </div>
            <div class="form-group col-md-3" id="divConcepto">
                <label for="inputConcepto">Concepto</label>
                <input type="text" name="concepto" class="form-control" id="inputConcepto"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" required value="<?php echo $presupuesto->getConcepto();?>">
                <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                <div class="invalid-feedback">
                    Ingrese un nombre válido.
                </div>
            </div>
            <div class="form-group col-md-6" id="divConceptoLista">
                <label for="inputConceptoLista">Concepto</label>
                <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="conceptoLista" id="inputConceptoLista">
                    <option value="Terracerías">Terracerías</option>
                    <option value="Agua Potable">Agua Potable</option>
                    <option value="Drenaje">Drenaje</option>
                    <option value="Gas">Gas</option>
                    <option value="Electricidad">Electricidad</option>
                    <option value="Alumbrado Público">Alumbrado Público</option>
                    <option value="Pavimentación">Pavimentación</option>
                    <option value="Cordones">Cordones</option>
                </select>
                <div class="invalid-feedback">
                    Elija una opción.
                </div>
            </div>
            <div class="form-group col-md-2" id="divNumCasas">
                <label for="inputNumCasas"># Casas</label>
                <input type="number" name="numeroCasas" class="form-control" id="inputNumCasas" min="1" value="1" value="<?php ?>" oninput="calcularImporte()">
                <div class="invalid-feedback">
                    Ingrese un número válido.
                </div>
            </div>
            <div class="form-group col-md-2" id="divPrecioM">
                <label for="inputImporteM2">Precio M2</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">$</span>
                    <input type="number" name="importeM2" class="form-control" id="inputImporteM2" min="0" value="<?php echo $presupuesto->getImporte();?>" oninput="calcularImporte()">
                    <div class="invalid-feedback">
                        Ingrese un número válido.
                    </div>
                </div>
            </div>
            <div class="form-group col-md-2" id="divMetros2">
                <label for="inputMetros2">Metros 2</label>
                <input type="number" name="metros2" class="form-control" id="inputMetros2" min="1" value="1" value="<?php ?>" oninput="calcularImporte()">
                <div class="invalid-feedback">
                    Ingrese un número válido.
                </div>
            </div>
            <div class="form-group" id="divImporte">
                <label for="inputImporte">Importe</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">$</span>
                    <input type="number" name="importe" class="form-control" id="inputImporte" min="0" required value="<?php echo $presupuesto->getImporte();?>">
                    <div class="invalid-feedback">
                        Ingrese un número válido.
                    </div>
                </div>
            </div>
            <div class="form-group d-grid">
                <input id="idProyecto" type="hidden" name="proyectoID" value="<?php echo $idProyecto;?>">
                <input type="hidden" name="presupuestoID" value="<?php echo $idPresupuesto;?>">
                <input type="hidden" name="accion" value="<?php echo $accion;?>">
                <button class="btn btn-block btn-primary" type="submit">Agregar</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/Nueva_Cotizacion.js"></script>
</body>
</html>