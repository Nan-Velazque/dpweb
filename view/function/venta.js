let productos_venta = {};
let id = 2;
let id2 = 4;
let producto = {};
producto.nombre = "Producto A";
producto.precio = 100;
producto.cantidad = 2;

let producto2 = {};
producto2.nombre = "Producto B";
producto2.precio = 200;
producto2.cantidad = 1;
//productos_venta.push(producto);

productos_venta[id] = producto;
productos_venta[id2] = producto2;
console.log(productos_venta);


async function agregar_producto_temporal(id_product = 0, price = 0, cant = 1) {
    if (id_product == 0) {
        id = document.getElementById('id_producto_venta').value;
    } else {
        id = id_product;
    }
    if (price == 0) {
        precio = document.getElementById('producto_precio_venta').value;
    } else {
        precio = price;
    }
    if (cant == 0) {
        cantidad = document.getElementById('producto_cantidad_venta').value;
    } else {
        cantidad = cant;
    }

    const datos = new FormData();
    datos.append('id_producto', id);
    datos.append('precio', precio);
    datos.append('cantidad', cantidad);
    try {
        let respuesta = await fetch(base_url + 'control/ventaController.php?tipo=registrarTemporal', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            if (json.msg == "registrado") {
                alert("el producto fue registrado");
            } else {
                alert("el producto fue actualizado");
            }
        }
        listar_temporales();

    } catch (error) {
        console.log("error en agregar producto temporal " + error);
    }
}
async function listar_temporales() {
    try {
        let respuesta = await fetch(base_url + 'control/ventaController.php?tipo=listar_venta_temporal', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache'
        });
        json = await respuesta.json();
        let lista_temporal = '';
        if (json.status && Array.isArray(json.data) && json.data.length > 0) {
            json.data.forEach(t_venta => {
                lista_temporal += `<tr>
                                    <td>${t_venta.nombre}</td>
                                    <td><input type="number" min="0" id="cant_${t_venta.id}" value="${t_venta.cantidad}" style="width: 60px;" oninput="if(this.value<0)this.value=0; actualizar_subtotal(${t_venta.id}, ${t_venta.precio});" onchange="actualizar_subtotal(${t_venta.id}, ${t_venta.precio});"></td>
                                    <td>S/. ${t_venta.precio}</td>
                                    <td id="subtotal_${t_venta.id}">S/. ${t_venta.cantidad * t_venta.precio}</td>
                                    <td><button class="btn btn-danger btn-sm" onclick="eliminarTemporalCarrito(${t_venta.id})">Eliminar</button></td>
                                </tr>`
            });
            document.getElementById('lista_compra').innerHTML = lista_temporal;
            act_subt_general();
        } else {
            // sin productos: limpiar lista y totales
            document.getElementById('lista_compra').innerHTML = '<tr><td colspan="5" class="text-center">No hay productos</td></tr>';
            document.getElementById('subtotal_general').innerHTML = 'S/. 0.00';
            document.getElementById('igv_general').innerHTML = 'S/. 0.00';
            document.getElementById('total').innerHTML = 'S/. 0.00';
        }
    } catch (error) {
        console.log("error al cargar productos temporales " + error);
    }
}
async function actualizar_subtotal(id, precio) {
    let cantidad = parseFloat(document.getElementById('cant_' + id).value) || 0;
    if (cantidad < 0) cantidad = 0;
    // actualizar el input para reflejar valor clamped
    document.getElementById('cant_' + id).value = cantidad;
    try {
        const datos = new FormData();
        datos.append('id', id);
        datos.append('cantidad', cantidad);
        let respuesta = await fetch(base_url + 'control/ventaController.php?tipo=actualizar_cantidad', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            subtotal = cantidad * precio;
            document.getElementById('subtotal_' + id).innerHTML = 'S/. ' + subtotal;
            act_subt_general();
        }
    } catch (error) {
        console.log("error al actualizar cantidad : " + error);
    }
}

async function act_subt_general() {
    try {
        let respuesta = await fetch(base_url + 'control/ventaController.php?tipo=listar_venta_temporal', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache'
        });
        json = await respuesta.json();
        if (json.status) {
            subtotal_general = 0;
            json.data.forEach(t_venta => {
                subtotal_general += parseFloat(t_venta.precio * t_venta.cantidad);
            });
            igv = parseFloat(subtotal_general * 0.18).toFixed(2);
            total = (parseFloat(subtotal_general) + parseFloat(igv)).toFixed(2);
            document.getElementById('subtotal_general').innerHTML = 'S/. ' + subtotal_general.toFixed(2);
            document.getElementById('igv_general').innerHTML = 'S/. ' + igv;
            document.getElementById('total').innerHTML = 'S/. ' + total;
        }
    } catch (error) {
        console.log("error al cargar productos temporales " + error);
    }
}

