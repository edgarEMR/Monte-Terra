<?php
ob_start();
include_once('../php/conection.php');
include_once('../modelos/Banco.php');

if (isset($_POST['accion'])) {

    ECHO $_POST["nombreBanco"] . '<br>';

    $banco = new Banco(require 'php/config.php');
    $coneccion = new DB(require 'php/config.php');

    $banco->setNombre($_POST["nombreBanco"]);

    if ($_POST['accion'] == 'registrar') {
        
        echo 'registrar';
        
        try {
            echo 'Try';
            $procedure = $coneccion->gestionBanco(
                0,
                $banco->getNombre(),
                'I'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);

            header('Location: ../Nuevo_Banco.php');

            // if($_POST['idRol'] != 1){
            //     header('Location: ../inicio.php?register=success');
            // } else {
            //     header("Location: ../perfil.php?nombreUsuario=edgar");
            // }

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header("Location: ../Nuevo_Banco.php?error=1");
        } catch (Exception $error) {
            echo $error;
        }
            
    }
    
    if ($_POST['accion'] == 'editar') {

        echo 'editar';
        $banco->setIdTipoPago($_POST["id"]);

        try {

            echo 'Try';
            $procedure = $coneccion->gestionBanco(
                0,
                $banco->getNombre(),
                'U'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            
            header('Location: ../Nuevo_Banco.php');


        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header("Location: ../Nuevo_Aportador.php?error=1");
        } catch (Exception $error) {
            echo $error;
        }
            
    }
}
?>