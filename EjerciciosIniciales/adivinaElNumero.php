<?php


    $numeroSecreto = $_REQUEST["numeroSecreto"];
    $intento = $_REQUEST["intento"];
    $numeroIntentos= $_REQUEST["numeroIntentos"];


?>
<?php
if ($numeroSecreto > $intento) {
echo "el numero secreto es mayor al del intento";
 $numeroIntentos++;
} elseif ($numeroSecreto  == $intento) {
echo "el numero secreto es igual al del intento";
?>
<p> El numero de intentos es: <?=$numeroIntentos?></p>
<?php
} else {
echo "el numero secreto es menor al del intento";
    $numeroIntentos++;
}
if($numeroIntentos > 4){
    echo "Perdiste";
    header('Location: mandaNumero.php');
}
?>
<html>
<head>
</head>
<body>

  <!--  <input type="hidden" id="numero" name="numero" value="4">-->

<form action="" method="get">
    <p> Introduce el segundo intento</p>
    <input type='text' name='intento'  />
    <input name='numeroSecreto' type='hidden' value='<?=$numeroSecreto?>'>
    <input name='numeroIntentos' value='<?=$numeroIntentos?>'>
    <input type='submit' name='boton' value="Enviar" />
</form>


</body>
</html>