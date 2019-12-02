<!--

  Menú para la vista del usuario - perfilUser.php

-->


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Menú Usuario</title>
</head>
<body>
  <!-- MENU -->
  <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
  <a class="navbar-brand pl-3" href="mainUser.php">iCONTROL</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item pl-3">
        <a class="nav-link active" href="#">Mi Perfil </a>
      </li>
      <li class="nav-item pl-3">
        <a class="nav-link" href="../libs/logOut.php"> Cerrar sesión</a>
      </li>
    </ul>
    <span class="navbar-text pr-3">
      Bienvenido: <?php echo $sesion->getNombre() ." " .$sesion->getApellidos(); ?>
    </span>
  </div>
</nav>