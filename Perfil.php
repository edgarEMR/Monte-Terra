<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="css/Perfil.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    <div id="navigation" class="top">

    </div>
    <?php
        ob_start();
        include_once('modelos/Usuario.php');
        include_once('php/conection.php');

        $accion = 'actualizar';
        $conection = new DB(require 'php/config.php');
        $usuario = new Usuario(require 'php/config.php');

        if (isset($_GET['id'])) {
            $procedure = $conection->gestionUsuario($_GET['id'], '', '', '', 0, 'S');
            $row = $procedure->fetch(PDO::FETCH_ASSOC);

            $usuario->setIdUsuario($row['idUsuario']);
            $usuario->setNombre($row['nombre']);
            $usuario->setCorreo($row['correo']);
            $usuario->setContraseña($row['contraseña']);
            $usuario->setIdDepa($row['idDepa']);
        }

    ?>
    <div class="register-form">
        <form id="registroProyecto" action="php/Usuario_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
            <div class="form-group col-12 mb-2">
                <label for="inputNombre">Nombre(s)</label>
                <input type="text" name="nombre" class="form-control" id="inputNombre"
                    pattern="[A-Za-zÀ-ÿ\u00f1\u00d1 ]{3,}" required value="<?php echo $usuario->getNombre();?>">
                <small id="nombreHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                <div class="invalid-feedback">
                    Ingrese su nombre.
                </div>
            </div>
            <div class="form-group col-md-12 mb-2">
                <label for="inputCorreo">Correo</label>
                <input type="text" name="correo" class="form-control" id="inputCorreo" placeholder="nombre@monteterra.com"
                    pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$" value="<?php echo $usuario->getCorreo();?>" required disabled>
                <small id="RFCUHelp" class="form-text text-muted">Máximo 13 caracteres.</small>
                <div class="invalid-feedback">
                    Ingrese un RFC válido.
                </div>
            </div>
            <div class="form-group col-md-12 mb-2">
                <label for="inputContraseña">Contraseña</label>
                <div class="input-group">
                <input type="password" name="contraseña" class="form-control" id="inputContraseña"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&]).{8,}" value="<?php echo $usuario->getContraseña();?>" required>
                <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="verContra()">
                    <i id="verIcon" class="bi bi-eye-slash-fill"></i>
                </button>
                </div>
                <small id="contraseñaHelp" class="form-text text-muted">Mínimo 8 caracteres, una
                            mayúscula, un número y un signo de puntuación.</small>
                <div class="invalid-feedback">
                    Ingrese una contraseña válida.
                </div>
            </div>
            <div class="form-group d-grid mt-3">
                 <input type="hidden" name="usuarioID" value="<?php echo $usuario->getIdUsuario();?>">
                 <input type="hidden" name="depaID" value="<?php echo $usuario->getIdDepa();?>" id="depaID">
                <input type="hidden" name="accion" value="<?php echo $accion;?>">
                <button class="btn btn-block btn-primary" type="submit">Guardar</button>
            </div>
        </form>
    </div>
    <div id="liveAlert" class="alert alert-dismissible fade show position-fixed fixed-bottom mx-auto" role="alert">
        <p class="alert-body mb-0"></p>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Perfil.js"></script>
</body>
</html>