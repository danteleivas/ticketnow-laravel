<x-layout>


    <div class="mx-auto w-10/12 max-w-md my-16 bg-white p-8 rounded-lg shadow-lg">
        @if (@session()->has('success'))
            <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if (@session()->has('error'))
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                {{ session('error') }}
            </div>
        @endif
        <h2 class="text-2xl font-bold mb-6 ">Inicia Sesión</h2>

        <form method="POST" action="{{ route('login.store') }}">

            @csrf
            @error('credenciales')
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
                    {{ $message }}
                </div>
            @enderror
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email"
                    class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="password" id="password"
                    class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit"
                class="w-full block md:w-1/3 bg-yellow-400 text-black py-2 px-4 rounded-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50 mb-4">Iniciar
                Sesión</button>

            <a class="mt-8 hover:underline" href="{{ route('register') }}">¿Todavía no tienes una cuenta? Registrate
                aquí</a>

        </form>


    </div>



</x-layout>
