<?php

require_once "_com/DAO.php";
$usuario=DAO::obtenerusuarioActual();

$destinatarioId= $_REQUEST["destinatarioId"];
// Comprobamos si hay sesión-usuario iniciada.
//   - Si la hay, no intervenimos. Dejamos que la pág se cargue.
//     (Mostrar info del usuario logueado y tal...)
//   - Si NO la hay, redirigimos a SesionInicioFormulario.php

if (!DAO::haySesionRamIniciada() && !DAO::intentarCanjearSesionCookie()) {
    redireccionar("SesionInicioFormulario.php");
}

?>



<html>

<head>
    <meta charset='UTF-8'>
</head>



<body>


<?php /*pintarInfoSesion();*/ ?>

<p>Sesion iniciada por <?=$usuario->getIdentificador()?></p>

<h1>Muro de <?=$usuario->getIdentificador()?></h1>

<p>/Aquí mostraremos los mensajes que hayan sido publicados para el usuario indicado como parámetro. Si no indican nada, veo los mensajes dirigidos a mí. Si indican otra cosa, veo los mensajes dirigidos a ese usuario.</p>
<?php
if($destinatarioId == null){
   $mensajes= DAO::obtenerMensajesUsuario($usuario->getIdentificador());?>
<table border="solid 1px">
   <tr>
       <td>Asunto del mensaje</td>
       <td>Contenido del mensaje</td>
   </tr>

    <?php foreach ($mensajes as $mensaje){?>
<tr>

    <td><?=$mensaje->getAsunto()?></td>
    <td><?=$mensaje->getContenido()?></td>
</tr>
<?php } ?>

</table>

    <?php
}else{
  $mensajes= DAO::obtenerMensajesUsuario($destinatarioId);
  ?>
    <table border="solid 1px">
   <tr>
       <td>Asunto del mensaje</td>
       <td>Contenido del mensaje</td>
   </tr>

    <?php foreach ($mensajes as $mensaje){?>
<tr>

    <td><?=$mensaje->getAsunto()?></td>
    <td><?=$mensaje->getContenido()?></td>
</tr>
<?php }
    }?>

</table>

<form action="Index.php" method="post">

    <p>Tu id :</p>
    <label>
        <input type="text" name="identificador" value="<?=$usuario->getIdentificador()?>">
    </label>

    <input type="submit" name="guardar" value="Ir al contenido publico 1"/><br><br>

</form>

<a href='Index.php?identificador=<?=$usuario->getIdentificador()?>'>Ir al Contenido Público 1</a>

<a href='MuroVerGlobal.php?identificador=<?=$usuario->getIdentificador()?>'>Ir al Contenido Privado 1</a>

</body>

</html>
