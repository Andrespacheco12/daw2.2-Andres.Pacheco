<?php
    require_once "_Varios.php";
    // TODO cerrar utilizando la función de _Varios.php y redirigir a contenido público 1.
    borrarCookieRecordar();
cerrarSesion();
    redireccionar("ContenidoPublico1.php");
?>
