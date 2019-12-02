<?php

  require_once("/opt/lampp/htdocs/iCONTROL/libs/ConexionDb.php");
  require_once("/opt/lampp/htdocs/iCONTROL/clases/Usuario.php");

  

  class Sesion{

    private $nombre;
    private $esAdmin = false;
    private $apellidos;
    private $idUsuario;
    private $email;
    private static $instance = null;

    private function __construct(){}
    



    /**
     * Para instanciar la clase Sesion.
     * @return Sesion Sesion.
     */
    public static function getInstance(){

      session_start();

      //Comprobación - si ya está la sesión iniciada...
      if(isset($_SESSION['sesion'])){

        self::$instance = unserialize($_SESSION['sesion']);

      } else if (self::$instance === null){

        self::$instance = new Sesion();
      }

      // Devuelve la instancia Sesion
      return self::$instance;

    }


    /**
     * Para comprobar que el usuario y la contraseña
     * que se han introducido en el login existen y coincidan.
     * Consulta con la bdd.
     * Si se encuentra el usuario y contraseña se inicia _SESSION.
     * @return boolean true si la sesión se ha iniciado o false si no.
     * @param string email del usuario a loguear.
     * @param string pass del usuario a loguear.
     */
    public function login ($email, $pass){


      // Conexion con la bdd (se instancia la clase ConexionDB).
      $db = ConexionDb::getInstance("root" , "");

      // Consulta sql para buscar si existe usuario a loguear
      $sql ="SELECT u.codUsu, u.nomUsu, u.apeUsu, l.rol, l.email  FROM usuario u JOIN login l ON (u.codUsu = l.codUsu)";
      $sql .= " WHERE l.email=:ema AND l.pass = MD5(:contra) ;";

      // Sentencia preparada.
      $db->prepare($sql);
      
      // Párametros de la consulta. 
      $db->getResult()->bindValue(":ema", $email , PDO::PARAM_STR);
      $db->getResult()->bindValue(":contra", $pass, PDO::PARAM_STR);

      
      // Ejecución de la sentencia preparada.
      if($db->getResult()->execute()){
        
        // si hay resultado...
        if($db->getResult()->rowCount()){

          // Obtengo la info del usuario (array) - nombre,apellidos ,rol,email e id .
          $columnas = $db->getResult()->fetch();

          $this->nombre = $columnas['nomUsu'];
          $this->apellidos = $columnas['apeUsu'];
          $this->esAdmin = $columnas['rol'];
          $this->idUsuario = $columnas['codUsu'];
          $this->email = $columnas['email'];
          // Almacenamos el momento (segundos) en el que se inicia la sesión.
          $_SESSION["time"] = time();
          $_SESSION["sesion"] = serialize(self::$instance);
        
          // Sesión iniciada
          return true;

        }     
      }

      // Sesión NO iniciada
      return false;

    }


    /**
     * Comprueba si la sesión está activa (vacía o no).
     * @return bool
     */
    public function checkSesionActiva (){
      
      if(!empty($_SESSION)){

        return true;
      }

      
      return false;
    }


    /**
     * Para redirecionar hacía otro script.
     * @param string url
		 */
		public function redirect(string $url)
		{
			header("Location: $url");
			die();
    }
    

		/**
     * Vacía las variables de sesión y la destruye.
		 */
		public function close()
		{
			// vaciamos las variables de sesión
			$_SESSION = [] ;

			// destruir la sesión
			session_destroy() ;
		}


    /**
     * Get the value of usuario
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Get the value of esAdmin
     */ 
    public function getEsAdmin()
    {
        return $this->esAdmin;
    }

    /**
     * Get the value of apellidos
     */ 
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * Get the value of idUsuario
     */ 
    public function getIdUsuario()
    {
        return $this->idUsuario;
    }



    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }
  }