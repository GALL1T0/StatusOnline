<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h1>Apreciable cliente</h1>
            </div>
            <div class="card-body">
                <h2 class="mb-4">Se le informa que su codigo unico es el siguiente: <span class="text-primary">{{ $UUID }}</span></h2>
                <h2 class="mb-4">El reparador que lo entenderá es: <span class="text-info">{{ $reparador }}</span></h2>
                <h2 class="mb-4">La fecha estima es: <span class="text-danger">{{ $fecha }}</span></h2>
                <p class="mt-4">Gracias por confiar en nosotros.</p>
            </div>
            <div>
                <p>Para consultar informacion sobre su pedido, use su codigo, en le siguiente <a href="http://status-online.net:8000/buscarReparacion">pagina</a></p>
            </div>
        </div>
    </div>
</x-layout>
