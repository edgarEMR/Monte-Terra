<?php 
ob_start();
include_once('../php/conection.php');
include_once('../modelos/Etapa.php');

if (isset($_POST['accion'])) {
    $etapa = new Etapa(require 'php/config.php');
    $viviendas = [];

    if ($_POST['accion'] == 'obtener') {
        $idProyecto = $_POST['id'];
        $coneccion = new DB(require 'php/config.php');
        
        try {

            $proc = $coneccion->gestionProyectoVivienda($idProyecto, 0, 'S');
            while ($row = $proc->fetch(PDO::FETCH_ASSOC)) {
                $viviendas[] = $row['idVivienda'];
            }
            
            $procedure = $coneccion->obtenerTipoVivienda();
            while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                if (in_array($rows['idVivienda'], $viviendas)) {
                    echo "<option value=".$rows['nombre'].">".$rows['nombre']."</option>";
                }
            }

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo $err . ' ' . $errorCode;
        }
            
    }

    if ($_POST['accion'] == 'select') {
        $idEtapa = $_POST['id'];
        $coneccion = new DB(require 'php/config.php');
        
        try {

            $procedure = $coneccion->gestionEtapa( $idEtapa, 0, 0, 0, 0, 0, "E");
            
            $resultado = $procedure->fetchAll(PDO::FETCH_DEFAULT);
            echo json_encode($resultado[0]);
        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo $err . ' ' . $errorCode;
        }
            
    }
}
?>