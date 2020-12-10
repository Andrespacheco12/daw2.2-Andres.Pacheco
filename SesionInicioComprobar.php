<?php

require_once "_Varios.php";
// TODO ...$_REQUEST["..."]...

// TODO Verificar (usar funciones de _Varios.php) identificador y contrasenna recibidos y redirigir a contenido1 (si OK) o a iniciar sesión (si NO ok).
$identificador= $_REQUEST["identificador"];
$contrasenna= $_REQUEST["contrasenna"];

$arrayUsuario = obtenerUsuario($identificador, $contrasenna);

if ($arrayUsuario) { // HAN venido datos: identificador existía y contraseña era correcta.
    // TODO Llamar a marcarSesionComoIniciada($arrayUsuario) ...
marcarSesionComoIniciada($arrayUsuario);
generarCookieRecordar($arrayUsuario);
redireccionar("ContenidoPrivado1.php");
    // TODO Redirigir.
} else {
    // TODO Redirigir.

    redireccionar("SesionInicioMostrarFormulario.php");
}