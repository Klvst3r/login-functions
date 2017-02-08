<?php
/* 
 * Close Sessionis
 */

include('lib/login.lib.php');
logout(); //Empty session of the user 
header('Location: index.php'); 

?>
