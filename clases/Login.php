<?php

  /**
   * Autor: David Pérez Pardo
   * Proyecto: iCONTROL - Desarrollo Web en Entorno Servidor
   * Curso 2019/2020
   * Clase Login 
   *  
   */

  class Login{

    private $codLog;
    private $email;
    private $pass;
    private $rol;
    private $codUsu;

    
    private function __construct() {}
      

    /**
     * Get the value of codLog
     */ 
    public function getcodLog()
    {
        return $this->codLog;
    }

    /**
     * Set the value of codLog
     *
     * @return  self
     */ 
    public function setcodLog($codLog)
    {
        $this->codLog = $codLog;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of pass
     */ 
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set the value of pass
     *
     * @return  self
     */ 
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get the value of rol
     */ 
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * Set the value of rol
     *
     * @return  self
     */ 
    public function setRol($rol)
    {
        $this->rol = $rol;

        return $this;
    }

    /**
     * Get the value of codUsu
     */ 
    public function getCodUsu()
    {
        return $this->codUsu;
    }

    /**
     * Set the value of codUsu
     *
     * @return  self
     */ 
    public function setCodUsu($codUsu)
    {
        $this->codUsu = $codUsu;

        return $this;
    }




    /** MÉTODOS */


    /**
     * Comprueba si ya existe el email en la bd.
     * @return bool true o false.
     */
    public function checkEmail($email){

        $db = ConexionDb::getInstance('root', '');
        $sql = "SELECT email FROM login WHERE email = :email";
        $db->prepare($sql);
        $db->getResult()->bindValue(":email", $email , PDO::PARAM_STR);
        $db->execute();     
        
        if($db->getNumRows() > 0):
            
            return true;
        else:
            return false;       

        endif;

        }




        public function getLogin($codUsu){

            $db = ConexionDb::getInstance('root', '');
            $sql = "SELECT * FROM login WHERE codUsu = :codUsu";
            $db->prepare($sql);
            $db->getResult()->bindValue(":codUsu", $codUsu , PDO::PARAM_STR);
            $db->execute();
            return $db->getObject("Login");

        
        }

    }