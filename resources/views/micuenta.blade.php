<x-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-4">Mi cuenta</h1>
        
        <div class="mb-8">
            <h2 class="text-2xl font-semibold mb-2">Información del usuario</h2>
            <div class="bg-white shadow-md rounded-lg p-4">
                <p><span class="font-semibold">Nombre:</span> {{ $user->nombre }}</p>
                <p><span class="font-semibold">Apellido:</span> {{ $user->apellido }}</p>
                <p><span class="font-semibold">Email:</span> {{ $user->email }}</p>
                
            </div>
        </div>

        <div>
            <h2 class="text-2xl font-semibold mb-2">Mis entradas</h2>
            @if ($entradas->isEmpty())
                <p>No tienes entradas adquiridas.</p>
            @else
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($entradas as $entrada)
                        <div class="bg-white shadow-md rounded-lg p-4">
                            <p class="font-semibold">Evento: {{ $entrada->show->artista }}</p>
                            <p><span class="font-semibold">Fecha:</span> {{ $entrada->show->fecha }}</p>
                            <p><span class="font-semibold">Hora:</span> {{ $entrada->show->hora }}</p>
                            <p><span class="font-semibold">Lugar:</span> {{ $entrada->show->place->nombre }}</p>
                            <p><span class="font-semibold">Sector:</span> {{  strtoupper($entrada->sector) }}</p>
                            <p><span class="font-semibold">Código QR:</span> {{ $entrada->codigo_qr }}</p>
                            <div>{!! QrCode::size(100)->generate($entrada->codigo_qr) !!}</div>
                            <img src="{{$entrada->qr_ruta}}" alt="">
        
                            
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-layout>
