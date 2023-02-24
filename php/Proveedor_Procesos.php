<?php
ob_start();
include_once('../php/conection.php');
include_once('../modelos/Aportador.php');

if (isset($_POST['accion'])) {

    ECHO $_POST["nombreAportador"] . '<br>';
    ECHO $_POST["RFCAportador"] . '<br>';

    $proveedor = new Proveedor(require 'php/config.php');
    $coneccion = new DB(require 'php/config.php');

    $proveedor->setRFC($_POST["RFCProveedor"]);
    $proveedor->setNombre($_POST["nombreProveedor"]);

    if ($_POST['accion'] == 'registrar') {
        
        echo 'registrar';
        
        try {
            echo 'Try';
            $procedure = $coneccion->gestionAportador(
                0,
                $proveedor->getRFC(),
                $proveedor->getNombre(),
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
        $proveedor->setidProveedor($_POST["id"]);

        try {

            echo 'Try';
            $procedure = $coneccion->gestionAportador(
                $proveedor->getidProveedor(),
                $proveedor->getRFC(),
                $proveedor->getNombre(),
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