async function buscar_cliente_venta() {
    let dni = document.getElementById('cliente_dni').value.trim();
    if (dni === '') return alert('Ingrese un DNI');
    if (dni.length !== 8) return alert('DNI inválido. Debe tener 8 dígitos');

    try {
        // Primero consultar API externa por DNI
        const datos = new FormData();
        datos.append('dni', dni);
        let respuesta = await fetch(base_url + 'control/consulta_dni.php', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        let json = await respuesta.json();
        // la API devuelve numeroDocumento y nombres/apellidos
        if (json && (json.numeroDocumento === dni || json.numeroDocumento == dni)) {
            const nombreCompleto = `${json.nombres || json.nombre || ''} ${json.apellidoPaterno || ''} ${json.apellidoMaterno || ''}`.trim();
            document.getElementById('cliente_nombre').value = nombreCompleto || '';
            // luego intentar obtener el id en la BD local (si existe)
            const datosLocal = new FormData();
            datosLocal.append('dni', dni);
            let respLocal = await fetch(base_url + 'control/usuarioController.php?tipo=obtener_usuario', {
                method: 'POST',
                mode: 'cors',
                cache: 'no-cache',
                body: datosLocal
            });
            let jsonLocal = await respLocal.json();
            if (jsonLocal.status) {
                document.getElementById('id_cliente_venta').value = jsonLocal.data.id;
            } else {
                // no existe en la BD local: dejar vacío para registrar luego si se desea
                document.getElementById('id_cliente_venta').value = '';
            }
        } else {
            alert('DNI no encontrado en el servicio externo');
        }
    } catch (error) {
        console.log('error al buscar cliente por dni ' + error);
        alert('Error al consultar DNI');
    }
}


async function registrarVenta() {
    let id_cliente = document.getElementById('id_cliente_venta').value;
    let fecha_venta = document.getElementById('fecha_venta').value;

    if (id_cliente == '' || fecha_venta == '') {
        return alert("debe completar todos los campos");
    }

    // Verificar que existan productos en el carrito antes de enviar la venta
    try {
        let respTemp = await fetch(base_url + 'control/ventaController.php?tipo=listar_venta_temporal', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache'
        });
        let jsonTemp = await respTemp.json();
        if (!(jsonTemp.status && Array.isArray(jsonTemp.data) && jsonTemp.data.length > 0)) {
            return alert('No hay productos en el carrito');
        }
    } catch (err) {
        console.log('Error al verificar productos temporales: ' + err);
        return alert('No se pudo verificar el carrito');
    }

    try {
        const datos = new FormData();
        datos.append('id_cliente', id_cliente);
        datos.append('fecha_venta', fecha_venta);

        let respuesta = await fetch(base_url + 'control/ventaController.php?tipo=registrar_venta', {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            body: datos
        });
        json = await respuesta.json();
        if (json.status) {
            alert("venta registrada con exito");
            window.location.reload();
        } else {
            alert(json.msg);
        }
    } catch (error) {
        console.log("error al registrar venta " + error);
    }
}

async function eliminarTemporalCarrito(id) {
    Swal.fire({
        icon: "warning",
        title: "¿Estás seguro?",
        text: "Esta acción no se puede revertir",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "No, cancelar",
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6"
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const datos = new FormData();
                // enviar el id del registro en la tabla temporal (campo `id`)
                datos.append('id', id);
                let respuesta = await fetch(base_url + 'control/ventaController.php?tipo=eliminar_temporal', {
                    method: 'POST',
                    mode: 'cors',
                    cache: 'no-cache',
                    body: datos
                });
                json = await respuesta.json();
                if (json.status) {
                    Swal.fire({
                        icon: "success",
                        title: "Eliminado",
                        text: json.msg
                    }).then(() => {
                        // refrescar la lista de temporales y los subtotales
                        listar_temporales();
                        act_subt_general();
                    });

                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: json.msg
                    });
                }

            } catch (error) {
                console.log('oops, ocurrio un error' + error);
            }
        }
    });
}