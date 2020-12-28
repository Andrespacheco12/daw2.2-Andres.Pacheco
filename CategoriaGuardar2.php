<?php
require_once "dao.php";

$id = (int)$_REQUEST["id"];
$nombre = $_REQUEST["nombre"];

$nueva_entrada = ($id == -1);

if ($nueva_entrada) {
    DAO::categoriaGuardar();
    redireccionar("CategoriaListado2.php");
} else {
    // Quieren MODIFICAR una categoría existente y es un UPDATE.

    DAO::categoriaModificar();
    redireccionar("CategoriaListado2.php");
}



