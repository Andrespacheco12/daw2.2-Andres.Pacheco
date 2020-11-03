<?php
   require_once "_varios.php";
   $conexion= obtenerPdoConexionBD();

   $sql= "SELECT id, nombre, telefono, categoria_id FROM persona order by nombre";
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
            <td><a href=   "persona-ficha.php?id=<?=$fila["id"]?>"> <?=$fila["nombre"] ?></a></td>
            <td><a href=   "persona-ficha.php?id=<?=$fila["id"]?>"> <?=$fila["telefono"] ?> </a></td>
            <td><a href=   "persona-ficha.php?id=<?=$fila["id"]?>"> <?=$fila["categoria_id"] ?> </a></td>
            <td><a href="persona-eliminar.php?id=<?=$fila["id"]?>"> (X)                   </a></td>
        </tr>
    <tr>


<?php } ?>
</table>
<a href="persona-ficha.php?id=-1">Crear entrada</a>
</body>
</html>
