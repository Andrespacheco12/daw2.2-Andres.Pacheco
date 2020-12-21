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

}
