function validar_form() {
    let nombre = document.getElementById("nombre").value;
    let detalle = document.getElementById("detalle").value;
    
    if (nombre == "" || detalle == "" ) {
        alert("Error:Existen campos vacios");
        return;
    }

    registrarcategoria();
}

if (document.querySelector('#frm_categoria')) {
    //evite que se envie el formulario
    let frm_categoria = document.querySelector('#frm_categoria');
    frm_categoria.onsubmit = function (e) {
        e.preventDefault();
        validar_form();
    }
}

async function registrarcategoria() {
    try {
        //capturar campos de formulario (HTML)
        const datos = new FormData(frm_categoria);
        //enviar datos a controlador
        let respuesta = await fetch(base_url + 'control/CategoriaController.php? tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        let json = await respuesta.json();
        if (json.status) { //validamos que json.status sea=true 
            alert(json.msg);
            document.getElementById('frm_categoria').reset();
        } else {
            alert(json.msg);
        }
    } catch (e) {
        console.log("Error al registrar Categoria:" + e);
    }
}
