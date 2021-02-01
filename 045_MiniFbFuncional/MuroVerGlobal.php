<?php

require_once "_com/DAO.php";

$mensajes= DAO::obtenerTodosMensajes();
$usuario= DAO::obtenerusuarioActual();


//$rs = DAO::VerFichaUsuario();

//$identificador=$rs[0]["identificador"];


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

<form action="UsuarioVerPerfil.php" method="post">


            <label>
                <input type="hidden" name="identificador" value="<?=$usuario->getIdentificador()?>">
            </label>


    <input type="submit" name="guardar" value="Accede al perfil del usuario"/><br><br>





</form>
<?php// pintarInfoSesion(); ?>
<a href="SesionCerrar.php">Cierra sesion</a>
<h1>Muro global</h1>

<p>Aquí mostraremos todos los mensajes de todos a todos.</p>

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

<a href='MuroVerDe.php?identificador=<?=$usuario->getIdentificador()?>'>Ir a mi muro.</a>

<h1>Ver los mensajes de cual usuario</h1>

<form action="MuroVerDe.php" method="post">

            <p>Escribe el id de la persona cuyo mensaje vamos a ver :</p>
            <label>
                <input type="text" name="destinatarioId">
            </label>

            <p>Tu id :</p>
             <label>
           <input type="text" name="identificador" value="<?=$usuario->getIdentificador()?>">
                </label>

    <input type="submit" name="guardar" value="Ver mensajes del usuario"/><br><br>

</form>

<h1>Enviar mensajes a otros usuarios</h1>

    <form action="PublicacionNuevaCrear.php" method="post">

        <ul>
            <li>
                <p>Escribe el id del destinatario al que le quieres enviar :</p>
                <label>
                    <input type="text" name="destinatarioId">
                </label>

                <p>Tu id :</p>
                <label>
                    <input type="text" name="emisorId" value="<?=$usuario->getId()?>">
                </label>

                <p>Asunto del mensaje:</p>
                <label>
                    <input type="text" name="asunto">
                </label>
                <p>Contenido del mensaje:</p>
                <label>
                    <input type="text" name="contenido">
                </label>

            </li>

        </ul>

        <input type="submit" name="guardar" value="Enviar mensaje"/><br><br>





</form>
</body>

</html>
