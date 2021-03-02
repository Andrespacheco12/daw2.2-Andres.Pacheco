<?php
require_once "dao.php";

$id= $_REQUEST["id"];
DAO::personaEliminar($id);
redireccionar("personaListado2.php");
