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
        }
    } catch (error) {
        console.log("error al agregar producto temporal" + error);
    }
}

async function listar_temporales() {
    try {
        let respuesta = await fetch(base_url + 'control/VentaController.php?tipo=listarTemporal', {
            method: 'GET',
            mode: 'cors',
            cache: 'no-cache',
        });
        json = await respuesta.json();
        if (json.status === false) {
            let listar_temporal= '';
            json.forEach(t_venta => {
                listar_temporal += `<tr>

                                <th>${t_venta.nombre}</th>
                                <th><input type="number" id="" value="${t_venta.cantidad}" style="width:60px;"</th>
                                <th>${t_venta.precio}</th>
                                <th>${t_venta.cantidad*t_venta.precio}</th>
                                <th><button class="btn btn-danger btn-sm">Eliminar</button></th>
                                    
</tr>`;
            });
            document.getElementById('tablaCarrito').innerHTML = listar_temporal;
        }
    } catch (error) {
        console.log("error al cargar productos temporales" + error);
    }
}

