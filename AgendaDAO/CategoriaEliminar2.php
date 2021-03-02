
<?php
    require_once "dao.php";

  $id = (int)$_REQUEST["id"];

  DAO::categoriaEliminar($id);;
  redireccionar("CategoriaListado2.php");
