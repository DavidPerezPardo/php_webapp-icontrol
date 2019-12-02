<?php

require_once("/opt/lampp/htdocs/iCONTROL/libs/ConexionDb.php");


class Control {

  private $codCon;
  private $inicioCon;
  private $checkEnt;
  private $finCon;

  private function __constructor(){}

  
  /**
   * Get the value of codCon
   */ 
  public function getCodCon()
  {
    return $this->codCon;
  }

  /**
   * Set the value of codCon
   *
   * @return  self
   */ 
  public function setCodCon($codCon)
  {
    $this->codCon = $codCon;

    return $this;
  }

  /**
   * Get the value of inicioCon
   */ 
  public function getInicioCon()
  {
    return $this->inicioCon;
  }

  /**
   * Set the value of inicioCon
   *
   * @return  self
   */ 
  public function setInicioCon($inicioCon)
  {
    $this->inicioCon = $inicioCon;

    return $this;
  }

  /**
   * Get the value of finCon
   */ 
  public function getFinCon()
  {
    return $this->finCon;
  }

  /**
   * Set the value of finCon
   *
   * @return  self
   */ 
  public function setFinCon($finCon)
  {
    $this->finCon = $finCon;

    return $this;
  }

  /**
   * Get the value of checkEnt
   */ 
  public function getCheckEnt()
  {
    return $this->checkEnt;
  }

  /**
   * Set the value of checkEnt
   *
   * @return  self
   */ 
  public function setCheckEnt($checkEnt)
  {
    $this->checkEnt = $checkEnt;

    return $this;
  }


  

  /** MÉTODOS DE CLASE */


    /**
     * Obtiene todo los registros especificados en la búsqueda por fechas.
     * @param string Fecha/hora de inicio
     * @param string Fecha/hora de fin
     * @param string Código de usuario - codUsu
     * @return Control Array de objetos (filas de la consulta).
     * 
     */
    public function getHistorical($fechIni, $fechFin, $codUsu){

      $db = ConexionDb::getInstance('root', '');
      $sql ="SELECT inicioCon, finCon FROM control WHERE (DATE(inicioCon) between :fechIni AND :fechFin) AND codUsu = :codUsu ORDER BY 1 DESC";
      $db->prepare($sql);
      $db->getResult()->bindValue(":fechIni", $fechIni, PDO::PARAM_STR);  
      $db->getResult()->bindValue(":fechFin", $fechFin, PDO::PARAM_STR);
      $db->getResult()->bindValue(":codUsu", $codUsu, PDO::PARAM_INT);
      $db->execute(); 

      // Devuelve todas las filas del resultado como objetos.
      return $db->fetchAll("Control");

    }


}
