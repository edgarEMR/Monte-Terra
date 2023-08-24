<?php 
ob_start();
include_once('../php/conection.php');
include_once('../modelos/Cotizacion.php');

echo "HOLA" . '<br>';

if (isset($_POST['accion'])) {

    ECHO ($_POST["concepto"] ?: $_POST["conceptoLista"]) . '<br>';
    ECHO $_POST["importe"] . '<br>';
    date_default_timezone_set('America/Monterrey');
    ECHO date('Y-m-d') . '<br>';
    ECHO $_POST["numeroCasas"] . '<br>';
    ECHO $_POST["importeM2"] . '<br>';
    ECHO $_POST["metros2"] . '<br>';
    ECHO $_POST["familia"] . '<br>';
    ECHO $_POST["proyectoID"] . '<br>';
    ECHO $_POST["etapa"] . '<br>';
    ECHO $_POST["accion"] . '<br>';

    $cotizacion = new Cotizacion(require 'php/config.php');
    $coneccion = new DB(require 'php/config.php');

    if ($_POST['accion'] == 'registrar') {
        
        echo 'registrar';
        $cotizacion->setIdProyecto($_POST["proyecto"]);
        $cotizacion->setIdEtapa($_POST["etapa"]);
        $cotizacion->setIdFamilia($_POST["familia"]);
        $cotizacion->setConcepto($_POST["concepto"] ?: $_POST["conceptoLista"]);
        $cotizacion->setNumeroCasas($_POST["numeroCasas"]);
        $cotizacion->setImporteM2($_POST["importeM2"]);
        $cotizacion->setMetros2($_POST["metros2"]);
        $cotizacion->setImporte($_POST["importe"]);
        $cotizacion->setFecha(date('Y-m-d'));
        
        try {
            echo 'Try';
            // $procedure = $coneccion->gestionCotizacion(
            //     0,
            //     $cotizacion->getConcepto(),
            //     $cotizacion->getImporte(),
            //     $cotizacion->getFecha(),
            //     $cotizacion->getIdArea(),
            //     $cotizacion->getIdProyecto(),
            //     $cotizacion->getIdEtapa(),
            //     'I'
            // );
            
            // echo 'Lo ejecuto';
            // $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            
            // header('Location: ../Nueva_Cotizacion.php');

            // if($_POST['idRol'] != 1){
            //     header('Location: ../inicio.php?register=success');
            // } else {
            //     header("Location: ../perfil.php?nombreUsuario=edgar");
            // }

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
           
            header("Location: ../Nueva_Cotizacion.php?error=1");
        } catch (Exception $error) {
            echo $error;
        }
            
    }
    
    if ($_POST['accion'] == 'editar') {
        echo 'editar';

        $cotizacion->setIdCotizacion($_POST['presupuestoID']);
        $cotizacion->setConcepto($_POST["concepto"]);
        $cotizacion->setImporte($_POST["importe"]);
        $cotizacion->setFecha(date('Y-m-d'));
        $cotizacion->setIdArea($_POST["area"]);
        $cotizacion->setIdProyecto($_POST["proyecto"]);
        $cotizacion->setIdEtapa($_POST["etapa"]);
        
        try {

            echo 'Try';
            $procedure = $coneccion->gestionCotizacion(
                $cotizacion->getIdCotizacion(),
                $cotizacion->getConcepto(),
                $cotizacion->getImporte(),
                $cotizacion->getFecha(),
                $cotizacion->getIdArea(),
                $cotizacion->getIdProyecto(),
                $cotizacion->getIdEtapa(),
                'U'
            );

            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            
            header('Location: ../Nueva_Cotizacion.php');

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header("Location: ../Nueva_Cotizacion.php?error=1");
        } catch (Exception $error) {
            echo $error;
        }
            
    }

    
}
?>