<?php 
ob_start();
include_once('../php/conection.php');
include_once('../modelos/Proyecto.php');

echo "HOLA" . "</br>";

if (isset($_POST['accion'])) {

    ECHO $_POST["nombreProyecto"] . "</br>";
    ECHO $_POST["totalCasas"] . "</br>";
    ECHO $_POST["totalEtapas"] . "</br>";
    ECHO $_POST["prototipos"] . "</br>";
    
    foreach ($_POST['metros'] as $metros) {
        ECHO $metros . "</br>";
    }
    ECHO $_POST["accion"] . "</br>";

    if ($_POST['accion'] == 'registrar') {
        $proyecto = new Proyecto(require 'php/config.php');
        $coneccion = new DB(require 'php/config.php');
        echo 'registrar';
        $proyecto->setNombre($_POST["nombreProyecto"]);
        $proyecto->setTotalCasas($_POST["totalCasas"]);
        $proyecto->setTotalEtapas($_POST["totalEtapas"]);
        $proyecto->setPrototipos($_POST["prototipos"]);
        
        try {
            echo 'Try';
            $procedure = $coneccion->gestionProyecto(
                0,
                $proyecto->getNombre(),
                $proyecto->getTotalCasas(),
                $proyecto->getTotalEtapas(),
                $proyecto->getPrototipos(),
                'I'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                echo $resultado['idProyecto'];
                $idProyecto = $resultado['idProyecto'];
                $prototipoCount = 1;

                foreach ($_POST['metros'] as $metros) {
                    $nombre = "Prototipo " . $prototipoCount;
                    $proc = $coneccion->gestionPrototipo(0, $nombre, $metros, $idProyecto, 'I');
                    $resultado = $proc->fetch(PDO::FETCH_ASSOC);

                    echo '<br> Agregado Prototipo ' . ($prototipoCount);
                    $prototipoCount++;
                }

                $procedure = $coneccion->gestionProyectoVivienda($idProyecto, 0, 'D');
                $resultado = $procedure->fetch(PDO::FETCH_ASSOC);

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
            //header('Location: ../Nuevo_Proyecto.php?success=0');
        } catch (Exception $error) {
            echo $error;
        }
            
    }

    /*if ($_POST['accion'] == 'editar') {
        $usuario = new Usuario();
        $coneccion = new DB();
        $nombreUsu = $_POST['nombreUsu'];

        $usuario->setNombreUsuario($_POST['nombreUsu']);
        $usuario->setContraseña($_POST['contra']);
        $usuario->setNombre($_POST['nombre']);
        $usuario->setApellidos($_POST['apellido']);
        $usuario->setEmail($_POST['email']);
        $usuario->setSexo($_POST['sexo']);
        $usuario->setFechaNacimiento($_POST['fecha']);
        $usuario->setIdRol($_POST['idRol']);
        $imagenGuardada = "";

        if ($_POST['imagenN'] == '') {
            $imagenGuardada = "NULL";
        } else {
            $imagenGuardada = "0x".bin2hex(file_get_contents($_FILES["imagen"]["tmp_name"]));
        }
        
        try {

            $procedure = $coneccion->gestionUsuario(
                $usuario->getNombreUsuario(),
                $usuario->getContraseña(),
                $usuario->getNombre(),
                $usuario->getApellidos(),
                $usuario->getFechaNacimiento(),
                $usuario->getEmail(),
                $usuario->getSexo(),
                $imagenGuardada,
                $usuario->getIdRol(),
                'U'
            );

            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            header("Location: ../perfil.php?nombreUsuario=$nombreUsu");

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo $err . ' ' . $errorCode;
        }
            
    }*/

}
?>