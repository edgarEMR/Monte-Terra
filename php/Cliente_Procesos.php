<?php 
ob_start();
session_start();
include_once('../php/conection.php');
include_once('../modelos/Cliente.php');

echo "HOLA" . '<br>';

if (isset($_POST['accion'])) {

    ECHO $_POST["primerNombre"] . '<br>';
    ECHO $_POST["segundoNombre"] . '<br>';
    ECHO $_POST["apPaterno"] . '<br>';
    ECHO $_POST["apMaterno"] . '<br>';
    ECHO $_POST["email"] . '<br>';
    ECHO $_POST["telefono"] . '<br>';
    ECHO $_POST["tipoVivienda"] . '<br>';
    ECHO $_POST["tipoCredito"] . '<br>';
    ECHO $_POST["credito"] . '<br>';
    ECHO $_POST["medio"] . '<br>';
    ECHO $_POST["proyecto"] . '<br>';
    ECHO $_POST["etapa"] . '<br>';
    ECHO $_POST["prototipo"] . '<br>';

    $cliente = new Cliente(require 'php/config.php');
    $coneccion = new DB(require 'php/config.php');
    
    $cliente->setNombre($_POST["primerNombre"]);
    $cliente->setSegundoNombre($_POST["segundoNombre"]);
    $cliente->setApellidoPaterno($_POST["apPaterno"]);
    $cliente->setApellidoMaterno($_POST["apMaterno"]);
    $cliente->setEmail($_POST["email"]);
    $cliente->setTelefono($_POST["telefono"]);
    $cliente->setTipoVivienda($_POST["tipoVivienda"]);
    $cliente->setTipoCredito($_POST["tipoCredito"]);
    $cliente->setCredito($_POST["credito"]);
    $cliente->setMedio($_POST["medio"]);
    $cliente->setIdProyecto($_POST["proyecto"]);
    $cliente->setIdEtapa($_POST["etapa"]);
    $cliente->setIdPrototipo($_POST["prototipo"]);
    $cliente->setIdVendedor($_SESSION['idUsuario']);
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
                $cliente->getTipoVivienda(),
                $cliente->getTipoCredito(),
                $cliente->getCredito(),
                $cliente->getMedio(),
                $cliente->getEsProspecto(),
                $cliente->getIdProyecto(),
                $cliente->getIdEtapa(),
                $cliente->getIdPrototipo(),
                $cliente->getIdVendedor(),
                'I'
            );
            
            echo 'Lo ejecuto';
            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);

            header('Location: ../Nuevo_Prospecto.php?success=1');

        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header('Location: ../Nuevo_Prospecto.php?success=0');
        } catch (Exception $error) {
            echo $error;
        }
            
    }
    
}
?>