<?php


require_once "_com/DAO.php";

$identificador = $_REQUEST["identificador"];
$contrasenna = $_REQUEST["contrasenna"];

$arrayUsuario = DAO::obtenerUsuario($identificador, $contrasenna);
DAO:: marcarSesionComoIniciada($arrayUsuario);
if ($arrayUsuario) {?>
    <h1>Confirma si estos son tus datos</h1>

    <form action="MuroVerGlobal.php" method="post">



                <p>Tu identificador :</p>
                <label>
                    <input type="text" name="identificador" value="<?=$identificador?>">
                </label>

                <p>Tu contraseña:</p>
                <label>
                    <input type="text" name="contrasenna" value="<?=$contrasenna?>">
                </label>


        <input type="submit" name="guardar" value="Sigue adelante"/><br><br>

</form>
<?php
    if (isset($_REQUEST["recordar"])) {
        DAO:: generarCookieRecordar($arrayUsuario);
    }

} else {
    redireccionar("SesionInicioFormulario.php?datosErroneos");
}
?>