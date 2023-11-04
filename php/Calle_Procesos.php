<?php 
ob_start();
include_once('../php/conection.php');
include_once('../modelos/Etapa.php');

if (isset($_POST['accion'])) {
    $etapa = new Etapa(require 'php/config.php');

    if ($_POST['accion'] == 'registrar') {
        $coneccion = new DB(require 'php/config.php');
        $idProyecto = $_POST['proyectoID'];
        
        try {
            $procedure = $coneccion->gestionCalle( 
                0,
                $_POST['nombreCalle'],
                $_POST['totalLotes'],
                $_POST['etapaID'],
                "I");
            
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            
            if($resultado) {
                $idCalle = $resultado['idCalle'];

                for ($i=0; $i < $_POST['totalLotes']; $i++) {
                    $numeroLote = 100 + $i;
                    $proc = $coneccion->gestionLote(0, $numeroLote, 'NULL', $_POST['precioLista'], 0, 0, 0, 0, 'NULL', 0, 'NULL', 'NULL', $_POST['prototipo'], 'NULL', $idCalle, 'NULL', 'NULL', 'I');
                    $result = $proc->fetch(PDO::FETCH_ASSOC);
                    echo '<br> Agregado Lote ' . ($numeroLote);
                }

                header('Location: ../Nueva_Etapa.php?id='. $idProyecto .'&successCalle=1');
            } else {
                header('Location: ../Nueva_Etapa.php?id='. $idProyecto .'&successCalle=0');
            }

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo $err . ' ' . $errorCode;
            header('Location: ../Nueva_Etapa.php?id='. $idProyecto .'&successCalle=0');
        }
            
    }

   if ($_POST['accion'] == 'obtener') {
        $idEtapa = $_POST['id'];
        $coneccion = new DB(require 'php/config.php');
        
        try {

            $procedure = $coneccion->gestionCalle( 0, '', 0, $idEtapa, "S");
            
            while($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value=".$rows['idCalle'].">".$rows['nombre']."</option>";
            }

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo $err . ' ' . $errorCode;
        }
            
    }

/*     if ($_POST['accion'] == 'select') {
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
            
    }*/
}
?>