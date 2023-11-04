<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto</title>
    <link rel="stylesheet" href="css/Nueva_Etapa.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>

<body>
    <div id="navigation" class="top">

    </div>
    <?php
    ob_start();
    session_start();
    include_once('modelos/Proyecto.php');
    include_once('php/conection.php');

        $idProyecto = 0;
        $nombreProyecto = '';
        $accion = 'registrar';
        $proyecto = new Proyecto(require 'php/config.php');
        $conection = new DB(require 'php/config.php');

        if (isset($_GET['id']) && !is_null($_GET['id'])) {
            $idProyecto = $_GET['id'];
            $proc = $conection->gestionProyecto($idProyecto, '', 0, 0, 0, 0, 0, 'S');
            $row = $proc->fetch(PDO::FETCH_ASSOC);

            $proyecto->setIdProyecto($idProyecto);
            $proyecto->setNombre($row['nombre']);
            $proyecto->setTotalCasas($row['totalCasas']);
            $proyecto->setTotalEtapas($row['totalEtapas']);
            $proyecto->setPrototipos($row['prototipos']);
            $proyecto->setManzanas($row['manzanas']);
            $proyecto->setMetrosBase($row['metrosBase']);

            //$proc = $conection->gestionEtapa(0, 0, 0, $idProyecto, 'S');

            //$accion = 'editar';
        }

    ?>
    <div class="proyect-info d-flex justify-content-evenly">
        <label><strong>Proyecto: </strong><?php echo $proyecto->getNombre();?></label>
        <label><strong>Total de Etapas: </strong><?php echo $proyecto->getTotalEtapas();?></label>
        <label><strong>Total de Casas: </strong><?php echo $proyecto->getTotalCasas();?></label>
    </div>
    <div class="register-form">
        <form id="registroProyecto" action="php/Etapa_Procesos.php" class="row needs-validation" method="POST"
            enctype="multipart/form-data" novalidate>
            <div class="form-group col-md-3">
                <label for="inputEtapa">Etapa</label>
                <select class="form-control selectpicker" data-live-search="true" title="Elige..." name="numeroEtapa"
                    id="inputEtapa" required>
                    <?php
                        for ($i=1; $i <= $proyecto->getTotalEtapas(); $i++) { 
                            echo "<option value=".$i.">Etapa ".$i."</option>";
                        }
                    ?>
                </select>
                <div class="invalid-feedback">
                    Elija una opción.
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="inputTotalCasas">Total de Casas</label>
                <input type="number" name="totalCasas" class="form-control" id="inputTotalCasas" min="1"
                    max="<?php echo $proyecto->getTotalCasas();?>" value="1" value="<?php ?>" required>
                <div class="invalid-feedback">
                    Ingrese un número válido.
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="inputExcedente">Precio M2 Excedente</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">$</span>
                    <input type="number" name="importeExcedente" class="form-control" id="inputExcedente" min="0"
                        step="0.01" required value="<?php ?>">
                    <div class="invalid-feedback">
                        Ingrese un número válido.
                    </div>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label for="inputMinimo">Total Minimo de Etapa</label>
                <div class="input-group has-validation">
                    <span class="input-group-text">$</span>
                    <input type="number" name="minimoEtapa" class="form-control" id="inputMinimo" min="0" step="0.01"
                        required value="<?php ?>">
                    <div class="invalid-feedback">
                        Ingrese un número válido.
                    </div>
                </div>
            </div>
            <div class="form-group d-grid col-md-3 offset-md-9">
                <input type="hidden" name="proyectoID" id="proyectoID" value="<?php echo $idProyecto;?>">
                <input type="hidden" name="accion" value="<?php echo $accion;?>">
                <button class="btn btn-block btn-primary" type="submit">Agregar</button>
            </div>
        </form>
    </div>
    <div id="botones-etapa" class="accordion">
        <?php
        $proc = $conection->gestionEtapa(0, 0, 0, 0, 0, $idProyecto, 'S');
        while ($row = $proc->fetch(PDO::FETCH_ASSOC)) {
            echo "<div class='accordion-item'>";
            echo "<h2 class='accordion-header' id='headingOne'>";
            echo "<button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapseEtapa".$row['numeroEtapa']."' aria-expanded='true' aria-controls='collapseOne'>";
            echo "Etapa " . $row['numeroEtapa'];
            echo "</button>";
            echo "</h2>";
            echo "<div id='collapseEtapa".$row['numeroEtapa']."' class='accordion-collapse collapse' aria-labelledby='headingOne' data-bs-parent='#accordionExample'>";
            echo "<div class='accordion-body'>";
            echo "<div class='etapa-info d-flex justify-content-evenly'>";
            echo "<label><strong>Total de Casas: </strong>".$row['cantidadCasas']."</label>";
            echo "<label><strong>Precio M2 Excedente: </strong>$".number_format($row['precioExcedente'], 2)."</label>";
            echo "<label><strong>Mínimo de Venta: </strong>$".number_format($row['totalMinimo'], 2)."</label>";
            echo "</div>";
            echo "<button class='btn btn-primary my-1 showCalleModal' etapa=".$row['idEtapa']." type='button' data-bs-toggle='modal' data-bs-target='#modalCalle'>";
            echo "Agregar Calle";
            echo "</button><br>";
                $proc2 = $conection->gestionCalle(0, '', 0, $row['idEtapa'], 'S');
                while ($row2 = $proc2->fetch(PDO::FETCH_ASSOC)) {
                    echo "<div class='accordion-item'>";
                    echo "<h2 class='accordion-header' id='headingOne'>";
                    echo "<button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapseCalle".$row2['idCalle']."' aria-expanded='true' aria-controls='collapseOne'>";
                    echo $row2['nombre'];
                    echo "</button>";
                    echo "</h2>";
                    echo "<div id='collapseCalle".$row2['idCalle']."' class='accordion-collapse collapse' aria-labelledby='headingOne' data-bs-parent='#accordionExample'>";
                    echo "<div class='accordion-body'>";
                    echo "<table class='table table-hover table-sm'>";
                    echo "<thead>";
                    echo "<tr>";
                    echo "<th scope='col'>Lote</th>";
                    echo "<th scope='col'>Prototipo</th>";
                    echo "<th scope='col'>Manzana</th>";
                    echo "<th scope='col'>Precio Base</th>";
                    echo "<th scope='col'>Metros Excedentes</th>";
                    echo "<th scope='col'>Precio Excedente</th>";
                    echo "<th scope='col'>Subtotal</th>";
                    echo "<th scope='col'>Parque</th>";
                    echo "<th scope='col'>Esquina</th>";
                    echo "<th scope='col'>Total</th>";
                    echo "<th scope='col'>Autorizado</th>";
                    echo "<th></th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                        $proc3 = $conection->gestionLote(0, '', 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, $row2['idCalle'], 0, 0, 'S');
                        while ($row3 = $proc3->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>".$row3['numeroLote']."</td>";
                            echo "<td>".$row3['nombrePrototipo']."</td>";
                            echo "<td>".$row3['manzana']."</td>";
                            echo "<td>$".number_format($row3['precioLista'], 2)."</td>";
                            echo "<td>".$row3['metrosExcedentes']."</td>";
                            echo "<td>$".number_format($row3['precioExcedente'], 2)."</td>";
                            echo "<td>$".number_format($row3['subtotal'], 2)."</td>";
                            echo "<td>".$row3['esParque']."</td>";
                            echo "<td>".$row3['esEsquina']."</td>";
                            echo "<td>$".number_format($row3['precioFinal'], 2)."</td>";
                            echo "<td>".$row3['autorizado']."</td>";
                            echo "<td><button class='btn btn-primary btn-sm showLoteModal' loteID=".$row3['idLote']." type='button' data-bs-toggle='modal' data-bs-target='#modalLote'>Editar</button></td>";
                            echo "</tr>";
                        }
                    echo "</tbody>";
                    echo "</table>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    ?>
    </div>
    <!-- Form Modal Calle-->
    <div class="modal fade" id="modalCalle" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="exampleModalLongTitle">Agregar calle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registroCalle" action="php/Calle_Procesos.php" class="row needs-validation" method="POST"
                        enctype="multipart/form-data" novalidate>
                        <div class="form-group col-md-6">
                            <label for="inputNombreCalle">Nombre</label>
                            <input type="text" name="nombreCalle" class="form-control" id="inputNombreCalle"
                                pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" required>
                            <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                            <div class="invalid-feedback">
                                Ingrese un nombre válido.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputTotalLotes">Total de Lotes</label>
                            <input type="number" name="totalLotes" class="form-control" id="inputTotalLotes" min="1"
                                max="" value="1" value="<?php ?>" required>
                            <div class="invalid-feedback">
                                Ingrese un número válido.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="InputPrototipo">Prototipo</label>
                            <select class="form-control selectpicker" data-live-search="true" title="Elige..."
                                name="prototipo" id="InputPrototipo" required>
                                <?php
                                $procProto = $conection->gestionPrototipo(0, '', 0, $idProyecto, 'S');
                                while ($rowProto = $procProto->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=".$rowProto['idPrototipo'].">".$rowProto['nombre']." - ".$rowProto['metros']."</option>";
                                }
                            ?>
                            </select>
                            <div class="invalid-feedback">
                                Elija una opción.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPrecioLista">Precio Base</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">$</span>
                                <input type="number" name="precioLista" class="form-control" id="inputPrecioLista"
                                    min="0" step="0.01" required>
                                <div class="invalid-feedback">
                                    Ingrese un número válido.
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-grid mt-1">
                            <input type="hidden" name="proyectoID" id="proyectoID" value="<?php echo $idProyecto;?>">
                            <input type="hidden" name="etapaID" id="etapaID">
                            <input type="hidden" name="accion" value="<?php echo $accion;?>">
                            <button class="btn btn-block btn-primary" type="submit">Agregar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Form Modal Lote-->
    <div class="modal fade" id="modalLote" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-primary" id="modalLoteTitle">Modificar Lote</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registroLote" action="php/Lote_Procesos.php" class="row needs-validation" method="POST"
                        enctype="multipart/form-data" novalidate>
                        <div class="form-group col-md-6">
                            <label for="inputSubtotal">Subtotal</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">$</span>
                                <input type="number" name="subtotal" class="form-control" id="inputSubtotal" min="0"
                                    step="0.01" required readonly>
                                <div class="invalid-feedback">
                                    Ingrese un número válido.
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPrecioFinal">Total</label>
                            <div class="input-group has-validation">
                                <span class="input-group-text">$</span>
                                <input type="number" name="precioFinal" class="form-control" id="inputPrecioFinal"
                                    min="0" step="0.01" required readonly>
                                <div class="invalid-feedback">
                                    Ingrese un número válido.
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPrototipoLote">Prototipo</label>
                            <select class="form-control selectpicker" data-live-search="true" title="Elige..."
                                name="prototipo" id="inputPrototipoLote" required>
                                <?php
                                $procProto = $conection->gestionPrototipo(0, '', 0, $idProyecto, 'S');
                                while ($rowProto = $procProto->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=".$rowProto['idPrototipo'].">".$rowProto['nombre']." - ".$rowProto['metros']."</option>";
                                }
                            ?>
                            </select>
                            <div class="invalid-feedback">
                                Elija una opción.
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputManzana">Manzana</label>
                            <select class="form-control selectpicker" data-live-search="true" title="Elige..."
                                name="manzana" id="inputManzana" required>
                                <?php
                                $procProto = $conection->gestionManzana(0, '', 0, $idProyecto, 0, 'S');
                                while ($rowProto = $procProto->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value=".$rowProto['idManzana'].">Manzana - ".$rowProto['numero']."</option>";
                                }
                            ?>
                            </select>
                            <div class="invalid-feedback">
                                Elija una opción.
                            </div>
                        </div>
                        <div class="form-group col-md-4 mt-4">
                            <input class="form-check-input" type="checkbox" name="parque" value="1" id="inputParque">
                            <label class="form-check-label" for="inputParque">
                                Parque
                            </label>
                        </div>
                        <div class="form-group col-md-4 mt-4">
                            <input class="form-check-input" type="checkbox" name="esquina" value="1" id="inputEsquina">
                            <label class="form-check-label" for="inputEsquina">
                                Esquina
                            </label>
                        </div>
                        <div class="form-group col-md-4 mt-4">
                            <input class="form-check-input" type="checkbox" name="autorizado" value="1"
                                id="inputAutorizado">
                            <label class="form-check-label" for="inputAutorizado">
                                Autorizado
                            </label>
                        </div>
                        <div class="form-group d-grid mt-4">
                            <input type="hidden" name="proyectoID" id="proyectoID" value="<?php echo $idProyecto;?>">
                            <input type="hidden" name="loteID" id="loteID">
                            <input type="hidden" name="accion" value="editar">
                            <button class="btn btn-block btn-primary" type="submit">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="liveAlert" class="alert alert-dismissible fade show position-fixed fixed-bottom mx-auto" role="alert">
        <p class="alert-body mb-0"></p>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/Nueva_Etapa.js"></script>
</body>

</html>