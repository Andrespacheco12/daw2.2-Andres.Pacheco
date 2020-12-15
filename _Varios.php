<?php

declare(strict_types=1);

session_start();

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

    $sql = "SELECT * FROM Usuario WHERE identificador=? AND contrasenna=?";

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
function hayCookieValida(): bool
{
    $conexion = obtenerPdoConexionBD();

$identificador = $_COOKIE['identificador'];
$codigoCookie = $_COOKIE['codigoCookie'];
    // TODO Comprobar si hay una "sesión-cookie" válida:

     if(isset($_SESSION['identificador'])){

         // Hacer la comprobacion interna de si vienen cookies

         /* if (isset($_COOKIE['identificador'] ) && isset($_COOKIE['codigoCookie']))   {*/
        $identificador = $_SESSION["identificador"];
        $codigoCookie = $_SESSION["codigoCookie"];

        $sql = "SELECT * FROM usuario WHERE identificador=? && BINARY codigoCookie=? ";
        $select = $conexion ->prepare($sql);
        $parametros= [$identificador,$codigoCookie];

        $select ->execute($parametros);
        $rs = $select ->fetchAll();
        $identificador = $rs[0]["identificador"];
        $codigoCookie = $rs[0]["cookie"];
        $unaFilaAfectada =( $select->rowCount()==1);
        if($unaFilaAfectada){
            return true;
        }else{
            return false;
        }

    }
    setcookie("identificador", $identificador, time()-3600);
    setcookie("codigoCookie", $codigoCookie, time()-3600);
    return false;

    //   - Ver que vengan DOS cookies "identificador" y "codigoCookie".
    //   - BD: SELECT ... WHERE identificador=? AND BINARY codigoCookie=?
    //   - ¿Ha venido un registro? (Igual que el inicio de sesión)
    //   - IMPORTANTE: si las cookies NO eran válidas, tenemos que borrárselas.
}
function generarCookieRecordar(array $arrayUsuario)
{
    $conexion = obtenerPdoConexionBD();
    // Creamos un código cookie muy complejo (no necesariamente único).
    $codigoCookie = generarCadenaAleatoria(32); // Random...

    // TODO guardar código en BD
    $sql = "UPDATE Usuario SET codigoCookie=? WHERE identificador=?";
    $parametros = [$codigoCookie, $arrayUsuario[1]];
    $sentencia = $conexion->prepare($sql);
    $sqlCorrecto = $sentencia->execute($parametros);


    // TODO Para una seguridad óptima convendría anotar en la BD la fecha de caducidad de la cookie y no aceptar ninguna cookie pasada dicha fecha.
    setcookie("identificador", $arrayUsuario[1], time()+3600);
    setcookie("codigoCookie", $codigoCookie, time()+3600);
    // TODO Enviamos al cliente, en forma de cookies, el identificador y el codigoCookie: setcookie(...) ...
}
    function borrarCookieRecordar()
    {
        $conexion=obtenerPdoConexionBD();
        // TODO Eliminar el código cookie de nuestra BD.
        $identificador = $_SESSION["identificador"];
    $sql = "SELECT codigoCookie FROM /*en casa es usuario */ Usuario WHERE identificador=?";

        $sql2 = "UPDATE /*en casa es usuario */Usuario SET codigoCookie=null WHERE identificador=?";
        $select = $conexion ->prepare($sql);
        $select ->execute([$identificador]);
        $rs = $select ->fetchAll();
       // $identificador = $rs[0]["identificador"];
        $codigoCookie = $rs[0]["codigoCookie"];

        $select2 = $conexion ->prepare($sql2);
        $select2 ->execute([$identificador]);

        // TODO Pedir borrar cookie (setcookie con tiempo time() - negativo...)
        setcookie("identificador", $identificador, time()-3600);
        setcookie("codigoCookie", $codigoCookie, time()-3600);
    }

    function generarCadenaAleatoria(int $longitud): string
{
    for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789')-1; $i != $longitud; $x = rand(0,$z), $s .= $a[$x], $i++);
    return $s;
}
function haySesionIniciada()//: boolean
{
    // TODO Pendiente hacer la comprobación.

    if (isset($_SESSION["id"])) {
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