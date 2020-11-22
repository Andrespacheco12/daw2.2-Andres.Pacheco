<?php
require_once "_varios2.php";
$conexion= obtenerPdoConexionBD();

 session_start();
if (isset($_REQUEST["soloReservado"])) {
    $_SESSION["soloReservado"] = true;
}
if (isset($_REQUEST["listadoEntero"])) {
    unset($_SESSION["soloReservado"]);
}

$ClausulaWhere = isset($_SESSION["soloReservado"]) ? "WHERE l.reservado=1" : "";
$sql = " 
               SELECT
                    l.id        AS lId,
                    l.nombre    AS lNombre,
                    l.editorial  AS lEditorial,
                    l.ISBN AS lISBN,
                    l.reservado AS lReservado,
                    e.id        AS eId,
                    e.nombre    AS eNombre
                   
                FROM
                   libro AS l INNER JOIN establecimiento AS e
                   ON l.establecimiento_id = e.id 
                   $ClausulaWhere
                ORDER BY l.nombre
         ";


$sentencia= $conexion->prepare($sql);
$sentencia->execute([]);
$rs=$sentencia->fetchAll();
?>

<html>

<head></head>

<br>

<h1>Listado de libros</h1>
<table border="1">
    <tr>
        <th>Nombre del libro</th>
        <th>Editorial</th>
        <th>ISBN</th>
        <th>Nombre del establecimiento </th>
    </tr>
    <?php foreach ($rs as $fila){ ?>

    <td><a href="libroFicha.php?id=<?=$fila["lId"]?>"> <?=$fila["lNombre"] ?></a></td>

    <td><a href="libroFicha.php?id=<?=$fila["lId"]?>"> <?=$fila["lEditorial"] ?></a></td>
    <td><a href="libroFicha.php?id=<?=$fila["lId"]?>"> <?=$fila["lISBN"] ?></a></td>
    <td><a href="libroFicha.php?id=<?=$fila["lId"]?>"> <?=$fila["eNombre"] ?></a></td>
    <td>
    <?php

    if ($fila["lReservado"]) {
        $urlImagen = "reservado.png";
        $parametroEstrella = "reservado";
     //   $soloFavoritos = "img/estrellaRellena.png";
    } else {
        $urlImagen = "libros.png";
        $parametroEstrella = "";
    }
    echo " <a href='libroEstablecerReservado.php?id=$fila[lId]'><img src='$urlImagen' width='35' height='35'></a>";
    ?>
    </td>
    <td><a href="libroFicha.php?id=<?=$fila["lId"]?>"> <?=$fila["lReservado"] ?></a></td>
    <td><a href="libroEliminar.php?id=<?=$fila["lId"]?>"> (X)                   </a></td>

    </tr>
    <tr>


        <?php } ?>
</table>
<?php if (!isset($_SESSION["soloReservado"])) {?>
    <a href='libroListado.php?soloReservado'>Mostrar solo los libros reservados</a>
<?php } else { ?>
    <a href='libroListado.php?listadoEntero'>Mostrar todos los libros</a>
<?php } ?>
<br>
<a href="libroFicha.php?id=-1">Crear entrada</a>
<br>
<a href="establecimientoListado.php">Ver listado de establecimientos</a>
</body>
</html>
