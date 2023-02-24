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

    $pago->setEsIngreso($_POST["esIngreso"]);
    $pago->setConcepto($_POST["concepto"]);
    $pago->setImporte($_POST["importe"]);
    $pago->setFechaPago("");
    $pago->setIdTipoPago($_POST["tipoPago"]);
    
    if($_POST["tipo"] == 'General') {
        $pago->setIdProyecto('NULL');
        $pago->setIdEtapa('NULL');
    }
    else {
        $pago->setIdProyecto($_POST["proyecto"]);
        $pago->setIdEtapa($_POST["etapa"]);
    }

    if($_POST["tipo"] != 'Ingreso') {
        $pago->setIdArea($_POST["area"]);
    }
    else {
        $pago->setIdArea('NULL');
    }

    if(isset($_POST["origenIngreso"])){
        switch ($_POST["origenIngreso"]) {
            case 'Banco':
                $pago->setIdProveedor('NULL');
                $pago->setIdAportador('NULL');
                $pago->setIdCliente('NULL');
                $pago->setIdBanco($_POST["tipoPago"]);
                break;

            case 'Aportacion':
                $pago->setIdProveedor('NULL');
                $pago->setIdAportador($_POST["aportador"]);
                $pago->setIdCliente('NULL');
                $pago->setIdBanco('NULL');
                break;

            case 'Venta':
                $pago->setIdProveedor('NULL');
                $pago->setIdAportador('NULL');
                $pago->setIdCliente($_POST["cliente"]);
                $pago->setIdBanco('NULL');
                break;
        }
    } else if(isset($_POST["origenEgreso"])){
        switch ($_POST["origenEgreso"]) {
            case 'Banco':
                $pago->setIdProveedor('NULL');
                $pago->setIdAportador('NULL');
                $pago->setIdCliente('NULL');
                $pago->setIdBanco($_POST["tipoPago"]);
                break;

            case 'Aportacion':
                $pago->setIdProveedor('NULL');
                $pago->setIdAportador($_POST["aportador"]);
                $pago->setIdCliente('NULL');
                $pago->setIdBanco('NULL');
                break;

            case 'Pago':
                $pago->setIdProveedor($_POST["proveedor"]);
                $pago->setIdAportador('NULL');
                $pago->setIdCliente('NULL');
                $pago->setIdBanco('NULL');
                break;

            case 'Devolucion':
                $pago->setIdProveedor('NULL');
                $pago->setIdAportador('NULL');
                $pago->setIdCliente($_POST["cliente"]);
                $pago->setIdBanco('NULL');
                break;
        }
    } else {
        $pago->setIdProveedor('NULL');
        $pago->setIdAportador('NULL');
        $pago->setIdCliente('NULL');
        $pago->setIdBanco('NULL');
    }

    if ($_POST['accion'] == 'registrar') {
        
        echo 'registrar';
        
        try {
            echo 'Try';
            $procedure = $coneccion->gestionPago(
                0,
                $pago->getConcepto(),
                $pago->getImporte(),
                "",
                $pago->getEsIngreso(),
                $pago->getIdTipoPago(),
                $pago->getIdEtapa(),
                $pago->getIdProyecto(),
                $pago->getIdArea(),
                $pago->getIdProveedor(),
                $pago->getIdCliente(),
                $pago->getIdAportador(),
                $pago->getIdBanco(),
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
        
        try {

            echo 'Try';
            $procedure = $coneccion->gestionPago(
                $pago->getIdPago(),
                $pago->getConcepto(),
                $pago->getImporte(),
                "",
                $pago->getEsIngreso(),
                $pago->getIdTipoPago(),
                $pago->getIdEtapa(),
                $pago->getIdProyecto(),
                $pago->getIdArea(),
                $pago->getIdProveedor(),
                $pago->getIdCliente(),
                $pago->getIdAportador(),
                $pago->getIdBanco(),
                'U'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            
            header('Location: ../Portafolio.php?id='. $pago->getIdProyecto());


        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header("Location: ../Detalle_Pago.php?error=1");
        } catch (Exception $error) {
            echo $error;
        }
            
    }
}
?>