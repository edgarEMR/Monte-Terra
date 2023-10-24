<?php
ob_start();
include_once('../php/conection.php');
include_once('../modelos/Operador.php');

if (isset($_POST['accion'])) {

    ECHO $_POST["nombre"] . '<br>';
    ECHO $_POST["RFCAportador"] . '<br>';

    $operador = new Operador(require 'php/config.php');
    $coneccion = new DB(require 'php/config.php');

    $operador->setNombre($_POST["nombre"]);
    $operador->setSueldo($_POST["sueldo"]);
    $operador->setIdMaquina($_POST["maquina"]);

    if ($_POST['accion'] == 'registrar') {
        
        echo 'registrar';
        
        try {
            echo 'Try';
            $procedure = $coneccion->gestionOperador(
                0,
                $operador->getNombre(),
                $operador->getSueldo(),
                $operador->getIdMaquina(),
                'I'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);

            header('Location: ../Nuevo_Operador.php?success=1');

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header('Location: ../Nuevo_Operador.php?success=0');
        } catch (Exception $error) {
            echo $error;
        }
            
    }
    
    if ($_POST['accion'] == 'editar') {

        echo 'editar';
        $operador->setIdOperador($_POST["operadorID"]);

        try {

            echo 'Try';
            $procedure = $coneccion->gestionOperador(
                $operador->getIdOperador(),
                $operador->getNombre(),
                $operador->getSueldo(),
                $operador->getIdMaquina(),
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

    if ($_POST['accion'] == 'nomina') {

        echo 'nomina';

        try {

            echo 'Es Nómina' . '</br>';
            $numOperadores = count($_POST['sueldo']);

            for ($i=0; $i < $numOperadores; $i++) { 
                // $pago->setConcepto();
                // $pago->setImporte($_POST['total'][$i]);
                echo "Nómina " . $_POST['nombre'][$i] . '= ' . $_POST['total'][$i] . '</br>';
                // $procedure = $coneccion->gestionPago(
                //     0,
                //     $pago->getConcepto(),
                //     $pago->getImporte(),
                //     $pago->getEsIngreso(),
                //     $pago->getIdTipoPago(),
                //     $pago->getIdArea(),
                //     $pago->getIdUsuario(),
                //     $pago->getEsGeneral(),
                //     $pago->getIdProyecto(),
                //     $pago->getIdEtapa(),
                //     $pago->getIdFamilia(),
                //     $pago->getIdConcepto(),
                //     $pago->getIdConceptoB(),
                //     $pago->getComentario(),
                //     $pago->getIdCliente(),
                //     $pago->getIdAportador(),
                //     $pago->getIdBanco(),
                //     $pago->getIdProveedor(),
                //     $pago->getIdEmpleado(),
                //     'I'
                // );

                // $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            }
            
            //header('Location: ../Maquinaria.php');


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