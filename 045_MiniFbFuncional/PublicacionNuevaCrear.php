
<?php

require_once "_com/DAO.php";

$publicacion["destinatarioId"]=$_REQUEST["destinatarioId"];
$publicacion["emisorId"]=$_REQUEST["emisorId"];
$publicacion["asunto"]=$_REQUEST["asunto"];
$publicacion["contenido"]=$_REQUEST["contenido"];

$publicacion= DAO::PublicacionCrear($publicacion);