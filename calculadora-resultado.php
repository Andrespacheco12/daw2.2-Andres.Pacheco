<?php
$operando1 = $_REQUEST["operando1"];
$operacion= $_REQUEST["operacion"];
$operando2 = $_REQUEST["operando2"];
//$errorDivCero=$_REQUEST["errorDivCero"];
$resultado =0;
$depositado =0;
$errorDivCero = false;

if($operacion == "sum"){
    $resultado = $operando1 + $operando2;
}elseif ($operacion == "res"){
    $resultado = $operando1 - $operando2;
}elseif ($operacion == "mul"){
    $resultado = $operando1 * $operando2;
}elseif($operacion == "div"){
    $resultado = $operando1 / $operando2;
}
$depositado=$resultado;
if($operacion == "div" && $operando2 == 0){
    $errorDivCero =true;

}else{
    $errorDivCero =false;

}
?>
<html>

<head></head>
<body>

<p><?=$operando1?> <?php echo "$operacion" ?> <?=$operando2?> = <?=$depositado?></p>
<?php if($operacion == "div") {?>
<p> Hay error de division entre cero? <?php if($errorDivCero == true){
    echo "si";
    }else{
    echo "no";
    }
        ?></p>
<?php }?>
</body>
</html>


