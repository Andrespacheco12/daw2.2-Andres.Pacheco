
window.onload = inicializaciones;
var tablaCategorias;



function inicializaciones() {
    tablaCategorias = document.getElementById("tablaCategorias");
    cargarTodasLasCategorias();

}
eliminarCategoria();
function cargarTodasLasCategorias() {
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var categorias = JSON.parse(this.responseText);
            for (var i=0; i<categorias.length; i++) {
                insertarCategoria(categorias[i]);
            }
        }
    };

    request.open("GET", "CategoriaObtenerTodas.php");
    request.send();
}

function insertarCategoria(categoria) {
    // TODO Que la categoría se inserte en el lugar que le corresponda según un orden alfabético.
    // Usar esto: https://www.w3schools.com/jsref/met_node_insertbefore.asp

    var tr = document.createElement("tr");
    var td = document.createElement("td");
    var a = document.createElement("a");
    a.setAttribute("href","CategoriaFicha.php?id=" + categoria.id);
    var textoContenido = document.createTextNode(categoria.nombre);

    a.appendChild(textoContenido);
    td.appendChild(a);
    tr.appendChild(td);
    tablaCategorias.appendChild(tr);
}

function eliminarCategoria() {

    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

           var id = JSON.parse(this.responseText);
            document.getElementById("tablaCategorias").removeChild(tablaCategorias.childNodes[id]);

        }
    };

    request.open("GET", "CategoriaEliminar.php");
    request.send();
}


function modificarCategoria(categoria) {
    // TODO Pendiente de hacer.
}

// TODO Actualizar lo local si actualizan el servidor. Poner timestamp de modificación en la tabla y pedir categoriaObtenerModificadasDesde(timestamp)