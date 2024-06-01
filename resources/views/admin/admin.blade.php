<x-layout>
    <h1 class="mt-8 text-center text-3xl font-bold mb-6 ">Panel de administración</h1>
    @if (@session()->has('successUpdate'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 text-center" role="alert">
            {{ session('successUpdate') }}
        </div>
    @endif
    <div class="flex justify-around flex-wrap">


        <div class="w-full md:w-1/3 bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-6 ">Agregar show</h2>
            @if (@session()->has('successShow'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 text-center" role="alert">
                    {{ session('successShow') }}
                </div>
            @endif
            <form method="POST" action="{{ route('admin.showStore') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="artista" class="block text-sm font-medium text-gray-700">Artista / Evento</label>
                    <input type="text" name="artista" id="artista" value="{{ old('artista') }}"
                        class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                    @error('artista')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="fecha" class="block text-sm font-medium text-gray-700">Fecha</label>
                    <input type="date" name="fecha" id="fecha" value="{{ old('fecha') }}"
                        class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">

                    @error('fecha')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>


                <div class="mb-4">
                    <label for="hora" class="block text-sm font-medium text-gray-700">Hora</label>
                    <input type="time" name="hora" id="hora" value="{{ old('hora') }}"
                        class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                    @error('hora')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4 inline-block">
                    <label for="place_id" class="text-sm block font-medium text-gray-700">Lugar</label>
                    <select name="place_id" id="place_id" value="{{ old('place_id') }}"
                        class="mt-1 rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">

                        <option disabled selected value="">--Seleccione un lugar--</option>
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
                    <input type="file" name="imagen" id="imagen" accept="image/*" value="{{ old('imagen') }}"
                        class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                    @error('imagen')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
                    <input type="number" name="precio" id="precio" value="{{ old('precio') }}"
                        class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                    @error('precio')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>



                <button type="submit"
                    class="w-full md:mx-auto bg-yellow-400 text-black py-2 px-4 rounded-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50 mt-8">Agregar
                    show</button>
            </form>
        </div>

        <div class="w-full md:w-1/3 bg-white p-8 rounded-lg shadow-lg">

            <h2 class="text-2xl font-bold mb-6 ">Agregar lugar</h2>
            @if (@session()->has('successPlace'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 text-center" role="alert">
                    {{ session('successPlace') }}
                </div>
            @endif


            <form method="POST" action="{{ route('admin.placeStore') }}">

                @csrf
                @error('credenciales')
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                        {{ $message }}
                    </div>
                @enderror
                @if ($errors->has('error'))
                    <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 text-center">
                        {{ $errors->first('error') }}
                    </div>
                @endif


                <div class="mb-4">
                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}"
                        class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                    @error('nombre')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                    <input type="text" name="direccion" value="{{ old('direccion') }}"
                        class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                    @error('direccion')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="capacidad_campo" class="block text-sm font-medium text-gray-700">Capacidad CAMPO</label>
                    <input type="number" name="capacidad_campo" id="capacidad_campo"
                        value="{{ old('capacidad_campo') }}"
                        class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                    @error('capacidad_campo')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="capacidad_vip" class="block text-sm font-medium text-gray-700">Capacidad VIP</label>
                    <input type="number" name="capacidad_vip" id="capacidad_vip"
                        value="{{ old('capacidad_vip') }}"
                        class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                    @error('capacidad_vip')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="capacidad_platea" class="block text-sm font-medium text-gray-700">Capacidad
                        PLATEA</label>
                    <input type="number" name="capacidad_platea" id="capacidad_platea"
                        value="{{ old('capacidad_platea') }}"
                        class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                    @error('capacidad_platea')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <button id="submitPlaceButton"
                    class="w-full text-bold block bg-green-400 text-black py-2 px-4 rounded-md hover:bg-green-500 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-50 mb-4">
                    Agregar
                    lugar
                    <button>



            </form>



        </div>


        <div class="w-full ml:w-3/4 mt-8 bg-white p-8 rounded-lg shadow-lg overflow-x-auto">
            <h2 class="text-2xl font-bold mb-6 ">Lista de Shows</h2>
            <div class="overflow-hidden border border-gray-200 rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-4 md:px-6 py-3 text-left text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Artista / Evento</th>
                            <th
                                class="px-4 md:px-6 py-3 text-left text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Fecha</th>
                            <th
                                class="px-4 md:px-6 py-3 text-left text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Hora</th>
                            <th
                                class="px-4 md:px-6 py-3 text-left text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Lugar</th>
                            <th
                                class="px-4 md:px-6 py-3 text-left text-xs md:text-sm font-medium text-gray-500 uppercase tracking-wider">
                                Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                        @foreach ($shows as $show)
                            <tr>
                                <td class="px-4 md:px-6 py-4 md:py-4 whitespace-nowrap">{{ $show->artista }}</td>
                                <td class="px-4 md:px-6 py-4 md:py-4 whitespace-nowrap">{{ $show->fecha }}</td>
                                <td class="px-4 md:px-6 py-4 md:py-4 whitespace-nowrap">{{ $show->hora }}</td>
                                <td class="px-4 md:px-6 py-4 md:py-4 whitespace-nowrap">
                                    {{ DB::table('places')->where('id', $show->place_id)->value('nombre') }}</td>
                                <td class="px-4 md:px-6 py-4 md:py-4 whitespace-nowrap">
                                    <a href="{{ route('admin.showEdit', $show->id) }}"><i
                                            class="p-1 mx-4 fa-solid fa-pen-to-square fa-xl"
                                            style="color: #074778;"></i></a>
                                    <form action="{{ route('admin.showDelete', $show->id) }}" method="POST"
                                        class="inline"
                                        onsubmit="return confirm('¿Estás seguro de que quieres eliminar este evento?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"><i class="fa-solid fa-trash fa-xl"
                                                style="color: #bd0000;"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if (count($shows) === 0)
                    <h2 class="text-center m-4">No hay ningun show registrado por el momento. </h2>
                @endif
            </div>
        </div>





</x-layout>
