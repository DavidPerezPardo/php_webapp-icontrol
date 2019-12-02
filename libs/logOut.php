<?php

  require_once("/opt/lampp/htdocs/iCONTROL/clases/Sesion.php");

  $sesion = Sesion::getInstance();

  // Cierre de la sesión, logout.
  $sesion->close();

  // Redirección hacia el login al cerrar la sesión.
  $sesion->redirect("../index.php");