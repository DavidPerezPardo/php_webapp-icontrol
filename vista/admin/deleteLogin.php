<?php

  // Para eliminar el login de un usuario.

  require_once("/opt/lampp/htdocs/iCONTROL/clases/Usuario.php");


$codUsu = $_POST['delete'];
if(Usuario::deleteLogin($codUsu)):

  header("Location: indexAdmin.php");

else:

  die("No se pudo eliminar al usuario,hubo un error");
  
endif;




?>