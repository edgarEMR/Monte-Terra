<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos</title>
    <link rel="stylesheet" href="css/Proyectos.css">
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
    

    <div id="resumen" class="table-responsive">
        
        <div id="titulo">
            <h2 class="text-primary">Resumen</h2>
            <div id="selector-semana" class="input-group mb-3">
                <button class="btn btn-outline-secondary" type="button" onclick="subDays('<?php echo $date;?>');"><i class="bi bi-caret-left-fill"></i></button>
                <input id="inputDate" type="text" class="form-control" placeholder="" aria-label="Example text with two button addons" disabled value="<?php echo date_format(date_create($date), 'd-m-Y');?>">
                <button class="btn btn-outline-secondary" type="button" onclick="addDays('<?php echo $date;?>');"><i class="bi bi-caret-right-fill"></i></button>
            </div>
        </div>
        
        <table id="tabla-resumen" class="table table-hover">
            <thead>
                <tr class="table-primary">
                    <th>PROYECTO</th>
                    <th>PORTAFOLIO PASADO <br> <?php echo date_format(date_create($rows['pasado']), 'd-m-Y');?></th>
                    <th>INGRESOS</th>
                    <th>EGRESOS</th>
                    <th>PORTAFOLIO HOY <br> <?php echo date_format(date_create($rows['hoy']), 'd-m-Y');?></th>
                </tr>
            </thead>
            <tbody>
                <!--<tr>
                    <td><a href="#">BANCOS</a></td>
                    <td>$214,505.05</td>
                    <td>$356,540.00</td>
                    <td>$266,824.80</td>
                    <td>$304,349.29</td>
                </tr>-->
                <?php 
                    $suma = 0;
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
                    }
                ?>
                <tr class="table-success">
                    <td class="text-end" colspan="5"><?php echo "$" . number_format($suma, 2);?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Proyectos.js"></script>
</body>
</html>