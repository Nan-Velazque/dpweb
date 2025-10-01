function validar_form(tipo) {
    let codigo  = document.getElementById("codigo").value;
    let nombre = document.getElementById("nombre").value;
    let detalle = document.getElementById("detalle").value;
    let precio = document.getElementById("precio").value;
    let stock = document.getElementById("stock").value;
    let id_categoria  = document.getElementById("id_categoria").value;
    let fecha_vencimiento = document.getElementById("fecha_vencimiento").value;
    
    if (codigo=="" || nombre=="" || detalle=="" || precio=="" || stock=="" || id_categoria=="" || fecha_vencimiento=="") {
        Swal.fire({
            icon: 'warning',
            title: 'Campos vacíos',
            text: 'Por favor, complete todos los campos requeridos',
            confirmButtonText: 'Entendido'
        });
        return;
    }

    if (tipo === "nuevo") {
        registrarProducto();
    } else if (tipo === "actualizar") {
        actualizarProducto();
    }
}

// Registrar
if(document.querySelector('#frm_product')){
    let frm_product = document.querySelector('#frm_product');
    frm_product.onsubmit = function(e){
        e.preventDefault();
        validar_form("nuevo");
    }
}

async function registrarProducto() {
    try {
        const frm_product = document.querySelector("#frm_product");
        const datos = new FormData(frm_product);
        let respuesta = await fetch(base_url + 'control/ProductsControler.php?tipo=registrar', {
            method: 'POST',
            body: datos
        });
        let json = await respuesta.json();
        if (json.status) {
            Swal.fire("Éxito", json.msg, "success");
            frm_product.reset();
            view_producto(); // refrescar tabla
        } else {
            Swal.fire("Error", json.msg, "error");
        }
    } catch (error) {
        console.log("Error al registrar producto: " + error);
    }
}

// Cancelar
function cancelar() {
    Swal.fire({
        icon: "warning",
        title: "¿Estás seguro?",
        text: "Se cancelará el registro",
        showCancelButton: true,
        confirmButtonText: "Sí, cancelar",
        cancelButtonText: "No"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = base_url + "new-products";
        }
    });
}

// Listar productos
async function view_producto() {
    try {
        let respuesta = await fetch(base_url + 'control/ProductsControler.php?tipo=listar');
        let json = await respuesta.json();

        let html = "";
        if (json && json.length > 0) {
            json.forEach((producto, index) => {
                html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${producto.codigo || ''}</td>
                        <td>${producto.nombre || ''}</td>
                        <td>${producto.precio || ''}</td>
                        <td>${producto.fecha_vencimiento || ''}</td>
                        <td>
                            <a href="${base_url}edit-products/${producto.id}" class="btn btn-primary">Editar</a>
                            <button onclick="eliminar(${producto.id})" class="btn btn-danger">Eliminar</button>
                        </td>
                    </tr>`;
            });
        } else {
            html = '<tr><td colspan="6">No hay productos disponibles</td></tr>';
        }
        document.getElementById('content_products').innerHTML = html;
    } catch (error) {
        console.log(error);
        document.getElementById('content_products').innerHTML = '<tr><td colspan="6">Error al cargar los productos</td></tr>';
    }
}

if (document.getElementById('content_products')) {
    view_producto();
}

// Editar producto
async function edit_producto() {
    try {
        let id_producto = document.getElementById('id_producto').value;
        const datos = new FormData();
        datos.append('id_producto', id_producto);

        let respuesta = await fetch(base_url + 'control/ProductsControler.php?tipo=ver', {
            method: 'POST',
            body: datos
        });
        let json = await respuesta.json();

        if (!json.status) {
            Swal.fire("Error", json.msg, "error");
            return;
        }

        let data = json.data;
        document.getElementById('codigo').value = data.codigo;
        document.getElementById('nombre').value = data.nombre;
        document.getElementById('detalle').value = data.detalle;
        document.getElementById('precio').value = data.precio;
        document.getElementById('stock').value = data.stock;
        document.getElementById('id_categoria').value = data.id_categoria;
        document.getElementById('fecha_vencimiento').value = data.fecha_vencimiento;

    } catch (error) {
        console.log('Error al cargar producto: ' + error);  
    } 
}

if (document.querySelector("#frm_edit_producto")) {
    let frm_edit_producto = document.querySelector("#frm_edit_producto");
    frm_edit_producto.onsubmit = function (e){
        e.preventDefault();
        validar_form("actualizar");
    }
}

// Actualizar
async function actualizarProducto() {
    const frm_edit_producto = document.querySelector("#frm_edit_producto");
    const datos = new FormData(frm_edit_producto);
    let respuesta = await fetch(base_url + 'control/ProductsControler.php?tipo=actualizar', {
        method: 'POST',
        body: datos
    });
    let json = await respuesta.json();

    if (!json.status) {
        Swal.fire("Error", json.msg, "error");
        return;
    } else {
        Swal.fire("Éxito", json.msg, "success").then(() => {
            view_producto(); // refrescar lista
        });
    }
}

// Eliminar
async function eliminar(id) {
    Swal.fire({
        icon: "warning",
        title: "¿Estás seguro?",
        text: "Esta acción no se puede revertir",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar",
        confirmButtonColor: "rgba(192, 113, 113, 1)",
        cancelButtonColor: "#e1cbf1ff"
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const datos = new FormData();
                datos.append('id_producto', id);

                let respuesta = await fetch(base_url + 'control/ProductsControler.php?tipo=eliminar', {
                    method: 'POST',
                    body: datos
                });
                let json = await respuesta.json();

                if (json.status) {
                    Swal.fire("Eliminado", json.msg, "success").then(() => {
                        view_producto(); // recarga tabla
                    });
                } else {
                    Swal.fire("Error", json.msg, "error");
                }
            } catch (error) {
                console.log('Error al eliminar producto: ' + error);
            }
        }
    });
}
 async function cargar_categorias() {
    let respuesta = await fetch(base_url + 'control/CategoriesControler.php?tipo=listar', {
        method: 'POST',
    
    });
  let json = await respuesta.json();
  let contenido = '';
    json.data.forEach(categoria => {
        contenido += '<option value="">'+categoria.nombre+'</option>';
         });
        // console.log(contenido);
        document.getElementById('id_categoria').innerHTML = contenido;
 }
 // cargar proveedor 
async function cargarProveedores() {
  let r = await fetch(base_url + 'control/UsuarioControler.php?tipo=ver_proveedores');
  let j = await r.json();
  let h = '<option value="">Seleccione un proveedor</option>';
  j.data.forEach(p => h += <option value="${p.id}">${p.razon_social}</option>);
  document.getElementById("id_persona").innerHTML = h;
}