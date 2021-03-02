<?php
require_once "_Varios.php";
$conexion= obtenerPdoConexionBD();
$clausulaWhere= "";

$tema = "negro";
$favorito= (isset($_REQUEST["estrella"]));
if($favorito ==1){
    $clausulaWhere = " WHERE p.estrella = 1";
}else {
    $clausulaWhere = "";
}
$sql = " 
               SELECT
                    p.id        AS pId,
                    p.nombre    AS pNombre,
                    p.telefono  AS pTelfono,
                    p.estrella  AS pEstrella,
                    c.id        AS cId,
                    c.nombre    AS cNombre
                                       
                FROM
                   persona AS p INNER JOIN categoria AS c
                   ON p.categoriaId = c.id $clausulaWhere
                ORDER BY p.nombre
         ";


$sentencia= $conexion->prepare($sql);
$sentencia->execute([]);
$rs=$sentencia->fetchAll();
?>

<html>

<head>
    <?php

    ?>
</head>

<body>

<h1>Listado de personas</h1>
<table border="1">
    <tr>
        <th>Nombre de la persona</th>
    </tr>
    <?php foreach ($rs as $fila){ ?>
    <?php
    if ($fila["pEstrella"]) {
        $urlImagen = "img/estrellaRellena.png";
        $parametroEstrella = "estrella";
        $soloFavoritos = "img/estrellaRellena.png";
    } else {
        $urlImagen = "img/estrellaVacia.png";
        $parametroEstrella = "";
    }

    ?>

    <td><a href="AgendaPro/persona-ficha.php?id=<?=$fila["pId"]?>"> <?=$fila["pNombre"] ?></a></td>
    <td><a href="AgendaPro/personaEstablecerEstadoEstrella.php?id=<?=$fila["pId"]?>"> <img src='<?=$urlImagen?>' width='16' height='16'></a></td>
    <td><a href="AgendaPro/persona-ficha.php?id=<?=$fila["pId"]?>"> <?=$fila["cNombre"] ?></a></td>
    <td><a href="AgendaPro/persona-ficha.php?id=<?=$fila["pId"]?>"> <?=$fila["pEstrella"] ?></a></td>
    <td><a href="AgendaPro/persona-eliminar.php?id=<?=$fila["pId"]?>"> (X)                   </a></td>

    </tr>
    <tr>


        <?php } ?>
</table>
<a href="AgendaPro/persona-ficha.php?id=-1">Crear entrada</a>
<a href="categoria-listado.php">Ver categorias</a>
</body>
</html>
