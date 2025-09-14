async function listar_productos() {
    try {
        let respuesta = await fetch(base_url + '/controller/Producto.php?tipo=listar');
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
                    <td>${item.codigo}</td>
                    <td>${item.nombre}</td>
                    <td>${item.precio}</td>
                    <td>${item.stock}</td>
                    <td>${item.categoria.nombre}</td>
                    <td>${item.proveedor.razon_social}</td>
                    <td>${item.options}</td>
                    <td></td>
                `;
                document.querySelector('#tbl_producto').appendChild(nueva_fila);
            });
        }
        console.log(json);
    } catch (e) {
        console.log("Ups, ocurrió un error " + e);
    }
}

if (document.querySelector('#tbl_producto')) {
    listar_productos();
}

async function insertar_producto() {
    let codigo = document.getElementById('codigo').value;
    let nombre = document.querySelector('#nombre').value;
    let detalle = document.querySelector('#detalle').value;
    let precio = document.querySelector('#precio').value;
    let stock = document.querySelector('#stock').value;
    let idCategoria = document.querySelector('#idCategoria').value;
    let fechaVencimiento = document.querySelector('#fechaVencimiento').value;
    let imagen1 = document.querySelector('#imagen1').value;
    let idProveedor = document.querySelector('#idProveedor').value;

    if (codigo == "" || nombre == "" || detalle == "" || precio == "" || stock == "" || fechaVencimiento == "" || idCategoria == "" || imagen1 == "" || idProveedor == "") {
        alert("Error, campos vacíos");
        return;
    }

    // Mostrar error en caso de codigo roto
    try {
        // Capturar los datos del formulario y guardarlos en la constante "datos"
        const datos = new FormData(formInsertProducto);
        // Enviar datos hacia el controlador
        // await = promesa
        let respuesta = await fetch(base_url + '/controller/Producto.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            swal("Registro", json.mensaje, "success");
        } else {
            swal("Registro", json.mensaje, "error");
        }

        console.log(json);
    } catch (e) {
        console.log("Ups, ocurrió un error" + e);
    }
}

async function listar_proveedores() {
    try {
        let respuesta = await fetch(base_url + '/controller/Proveedor.php?tipo=listar');
        json = await respuesta.json();
        if (json.status) {
            let datos = json.contenido;
            let contenido_select = '<option value="" disabled selected>Seleccione</option>'; // Sin jquery
            datos.forEach(element => {
                contenido_select += '<option value="' + element.id + '">' + element.razon_social + '</option>'; // Sin jquery

                // Para trabajar con jquery
                /*$('#idProveedor').append($('<option />', {
                    text: `${element.razon_social}` ,
                    value: `${element.id}`
                }));*/
            });
            document.getElementById('idProveedor').innerHTML = contenido_select; // Sin jquery
        }
        console.log(respuesta);
    } catch (e) {
        console.log("Error al cargar proveedores." + e);
    }
}

async function listar_productosP() {
    try {
        let respuesta = await fetch(base_url + '/controller/Producto.php?tipo=listarP');
        json = await respuesta.json();
        if (json.status) {
            let datos = json.contenido;
            let contenido_select = '<option value="" disabled selected>Seleccione</option>'; // Sin jquery
            datos.forEach(element => {
                contenido_select += '<option value="' + element.id + '">' + element.nombre + '</option>'; // Sin jquery

                // Para trabajar con jquery
                /*$('#idProveedor').append($('<option />', {
                    text: `${element.razon_social}` ,
                    value: `${element.id}`
                }));*/
            });
            document.getElementById('idProducto').innerHTML = contenido_select; // Sin jquery
        }
        console.log(respuesta);
    }catch(e){
        console.log("Error al cargar productos." + e);
    }
}

async function ver_producto(id) {
    const formData = new FormData();
    formData.append('id_producto', id);
    try {
        let respuesta = await fetch(base_url + '/controller/Producto.php?tipo=ver', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await respuesta.json();
        if (json.status) {
            document.querySelector('#id_producto').value = json.contenido.id;
            document.querySelector('#codigo').value = json.contenido.codigo;
            document.querySelector('#nombre').value = json.contenido.nombre;
            document.querySelector('#detalle').value = json.contenido.detalle;
            document.querySelector('#precio').value = json.contenido.precio;
            document.querySelector('#idCategoria').value = json.contenido.id_categoria;
            /* document.querySelector('#fechaVencimiento').value = json.contenido.fecha_vencimiento; */
            document.querySelector('#idProveedor').value = json.contenido.id_proveedor;
            document.querySelector('#img').value = json.contenido.imagen_1;
        }else{
            window.location = base_url + "/view-producto-admin";
        }
        console.log(json);
    } catch (e) {
        console.log('Ups, ocurrió un error ' + e);
    }
}

async function actualizar_producto() {
    const datos = new FormData(formUpdateProducto);
    try {
        let respuesta = await fetch(base_url + '/controller/Producto.php?tipo=actualizar', {
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

async function eliminar_producto(id) {
    swal({
        title: "Estás seguro de que quieres eliminar este producto?",
        text: "",
        icon: "warning",
        buttons: true,
        dangerMode: true
    }).then((willDelete)=>{
        if (willDelete) {
            fnt_eliminar(id);
        }
    })
}


async function fnt_eliminar(id) {
    const formData = new FormData();
    formData.append('id_producto', id);
    try {
        let respuesta = await fetch(base_url + '/controller/Producto.php?tipo=eliminar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: formData
        });
        json = await respuesta.json();
        if (json.status) {
            swal("Eliminar", "Eliminado correctamente", "success");
            document.querySelector('#fila' + id).remove();
        }else{
            swal("Eliminar", "Error al eliminar", "warning");
        }
    } catch (e) {
        console.log("Ups, ocurrió un error, " + e);
    }
}
