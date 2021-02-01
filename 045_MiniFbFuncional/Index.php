<?php

require_once "_com/DAO.php";
$usuario=DAO::obtenerusuarioActual();

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>


<p>Sesion iniciada por <?=$usuario->getIdentificador()?></p>

<h1>MiniFb</h1>

<p>¡Bienvenido al MiniFb!</p>
<p>Esto es una red social en la que bla, bla, bla, bla.</p>
<p>Crea tu cuenta y participa.</p>

<a href='MuroVerGlobal.php?identificador=<?=$usuario->getIdentificador()?>'>Mira el muro global si ya tienes una cuenta.</a>

</body>

</html>
