<?php
	require_once "_com/DAO.php";

	$id = $_REQUEST["id"];
	//DAO::categoriaEliminar($id);
        echo json_encode($id);
	redireccionar("Agenda.html");

	?>
