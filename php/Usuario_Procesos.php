<?php
ob_start();
session_start();
include_once('../php/conection.php');
include_once('../modelos/Usuario.php');

if (isset($_POST['accion'])) {

    $usuario = new Usuario(require 'php/config.php');
    $coneccion = new DB(require 'php/config.php');

    $usuario->setIdUsuario($_POST['usuarioID']);
    $usuario->setNombre($_POST['nombre']);
    $usuario->setCorreo($_POST['correo']);
    $usuario->setContraseña($_POST['contraseña']);
    $usuario->setIdDepa(0);

    if ($_POST['accion'] == 'actualizar') {
        try {
            $procedure = $coneccion->gestionUsuario(
                $usuario->getIdUsuario(),
                $usuario->getNombre(),
                $usuario->getCorreo(),
                $usuario->getContraseña(),
                $usuario->getIdDepa(),
                'U'
            );

            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);

            header('Location: ../Perfil.php?id='.$usuario->getIdUsuario().'&success=1');
        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header('Location: ../Perfil.php?id='.$usuario->getIdUsuario().'&success=0');
        }
    }
}
?>