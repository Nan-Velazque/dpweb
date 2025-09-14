async function insertar_categoria() {
    let nombre = document.getElementById('nombre').value;
    let detalle = document.querySelector('#detalle').value;
    
    if (nombre == "" || detalle == "") {
        alert("Error, campos vacíos");
        return;
    }

// Mostrar error en caso de codigo roto
    try {
        // 
        const datos = new FormData(formInsertCategoria);
        // await = promesa
        let respuesta = await fetch(base_url + '/controller/Categoria.php?tipo=registrar',{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            swal("Registro", json.mensaje, "success");
        }else{
            swal("Registro", json.mensaje, "error");
        }

        console.log(json);
    } catch (e) {
        console.log("Ups, ocurrió un error" + e);
    }
}

async function listar_categorias() {
    try {
        let respuesta = await fetch(base_url + '/controller/Categoria.php?tipo=listar');
        json = await respuesta.json();
        if (json.status) {
            let datos = json.contenido;
            let contenido_select = '<option value="" disabled selected>Seleccione</option>'; // Sin jquery
            datos.forEach(element => {
                contenido_select += '<option value="' + element.id + '">' + element.nombre + '</option>'; // Sin jquery

                // Para trabajar con jquery
                /*$('#idCategoria').append($('<option />', {
                    text: ${element.nombre} ,
                    value: ${element.id}
                }));*/
            });
            document.getElementById('idCategoria').innerHTML = contenido_select; // Sin jquery
        }
        console.log(respuesta);
    }catch(e){
        console.log("Error al cargar categorias." + e);
    }
}


async function listar_categorias_admin() {
    try {
        let respuesta = await fetch(base_url + '/controller/Categoria.php?tipo=listar');
        json = await respuesta.json();
        if (json.status) {
            let datos = json.contenido;
            let cont = 0;
            datos.forEach(item => {
                let nueva_fila = document.createElement("tr");
                // "nueva_fila.id" = id de la nueva fila, "item.id" = id de la base de datos(producto)
                nueva_fila.id = "fila" + item.id;
                // Sumar 1 al contador
                /* cont+=1; */
                cont++;
                // los items.xx vienen De la Base de datos
                nueva_fila.innerHTML = `
                    <th>${cont}</th>
                    <td>${item.nombre}</td>
                    <td>${item.detalle}</td>
                    <td>${item.options}</td>
                `;
                document.querySelector('#tbl_categoria').appendChild(nueva_fila);
            });
        }
        console.log(json);
    } catch (e) {
        console.log("Ups, ocurrió un error " + e);
    }
}

// Verificar si hay una tabla o un contenedor con el id tbl_persona en la página.
// Si existe, se ejecuta una función listar_personas_admin() responsable de mostrar o listar datos de personas
if (document.querySelector('#tbl_categoria')) {
    listar_categorias_admin();
}

async function ver_categoria(id){
    const formData= new FormData();
    //agregale un hijo   creale un nombre y pasale el id
    formData.append('id_categoria',id);
    try {
        //respndemos e indicamos hacia donde queremos enviar
        let respuesta = await fetch(base_url + '/controller/Categoria.php?tipo=ver', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await respuesta.json();
        if (json.status) {
            document.querySelector('#id_categoria').value = json.contenido.id;
            document.querySelector('#nombre').value = json.contenido.nombre;
            document.querySelector('#detalle').value = json.contenido.detalle;
        }else{
            window.location = base_url+"admin-listar-categorias";
        }
        console.log(json);
    } catch (error) {
        console.log("Oops, ocurrió un error "+ error);
    }
}

async function actualizar_categoria() {
    const datos = new FormData(formUpdateCategoria);
    try {
        let respuesta = await fetch(base_url + '/controller/Categoria.php?tipo=actualizar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            swal("Registro", json.mensaje, "success")
        } else {
            swal("Registro", json.mensaje, "error")
        }
        console.log(json);
    } catch (e) {

    }
}

async function eliminar_categoria(id){
    //dos partes, una para preguntar y una para ejecutar
    swal({
        title: "¿Realmente desea eliminar la categoría?",
        text: '',
        icon: "warning",
        buttons: true,
        dangerMode: true
    }).then((willDelete)=>{
        if(willDelete){
            fnt_eliminarCategoria(id);
        }
    });
    
}

async function fnt_eliminarCategoria(id){
    const formData = new FormData();
    formData.append('id_categoria', id);
    try {
        let respuesta = await fetch(base_url + '/controller/Categoria.php?tipo=eliminar',{
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await respuesta.json();
        if(json.status){
            swal("Eliminar", "Eliminado correctamente", "success")
            document.querySelector('#fila'+ id).remove();
        }else{
            swal('Eliminar', 'Error al eliminar categoria', 'warning');
        }
    } catch (error) {
        console.log("Ocurrió un error "+error)
    }
}
