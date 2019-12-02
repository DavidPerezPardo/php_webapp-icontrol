<?php


  require_once("/opt/lampp/htdocs/iCONTROL/libs/ConexionDb.php");
  require_once("/opt/lampp/htdocs/iCONTROL/clases/Sesion.php");

  /* FUNCIONES PARA REALIZAR INSERTS */


  /**
   *  1º Insert para registrar el tiempo en el que se inicia la jornada (Fichar).
   *  2º Obtiene el ultimo ID afectado al realizar el primer insert (código de control).
   *  3º Update para establecer que el usuario fichó la entrada (dentro de su jornada laboral).
   * 
   *    true = Ya ha fichado al entrar.
   *    false = Aún no comenzó la jornada.
   * 
   * @param int Código de usuario que tiene abierta la sesión.
   * 
   */
  function insertEntryTime ($codUsu){
    // Conexión con la base de datos.
    $db = ConexionDb::getInstance("root" , "");

    $sql = "INSERT INTO control (inicioCon,codUsu) VALUES (CURRENT_TIMESTAMP(), :codUsu)";
    $sql2 = "UPDATE usuario SET checkEntry = true WHERE codUsu = :codUsu";

    // Se almacena la Sentencia preparada en result.
    $db->prepare($sql);
    // Párametros de la consulta, hacemos el bindValue con la sentencia ya preparada. 
    $db->getResult()->bindValue(":codUsu", $codUsu , PDO::PARAM_INT);
    // Se ejecuta la sentencia preparada.
    $db->execute();

    
    // Ejecución de la segunda sentencia, update.
    $db->prepare($sql2);
    $db->getResult()->bindValue(":codUsu", $codUsu , PDO::PARAM_INT);
    $db->execute();

  }



  /**
   * 1º Update para registrar el tiempo en el que finaliza la jornada (Fichar).
   * 2º Update para establecer que el usuario ya fichó la salida (fuera de su jornada laboral).
   * 
   * @param int,int código de usuario, código de control.
   */
  function insertExitTime($codUsu){

    // Conexión con la base de datos.
    $db = ConexionDb::getInstance("root" , "");
    $sql = "UPDATE control SET finCon = CURRENT_TIMESTAMP() WHERE codUsu = :codUsu AND codCon = :codCon";  
    $sql2 = "UPDATE usuario SET checkEntry = false WHERE codUsu = :codUsu";
    $lastId = "SELECT MAX(codCon) FROM control WHERE codUsu = :codUsu";


    // 1º Obtiene el último código de la tabla control, el valor más alto auto_increment.
    $db->prepare($lastId);
    $db->getResult()->bindValue(":codUsu", $codUsu , PDO::PARAM_INT);
    $db->execute();
    $codCon = $db->fetchColumn(0);
    
    // 2º Update.
    $db->prepare($sql);
    $db->getResult()->bindValue(":codUsu", $codUsu , PDO::PARAM_INT);
    $db->getResult()->bindValue(":codCon", $codCon , PDO::PARAM_INT);
    $db->execute();


    // 3º Update.
    $db->prepare($sql2);
    $db->getResult()->bindValue(":codUsu", $codUsu , PDO::PARAM_INT);
    $db->execute();


  }
