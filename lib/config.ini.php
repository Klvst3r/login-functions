<?php
/* 
 * General config: Conection to Data base
 */

define('SERVIDOR_MYSQL','localhost'); 
define('USUARIO_MYSQL','dev'); 
define('PASSWORD_MYSQL','desarrollo'); 
define('BASE_DATOS','login-functions'); 

define('TABLA_DATOS_LOGIN','usuarios'); 
define('CAMPO_USUARIO_LOGIN','usuario'); 
define('CAMPO_CLAVE_LOGIN','password'); 

define('METODO_ENCRIPTACION_CLAVE','texto'); //o0ptions: sha1, md5, o Text


?>
