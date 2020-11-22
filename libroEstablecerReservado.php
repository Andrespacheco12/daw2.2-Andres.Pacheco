<?php
require_once "_varios2.php";
$conexion = obtenerPdoConexionBD();

$id=$_REQUEST["id"];

$sql = "UPDATE libro SET reservado = (NOT (SELECT reservado FROM libro WHERE id=?)) WHERE id=?";
$parametros = [$id,$id];

$sentencia = $conexion->prepare($sql);
 $sentencia->execute($parametros);

redireccionar("libroListado.php");

?>
