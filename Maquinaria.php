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
        
        //$procedure = $conection->obtenerResumen($date);
        //$rows = $procedure->fetch(PDO::FETCH_ASSOC);

    ?>
    
    <div id="prospectos" class="table-responsive">
        
        <div id="titulo-prospectos">
            <h2 class="text-primary">Por Pagar Operadores</h2>
        </div>
        
        <table id="tabla-prospectos" class="table table-hover">
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
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="prospectos" class="table-responsive">
        
        <div id="titulo-prospectos">
            <h2 class="text-primary">Por Pagar Gastos</h2>
        </div>
        
        <table id="tabla-prospectos" class="table table-hover">
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
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Maquinaria.js"></script>
</body>
</html>