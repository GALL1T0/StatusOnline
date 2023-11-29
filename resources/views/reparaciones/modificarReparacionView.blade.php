<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='modificar_reparacion'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Modificar Reparacion"></x-navbars.navs.auth>
        <!-- End Navbar -->

        <div class="container pt-4">
            <form action="{{ route('updateReparacionesPendientes') }}" method="POST" id="update">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $reparacionArray[0]['id'] }}">
                <span for="correo_cliente">
                    <h6>Reparacion: </h6>
                </span>
                <div class="input-group input-group-dynamic mb-1">
                    <input type="text" class="form-control" id="UUID" name="UUID"
                        value="{{ $reparacionArray[0]['UUID'] }}" aria-label="Correo Cliente"
                        aria-describedby="basic-addon2" disabled>
                </div>

                <span for="fh_estimada">
                    <h6>Status</h6>
                </span>
                <div class="input-group input-group-dynamic mb-1">
                    <select class="form-select productos" id="status" name="status" required>
                        <option value="" disabled selected>Seleccionar estatus</option>
                        @foreach ($estatus as $item)
                            <option value="{{ $item->id }}" @if ($reparacionArray[0]['status'] == $item->id) selected @endif>
                                {{ $item->tipo }} </option>
                        @endforeach
                    </select>
                </div>
                <span for="precio">
                    <h6>Comentario para la reparacion</h6>
                </span>
                <div class="input-group input-group-dynamic mb-1">
                    <span class="input-group-text">comentarios</span>
                    <input type="text" class="form-control" id="comentario" name="comentario"
                        value="{{ $reparacionArray[0]['comentario'] }}" required>
                </div>
                <span for="precio">
                    <h6>Nueva Fecha Estimada</h6>
                </span>
                <div class="input-group input-group-dynamic mb-1">
                    <span class="input-group-text">$</span>
                    <input type="date" class="form-control" id="fh_estimada" name="fh_estimada"
                        value="{{ $reparacionArray[0]['fh_estimada'] }}" required>
                </div>
                <br>
                <button type="submit" id="guardarBoton" class="btn bg-gradient-dark">Guardar Nuevo Estatus</button>
            </form>

            <button class="btn bg-gradient-danger" id="miBoton" style="display: none">Eliminar orden</button>
        </div>

    </main>
    <x-plugins></x-plugins>
</x-layout>
<script>
    document.getElementById('guardarBoton').addEventListener('click', function(event) {
        // Evita que el formulario se envíe automáticamente
        event.preventDefault();
        // Deshabilita el botón y cambia el texto
        this.disabled = true;
        this.innerHTML = 'Guardando...';
        // Obtén una referencia al formulario
        var formulario = document.getElementById('update'); // Reemplaza 'tuFormularioId' con el ID de tu formulario
        // Envía el formulario
        formulario.submit();
    });
    $(document).ready(function() {
        // Ocultar el botón al cargar la página
        $('#miBoton').hide();

        // Mostrar u ocultar el botón al cambiar la opción seleccionada
        $('#status').change(function() {
            var selectedOption = $(this).val();

            // Mostrar el botón solo si la opción seleccionada es 5
            if (selectedOption == 5) {
                $('#miBoton').show();
            } else {
                $('#miBoton').hide();
            }
        });
    });
    document.addEventListener('DOMContentLoaded', (event) => {
        document.getElementById('miBoton').addEventListener('click', function() {
            Swal.fire({
                title: "ATENCION, ESTAS POR ELIMINAR UNA REPARACION DEL REGISTRO",
                text: "No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Sí, borrala!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var reparacionId = document.getElementById('id').value;
                    const options = {
                        method: "GET"
                    };
                    fetch('/eliminar/' + reparacionId, options)
                        .then(response => response.json())
                        .then(data => {
                            // Verificar el tipo de icono y personalizar el mensaje en consecuencia
                            if (data.icon === 'success') {
                                Swal.fire({
                                    title: data.title,
                                    text: data.message,
                                    icon: data.icon,
                                }).then(() => {
                                    // Redireccionar o recargar la página si la operación fue exitosa
                                    window.location.href =
                                    "/reparacionesPendientes";
                                });
                            } else {
                                Swal.fire({
                                    title: data.title,
                                    text: data.message,
                                    icon: data.icon,
                                });
                            }
                        })
                        .catch(error => {
                            console.error('Error en la petición Fetch:', error);
                        });
                }
            });
        });
    });
</script>
