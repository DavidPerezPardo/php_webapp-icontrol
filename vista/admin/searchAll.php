<?php

  require_once("/opt/lampp/htdocs/iCONTROL/clases/Sesion.php");
  require_once("/opt/lampp/htdocs/iCONTROL/clases/Usuario.php");


  $sesion = Sesion::getInstance();
  // Comprobación de sesión activa y tipo de Usuario.Control de acceso a través de URL.
  if(!$sesion->checkSesionActiva()):

    $sesion->redirect("../../index.php");
    die;

  elseif($sesion->checkSesionActiva() && $sesion->getEsAdmin() == 0):

    $sesion->redirect("../mainUser.php");

  endif;


  require_once("/opt/lampp/htdocs/iCONTROL/vista/admin/navAdmin.php");


?>


<div class="container-fluid">

  <div class="row">
    
    <div class="col pt-4">
          <!-- inicio tabla -->
          <table class="table table-sm text-center">
            <thead>
              <tr>
                <th scope="col">Nombre</th>
                <th scope="col">Apellidos</th>
                <th scope="col">Tfn</th>
                <th scope="col">DNI</th>
                <th scope="col">Dirección</th>
                <th scope="col">Puesto</th>
                <th scope="col">Turno</th>
                <th scope="col">Alta</th>

              </tr>
            </thead>
            <tbody>

          <!-- Tabla con todos los datos del usuario -->
          <?php
                    
                    $usuario = Usuario::searchAllUsers("all"); // Objeto Usuario - datos del usuario

                    foreach ($usuario as $row => $col):
                      
                      echo "<tr> <td>" . $col->getNomUsu() . "</td>";
                      echo "<td>" . $col->getApeUsu() . "</td>";
                      echo "<td>" . $col->getTfnUsu() . "</td>";
                      echo "<td>" . $col->getDniUsu() . "</td>";
                      echo "<td>" . $col->getDirUsu() . "</td>";
                      echo "<td>" . $col->getPuestoUsu() . "</td>";
                      echo "<td>" . $col->getTurnoUsu() . "</td>";
                      echo "<td>" . $col->getAltaUsu() . "</td>";
                      
          ?>
                      <td>                     
                        <!-- Formularios hidden para acciones de los botones -->
                        <form class="d-inline" action="updateUser.php" method="POST">
                          <input type="hidden" name="update" value = <? echo $col->getCodUsu() ?>>
                          <button type="submit" class="btn btn-sm btn-light"><i class="fas fa-user-edit"></i></button>
                        </form>
                      </td>
                      <td>
                        <form class="d-inline" action="getHistorial.php" method="POST">
                          <input type="hidden" name="historial" value = <? echo $col->getCodUsu() ?>>
                          <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-user-clock"></i></button>                      
                        </form>
                      </td>
                      <td>
                        <form class="d-inline"action="deleteLogin.php" method="POST" onsubmit="return confirm('¿Estás seguro/a de querer eliminar al usuario seleccionado?');">
                          <input type="hidden" name="delete" value = <? echo $col->getCodUsu() ?>>
                          <button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-user-times"></i></button>                      
                        </form>

                      </td>
    
                    </tr>


                    <?php endforeach ?>
        
          
            </tbody>
          </table>
        
        </div> <!-- fin col general -->     
    </div><!-- fin row general -->
</div><!-- fin container -->




            
       <!-- <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">
        
          <form>
            <div class="form-row mt-4">
              <div class="col-lg-2 col-md-3 col-sm-4">
                <input type="text" class="form-control" placeholder="Nombre">
              </div>
              <div class="col-lg-2 col-md-3 col-sm-4">
                <input type="text" class="form-control" placeholder="Apellidos">
              </div>
              <div class="col-1">
              <input type="button" class="btn btn-outline-primary" value="Consultar"> 
              </div>
                
            </div>
          </form>-->



  <!-- LIBRERÍAS PARA BOOTSTRAP-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>   
</body>
</html>

  