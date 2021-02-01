<?php
require_once "Utilidades.php";
require_once "Clases.php";


class DAO
{

    private static ?PDO $pdo = null;
    private static function obtenerPdoConexionBD(): PDO
    {
        $servidor = "localhost";
        $identificador = "root";
        $contrasenna = "";
        $bd = "minifb";
        $opciones = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        try {
            $pdo = new PDO("mysql:host=$servidor;dbname=$bd;charset=utf8", $identificador, $contrasenna, $opciones);
        } catch (Exception $e) {
            error_log("Error al conectar: " . $e->getMessage());
            exit("Error al conectar" . $e->getMessage());
        }
        return $pdo;
    }

    public static function haySesionRamIniciada()//: boolean
    {

        if (isset($_SESSION["id"])) {
            return true;
        }else{
            return false;
        }
    }

    private static function ejecutarConsulta(string $sql, array $parametros): array
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $select = self::$pdo->prepare($sql);
        $select->execute($parametros);
        return $select->fetchAll();
    }
    public static function VerFichaUsuario(): array
    {
        $identificador = $_REQUEST["identificador"];

        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        return self::ejecutarConsulta("SELECT * FROM usuario WHERE identificador=?", [$identificador]);
    }

    public static function usuarioModificar()
    {
        $identificador = $_REQUEST["identificador"];
        $nombre = $_REQUEST["nombre"];
        $apellidos = $_REQUEST["apellidos"];



        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();
        self::ejecutarActualizacion("UPDATE usuario SET identificador=?,nombre=?,apellidos=? WHERE identificador=?", [$identificador, $nombre, $apellidos, $identificador]);
    }

    public static function obtenerusuario(): array
    {
        $datos = [];
        $rs = self::ejecutarConsulta(
            "SELECT * FROM usuario ",
            []
        );

        foreach ($rs as $fila) {
            $usuario = self::usuarioCrearDesdeRS($fila);
            array_push($datos, $usuario);
        }

        return $datos;
    }

    public static function obtenerusuarioActual(): Usuario
    {
        $usuario=0;
        $identificador = $_REQUEST["identificador"];

        $rs = self::ejecutarConsulta(
            "SELECT * FROM usuario WHERE identificador=?",
            [$identificador]
        );

        foreach ($rs as $fila) {
            $usuario = self::usuarioCrearDesdeRS($fila);

        }
    return $usuario;

    }

    public static function obtenerTodosMensajes(): array
    {
        $datos = [];
        $rs = self::ejecutarConsulta(
            "SELECT id,fecha,emisorId,destinatarioId,asunto,contenido FROM publicacion",
            []
        );

        foreach ($rs as $fila) {
            $publicacion = self::publicacionCrearDesdeRS($fila);
            array_push($datos, $publicacion);
        }

        return $datos;
    }
    public static function obtenerMensajesUsuario($destinatarioId): array
    {
        $datos=[];

        $rs = self::ejecutarConsulta(
            "SELECT * FROM publicacion WHERE destinatarioId=?",
            [$destinatarioId]
        );

        foreach ($rs as $fila) {
            $publicacion = self::publicacionCrearDesdeRS($fila);
            array_push($datos, $publicacion);
        }
    return $datos;

    }
    function cerrarSesionRamYCookie()
    {
        session_destroy();
       // actualizarCodigoCookieEnBD(Null);
        //borrarCookies();
        unset($_SESSION); // Por si acaso
    }

    private static function ejecutarActualizacion(string $sql, array $parametros): bool
    {
        if (!isset(self::$pdo)) self::$pdo = self::obtenerPdoConexionBd();

        $actualizacion = self::$pdo->prepare($sql);
        return $actualizacion->execute($parametros);
    }
    public static function UsuarioCrear(array $arrayUsuario)
    {
        if (isset($arrayUsuario)) {

            return self::ejecutarActualizacion("INSERT INTO usuario (identificador,contrasenna,nombre,apellidos) VALUES (?,?,?,?) ", [$arrayUsuario["identificador"], $arrayUsuario["contrasenna"], $arrayUsuario["nombre"], $arrayUsuario["apellidos"]]);

        }
    }

    public static function PublicacionCrear(array $publicacion)
    {
        if (isset($publicacion)) {

            return self::ejecutarActualizacion("INSERT INTO publicacion (destinatarioId,emisorId,asunto,contenido) VALUES (?,?,?,?)", [$publicacion["destinatarioId"],$publicacion["emisorId"], $publicacion["asunto"], $publicacion["contenido"]]);

        }
    }

    function intentarCanjearSesionCookie(): bool
    {
        $conexion = self::obtenerPdoConexionBD();
        $identificador = $_SESSION["identificador"];
        $codigoCookie = $_SESSION["codigoCookie"];
        // TODO Comprobar si hay una "sesión-cookie" válida:
        if (isset($_COOKIE['identificador'] ) && isset($_COOKIE['codigoCookie']))   {
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
            setcookie("identificador", $identificador, time()-3600);
            setcookie("codigoCookie", $codigoCookie, time()-3600);
        }return false;

        //   - Ver que vengan DOS cookies "identificador" y "codigoCookie".
        //   - BD: SELECT ... WHERE identificador=? AND BINARY codigoCookie=?
        //   - ¿Ha venido un registro? (Igual que el inicio de sesión)
        //   - IMPORTANTE: si las cookies NO eran válidas, tenemos que borrárselas.
    }
    private static function usuarioCrearDesdeRS(array $usuario): Usuario
    {
        return new Usuario($usuario["id"], $usuario["identificador"], $usuario["contrasenna"],$usuario["tipoUsuario"],$usuario["nombre"], $usuario["apellidos"]);
    }

    private static function publicacionCrearDesdeRS(array $publicacion):  Publicacion
    {
        return new Publicacion($publicacion["id"], $publicacion["fecha"], $publicacion["emisorId"],$publicacion["destinatarioId"],$publicacion["asunto"],$publicacion["contenido"]);
    }

    public static function marcarSesionComoIniciada($arrayUsuario)
    {
        $_SESSION["id"]=$arrayUsuario[0];
        $_SESSION["identificador"]=$arrayUsuario[1];
        $_SESSION["contrasenna"]=$arrayUsuario[2];
        $_SESSION["codigoCookie"]=$arrayUsuario[3];
        $_SESSION["caducidadCodigoCookie"]=$arrayUsuario[4];
        $_SESSION["tipoUsuario"]=$arrayUsuario[5];
        $_SESSION["nombre"]=$arrayUsuario[6];
        $_SESSION["apellidos"]=$arrayUsuario[7];
    }
    function generarCookieRecordar(array $arrayUsuario)
    {
        $conexion = self::obtenerPdoConexionBD();
        $codigoCookie = generarCadenaAleatoria(32); // Random...

        $sql = "UPDATE Usuario SET codigoCookie=? WHERE identificador=?";
        $parametros = [$codigoCookie, $arrayUsuario[1]];
        $sentencia = $conexion->prepare($sql);
        $sqlCorrecto = $sentencia->execute($parametros);

        setcookie("identificador", $arrayUsuario[1], time()+3600);
        setcookie("codigoCookie", $codigoCookie, time()+3600);
    }

}
