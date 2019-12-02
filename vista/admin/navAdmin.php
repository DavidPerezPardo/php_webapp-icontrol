<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" rel="stylesheet" crossorigin="anonymous">
  <title>Menú administrador</title>
</head>

<body>

  
  <nav class="navbar navbar-expand-xl navbar-light "style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="indexAdmin.php">iCONTROL</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="indexAdmin.php">Home </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="registro.php">Alta usuario</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Consultas
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="searchAll.php">Mostrar Usuarios</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../libs/logOut.php">Cerrar sesión</a>
        </li>
      </ul>
      <form class="form-inline my-2 my-lg-0" method="POST" action="indexAdmin.php">
        <span class="mr-2">Consulta rápida</span>
        <input class="form-control mr-sm-2 col-3" type="search" name="nombre" placeholder="Nombre" aria-label="Nombre">
        <input class="form-control mr-sm-2 col-4" type="search" name="apellidos" placeholder="Apellidos" aria-label="Apellidos">
        <button class="btn btn-outline-info btn-xs my-2 my-sm-0" name="consulta" value="1" type="submit">Consultar</button>
      </form>
    </div>
  </nav>