<?php
/*
 * Valid an user and password or present the login form 
 */

if ($_SERVER['REQUEST_METHOD']=='POST') { // The method to send data is POST
    include('lib/config.ini.php'); //include config
    include('lib/login.lib.php'); //include functions

    //Verify user and password sended
    if (login($_POST['usuario'],$_POST['password'])) {



       // Actions to realice when an user is loged
       // Ej. Save in memory the data, sign an access in a table

        //First the access is denied
        header('Location: restricted.php');
        die();
    } else {
        // If the login fail

        // We prepare a error mesage and continue to show the form
        $mensaje='Usuario o contraseña incorrecto.';
    }
} //End if post
?>

<!DOCTYPE html>
<html lang="es_MX">
    <head>
        <meta charset="UTF-8"/>
        <title>Login </title>
    </head>
    <body>
        <h1>Login</h1>
        <?php
            // If exist error, show it escapping html characters
            if (!empty($mensaje)) echo('<h2>'.htmlspecialchars($mensaje).'</h2>');
        ?>
        <form action="index.php" enctype="multipart/form-data" method="post">
            <label>Usuario:
                <input name="usuario" type="text" />
            </label>
            <label>Contraseña:
                <input name="password" type="password" />
            </label>
            <input type="submit" value="Entrar" />
        </form>
    </body>
</html>