<x-layout>

    <div class="flex flex-col md:flex-row">
        
        <div class="md:w-1/2">

            <img src="/{{ $show->imagen }}" alt="Imagen del evento">
        </div>

        
        <div class="md:w-1/2 text-center ">
            
            <h2 class="text-3xl font-bold mb-4 mt-16">{{ $show->artista }}</h2>

            <p class="text-lg mb-4">Fecha: {{ \Carbon\Carbon::parse($show->fecha)->translatedFormat('j \\de F \\de Y') }}</p>
            <p class="text-lg mb-4">Hora: {{ \Carbon\Carbon::parse($show->hora)->format('H:i') }} hs</p>
            <p class="text-lg mb-4">Lugar: {{ $place->nombre }}</p>
            <p class="text-lg mb-4">Direccion: {{ $place->direccion }}</p>


        </div>
    </div>
    @if (@session()->has('error'))
            <div class="p-4 mt-4 text-sm text-red-800 rounded-lg bg-red-50 text-center" role="alert">
                {{ session('error') }}
            </div>
        @endif

    <div class="container mx-auto">
        <form action="{{ route('detalle') }}" method="POST"
            class="flex flex-col m-16 my-4 md:flex-row bg-white shadow-md rounded-lg p-6 border-4">
            @csrf
            <div class="flex-grow md:w-1/3 md:pr-4 mb-4">
                <label for="sector" class="block text-sm font-medium text-gray-700">Sector:</label>
                <div class="relative">
                    <select name="sector" id="sector" class="mt-1 block w-full p-4">
                        <option value="campo">Campo (${{ number_format($show->precio, 2) }})</option>
                        <option value="vip">VIP (${{ number_format($show->precio * 2, 2) }})</option>
                        <option value="platea">Platea (${{ number_format($show->precio * 1.5, 2) }})</option>
                        
                    </select>

                </div>
            </div>
            
            <div class="flex-grow md:w-1/3 md:px-2 mb-4">
                <label for="cantidad" class="block text-sm font-medium text-gray-700">Cantidad de Entradas:</label>
                <input type="number" name="cantidad" id="cantidad" min="1" max="4" value="1"
                    class="mt-1 block w-full p-4">
            </div>

            <input type="hidden" name="show_id" value="{{ $show->id }}">
            <input type="hidden" name="place_id" value="{{ $place->id }}">

            <div class="flex-grow md:w-1/4 md:pl-4 m-auto">
                <button type="submit"
                    class="bg-indigo-500 hover:bg-indigo-600 text-white px-2 py-2 rounded-lg shadow-md w-full">Comprar</button>
            </div>
        </form>
    </div>

</x-layout>
