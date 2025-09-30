function validar_form_categoria() {
    let nombre = document.getElementById("nombre").value;
    let detalle = document.getElementById("detalle").value;

    if (nombre == "" || detalle == "") {
        Swal.fire({
            icon: "error",
            title: "Error: Campos vacíos",
            text: "Por favor, completa todos los campos.",
        });
        return;
    }

     if (tipo == "nuevo") {
        registrarCategoria();
    }
    if (tipo == "actualizar") {
        actualizarCategoria();
    }

}

if (document.querySelector('#frm_category')) {
    let frm_category = document.querySelector('#frm_category');
    frm_category.onsubmit = function (e) {
        e.preventDefault();
        validar_form_categoria();
    }
}

async function registrarCategoria() {
    try {
        const datos = new FormData(frm_category);
        let respuesta = await fetch(base_url + 'control/CategoriesControler.php?tipo=registrar', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        let json = await respuesta.json();

        if (json.status) {
            Swal.fire("Registrado", json.msg, "success");
            document.getElementById('frm_category').reset();
        } else {
            Swal.fire("Error", json.msg, "error");
        }

    } catch (error) {
        console.log("Error al registrar categoría: " + error);
    }
}


document.addEventListener("DOMContentLoaded", function () {
    cargarCategorias();
});

async function cargarCategorias() {
    try {
        const response = await fetch(base_url + 'control/CategoriesControler.php?tipo=listar');
        const data = await response.json();
        const tbody = document.getElementById("content_categories");
        let html = "";

        data.forEach((categoria, index) => {
    html += `
        <tr>
            <td>${index + 1}</td>
            <td>${categoria.nombre}</td>
            <td>${categoria.detalle}</td> 
            <td>
                <a class="btn btn-primary" href="${base_url}edit-categories/${categoria.id}">Editar</a>
                <button class="btn btn-danger" onclick="deleteCategory(${categoria.id})">Eliminar</button>
            </td>
        </tr>
    `;
});


        tbody.innerHTML = html;
    } catch (error) {
        console.error("Error:", error);
    }
}

// editar categoría
async function edit_category() {
    // Obtener ID desde input hidden
    const id = document.getElementById("id_categoria").value;

    // Traer datos de la categoría
    try {
        const response = await fetch(base_url + 'control/CategoriesControler.php?tipo=ver&id=' + id);
        const data = await response.json();

        // Rellenar campos con la info de la BD
        document.getElementById("nombre").value = data.nombre;
        document.getElementById("detalle").value = data.detalle;

        // Manejar el submit
        document.getElementById("frm_category").addEventListener("submit", async function (e) {
            e.preventDefault();

            const formData = new FormData(this);
            formData.append("id", id);

            const resp = await fetch(base_url + 'control/CategoriesControler.php?tipo=actualizar', {
                method: "POST",
                body: formData
            });
            const result = await resp.json();

            Swal.fire({
                icon: result.status ? "success" : "error",
                title: result.msg,
                showConfirmButton: false,
                timer: 3000
            }).then(() => {
                if (result.status) {
                    window.location.href = base_url + "categories";
                }
            });
        });
    } catch (error) {
        console.error("Error cargando categoría:", error);
    }
}


// Eliminar categoría
async function deleteCategory(id) {
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción no se puede deshacer",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "rgba(194, 105, 105, 1)",
        cancelButtonColor: "#917e9fff",
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar"
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                let datos = new FormData();
                datos.append("id", id);

                let respuesta = await fetch(base_url + 'control/CategoriesControler.php?tipo=eliminar', {
                    method: 'POST',
                    body: datos
                });
                let json = await respuesta.json();

                if (json.status) {
                    Swal.fire("Eliminado", json.msg, "success");
                    cargarCategorias(); // recarga la tabla
                } else {
                    Swal.fire("Error", json.msg, "error");
                }
            } catch (error) {
                console.error("Error al eliminar categoría:", error);
            }
        }
    });
}

// Cargar datos en el formulario de edición
async function cargarCategoriaEditar(id) {
    try {
        let respuesta = await fetch(base_url + 'control/CategoriesControler.php?tipo=ver&id=' + id);
        let data = await respuesta.json();

        document.getElementById("nombre").value = data.nombre;
        document.getElementById("detalle").value = data.detalle;
        document.getElementById("frm_category").setAttribute("data-id", id);
    } catch (error) {
        console.error("Error al cargar categoría:", error);
    }
}

// Enviar actualización
if (document.querySelector('#frm_category')) {
    let frm_category = document.querySelector('#frm_category');
    frm_category.onsubmit = async function (e) {
        e.preventDefault();

        let id = frm_category.getAttribute("data-id");
        if (id) {
            // actualizar
            let datos = new FormData(frm_category);
            datos.append("id", id);

            let respuesta = await fetch(base_url + 'control/CategoriesControler.php?tipo=actualizar', {
                method: 'POST',
                body: datos
            });
            let json = await respuesta.json();

            if (json.status) {
                Swal.fire("Actualizado", json.msg, "success");
            } else {
                Swal.fire("Error", json.msg, "error");
            }
        } else {
            validar_form_categoria(); // registrar normal
        }
    }
}