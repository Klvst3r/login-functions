<?php
/* 
 * Make sure the page 
 */

include_once('lib/config.ini.php'); 
include_once('lib/login.lib.php'); 

if (!estoy_logeado()) { // 
    header('Location: index.php'); 
    die('Acceso no autorizado'); 
}

//Continues script
?>
