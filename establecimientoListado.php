<?php
require_once "_varios2.php";

$pdo = obtenerPdoConexionBD();

$sql = "SELECT id, nombre FROM establecimiento ORDER BY nombre";
$select = $pdo->prepare($sql);
$select->execute([]); // Array vacío porque la consulta preparada no requiere parámetros.
$rs = $select->fetchAll();
?>



<html>

<head>
    <meta charset="UTF-8">
</head>



<body>

<h1>Listado de Establecimientos </h1>

<table border="1">

    <tr>
        <th>Nombre</th>
    </tr>

    <?php
    foreach ($rs as $fila) { ?>
        <tr>
            <td><a href= "establecimientoFicha.php?id=<?=$fila["id"]?>"> <?=$fila["nombre"] ?> </a></td>
            <td><a href="establecimientoEliminar.php?id=<?=$fila["id"]?>"> (X)                   </a></td>
        </tr>
    <?php } ?>

</table>

<br />

<a href="establecimientoFicha.php?id=-1">Crear entrada</a>

<br />
<br />

<a href="libroListado.php">Gestionar listado de libros</a>

</body>

</html>