<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Entradas</title>
</head>

<body>
    <div>
        <h2 class="text-2xl font-semibold mb-2">Gracias por confiar, {{ $data['nombre'] }}! Tus entradas:</h2>

        <ul class="grid grid-cols-1 gap-4">
            @foreach ($data['entradas'] as $entrada)
                <li class="bg-white shadow-md rounded-lg p-4">
                    <p class="font-semibold">Evento: {{ $entrada->show->artista }}</p>
                    <p>Fecha: {{ $entrada->show->fecha }}</p>
                    <p>Hora: {{ $entrada->show->hora }}</p>
                    <p>Lugar: {{ $entrada->show->place->nombre }}</p>
                    <p>Sector: {{ strtoupper($entrada->sector) }}</p>
                    <p>Código QR: {{ $entrada->codigo_qr }}</p>

                    <img src="{!! $message->embedData(Storage::get($entrada->qr_ruta), 'qr.png', 'image/png') !!}" alt="QR">




                </li>
            @endforeach
        </ul>

        <p>También podras acceder a tus entradas en la sección <a href="{{route('micuenta')}}">'Mi Cuenta'</a> de nuestra página</p>

    </div>
</body>

</html>
