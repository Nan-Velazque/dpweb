// Validar campos del formulario de usuario antes de enviarl
function validar_form() {
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


    registrarUsuario();
}

if (document.querySelector('#frm_user')) {// Validar que el formulario con id "frm_user" exista en la página
    // Envia al controlador PHP usando fetch
    let frm_user = document.querySelector('#frm_user');
    frm_user.onsubmit = function (e) {
        e.preventDefault();
        validar_form();
    }
}

async function registrarUsuario() {
    try {
        //capturar campos de formulario (HTML)
        const datos = new FormData(frm_user);
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
            document.getElementById('frm_user').reset(); // Limpiar formulario
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
            location.replace(base_url + 'new-user');// Redirige si es correcto
        } else {
            alert(json.msg);
        }


    } catch (error) {
        console.log(error);// Error de red o servidor

    }
}


async function view_users() {
    try {
        let respuesta = await fetch(base_url + 'control/usuarioController.php?tipo=ver_usuarios', {
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