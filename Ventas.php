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

        if(isset($_GET['date'])){
            $date = $_GET['date'];
        } else {
            $date = $conection->getCurrent_date();
        }
        
        $procedure = $conection->obtenerResumen($date);
        $rows = $procedure->fetch(PDO::FETCH_ASSOC);

    ?>
    
    <div id="prospectos" class="table-responsive">
        
        <div id="titulo-prospectos">
            <!--AGREGAR PROSPECTO-->
            <h2 class="text-primary">Prospectos</h2>
        </div>
        
        <table id="tabla-prospectos" class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th>NOMBRE</th>
                    <th>EMAIL</th>
                    <th>TELEFONO</th>
                    <th>PUNTAJE</th>
                    <th>VIVIENDA <br> DE INTERES</th>
                    <th>CREDITO</th>
                    <th>MEDIO</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $procedure = $conection->obtenerProspectos();
                    while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td><a onclick=\"sendVariables('Nuevo_Cliente.php', " . $rows['idCliente'] . ", 'id');\">" . $rows['nombre'] . "</a></td>";
                        echo "<td>" . $rows['email'] . "</td>";
                        echo "<td>" . $rows['telefono'] . "</td>";
                        echo "<td>" . $rows['puntaje'] . "</td>";
                        echo "<td>" . $rows['tipoVivienda'] . "</td>";
                        echo "<td>" . $rows['credito'] . "</td>";
                        echo "<td>" . $rows['medio'] . "</td>";
                        echo '<th><button  onclick="sendVariables(\'Nuevo_Cliente.php\', ' . $rows['idCliente'] . ', \'id\');" class="btn btn-outline-primary ms-1">Generar contrato</button></th>';
                        echo "</tr>";

                    }
                ?>
            </tbody>
        </table>
    </div>

    <div id="resumen" class="table-responsive">
        
        <div id="titulo">
            <!--TOTAL DE CLIENTES POR PROYECTO-->
            <h2 class="text-primary">Resumen</h2>
        </div>
        
        <table id="tabla-resumen" class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th>PROYECTO</th>
                    <th># CLIENTES</th>
                    <th>PROM VENTA</th>
                    <th>PENDIENTE</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $procedure = $conection->resumenVentas();
                    while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td><a onclick=\"sendVariables('Ventas_Proyecto.php', " . $rows['idProyecto'] . ", 'id');\">" . $rows['nombre'] . "</a></td>";
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

    
    <div id="cancelacion" class="table-responsive">
        
        <div id="titulo-cancel">
            <h2 class="text-primary">Cancelaciones</h2>
        </div>
        
        <table id="tabla-cancel" class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th>NOMBRE</th>
                    <th>PROYECTO</th>
                    <th>CASA #</th>
                    <th>MANZANA</th>
                    <th>COSTO</th>
                    <th>PAGO</th>
                    <th>PENDIENTE</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    /*$suma = 0;
                    $procedure = $conection->obtenerResumen($date);
                    while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr>";
                        echo "<td><a onclick=\"sendVariables('Portafolio.php', " . $rows['idProyecto'] . ", 'id');\">" . $rows['nombre'] . "</a></td>";
                        echo "<td>$" . number_format($rows['totalPasado'], 2) . "</td>";
                        echo "<td>$" . number_format($rows['ingreso'], 2) . "</td>";
                        echo "<td>$" . number_format($rows['egreso'], 2) . "</td>";
                        echo "<td>$" . number_format($rows['totalHoy'], 2) . "</td>";
                        echo "</tr>";

                        $suma += $rows['totalHoy'];
                    }*/
                ?>
                <tr class="table-success">
                    <td>TOTAL</td>
                    <td colspan="3"></td>
                    <td>TOTAL COSTO</td>
                    <td>TOTAL PAGOS</td>
                    <td>TOTAL PENDIENTE</td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Ventas.js"></script>
</body>
</html>