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
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>

        <style>
            .ts-control, .ts-control > input{
                font-size: 1rem;
                font-weight: bold;
            }

            .ts-control > input::placeholder{
                font-weight: normal !important;
                color: black;
            }

            .ts-dropdown{
                /* font-size: 1rem; */
            }
        </style>
    </head>
    <body class="px-24">
        <!-- Admin Panel -->
        <div class="w-full h-full absolute top-0 left-0 opacity-50 z-[-1] bg-[url('{{asset('storage/obrowiec.png')}}')] bg-center bg-no-repeat"></div>
        @auth
            @include('layouts.adminNavigation')
        @endauth
        <div class="content min-h-screen mt-12">
            @yield('content')
        </div>
        @include('layouts.footer')
        @yield('scripts')
        <style>
            .fading{
                animation-name: fadeOut;
                animation-duration: 3s;
                animation-iteration-count: 1;
                
            }
            @keyframes fadeOut{
                from{
                    opacity: 1;
                }
                to{
                    opacity: 0;
                }
            }


            @keyframes unwrap {
                from {
                    width: 0%;
                }

                to {
                    width: 100%;
                }
            }
        </style>
        
        @if(Session::has('alert'))
            @php
            $alert = Session::get('alert')
            @endphp
            <div id="messageBox" class="fixed opacity-100 w-72 bottom-12 right-12 small-shadow rounded-md bg-white transition-opacity duration-1000">
                <div
                @class([
                    'border-green-700' => $alert->status == 'success',
                    'border-red-700' => $alert->status == 'fail',
                    'flex', 'items-center', 'gap-2', 'font-bold', 'py-1', 'px-4'
                ])>
                    <i
                    @class([
                        'text-green-700' => $alert->status == 'success',
                        'text-red-700' => $alert->status == 'fail',
                        'fa-solid', 'fa-circle-check'
                    ])></i>
                    <p class="text-xl tracking-wide">
                        {{$alert->status == 'success' ? 'Sukces' : 'Błąd'}}
                    </p>
                </div>
                <div id="test"
                @class([
                    'bg-green-700' => $alert->status == 'success',
                    'bg-red-700' => $alert->status == 'fail',
                    'h-[2px]', "animate-[unwrap_linear_{$alert->duration}s]"
                ])></div>
                <div class="px-4 py-2">
                    <p>{{$alert->message}}</p>
                </div>
            </div>
        @endif

        <script>
            function fadeOut(element, duration){
                duration = duration*1000;
                console.log(element);
                setTimeout(function(){
                    element.classList.remove('opacity-100');
                    element.classList.add('opacity-0');
                }, duration);

                setTimeout(function(){
                    element.remove();
                }, duration+1000);
            }

            @if(Session::has('alert'))
                fadeOut(document.getElementById("messageBox"), {{$alert->duration}})
            @endif

        </script>
        

        
    </body>
</html>