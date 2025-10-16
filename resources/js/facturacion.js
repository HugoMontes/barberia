document.addEventListener("DOMContentLoaded", function () {
    const selectReserva = document.getElementById("reserva_id");
    const contenedorDetalle = document.getElementById(
        "detalle-factura-container"
    );
    const nombreComprador = document.getElementById("nombre_comprador");

    selectReserva.addEventListener("change", function () {
        const reservaId = this.value;
        // Limpiar contenedor si no hay selección
        if (!reservaId) {
            contenedorDetalle.innerHTML = "";
            return;
        }

        // Mostrar loading
        contenedorDetalle.innerHTML =
            '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Cargando...</span></div></div>';

        // Hacer petición AJAX
        fetch(`/factura/reserva/detalle/${reservaId}`)
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Error en la respuesta");
                }
                return response.json();
            })
            .then((data) => {
                // Insertar el HTML recibido
                contenedorDetalle.innerHTML = data.html;
                nombreComprador.value = data.apellido_cliente;
                inicializarCheckboxes();
            })
            .catch((error) => {
                console.error("Error:", error);
                contenedorDetalle.innerHTML =
                    '<div class="alert alert-danger">Error al cargar el detalle</div>';
            });
    });

    // Función inicializar checkboxes
    function inicializarCheckboxes() {
        const checkboxes = document.querySelectorAll(".servicio-checkbox");

        checkboxes.forEach((checkbox) => {
            // Remover event listener previo para evitar duplicados
            checkbox.replaceWith(checkbox.cloneNode(true));
        });

        // Volver a obtener los checkboxes después del clone
        const nuevosCheckboxes =
            document.querySelectorAll(".servicio-checkbox");

        nuevosCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", function () {
                const precioCell =
                    this.closest("tr").querySelector(".precio-cell");
                const precio = parseFloat(this.dataset.precio);

                if (this.checked) {
                    precioCell.style.display = "block";
                } else {
                    precioCell.style.display = "none";
                }

                calcularTotal();
            });
        });
    }

    // Función para calcular total
    function calcularTotal() {
        const checkboxes = document.querySelectorAll(".servicio-checkbox");
        const totalElement = document.getElementById("total");
        const totalInput = document.getElementById("totalValue");
        let total = 0;

        checkboxes.forEach((checkbox) => {
            if (checkbox.checked) {
                total += parseFloat(checkbox.dataset.precio);
            }
        });

        totalElement.textContent = total.toFixed(2);
        totalInput.value = total.toFixed(2);
    }

    inicializarCheckboxes();
});
