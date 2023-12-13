<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maquinaria</title>
    <link rel="stylesheet" href="css/Nuevo_Operador.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>

<body>
    <div id="navigation" class="top">

    </div>
    <?php
        ob_start();
        include_once('modelos/Pago.php');
        include_once('php/conection.php');

        $accion = 'registrar';
        $conection = new DB(require 'php/config.php');
        $idUsuario = 0;

        $idUsuario = $_SESSION['idUsuario'];

    ?>

    <div id="maquinaria" class="table-responsive">

        <div class="register-form">
            <form id="registroOperador" action="php/Operador_Procesos.php" class="row needs-validation" method="POST"
                enctype="multipart/form-data" novalidate>
                <div class="form-group input-group-sm col-md-12">
                    <label for="inputNombre">Operador</label>
                    <input type="text" name="nombre" class="form-control" id="inputNombre"
                        pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" value="" required>
                    <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                    <div class="invalid-feedback">
                        Ingrese un nombre válido.
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="inputMaquina">Maquina</label>
                    <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="maquina"
                        id="inputMaquina" onchange="" required>
                        <?php
                            $procedure = $conection->gestionMaquinaria(0, "", 0, 0, 'E');
                            while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value=".$rows['idMaquinaria'].">".$rows['nombre']."</option>";
                            }
                        ?>
                    </select>
                    <div class="invalid-feedback">
                        Elija una opción.
                    </div>
                </div>
                <div class="form-group input-group-sm col-md-12">
                    <label for="inputSueldo">Sueldo</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text">$</span>
                        <input type="number" name="sueldo" class="form-control" id="inputSueldo" min="0" step="0.01"
                            required value="<?php ?>">
                        <div class="invalid-feedback">
                            Ingrese un número válido.
                        </div>
                    </div>
                </div>
                <div class="form-group d-grid mt-3">
                    <input type="hidden" name="accion" value="<?php echo $accion;?>">
                    <button class="btn btn-block btn-primary" type="submit">Agregar</button>
                </div>
            </form>
        </div>
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
    <script src="js/bootstrap-select.js"></script>
    <script src="js/Nuevo_Operador.js"></script>
</body>

</html>