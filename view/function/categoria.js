function validarFormularioCategoria() {
    const nombre = document.getElementById("nombre").value.trim();
    const detalle = document.getElementById("detalle").value.trim();

    if (nombre === "" || detalle === "") {
        Swal.fire("Error", "Todos los campos son obligatorios", "warning");
        return;
    }

    registrarCategoria();
}

if (document.querySelector('#categoriaForm')) {
    document.querySelector('#categoriaForm').onsubmit = function (e) {
        e.preventDefault();
        validarFormularioCategoria();
    };
}

async function registrarCategoria() {
    try {
        const datos = new FormData(document.getElementById("categoriaForm"));

        const respuesta = await fetch(base_url + 'control/CategoriaController.php?tipo=registrar', {
            method: 'POST',
            body: datos
        });

        const json = await respuesta.json();
        console.log(json); // Para ver en consola

        if (json.status) {
            Swal.fire("¡Éxito!", json.msg, "success");
            document.getElementById("categoriaForm").reset();
        } else {
            Swal.fire("Error", json.msg, "error");
        }
    } catch (error) {
        console.exito("Error:", error);
        Swal.fire("exito", "se registro exitosamente", "exito");
    }
}
