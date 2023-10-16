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
    
    $cliente->setIdCliente($_POST["clienteID"] ?: 'NULL');
    $cliente->setNombre($_POST["primerNombre"] ?: 'NULL');
    $cliente->setSegundoNombre($_POST["segundoNombre"]);
    $cliente->setApellidoPaterno($_POST["apPaterno"] ?: 'NULL');
    $cliente->setApellidoMaterno($_POST["apMaterno"] ?: 'NULL');
    $cliente->setEmail($_POST["email"] ?: 'NULL');
    $cliente->setTelefono($_POST["telefono"] ?: 'NULL');
    $cliente->setTipoVivienda($_POST["tipoVivienda"] ?: 'NULL');
    $cliente->setTipoCredito($_POST["tipoCredito"] ?: 'NULL');
    $cliente->setCredito($_POST["credito"] ?: 'NULL');
    $cliente->setMedio($_POST["medio"] ?: 'NULL');
    $cliente->setIdProyecto($_POST["proyecto"] ?: 'NULL');
    $cliente->setIdEtapa($_POST["etapa"] ?: 'NULL');
    $cliente->setIdPrototipo($_POST["prototipo"] ?: 'NULL');
    $cliente->setIdVendedor($_SESSION['idUsuario'] ?: 'NULL');
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

    if ($_POST['accion'] == 'registrarC') {
        
        echo 'registrar';
        $cliente->setEsProspecto(0);
        echo $cliente->getNombre();
        try {
            if ($cliente->getIdCliente() == 'NULL') {
                echo 'ID cliente es NULL';
                $proc = $coneccion->existeProspecto($cliente->getNombre(), $cliente->getApellidoPaterno(), $cliente->getTelefono());
                $existe = $proc->fetch(PDO::FETCH_ASSOC);

                if ($existe) {
                    echo 'Cliente ya existe como prospecto';
                    header('Location: ../Nuevo_Cliente.php?success=2');
                }
            } else {
                echo 'No esta como prospecto';
                echo 'Try';
                $procedure = $coneccion->gestionCliente(
                    $cliente->getIdCliente(),
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
                    'V'
                );
                
                echo 'Lo ejecuto';
                
                $resultado = $procedure->fetch(PDO::FETCH_ASSOC);
    
                if($resultado) {
                    $idCliente = $resultado['idCliente'];
    
                    $proc = $coneccion->gestionLote($_POST['lote'], '', 0, 0, 0, $_POST['precioFinal'], $_POST['tipoCredito'], 
                        'NULL', 0, 0, 0, $idCliente, $_SESSION['idUsuario'], 'V');
                    $result = $proc->fetch(PDO::FETCH_ASSOC);
    
                    header('Location: ../Nuevo_Cliente.php?success=1');
                } else {
                    //header('Location: ../Nuevo_Cliente.php?success=0');
                }
            }
        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            //header('Location: ../Nuevo_Cliente.php?success=0');
        } catch (Exception $error) {
            echo $error;
        }
            
    }

    if ($_POST['accion'] == 'obtener') {
        
        echo 'obtener';
        try {
            echo 'Try';
            $procedure = $coneccion->obtenerClientes($_POST['proyecto'], $_POST['etapa']);
            
            echo 'Lo ejecuto';
            
            while($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value=".$rows['idCliente'].">".$rows['nombre'] . " - Calle ". $rows['calle'] . " - Lote " . $rows['numeroLote'] . "</option>";
            }
        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo $err . ' ' . $errorCode;
        } catch (Exception $error) {
            echo $error;
        }
            
    }
    
}
?>