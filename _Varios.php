<?php

declare(strict_types=1);

function obtenerPdoConexionBD(): PDO
{
    $servidor = "localhost";
    $bd = "MiniFb";
    $identificador = "root";
    $contrasenna = "";
    $opciones = [
        PDO::ATTR_EMULATE_PREPARES   => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
    ];

    try {
        $conexion = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
    } catch (Exception $e) {
        error_log("Error al conectar: " . $e->getMessage()); // El error se vuelca a php_error.log
        exit('Error al conectar'); //something a user can understand
    }

    return $conexion;
}

function obtenerUsuario(string $identificador, string $contrasenna): ?array
{
   $conexion= obtenerPdoConexionBD();
    // TODO Pendiente hacer.

    $sql = "SELECT * FROM usuario WHERE identificador=? AND contrasenna=?";

    $select = $conexion  ->prepare($sql);
    $parametros = [$identificador,$contrasenna];
    $select ->execute($parametros);
    $rs = $select ->fetchAll();
    $unaFila =( $select ->rowCount() ==1 );

    $id= $rs[0]["id"];
    $nombre = $rs[0]["nombre"];
    $apellidos = $rs[0]["apellidos"];
    //$identificador= $rs[0]["identificador"];
    //$contrasenna= $rs[0]["contrasenna"];


    // Conectar con BD, lanzar consulta, ver si viene 1 fila o ninguna...
    if($unaFila){
        return [$id, $identificador, $nombre , $apellidos];
    }else{
        return [];
    }
}

function marcarSesionComoIniciada(array $arrayUsuario)
{
    // TODO Anotar en el post-it todos estos datos:
     $_SESSION["id"] = $arrayUsuario[0];
     $_SESSION["identificador"] = $arrayUsuario[1];
     $_SESSION["nombre"] = $arrayUsuario[3];
     $_SESSION["apellidos"] = $arrayUsuario[4];

    // ...
}

function haySesionIniciada()//: boolean
{
    // TODO Pendiente hacer la comprobación.

    if (isset($_REQUEST["id"])) {
        return true;
    }else{
        return false;
    }
}

function cerrarSesion()
{
   session_destroy();
   session_unset();
}

// (Esta función no se utiliza en este proyecto pero se deja por si se optimizase el flujo de navegación.)
// Esta función redirige a otra página y deja de ejecutar el PHP que la llamó:
function redireccionar(string $url)
{
    header("Location: $url");
    exit;
}

function syso(string $contenido)
{
    file_put_contents('php://stderr', $contenido . "\n");
}