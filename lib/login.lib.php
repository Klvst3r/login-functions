<?php
/**
 * This library validate un user checking user and password fields
 *
 * @author Klvst3r
 */

/**
 * Valid te user and pass
 * @param string $usuario
 * @param string $password
 * @return bool
 */
function login($usuario,$password) {

    // Exist data
    if (empty($usuario)) return false;
    if (empty ($password)) return false;

    // Connecto to the Database with globals parameters
    $link =  mysql_connect(SERVIDOR_MYSQL, USUARIO_MYSQL, PASSWORD_MYSQL);

    if (!$link) {
        //trigger_error('Error al conectar al servidor mysql: ' . mysql_error(),E_USER_ERROR);
        print('Error al conectar al servidor mysql: ' . mysql_error());
        
    }

    // Select the active database 
    $db_selected = mysql_select_db(BASE_DATOS, $link);
    if (!$db_selected) {
        //trigger_error ('Error al conectar a la base de datos: ' . mysql_error(),E_USER_ERROR);
        print('Error al conectar a la base de datos: ' . mysql_error());
    }

    // Make the query in SQL format avoid SQL Injection
    $query = 'SELECT '.CAMPO_USUARIO_LOGIN.', '.CAMPO_CLAVE_LOGIN.' FROM '.TABLA_DATOS_LOGIN.' WHERE '.CAMPO_USUARIO_LOGIN.'="'.  mysql_real_escape_string($usuario).'" LIMIT 1 '; // Table and fields are defined in global parameters
    
    $result = mysql_query($query);
    if (!$result) {
        //trigger_error('Error al ejecutar la consulta SQL: ' . mysql_error(),E_USER_ERROR);
        print('Error al ejecutar la consulta SQL ' . mysql_error());
    }


    //Extract the row for this user
    $row = mysql_fetch_assoc($result);

    
    
    if ($row) {
        // Generate the hash of the password encrypted to compare o leave in plain text
        switch (METODO_ENCRIPTACION_CLAVE) {
            case 'sha1'|'SHA1':
                $hash=sha1($password);
                break;
            case 'md5'|'MD5':
                $hash=md5($password);
                break;
            case 'texto'|'TEXTO':
                $hash=$password;
                break;
            default:
                //trigger_error('El valor de la constante METODO_ENCRIPTACION_CLAVE no es válido. Utiliza MD5 o SHA1 o TEXTO',E_USER_ERROR);
                echo 'El valor de la constante METODO_ENCRIPTACION_CLAVE no es válido. Utiliza MD5 o SHA1 o TEXTO';
        }


        //Test the password
        if ($hash==$row[CAMPO_CLAVE_LOGIN]) {
            @session_start();
            $_SESSION['USUARIO']=array('user'=>$row[CAMPO_USUARIO_LOGIN]); //Send to memory the data
            
            // to this point is important save data in memory for use later, in an assosiative array with the id, name, email, preferences, ...
            return true; //if the user and pass are validated
        } else {
            @session_start();
            unset($_SESSION['USUARIO']); //destroy the active sessiondestruimos if the login fail if exist 
            return false; //the password is fail
        }
    } else {
        //The user doesn't exist
        return false;
    }

}

/**
 * Verify if the user is signed
 * @return bool
 */
function estoy_logeado () {
    @session_start(); //Begin session ( the @ avoid the error mesages if the session is begining already 
    
    if (!isset($_SESSION['USUARIO'])) return false; //Doesn't exist the variable $_SESSION['USUARIO']. Not signed In
    if (!is_array($_SESSION['USUARIO'])) return false; //The varaibel is not an array $_SESSION['USUARIO']. Not signed In
    if (empty($_SESSION['USUARIO']['user'])) return false; // The user is not saved in $_SESSION['USUARIO']. Not signed In

    //If the previuos conditions are meeted, then the user is valid
    return true;

}

/**
 * empty the session with user data validated   
 */
function logout() {
    @session_start(); //Begin the session (the @ avoid the error messages if the session was beggined
    unset($_SESSION['USUARIO']); //Delete the variable with user data 
    session_write_close(); //Cave and close sessioni 
    return true;
}

    
?>
