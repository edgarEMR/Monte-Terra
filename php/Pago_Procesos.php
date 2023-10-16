<?php 
ob_start();
session_start();
include_once('../php/conection.php');
include_once('../modelos/Pago.php');

echo "HOLA" . '<br>';

if (isset($_POST['accion'])) {
    echo "<table>";
    foreach ($_POST as $key => $value) {
        $checked = $value ?: 'NULL';
        echo "<tr>";
        echo "<td>";
        echo $key;
        echo "</td>";
        echo "<td>";
        echo $checked;
        //echo $value;
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";

    $pago = new Pago(require 'php/config.php');
    $coneccion = new DB(require 'php/config.php');

    $pago->setIdPago($_POST['pagoID'] ?: 'NULL');
    $pago->setConcepto($_POST['concepto'] ?: 'NULL');
    $pago->setImporte($_POST['importe']) ?: 'NULL';
    $pago->setFechaPago('');
    $pago->setEsIngreso($_POST['esIngreso']);
    $pago->setIdTipoPago($_POST['tipoPago'] ?: 'NULL');
    $pago->setIdArea($_POST['origen'] ?: 'NULL');
    $pago->setIdUsuario($_SESSION['idUsuario'] ?: 'NULL');
    $pago->setEsGeneral($_POST['tipo'] == 'General' ? 1 : 0);
    $pago->setIdProyecto($_POST['proyecto'] ?: 'NULL');
    $pago->setIdEtapa($_POST['etapa'] ?: 'NULL');
    $pago->setIdFamilia($_POST['area'] ?: 'NULL');
    $pago->setIdConcepto($_POST['conceptoA'] ?: 'NULL');
    $pago->setIdConceptoB($_POST['conceptoB'] ?: 'NULL');
    $pago->setComentario($_POST['comentario'] ?: 'NULL');
    $pago->setIdCliente($_POST['cliente'] ?: 'NULL');
    $pago->setIdAportador($_POST['aportador'] ?: 'NULL');
    $pago->setIdBanco($_POST['banco'] ?: 'NULL');
    $pago->setIdProveedor($_POST['proveedor'] ?: 'NULL');
    $pago->setIdEmpleado($_POST['empleado'] ?: 'NULL');

    echo $pago->getIdPago() . '<br>';
    echo $pago->getConcepto() . '<br>';
    echo $pago->getImporte() . '<br>';
    echo $pago->getFechaPago() . '<br>';
    echo $pago->getEsIngreso() . '<br>';
    echo $pago->getIdTipoPago() . '<br>';
    echo $pago->getIdArea() . '<br>';
    echo $pago->getIdUsuario() . '<br>';
    echo $pago->getEsGeneral() . '<br>';
    echo $pago->getIdProyecto() . '<br>';
    echo $pago->getIdEtapa() . '<br>';
    echo $pago->getIdFamilia() . '<br>';
    echo $pago->getIdConcepto() . '<br>';
    echo $pago->getIdConceptoB() . '<br>';
    echo $pago->getComentario() . '<br>';
    echo $pago->getIdCliente() . '<br>';
    echo $pago->getIdAportador() . '<br>';
    echo $pago->getIdBanco() . '<br>';
    echo $pago->getIdProveedor() . '<br>';
    echo $pago->getIdEmpleado() . '<br>';

    if ($_POST['accion'] == 'registrar') {

        $esProrrateo = $pago->getIdArea() == 19 || $pago->getIdArea() == 20 ? true : false;
        
        echo 'registrar';
        try {
            echo 'Try' . '</br>';

            if ($esProrrateo) {
                echo 'Es Prorrateo' . '</br>';
                $importeProrrateo = number_format($_POST['importe'] / count($_POST['proyectoGen']), 2);
                $pago->setImporte($importeProrrateo);
                foreach ($_POST['proyectoGen'] as $proyecto) {
                        $pago->setIdProyecto($proyecto);
                        $procedure = $coneccion->gestionPago(
                            0,
                            $pago->getConcepto(),
                            $pago->getImporte(),
                            $pago->getEsIngreso(),
                            $pago->getIdTipoPago(),
                            $pago->getIdArea(),
                            $pago->getIdUsuario(),
                            $pago->getEsGeneral(),
                            $pago->getIdProyecto(),
                            $pago->getIdEtapa(),
                            $pago->getIdFamilia(),
                            $pago->getIdConcepto(),
                            $pago->getIdConceptoB(),
                            $pago->getComentario(),
                            $pago->getIdCliente(),
                            $pago->getIdAportador(),
                            $pago->getIdBanco(),
                            $pago->getIdProveedor(),
                            $pago->getIdEmpleado(),
                            'I'
                        );

                        $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
                }
            }if (isset([$_POST['sueldo']])) {
                echo 'Es Nómina' . '</br>';
                $importeProrrateo = number_format($_POST['importe'] / count($_POST['proyectoGen']), 2);
                
                foreach ($_POST['proyectoGen'] as $proyecto) {
                    $pago->setImporte($importeProrrateo);
                        $pago->setIdProyecto($proyecto);
                        $procedure = $coneccion->gestionPago(
                            0,
                            $pago->getConcepto(),
                            $pago->getImporte(),
                            $pago->getEsIngreso(),
                            $pago->getIdTipoPago(),
                            $pago->getIdArea(),
                            $pago->getIdUsuario(),
                            $pago->getEsGeneral(),
                            $pago->getIdProyecto(),
                            $pago->getIdEtapa(),
                            $pago->getIdFamilia(),
                            $pago->getIdConcepto(),
                            $pago->getIdConceptoB(),
                            $pago->getComentario(),
                            $pago->getIdCliente(),
                            $pago->getIdAportador(),
                            $pago->getIdBanco(),
                            $pago->getIdProveedor(),
                            $pago->getIdEmpleado(),
                            'I'
                        );

                        $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
                }
            } else {
                $procedure = $coneccion->gestionPago(
                    0,
                    $pago->getConcepto(),
                    $pago->getImporte(),
                    $pago->getEsIngreso(),
                    $pago->getIdTipoPago(),
                    $pago->getIdArea(),
                    $pago->getIdUsuario(),
                    $pago->getEsGeneral(),
                    $pago->getIdProyecto(),
                    $pago->getIdEtapa(),
                    $pago->getIdFamilia(),
                    $pago->getIdConcepto(),
                    $pago->getIdConceptoB(),
                    $pago->getComentario(),
                    $pago->getIdCliente(),
                    $pago->getIdAportador(),
                    $pago->getIdBanco(),
                    $pago->getIdProveedor(),
                    $pago->getIdEmpleado(),
                    'I'
                );

                $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            }
            
            echo 'Lo ejecuto';

            header('Location: ../Detalle_Pago.php?success=1');

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header("Location: ../Detalle_Pago.php?success=0");
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
                0,
                $pago->getConcepto(),
                $pago->getImporte(),
                $pago->getEsIngreso(),
                $pago->getIdTipoPago(),
                $pago->getIdArea(),
                $pago->getIdUsuario(),
                $pago->getEsGeneral(),
                $pago->getIdProyecto(),
                $pago->getIdEtapa(),
                $pago->getIdFamilia(),
                $pago->getIdConcepto(),
                $pago->getIdConceptoB(),
                $pago->getComentario(),
                $pago->getIdCliente(),
                $pago->getIdAportador(),
                $pago->getIdBanco(),
                $pago->getIdProveedor(),
                $pago->getIdEmpleado(),
                'I'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            echo 'Lo ejecuto';
            // $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            
            // header('Location: ../Portafolio.php?id='. $pago->getIdProyecto());


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