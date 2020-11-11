<?php
   require_once "_varios.php";
   $conexion= obtenerPdoConexionBD();
   //$where = " WHERE pEstrella = 1";
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
                   ON p.categoriaId = c.id
                ORDER BY p.nombre
         ";
// . $where ;

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

            <td><a href="persona-ficha.php?id=<?=$fila["pId"]?>"> <?=$fila["pNombre"] ?></a></td>
         <td><a href='personaEstablecerEstadoEstrella.php?$parametroEstrella'><img src='<?=$urlImagen?>' width='16' height='16'></a></td>

            <td><a href="persona-ficha.php?id=<?=$fila["pId"]?>"> <?=$fila["cNombre"] ?></a></td>
            <td><a href="persona-ficha.php?id=<?=$fila["pId"]?>"> <?=$fila["pEstrella"] ?></a></td>
            <td><a href="persona-eliminar.php?id=<?=$fila["pId"]?>"> (X)                   </a></td>

        </tr>
    <tr>


<?php } ?>
</table>
<a href="persona-ficha.php?id=-1">Crear entrada</a>
</body>
</html>
