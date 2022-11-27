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
                $presupuesto->setIdEtapa($row['idEtapa']);
                $presupuesto->setIdProyecto($row['idProyecto']);

                $idProyecto = $row['idProyecto'];
            }

            $accion = 'editar';
        }
        
    ?>
    
    <h2 class="text-primary">Presupuesto <?php echo strtoupper($nombreProyecto);?> - $<?php echo number_format($presupuestoProyecto, 2);?></h2>
    
    <div class="presupuesto-form">
        <form id="nuevoPresupuesto" action="php/Presupuesto_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
            <div class="form-group col-md-4">
                <label for="inputConcepto">Concepto</label>
                <input type="text" name="concepto" class="form-control" id="inputConcepto"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" required value="<?php echo $presupuesto->getConcepto();?>">
                <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                <div class="invalid-feedback">
                    Ingrese un nombre válido.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputImporte">Importe</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" name="importe" class="form-control" id="inputImporte" min="0" required value="<?php echo $presupuesto->getImporte();?>">
                    <div class="invalid-feedback">
                        Ingrese un número válido.
                    </div>
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
                            if ($rows['idEtapa'] == $presupuesto->getIdEtapa()) {
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
                    <th>CONCEPTO</th>
                    <th>IMPORTE</th>
                    <th>FECHA</th>
                    <th>ETAPA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $procedure = $conection->gestionPresupuesto(0, '', 0, '', 0, $idProyecto, 'S');
                    while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td><a onclick=\"sendVariables('Presupuestos.php', " . $rows['idPresupuesto'] . ", 'idPresupuesto');\">" . $rows['concepto'] . "</a></td>";
                        echo "<td>$" . $rows['importe'] . "</td>";
                        echo "<td>" . $rows['fecha'] . "</td>";
                        if($rows['numeroEtapa'] == null){
                            echo "<td>Todas</td>";
                        } else {
                            echo "<td>" . $rows['numeroEtapa'] . "</td>";
                        }
                        echo "</tr>";
                    }

                    $conection = NULL;
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Presupuesto.js"></script>
</body>
</html>