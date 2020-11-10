<?php
require_once "_varios.php";
$conexion=obtenerPdoConexionBD();

$id= (int)$_REQUEST["id"];
$nombre= $_REQUEST["nombre"];
$apellidos= $_REQUEST["apellidos"];
$telefono = $_REQUEST["telefono"];
$categoriaId= (int)$_REQUEST["categoriaId"];

$nuevaEntrada= ($id== -1);

if($nuevaEntrada){
    $sql= "INSERT INTO persona (nombre,apellidos,telefono,categoriaId) VALUES(?,?,?,?)";
    $parametros = [$nombre,$apellidos,$telefono,$categoriaId];
}else{
    $sql= "UPDATE persona SET nombre=?,apellidos=?,telefono=?,categoriaId=? WHERE id=?";
    $parametros = [$nombre,$apellidos,$telefono,$categoriaId,$id];
}

$sentencia = $conexion->prepare($sql);
$sqlCorrecto= $sentencia->execute($parametros);

$unaFilaAfectada =( $sentencia->rowCount()==1);
$ningunaFilaAfectada = ($sentencia->rowCount()==0);

$bien =($sqlCorrecto && $unaFilaAfectada);
$ningunCambio =($sqlCorrecto && $ningunaFilaAfectada);
?>

<html>

<head></head>

<body>

<?php if( $bien || $ningunCambio){
    if($id == -1){ ?>
        <p>Se ha introducido la persona correctamente </p>
        <p>Se ha introducido correctamente la nueva persona con nombre <?php echo $nombre; ?>.</p>
    <?php }else{?>
<h1>Se ha guardado correctamente</h1>
<p>Se han guardado correctamente lo introducido sobre <?php echo $nombre; ?>.</p>
<?php    }
if($ningunCambio){ ?>
    <p>No se ha modificado nada</p>
<?php }
}else{ ?>
<p>Ha ocurrido un error al modificar los datos de la persona</p>
<?php }
?>

<a href="persona-listado.php">Volver al listado de categorías.</a>

</body>
</html>


