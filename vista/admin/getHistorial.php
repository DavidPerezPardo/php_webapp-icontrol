<?php

  require_once("/opt/lampp/htdocs/iCONTROL/clases/Sesion.php");
  require_once("/opt/lampp/htdocs/iCONTROL/clases/Control.php");


  $sesion = Sesion::getInstance();
  // Comprobación de sesión activa y tipo de Usuario.Control de acceso a través de URL.
  if(!$sesion->checkSesionActiva()):

    $sesion->redirect("../../index.php");
    die;

  elseif($sesion->checkSesionActiva() && $sesion->getEsAdmin() == 0):

    $sesion->redirect("../mainUser.php");

  endif;




  // Se obtiene el código de usuario seleccionado desde la consulta.
  if(!empty($_POST['historial']))  $codUsu = $_POST['historial'];

  // Se obtiene el código de usuario seleccionado desde el propio formulario de búsqueda por fechas.
  if(!empty($_POST['codUsu'])):

    $codUsu = $_POST['codUsu'];
    $usuario = Usuario::datosUser($codUsu); // Objeto Usuario - datos del usuario

    // Consulta historial del usuario
    $fechIni = $_POST['fechIni'];
    $fechFin = $_POST['fechFin'];
    $control = Control::getHistorical($fechIni, $fechFin, $codUsu);

  endif;

  require_once("/opt/lampp/htdocs/iCONTROL/vista/admin/navAdmin.php");


?>


  <? $nowDate = date("Y-m-d") // fecha actual ?>


  <!-- Formulario rango de fechas -->
  <div class="row">
  
    <div class="col-12 pt-4 pt-5">
      <h4 class="text-center pb-5"> Histórico de registros </h4>
    </div>

  </div>

  <div class="row">

    <div class="col d-flex justify-content-center">

      <form class="form-inline" method="POST">
        <div class="form-group">
          <label for="desde">Desde:</label>
          <input type="date" name="fechIni" id="desde" class="form-control mx-2" >
          <label for="hasta">Hasta:</label>
          <input type="date" name="fechFin" value= <? echo $nowDate?> class="form-control mx-2" >
          <input type="hidden" name="codUsu" value= <? echo $codUsu?> >
          <button type="submit"  class="btn-sm btn-info">Consultar</button>
        </div>
      </form>  
      
    </div> <!-- fin col formulario histórico registros -->

  </div> <!-- fin row  formulario histórico registros -->


    <!-- Información histórico de registros -->
    <div class="row mt-5">
        
      <div class="col d-flex justify-content-center pb-2">        
         <div><h5>Fecha/hora de entrada</h5></div>
      </div>
      <div class="col d-flex justify-content-center">
        <div><h5>Fecha/Hora de salida</h5></div>
      </div>
    </div>

  <?php

    if(isset($control)):

      foreach ($control as $row ):
              
  ?>

      <div class="row border-top">

        <div class="col d-flex justify-content-center ">
          <div><p> <? echo $row->getInicioCon() ?> </p> </div>
        </div>     
        <div class="col d-flex justify-content-center ">
          <div><p> <? echo $row->getFinCon() ?> </p> </div>
        </div>

      </div> <!-- Row histórico de registros -->

  <?php 
    
      endforeach;
    
    endif;
  ?>









  <!-- LIBRERÍAS PARA BOOTSTRAP-->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>   
</body>
</html>