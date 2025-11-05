// ✅ Validar campos del formulario de usuario antes de enviar
function validar_form(tipo) {
    const campos = [
        "nro_identidad", "razon_social", "telefono", "correo",
        "departamento", "provincia", "distrito", "cod_postal",
        "direccion", "rol"
    ];

    // Verifica si hay campos vacíos
    for (let campo of campos) {
        if (document.getElementById(campo).value.trim() === "") {
            Swal.fire({
                title: "¡Error!",
                text: "Hay campos vacíos, por favor complétalos todos.",
                icon: "error",
                confirmButtonColor: "#ff6b6b"
            });
            return; // Detiene la ejecución
        }
    }

    // ✅ Mostrar mensaje de éxito visual (no detiene el flujo)
    Swal.fire({
        title: "¡Registro exitoso!",
        text: "El formulario se completó correctamente.",
        icon: "success",
        confirmButtonText: "Perfecto",
        confirmButtonColor: "#4CAF50",
        timer: 2500,
        timerProgressBar: true,
        showClass: { popup: 'animate__animated animate__tada' },
        hideClass: { popup: 'animate__animated animate__fadeOut' }
    });

    // Llama a la función correspondiente
    if (tipo === "nuevo") {
        registrarUsuario();
    } else if (tipo === "actualizar") {
        actualizarUsuario();
    }
}

// ✅ Manejo del formulario de registro
const frm_user = document.querySelector('#frm_user');
if (frm_user) {
    frm_user.onsubmit = function (e) {
        e.preventDefault();
        validar_form("nuevo");
    };
}

// ✅ Registrar usuario
async function registrarUsuario() {
    try {
        const datos = new FormData(frm_user);
        const respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        const json = await respuesta.json();

        if (json.status) {
            Swal.fire({
                title: "¡Éxito!",
                text: json.msg,
                icon: "success",
                timer: 2000,
                showConfirmButton: false
            });
            frm_user.reset();
        } else {
            Swal.fire({
                title: "Error",
                text: json.msg,
                icon: "error"
            });
        }
    } catch (e) {
        console.error("Error al registrar Usuario: " + e);
    }
}

// ✅ Iniciar sesión
async function iniciar_sesion() {
    const usuario = document.getElementById("username").value.trim();
    const password = document.getElementById("password").value.trim();

    if (usuario === "" || password === "") {
        Swal.fire({
            title: "Campos vacíos",
            text: "Por favor completa todos los campos.",
            icon: "warning"
        });
        return;
    }

    try {
        const datos = new FormData(frm_login);
        const respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=iniciar_sesion', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        const json = await respuesta.json();

        if (json.status) {
            location.replace(base_url + 'new-user');
        } else {
            Swal.fire({
                title: "Error",
                text: json.msg,
                icon: "error"
            });
        }
    } catch (error) {
        console.error("Error al iniciar sesión:", error);
    }
}

// ✅ Ver usuarios
async function view_users() {
    try {
        const respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=ver_usuarios', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache'
        });
        const json = await respuesta.json();

        let html = '';

        if (json && json.length > 0) {
            json.forEach((user, index) => {
                html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${user.nro_identidad || ''}</td>
                        <td>${user.razon_social || ''}</td>
                        <td>${user.correo || ''}</td>
                        <td>${user.rol || ''}</td>
                        <td>${user.estado || ''}</td>
                        <td>
                            <a href="${base_url}edit-user/${user.id}">Editar</a> |
                            <a href="#" onclick="eliminarUser(${user.id})" style="color:red;">Eliminar</a>
                        </td>
                    </tr>`;
            });
        } else {
            html = '<tr><td colspan="7">No hay usuarios disponibles</td></tr>';
        }

        document.getElementById('content_users').innerHTML = html;

    } catch (error) {
        console.error(error);
        document.getElementById('content_users').innerHTML =
            '<tr><td colspan="7">Error al cargar los usuarios</td></tr>';
    }
}

if (document.getElementById('content_users')) {
    view_users();
}

// ✅ Editar usuario
async function edit_users() {
    try {
        const id_persona = document.getElementById('id_persona').value;
        const datos = new FormData();
        datos.append('id_persona', id_persona);

        const respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=ver', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        const json = await respuesta.json();

        if (!json.status) {
            Swal.fire({
                title: "Error",
                text: json.msg,
                icon: "error"
            });
            return;
        }

        const data = json.data;
        document.getElementById('nro_identidad').value = data.nro_identidad;
        document.getElementById('razon_social').value = data.razon_social;
        document.getElementById('telefono').value = data.telefono;
        document.getElementById('correo').value = data.correo;
        document.getElementById('departamento').value = data.departamento;
        document.getElementById('provincia').value = data.provincia;
        document.getElementById('distrito').value = data.distrito;
        document.getElementById('cod_postal').value = data.cod_postal;
        document.getElementById('direccion').value = data.direccion;
        document.getElementById('rol').value = data.rol;

    } catch (error) {
        console.error("Error al editar usuario:", error);
    }
}

// ✅ Formulario de edición
const frm_edit_user = document.querySelector('#frm_edit_user');
if (frm_edit_user) {
    frm_edit_user.onsubmit = function (e) {
        e.preventDefault();
        validar_form("actualizar");
    };
}

// ✅ Actualizar usuario
async function actualizarUsuario() {
    try {
        const datos = new FormData(frm_edit_user);
        const respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=actualizar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        const json = await respuesta.json();

        if (!json.status) {
            Swal.fire({
                title: "Error",
                text: "Ocurrió un error al actualizar, inténtelo nuevamente.",
                icon: "error"
            });
            console.log(json.msg);
        } else {
            Swal.fire({
                title: "Actualizado",
                text: json.msg,
                icon: "success"
            });
        }
    } catch (error) {
        console.error("Error al actualizar usuario:", error);
    }
}
