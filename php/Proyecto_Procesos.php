<?php 
ob_start();
include_once('../php/conection.php');
include_once('../modelos/Proyecto.php');

echo "HOLA" . "</br>";

if (isset($_POST['accion'])) {
    $proyecto = new Proyecto(require 'php/config.php');
    $coneccion = new DB(require 'php/config.php');

    ECHO $_POST["nombreProyecto"] . "</br>";
    ECHO $_POST["totalCasas"] . "</br>";
    ECHO $_POST["totalEtapas"] . "</br>";
    ECHO $_POST["prototipos"] . "</br>";
    
    foreach ($_POST['metros'] as $metros) {
        ECHO $metros . "</br>";
    }
    ECHO $_POST["accion"] . "</br>";

    
    $proyecto->setNombre($_POST["nombreProyecto"]);
    $proyecto->setTotalCasas($_POST["totalCasas"]);
    $proyecto->setTotalEtapas($_POST["totalEtapas"]);
    $proyecto->setPrototipos($_POST["prototipos"]);
    $proyecto->setManzanas($_POST["manzanas"]);
    $proyecto->setMetrosBase($_POST["m2Base"]);

    if ($_POST['accion'] == 'registrar') {
        echo 'registrar';
        
        try {
            echo 'Try';
            $procedure = $coneccion->gestionProyecto(
                0,
                $proyecto->getNombre(),
                $proyecto->getTotalCasas(),
                $proyecto->getTotalEtapas(),
                $proyecto->getPrototipos(),
                $proyecto->getManzanas(),
                $proyecto->getMetrosBase(),
                'I'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                echo $resultado['idProyecto'];
                $idProyecto = $resultado['idProyecto'];
                $prototipoCount = 1;
                $manzanaCount = 1;

                foreach ($_POST['metros'] as $metros) {
                    $nombre = "Prototipo " . $prototipoCount;
                    $proc = $coneccion->gestionPrototipo(0, $nombre, $metros, $idProyecto, 'I');
                    $resultado = $proc->fetch(PDO::FETCH_ASSOC);

                    echo '<br> Agregado Prototipo ' . ($prototipoCount);
                    $prototipoCount++;
                }

                foreach ($_POST['numeros'] as $numeros) {
                    $nombre = "Manzana " . $manzanaCount;
                    $proc = $coneccion->gestionManzana(0, $nombre, $numeros, $idProyecto, 0, 'I');
                    $resultado = $proc->fetch(PDO::FETCH_ASSOC);

                    echo '<br> Agregada Manzana ' . ($manzanaCount);
                    $manzanaCount++;
                }

                foreach ($_POST['tipoVivienda'] as $vivienda) {
                    $proc = $coneccion->gestionProyectoVivienda($idProyecto, $vivienda, 'I');
                    $resultado = $proc->fetch(PDO::FETCH_ASSOC);

                    echo '<br> Agregada vivienda ID ' . ($vivienda);
                }
                
                header('Location: ../Portafolio.php?id='. $idProyecto . '&success=1');
            } else {
                echo '<br>No trae nada';
                header('Location: ../Nuevo_Proyecto.php?success=0');
            }

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header('Location: ../Nuevo_Proyecto.php?success=0');
        } catch (Exception $error) {
            echo $error;
        }
            
    }

    if ($_POST['accion'] == 'editar') {
        echo 'editar';
        $proyecto->setIdProyecto($_POST["proyectoID"]);
        
        try {
            echo 'Try';
            $procedure = $coneccion->gestionProyecto(
                $proyecto->getIdProyecto(),
                $proyecto->getNombre(),
                $proyecto->getTotalCasas(),
                $proyecto->getTotalEtapas(),
                $proyecto->getPrototipos(),
                $proyecto->getManzanas(),
                $proyecto->getMetrosBase(),
                'U'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);

            $idProyecto = $proyecto->getIdProyecto();
            $prototipoCount = 1;
            $maxPrototipo = 1;
            $prototipoID = [];
            $manzanaCount = 1;
            $maxManzana = 1;
            $manzanaID = [];

            $proc = $coneccion->gestionPrototipo(0, '', 0, $idProyecto, 'S');
            while ($row = $proc->fetch(PDO::FETCH_ASSOC)) {
                $prototipoID[] = $row['idPrototipo'];
                $maxPrototipo++;
            }

            foreach ($_POST['metros'] as $metros) {
                $nombre = "Prototipo " . $prototipoCount;
                $proc = $coneccion->gestionPrototipo(0, $nombre, $metros, $idProyecto, 'U');
                $resultado = $proc->fetch(PDO::FETCH_ASSOC);

                if (!$resultado) {
                    $proc = $coneccion->gestionPrototipo(0, $nombre, $metros, $idProyecto, 'I');
                    $resultado = $proc->fetch(PDO::FETCH_ASSOC);
                }
                echo '<br> Actualizado Prototipo ' . ($prototipoCount);
                $prototipoCount++;
            }
            
            echo "<br>". $maxPrototipo. " - " .$prototipoCount."<br>";
            if ($maxPrototipo >= $prototipoCount) {
                $reverseProtoID = array_reverse($prototipoID);
                for ($i=$prototipoCount; $i < $maxPrototipo; $i++) { 
                    $id = $i - $prototipoCount;
                    echo"<br>".  $prototipoID[$id] ."<br>";
                    $proc = $coneccion->gestionPrototipo($reverseProtoID[$id], '', 0, 0, 'D');
                    $resultado = $proc->fetch(PDO::FETCH_ASSOC);
                }
            }

            $proc = $coneccion->gestionManzana(0, '', 0, $idProyecto, 0, 'S');
            while ($row = $proc->fetch(PDO::FETCH_ASSOC)) {
                $manzanaID[] = $row['idManzana'];
                $maxManzana++;
            }

            foreach ($_POST['numeros'] as $numeros) {
                $nombre = "Manzana " . $manzanaCount;
                $proc = $coneccion->gestionManzana(0, $nombre, $numeros, $idProyecto, 0, 'U');
                $resultado = $proc->fetch(PDO::FETCH_ASSOC);

                if (!$resultado) {
                    $proc = $coneccion->gestionManzana(0, $nombre, $numeros, $idProyecto, 0, 'I');
                    $resultado = $proc->fetch(PDO::FETCH_ASSOC);
                }

                echo '<br> Agregada Manzana ' . ($manzanaCount);
                $manzanaCount++;
            }

            echo $maxManzana. " - " .$manzanaCount;
            echo "<br>". $maxManzana. " - " .$manzanaCount."<br>";
            if ($maxManzana >= $manzanaCount) {
                $reverseManzanaID = array_reverse($manzanaID);
                for ($i=$manzanaCount; $i < $maxManzana; $i++) { 
                    $id = $i - $manzanaCount;
                    echo"<br>".  $manzanaID[$id] ."<br>";
                    $proc = $coneccion->gestionManzana($reverseManzanaID[$id], '', 0, 0, 0, 'D');
                    $resultado = $proc->fetch(PDO::FETCH_ASSOC);
                }
            }

            $procedure = $coneccion->gestionProyectoVivienda($idProyecto, 0, 'D');
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);

            foreach ($_POST['tipoVivienda'] as $vivienda) {
                $proc = $coneccion->gestionProyectoVivienda($idProyecto, $vivienda, 'I');
                $resultado = $proc->fetch(PDO::FETCH_ASSOC);

                echo '<br> Agregada vivienda ID ' . ($vivienda);
            }
            
            header('Location: ../Portafolio.php?id='. $idProyecto . '&success=1');

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            //header('Location: ../Nuevo_Proyecto.php?id='. $idProyecto . '&success=0');
        } catch (Exception $error) {
            echo $error;
        }
            
    }
}
?>