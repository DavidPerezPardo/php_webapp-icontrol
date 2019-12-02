<?php

  /**
   * Autor: David Pérez Pardo
   * Proyecto: iCONTROL - Desarrollo Web en Entorno Servidor
   * Curso 2019/2020
   * Clase ConexionDb - Conecta con la base de datos utilizando PDO
   *  
   */


  class ConexionDb {

    private $dns = "mysql:host=localhost;dbname=icontrol;charset=utf8";
    private $dbUser;
    private $dbPass;
  
    private $miPdo = null;
    private static $instance = null ;
    private $result = null;



    /**
    * @param  $dns
    * @param  $dbUser - Usuario bdd
    * @param  $dbPass - Pass bdd
    */
    private function __construct($dbUser, $dbPass){

      $this->dbUser = $dbUser;
      $this->dbPass = $dbPass;

      $this->connect();

    }

    
    /**
     * Destructor para la clase.
     * Al destruirse el objeto, cerramos la conexion a la bdd.
     */
    public function __destruct(){
      $this->miPdo = null;
    }



    /**
     * Utilizamos el patrón de diseño SINGLETON que nos permitirá
     * tener una única instancia de la clase DATABASE.
     *
     * @param String $dbUser - Usuario bdd
     * @param String $dbPass - Password bdd
     */
    public static function getInstance($dbUser, $dbPass){
      
      // Si no existe la instancia la creamos
      if(ConexionDb::$instance === null)
  
        ConexionDb::$instance = new ConexionDb ($dbUser, $dbPass); 
        // Devuelve la instancia
        return ConexionDb::$instance;       
    
      }
    

    // Para establecer la conexión con la base de datos
    private function connect(){

      try {

        // Conexión con la bdd
        $this->miPdo = new PDO ($this->dns, $this->dbUser, $this->dbPass);

      } catch (miPdoException $e) {

        die("**Error: " . $e->getMessage());
    
      }
    }


    /**
    * Realizamos una consulta y devolvemos: true si la consulta
    * se ha hecho con éxito y/o hay resultado; false en otro caso.
    * @param string $sql - La consulta sql
    * @return boolean true o false, 1 o 0
    */
    public function query($sql):bool{
      // Se lanza la consulta
      $this->result = $this->miPdo->query($sql)
        or die("ERROR: se ha producido un error de acceso a la base de datos") ;
        
      // Si la query se realiza OK...
      if($this->result){
        // Si además hay resultados (filas)
        return ($this->result->rowCount() > 0);

      }
      // Si no hay registros...false
      return $this->result;
    }
    

    /**
     * Devuelve el resultado de la consulta como un objeto
     * @param $objeto (por defecto "StdClass")
     * @return $this->result como un objeto
     * 
     */
    public function getObject($objeto = "stdClass"){
      
      if(is_null($this->result)){

        return null;
      }

      // Si hay resultado, se devuelve...
      return $this->result->fetchObject($objeto);

    }


    /**
     * Devuelve una fila de la consulta.
     */
    public function fetch(){

      return $this->result->fetch();
    }

    /**
     * Devuelve todas las filas de la consulta.
     * @param string Clase de los objeto a devolver
     * @return Object Filas de la consulta como objeto.
     */
    public function fetchAll($clase){

      return $this->result->fetchAll(PDO::FETCH_CLASS, $clase);
    }
    

        /**
     * Devuelve una columna de la consulta.
     * @param int Posición de la columan a devolver.
     */
    public function fetchColumn($numCol){

      return $this->result->fetchColumn($numCol);
    }


    /**
     * Para preparar una sentencia parametrizada.
     * @param string consulta sql.
     * @return miPdostatement objeto miPdostatement o false en caso de error.
     */
    public function prepare($sql){

      $this->result = $this->miPdo->prepare($sql);
      return $this->result;
    }


    /**
     * Ejecuta una sentencia preparada.
     * @return bool true si se ejecuta o false si no.
     */
    public function execute(){

      return $this->result->execute();

    }
    

    /**
     * Devuelve el número de filas afectadas en la sentencia
     * SQL.
     * @return int
     * 
     */
    public function getNumRows(){

      return $this->result->rowCount();
    }


    /**
		* Cuando el objeto se deserializa, conectamos de nuevo
		* con el motor de base de datos.
		*/
		public function __wakeup()
		{
			$this->connect() ;
    }
    



    // GETTERS Y SETTERS

    /**
     * Get the value of result
     */ 
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set the value of result
     *
     * @return  self
     */ 
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }


  }
