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

    echo 'ID: ' . $pago->getIdPago() . '<br>';
    echo 'Concepto: ' . $pago->getConcepto() . '<br>';
    echo 'Importe: ' . $pago->getImporte() . '<br>';
    echo 'Fecha: ' . $pago->getFechaPago() . '<br>';
    echo 'Es ingreso: ' . $pago->getEsIngreso() . '<br>';
    echo 'ID pago: ' . $pago->getIdTipoPago() . '<br>';
    echo 'ID area: ' . $pago->getIdArea() . '<br>';
    echo 'ID usuario: ' . $pago->getIdUsuario() . '<br>';
    echo 'Es general: ' . $pago->getEsGeneral() . '<br>';
    echo 'ID proyecto: ' . $pago->getIdProyecto() . '<br>';
    echo 'ID etaoa: ' . $pago->getIdEtapa() . '<br>';
    echo 'ID familia: ' . $pago->getIdFamilia() . '<br>';
    echo 'ID concepto: ' . $pago->getIdConcepto() . '<br>';
    echo 'ID concepto b: ' . $pago->getIdConceptoB() . '<br>';
    echo 'Comentario: ' . $pago->getComentario() . '<br>';
    echo 'ID cliente: ' . $pago->getIdCliente() . '<br>';
    echo 'ID aportador: ' . $pago->getIdAportador() . '<br>';
    echo 'ID banco: ' . $pago->getIdBanco() . '<br>';
    echo 'ID proveedor: ' . $pago->getIdProveedor() . '<br>';
    echo 'ID empleado: ' . $pago->getIdEmpleado() . '<br>';

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
            } else if (isset($_POST['sueldo'])) {
                echo 'Es Nómina' . '</br>';
                $numEmpleados = count($_POST['sueldo']);

                for ($i=0; $i < $numEmpleados; $i++) { 
                    $pago->setConcepto("Nómina " . $_POST['nombreEmpleado'][$i]);
                    $pago->setImporte($_POST['total'][$i]);
                    echo $pago->getConcepto() . '= ' . $pago->getImporte() . '</br>';
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
                $pago->getIdPago(),
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