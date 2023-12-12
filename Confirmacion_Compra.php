<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MonteTerra</title>
    <link rel="stylesheet" href="css/Confirmacion_Compra.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body>
    <div id="navigation" class="top">

    </div>

    <?php
        ob_start();
        include_once('php/conection.php');

        $conection = new DB(require 'php/config.php');

        if(isset($_GET["id"]))
        {
            $idLote = $_GET["id"];
            $procedure = $conection->informacionComprobante($idLote);

        }
    ?>

    <div id="resumen" class="table-responsive">

        <div id="titulo">
            <h2 class="text-primary">Confirmación de separación</h2>
            <h1 class="text-success"><i class="bi bi-check-circle-fill" style="font-size: 5rem;"></i></h1>
        </div>

        <table id="tabla-resumen" class="table table-hover w-50 mt-3">
            <tbody>
                <?php 
                    while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                        echo "<tr class='table-primary'>";
                        echo "<th>FOLIO SEPARACIÓN</th>";
                        echo "<th>" . $rows['folioVenta'] . "</th>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<th>NOMBRE</th>";
                        echo "<td>" . $rows['nombreCliente'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<th>PROYECTO</th>";
                        echo "<td>" . $rows['proyecto'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<th>CALLE</th>";
                        echo "<td>" . $rows['calle'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<th>LOTE</th>";
                        echo "<td>" . $rows['numeroLote'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<th>PROTOTIPO</th>";
                        echo "<td>" . $rows['prototipo'] . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<th>PRECIO VENTA</th>";
                        echo "<td>$" . number_format($rows['precioVenta'], 2) . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<th>MONTO DE SEPARACIÓN</th>";
                        echo "<td>$" . number_format($rows['montoSeparacion'], 2) . "</td>";
                        echo "</tr>";
                        echo "<tr>";
                        echo "<th>RESTANTE</th>";
                        echo "<td>$" . number_format($rows['precioVenta'] - $rows['montoSeparacion'], 2) . "</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <div id="botones" class="w-50 my-3 d-flex justify-content-evenly">
        <button id="descargarPDF" type="button" class="btn btn-primary" onclick="savePDF()"><i
                class="bi bi-download"></i>
            Descargar</button>
        <button id="regresar" type="button" class="btn btn-success"
            onclick="location.href='Ventas.php'">Continuar</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
        integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="js/Confirmacion_Compra.js"></script>
</body>

</html>