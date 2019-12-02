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

// Menú admin.
require_once("/opt/lampp/htdocs/iCONTROL/vista/admin/navAdmin.php");




// Para actualizar los datos del usuario.
// Cuando se envia el formulario con los datos actualizados.
if(!empty($_POST ['refreshUpdate'])):


  //$email = $_POST['email'];
  //$getEmail = Login::checkEmail($email); para checkear si ya existe email - sin usar

    //si no existe email en la bd...
    if($updateOk = Usuario::updateUserAdmin()):

      echo "<div class=\"alert alert-info\" role=\"alert\">Usuario modificado correctamente!</div>";

    else:

     echo "<div class=\"alert alert-danger\" role=\"alert\">Se produjo un error al modificar el usuario!</div>";

    endif;


endif;




// Formulario traído desde formulario hidden - botón.
// Consulta a la bd - objeto con los datos del usuario.
if(isset($_POST['update'])):

  $codUsu = $_POST['update'];
  $usuario = Usuario::datosUser($codUsu); // Objeto Usuario - datos del usuario.
  $login = Login::getLogin($codUsu); // Para obtener login.

?>

  <!-- Formulario para actualizar datos del usuario -->
  <div class="container-fluid">

    <div class="row d-flex justify-content-center">

      <div class="col-8 pt-5 align-content-center">
        <h4 class="pb-2 mb-4 text-center border-bottom bg-light">Actualizar datos del usuario</h4>

        <form class="p-2 bg-light" method="POST">

        <div class="form-row">

            <div class="form-group col-md-6">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" value = "<? echo $login->getEmail() ?>" name="email" disabled >
            </div>

            <div class="form-group col-md-4">
              <label for="pass">Password</label>
              <input type="password" class="form-control" id="pass" value = "<? echo $login->getPass() ?>" name="pass" disabled >
            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-4">
              <label for="name">Nombre</label>
              <input type="text" class="form-control" id="name" value = "<? echo $usuario->getNomUsu() ?>" name="nombre" >
            </div>

            <div class="form-group col-md-6">
              <label for="surname">Apellidos</label>
              <input type="text" class="form-control" id="surname" value = "<? echo $usuario->getApeUsu() ?>" name="apellidos" >
            </div>

          </div>

          <div class="form-row">

            <div class="form-group col-md-3">
              <label for="tfn">Teléfono</label>
              <input type="number" class="form-control" id="tfn" value = "<? echo $usuario->getTfnUsu() ?>" name="tfn" >
            </div>

            <div class="form-group col-md-4">
              <label for="dni">DNI</label>
              <input type="text" class="form-control" id="dni" value = "<? echo $usuario->getDniUsu() ?>" name="dni" >
            </div>

          </div>

          <div class="form-row">

              <div class="form-group col-md-12">
                <label for="direccion">Dirección</label>
                <input type="text" class="form-control" id="direccion" value = "<? echo $usuario->getDirUsu() ?>" name="direccion">
              </div>

          </div>
          
          <div class="form-row">   

            <div class="form-group col-md-8">
              <label for="puesto">Puesto en la empresa</label>
              <input type="text" class="form-control" id="puesto" value = "<? echo $usuario->getPuestoUsu() ?>" name="puesto" >
            </div>

            <div class="form-group col-md-4">
              <label for="turno">Turno / Jornada</label>
              <select id="turno" class="turno"  name="turno">
                <option> <? echo $usuario->getTurnoUsu() ?></option>
                <option>Jornada completa - 08:00 a 17:30</option>
                <option>Mañana - 08:00 a 15:00</option>
                <option>Tarde - 15:00 a 22:00</option>
              </select>
            </div>

          </div>

          <div class="form-group">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="gridCheck" required >
              <label class="form-check-label" for="gridCheck">
                Confirmar cambios
              </label>
            </div>
          </div>
          <input type="hidden" value = <? echo $codUsu ?> name="codUsu" >
          <button type="submit" name="refreshUpdate" value="1" class="btn btn-outline-info">Actualizar</button>
        </form>

<? endif; ?> <!-- Muestra todo el formulario sólo antes de enviarlo a modificar -->




  <!-- LIBRERÍAS PARA BOOTSTRAP-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>   
</body>
</html>