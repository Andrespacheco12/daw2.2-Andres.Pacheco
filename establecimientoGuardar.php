<?php
require_once "_varios2.php";

$pdo = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];

$nueva_entrada = ($id == -1);

if ($nueva_entrada) {

    $sql = "INSERT INTO establecimiento (nombre) VALUES (?)";
    $parametros = [$nombre];
} else {

    $sql = "UPDATE establecimiento SET nombre=? WHERE id=?";
    $parametros = [$nombre, $id];
}

$sentencia = $pdo->prepare($sql);

$sql_con_exito = $sentencia->execute($parametros);


$una_fila_afectada = ($sentencia->rowCount() == 1);
$ninguna_fila_afectada = ($sentencia->rowCount() == 0);


$correcto = ($sql_con_exito && $una_fila_afectada);

$datos_no_modificados = ($sql_con_exito && $ninguna_fila_afectada);
?>



<html>

<head>
    <meta charset="UTF-8">
</head>



<body>

<?php
// Todo bien tanto si se han guardado los datos nuevos como si no se habían modificado.
if ($correcto || $datos_no_modificados) { ?>

    <?php if ($id == -1) { ?>
        <h1>Inserción completada</h1>
        <p>Se ha insertado correctamente la nueva entrada de <?php echo $nombre; ?>.</p>
    <?php } else { ?>
        <h1>Guardado completado</h1>
        <p>Se han guardado correctamente los datos de <?php echo $nombre; ?>.</p>

        <?php if ($datos_no_modificados) { ?>
            <p>En realidad, no había modificado nada, pero no está de más que se haya asegurado pulsando el botón de guardar :)</p>
        <?php } ?>
    <?php }
    ?>

    <?php
} else {
    ?>

    <h1>Error en la modificación.</h1>
    <p>No se han podido guardar los datos de la categoría.</p>

    <?php
}
?>

<a href="establecimientoListado.php">Vuelve al listado de establecimientos</a>

</body>

</html>