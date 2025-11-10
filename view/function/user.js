// Validar campos del formulario de usuario antes de enviar
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

    if (nro_documento == "" || razon_social == "" || telefono == "" || correo == "" ||
        departamento == "" || provincia == "" || distrito == "" || cod_postal == "" ||
        direccion == "" || rol == "") {

        Swal.fire({
            title: "ERROR?",
            text: "¡Ups! Hay campos vacíos.",
            icon: "question"
        });
        return; // Detener función
    }

    Swal.fire({
        title: "¡Registro exitoso!",
        icon: "success",
        confirmButtonText: "¡Perfecto!",
        confirmButtonColor: "#ff6b6b",
        timer: 4000,
        timerProgressBar: true,
        customClass: {
            popup: 'swal2-success-fun',
            title: 'swal2-title-party',
            htmlContainer: 'swal2-html-fun'
        },
        showClass: {
            popup: 'animate__animated animate__tada'
        },
        hideClass: {
            popup: 'animate__animated animate__bounceOut'
        },
        draggable: true
    });

    if (tipo == "nuevo") {
        registrarUsuario();
    }
    if (tipo == "actualizar") {
        actualizarUsuario();
    }
}

// Validar que el formulario exista
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
        let json = await respuesta.json();

        if (json.status) {
            alert(json.msg);
            document.getElementById('frm_user').reset();
        } else {
            alert(json.msg);
        }
    } catch (e) {
        console.log("Error al registrar Usuario:" + e);
    }
}

// Función para iniciar sesión
async function iniciar_sesion() {
    let usuario = document.getElementById("username").value.trim();
    let password = document.getElementById("password").value.trim();

    // Validar campos vacíos
    if (usuario === "" || password === "") {
        alert("Error: campos vacíos");
        return;
    }

    try {
        const datos = new FormData();
        datos.append('username', usuario);
        datos.append('password', password);

        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=iniciar_sesion', {

            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });

        let json = await respuesta.json();

        // Validar la respuesta
        if (json.status) {
            alert("Inicio de sesión exitoso");
            location.replace(base_url + 'new-user'); // Redirige si es correcto
        } else {
            alert(json.msg || "Usuario o contraseña incorrectos");
        }

    } catch (error) {
        console.log("Error al iniciar sesión: " + error);
        alert("Error de conexión con el servidor");
    }
}

// Ver usuarios
async function view_users() {
    try {
        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=ver_usuarios', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache'
        });

        let json = await respuesta.json();

        if (json && json.length > 0) {
            let html = '';
            json.forEach((user, index) => {
                html += `<tr>
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
            document.getElementById('content_users').innerHTML = html;
        } else {
            document.getElementById('content_users').innerHTML = '<tr><td colspan="6">No hay usuarios disponibles</td></tr>';
        }

    } catch (error) {
        console.log(error);
        document.getElementById('content_users').innerHTML = '<tr><td colspan="6">Error al cargar los usuarios</td></tr>';
    }
}

if (document.getElementById('content_users')) {
    view_users();
}

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
        console.log('Ocurrió un error: ' + error);
    }
}

if (document.querySelector('#frm_edit_user')) {
    let frm_edit_user = document.querySelector('#frm_edit_user');
    frm_edit_user.onsubmit = function (e) {
        e.preventDefault();
        validar_form("actualizar");
    }
}

// Actualizar usuario
async function actualizarUsuario() {
    const datos = new FormData(frm_edit_user);
    let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=actualizar', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
    });

    json = await respuesta.json();

    if (!json.status) {
        alert("Ocurrió un error al actualizar, inténtelo nuevamente");
        console.log(json.msg);
        return;
    } else {
        alert(json.msg);
    }
}
