<?php 
ob_start();
include_once('../php/conection.php');
include_once('../modelos/Etapa.php');

echo "HOLA" . '<br>';

if (isset($_POST['accion'])) {

    if ($_POST['accion'] == 'obtener') {
        $idProyecto = $_POST['id'];
        $coneccion = new DB(require 'php/config.php');
        
        try {

            $procedure = $coneccion->gestionEtapa( 0, 0, 0, $idProyecto, "S");
            
            echo '<option value="0">Todas</option>';

            while($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value=".$rows['idEtapa'].">".$rows['numeroEtapa']."</option>";
            }

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo $err . ' ' . $errorCode;
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

    /*if ($_POST['accion'] == 'registrar') {
        $presupuesto = new Presupuesto();
        $coneccion = new DB();
        echo 'registrar';
        $presupuesto->setConcepto($_POST["nombreProyecto"]);
        $presupuesto->setImporte($_POST["presupuesto"]);
        $presupuesto->sete($_POST["totalCasas"]);
        $presupuesto->setTotalEtapas($_POST["totalEtapas"]);
        
        try {
            echo 'Try';
            $procedure = $coneccion->gestionProyecto(
                0,
                $presupuesto->getNombre(),
                $presupuesto->getTotalCasas(),
                $presupuesto->getTotalEtapas(),
                $presupuesto->getPresupuesto(),
                'I'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);

            if ($resultado) {
                echo $resultado['idProyecto'];
                $idProyecto = $resultado['idProyecto'];

                for ($i=0; $i < $presupuesto->getTotalEtapas(); $i++) { 
                    $procedure = $coneccion->gestionEtapa(
                        0,
                        $i + 1,
                        $_POST['casasEtapa' . ($i + 1)],
                        $idProyecto,
                        'I'
                    );

                    $resultadoEtapa = $procedure->fetch(PDO::FETCH_ASSOC);

                    echo '<br> Agregada Etapa ' . ($i + 1);

                }

                
                header('Location: ../Presupuesto.php?id='. $idProyecto);
            } else {
                echo '<br>No trae nada';
            }


            // if($_POST['idRol'] != 1){
            //     header('Location: ../inicio.php?register=success');
            // } else {
            //     header("Location: ../perfil.php?nombreUsuario=edgar");
            // }

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header("Location: ../Nuevo_Proyecto.php?error=1");
        } catch (Exception $error) {
            echo $error;
        }
            
    }*/
}
?>