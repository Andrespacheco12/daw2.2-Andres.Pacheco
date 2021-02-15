<?php
require_once "_com/DAO.php";

$categoria = DAO::categoriaGuardar($_REQUEST["nombre"]);

echo json_encode($categoria);
redireccionar("Agenda.html");
?>