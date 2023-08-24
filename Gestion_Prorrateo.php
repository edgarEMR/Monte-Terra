<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Banco</title>
    <link rel="stylesheet" href="css/Gestion_Prorrateo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>
<body>
    <div id="navigation" class="top">

    </div>
    <?php
    ob_start();
    include_once('php/conection.php');

    
        $idProyecto = 0;
        $nombreProyecto = '';
        $accion = 'registrar';
        $conection = new DB(require 'php/config.php');

    ?>
    <div class="toast-container position-fixed top-0 start-50 translate-middle-x p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
                    <rect width="100%" height="100%" fill="#007aff"></rect>
                </svg>
                <strong class="me-auto">MonteTerra</strong>
                <small>Justo ahora</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Usuario registrado exitosamente.
            </div>
        </div>
    </div>
    <div class="register-form">
        
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="admin-tab" data-bs-toggle="tab" data-bs-target="#admin-tab-pane" type="button" role="tab" aria-controls="admin-tab-pane" aria-selected="true">Administrativo</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="intereses-tab" data-bs-toggle="tab" data-bs-target="#intereses-tab-pane" type="button" role="tab" aria-controls="intereses-tab-pane" aria-selected="false">Intereses</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="admin-tab-pane" role="tabpanel" aria-labelledby="admin-tab" tabindex="0">
            <form id="registroAdmin" action="php/Prorrateo_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                
                <ul class="list-group">
                    <?php
                        $procedure = $conection->gestionProrrateo(0, 0, 1, 'S');
                        while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {

                            echo "<li class='list-group-item'>";

                            if (is_null($rows['idProrrateo'])) {
                                echo "<input class='form-check-input me-1' type='checkbox' name='prorrateo[]' value=".$rows['idProyecto'].">";
                            } else {
                                echo "<input class='form-check-input me-1' type='checkbox' name='prorrateo[]' value=".$rows['idProyecto']." checked>";
                            }
                            
                            echo "<label class='form-check-label'>".$rows['nombre']."</label>";
                            echo "</li>";
                        }
                    ?>
                    
                </ul>
                <div class="form-group d-grid mt-3">
                    <input type="hidden" name="accion" value="<?php echo $accion;?>">
                    <input type="hidden" name="esAdmin" value="1">
                    <button class="btn btn-block btn-primary" type="submit">Agregar</button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade" id="intereses-tab-pane" role="tabpanel" aria-labelledby="intereses-tab" tabindex="0">
        <form id="registroAdmin" action="php/Prorrateo_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                
                <ul class="list-group">
                    <?php
                        $procedure = $conection->gestionProrrateo(0, 0, 0, 'S');
                        while ($rows = $procedure->fetch(PDO::FETCH_ASSOC)) {

                            echo "<li class='list-group-item'>";
                            
                            if (is_null($rows['idProrrateo'])) {
                                echo "<input class='form-check-input me-1' type='checkbox' name='prorrateo[]' value=".$rows['idProyecto'].">";
                            } else {
                                echo "<input class='form-check-input me-1' type='checkbox' name='prorrateo[]' value=".$rows['idProyecto']." checked>";
                            }
                            
                            echo "<label class='form-check-label'>".$rows['nombre']."</label>";
                            echo "</li>";
                        }
                    ?>
                    
                </ul>
                <div class="form-group d-grid mt-3">
                    <input type="hidden" name="accion" value="<?php echo $accion;?>">
                    <input type="hidden" name="esAdmin" value="0">
                    <button class="btn btn-block btn-primary" type="submit">Agregar</button>
                </div>
            </form>
        </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="js/bootstrap-select.js"></script>
    <script src="js/Gestion_Prorrateo.js"></script>
</body>
</html>