<?php
/* 
 * This is a simple page
 */
require('lib/restricted.php'); //el incude para vericar que estoy logeado. Si falla salta a la página de login.php
?>

<!DOCTYPE html>
<html lang="es_MX">
    <head>
        <meta charset="UTF-8"/>
        <title>Welcome</title>
    </head>
    <body>
        <p>
            User validated
        </p>
        <p><a href='logout.php' >logout</a></p>
    </body>
</html>
