<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage='reparaciones_pendientes'></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Reparaciones Pendientes"></x-navbars.navs.auth>
            @csrf
            <div class="row mt-4">
                @foreach ($reparaciones_pendientes as $pendiente)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <a href="{{ route('modificarReparacion', ['id' => $pendiente->id]) }}" class="card-link">
                            <div class="card" style="cursor: pointer">
                                <div class="card-header p-3 pt-2">
                                    <div
                                        class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                        <i class="material-icons opacity-10">build_circle</i>
                                    </div>
                                    <div class="text-end pt-1">
                                        <p class="text-sm mb-0 text-capitalize">Reparacion Pendiente</p>
                                        <h4 class="mb-0">{{$pendiente->producto}}</h4>
                                    </div>
                                </div>
                                <hr class="dark horizontal my-0">
                                <div class="card-footer p-3">
                                    <h6>{{$pendiente->correo}}</h6>
                                    <h5>{{$pendiente->estatus}}</h5>
                                    <h6>Fecha estimada de entraga: {{$pendiente->fecha_estimada}}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
    </main>
    <x-plugins></x-plugins>
</x-layout>
