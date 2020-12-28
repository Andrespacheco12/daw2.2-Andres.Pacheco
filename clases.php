<?php

abstract class Dato
{

}

class Categoria extends Dato {
    //use Identificable;

    private $id;
    private $nombre;

    public function __construct($id,$nombre)
    {
        $this->id = $id;
        $this->setNombre($nombre);

    }



    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id=$id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    public function obtenerPersonasPertenecientes(): array
    {
        if ($this->personasPertenecientes == null) $personasPertenecientes = DAO::personaObtenerPorCategoria($this->id);

        return $personasPertenecientes;
    }
}

class Persona extends Dato
{
    private  $id;
    private  $nombre;
    private  $apellidos;
    private $telefono;
    private $estrella;
    private $categoriaId;

    public function __construct($id,$nombre,$apellidos,$telefono,$estrella,$categoriaId)
    {
        $this->id = $id;
        $this->setNombre($nombre);
        $this->setApellidos($apellidos);
        $this->setTelefono($telefono);
        $this->setEstrella($estrella);
        $this->setCategoriaId($categoriaId);
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id=$id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos): void
    {
        $this->apellidos = $apellidos;
    }

    public function getTelefono()
    {
        return $this->telefono;
    }

    public function setTelefono($telefono): void
    {
        $this->telefono = $telefono;
    }

    public function getEstrella()
    {
        return $this->estrella;
    }

    public function setEstrella($estrella): void
    {
        $this->estrella = $estrella;
    }

    public function getCategoriaId()
    {
        return $this->categoriaId;
    }

    public function setCategoriaId($categoriaId): void
    {
        $this->categoriaId = $categoriaId;
    }
    public function obtenerCategoria(): Categoria
    {
        if ($this->categoria == null) $categoria = DAO::categoriaObtenerPorId($this->categoriaId);

        return $categoria;
    }

}