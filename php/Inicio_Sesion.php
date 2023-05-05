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

            session_write_close();
            header("Location: ../Proyectos.php");
        } else {
            header("Location: ../index.php");
        }
    }
?>