<?php
 require_once "_varios.php";
 $conexion= obtenerPdoConexionBD();

 $id = (int)$_REQUEST["id"];

 $nueva_Entrada = ($id== -1);

 if($nueva_Entrada){
     $personaNombre = "<introduzca un nombre>";
     $telefono= "<Introduzca un telefono>";
     $categoria_id= "<Introduce el id de la categoria>";
 }else{
     $sql = "SELECT nombre, telefono , categoria_id FROM persona WHERE id=?";
     $select = $conexion ->prepare($sql);
     $select ->execute([$id]);
     $rs = $select ->fetchAll();

     $personaNombre= $rs[0]["nombre"];
     $personaNombre= $rs[0]["telefono"];
     $personaNombre= $rs[0]["categoria_id"];
 }

?>

<html>

<head></head>
<?php if($nueva_Entrada){ ?>
    <h1>Nueva persona</h1>
<?php }else{ ?>
    <h1>Ficha persona</h1>
<?php } ?>

<form action="persona-guardar.php" method="post">

   <input type="hidden" name="id" value="<?=$id?>"/>

<ul>
    <li>
        <p>Nombre:</p>
        <input type="text" name="nombre" value="<?=$personaNombre?>">
        <input type="text" name="telefono" value="<?=$telefono?>">
        <input type="text" name="categoria_id" value="<?=$categoria_id?>">
    </li>

</ul>
    <?php if ($nueva_Entrada) { ?>
        <input type="submit" name="crear" value="Añadir persona" />
    <?php } else { ?>
        <input type="submit" name="guardar" value="Guardar cambios" />
    <?php } ?>

</form>

<a href="persona-eliminar.php?id=<?=$id ?>">Eliminar persona</a>

<a href="persona-listado.php">Volver al listado de categorías.</a>
</html>