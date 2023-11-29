<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='nueva_reparacion'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Nueva Reparacion"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <form action="{{route('guardarReparacion')}}" method="POST" id="insert">
            @csrf
            <div class="container pt-4">
                <div class="input-group input-group-dynamic mb-1">
                    <span for="productos">
                        <h6>Productos a reparar</h6>
                    </span>
                    <select class="form-select productos" id="id_producto" name="id_producto" required>
                        <option value="" disabled selected>Seleccionar Producto a Reparar</option>
                        @foreach ($data as $group => $items)
                            <optgroup label="{{ $group }}">
                                @foreach ($items as $itemArray)
                                    @foreach ($itemArray as $item)
                                        <option value="{{ $item->ID }}"
                                            data-estimado="{{ $item->estimado_reparacion }}">
                                            {{ $item->nombre_producto }}
                                        </option>
                                    @endforeach
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>

                <span for="correo_cliente">
                    <h6>Correo del Cliente</h6>
                </span>
                <div class="input-group input-group-dynamic mb-1">
                    <input type="email" class="form-control" id="correo_cliente" name="correo_cliente"
                        placeholder="Correo del cliente" aria-label="Correo Cliente" aria-describedby="basic-addon2"
                        required pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,5}" size="30">
                    <span class="input-group-text" id="basic-addon2">@example.com</span>
                </div>
                <span for="fh_estimada">
                    <h6>Fecha Estimada Reparacion</h6>
                </span>
                <div class="input-group input-group-dynamic mb-1">
                    <input type="date" class="form-control" id="fh_estimada" name="fh_estimada"
                        aria-label="fh_estimada" aria-describedby="basic-addon2"
                        value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" required>
                </div>
                <span for="precio">
                    <h6>Precio para la reparacion</h6>
                </span>
                <div class="input-group input-group-dynamic mb-1">
                    <span class="input-group-text">$</span>
                    <input type="number" class="form-control" id="precio" name="precio"
                        aria-label="Amount (to the nearest dollar)" min="1" pattern="^[0-9]+" required>
                </div>
                <br>
                <button type="submit" id="guardarBoton" class="btn bg-gradient-dark">Guardar Reparacion</button>
            </div>
        </form>

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
        var formulario = document.getElementById('insert'); // Reemplaza 'tuFormularioId' con el ID de tu formulario
        // Envía el formulario
        formulario.submit();
    });
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.productos').select2();
    });

    $(document).ready(function() {
        $('#id_producto').change(function() {
            let estimado = $('option:selected', this).data('estimado');
            let fecha = new Date();
            fecha.setDate(fecha.getDate() + estimado);
            let fechaFormateada = fecha.toISOString().substring(0, 10);
            $('input[type="date"]').val(fechaFormateada);
        });
    });
</script>
