<?php

require_once "_com/DAO.php";

$identificador = $_REQUEST["identificador"];
$nombre = $_REQUEST["nombre"];
$apellidos = $_REQUEST["apellidos"];
$modificacion=DAO::usuarioModificar();
?>

<html>
<head></head>
<body>
<?php
if($modificacion){?>
<h1>El usuario se ha modificado correctamente</h1>
<?php}else{?>
<h1>Ha ocurrido algun error al modificar el usuario</h1>

    <?php
}
?>
<a href="MuroVerGlobal.php?identificador=<?=$identificador?>">Volver al contenido privado</a>
</body>
</html>
