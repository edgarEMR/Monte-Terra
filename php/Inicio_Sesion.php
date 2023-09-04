<?php 
    ob_start();
    session_start();
    include_once('../php/conection.php');

    $conection = new DB(require '../php/config.php');

    if(isset($_POST["usuario"]) && isset($_POST["contraseña"])) {
        $procedure = $conection->inicioSesion($_POST["usuario"], $_POST["contraseña"]);
        $row = $procedure->fetch(PDO::FETCH_ASSOC);
        if($procedure->rowCount() > 0) {
            echo "Hola";
            echo $row["idUsuario"];
            echo $row["nombre"];
            echo $row["correo"];

            $_SESSION["idUsuario"] = $row["idUsuario"];
            $_SESSION["nombre"] = $row["nombre"];
            $_SESSION["correo"] = $row["correo"];
            $_SESSION["rol"] = $row["idDepa"];

            session_write_close();
            switch ($row["idDepa"]) {
                case 1:
                    header("Location: ../Menu.php");
                    break;
                
                case 2:
                    header("Location: ../Proyectos.php");
                    break;

                case 3:
                    header("Location: ../Ventas.php");
                    break;

                case 4:
                    header("Location: ../Maquinaria.php");
                    break;

                default:
                    header("Location: ../index.php?invalid=1");
                    break;
            }
            
        } else {
            header("Location: ../index.php?error=1");
        }
    }
?>