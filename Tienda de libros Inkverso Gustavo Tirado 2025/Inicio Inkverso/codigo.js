  const carrito = [];
        function agregarAlCarrito(producto, precio) {
            carrito.push({ producto, precio });
            actualizarCarrito();
        }
        function actualizarCarrito() {
            const lista = document.getElementById('lista-carrito');
            const total = document.getElementById('total');
            lista.innerHTML = '';
            let suma = 0;
            carrito.forEach(item => {
                const li = document.createElement('li');
                li.textContent = `${item.producto} - $${item.precio}`;
                lista.appendChild(li);
                suma += item.precio;
            });
            total.textContent = suma;
        }
        function pagarCompra() {
            alert('Gracias por tu compra. Procesaremos tu pedido pronto.');
        }

let alto = window.screen.availHeight;
let ancho = window.screen.availWidth;

comprar = confirm(`El alto es: ${alto}, el Ancho es: ${ancho}`)

if (comprar) {
    alert("compra realizada exitosamente");
}else
{
alert("compra cancelada")
}