<x-layout>

    <div class="mx-auto w-10/12 max-w-md my-16 bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold mb-6 ">Registro</h2>
        <form method="POST" action="{{route('register.store')}}">
            @csrf
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                @error('nombre')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="apellido" class="block text-sm font-medium text-gray-700">Apellido</label>
                <input type="text" name="apellido" id="apellido" class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1"> 

                @error('apellido')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
          
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1" >
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" name="password" id="password" class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation" id="password" class="mt-1 block w-full rounded-md ring ring-gray-200 focus:ring-opacity-50 p-1">
                @error('password_confirmation')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="w-full md:w-1/3 bg-yellow-400 text-black py-2 px-4 rounded-md hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-300 focus:ring-opacity-50 mt-8">Registrar</button>
        </form>

        

    </div>
   

    
</x-layout>