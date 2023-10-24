<?php
ob_start();
session_start();
include_once('../php/conection.php');
include_once('../modelos/Usuario.php');

if (isset($_POST['accion'])) {

    $usuario = new Usuario(require 'php/config.php');
    $coneccion = new DB(require 'php/config.php');

    if (isset($_POST['usuarioID'])) {
        $usuario->setIdUsuario($_POST['usuarioID']);
        $usuario->setNombre($_POST['nombre']);
        $usuario->setCorreo($_POST['correo']);
        $usuario->setContraseña($_POST['contraseña']);
        $usuario->setIdDepa($_POST['depaID']);
    }


    if ($_POST['accion'] == 'actualizar') {
        try {
            $procedure = $coneccion->gestionUsuario(
                $usuario->getIdUsuario(),
                $usuario->getNombre(),
                $usuario->getCorreo(),
                $usuario->getContraseña(),
                $usuario->getIdDepa(),
                'U'
            );

            $resultado = $procedure->fetch(PDO::FETCH_ASSOC);

            header('Location: ../Perfil.php?id='.$usuario->getIdUsuario().'&success=1');
        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
            header('Location: ../Perfil.php?id='.$usuario->getIdUsuario().'&success=0');
        }
    }

    if ($_POST['accion'] == 'obtener') {
        try {
            $procedure = $coneccion->gestionUsuario(0, '', '', '', 0, 'E');

            echo '<table id="tabla-nomina" class="table table-hover table-sm">';
            echo '<thead>';
            echo '<tr class="">';
            echo '<th scope="col" class="col-1 text-primary">NOMBRE</th>';
            echo '<th scope="col" class="col-1 text-primary">SUELDO</th>';
            echo '<th scope="col" class="col-1 text-primary">HORAS EXTRAS</th>';
            echo '<th scope="col" class="col-1 text-primary">COMPENSACIONES</th>';
            echo '<th scope="col" class="col-1 text-primary">DESCUENTO</th>';
            echo '<th scope="col" class="col-1 text-primary">CONCEPTO DESCUENTO</th>';
            echo '<th scope="col" class="col-1 text-primary">ABONO PRÉSTAMO</th>';
            echo '<th scope="col" class="col-1 text-primary">TOTAL</th>';
            echo '<th ></th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody class="table-group-divider">';
            while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td class="p-0">';
                echo '<input type="text" name="nombreEmpleado[]" class="form-control px-0" required value="'. $rows['nombre'] .'" readonly>';
                echo '</td>';
                echo '<td class="p-0">';
                echo '<input type="number" name="sueldo[]" class="form-control px-0" min="0" step="0.01" required value="" oninput="nominaTotal()">';
                echo '</td>';
                echo '<td class="p-0">';
                echo '<input type="number" name="extras[]" class="form-control px-0" min="0" step="0.01" required value="" oninput="nominaTotal()">';
                echo '</td>';
                echo '<td class="p-0">';
                echo '<input type="number" name="compensacion[]" class="form-control px-0" min="0" step="0.01" required value="" oninput="nominaTotal()">';
                echo '</td>';
                echo '<td class="p-0">';
                echo '<input type="number" name="descuento[]" class="form-control px-0" min="0" step="0.01" required value="" oninput="nominaTotal()">';
                echo '</td>';
                echo '<td class="p-0">';
                echo '<input type="text" name="conceptoN[]" class="form-control px-0" pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" required value="">';
                echo '</td>';
                echo '<td class="p-0">';
                echo '<input type="number" name="abono[]" class="form-control px-0" min="0" step="0.01" required value="" oninput="nominaTotal()">';
                echo '</td>';
                echo '<td class="p-0">';
                echo '<input type="number" name="total[]" class="form-control px-0" min="0" step="0.01" required value="">';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } catch (PDOException $err) {
            $errorCode = $err->getCode();
            echo '<br>' . $err;
        }
    }

    /*
                while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {
                echo '<div style="border: 2px solid white; border-radius: 5px;"  class="row">';
                echo '<div class="form-group col-md-12" id="divNombreEmpleado">';
                echo '<label for="inputNombreEmpleado">'. $rows['nombre'] .'</label>';
                echo '<input type="text" name="nombreEmpleado[]" class="form-control" required value="'. $rows['idUsuario'] .'" disabled>';
                echo '</td>';
                echo '<td>';
                echo '<label for="inputSueldo">Sueldo</label>';
                echo '<div class="input-group has-validation">';
                echo '<span class="input-group-text">$</span>';
                echo '<input type="number" name="sueldo[]" class="form-control" min="0" step="0.01" required value="" oninput="nominaTotal()">';
                echo '<div class="invalid-feedback">';
                echo 'Ingrese un número válido.';
                echo '</td>';
                echo '</td>';
                echo '</td>';
                echo '<td>';
                echo '<label for="inputExtras">Horas extras</label>';
                echo '<div class="input-group has-validation">';
                echo '<span class="input-group-text">$</span>';
                echo '<input type="number" name="extras[]" class="form-control" min="0" step="0.01" required value="" oninput="nominaTotal()">';
                echo '<div class="invalid-feedback">';
                echo 'Ingrese un número válido.';
                echo '</td>';
                echo '</td>';
                echo '</td>';
                echo '<td>';
                echo '<label for="inputCompensacion">Compensaciones</label>';
                echo '<div class="input-group has-validation">';
                echo '<span class="input-group-text">$</span>';
                echo '<input type="number" name="compensacion[]" class="form-control" min="0" step="0.01" required value="" oninput="nominaTotal()">';
                echo '<div class="invalid-feedback">';
                echo 'Ingrese un número válido.';
                echo '</td>';
                echo '</td>';
                echo '</td>';
                echo '<td>';
                echo '<label for="inputPrestamoN">Préstamos</label>';
                echo '<div class="input-group has-validation">';
                echo '<span class="input-group-text">$</span>';
                echo '<input type="number" name="prestamoN[]" class="form-control" min="0" step="0.01" required value="" oninput="nominaTotal()">';
                echo '<div class="invalid-feedback">';
                echo 'Ingrese un número válido.';
                echo '</td>';
                echo '</td>';
                echo '</td>';
                echo '<td>';
                echo '<label for="inputDescuento">Descuento</label>';
                echo '<div class="input-group has-validation">';
                echo '<span class="input-group-text">$</span>';
                echo '<input type="number" name="descuento[]" class="form-control" min="0" step="0.01" required value="" oninput="nominaTotal()">';
                echo '<div class="invalid-feedback">';
                echo 'Ingrese un número válido.';
                echo '</td>';
                echo '</td>';
                echo '</td>';
                echo '<td>';
                echo '<label for="inputConceptoNom">Concepto Descuento</label>';
                echo '<input type="text" name="conceptoN[]" class="form-control"';
                echo 'pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" required value="">';
                echo '<small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>';
                echo '<div class="invalid-feedback">';
                echo 'Ingrese un nombre válido.';
                echo '</td>';
                echo '</td>';
                echo '<td>';
                echo '<label for="inputAbono">Abono a préstamo</label>';
                echo '<div class="input-group has-validation">';
                echo '<span class="input-group-text">$</span>';
                echo '<input type="number" name="abono[]" class="form-control" min="0" step="0.01" required value="" oninput="nominaTotal()">';
                echo '<div class="invalid-feedback">';
                echo 'Ingrese un número válido.';
                echo '</td>';
                echo '</td>';
                echo '</td>';
                echo '<td>';
                echo '<label for="inputTotal">Total</label>';
                echo '<div class="input-group has-validation">';
                echo '<span class="input-group-text">$</span>';
                echo '<input type="number" name="total[]" class="form-control" min="0" step="0.01" required value="">';
                echo '<div class="invalid-feedback">';
                echo 'Ingrese un número válido.';
                echo '</td>';
                echo '</td>';
                echo '</td>';
                echo '</td>';
            }*/
}
?>