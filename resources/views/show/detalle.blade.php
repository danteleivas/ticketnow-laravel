<x-layout>
    <div class="max-w-2xl mx-auto px-4 py-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold mb-4">Detalles de la Compra</h2>
            <div class="mb-4">
                <p class="text-lg inline-block font-semibold">Nombre del Artista:</p>
                <p class="inline text-lg">{{ $show->artista }}</p>
            </div>
            <div class="mb-4">
                <p class="inline text-lg font-semibold">Lugar del Evento:</p>
                <p class="inline text-lg">{{ $place->nombre }} - </p>
                <p class="inline text-sm text-gray-600">{{ $place->direccion }}</p>
            </div>
            <div class="mb-4">
                <p class="inline text-lg font-semibold">Sector:</p>
                <p class="uppercase inline text-lg">{{ $sector }}</p>
            </div>
            <div class="mb-4">
                <p class="inline text-lg font-semibold">Cantidad de Entradas:</p>
                <p class="inline text-lg">{{ $cantidad }}</p>
            </div>
            <div class="mb-4">
                <p class="inline text-lg font-semibold">Precio unitario:</p>
                <p class="inline text-lg">${{ $precio }}</p>
            </div>
            <div class="mb-4">
                <p class="inline text-lg font-semibold">Total:</p>
                <p class="inline text-lg">${{ number_format(floatval($precio * $cantidad), 2) }}</p>

            </div>


        </div>
    </div>

    <div id="wallet_container" class="w-10/12 md:w-1/4 m-auto "></div>
    
    <script>
        

        const mp = new MercadoPago('{{ env('MERCADO_PAGO_PUBLIC_KEY') }}');
        

        const bricksBuilder = mp.bricks();


        mp.bricks().create("wallet", "wallet_container", {
            initialization: {
                preferenceId: '{{$preference->id}}',
            },
            
        });

       
    </script>

</x-layout>
