
<?php
    require_once "dao.php";
	// Se recoge el parámetro "id" de la request.
	$id = (int)$_REQUEST["id"];
  DAO::ejecutarConsultaEliminar("DELETE FROM categoria WHERE id=?",$id);
  redireccionar("categoria-listado.php");
