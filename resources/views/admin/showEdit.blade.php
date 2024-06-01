<x-layout>
    <h1 class="mt-8 text-center text-3xl font-bold mb-6 ">Panel de administración</h1>
    <div class="m-auto w-full md:w-1/3 bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 ">Editar evento</h2>
        @if (@session()->has('successShow'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 text-center" role="alert">
                {{ session('successShow') }}
            </div>
        @endif
        <form method="POST" action="{{ route('admin.showUpdate', $show->id) }}" enctype="multipart/form-data">
            @csrf
            @method ('PUT')
            <div class="mb-4">
                <label for="artista" class="block text-sm font-medium text-gray-700">Artista / Evento</label>
                <input type="text" name="artista" id="artista" value="{{ $show->artista }}"
                    class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                @error('artista')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                <input type="date" name="fecha" id="fecha" value="{{ $show->fecha }}"
                    class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">

                @error('fecha')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-4">
                <label for="hora" class="block text-sm font-medium text-gray-700">Hora</label>
                <input type="time" name="hora" id="hora" value="{{ $show->hora }}"
                    class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                @error('hora')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4 inline-block">
                <label for="place_id" class="text-sm block font-medium text-gray-700">Lugar</label>

                <select name="place_id" id="place_id" value="{{ $show->place_id }}"
                    class="mt-1 rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">

                    <option selected value="{{ $show->place_id }}">
                        {{ DB::table('places')->where('id', $show->place_id)->value('nombre') }}</option>
                    @foreach ($places as $place)
                        <option value={{ $place['id'] }}>{{ $place['nombre'] }}</option>
                    @endforeach

                </select>


                @error('place_id')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen del evento</label>
                <input type="file" name="imagen" id="imagen" accept="image/*" value="{{ $show->imagen }}"
                    class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                @error('imagen')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                <input type="number" name="precio" id="precio" value="{{ $show->precio }}"
                    class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                @error('precio')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>



            <button type="submit"
                class="w-full md:mx-auto bg-yellow-400 text-black py-2 px-4 rounded-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50 mt-8">Actualizar
                evento</button>
        </form>
    </div>
</x-layout>
