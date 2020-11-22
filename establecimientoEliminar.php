<?php
require_once "_varios2.php";

$pdo = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$sql = "DELETE FROM establecimiento WHERE id=?";

$sentencia = $pdo->prepare($sql);
$sqlConExito = $sentencia->execute([$id]);


$correcto = ($sqlConExito && $sentencia->rowCount() == 1);
$noExistia = ($sqlConExito && $sentencia->rowCount() == 0);


?>



<html>

<head>
    <meta charset="UTF-8">
</head>



<body>

<?php if ($correcto) { ?>

    <h1>Eliminación completada</h1>
    <p>Se ha eliminado correctamente la categoría.</p>

<?php } else if ($noExistia) { ?>

    <h1>Eliminación no realizada</h1>
    <p>No existe la categoría que se pretende eliminar (quizá la eliminaron en paraleo o, ¿ha manipulado Vd. el parámetro id?).</p>

<?php } else { ?>

    <h1>Error en la eliminación</h1>
    <p>No se ha podido eliminar la categoría.</p>

<?php } ?>

<a href="establecimientoListado.php">Volver al listado de categorías.</a>

</body>

</html>
