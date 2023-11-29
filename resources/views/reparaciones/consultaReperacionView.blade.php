<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    {{-- <x-navbars.sidebar activePage='nueva_reparacion'></x-navbars.sidebar> --}}
    @guest
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        {{-- <x-navbars.navs.auth titlePage="Nueva Reparacion"></x-navbars.navs.auth> --}}
        <!-- End Navbar -->
        <div class="container pt-4">
            <span for="UUID">
                <h1>STATUS ONLINE</h1>
            </span>
        </div>
        <form action="{{ route('consultarReparacionByUUID') }}" method="POST">
            @csrf
            <div class="container pt-4">
                <span for="UUID">
                    <h6>Codigo de la reparacion </h6>
                </span>
                <div class="input-group input-group-dynamic mb-1">
                    <input type="text" class="form-control" id="UUID" name="UUID"
                        placeholder="Ingresa el codigo de la reparacion" aria-label="UUID"
                        aria-describedby="basic-addon2" required>
                </div>
                <br>
                <button type="submit" class="btn bg-gradient-dark">Buscar reparacion</button>
            </div>
        </form>
        <img src="{{asset('assets/img/link.png')}}" alt="Link" style="margin-left: 600px; margin-top: -100px;">
        <img src="{{asset('assets/img/spiderman.png')}}" alt="Spiderman" style="margin-left: 1600px; margin-top:-1650px; width: 400px;">
        <img src="{{asset('assets/img/scorpion.png')}}" alt="scorpion" style="margin-left: 50px; margin-top:-380px; width: 400px;">
    </main>
    @endguest
    <x-plugins></x-plugins>
</x-layout>

