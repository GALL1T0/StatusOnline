<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1>Apreciable cliente</h1>
            </div>
            <div class="card-body">
                <h2 class="mb-4">Se le informa que su: <span class="text-primary">{{ $nombre }}</span></h2>
                <h2 class="mb-4">Ha cambiado de estatus a: <span class="text-success">{{ $estatus }}</span></h2>
                <h2 class="mb-4">El reparador que lo atendió es: <span class="text-info">{{ $reparador }}</span></h2>
                <h2 class="mb-4">Y este ha dejado los siguientes comentarios: <span class="text-dark">{{ $comentario }}</span></h2>
                <h2 class="mb-4">La nueva fecha es: <span class="text-danger">{{ $fecha }}</span></h2>
                <p class="mt-4">Gracias por unirte a nosotros.</p>
            </div>
        </div>
    </div>
</x-layout>
