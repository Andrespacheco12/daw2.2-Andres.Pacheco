<?php
 require_once "_varios.php";
 $conexion= obtenerPdoConexionBD();

 $id = (int)$_REQUEST["id"];

 $nueva_Entrada = ($id== -1);

 if($nueva_Entrada){
     $personaNombre = "<introduzca un nombre>";
     $apellidos = "<Introduzca los apellidos>";
     $telefono= "<Introduzca un telefono>";
     $categoriaId= "<Introduce el id de la categoria>";
     $estrella = false;
 }else{
     $sql = "SELECT * FROM persona WHERE id=?";
     $select = $conexion ->prepare($sql);
     $select ->execute([$id]);
     $rs = $select ->fetchAll();

     $personaNombre= $rs[0]["nombre"];
     $apellidos= $rs[0]["apellidos"];
     $telefono= $rs[0]["telefono"];
     $categoriaId= $rs[0]["categoriaId"];
     $estrella = ($rs[0]["estrella"]==1);


     $sqlCategoria = "SELECT nombre FROM categoria WHERE id=?";
     $select2 = $conexion->prepare($sqlCategoria);
     $select2 ->execute([$categoriaId]);
     $rs2 = $select2->fetchAll();
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
        <input type="text" name="apellidos" value="<?=$apellidos?>">
        <input type="text" name="telefono" value="<?=$telefono?>">
        <input type="text" name="categoriaId" value="<?=$categoriaId?>">
        <input type="checkbox" name="estrella" <?=$estrella ? "checked" : "" ?> />
<?php /*
 <select>
     <option value="-1" name="Selecciona un campo"></option>

        <?php  foreach($rs2 as $categoriaId=> $fila2 ){
            $categoria_nombre = $fila2["nombre"];
       echo " <option value='$categoriaId'>$categoria_nombre</option> ";

        }?>

 </select>
*/ ?>
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