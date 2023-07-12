<?php 
ob_start();
include_once('../php/conection.php');

echo "HOLA" . '<br>';

if (isset($_POST['accion'])) {

    if ($_POST['accion'] == 'obtener') {
        $esIngreso = $_POST['tipo'];
        $coneccion = new DB(require '../php/config.php');
        $tipoArea = $esIngreso == 1 ? 3 : 4;

        try {
            $procedure = $coneccion->obtenerAreas($tipoArea);
            
            while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value=".$rows['valorConsecutivo'].">".$rows['nombre']."</option>";
            }

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo $err . ' ' . $errorCode;
        }
            
    }
}
?>