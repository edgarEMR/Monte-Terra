<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presupuesto</title>
    <link rel="stylesheet" href="css/Presupuesto.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</head>
<body>
    <div id="navigation" class="top">

    </div>

    <div class="presupuesto-form">
        <form id="nuevoPresupuesto" action="php/Proyecto_Procesos.php" class="row needs-validation" method="POST" enctype="multipart/form-data" novalidate>
            <div class="form-group col-md-4">
                <label for="nombreProyecto">Concepto</label>
                <input type="text" name="nombreProyecto" class="form-control" id="inputNombreProyecto"
                    pattern="[A-Za-z0-9À-ÿ\u00f1\u00d1 ]{3,}" required>
                <small id="nombreUHelp" class="form-text text-muted">Mínimo 3 caracteres.</small>
                <div class="invalid-feedback">
                    Ingrese un nombre válido.
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputPresupuesto">Importe</label>
                <div class="input-group">
                    <span class="input-group-text">$</span>
                    <input type="number" name="presupuesto" class="form-control" id="inputPresupuesto" min="0" required>
                    <div class="invalid-feedback">
                        Ingrese un número válido.
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="inputEtapa">Etapa</label>
                <select class="form-select" id="inputEtapa" required>
                    <option selected disabled value="">Elige...</option>
                    <option>Todas</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    </select>
                <div class="invalid-feedback">
                    Elija una opción.
                </div>
            </div>
            <div class="form-group d-grid">
                <input type="hidden" name="accion" value="agregar">
                <button class="btn btn-block btn-primary" type="submit">Agregar</button>
            </div>
        </form>
    </div>

    <h2 class="text-primary">Presupuesto</h2>
    
    <div id="tabla-desglose-semana" class="table-responsive">    

        <table id="tabla-semana" class="table table-hover table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>CONCEPTO</th>
                    <th>IMPORTE</th>
                    <th>FECHA</th>
                    <th>ETAPA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/Presupuesto.js"></script>
</body>
</html>