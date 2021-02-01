<?php

trait Identificable
{
    protected int $id;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }
}

abstract class Dato
{
}

/*--------------------------------USUARIO----------------------------------*/

class Usuario extends Dato
{
    use Identificable;

    private string $identificador;

    private string $contrasenna;

    private string $tipoUsuario;

    private string $nombre;

    private string $apellidos;




    public function __construct(int $id, string $identificador,string $contrasenna,string $tipoUsuario, string $nombre, string $apellidos )
    {
        $this->setId($id);
        $this->setIdentificador($identificador);
        $this->setContrasenna($contrasenna);
        $this->setTipoUsuario($tipoUsuario);
        $this->setNombre($nombre);
        $this->setApellidos($apellidos);

    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function getIdentificador(): string
    {
        return $this->identificador;
    }

    public function setIdentificador(string $identificador)
    {
        $this->identificador = $identificador;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function getTipoUsuario(): string
    {
        return $this->tipoUsuario;
    }

    public function setTipoUsuario(string $tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;
    }

    public function getContrasenna(): string
    {
        return $this->contrasenna;
    }

    public function setContrasenna(string $contrasenna)
    {
        $this->contrasenna = $contrasenna;
    }
}
class Publicacion extends Dato
{
    use Identificable;

    private string $fecha;

    private string $emisorId;

    private ?int $destinatarioId;

    private string $asunto;

    private string $contenido;


    public function __construct(int $id, string $fecha,int $emisorId, ?int $destinatarioId, string $asunto, string $contenido)
    {
        $this->setId($id);
        $this->setFecha($fecha);
        $this->setEmisorId($emisorId);
        $this->setDestinatarioId($destinatarioId);
        $this->setAsunto($asunto);
        $this->setContenido($contenido);

    }

    public function getFecha(): string
    {
        return $this->fecha;
    }

    public function setFecha(string $fecha)
    {
        $this->fecha = $fecha;
    }

    public function getEmisorId(): int
    {
        return $this->emisorId;
    }

    public function setEmisorId(int $emisorId)
    {
        $this->emisorId = $emisorId;
    }

    public function getDestinatarioId(): ?int
    {
        return $this->destinatarioId;
    }

    public function setDestinatarioId(?int  $destinatarioId)
    {
         $this->destinatarioId = $destinatarioId;
    }

    public function getAsunto(): string
    {
        return $this->asunto;
    }

    public function setAsunto(string $asunto)
    {
        $this->asunto = $asunto;
    }

    public function getContenido(): string
    {
        return $this->contenido;
    }

    public function setContenido(string $contenido)
    {
        $this->contenido = $contenido;
    }
}
