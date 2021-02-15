
window.onload = inicializaciones;
var tablaCategorias;
document.getElementById("eliminaBoton").addEventListener("click",eliminarCategoria);
document.getElementById("submitCrearCategoria").addEventListener("click",creaCategoria);
document.getElementById("verFichaa").addEventListener("click",verFicha);

/*
var tab = document.getElementById("tablaCategorias");
tab.getElementsByTagName("td")[1].style.display = "none";
*/
function inicializaciones() {
    tablaCategorias = document.getElementById("tablaCategorias");
    cargarTodasLasCategorias();

}

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
   // var tr2= document.createElement("tr");
    var td = document.createElement("td");
    var td2= document.createElement("td");
    td2.id= "columna";

    var a = document.createElement("a");
    var input= document.createElement("input");
    input.value = categoria.nombre;
    a.setAttribute("id","enlace");
    a.setAttribute("href","CategoriaFicha.php?id="+categoria.id);

    var textoContenido = document.createTextNode(categoria.nombre);

    a.appendChild(textoContenido);
    td.appendChild(a);
    td2.appendChild(input);
    tr.appendChild(td);
    tr.appendChild(td2);
    tablaCategorias.appendChild(tr);
 //   tablaCategorias.appendChild(tr2);
}
function creaCategoria(){
    var request = new XMLHttpRequest();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            var categoria= JSON.parse(this.responseText);
            insertarCategoria(categoria);
        }
    };

    request.open("GET", "CategoriaCrear.php");
    request.send();

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

function verFicha(){
        var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {
                var ficha= JSON.parse(this.responseText);

                        var tr = document.createElement("tr");
                        var td = document.createElement("td");
                        var input = document.createElement("input");
                        input.type= "text";
                        input.value = ficha.nombre;

                        td.appendChild(input);
                        tr.appendChild(td);
                        tablaCategorias.appendChild(tr);

            }
        };

        request.open("GET", "CategoriaFicha.php");
        request.send();

    }

function modificarCategoria(categoria) {

        var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200)
            {


            }
        };

        request.open("GET", "CategoriaGuardar.php");
        request.send();


}

// TODO Actualizar lo local si actualizan el servidor. Poner timestamp de modificación en la tabla y pedir categoriaObtenerModificadasDesde(timestamp)