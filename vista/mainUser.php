<?php

  require_once("/opt/lampp/htdocs/iCONTROL/clases/Sesion.php");
  require_once("/opt/lampp/htdocs/iCONTROL/libs/inserts.php");


  $sesion = Sesion::getInstance();
  // Comprobación de sesión activa y tipo de Usuario.Control de acceso a través de URL.
  if(!$sesion->checkSesionActiva()):

    $sesion->redirect("../index.php");
    die;

  // Si es admin,redirige a su vista, sino seguimos en la de usuario.
  elseif($sesion->checkSesionActiva() && $sesion->getEsAdmin() == 1):

    $sesion->redirect("mainAdmin.php");
    die;
    
  endif;



  // Obtenemos el id del usuario de la sesion.
  $codUsu = $sesion->getIdUsuario();
  // INSERT PARA REGISTRAR EL TIEMPO AL ENTRAR (Fichar).
  if(!empty($_POST['tiempoIni'])):
  
    // INSERT, SE INSERTA LA HORA DE ENTRADA
    insertEntryTime($codUsu);
    header("location:mainUser.php");
    
    elseif(!empty($_POST['tiempoFin'])):

    //  UPDATE, SE INSERTA LA HORA DE SALIDA
      insertExitTime($codUsu);
      header("location:mainUser.php");
    
  endif;


  // Método para comprobar si el usuario ya ha fichado al entrar.
  $checkEntry = Usuario::checkEntrada($codUsu);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Menu para usuario</title>
</head>
<body>

  <div class="container-fluid">

    <div class="row">

      <div class="col d-flex vh-100 justify-content-center align-items-center " style="background-color: #d6d6c2;">

        <form method="post">
        
          <div class="d-flex justify-content-center">
            
            <?php 

              // Botón para iniciar jornada o finalizarla según el caso...
              if(!$checkEntry): 
                
                echo" <button type=\"submit\" name=\"tiempoIni\" value=\"1\" class=\"btn btn-light btn-outline-info btn-lg p-4\">Iniciar Jornada</button>"; 
              else:
                echo " <button type=\"submit\" name=\"tiempoFin\" value=\"1\" class=\"btn btn-light btn-outline-info btn-lg p-4\">Finalizar jornada</button> ";           
                
              endif;

              ?>

          </div>     

            <div class = "d-flex vw-100 justify-content-center mt-5">

              <a href="perfilUser.php" type="button" class="btn btn-light btn-outline-dark btn-lg mr-4">Mi perfil</a>
              <!-- <button type="button" class="btn btn-light btn-outline-dark btn-lg mr-4">Middle</button> -->
              <a href="../libs/logOut.php" type="button" class="btn bg-danger btn-outline-light btn-lg"> Logout</a>

            </div>

        </form> 

      </div> <!-- FIN COL -->
    </div> <!-- FIN ROW -->
     

  </div>



  <!-- LIBRERÍAS PARA BOOTSTRAP-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> 
</body>
</html>