<?php
   require_once "_varios.php";
   $conexion= obtenerPdoConexionBD();

$sql = " 
               SELECT
                    p.id        AS pId,
                    p.nombre    AS pNombre,
                    c.id        AS cId,
                    c.nombre    AS cNombre
                FROM
                   persona AS p INNER JOIN categoria AS c
                   ON p.categoriaId = c.id
                ORDER BY p.nombre
        ";

$sentencia= $conexion->prepare($sql);
   $sentencia->execute([]);
   $rs=$sentencia->fetchAll();
?>

<html>

<head></head>

<body>

<h1>Listado de personas</h1>
<table border="1">
    <tr>
        <th>Nombre de la persona</th>
    </tr>
    <?php foreach ($rs as $fila){ ?>
        <tr>
            <td><a href="persona-ficha.php?id=<?=$fila["pId"]?>"> <?=$fila["pNombre"] ?></a></td>
            <td><a href="persona-ficha.php?id=<?=$fila["pId"]?>"> <?=$fila["cNombre"] ?></a></td>
            <td><a href="persona-eliminar.php?id=<?=$fila["pId"]?>"> (X)                   </a></td>

        </tr>
    <tr>


<?php } ?>
</table>
<a href="persona-ficha.php?id=-1">Crear entrada</a>
</body>
</html>
