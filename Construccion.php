<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Construcción</title>
    <link rel="stylesheet" href="css/Construccion.css">
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
        $crecimiento = 0;
        $conection = new DB(require 'php/config.php');

        if(isset($_GET['date'])){
            $date = $_GET['date'];
        } else {
            $date = $conection->getCurrent_date();
        }
        
        $procedure = $conection->obtenerResumen($date);
        $rows = $procedure->fetch(PDO::FETCH_ASSOC);

    ?>
    
    <div id="construccion" class="table-responsive">
        
        <div id="titulo-construccion">
            <h2 class="text-primary">Proyectos</h2>
        </div>

        
        <div id="itemsProyecto" class="row gy-1">
            
            <?php 
                $procedure = $conection->obtenerResumen($date);
                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='col-2 align-self-center'>";
                    echo "<button type='button' class='btn btn-primary' onclick='location.href=\"Construccion_Detalle.php\"' style='text-decoration: none;'>" . $rows['nombre'] . "</button>";
                    echo "</div>";
                }
            ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Construccion.js"></script>
</body>
</html>