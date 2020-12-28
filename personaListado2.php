<?php
require_once "dao.php";
require_once "clases.php";

$personas= DAO::personaObtenerTodas();
?>
<html>
<head>
</head>

<body>

<h1>Listado de personas</h1>
<table border="1">
    <tr>
        <th>Nombre de la persona</th>
    </tr>
    <?php foreach ($personas as $persona){ ?>
   <?php
    if ($persona->getEstrella()) {
                        $urlImagen = "img/estrellaRellena.png";
                        $parametroEstrella = "estrella";
                        $soloFavoritos = "img/estrellaRellena.png";
                    } else {
                        $urlImagen = "img/estrellaVacia.png";
                        $parametroEstrella = "";
                    }

    ?>

    <td><a href="fichaPersona2.php?id=<?=$persona->getId()?>"> <?=$persona->getNombre() ?></a></td>
    <td><a href="fichaPersona2.php?id=<?=$persona->getId()?>"> <?=$persona->getApellidos() ?></a></td>
    <td><a href="fichaPersona2.php?id=<?=$persona->getId()?>"> <?=$persona->getTelefono() ?></a></td>
    <td><a href="personaEstablecerEstadoEstrella.php?estrella= <?=$persona->getEstrella()?>"> <img src='<?=$urlImagen?>' width='16' height='16'></a></td>
    <td><a href="fichaPersona2.php?id=<?=$persona->getId()?>"> <?=$persona->getcategoriaId() ?></a></td>

    <td><a href="personaEliminar2.php?id=<?=$persona->getId()?>"> (X)                   </a></td>

        </tr>
    <tr>


<?php } ?>
</table>

</body>

<a href="fichaPersona2.php?id=-1">Crear entrada</a>

<br />
<br />

<a href="CategoriaListado2.php">Gestionar listado de Personas</a>

</html>

