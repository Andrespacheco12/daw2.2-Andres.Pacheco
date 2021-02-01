<?php

require_once "_com/DAO.php";
?>

<html>

<body>

<h1> Introduce tus datos a continuacion</h1>

<form action='UsuarioNuevoCrear.php' method="post">

    <label for='identificador'>Identificador:</label>
    <input type='text' name='identificador'><br><br>

    <label for='contrasenna'>Contraseña:</label>
    <input type='password' name='contrasenna' id='contrasenna'><br><br>

    <label for='nombre'>Nombre:</label>
    <input type='text' name='nombre' id='nombre'><br><br>

    <label for='apellidos'>Apellidos:</label>
    <input type='text' name='apellidos' id='apellidos'><br><br>

    <input type='submit' value='Crea el usuario'>
</form>
</body>
</html>
