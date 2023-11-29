
<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    @guest
        <div style="margin-left: 800px; margin-bottom: -500px">
            <h1>STATUS ONLINE</h1>
            <br><br><br><br>
            <h4>Aqui esta el estatus actual de tu pedido:</h4>
            <div class="row mt-4" style="margin-left: 17px;">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card" style="cursor: pointer">
                        <div class="card-header p-3 pt-2">
                            <div
                                class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                                <i class="material-icons opacity-10">build_circle</i>
                            </div>
                            <div class="text-end pt-1">
                                <p class="text-sm mb-0 text-capitalize">Tu reparación:</p>
                                <h4 class="mb-0">{{ $reparacionArray[0]['nombre'] }}</h4>
                            </div>
                        </div>
                        <hr class="dark horizontal my-0">
                        <div class="card-footer p-3">
                            <h6>Reparación número: {{ $reparacionArray[0]['id'] }}</h6>
                            <h5>Estatus Actual: <strong>{{ $reparacionArray[0]['estatus'] }}</strong></h5>
                            <h6>Fecha estimada de entrega: {{ $reparacionArray[0]['fecha_estimada'] }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <h5>¿Buscas una reparación distinta? Haz click <a href="/buscarReparacion">aquí</a></h5>
            </div>
            <img src="{{asset('assets/img/ellie.webp')}}" alt="Link" style="margin-left: 600px; margin-top: -250px; width: 700px;">
            <img src="{{asset('assets/img/joel.webp')}}" alt="Link" style="margin-left: -700px; margin-top: -900px; width: 700px;">
        </div>
    @endguest
</x-layout>
