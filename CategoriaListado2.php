<?php
    require_once "dao.php";
    require_once "clases.php";
   $categorias= DAO::categoriaObtenerTodas();
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
    foreach ($categorias as $categoria) { ?>
        <tr>
            <td><a href="CategoriaFicha2.php?id=<?=$categoria->getId()?>"> <?=$categoria ->getNombre() ?> </a></td>
            <td><a href="CategoriaEliminar2.php?id=<?=$categoria->getId()?>"> (X)</a></td>
        </tr>
    <?php } ?>

</table>

<br />

<a href="CategoriaFicha2.php?id=-1">Crear entrada</a>

<br />
<br />

<a href="personaListado2.php">Gestionar listado de Personas</a>

</body>

</html>