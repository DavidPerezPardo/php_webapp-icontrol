

<?php


  require_once("/opt/lampp/htdocs/iCONTROL/clases/Sesion.php");
  require_once("/opt/lampp/htdocs/iCONTROL/clases/Usuario.php");
  require_once("/opt/lampp/htdocs/iCONTROL/clases/Control.php");


  // Obtengo id del usuario de la sesión.
  $sesion = Sesion::getInstance();
  $codUsu = $sesion->getIdUsuario();


  // Comprobación de sesión activa y tipo de Usuario.Control de acceso a través de URL.
  if(!$sesion->checkSesionActiva()):

    $sesion->redirect("../index.php");
    die;

  // Si es admin,redirige a su vista, sino seguimos en la de usuario.
  elseif($sesion->checkSesionActiva() && $sesion->getEsAdmin()):

    $sesion->redirect("vista/mainAdmin.php");
    die;

  endif;




  // Datos formulario info. personal.
  if(!empty($_POST['update'])):

    // Update datos del usuario
    $tfn = $_POST['tfn'];
    $direccion = $_POST['direccion'];
    Usuario::updateUser($tfn, $direccion, $codUsu);
    header("location:perfilUser.php");

  endif;

  // Datos formulario histórico registros.
  if((!empty($_POST['fechFin']))):
    // Update datos del usuario
    $fechIni = $_POST['fechIni'];
    $fechFin = $_POST['fechFin'];
    $control = Control::getHistorical($fechIni, $fechFin, $codUsu);
    $getHistorical = true;

  endif;


  require_once("/opt/lampp/htdocs/iCONTROL/vista/navUser.php");
  $usuario = Usuario::datosUser($codUsu); // Objeto Usuario - datos del usuario

?>
  

  <div class="container-fluid">
    
    <div class="row">
      
      <div class="col-lg-6 pt-5 ">
    
        <div><h4 class="text-center pb-5"> Información personal </h4></div>

        <div class="row">
          <div class="col-sm-12">
            <p><span class="font-weight-bold"> Nombre:</span> <?echo $usuario->getNomUsu() ?> </p>
            <p><span class="font-weight-bold"> Apellidos:</span> <?echo $usuario->getApeUsu() ?> </p>
          </div>
        </div>

        <div class="row">
          <div class="col">
          <p><span class="font-weight-bold"> DNI: </span> <?echo $usuario->getDniUsu() ?> </P>
          </div>
        </div>


        <!-- formulario tfn y direccion -->
        <div class="row">
          <div class="col">

          <form class="form-inline" method="POST" id="info">
            <div class="form-group my-2 w-100">
              <label class="font-weight-bold" for="tfn">Teléfono:</label>
              <input type="number" name="tfn" value="<?echo $usuario->getTfnUsu() ?>" id="tfn" class="form-control ml-sm-2 col-xs-12 col-sm-3" required>
            </div>

            <div class="form-group my-2 w-100">
              <label class="font-weight-bold" for="direccion">Dirección:</label>
              <input type="text"  name="direccion" value="<?echo $usuario->getDirUsu() ?>" id="direccion" class="form-control ml-sm-2 col-sm-10">
            </div>

          </form>

          </div>
        </div>

        <div class="row">
          <div class="col">
          <p><span class="font-weight-bold"> Puesto: </span><?echo $usuario->getPuestoUsu() ?> </P>
          </div>
        </div>

        <div class="row">
          <div class="col">
          <p><span class="font-weight-bold"> Turno: </span><?echo $usuario->getTurnoUsu() ?> </P>
          </div>
        </div>

        <div class="row">
          <div class="col">
          <p><span class="font-weight-bold"> Alta en empresa: </span><?echo $usuario->getAltaUsu() ?> </P>
          </div>
        </div>

        <!-- submit para formulario de información personal -->
        <div class="col d-flex justify-content-center pt-4">
          <button type="submit" name="update" form="info" value="1" class="btn-sm btn-dark">Guardar cambios</button>
        </div>


      </div> <!-- fin col info-->



      
      <? $nowDate = date("Y-m-d") // fecha actual ?>


      <!-- col histórico de registros -->
      <div class="col-lg-6 pt-4 pt-5 bg-light border-left ">

        <div><h4 class="text-center pb-5"> Histórico de registros </h4></div>

        <!-- Formulario rango de fechas -->
        <div class="row">
          
          <div class="col d-flex justify-content-center">

            <form class="form-inline" method="POST" id="dates">
              <div class="form-group">
                <label for="desde">Desde:</label>
                <input type="date" name="fechIni" id="desde" class="form-control mx-2" >
                <label for="hasta">Hasta:</label>
                <input type="date" name="fechFin" value= <? echo $nowDate?> id="hasta" class="form-control mx-2" >
                <button type="submit" form="dates" class="btn-sm btn-info">Consultar</button>
              </div>
            </form>  
            
          </div> <!-- fin col formulario histórico registros -->

      </div> <!-- fin row  histórico registros -->



      <!-- Información histórico de registros -->
      <div class="row mt-5">
        
        <div class="col d-flex justify-content-center">        
          <div><p>Fecha/hora de entrada</p></div>
        </div>
        <div class="col d-flex justify-content-center">
          <div><p>Fecha/Hora de salida</p></div>
        </div>
      </div>


  <?php

    if(isset($control)):

      foreach ($control as $row ):
              
  ?>

      <div class="row border-top">

        <div class="col d-flex justify-content-center ">
          <div><p> <? if( isset($getHistorical)) echo $row->getInicioCon() ?> </p> </div>
        </div>     
        <div class="col d-flex justify-content-center ">
          <div><p> <? if( isset($getHistorical)) echo $row->getFinCon() ?> </p> </div>
        </div>

      </div> <!-- Row histórico de registros -->

  <?php 
    
      endforeach;
    
    endif;
  ?>




    </div> <!-- fin row -->

  </div><!-- fin container -->


  <!-- LIBRERÍAS PARA BOOTSTRAP-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>   
</body>
</html>