<?php

require_once "_com/DAO.php";

DAO::cerrarSesionRamYCookie();

redireccionar("SesionInicioFormulario.php");