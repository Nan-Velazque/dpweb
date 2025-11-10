// -------------------------------------------------------------
// Validar campos del formulario de usuario antes de enviarlo
// -------------------------------------------------------------
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

    if (
        nro_documento == "" || razon_social == "" || telefono == "" ||
        correo == "" || departamento == "" || provincia == "" ||
        distrito == "" || cod_postal == "" || direccion == "" || rol == ""
    ) {
        Swal.fire({
            title: "ERROR ⚠️",
            text: "¡Ups! Hay campos vacíos.",
            icon: "error"
        });
        return;
    }

    Swal.fire({
        title: "¡Registro exitoso!",
        confirmButtonText: "¡Perfecto!",
        confirmButtonColor: "#ff6b6b",
        timer: 2500,
        timerProgressBar: true,
        icon: "success"
    });

    if (tipo === "nuevo") registrarUsuario();
    if (tipo === "actualizar") actualizarUsuario();
}

// -------------------------------------------------------------
// Enviar formulario de nuevo usuario
// -------------------------------------------------------------
if (document.querySelector('#frm_user')) {
    let frm_user = document.querySelector('#frm_user');
    frm_user.onsubmit = function (e) {
        e.preventDefault();
        validar_form("nuevo");
    }
}

async function registrarUsuario() {
    try {
        const datos = new FormData(frm_user);
        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        if (!respuesta.ok) {
            console.error("Error HTTP:", respuesta.status);
            return;
        }

        let json = await respuesta.json();
        if (json.status) {
            alert(json.msg);
            frm_user.reset();
        } else {
            alert(json.msg);
        }
    } catch (e) {
        console.log("Error al registrar Usuario: " + e);
    }
}

// -------------------------------------------------------------
// FUNCIÓN PARA INICIAR SESIÓN
// -------------------------------------------------------------
async function iniciar_sesion() {
    let usuario = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    if (usuario === "" || password === "") {
        alert("Error, campos vacíos!");
        return;
    }

    try {
        const frm_login = document.getElementById("frm_login");
        const datos = new FormData(frm_login);

        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=iniciar_sesion', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        if (!respuesta.ok) {
            const texto = await respuesta.text();
            console.error("⚠️ Error HTTP:", respuesta.status, texto);
            alert("Error del servidor (" + respuesta.status + ")");
            return;
        }

        let json = await respuesta.json();

        if (json.status) {
            location.replace(base_url + 'new-user');
        } else {
            alert(json.msg);
        }

    } catch (error) {
        console.log("🚨 Error en iniciar_sesion():", error);
    }
}

// -------------------------------------------------------------
// VER USUARIOS
// -------------------------------------------------------------
async function view_users() {
    try {
        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=ver_usuarios', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache'
        });

        if (!respuesta.ok) {
            console.error("Error HTTP:", respuesta.status);
            return;
        }

        let json = await respuesta.json();
        let html = "";

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
            html = '<tr><td colspan="6">No hay usuarios disponibles</td></tr>';
        }

        document.getElementById('content_users').innerHTML = html;

    } catch (error) {
        console.log("Error al cargar usuarios:", error);
        document.getElementById('content_users').innerHTML =
            '<tr><td colspan="6">Error al cargar los usuarios</td></tr>';
    }
}

if (document.getElementById('content_users')) view_users();

// -------------------------------------------------------------
// EDITAR USUARIO
// -------------------------------------------------------------
async function edit_users() {
    try {
        let id_persona = document.getElementById('id_persona').value;
        const datos = new FormData();
        datos.append('id_persona', id_persona);

        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=ver', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let json = await respuesta.json();
        if (!json.status) {
            alert(json.msg);
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
        console.log('Oops, ocurrió un error: ' + error);
    }
}

if (document.querySelector('#frm_edit_user')) {
    let frm_user = document.querySelector('#frm_edit_user');
    frm_user.onsubmit = function (e) {
        e.preventDefault();
        validar_form("actualizar");
    }
}

// -------------------------------------------------------------
// ACTUALIZAR USUARIO
// -------------------------------------------------------------
async function actualizarUsuario() {
    try {
        const datos = new FormData(frm_edit_user);
        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=actualizar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let json = await respuesta.json();

        if (!json.status) {
            alert("Ocurrió un error al actualizar, inténtelo nuevamente");
            console.log(json.msg);
            return;
        }

        alert(json.msg);
    } catch (error) {
        console.log("Error en actualizarUsuario():", error);
    }
}
