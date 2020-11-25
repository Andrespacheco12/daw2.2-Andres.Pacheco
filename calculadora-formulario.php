<?php
?>

<html>
<head>

</head>
<body>

<form action="calculadora-resultado.php" method="get">
    <input type="number" name="operando1">
    <select name="operacion" id="operacion">
        <option value="sum">sum</option>
        <option value="res">res</option>
        <option value="mul">mul</option>
        <option value="div">div</option>
    </select>
    <input type="number" name="operando2">
    <input type="submit" name="enviar">
</form>

</body>

</html>
