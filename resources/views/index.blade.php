<x-layout>
    
    @if (@session()->has('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 text-center" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @if (@session()->has('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 text-center" role="alert">
            {{ session('success') }}
        </div>
    @endif
    
    <h1 class="text-3xl font-bold text-center mb-8 mt-8">Eventos</h1>
    <form action="{{ route('buscar') }}" method="GET" class="flex-1 bg-transparent text-center w-3/4 m-auto">
        <input
            class="bg-[url('https://cdn0.iconfinder.com/data/icons/slim-square-icons-basics/100/basics-19-32.png')] my-16 bg-no-repeat bg-left w-full border-b border-gray-300 py-2 pl-10 pr-4 focus:outline-none focus:border-gray-500 md:w-1/3"
            type="text" name="busqueda" placeholder="Busca tu evento favorito aquí">
        <button type="submit" class="hidden">
            Buscar
        </button>
    </form>

    <body class="bg-gray-100">
        <div class="container mx-auto py-8">
            @if (count($shows) === 0) 

                <h2 class="text-2xl font-bold text-center content-center mb-8">No hay eventos actualmente</h2>
            
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                
                @foreach ($shows as $show)
                <div class="relative bg-white rounded-lg shadow-md overflow-hidden border-4 ">
                    <h2 class="text-xl text-center font-semibold mb-2 overflow-visible">{{$show->artista}}</h2>

                    <img src="{{$show->imagen}}" alt="Evento 1" class="w-full h-full object-cover">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 hover:opacity-100 transition duration-300">
                        <div class="text-white text-center p-4">
                            <p >Fecha: {{ \Carbon\Carbon::parse($show->fecha)->translatedFormat('j \\de F \\de Y') }}</p>
                            <p >Lugar: {{ DB::table('places')->where('id', $show->place_id)->value('nombre') }}</p>
                        </div>
                        
                    </div>
                    <a href="{{ route('show', $show->id) }}" class="uppercase absolute left-1/2 transform -translate-x-1/2 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded inline-flex items-center bottom-4">
                        Comprar
                    </a>
                    
                </div>
                @endforeach
                

</x-layout>
