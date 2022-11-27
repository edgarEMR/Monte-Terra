<?php 
ob_start();
include_once('../php/conection.php');
include_once('../modelos/Pago.php');

echo "HOLA" . '<br>';

if (isset($_POST['accion'])) {

    ECHO $_POST["esIngreso"] . '<br>';
    ECHO $_POST["concepto"] . '<br>';
    ECHO $_POST["importe"] . '<br>';
    ECHO $_POST["area"] . '<br>';
    ECHO $_POST["etapa"] . '<br>';
    ECHO $_POST["tipoPago"] . '<br>';
    ECHO $_POST["proyectoID"] . '<br>';
    ECHO $_POST["accion"] . '<br>';

    $pago = new Pago(require 'php/config.php');
    $coneccion = new DB(require 'php/config.php');

    if ($_POST['accion'] == 'registrar') {
        
        echo 'registrar';
        $pago->setConcepto($_POST["concepto"]);
        $pago->setImporte($_POST["importe"]);
        $pago->setFechaPago("");
        $pago->setArea($_POST["area"]);
        $pago->setExtra(0);
        $pago->setEsIngreso($_POST["esIngreso"]);
        $pago->setIdTipoPago($_POST["tipoPago"]);
        $pago->setIdEtapa($_POST["etapa"]);
        $pago->setIdProyecto($_POST["proyecto"]);
        
        try {
            echo 'Try';
            $procedure = $coneccion->gestionPago(
                0,
                $pago->getConcepto(),
                $pago->getImporte(),
                "",
                $pago->getEsIngreso(),
                $pago->getArea(),
                $pago->getIdTipoPago(),
                $pago->getIdEtapa(),
                $pago->getIdProyecto(),
                'I'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);

            header('Location: ../Detalle_Pago.php');

            // if($_POST['idRol'] != 1){
            //     header('Location: ../inicio.php?register=success');
            // } else {
            //     header("Location: ../perfil.php?nombreUsuario=edgar");
            // }

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header("Location: ../Detalle_Pago.php?error=1");
        } catch (Exception $error) {
            echo $error;
        }
            
    }
    
    if ($_POST['accion'] == 'editar') {

        echo 'editar';

        $pago->setIdPago($_POST["pagoID"]);
        $pago->setConcepto($_POST["concepto"]);
        $pago->setImporte($_POST["importe"]);
        $pago->setFechaPago("NULL");
        $pago->setArea($_POST["area"]);
        $pago->setExtra(0);
        $pago->setEsIngreso($_POST["esIngreso"]);
        $pago->setIdTipoPago($_POST["tipoPago"]);
        $pago->setIdEtapa($_POST["etapa"]);
        $pago->setIdProyecto($_POST["proyectoID"]);
        
        try {

            echo 'Try';
            $procedure = $coneccion->gestionPago(
                $pago->getIdPago(),
                $pago->getConcepto(),
                $pago->getImporte(),
                "",
                $pago->getEsIngreso(),
                $pago->getArea(),
                $pago->getIdTipoPago(),
                $pago->getIdEtapa(),
                $pago->getIdProyecto(),
                'U'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            
            header('Location: ../Portafolio.php?id='. $pago->getIdProyecto());


        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            //header("Location: ../Detalle_Pago.php?error=1");
        } catch (Exception $error) {
            echo $error;
        }
            
    }
}
?>