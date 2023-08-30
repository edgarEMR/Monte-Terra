<?php 
ob_start();
include_once('../php/conection.php');
include_once('../modelos/Etapa.php');

if (isset($_POST['accion'])) {
    $etapa = new Etapa(require 'php/config.php');

    if ($_POST['accion'] == 'obtener') {
        $idProyecto = $_POST['id'];
        $coneccion = new DB(require 'php/config.php');
        
        try {

            $procedure = $coneccion->gestionPrototipo( 0, '', 0, $idProyecto, "S");
            
            while($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value=".$rows['idPrototipo'].">".$rows['nombre']." - ".$rows['metros']."</option>";
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