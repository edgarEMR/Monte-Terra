<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link rel="stylesheet" href="css/Ventas.css">
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
        $idEtapa = 0;
        $numeroEtapa = 0;
        $nombreProyecto = "";

        if(isset($_GET["id"]))
        {
            $idEtapa = $_GET["id"];
            $proc = $conection->gestionEtapa($idEtapa, '', 0, 0, 0, 0, 'E');
            $rows = $proc->fetch(PDO::FETCH_ASSOC);

            $numeroEtapa = $rows['numeroEtapa'];
            $nombreProyecto = $rows['nombre'];
        }
    ?>

    <div id="resumen" class="table-responsive">
        
        <div id="titulo">
            <!--TOTAL DE CLIENTES POR PROYECTO-->
            <h2 class="text-primary"><?php echo $nombreProyecto . " | Etapa " . $numeroEtapa;?></h2>
        </div>
        
        <table id="tabla-resumen" class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th>NOMBRE</th>
                    <th>LOTE</th>
                    <th>MANZANA</th>
                    <th>PRECIO VENTA</th>
                    <th>PAGADO</th>
                    <th>PENDIENTE</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $procedure = $conection->resumenVentasEtapa($idEtapa);
                    while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td>" . $rows['nombre'] . "</td>";
                        echo "<td>" . $rows['lote'] . "</td>";
                        echo "<td>" . $rows['manzana'] . "</td>";
                        echo "<td>" . $rows['precio'] . "</td>";
                        echo "<td>" . $rows['pagado'] . "</td>";
                        echo "<td>" . $rows['pendiente'] . "</td>";
                        echo "</tr>";
                    }
                ?>
                <tr class="table-success">
                    <td>TOTAL</td>
                    <td colspan="4"></td>
                    <td>TOTAL PENDIENTE</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Ventas_Detalle.js"></script>
</body>
</html>