<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expediente</title>
    <link rel="stylesheet" href="css/Expediente.css">
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
            $idCliente = $_GET["id"];
            $proc = $conection->gestionCliente($idCliente, '', '', '', '', '', '', '', '', 0, '', 0, 0, 0, 0, 0, 'S');
            $rows = $proc->fetch(PDO::FETCH_ASSOC);

            $nombreCliente = $rows['nombre'];
            $nombreCliente = is_null($rows['segundoNombre']) ? $nombreCliente : $nombreCliente . " " . $rows['segundoNombre'];
            $nombreCliente = $nombreCliente . " " . $rows['apellidoPaterno'];
            $nombreCliente = is_null($rows['apellidoMaterno']) ? $nombreCliente : $nombreCliente . " " . $rows['apellidoMaterno'];
        }
    ?>

    <div id="resumen" class="table-responsive">

        <div id="titulo">
            <h2 class="text-primary">Expediente <?php echo $nombreCliente;?></h2>
        </div>
        <div id="upload" class="mt-3">
            <form id="nuevoPresupuesto" action="php/Expediente_Procesos.php" class="row needs-validation" method="POST"
                enctype="multipart/form-data" novalidate>
                <div class="form-group mb-3 col-4">
                    <input type="file" class="form-control" name="archivo" id="inputArchivo" accept=".pdf">
                </div>
                <div class="form-group col-4">
                    <input type="hidden" name="proyectoID" value="<?php echo $idCliente;?>">
                    <input type="hidden" name="accion" value="agregar">
                    <button class="btn btn-primary" type="submit">Cargar</button>
                </div>
            </form>
        </div>
        <div id="archivos" class="row justify-content-between mt-3">
            <div class="card text-center col-2">
                <embed src="https://www.africau.edu/images/default/sample.pdf" type="application/pdf">
                <div class="card-body">
                    <h6 class="card-title"><a href="https://www.africau.edu/images/default/sample.pdf"
                            target="_blank">RFC</a></h6>
                </div>
            </div>
            <div class="card text-center col-2">
                <embed src="https://www.africau.edu/images/default/sample.pdf" type="application/pdf">
                <div class="card-body">
                    <h6 class="card-title"><a href="https://www.africau.edu/images/default/sample.pdf"
                            target="_blank">RFC</a></h6>
                </div>
            </div>
            <div class="card text-center col-2">
                <embed src="https://www.africau.edu/images/default/sample.pdf" type="application/pdf">
                <div class="card-body">
                    <h6 class="card-title"><a href="https://www.africau.edu/images/default/sample.pdf"
                            target="_blank">RFC</a></h6>
                </div>
            </div>
            <div class="card text-center col-2">
                <embed src="https://www.africau.edu/images/default/sample.pdf" type="application/pdf">
                <div class="card-body">
                    <h6 class="card-title"><a href="https://www.africau.edu/images/default/sample.pdf"
                            target="_blank">RFC</a></h6>
                </div>
            </div>
            <div class="card text-center col-2">
                <embed src="https://www.africau.edu/images/default/sample.pdf" type="application/pdf">
                <div class="card-body">
                    <h6 class="card-title"><a href="https://www.africau.edu/images/default/sample.pdf"
                            target="_blank">RFC</a></h6>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Expediente.js"></script>
</body>

</html>