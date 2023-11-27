<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='nueva_reparacion'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Nueva Reparacion"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <form action="{{ route('guardarProducto') }}" method="POST">
            @csrf
            <div class="container pt-4">
                <div class="input-group input-group-dynamic mb-1">
                    <span for="productos">
                        <h6>Tipo de Producto:</h6>
                    </span>
                    <select class="form-select productos" id="id_tipo_producto" name="id_tipo_producto" required>
                        <option value="" disabled selected>Seleccionar Producto a Reparar</option>
                        @foreach ($TipoProducto as $producto)
                            <option value="{{ $producto->ID }}"> {{ $producto->tipo }}</option>
                        @endforeach
                    </select>
                </div>

                <span for="nombre_producto">
                    <h6>Descripcion del Producto</h6>
                </span>
                <div class="input-group input-group-dynamic mb-1">
                    <input type="text" class="form-control" id="nombre_producto" name="nombre_producto"
                        placeholder="Descripcion del Producto" aria-label="nombre_producto"
                        aria-describedby="basic-addon2" required>
                </div>

                <span for="estimado_reparacion">
                    <h6>Estimado reparacion</h6>
                </span>
                <div class="input-group input-group-dynamic mb-1">
                    <input type="number" class="form-control" id="estimado_reparacion" name="estimado_reparacion"
                        placeholder="Descripcion del Producto" aria-label="estimado_reparacion"
                        aria-describedby="basic-addon2" required min="1" pattern="^[0-9]+">
                </div>
                <br>
                <button type="submit" class="btn bg-gradient-dark">Guardar nuevo Producto</button>
            </div>
        </form>

    </main>
    <x-plugins></x-plugins>
</x-layout>
<script>
    $(document).ready(function() {
        $('.productos').select2();
    });
</script>
