// Validar campos del formulario de usuario antes de enviarl
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
    /*
    Swal.fire({
        title: "¡Registro exitoso!",

        imageAlt: "Success celebration GIF",
        confirmButtonText: "¡Perfecto! ",
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
        icon: "success",
        draggable: true
    });*/


    if (tipo == "nuevo") {
        registrarClients();
    }
    if (tipo == "actualizar") {
        actualizarClients();
    }

}


if (document.querySelector('#frm_client')) {// Validar que el formulario con id "frm_user" exista en la página
    // Envia al controlador PHP usando fetch
    let frm_user = document.querySelector('#frm_client');
    frm_user.onsubmit = function (e) {
        e.preventDefault();
        validar_form("nuevo");
    }
}

async function registrarClients() {
    try {
        //capturar campos de formulario (HTML)
        const datos = new FormData(frm_client);
        //enviar datos a controlador
        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        let json = await respuesta.json();
        //validamos que json.status sea = true
        if (json.status) { // Mostrar mensaje de éxito o error
            alert(json.msg);
            document.getElementById('frm_client').reset(); // Limpiar formulario
        } else {
            alert(json.msg);
        }
    } catch (e) {
        console.log("Error al registrar Usuario:" + e);// Mostrar error en consola
    }

}
// Función para iniciar sesión
async function iniciar_sesion() {
    // Capturar usuario y contraseña
    let usuario = document.getElementById("username").value;
    let password = document.getElementById("password").value;
    if (usuario == "" || password == "") { // Validar campos vacíos
        alert("Error, campos vacios!");
        return;
    }

    try {
        const datos = new FormData(frm_login);
        // Enviar a backend para validar inicio de sesión
        let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=iniciar_sesion', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        // -------------------------------
        let json = await respuesta.json();
        //validamos
        if (json.status) { //true
            location.replace(base_url + 'new-client');// Redirige si es correcto
        } else {
            alert(json.msg);
        }


    } catch (error) {
        console.log(error);// Error de red o servidor

    }
}


async function view_clients() {
    try {
        let respuesta = await fetch(base_url + 'control/usuarioController.php?tipo=ver_clients', {
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
                    
                        <a href="`+ base_url + `edit-client/` + user.id + `">Editar</a>
                    </td>
                </tr>`;
            });
            document.getElementById('content_clients').innerHTML = html;
        } else {
            document.getElementById('content_clients').innerHTML = '<tr><td colspan="6">No hay usuarios disponibles</td></tr>';
        }
    } catch (error) {
        console.log(error);
        document.getElementById('content_clients').innerHTML = '<tr><td colspan="6">Error al cargar los usuarios</td></tr>';
    }
}

if (document.getElementById('content_clients')) {
    view_users();
}
async function edit_clients() {
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
        console.log('oops , ocurrio un eror' + error);
    }

}

if (document.querySelector('#frm_client')) {
    // Evita que se envie el formulario
    let frm_user = document.querySelector('#frm_new_client');
    frm_user.onsubmit = function (e) {
        e.preventDefault();
        validar_form("actualizar");
    }
}
//actualizar
async function actualizarUsuario() {
    const datos = new FormData(frm_client);
    let respuesta = await fetch(base_url + 'control/UsuarioController.php?tipo=actualizar', {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
    });
    json = await respuesta.json();
    if (!json.status) {
        alert("Oooooooops,ocurrio un error al actualizar ,intentelo nuevamente");
        console.log(json.msg);
        return;
    } else {
        alert(json.msg);
    }


}
