<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
</head>
<body class="px-24">
    <!-- Admin Panel -->
    @auth
        <div class="fixed h-8 w-full top-0 left-0 px-12 flex bg-zinc-900/70 text-white items-center justify-between z-50">
            <div>
                <a class="px-2" href="{{route('dashboard')}}">Panel</a>
                <a class="px-2" href="#">Dodaj Post</a>
                <a class="px-2" href="#">Uzupełnij tabele</a>
                <a class="px-2" href="#">Dodaj Gracza</a>
                <a class="px-2" href="#">Dodaj Mecz</a>
            </div>
            <div>
                Admin
                <a class="text-sm text-pink-300" href="#">[Wyloguj]</a>
            </div>
        </div>
    @endauth

    @include('layouts.navigation')
    <!-- bg1 -->
    <img class="w-full absolute z-[-1] left-0 top-[10vw] overflow-x-hidden select-none" src="{{asset('storage/bg4.png')}}"/>
    <!-- bg2 -->
    <img class="w-full absolute z-[-2] left-0 top-[1540px] select-none" src="{{asset('storage/bg_auto_x2_cut.jpg')}}"/>
    <div class="content min-h-screen mt-12">
        @yield('content')
    </div>
    @include('layouts.footer')
    @yield('scripts')
</body>
</html>