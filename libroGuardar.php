<?php
require_once "_varios2.php";
$conexion=obtenerPdoConexionBD();

$id= (int)$_REQUEST["id"];
$nombre= $_REQUEST["nombre"];
$editorial= $_REQUEST["editorial"];
$ISBN = $_REQUEST["ISBN"];
$establecimiento_id= (int)$_REQUEST["establecimiento_id"];
$reservado = ISSET($_REQUEST["reservado"]);

$nuevaEntrada= ($id== -1);

if($nuevaEntrada){
    $sql= "INSERT INTO libro (nombre,editorial,ISBN,establecimiento_id,reservado) VALUES(?,?,?,?,?)";
    $parametros = [$nombre,$editorial,$ISBN,$establecimiento_id, $reservado?1:0];
}else{
    $sql= "UPDATE libro SET nombre=?,editorial=?,ISBN=?,establecimiento_id=?,reservado=? WHERE id=?";
    $parametros = [$nombre,$editorial,$ISBN,$establecimiento_id,$reservado?1:0,$id];
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
        <p>Se ha introducido el libro correctamente </p>
        <p>Se ha introducido correctamente el nuevo libro con nombre <?php echo $nombre; ?>.</p>
    <?php }else{?>
        <h1>Se ha guardado correctamente</h1>
        <p>Se han guardado correctamente lo introducido sobre <?php echo $nombre; ?>.</p>
    <?php    }
    if($ningunCambio){ ?>
        <p>No se ha modificado nada</p>
    <?php }
}else{ ?>
    <p>Ha ocurrido un error al modificar los datos del libro</p>
<?php }
?>

<a href="libroListado.php">Volver al listado de libros.</a>

</body>
</html>

