<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    {{-- <x-navbars.sidebar activePage='nueva_reparacion'></x-navbars.sidebar> --}}
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        {{-- <x-navbars.navs.auth titlePage="Nueva Reparacion"></x-navbars.navs.auth> --}}
        <!-- End Navbar -->
        <div class="container pt-4">
            <span for="nombre_producto">
                <h1>STATUS ONLINE</h1>
            </span>
        </div>
        <form action="{{ route('guardarProducto') }}" method="POST">
            @csrf
            <div class="container pt-4">
                <span for="nombre_producto">
                    <h6>Codigo de la reparacion </h6>
                </span>
                <div class="input-group input-group-dynamic mb-1">
                    <input type="text" class="form-control" id="nombre_producto" name="nombre_producto"
                        placeholder="Ingresa el codigo de la reparacion" aria-label="nombre_producto"
                        aria-describedby="basic-addon2" required>
                </div>
                <br>
                <button type="submit" class="btn bg-gradient-dark">Buscar reparacion</button>
            </div>
        </form>

    </main>
    <x-plugins></x-plugins>
</x-layout>
