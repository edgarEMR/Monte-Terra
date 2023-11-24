<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maquinaria</title>
    <link rel="stylesheet" href="css/Maquinaria.css">
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
        
        $procedure = $conection->gestionOperador(0, '', 0, 0, 'S');
        //$rows = $procedure->fetch(PDO::FETCH_ASSOC);

    ?>

    <div id="maquinaria" class="table-responsive">

        <div id="titulo-maquinaria">
            <h2 class="text-primary">Por Pagar Operadores</h2>
        </div>
        <form id="pagoOperadores" action="php/Operador_Procesos.php" class="row needs-validation" method="POST"
            enctype="multipart/form-data" novalidate>
            <table id="tabla-maquinaria" class="table table-hover">
                <thead>
                    <tr class="table-primary">
                        <th>MAQUINA</th>
                        <th>OPERADOR</th>
                        <th>SUELDO</th>
                        <th>EXTRAS</th>
                        <th>DESCUENTO</th>
                        <th>TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($rows = $procedure->fetch(PDO::FETCH_ASSOC)){
                            echo '<tr>';
                            echo '<td class="p-0"><input type="text" name="nombreMaquina[]" class="form-control" id="inputNMaquina" value="' . $rows['nombreMaquina'] . '" required readonly></td>';
                            echo '<td class="p-0"><input type="text" name="nombre[]" class="form-control" id="inputNombre" value="' . $rows['nombre'] . '" required readonly></td>';
                            echo '<td class="p-0"><input type="number" name="sueldo[]" class="form-control" id="inputSueldo" min="0" value="' . $rows['sueldo'] . '" oninput="nominaTotal()" required readonly></td>';
                            echo '<td class="p-0"><input type="number" name="extras[]" class="form-control" id="inputExtras" min="0" value="" oninput="nominaTotal()" required></td>';
                            echo '<td class="p-0 position-relative"><input type="number" name="descuento[]" class="form-control" id="inputDescuento" min="0" value="" oninput="nominaTotal()" required></td>';
                            echo '<td class="p-0"><input type="number" name="total[]" class="form-control" id="inputTotal" min="0" value="" oninput="nominaTotal()" required></td>';
                            echo '</tr>';
                        }
                    ?>
                    <tr>
                        <td colspan="5"></td>
                        <input type="hidden" name="accion" value="nomina">
                        <td><button id="btnPagarOperadores" class="btn btn-block btn-primary"
                                type="submit">Agregar</button></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <div id="maquinaria" class="table-responsive">

        <div id="titulo-maquinaria">
            <h2 class="text-primary">Por Pagar Gastos</h2>
        </div>

        <table id="tabla-maquinaria" class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th>MAQUINA</th>
                    <th>CONCEPTO</th>
                    <th>PROYECTO</th>
                    <th>PROVEEDOR</th>
                    <th>IMPORTE</th>
                    <th>MÉTODO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $procedure = $conection->gestionPagoMaquinaria(0, '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'E');
                    $total = 0;
                    while($rows = $procedure->fetch(PDO::FETCH_ASSOC)){
                        if(!$rows['esIngreso']){
                        echo "<tr>";
                        echo "<td>" . $rows['nombreMaquina'] . "</td>";
                        echo "<td>" . $rows['concepto'] . "</td>";
                        echo "<td>" . $rows['nombreProyecto'] . "</td>";
                        echo "<td>" . $rows['nombreProveedor'] . "</td>";
                        echo "<td>$" . number_format($rows['importe'], 2) . "</td>";
                        echo "<td>" . $rows['nombrePago'] . "</td>";
                        echo "</tr>";
                        $total -= $rows['importe'];
                        }
                    }
                ?>
            </tbody>
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
    <script src="js/Maquinaria.js"></script>
</body>

</html>