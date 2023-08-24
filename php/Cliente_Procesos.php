<?php 
ob_start();
include_once('../php/conection.php');
include_once('../modelos/Cliente.php');

echo "HOLA" . '<br>';

if (isset($_POST['accion'])) {

    ECHO $_POST["primerNombre"] . '<br>';
    ECHO $_POST["segundoNombre"] . '<br>';
    ECHO $_POST["apPaterno"] . '<br>';
    ECHO $_POST["apMaterno"] . '<br>';
    ECHO $_POST["email"] . '<br>';
    ECHO $_POST["fecha"] . '<br>';
    ECHO $_POST["telefono"] . '<br>';
    ECHO $_POST["NSS"] . '<br>';
    ECHO $_POST["puntaje"] . '<br>';
    ECHO $_POST["contraseña"] . '<br>';
    ECHO $_POST["tipoVivienda"] . '<br>';
    ECHO $_POST["ingresos"] . '<br>';
    ECHO $_POST["credito"] . '<br>';
    ECHO $_POST["medio"] . '<br>';

    $cliente = new Cliente(require 'php/config.php');
    $coneccion = new DB(require 'php/config.php');

    
    $cliente->setNombre($_POST["primerNombre"]);
    $cliente->setSegundoNombre($_POST["segundoNombre"]);
    $cliente->setApellidoPaterno($_POST["apPaterno"]);
    $cliente->setApellidoMaterno($_POST["apMaterno"]);
    $cliente->setEmail($_POST["email"]);
    $cliente->setFechaNacimiento($_POST["fecha"]);
    $cliente->setTelefono($_POST["telefono"]);
    $cliente->setNumeroSS($_POST["NSS"]);
    $cliente->setPuntaje($_POST["puntaje"]);
    $cliente->setContraseña($_POST["contraseña"]);
    $cliente->setTipoVivienda($_POST["tipoVivienda"]);
    $cliente->setIngresos($_POST["ingresos"]);
    $cliente->setCredito($_POST["credito"]);
    $cliente->setMedio($_POST["medio"]);
    $cliente->setEsProspecto(1);

    if ($_POST['accion'] == 'registrarP') {
        
        echo 'registrar';
        
        try {
            echo 'Try';
            $procedure = $coneccion->gestionCliente(
                0,
                $cliente->getNombre(),
                $cliente->getSegundoNombre(),
                $cliente->getApellidoPaterno(),
                $cliente->getApellidoMaterno(),
                $cliente->getEmail(),
                $cliente->getTelefono(),
                $cliente->getFechaNacimiento(),
                $cliente->getNumeroSS(),
                $cliente->getPuntaje(),
                $cliente->getContraseña(),
                $cliente->getTipoVivienda(),
                $cliente->getIngresos(),
                $cliente->getCredito(),
                $cliente->getMedio(),
                $cliente->getEsProspecto(),
                'I'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);

            header('Location: ../Nuevo_Cliente.php');

            // if($_POST['idRol'] != 1){
            //     header('Location: ../inicio.php?register=success');
            // } else {
            //     header("Location: ../perfil.php?nombreUsuario=edgar");
            // }

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            //header("Location: ../Nuevo_Cliente.php?error=1");
        } catch (Exception $error) {
            echo $error;
        }
            
    }
    
    if ($_POST['accion'] == 'editar') {

        echo 'editar';

        $cliente->setIdCliente($_POST["idCliente"]);
        try {

            echo 'Try';
            $procedure = $coneccion->gestionCliente(
                $cliente->getIdCliente(),
                $cliente->getNombre(),
                $cliente->getSegundoNombre(),
                $cliente->getApellidoPaterno(),
                $cliente->getApellidoMaterno(),
                $cliente->getEmail(),
                $cliente->getTelefono(),
                $cliente->getFechaNacimiento(),
                $cliente->getNumeroSS(),
                $cliente->getPuntaje(),
                $cliente->getContraseña(),
                $cliente->getTipoVivienda(),
                $cliente->getIngresos(),
                $cliente->getCredito(),
                $cliente->getMedio(),
                $cliente->getEsProspecto(),
                'U'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
            
            header('Location: ../Ventas.php');


        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header("Location: ../Ventas.php?error=1");
        } catch (Exception $error) {
            echo $error;
        }
            
    }
}
?>