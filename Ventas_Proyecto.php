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
        $idProyecto = 0;
        $nombreProyecto = "";

        if(isset($_GET["id"]))
        {
            $idProyecto = $_GET["id"];
            $proc = $conection->gestionProyecto($idProyecto, '', 0, 0, 0, 'S');
            $rows = $proc->fetch(PDO::FETCH_ASSOC);

            $nombreProyecto = $rows['nombre'];
        }
    ?>

    <div id="resumen" class="table-responsive">
        
        <div id="titulo">
            <!--TOTAL DE CLIENTES POR PROYECTO-->
            <h2 class="text-primary"><?php echo $nombreProyecto;?></h2>
        </div>
        
        <table id="tabla-resumen" class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th>ETAPA</th>
                    <th># CLIENTES</th>
                    <th>PROM VENTA</th>
                    <th>PENDIENTE</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $procedure = $conection->resumenVentasProyecto($idProyecto);
                    while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td><a onclick=\"sendVariables('Ventas_Etapa.php', " . $rows['idEtapa'] . ", 'id');\">" . $rows['numeroEtapa'] . "</a></td>";
                        echo "<td>" . $rows['numeroClientes'] . "</td>";
                        echo "<td>" . $rows['promedioVenta'] . "</td>";
                        echo "<td>" . $rows['pendiente'] . "</td>";
                        echo "</tr>";
                    }
                ?>
                <tr class="table-success">
                    <td>TOTAL</td>
                    <td colspan="2"></td>
                    <td>TOTAL PENDIENTE</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Ventas_Detalle.js"></script>
</body>
</html>