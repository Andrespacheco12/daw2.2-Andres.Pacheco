<?php
$color = $_REQUEST["color"];
$id= $_REQUEST["id"];
?>

<html>
<head>
    <style>
        p{
        <?php if($color == "azul") { ?> color:blue;
        <?php }else if($color == "naranja"){ ?> color: orange;
        <?php }else if($color == "rojo"){ ?> color: red;
        <?php }else if($color == "verde"){ ?> color:green;
        <?php } ?>
    </style>
<body>
<p> El color que ha salido es <?=$color ?>.</p>


</body>
</head>
</html>