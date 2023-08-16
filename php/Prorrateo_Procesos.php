<?php
ob_start();
include_once('../php/conection.php');

if (isset($_POST['accion'])) {

    // $array = implode(",", $_POST["prorrateo"]);
    // ECHO $array . '<br>';

    // foreach ($_POST["prorrateo"] as $proyecto) {
    //     echo $proyecto . '<br>';
    // }

    $coneccion = new DB(require '../php/config.php');
    $esAdmin = $_POST['esAdmin'];

    if ($_POST['accion'] == 'registrar') {
        
        echo 'registrar';
        
        try {
            echo 'Try';
            $procedure = $coneccion->gestionProrrateo(0, 0, $esAdmin, 'T');
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            

            foreach ($_POST["prorrateo"] as $proyecto) {
                echo $proyecto . '<br>';
                $procedure = $coneccion->gestionProrrateo(0, $proyecto, $esAdmin, 'I');
                $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            }
            
            header('Location: ../Gestion_Prorrateo.php');

            // if($_POST['idRol'] != 1){
            //     header('Location: ../inicio.php?register=success');
            // } else {
            //     header("Location: ../perfil.php?nombreUsuario=edgar");
            // }

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            //header("Location: ../Nuevo_Banco.php?error=1");
        } catch (Exception $error) {
            echo $error;
        }
            
    }
    
}
?>