<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portafolio</title>
    <link rel="stylesheet" href="css/Portafolio.css">
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

        $idProyecto = 0;
        $nombreProyecto = '';
        $conection = new DB(require 'php/config.php');

        if (isset($_GET['id'])) {
            $idProyecto = $_GET['id'];
            $proc = $conection->gestionProyecto($idProyecto, '', 0, 0, 0, 0, 0, 'S');
            $rows = $proc->fetch(PDO::FETCH_ASSOC);

            $nombreProyecto = $rows['nombre'];
        }
        
        $procedure = $conection->obtenerPortafolio(0, $idProyecto);
        $_SESSION['proyectoID'] = $idProyecto;
    ?>

    <div id="titulo">
        <h2 class="text-primary">PORTAFOLIO <?php echo strtoupper($nombreProyecto);?>
            <button type="button" onclick="sendVariables('Nuevo_Proyecto.php', <?php echo $idProyecto?>, 'id')"
                class="btn btn-outline-primary"><i class="bi bi-pencil-fill"></i></button>
        </h2>

    </div>

    <div id="tabla-desglose-portafolio" class="table-responsive">

        <table id="tabla-portafolio" class="table table-hover table-bordered align-middle">
            <?php
                if($idProyecto != 13) {
            ?>
            <thead>
                <tr class="table-primary">
                    <th col-index=1>FOLIO</th>
                    <th col-index=2>FECHA
                        <select class="table-filter" onchange="filter_rows()">
                            <option value="all">Todos</option>
                        </select>
                    </th>
                    <th col-index=3>INGRESO</th>
                    <th col-index=4>EGRESO</th>
                    <th col-index=5>CONCEPTO
                        <select class="table-filter" onchange="filter_rows()">
                            <option value="all">Todos</option>
                        </select>
                    </th>
                    <th col-index=6>PROVEEDOR
                        <select class="table-filter" onchange="filter_rows()">
                            <option value="all">Todos</option>
                        </select>
                    </th>
                    <th col-index=7>TIPO DE PAGO
                        <select class="table-filter" onchange="filter_rows()">
                            <option value="all">Todos</option>
                        </select>
                    </th>
                    <th col-index=8>ÁREA
                        <select class="table-filter" onchange="filter_rows()">
                            <option value="all">Todos</option>
                        </select>
                    </th>
                    <th col-index=9>ETAPA</th>
                    <th col-index=10>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total = 0;
                    while($rows = $procedure->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>";
                        echo "<td>" . $rows['folioPago'] . "</td>";
                        echo "<td>" . $rows['fechaPago'] . "</td>";
                        if($rows['esIngreso']){
                            echo "<td>$" . number_format($rows['importe'], 2) . "</td>";
                            echo "<td>-</td>";
                            $total -= $rows['importe'];
                        } else {
                            echo "<td>-</td>";
                            echo "<td>$" . number_format($rows['importe'], 2) . "</td>";
                            $total += $rows['importe'];
                        }
                        echo "<td><a onclick=\"sendVariables('Detalle_Pago.php', " . $rows['idPago'] . ", 'idPago');\">" . $rows['concepto'] . "</a></td>";
                        echo "<td>" . $rows['nombre'] . "</td>";
                        echo "<td>" . $rows['nombrePago'] . "</td>";
                        echo "<td>" . $rows['clave'] . "</td>";
                        echo "<td>" . $rows['numeroEtapa'] . "</td>";
                        echo "<td>$" . number_format($total, 2) . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
            <?php
                } else {
            ?>
            <thead>
                <tr class="table-primary">
                    <th>FECHA <br>
                        <select class="table-filter" onchange="filter_rows()">
                            <option value="all">Todos</option>
                        </select>
                    </th>
                    <th>INGRESO</th>
                    <th>EGRESO</th>
                    <th>CONCEPTO</th>
                    <th>MAQUINARIA <br>
                        <select class="table-filter" onchange="filter_rows()">
                            <option value="all">Todos</option>
                        </select>
                    </th>
                    <th>TIPO DE PAGO <br>
                        <select class="table-filter" onchange="filter_rows()">
                            <option value="all">Todos</option>
                        </select>
                    </th>
                    <th>PROYECTO <br>
                        <select class="table-filter" onchange="filter_rows()">
                            <option value="all">Todos</option>
                        </select>
                    </th>
                    <th>ETAPA</th>
                    <th>TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total = 0;
                    while($rows = $procedure->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>";
                        echo "<td>" . $rows['fechaPago'] . "</td>";
                        if($rows['esIngreso']){
                            echo "<td>$" . number_format($rows['importe'], 2) . "</td>";
                            echo "<td>-</td>";
                            $total -= $rows['importe'];
                        } else {
                            echo "<td>-</td>";
                            echo "<td>$" . number_format($rows['importe'], 2) . "</td>";
                            $total += $rows['importe'];
                        }
                        echo "<td><a onclick=\"sendVariables('Detalle_Pago.php', " . $rows['idPago'] . ", 'idPago');\">" . $rows['concepto'] . "</a></td>";
                        echo "<td>" . $rows['nombreMaquina'] . "</td>";
                        echo "<td>" . $rows['nombrePago'] . "</td>";
                        echo "<td>" . $rows['nombreProyecto'] . "</td>";
                        echo "<td>" . (is_null($rows['numeroEtapa'])? "Todas" : $rows['numeroEtapa']) . "</td>";
                        echo "<td>$" . number_format($total, 2) . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
            <?php
                }
            ?>
        </table>
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
    <script src="js/Portafolio.js"></script>
</body>

</html>