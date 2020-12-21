<?php
require_once "dao.php";


$rs =DAO::devuelveTodasCategorias("SELECT id, nombre FROM categoria ORDER BY nombre");

?>



<html>

<head>
    <meta charset="UTF-8">
</head>



<body>

<h1>Listado de Categorías</h1>

<table border="1">

    <tr>
        <th>Nombre</th>
    </tr>

    <?php
    foreach ($rs as $fila) { ?>
        <tr>
            <td><a href=   "CategoriaFicha2.php?id=<?=$fila["id"]?>"> <?=$fila["nombre"] ?> </a></td>
            <td><a href="CategoriaEliminar2.php?id=<?=$fila["id"]?>"> (X)                   </a></td>
        </tr>
    <?php } ?>

</table>

<br />

<a href="CategoriaFicha2.php ?id=-1">Crear entrada</a>

<br />
<br />

<a href="persona-listado.php">Gestionar listado de Personas</a>

</body>

</html>