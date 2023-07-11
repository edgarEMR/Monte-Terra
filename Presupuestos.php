<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presupuesto</title>
    <link rel="stylesheet" href="css/Presupuesto.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
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

        if (isset($_GET['id'])) {
            $idProyecto = $_GET['id'];
            $proc = $conection->gestionProyecto($idProyecto, '', 0, 0, 0, 'S');
            $rows = $proc->fetch(PDO::FETCH_ASSOC);

            $nombreProyecto = $rows['nombre'];
            $presupuestoProyecto = $rows['presupuestoProyecto'];
        }

        if (isset($_GET['idPresupuesto'])) {
            $idPresupuesto = $_GET['idPresupuesto'];
            $proc = $conection->gestionPresupuesto($idPresupuesto, '', 0, '', 0, 0, 'O');

            while($row = $proc->fetch(PDO::FETCH_ASSOC)) {
                $presupuesto->setIdPresupuesto($idPresupuesto);
                $presupuesto->setConcepto($row['concepto']);
                $presupuesto->setImporte($row['importe']);
                $presupuesto->setFecha($row['fecha']);
                $presupuesto->setIdArea($row['idArea']);
                $presupuesto->setIdProyecto($row['idProyecto']);

                $idProyecto = $row['idProyecto'];
            }

            $accion = 'editar';
        }
        
    ?>
    
    <h2 class="text-primary">Presupuesto <?php echo strtoupper($nombreProyecto);?> - $<?php echo number_format($presupuestoProyecto, 2);?></h2>
    
    <div class="presupuesto-form">
        <form id="nuevoPresupuesto" action="php/Presupuesto_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
            <!-- <div class="form-group col-md-4">
                <label for="inputConcepto">Concepto</label>
                <input type="text" name="concepto" class="form-control" id="inputConcepto"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" required value="<?php echo $presupuesto->getConcepto();?>">
                <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                <div class="invalid-feedback">
                    Ingrese un nombre válido.
                </div>
            </div> -->
            <div class="form-group col-md-6">
                <label for="inputImporte">Importe</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" name="importe" class="form-control" id="inputImporte" min="0" required value="<?php echo $presupuesto->getImporte();?>">
                    <div class="invalid-feedback">
                        Ingrese un número válido.
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="inputArea">Área</label>
                <select class="form-select" name="area" id="inputArea" required>
                    <option selected disabled value="">Elige...</option>
                    <?php
                        $procedure = $conection->obtenerFamilias();
                        while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value=".$rows['idFamilia'].">".$rows['nombre']."</option>";
                        }
                    ?>
                    </select>
                <div class="invalid-feedback">
                    Elija una opción.
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

    <div id="tabla-desglose-presupuesto" class="table-responsive">    
        
        <table id="tabla-presupuesto" class="table table-hover table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>AREA</th>
                    <th>IMPORTE</th>
                    <th>PORCENTAJE</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sumaImporte = 0;
                    $sumaPorcentaje = 0;

                    $procedure = $conection->presupuestoFamilia($idProyecto);
                    while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $rows['nombre'] . "</td>";
                        echo "<td>$" . number_format($rows['importe'], 2) . "</td>";
                        echo "<td>" . number_format($rows['porcentaje'], 2) . "%</td>";
                        echo "</tr>";

                        $sumaImporte += $rows['importe'];
                        $sumaPorcentaje += $rows['porcentaje'];
                    }

                ?>
                <tr class="table-success">
                    <td>TOTAL</td>
                    <td><?php echo "$" . number_format($sumaImporte, 2);?></td>
                    <td><?php echo number_format($sumaPorcentaje, 2) . "%";?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Presupuesto.js"></script>
</body>
</html>