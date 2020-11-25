<?php

$colores = [1 => "naranja",
    2 => "verde",
    3 => "rojo",
    4 => "azul",
]; ?>

<html>
<head>
    <body>

<style>

    /*
    for($i=0; i < sizeof($colores);$i++){
    color:$colores[i];
    }*/

</style>


<form action='muestraColor.php' method='get'>
    <select name = "color">
    <option value="-1"> Elige color</option>
    <?php
    foreach ($colores as $id => $color ){
        // si tenia aqui $id de valor me salia como resultado en pantalla el id del color
        echo "<option value ='$color'> $color </option>/n";
    }
    ?>
   <!-- <input type='text' name='color' /> -->
    <input type='submit' name='boton' value="Enviar" />
</form>
</select>
</body>
</head>
</html>
