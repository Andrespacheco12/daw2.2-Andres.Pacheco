<?php


if (!isset($_REQUEST["acumulado"]) || isset($_REQUEST["reset"])) { // Si NO hay formulario enviado (1ª vez), o piden resetear.
    $menos=0;
    $acumulado = $_REQUEST["menos"];

} else { // Sí hay formulario enviado (2ª ó siguientes veces).
    $acumulado = (int) $_REQUEST["acumulado"] + 1;

}
if (!isset($_REQUEST["menos"]) || isset($_REQUEST["reset"])) { // Si NO hay formulario enviado (1ª vez), o piden resetear.
    $menos =$acumulado;

} else { // Sí hay formulario enviado (2ª ó siguientes veces).
    $menos = (int) $_REQUEST["menos"] -1;

}


if (!isset($_REQUEST["acumuladoN"]) || isset($_REQUEST["reset"])) { // Si NO hay formulario enviado (1ª vez), o piden resetear.
$acumuladoN=0;
} else { // Sí hay formulario enviado (2ª ó siguientes veces).
    $numero= (int) $_REQUEST["numero"] ;
$acumuladoN=(int) $_REQUEST["acumuladoN"] + $numero;

}


if (!isset($_REQUEST["restaN"]) || isset($_REQUEST["reset"])) { // Si NO hay formulario enviado (1ª vez), o piden resetear.
$restaN=0;
} else { // Sí hay formulario enviado (2ª ó siguientes veces).
    $numero2= (int) $_REQUEST["numero2"] ;
    $restaN=(int) $acumuladoN - $numero2;
    $acumuladoN=$restaN;

}
?>



<html>
<h2> Primero incrementacion y resta de un numero</h2>
<form method='get'>

    <input type='text' name='acumulado' value='<?=$acumulado?>'>

    <input type='submit' value='+1' name='suma'>

    <br /><br />

    <input type='submit' value='Resetear' name='reset'>

    <br /><br />


</form>
<form method= 'get'>
    <input type='text' name='menos' value='<?=$menos?>'>

    <input type='submit' value='-1' name='resta'>

    <br /><br />
</form>
<H2>Incrementacion y resta en funcion de n</H2>
<form method='get'>
    <input type='text' name='numero'  />
    <input type='text' name='acumuladoN' value='<?=$acumuladoN?>' />
    <input type='submit' name='boton' value="+" />


    <input type='text' name='numero2'  />
    <input type='text' name='restaN' value='<?=$restaN?>' />
    <input type='submit' name='boton' value="-" />
</form>

</html>