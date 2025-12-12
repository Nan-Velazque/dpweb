let productos_venta = {};
let id = 2;
let id2 = 3;
let producto = {};
producto.nombre = "Producto A";
producto.precio = 10.00;
producto.cantidad = 2;
productos_venta[id] = producto;

let producto2 = {};
producto2.nombre = "Producto B";
producto2.precio = 5.00;
producto2.cantidad = 1;


productos_venta[id] = producto;
productos_venta[id2] = producto2;
console.log(productos_venta);




// Función para agregar un producto al carrito de venta
async function agregar_producto_temporal() {
    let id = document.getElementById('id_producto_venta').value;
    let precio = document.getElementById('producto_precio_venta').value;
    let cantidad = document.getElementById('producto_cantidad_venta').value;

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
        // corregir comprobación: status true = éxito
        if (json.status) {
            if (json.msg === 'registrado') {
                alert("El producto fue registrado");
                console.log("respuesta:", json);
            } else {
                alert("El producto fue actualizado");
                console.log("respuesta:", json);
                return;
            }
            listar_temporales();
        }
    } catch (error) {
        console.log("error al agregar producto temporal" + error);
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
        if (json.status) {
            let lista_temporal = '';
            json.data.forEach(t => {
                lista_temporal += `<tr>
                                    <td>${t.nombre}</td>
                                    <td><input type="number" id="cant_${t.id}" value="${t.cantidad}" style="width: 60px;" onkeyup="actualizar_subtotal(${t.id}, ${t.precio});" onchange="actualizar_subtotal(${t.id}, ${t.precio});"></td>
                                    <td>S/. ${t.precio}</td>
                                    <td id="subtotal_${t.id}">S/. ${t.cantidad * t.precio}</td>
                                    <td><button class="btn btn-danger btn-sm">Eliminar</button></td>
                                </tr>`
            });
            document.getElementById('tablaCarrito').innerHTML = lista_temporal;
            act_subt_general();
        }
    } catch (error) {
        console.log("error al cargar productos temporales " + error);
    }
}
async function actualizar_subtotal(id, precio) {
    let cantidad = document.getElementById('cant_' + id).value;
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
            json.data.forEach(t => {
                subtotal_general += (t.precio * t.cantidad);
            });
            igv = subtotal_general*0.18;
            total = subtotal_general+igv;
            document.getElementById('subtotal_general').innerHTML = 'S/. '+subtotal_general;
            document.getElementById('igv_general').innerHTML = 'S/. '+igv;
            document.getElementById('total').innerHTML = 'S/. '+total;
        }
    } catch (error) {
        console.log("error al cargar productos temporales " + error);
    }
}