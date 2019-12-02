<?php

  require_once("/opt/lampp/htdocs/iCONTROL/clases/Sesion.php");
  require_once("/opt/lampp/htdocs/iCONTROL/clases/Login.php");



  $sesion = Sesion::getInstance();
  // Comprobación de sesión activa y tipo de Usuario.Control de acceso a través de URL.
  if(!$sesion->checkSesionActiva()):

    $sesion->redirect("../../index.php");
    die;

  elseif($sesion->checkSesionActiva() && $sesion->getEsAdmin() == 0):

    $sesion->redirect("../mainUser.php");

  endif;



  if(!empty($_POST)){

    $pass = $_POST['pass'];
    $email = $_POST['email'];
    $getEmail = Login::checkEmail($email);

      //si no existe email en la bd...
      if(!$getEmail):

        // Insert nuevo usuario
        Usuario::altaUser();

      else:

          echo"<div class=\"alert alert-danger\" role=\"alert\">El email Introducido ya existe en la base de datos, Pruebe con otro!</div>";

      endif;
  }





  require_once("/opt/lampp/htdocs/iCONTROL/vista/admin/navAdmin.php");


?>

  <div class="container-fluid">

    <div class="row d-flex justify-content-center">

      <div class="col-8 pt-5 align-content-center">
        <h4 class="pb-2 mb-4 text-center border-bottom bg-light">Registro de nuevo usuario</h4>

        <form class="p-2 bg-light" method="POST">

        <div class="form-row">

            <div class="form-group col-md-6">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" placeholder="usuario@gmail..." name="email" required >
            </div>

            <div class="form-group col-md-4">
              <label for="pass">Password</label>
              <input type="password" class="form-control" id="pass" name="pass" required>
            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-4">
              <label for="name">Nombre</label>
              <input type="text" class="form-control" id="name" name="nombre" required>
            </div>

            <div class="form-group col-md-6">
              <label for="surname">Apellidos</label>
              <input type="text" class="form-control" id="surname" name="apellidos" required>
            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-3">
              <label for="tfn">Teléfono</label>
              <input type="number" class="form-control" id="tfn" name="tfn" required>
            </div>

            <div class="form-group col-md-4">
              <label for="dni">DNI</label>
              <input type="text" class="form-control" id="dni" placeholder="" name="dni" required>
            </div>

          </div>

          <div class="form-row">

              <div class="form-group col-md-12">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" name="direccion">
              </div>

          </div>
          
          <div class="form-row">   

            <div class="form-group col-md-8">
              <label for="puesto">Puesto en la empresa</label>
              <input type="text" class="form-control" id="puesto" name="puesto" required>
            </div>

            <div class="form-group col-md-4">
              <label for="turno">Turno / Jornada</label>
              <select id="turno" class="turno"  name="turno" required>
                <option value="">Seleccione un turno</option>
                <option>Jornada completa - 08:00 a 17:30</option>
                <option>Mañana - 08:00 a 15:00</option>
                <option>Tarde - 15:00 a 22:00</option>
              </select>
            </div>

          </div>

          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="gridCheck" required>
              <label class="form-check-label" for="gridCheck">
                Confirmación
              </label>
            </div>
          </div>

          <button type="submit" class="btn btn-outline-info">Registrar</button>
        </form>






      </div> <!-- fin col general -->     
    </div><!-- fin row general -->
</div><!-- fin container -->




  <!-- LIBRERÍAS PARA BOOTSTRAP-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>   
</body>
</html>