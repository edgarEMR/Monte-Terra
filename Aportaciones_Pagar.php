<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aportaciones Por Pagar</title>
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

        $idTipoPago = 0;
        $nombre = '';
        $conection = new DB(require 'php/config.php');

        if (isset($_GET['id'])) {
            $idProyecto = $_GET['id'];
            $procedure = $conection->spObtenerAportaciones($idProyecto);

        }

        
    ?>

    <h2 class="text-primary"><?php echo strtoupper($nombre);?></h2>
    
    <div id="tabla-desglose-portafolio" class="table-responsive">    

        <table id="tabla-portafolio" class="table table-hover table-bordered">
            <thead>
                <tr class="table-primary">
                    <th col-index = 1>FECHA
                    <select class="table-filter" onchange="filter_rows()">
                        <option value="all">Todos</option>
                    </select></th>
                    <th col-index = 2>IMPORTE</th>
                    <th col-index = 3>CONCEPTO</th>
                    <th col-index = 4>APORTADOR
                    <select class="table-filter" onchange="filter_rows()">
                        <option value="all">Todos</option>
                    </select></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total = 0;
                    while($rows = $procedure->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>";
                        echo "<td>" . $rows['fechaPago'] . "</td>";
                        echo "<td>$" . number_format($rows['importe'], 2) . "</td>";
                        echo "<td>" . $rows['concepto'] . "</td>";
                        echo "<td>" . $rows['aportador'] . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Aportaciones_Pagar.js"></script>
</body>
</html>