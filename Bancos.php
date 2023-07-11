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
        include_once('php/conection.php');

        $idTipoPago = 0;
        $nombre = '';
        $conection = new DB(require 'php/config.php');

        if (isset($_GET['id'])) {
            $idTipoPago = $_GET['id'];
            $proc = $conection->obtenerTipoPago();
            while($rows = $proc->fetch(PDO::FETCH_ASSOC)) {
                if ($rows['idTipoPago'] == $idTipoPago) {
                    $nombre = $rows['nombre'];
                }
            }
            
        }

        $procedure = $conection->obtenerPagoBanco($idTipoPago);
        
    ?>

    <h2 class="text-primary"><?php echo strtoupper($nombre);?></h2>
    
    <div id="tabla-desglose-portafolio" class="table-responsive">    

        <table id="tabla-portafolio" class="table table-hover table-bordered">
            <thead>
                <tr class="table-primary">
                    <th col-index = 1>FECHA <br>
                    <select class="table-filter" onchange="filter_rows()">
                        <option value="all">Todos</option>
                    </select></th>
                    <th>INGRESO</th>
                    <th>EGRESO</th>
                    <th>CONCEPTO</th>
                    <th>ÁREA</th>
                    <th>PROYECTO</th>
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
                            $total += $rows['importe'];
                        } else {
                            echo "<td>-</td>";
                            echo "<td>$" . number_format($rows['importe'], 2) . "</td>";
                            $total -= $rows['importe'];
                        }
                        echo "<td><a onclick=\"sendVariables('Detalle_Pago.php', " . $rows['idPago'] . ", 'idPago');\">" . $rows['concepto'] . "</a></td>";
                        echo "<td>" . $rows['familia'] . "</td>";
                        echo "<td>" . $rows['proyecto'] . "</td>";
                        echo "<td>$" . number_format($total, 2) . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Bancos.js"></script>
</body>
</html>