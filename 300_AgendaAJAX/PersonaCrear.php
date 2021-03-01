<?php

require_once "_com/DAO.php";

$persona = DAO::personaCrear($_REQUEST["nombre"],$_REQUEST["categoriaId"]);

echo json_encode($persona);

