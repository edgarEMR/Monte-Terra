<?php 
ob_start();
include_once('../php/conection.php');
include_once('../modelos/Presupuesto.php');

echo "HOLA" . '<br>';

if (isset($_POST['accion'])) {

    ECHO $_POST["concepto"] . '<br>';
    ECHO $_POST["importe"] . '<br>';
    date_default_timezone_set('America/Monterrey');
    ECHO date('Y-m-d') . '<br>';
    ECHO $_POST["etapa"] . '<br>';
    ECHO $_POST["proyectoID"] . '<br>';
    ECHO $_POST["accion"] . '<br>';

    $presupuesto = new Presupuesto(require 'php/config.php');
    $coneccion = new DB(require 'php/config.php');

    if ($_POST['accion'] == 'registrar') {
        
        echo 'registrar';
        $presupuesto->setConcepto($_POST["concepto"]);
        $presupuesto->setImporte($_POST["importe"]);
        $presupuesto->setFecha(date('Y-m-d'));
        $presupuesto->setIdEtapa($_POST["etapa"]);
        $presupuesto->setIdProyecto($_POST["proyectoID"]);
        
        try {
            echo 'Try';
            $procedure = $coneccion->gestionPresupuesto(
                0,
                $presupuesto->getConcepto(),
                $presupuesto->getImporte(),
                $presupuesto->getFecha(),
                $presupuesto->getIdEtapa(),
                $presupuesto->getIdProyecto(),
                'I'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            
            header('Location: ../Presupuestos.php?id='. $presupuesto->getIdProyecto());

            // if($_POST['idRol'] != 1){
            //     header('Location: ../inicio.php?register=success');
            // } else {
            //     header("Location: ../perfil.php?nombreUsuario=edgar");
            // }

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header("Location: ../Presupuestos.php?error=1");
        } catch (Exception $error) {
            echo $error;
        }
            
    }
    
    if ($_POST['accion'] == 'editar') {
        echo 'editar';

        $presupuesto->setIdPresupuesto($_POST['presupuestoID']);
        $presupuesto->setConcepto($_POST["concepto"]);
        $presupuesto->setImporte($_POST["importe"]);
        $presupuesto->setFecha(date('Y-m-d'));
        $presupuesto->setIdEtapa($_POST["etapa"]);
        $presupuesto->setIdProyecto($_POST["proyectoID"]);
        
        try {

            echo 'Try';
            $procedure = $coneccion->gestionPresupuesto(
                $presupuesto->getIdPresupuesto(),
                $presupuesto->getConcepto(),
                $presupuesto->getImporte(),
                $presupuesto->getFecha(),
                $presupuesto->getIdEtapa(),
                $presupuesto->getIdProyecto(),
                'U'
            );

            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            
            header('Location: ../Presupuestos.php?id='. $presupuesto->getIdProyecto());

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header("Location: ../Presupuestos.php?error=1");
        } catch (Exception $error) {
            echo $error;
        }
            
    }

    
}
?>