<?php

require_once "dao.php";

$id= (int)$_REQUEST["id"];
$nombre= $_REQUEST["nombre"];
$apellidos= $_REQUEST["apellidos"];
$telefono = $_REQUEST["telefono"];
$categoriaId= (int)$_REQUEST["categoriaId"];
$estrella = ISSET($_REQUEST["estrella"]);

$nuevaEntrada= ($id== -1);

if($nuevaEntrada){
  DAO::personaGuardar();
  redireccionar("personaListado2.php");
}else{
  DAO::personaModificar();
    redireccionar("personaListado2.php");
}

?>

