<?php

require_once "clases.php";
require_once "utilidades.php";

class DAO
{
    private static $pdo = null;

    private static function obtenerPdoConexionBD()
    {
        $servidor = "localhost";
        $bd = "agenda";
        $identificador = "root";
        $contrasenna = "";
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false, // turn off emulation mode for "real" prepared statements
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //make the default fetch be an associative array
        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage()); // El error se vuelca a php_error.log
            exit('Error al conectar'); //something a user can understand
        }

        return $pdo;
    }
/*
    public static function ejecutarConsulta(string $sql, array $parametros): array
    {
        if (!isset(Self::$pdo)) Self::$pdo = Self::obtenerPdoConexionBd();

        $select = Self::$pdo->prepare($sql);
        $select->execute($parametros); // Array vacío porque la consulta preparada no requiere parámetros.
        $rs = $select->fetchAll();

        return $rs;
    }
*/
    public static function ejecutarConsulta(string $sql, array $id): array
    {
        if (!isset(Self::$pdo)) Self::$pdo = Self::obtenerPdoConexionBd();

        $select = Self::$pdo->prepare($sql);
        $select->execute($id);

        return $select->fetchAll();
    }
    public static function categoriaFicha(){

        $id= (int)$_REQUEST["id"];

        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

      $rs=  self::ejecutarConsulta("SELECT nombre FROM categoria WHERE id=?",[$id]);

      return $rs;
    }

    public static function personaFicha(){

        $id= (int)$_REQUEST["id"];

        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $rs=  self::ejecutarConsulta("SELECT * FROM persona WHERE id=?",[$id]);

        return $rs;
    }


    private static function ejecutarConsultaNormal(string $sql, array $id)
    {
        if (!isset(Self::$pdo)) Self::$pdo = Self::obtenerPdoConexionBd();

        $select = Self::$pdo->prepare($sql);
        $select->execute($id);

    }

    private static function categoriaCrearDesdeRs(array $fila): Categoria
    {
        return new Categoria($fila["id"], $fila["nombre"]);
    }

    private static function personaCrearDesdeRs(array $fila): Persona
    {
        return new Persona($fila["id"], $fila["nombre"], $fila["apellidos"], $fila["telefono"], $fila["estrella"], $fila["categoriaId"]);
    }

    public static function personaObtenerTodas(): array
    {
        $datos = [];
        $rs = self::ejecutarConsulta(
            "SELECT * FROM persona ORDER BY nombre",
            []
        );

        foreach ($rs as $fila) {
            $persona = self::personaCrearDesdeRs($fila);
            array_push($datos, $persona);
        }

        return $datos;
    }


    public static function categoriaObtenerTodas(): array
    {
        $datos = [];
        $rs = self::ejecutarConsulta(
            "SELECT * FROM categoria ORDER BY nombre",
            []
        );

        foreach ($rs as $fila) {
            $categoria = self::categoriaCrearDesdeRs($fila);
            array_push($datos, $categoria);
        }

        return $datos;
    }

    public static function creaModificaCategoria(string $sql, array $parametros)
    {
        if (!isset(Self::$pdo)) Self::$pdo = Self::obtenerPdoConexionBd();

        $select = Self::$pdo->prepare($sql);
        $select->execute($parametros);
    }

    public static function categoriaEliminar(int $id)
    {

        if (!isset(Self::$pdo)) Self::$pdo = Self::obtenerPdoConexionBd();

        self::ejecutarConsultaNormal("DELETE FROM categoria WHERE id=?",
            [$id]);
    }
    public static function personaEliminar(int $id)
    {

        if (!isset(Self::$pdo)) Self::$pdo = Self::obtenerPdoConexionBd();

        self::ejecutarConsultaNormal("DELETE FROM persona WHERE id=?",
            [$id]);
    }
    public static function categoriaGuardar()
    {
        $nombre = $_REQUEST["nombre"];

        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        self::ejecutarConsultaNormal("INSERT INTO categoria (nombre) VALUES (?)",[$nombre]);
    }

    public static function personaGuardar()
    {
        $nombre= $_REQUEST["nombre"];
        $apellidos= $_REQUEST["apellidos"];
        $telefono = $_REQUEST["telefono"];
        $categoriaId= (int)$_REQUEST["categoriaId"];
        $estrella = ISSET($_REQUEST["estrella"]);

        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        self::ejecutarConsultaNormal("INSERT INTO persona (nombre,apellidos,telefono,estrella,categoriaId) VALUES (?,?,?,?,?)",[$nombre,$apellidos,$telefono,$estrella?1:0,$categoriaId]);
    }
    public static function categoriaModificar()
    {
        $id = (int)$_REQUEST["id"];
        $nombre = $_REQUEST["nombre"];

        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();
        self::ejecutarConsultaNormal("UPDATE categoria SET nombre=? WHERE id=?",[$nombre,$id]);
    }

    public static function personaModificar()
    {
        $id = (int)$_REQUEST["id"];
        $nombre= $_REQUEST["nombre"];
        $apellidos= $_REQUEST["apellidos"];
        $telefono = $_REQUEST["telefono"];
        $categoriaId= (int)$_REQUEST["categoriaId"];
        $estrella = ISSET($_REQUEST["estrella"]);

        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();
        self::ejecutarConsultaNormal("UPDATE persona SET nombre=?,apellidos=?,telefono=?,estrella=?,categoriaId=? WHERE id=?",[$nombre,$apellidos,$telefono,$estrella?1:0,$categoriaId,$id]);
    }

    private static function ejecutarActualizacion(string $sql, array $parametros): void
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $actualizacion = self::$pdo->prepare($sql);
        $actualizacion->execute($parametros);
    }
}


