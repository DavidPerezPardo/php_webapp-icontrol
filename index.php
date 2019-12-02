
<?php

  require_once("/opt/lampp/htdocs/iCONTROL/clases/Sesion.php");
  require_once("/opt/lampp/htdocs/iCONTROL/clases/Login.php");

  // Instancia de Sesion
  $sesion = Sesion::getInstance();

  // Comprobación de sesión activa y redirección.
  if($sesion->checkSesionActiva()){

    // Redirección - si es usuario a vista de usuario, si es admin a vista de administrador.
    if($sesion->getEsAdmin == 0):

      $sesion->redirect("vista/mainUser.php");
    elseif($sesion->getEsAdmin == 1):

      $sesion->redirect("vista/admin/mainAdmin.php");

    endif;
     
  }


  // Comprueba si se recibe información desde el formulario
  if (!empty($_POST)):

    $email = $_POST['email'];
    $pass = $_POST['pass'];

    // Se inicia el logueo
    if($ok = $sesion->login($email , $pass)):

      if($sesion->getEsAdmin() == 0):
        $sesion->redirect("vista/mainUser.php");
  
        else:
        $sesion->redirect("vista/admin/indexAdmin.php");
        
      endif; // es admin?

    endif;// login ok?

  endif; // POST
  




?>



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="myStyle.css">
  <title>Login</title>
</head>


<body class="fondo">

  <div class="container-fluid vh-100 d-flex justify-content-center align-items-center">
    <div class="row">
      
      <div class="col">
        
        <h3 class="text-center text-white mb-2 p-2 colorNav">iCONTROL</h3>

        <form method="POST" class="border border-info bg-light p-5">
          <div class="form-group">
            <label for="inputEmail">Email</label>
            <input type="email" class="form-control" id="inputEmail" name="email" aria-describedby="emailHelp" placeholder="Usuario@iescampanillas.es" required>
          </div>

          <div class="form-group ">
            <label for="inputPass">Password</label>
            <input type="password" class="form-control" id="inputPass" name="pass" placeholder="Password" required>
          </div>

          <button type="submit" class="btn btn-info text-center w-100">Acceder</button>
        </form>

      </div>
    </div>
  </div>




  <!-- LIBRERÍAS PARA BOOTSTRAP-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>