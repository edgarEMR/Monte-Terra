<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="css/Index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa"
        crossorigin="anonymous"></script>
</head>
<body>
    <div class="contenedor d-flex justify-content-center flex-column">
        <img src="assets/mountain.png" alt="img" class="rounded-circle">    
        <h5>Bienvenido</h5>
        <form id="login" class="gy-3">    
            <div class="mb-3">
              <input type="text" class="form-control" id="inputUser" aria-describedby="userHelp" placeholder="Usuario">
            </div>
            <div class="mb-3">
              <input type="password" class="form-control" id="inputPassword" placeholder="Contraseña">
            </div>
            <div class="d-grid">
                <button id="entrar" type="button" class="btn btn-primary btn-block btn-lg">Entrar</button>
            </div>
          </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/index.js"></script>
</body>
</html>