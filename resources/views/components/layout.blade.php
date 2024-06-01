<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" href="../images/logo.png">

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <title>TicketNow</title>


</head>


<body class="flex flex-col min-h-screen">

    <header class="text-center bg-no-repeat bg-[url('/images/layout/fondo-header.jpeg')] bg-cover bg-center">
        <a href="{{ url('/') }}">
            <img class="w-1/6 mx-auto" src="/images/layout/logo.png" alt="inicio">
        </a>

        <nav class="bg-[#f59f34] text-center">
            <ul class="font-bold md:gap-16 md:flex md:justify-center md-h-full uppercase md:normal-case ">
                <li class="py-4 border-b-4 border-transparent hover:text-white hover:border-b-4 hover:border-b-white"><a
                        href="{{ route('home') }}">Inicio</a></li>


                @auth
                    @if (auth()->user()->admin === 1)
                        <li
                            class="py-4 border-b-4 border-transparent hover:text-white hover:border-b-4 hover:border-b-white">
                            <a href="{{ route('admin') }}">Panel de Admin</a>
                        </li>
                    @else
                        <li
                            class="py-4 border-b-4 border-transparent hover:text-white hover:border-b-4 hover:border-b-white">
                            <a href="{{ route('micuenta') }}">Mi cuenta</a>
                        </li>
                    @endif
                    <li class="py-4 border-b-4 border-transparent hover:text-white hover:border-b-4 hover:border-b-white">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Cerrar sesión
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="py-4 border-b-4 border-transparent hover:text-white hover:border-b-4 hover:border-b-white">
                        <a href="{{ route('login') }}">Iniciar sesión</a>
                    </li>
                @endauth









            </ul>
        </nav>
    </header>
    <main class="flex-1">
        {{ $slot }}
    </main>


    <footer class="w-full text-center bg-[#f59f34]">
        <div class="text-center w-100">
            <nav class="bg-[#f59f34] text-center">
                <ul class="md:gap-16 md:flex md:justify-center md-h-full ">
                    <li class="py-4 border-b-4 border-transparent text-3xl font-bold "><a
                            href="{{ url('/') }}">TicketNow</a></li>


                </ul>
            </nav>
        </div>

    </footer>



</body>

</html>
