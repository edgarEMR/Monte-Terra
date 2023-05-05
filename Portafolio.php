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
            $proc = $conection->gestionProyecto($idProyecto, '', 0, 0, 0, 'S');
            $rows = $proc->fetch(PDO::FETCH_ASSOC);

            $nombreProyecto = $rows['nombre'];
        }
        
        $procedure = $conection->obtenerPortafolio(0, $idProyecto);
        
    ?>

    <div id="titulo">
        <h2 class="text-primary">PORTAFOLIO <?php echo strtoupper($nombreProyecto);?>
        <button type="button" onclick="sendVariables('Nuevo_Proyecto.php', <?php echo $idProyecto?>, 'id')" class="btn btn-outline-primary"><i class="bi bi-pencil-fill"></i></button>
        </h2>
        
    </div>
    
    <div id="tabla-desglose-portafolio" class="table-responsive">    

        <table id="tabla-portafolio" class="table table-hover table-bordered">
            <?php
                if($idProyecto != 13) {
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
                    <th>PROVEEDOR <br>
                    <select class="table-filter" onchange="filter_rows()">
                        <option value="all">Todos</option>
                    </select>
                    </th>
                    <th>TIPO DE PAGO <br>
                    <select class="table-filter" onchange="filter_rows()">
                        <option value="all">Todos</option>
                    </select>
                    </th>
                    <th>ÁREA <br>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Portafolio.js"></script>
</body>
</html>