<?php
require_once "_Varios2.php";

$pdo = obtenerPdoConexionBD();

$id = (int)$_REQUEST["id"];

$nueva_entrada = ($id == -1);

if ($nueva_entrada) {
    $establecimiento_nombre = "<introduzca nombre>";
} else {
    $sql = "SELECT nombre FROM establecimiento WHERE id=?";

    $select = $pdo->prepare($sql);
    $select->execute([$id]);
    $rs = $select->fetchAll();

    $establecimiento_nombre = $rs[0]["nombre"];
}



$sql = "SELECT nombre, editorial FROM libro WHERE establecimiento_id=? ORDER BY nombre";

$select = $pdo->prepare($sql);
$select->execute([$id]);
$rs2 = $select->fetchAll();

?>



<html>

<head>
    <meta charset="UTF-8">
</head>



<body>

<?php if ($nueva_entrada) { ?>
    <h1>Nueva ficha del establecimiento</h1>
<?php } else { ?>
    <h1>Ficha del establecimiento</h1>
<?php } ?>

<form method="post" action="establecimientoGuardar.php">

    <input type="hidden" name="id" value="<?=$id?>" />

    <ul>
        <li>
            <strong>Nombre: </strong>
            <input type="text" name="nombre" value="<?=$establecimiento_nombre?>" />
        </li>
 <h3>Lista de libros de este establecimiento</h3>
        <?php  foreach ($rs2 as $fila2){ ?>

            <li> <a href=   "establecimientoFicha.php?id=<?=$fila2["id"]?>">El nombre del libro es: <?=$fila2["nombre"] ?>   y su editorial es---<?=$fila2["editorial"] ?> </a> </li>

        <?php } ?>

    </ul>

    <?php if ($nueva_entrada) { ?>
        <input type="submit" name="crear" value="Crear local" />
    <?php } else { ?>
        <input type="submit" name="guardar" value="Guardar cambios" />
    <?php } ?>

</form>

<br />

<a href="establecimientoEliminar.php?id=<?=$id ?>">Eliminar local</a>

<br />
<br />

<a href="establecimientoListado.php">Volver al listado de locales.</a>

</body>

</html>