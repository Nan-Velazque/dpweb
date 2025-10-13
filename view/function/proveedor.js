// Validar campos del formulario de proveedor antes de enviarl
function validar_form(tipo) {
    let nro_documento = document.getElementById("nro_identidad").value;
    let razon_social = document.getElementById("razon_social").value;
    let telefono = document.getElementById("telefono").value;
    let correo = document.getElementById("correo").value;
    let departamento = document.getElementById("departamento").value;
    let provincia = document.getElementById("provincia").value;
    let distrito = document.getElementById("distrito").value;
    let cod_postal = document.getElementById("cod_postal").value;
    let direccion = document.getElementById("direccion").value;
    let rol = document.getElementById("rol").value;
    if (nro_documento == "" || razon_social == "" || telefono == "" || correo == "" || departamento == "" || provincia == "" || distrito == "" || cod_postal == "" || direccion == "" || rol == "") {

        Swal.fire({// Mostrar alerta de error con SweetAlert
            title: "ERROR?",
            text: "¡Ups! Hay campos vacíos.",
            icon: "question"
        });

        return;// Detener función
    }

    if (tipo == "nuevo") {
        registrarProveedor();
    }
    if (tipo == "actualizar") {
        actualizarProveedor();
    }

}


if (document.querySelector('#frm_proveedor')) {// Validar que el formulario con id "frm_proveedor" exista en la página
    // Envia al controlador PHP usando fetch
    let frm_proveedor = document.querySelector('#frm_proveedor');
    frm_proveedor.onsubmit = function (e) {
        e.preventDefault();
        validar_form("nuevo");
    }
}

async function registrarProveedor() {
    try {
        const datos = new FormData(frm_proveedor);

        let respuesta = await fetch(base_url + 'control/ProveedorController.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        // DEBUG: ver status HTTP
        console.log('Fetch response status:', respuesta.status);

        // intento leer texto crudo si el JSON falla
        const text = await respuesta.text();
        console.log('Respuesta cruda del servidor:', text);

        // intentar parsear JSON (si el servidor devuelve JSON correcto)
        let json;
        try {
            json = JSON.parse(text);
        } catch (err) {
            console.error('No es JSON válido:', err);
            alert('Error: respuesta del servidor no es JSON.\nRevisa la consola (F12 → Network / Console).');
            return;
        }

        console.log('JSON recibido:', json);

        if (json.status) {
            alert(json.msg);
            document.getElementById('frm_proveedor').reset();
            view_proveedores(); // refresca la lista
        } else {
            alert(json.msg || 'No se pudo registrar');
        }
    } catch (e) {
        console.log("Error al registrar Proveedor:" + e);
        alert('Error de red. Revisa la consola.');
    }
}


// Función para iniciar sesión
async function iniciar_sesion() {
    let usuario = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    if (usuario == "" || password == "") {
        alert("Error, campos vacios!");
        return;
    }

    try {
        const datos = new FormData(frm_login);
        let respuesta = await fetch(base_url + 'control/ProveedorController.php?tipo=iniciar_sesion', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let json = await respuesta.json();
        if (json.status) {
            location.replace(base_url + 'new-proveedor');
        } else {
            alert(json.msg);
        }

    } catch (error) {
        console.log(error);
    }
}

// Mostrar proveedores
async function view_proveedores() {
    try {
        let respuesta = await fetch(base_url + 'control/ProveedorController.php?tipo=ver_proveedores', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache'
        });
        let json = await respuesta.json();
        if (json && json.length > 0) {
            let html = '';
            json.forEach((proveedor, index) => {
                html += `<tr>
                    <td>${index + 1}</td>
                    <td>${proveedor.nro_identidad || ''}</td>
                    <td>${proveedor.razon_social || ''}</td>
                    <td>${proveedor.correo || ''}</td>
                    <td>${proveedor.rol || ''}</td>
                    <td>${proveedor.estado || ''}</td>
                    <td>
                        <a href="`+ base_url + `edit-proveedor/` + proveedor.id + `">Editar</a> |
                        <a href="#" onclick="eliminarProveedor(${proveedor.id})" style="color:red;">Eliminar</a>
                    </td>
                </tr>`;
            });
            document.getElementById('content_proveedores').innerHTML = html;
        } else {
            document.getElementById('content_proveedores').innerHTML = '<tr><td colspan="6">No hay proveedores disponibles</td></tr>';
        }
    } catch (error) {
        console.log(error);
        document.getElementById('content_proveedores').innerHTML = '<tr><td colspan="6">Error al cargar los proveedores</td></tr>';
    }
}

if (document.getElementById('content_proveedores')) {
    view_proveedores();
}

// Editar proveedor
async function edit_proveedores() {
    try {
        let id_persona = document.getElementById('id_persona').value;
        const datos = new FormData();
        datos.append('id_persona', id_persona);

        let respuesta = await fetch(base_url + 'control/ProveedorController.php?tipo=ver', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (!json.status) {
            alert(json.msg);
            return;
        }
        document.getElementById('nro_identidad').value = json.data.nro_identidad;
        document.getElementById('razon_social').value = json.data.razon_social;
        document.getElementById('telefono').value = json.data.telefono;
        document.getElementById('correo').value = json.data.correo;
        document.getElementById('departamento').value = json.data.departamento;
        document.getElementById('provincia').value = json.data.provincia;
        document.getElementById('distrito').value = json.data.distrito;
        document.getElementById('cod_postal').value = json.data.cod_postal;
        document.getElementById('direccion').value = json.data.direccion;
        document.getElementById('rol').value = json.data.rol;

    } catch (error) {
        console.log('oops , ocurrio un error' + error);
    }

}

if (document.querySelector('#frm_edit_proveedor')) {
    let frm_proveedor = document.querySelector('#frm_edit_proveedor');
    frm_proveedor.onsubmit = function (e) {
        e.preventDefault();
        validar_form("actualizar");
    }
}

// Actualizar proveedor
async function actualizarProveedor() {
    const datos = new FormData(frm_edit_proveedor);
    let respuesta = await fetch(base_url + 'control/ProveedorController.php?tipo=actualizar', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
    });
    json = await respuesta.json();
    if (!json.status) {
        alert("Oooooooops, ocurrio un error al actualizar, intentelo nuevamente");
        console.log(json.msg);
        return;
    } else {
        alert(json.msg);
    }
}

// Eliminar proveedor
async function eliminarProveedor(id) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "¡Esta acción eliminará al proveedor de forma permanente!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const datos = new FormData();
                datos.append('id', id);

                let respuesta = await fetch(base_url + 'control/ProveedorController.php?tipo=eliminar', {
                    method: 'POST',
                    mode: 'cors',
                    cache: 'no-cache',
                    body: datos
                });
                let json = await respuesta.json();

                if (json.status) {
                    Swal.fire("Eliminado", json.msg, "success");
                    view_proveedores(); // refresca la lista
                } else {
                    Swal.fire("Error", json.msg, "error");
                }
            } catch (error) {
                console.log("Error al eliminar proveedor:", error);
                Swal.fire("Error", "No se pudo eliminar el proveedor.", "error");
            }
        }
    });
}
