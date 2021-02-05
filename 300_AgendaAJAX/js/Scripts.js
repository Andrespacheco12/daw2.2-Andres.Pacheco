
window.onload = inicializaciones;

function inicializaciones() {
    cargarTodasLasCategorias();
}

function cargarTodasLasCategorias() {
    // TODO v0.9 Obtener el JSON con UNA categoría.
    // TODO v1.0 Obtener el JSON con un ARRAY de categorías.




    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           var categoria = JSON.parse(this.responseText);
          //  alert(categoria.id + categoria.nombre);

            document.getElementById("fila1").innerHTML +=(categoria.id);
            document.getElementById("fila1.2").innerHTML +=(categoria.nombre);
        }
    };
    xmlhttp.open("GET", "CategoriaObtenerTodas.php", true);
    xmlhttp.send();
    // TODO Adaptar/traducir esto a Javascript/DOM/etc.
    // <?php foreach ($categorias as $categoria) { ?>
    //     <tr>
    // <td><a href='CategoriaFicha.php?id=<?=$categoria->getId()?>'>    <?=$categoria->getNombre()?> </a></td>
    // <td><a href='CategoriaEliminar.php?id=<?=$categoria->getId()?>'> (X)                            </a></td>
    // </tr>
    // <?php } ?>
}