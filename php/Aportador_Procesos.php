<?php
ob_start();
include_once('../php/conection.php');
include_once('../modelos/Aportador.php');

if (isset($_POST['accion'])) {

    ECHO $_POST["nombreAportador"] . '<br>';
    ECHO $_POST["RFCAportador"] . '<br>';

    $aportador = new Aportador(require 'php/config.php');
    $coneccion = new DB(require 'php/config.php');

    $aportador->setRFC('XAXX010101000');
    $aportador->setNombre($_POST["nombreAportador"]);
    $aportador->setEsPrestamista($_POST["esPrestamista"]);
    $aportador->setProyecto($_POST["proyecto"]);

    if ($_POST['accion'] == 'registrar') {
        
        echo 'registrar';
        
        try {
            echo 'Try';
            $procedure = $coneccion->gestionAportador(
                0,
                $aportador->getRFC(),
                $aportador->getNombre(),
                $aportador->getEsPrestamista(),
                $aportador->getProyecto(),
                'I'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);

            header('Location: ../Nuevo_Aportador.php');

            // if($_POST['idRol'] != 1){
            //     header('Location: ../inicio.php?register=success');
            // } else {
            //     header("Location: ../perfil.php?nombreUsuario=edgar");
            // }

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header("Location: ../Nuevo_Aportador.php?error=1");
        } catch (Exception $error) {
            echo $error;
        }
            
    }
    
    if ($_POST['accion'] == 'editar') {

        echo 'editar';
        $aportador->setIdAportador($_POST["id"]);

        try {

            echo 'Try';
            $procedure = $coneccion->gestionAportador(
                $aportador->getIdAportador(),
                $aportador->getRFC(),
                $aportador->getNombre(),
                $aportador->getEsPrestamista(),
                $aportador->getProyecto(),
                'U'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            
            header('Location: ../Nuevo_Aportador.php');


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