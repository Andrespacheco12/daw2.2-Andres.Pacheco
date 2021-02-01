<?php

require_once "_com/DAO.php";

$arrayUsuario["identificador"] = $_REQUEST["identificador"];
$arrayUsuario["contrasenna"] = $_REQUEST["contrasenna"];
$arrayUsuario["nombre"]=$_REQUEST["nombre"];
$arrayUsuario["apellidos"]=$_REQUEST["apellidos"];
//$id=$_REQUEST["id"];
//$tipoUsuario=$_REQUEST["tipoUsuario"];

//$arrayUsuario=[$identificador,$contrasenna,$nombre,$apellidos];
$usuario= DAO::UsuarioCrear($arrayUsuario);

if($usuario){
    redireccionar("SesionInicioFormulario.php");
}else{
    redireccionar("UsuarioNuevoFormulario.php");
}

