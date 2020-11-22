<?php
 require_once "_varios2.php";
 $conexion= obtenerPdoConexionBD();

 $id = (int)$_REQUEST["id"];

 $nueva_Entrada = ($id== -1);

 if($nueva_Entrada){
     $libroNombre = "<introduzca un nombre>";
     $editorial = "<Introduzca la editorial>";
     $ISBN= "<Introduzca un ISBN>";
     $establecimiento_id= "<Introduce el id de el establecimiento>";
     $reservado = false;
 }else{
     $sql = "SELECT * FROM libro WHERE id=?";
     $select = $conexion ->prepare($sql);
     $select ->execute([$id]);
     $rs = $select ->fetchAll();

     $libroNombre= $rs[0]["nombre"];
     $editorial= $rs[0]["editorial"];
     $ISBN= $rs[0]["ISBN"];
     $establecimiento_id= $rs[0]["establecimiento_id"];
     $reservado = ($rs[0]["reservado"]==1);

/*
     $sqlCategoria = "SELECT nombre FROM categoria WHERE id=?";
     $select2 = $conexion->prepare($sqlCategoria);
     $select2 ->execute([$establecimiento_Id]);
     $rs2 = $select2->fetchAll();
*/
 }

?>

<html>

<head></head>
<?php if($nueva_Entrada){ ?>
    <h1>Nuevo libro</h1>
<?php }else{ ?>
    <h1>Ficha libro</h1>
<?php } ?>

<form action="libroGuardar.php" method="post">

   <input type="hidden" name="id" value="<?=$id?>"/>

<ul>
    <li>
        <p>Nombre:</p>
        <input type="text" name="nombre" value="<?=$libroNombre?>">
        <input type="text" name="editorial" value="<?=$editorial?>">
        <input type="text" name="ISBN" value="<?=$ISBN?>">
        <input type="text" name="establecimiento_id" value="<?=$establecimiento_id?>">
        <input type="checkbox" name="reservado" <?=$reservado ? "checked" : "" ?> />
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
        <input type="submit" name="crear" value="Añadir libro" />
    <?php } else { ?>
        <input type="submit" name="guardar" value="Guardar cambios" />
    <?php } ?>

</form>

<a href="libroEliminar.php?id=<?=$id ?>">Eliminar persona</a>

<a href="libroListado.php">Volver al listado de libros.</a>
</html>
