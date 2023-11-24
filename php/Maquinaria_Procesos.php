<?php 
ob_start();
session_start();
include_once('../php/conection.php');
include_once('../modelos/Maquina.php');

if (isset($_POST['accion'])) {
    $maquina = new Maquina(require 'php/config.php');
    $coneccion = new DB(require 'php/config.php');

    if ($_POST['accion'] == 'registrar') {
        try {
            $maquina->setNombre($_POST['maquina'] ?: 'NULL');
            $maquina->setCosto($_POST['importe'] ?: 'NULL');
            $maquina->setIdRecurrencia($_POST['concepto'] ?: 'NULL');

            $procedure = $coneccion->gestionMaquinaria(
                0,
                $maquina->getNombre(),
                $maquina->getCosto(),
                $maquina->getIdRecurrencia(),
                'I'
            );

            $result = $procedure->fetch(PDO::FETCH_ASSOC);

            if($resultado){
                header('Location: ../Nueva_Maquina.php?success=1');
            } else {
                header("Location: ../Nueva_Maquina.php?success=0");
            }
        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header("Location: ../Nueva_Maquina.php?success=0");
        }
        
    }

    if ($_POST['accion'] == 'pago') {
        try {

            $procedure = $coneccion->gestionPagoMaquinaria(
                0,
                $_POST['concepto'] ?: 'NULL',
                $_POST['conceptoB'] ?: 'NULL',
                $_POST['cantidad'] ?: 'NULL',
                $_POST['precioUnitario'] ?: 'NULL',
                $_POST['modificacion'] ?: 'NULL',
                $_POST['importe'],
                $_POST['esIngreso'],
                $_POST['tipoPago'] ?: 'NULL',
                $_POST['maquina'] ?: 'NULL',
                $_POST['proyecto'] ?: 'NULL',
                $_POST['proveedor'] ?: 'NULL',
                $_SESSION['idUsuario'] ?: 'NULL',
                'I'
            );

            $result = $procedure->fetch(PDO::FETCH_ASSOC);

            header('Location: ../Movimiento_Maquinaria.php?success=1');
                
        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header("Location: ../Movimiento_Maquinaria.php?success=0");
        }
        
    }

    if ($_POST['accion'] == 'obtener') {
        try {
            $maquina->setIdMaquinaria($_POST['id'] ?: 'NULL');

            $procedure = $coneccion->gestionMaquinaria($_POST['id'], '', 0, 0, 'S');

            $resultado = $procedure->fetchAll(PDO::FETCH_DEFAULT);
            echo json_encode($resultado[0]);
        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
        }
        
    }
}
?>