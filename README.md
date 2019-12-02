# php_webapp-icontrol
PHP-Project webApp
<hr>
<h1>TÍTULO: iCONTROL</H1>
<hr>
<h2>Descripción</h2>
<hr>

<p>Se trata de una aplicación web para llevar un registro del control horario de los trabajadores en una empresa.Registra en la BD la fecha y hora en que el trabajador fichó, tanto a la entrada cómo para la salida.</p>
<p>Se dispone también de información personal que pudiera ser útil sobre los usuarios en la empresa, tales cómo el puesto que ocupan, la fecha de alta en la empresa, el turno etc.</p>
  
<p>Tenemos dos tipos de roles/usuarios en ella:</p>
 <ul> 
  <li>
    <p>Usuario: Éste usuario es el que sólo tiene capacidad de registrar sus entradas y salidas, de consultar toda su información personal, historial de registros etc. Solo podrá modificar algunos datos personales propios, es el usuario que tendrá el trabajador de la empresa, teniendo para ello su propia vista.</p>   
  </li>  
  <li>
  <p>Administrador: Éste usuario es el que se encargará de registrar a todos los demás usuarios, podrá consultar toda su informacion personal, modificarla, consultar sus historiales de registros etc.Tendrá también el poder de elminar la cuenta login a un usuario, impidiendo su acceso en la aplicación.</p> 
  </li>
  
  </ul>
  
  <h2>Manual</h2>
  <hr>
  <p>Para comenzar a usar la aplicación, debemos iniciar sesión con nuestra cuenta de usuario, y en función del tipo/rol, accederemos a una vista u otra, en este caso, la de usuario no-administrador:</p>
  <img src="https://github.com/DavidPerezPardo/php_webapp-icontrol/blob/master/capturas/Captura%20de%20pantalla%20de%202019-12-02%2013-58-35.png"><br>
  <p>Ésta es la primera pantalla que se encuentra el usuario, en la que podrá registrar la fecha y hora con tan sólo pulsar el botón, acceder a su perfil o bien cerrar sesión:</p>
    <img src="https://github.com/DavidPerezPardo/php_webapp-icontrol/blob/master/capturas/Captura de pantalla de 2019-12-02 13-59-29.png">
        <img src="https://github.com/DavidPerezPardo/php_webapp-icontrol/blob/master/capturas/Captura de pantalla de 2019-12-02 13-59-45.png"><br>
   <p>Aquí el perfil del usuario, dónde podrá consultar sus datos personales, modificar algunos y consultar su histórico de registros filtrando por fechas:</p>
        <img src="https://github.com/DavidPerezPardo/php_webapp-icontrol/blob/master/capturas/Captura de pantalla de 2019-12-02 14-01-12.png"><br>
        
        
              
<p>Ahora pasaremos a la vista del administrador, en la que podrá consultar a todos los usuarios del sistema:</p>
<img src="https://github.com/DavidPerezPardo/php_webapp-icontrol/blob/master/capturas/Captura de pantalla de 2019-12-02 13-53-18.png"><br>
<img src="https://github.com/DavidPerezPardo/php_webapp-icontrol/blob/master/capturas/Captura de pantalla de 2019-12-02 13-53-53.png"><br>

<p>Consultar el historial de registros, filtrando por fechas:</p>
<img src="https://github.com/DavidPerezPardo/php_webapp-icontrol/blob/master/capturas/Captura de pantalla de 2019-12-02 13-57-31.png"><br>


<p>Modificar sus datos personales:</p>
<img src="https://github.com/DavidPerezPardo/php_webapp-icontrol/blob/master/capturas/Captura de pantalla de 2019-12-02 13-55-47.png"><br>

<p>Registrar nuevos usuarios en el sistema, creando su cuenta de login: </p>
<img src="https://github.com/DavidPerezPardo/php_webapp-icontrol/blob/master/capturas/Captura de pantalla de 2019-12-02 13-51-28.png"><br>
<p>El administrador también podrá eliminar usuarios, impidiendo que puedan acceder a la aplicación, pero manteniendo la información y los registros de los mismos almacenados en la BD, por si fuese necesario su consulta en el futuro.</p>


