<?php
require_once "_varios2.php";
$conexion = obtenerPdoConexionBD();

$id= $_REQUEST["id"];

$sql = "DELETE FROM libro where id=?";
$sentencia = $conexion->prepare($sql);
$sqlFunciona= $sentencia->execute([$id]);

$correcto = ($sqlFunciona && $sentencia->rowCount()== 1);
$noExiste = ($sqlFunciona && $sentencia->rowCount()==0);

?>


<html>

<head></head>

<body>

<?php if ($correcto){ ?>
    <p>El borrado se ha realizado correctamente</p>
<?php } elseif($noExiste){ ?>
    <p>No hay filas que se puedan borrar </p>
<?php }else{ ?>
    <p>No se ha podido eliminar</p>
<?php } ?>

<a href="libroListado.php">Volver al listado de libros.</a>
</body>
</html>