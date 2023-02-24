<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos</title>
    <link rel="stylesheet" href="css/Proyectos.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    <div id="navigation" class="top">

    </div>

    <?php
        ob_start();
        include_once('php/conection.php');

        $date = '';
        $conection = new DB(require 'php/config.php');

        if(isset($_GET['date'])){
            $date = $_GET['date'];
        } else {
            $date = $conection->getCurrent_date();
        }
        
        $procedure = $conection->obtenerResumen($date);
        $rows = $procedure->fetch(PDO::FETCH_ASSOC);

    ?>
    

    <div id="resumen" class="table-responsive">
        <!--diferencia hoy vs pasadp-->
        <div id="titulo">
            <h2 class="text-primary">Resumen</h2>
            <div id="selector-semana" class="input-group mb-3">
                <button class="btn btn-outline-secondary" type="button" onclick="subDays('<?php echo $date;?>');"><i class="bi bi-caret-left-fill"></i></button>
                <input id="inputDate" type="text" class="form-control" placeholder="" aria-label="Example text with two button addons" disabled value="<?php echo date_format(date_create($date), 'd-m-Y');?>">
                <button class="btn btn-outline-secondary" type="button" onclick="addDays('<?php echo $date;?>');"><i class="bi bi-caret-right-fill"></i></button>
            </div>
        </div>
        
        <table id="tabla-resumen" class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th>PROYECTO</th>
                    <th>PORTAFOLIO PASADO <br> <?php echo date_format(date_create($rows['pasado']), 'd-m-Y');?></th>
                    <th>INGRESOS</th>
                    <th>EGRESOS</th>
                    <th>PORTAFOLIO ACTUAL <br> <?php echo date_format(date_create($rows['hoy']), 'd-m-Y');?></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sumaPasado = 0;
                    $sumaIng = 0;
                    $sumaEgr = 0;
                    $sumaHoy = 0;

                    $procedure = $conection->obtenerResumen($date);
                    while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td><a onclick=\"sendVariables('Portafolio.php', " . $rows['idProyecto'] . ", 'id');\">" . $rows['nombre'] . "</a></td>";
                        echo "<td>$" . number_format($rows['totalPasado'], 2) . "</td>";
                        echo "<td>$" . number_format($rows['ingreso'], 2) . "</td>";
                        echo "<td>$" . number_format($rows['egreso'], 2) . "</td>";
                        echo "<td>$" . number_format($rows['totalHoy'], 2) . "</td>";
                        echo "</tr>";

                        $sumaPasado += $rows['totalPasado'];
                        $sumaIng += $rows['ingreso'];
                        $sumaEgr += $rows['egreso'];
                        $sumaHoy += $rows['totalHoy'];
                    }
                ?>
                <tr class="table-success">
                    <td>TOTAL</td>
                    <td><?php echo "$" . number_format($sumaPasado, 2);?></td>
                    <td><?php echo "$" . number_format($sumaIng, 2);?></td>
                    <td><?php echo "$" . number_format($sumaEgr, 2);?></td>
                    <td><?php echo "$" . number_format($sumaHoy, 2);?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="bancos" class="table-responsive">
        
        <div id="titulo">
            <h2 class="text-primary">Bancos</h2>
        </div>
        
        <table id="tabla-resumen" class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th>BANCOS</th>
                    <th>ANTERIOR</th>
                    <th>ACTUAL</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $sumaPasadoB = 0;
                    $sumaHoyB = 0;

                    $procedure = $conection->obtenerBancos($date);
                    while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td><a onclick=\"sendVariables('Bancos.php', " . $rows['idTipoPago'] . ", 'id');\">" . $rows['nombre'] . "</a></td>";
                        echo "<td>$" . number_format($rows['totalPasado'], 2) . "</td>";
                        echo "<td>$" . number_format($rows['totalHoy'], 2) . "</td>";
                        echo "</tr>";

                        $sumaPasadoB += $rows['totalPasado'];
                    }

                    $sumaHoyB = $sumaPasadoB + $sumaIng - $sumaEgr;

                ?>
                <tr class="table-success">
                    <td>TOTAL</td>
                    <td><?php echo "$" . number_format($sumaPasadoB, 2);?></td>
                    <td><?php echo "$" . number_format($sumaHoyB, 2);?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <!--UNIR LAS SIGUIENTES DOS-->
    <div id="resumen" class="table-responsive">
        
        <div id="titulo">
            <h2 class="text-primary">Aportaciones Por Pagar</h2>
        </div>
        
        <table id="tabla-resumen" class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th>PROYECTO</th>
                    <th>MONTO</th>
                    <th>PAGADO</th>
                    <th>PENDIENTE</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $pendiente = 0;
                    $sumaMonto = 0;
                    $sumaPagado = 0;
                    $sumaPendiente = 0;

                    $procedure = $conection->porPagarAportador();
                    while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td><a onclick=\"sendVariables('Portafolio.php', " . $rows['idProyecto'] . ", 'id');\">" . $rows['nombre'] . "</a></td>";
                        echo "<td>$" . number_format($rows['monto'], 2) . "</td>";
                        echo "<td>$" . number_format($rows['pagado'], 2) . "</td>";
                        $pendiente = $rows['monto'] - number_format($rows['pagado']);
                        echo "<td>$" . number_format($pendiente, 2) . "</td>";
                        echo "</tr>";

                        $sumaMonto += $rows['monto'];
                        $sumaPagado += $rows['pagado'];
                        $sumaPendiente += $pendiente;
                    }
                ?>
                <tr class="table-success">
                    <td>TOTAL</td>
                    <td><?php echo "$" . number_format($sumaMonto, 2);?></td>
                    <td><?php echo "$" . number_format($sumaPagado, 2);?></td>
                    <td><?php echo "$" . number_format($sumaPendiente, 2);?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="resumen" class="table-responsive">
        
        <div id="titulo">
            <h2 class="text-primary">Créditos Por Pagar</h2>
        </div>
        
        <table id="tabla-resumen" class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th>PROYECTO</th>
                    <th>MONTO</th>
                    <th>PAGADO</th>
                    <th>PENDIENTE S/ INTERESES</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                    $pendiente = 0;
                    $sumaMonto = 0;
                    $sumaPagado = 0;
                    $sumaPendiente = 0;

                    $procedure = $conection->porPagarBanco();
                    while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td><a onclick=\"sendVariables('Portafolio.php', " . $rows['idProyecto'] . ", 'id');\">" . $rows['nombre'] . "</a></td>";
                        echo "<td>$" . number_format($rows['monto'], 2) . "</td>";
                        echo "<td>$" . number_format($rows['pagado'], 2) . "</td>";
                        $pendiente = $rows['monto'] - number_format($rows['pagado']);
                        echo "<td>$" . number_format($pendiente, 2) . "</td>";
                        echo "</tr>";

                        $sumaMonto += $rows['monto'];
                        $sumaPagado += $rows['pagado'];
                        $sumaPendiente += $pendiente;
                    }
                ?>
                <tr class="table-success">
                    <td>TOTAL</td>
                    <td><?php echo "$" . number_format($sumaMonto, 2);?></td>
                    <td><?php echo "$" . number_format($sumaPagado, 2);?></td>
                    <td><?php echo "$" . number_format($sumaPendiente, 2);?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Proyectos.js"></script>
</body>
</html>