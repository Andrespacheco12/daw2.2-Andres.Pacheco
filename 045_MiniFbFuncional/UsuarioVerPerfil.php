<?php

require_once "_com/DAO.php";

$rs = DAO::VerFichaUsuario();

$identificador = $rs[0]["identificador"];
$nombre = $rs[0]["nombre"];
$apellidos = $rs[0]["apellidos"];
$contrasenna = $rs[0]["contrasenna"];

?>

<html lang=''>

<head>
</head>

<body>



<br><br>

<h1> Datos personales</h1>

<form action="UsuarioPerfilGuardar.php" method="post">

    <ul>
        <li>
            <p>Identificador:</p>
            <label>
                <input type="text" name="identificador" value="<?= $identificador ?>">
            </label>
            <p>Nombre:</p>
            <label>
                <input type="text" name="nombre" value="<?= $nombre ?>">
            </label>
            <p>Apellidos:</p>
            <label>
                <input type="text" name="apellidos" value="<?= $apellidos ?>">
            </label>


        </li>

    </ul>

    <input type="submit" name="guardar" value="Guardar cambios"/><br><br>



</form>

</body>
</html>
