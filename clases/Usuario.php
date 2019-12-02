<?php


  /**
   * Autor: David Pérez Pardo
   * Proyecto: iCONTROL - Desarrollo Web en Entorno Servidor
   * Curso 2019/2020
   * Clase Usuario
   *  
   */

  require_once("/opt/lampp/htdocs/iCONTROL/libs/ConexionDb.php");


  class Usuario {

    private $codUsu;
    private $checkEntry;
    private $nomUsu;
    private $apeUsu;
    private $tfnUsu;
    private $altaUsu;
    private $puestoUsu;
    private $turnoUsu;
    private $dniUsu;
    private $dirUsu;

    public function __construct(){}

    
    

    /**
     * Get the value of codUsu
     */ 
    public function getCodUsu()
    {
        return $this->codUsu;
    }

    /**
     * Set the value of codUSu
     *
     * @return  self
     */ 
    public function setCodUSu($codUsu)
    {
        $this->codUsu = $codUsu;

        return $this;
    }

    /**
     * Get the value of nomUsu
     */ 
    public function getNomUsu()
    {
        return $this->nomUsu;
    }

    /**
     * Set the value of nomUsu
     *
     * @return  self
     */ 
    public function setNomUsu($nomUsu)
    {
        $this->nomUsu = $nomUsu;

        return $this;
    }

    /**
     * Get the value of apeUsu
     */ 
    public function getApeUsu()
    {
        return $this->apeUsu;
    }

    /**
     * Set the value of apeUsu
     *
     * @return  self
     */ 
    public function setApeUsu($apeUsu)
    {
        $this->apeUsu = $apeUsu;

        return $this;
    }

    /**
     * Get the value of tfnUsu
     */ 
    public function getTfnUsu()
    {
        return $this->tfnUsu;
    }

    /**
     * Set the value of tfnUsu
     *
     * @return  self
     */ 
    public function setTfnUsu($tfnUsu)
    {
        $this->tfnUsu = $tfnUsu;

        return $this;
    }

    /**
     * Get the value of altaUsu
     */ 
    public function getAltaUsu()
    {
        return $this->altaUsu;
    }

    /**
     * Set the value of altaUsu
     *
     * @return  self
     */ 
    public function setAltaUsu($altaUsu)
    {
        $this->altaUsu = $altaUsu;

        return $this;
    }

    /**
     * Get the value of puestoUsu
     */ 
    public function getPuestoUsu()
    {
        return $this->puestoUsu;
    }

    /**
     * Set the value of puestoUsu
     *
     * @return  self
     */ 
    public function setPuestoUsu($puestoUsu)
    {
        $this->puestoUsu = $puestoUsu;

        return $this;
    }

    /**
     * Get the value of turnoUsu
     */ 
    public function getTurnoUsu()
    {
        return $this->turnoUsu;
    }

    /**
     * Set the value of turnoUsu
     *
     * @return  self
     */ 
    public function setTurnoUsu($turnoUsu)
    {
        $this->turnoUsu = $turnoUsu;

        return $this;
    }

    /**
     * Get the value of dniUsu
     */ 
    public function getDniUsu()
    {
        return $this->dniUsu;
    }

    /**
     * Set the value of dniUsu
     *
     * @return  self
     */ 
    public function setDniUsu($dniUsu)
    {
        $this->dniUsu = $dniUsu;

        return $this;
    }

    /**
     * Get the value of dirUsu
     */ 
    public function getDirUsu()
    {
        return $this->dirUsu;
    }

    /**
     * Set the value of dirUsu
     *
     * @return  self
     */ 
    public function setDirUsu($dirUsu)
    {
        $this->dirUsu = $dirUsu;

        return $this;
    }

        /**
     * Get the value of checkEntry
     */ 
    public function getCheckEntry()
    {
        return $this->checkEntry;
    }




    /* MÉTODOS DE LA CLASE */


    /**
     * Método para consultar si el usuario ya ha registrado la hora de "entrada".
     * Devolverá True si ya ha "fichado al entrar" o false (sin resultado) en caso de NO haber fichado.
     * @param int id del usuario traído desde la sesion.
     * @return boolean 
     * 
    */
    public function checkEntrada($id){

        $db = ConexionDb::getInstance('root', '');
        $consulta = "SELECT checkEntry FROM usuario WHERE codUsu = $id  AND checkEntry = true";
        $result = $db->query($consulta);
        
        return $result;

    }




    /**
     * Consulta tabla usuario.
     * Obtiene todos los datos del usuario - tabla usuario.
     * @param int código de usuario - sesión.
     * @return object Objeto Usuario con todos sus datos.
     */
    public function datosUser($codUsu){

        $db = ConexionDb::getInstance('root', '');
        $sql = "SELECT * FROM usuario WHERE codUsu = :codUsu";
        $db->prepare($sql);
        $db->getResult()->bindValue(":codUsu", $codUsu , PDO::PARAM_INT);
        $db->execute();
        return $db->getObject("Usuario");

    }
    



    /**
     * Consulta tabla usuario.
     * Obtiene todos los datos del usuario - tabla usuario.
     * @param array nombre y apellidos o all para todos. - en función de la búsqueda seleccionada.
     * @return object Objeto Usuario con todos sus datos.
     */
    public function searchAllUsers($search){

        $db = ConexionDb::getInstance('root', '');

        if($search == "all"):
         
          $sql = "SELECT * FROM usuario WHERE baja = false;";
          $db->query($sql);
          return $db->fetchAll("Usuario");
       
        else:           
          
          $sql = "SELECT * FROM usuario WHERE nomUsu LIKE  :nombre '%' AND apeUsu LIKE :apellidos '%' AND baja = false;";  
          
          $db->prepare($sql);
          $db->getResult()->bindValue(":nombre", $search[0], PDO::PARAM_STR);
          $db->getResult()->bindValue(":apellidos", $search[1], PDO::PARAM_STR);  
          $db->execute();

          return $db->fetchAll("Usuario");

        endif;
    }




    /**
     * Actualiza en la bd los campos tfnUsu y durUsu del usuario ( tfn y dirección).
     * @param string
     * @param string
     * @param int
     */
    public function updateUser($tfn, $dir, $codUsu){

        $db = ConexionDb::getInstance('root', '');
        $sql = "UPDATE usuario SET tfnUsu = :tfn, dirUsu = :dir WHERE codUsu = :codUsu;";
        $db->prepare($sql);
        $db->getResult()->bindValue(":tfn", $tfn , PDO::PARAM_STR);  
        $db->getResult()->bindValue(":dir", $dir , PDO::PARAM_STR);
        $db->getResult()->bindValue(":codUsu", $codUsu , PDO::PARAM_INT);
        $db->execute();  
     

    }



    /**
     * Registro de nuevo usuario.
     */ 
    public function altaUser(){

        $email = $_POST['email'];
        $pass = $_POST['pass'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $tfn = $_POST['tfn'];
        $dni = $_POST['dni'];
        $direccion = $_POST['direccion']; 
        $puesto = $_POST['puesto'];
        $turno = $_POST['turno'];

        
        $db = ConexionDb::getInstance('root', '');
        $sql = "INSERT INTO usuario (nomUsu, apeUsu, tfnUsu, puestoUsu, turnoUsu, altaUsu, dniUsu, dirUsu)";
        $sql .= " VALUES (:nom, :ape, :tfn, :puesto, :turno, CURRENT_TIMESTAMP(), :dni, :dir)";
        $lastId = "SELECT MAX(codUsu) FROM usuario";
        $sql2 = "INSERT INTO login (email, pass, codUsu) VALUES (:email , MD5(:pass), :codUsu); ";

        // 1. Inserta los datos del nuevo usuario - Registro.
        $db->prepare($sql);
        $db->getResult()->bindValue(":nom", $nombre , PDO::PARAM_STR);  
        $db->getResult()->bindValue(":ape", $apellidos , PDO::PARAM_STR);
        $db->getResult()->bindValue(":tfn", $tfn , PDO::PARAM_STR);  
        $db->getResult()->bindValue(":puesto", $puesto , PDO::PARAM_STR);
        $db->getResult()->bindValue(":turno", $turno , PDO::PARAM_STR);  
        $db->getResult()->bindValue(":dni", $dni , PDO::PARAM_STR);  
        $db->getResult()->bindValue(":dir", $direccion , PDO::PARAM_STR);  
        $db->execute(); 

        // 2. Para obtener el código del usuario insertado en la tabla usuario.        
        $db->prepare($lastId);
        $db->execute();
        $codUsu = $db->fetchColumn(0);

        // 3. Insert email y pass en la tabla login (email y contraseña para el usuario registrado).
        $db->prepare($sql2);
        $db->getResult()->bindValue(":email", $email , PDO::PARAM_STR);  
        $db->getResult()->bindValue(":pass", $pass , PDO::PARAM_STR);
        $db->getResult()->bindValue(":codUsu", $codUsu , PDO::PARAM_INT);
        $db->execute();


    }



    /**
     * ADMIN - Update de todos los datos del usuario.
     * @return bool true si ok, o false si no se ejecutó.
     * 
    */
    public function updateUserAdmin(){

        $codUsu = $_POST['codUsu'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $tfn = $_POST['tfn'];
        $dni = $_POST['dni'];
        $direccion = $_POST['direccion']; 
        $puesto = $_POST['puesto'];
        $turno = $_POST['turno'];

        $db = ConexionDb::getInstance('root', '');
        $sql = "UPDATE usuario SET nomUsu = :nom, apeUsu = :ape, tfnUsu = :tfn, dniUsu = :dni, dirUsu = :dir,";
        $sql .= " puestoUsu = :puesto, turnoUsu = :turno WHERE codUsu = :codUsu";

        // 1. Actualiza los datos del usuario.
        $db->prepare($sql);
        $db->getResult()->bindValue(":nom", $nombre , PDO::PARAM_STR);  
        $db->getResult()->bindValue(":ape", $apellidos , PDO::PARAM_STR);
        $db->getResult()->bindValue(":tfn", $tfn , PDO::PARAM_STR);  
        $db->getResult()->bindValue(":puesto", $puesto , PDO::PARAM_STR);
        $db->getResult()->bindValue(":turno", $turno , PDO::PARAM_STR);  
        $db->getResult()->bindValue(":dni", $dni , PDO::PARAM_STR);  
        $db->getResult()->bindValue(":dir", $direccion , PDO::PARAM_STR);
        $db->getResult()->bindValue(":codUsu", $codUsu , PDO::PARAM_INT);

        return $db->execute(); 



    }



    /**
     * Elimina a un usuario de la bd - tabla login solo.
     */
    public function deleteLogin($codUsu){

        $db = ConexionDb::getInstance('root', '');

        $sql2 = "UPDATE usuario SET baja = true WHERE codUsu = :codUsu";
        $db->prepare($sql2);
        $db->getResult()->bindValue(":codUsu", $codUsu , PDO::PARAM_INT);

        $db->execute(); 

        $sql = "DELETE FROM login WHERE codUsu = :codUsu;";
        $db->prepare($sql);
        $db->getResult()->bindValue(":codUsu", $codUsu , PDO::PARAM_INT);

        return $db->execute(); 

    }




  }
  