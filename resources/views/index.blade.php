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
    <!-- Logo -->
    <div class="w-full h-[8vw] mt-4 mb-8 flex justify-center">
        <a href="">
            <img class="h-[8vw]" src="{{asset('storage/obrowiec.png')}}" />
        </a>
    </div>
    <!-- bg1 -->
    <img class="w-full absolute z-[-1] left-0 top-[10vw] overflow-x-hidden select-none" src="{{asset('storage/bg4.png')}}"/>

    <!-- Nav -->
    <nav class="w-full flex justify-center content-center text-center gap-24">
        <a class="w-36 py-2 rounded-xl bg-white small-shadow text-xl font-semibold" href="#">Home</a>
        <a class="w-36 py-2 rounded-xl bg-white small-shadow text-xl font-semibold" href="#">Klub</a>
        <a class="w-36 py-2 rounded-xl bg-white small-shadow text-xl font-semibold" href="#">Rozgrywki</a>
        <a class="w-36 py-2 rounded-xl bg-white small-shadow text-xl font-semibold" href="#">Galeria</a>
        <a class="w-36 py-2 rounded-xl bg-white small-shadow text-xl font-semibold" href="#">Partnerzy</a>
    </nav>
    <!-- Carousel -->
    <div class="w-full h-[30rem] mt-12 grid grid-cols-2 justify-center text-center gap-4">
        <div class="relative w-[40vw] justify-self-end rounded-xl big-shadow">
            <a href="">
                <div class="flex absolute w-full h-full px-4 justify-center items-center flex-col">
                    <img class="absolute w-full h-full rounded-xl grayscale-[20%] object-cover" src="{{asset('storage/image.jpg')}}">
                    <div class="articleShadow absolute w-full h-full rounded-xl"></div>
                    <div class="articleTitle relative mt-36 text-white uppercase tracking-wide text-3xl font-bold">LKS Obrowiec Mistrzem Ligi Tygodnika Krapkowickiego</div>
                    <div class="articleDate absolute bottom-2 text-sky-400 text-2xl font-bold uppercase tracking-wide">22.05.2021</div>
                </div>
            </a>
        </div>
        <div class="grid grid-rows-2 w-[40vw] gap-4 justify-self-left">
            <div class="relative rounded-xl big-shadow">
                <a href="">
                    <div class="flex absolute w-full h-full px-4 justify-center items-center flex-col">
                        <img class="absolute w-full h-full rounded-xl grayscale-[20%] object-cover" src="{{asset('storage/image2.jpg')}}">
                        <div class="articleShadow absolute w-full h-full rounded-xl"></div>
                        <div class="articleTitle relative text-white uppercase tracking-wide text-2xl font-bold">Zwycięzca Ligi Tygodnika Krapkowickiego. strażaczki.pl wspierają najlepszych</div>
                        <div class="articleDate absolute bottom-2 text-sky-400 text-xl font-bold uppercase tracking-wide">22.05.2021</div>
                    </div>
                </a>
            </div>
            <div class="relative rounded-xl big-shadow">
                <a href="">
                    <div class="flex absolute w-full h-full px-4 justify-center items-center flex-col">
                        <img class="absolute w-full h-full rounded-xl grayscale-[20%] object-cover" src="{{asset('storage/image3.jpg')}}">
                        <div class="articleShadow absolute w-full h-full rounded-xl"></div>
                        <div class="articleTitle relative text-white uppercase tracking-wide text-2xl font-bold">Grali przy jupiterach i gościli w telewizji, czyli LKS Obrowiec</div>
                        <div class="articleDate absolute bottom-2 text-sky-400 text-xl font-bold uppercase tracking-wide">22.05.2021</div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- O nas -->
    <div class="w-full mt-24 flex justify-center">
        <a class="min-[2000px]:w-1/3 w-1/2 bg-white rounded-xl big-shadow" href="">
            <div class="buttonAbout h-40 flex justify-center items-center text-6xl font-bold uppercase text-white text-shadow transition-long" style="background-image: url({{asset('storage/obrowiec.png')}})">
                O nas
            </div>
        </a>
    </div>
    <!-- Tabela i kafelki -->
    <div class="w-full mt-28 grid min-[2000px]:grid-cols-2 grid-cols-[2fr_1fr] justify-center text-center min-[2000px]:gap-4">
        <table class="min-[2000px]:w-10/12 w-10/12 h-0 min-[2000px]:justify-self-end rounded-xl big-shadow font-bold bg-white">
            <thead class="h-12 text-white rounded-xl">
                <tr class="bg-black rounded-xl">
                    <th class="rounded-tl-xl">Lp.</th>
                    <th>Nazwa</th>
                    <th>Mecze</th>
                    <th class="rounded-tr-xl">Punkty</th>
                </tr>
            </thead>
            <tbody class="text-md uppercase">
                <tr>
                    <td class="">1</td>
                    <td class="">LKS Obrowiec</td>
                    <td class="">12</td>
                    <td class="">12</td>
                </tr>
                <tr class="text-sky-400">
                    <td>2</td>
                    <td>LKS Obrowiec</td>
                    <td>12</td>
                    <td>12</td>
                </tr>
                <tr class="">
                    <td>3</td>
                    <td>LKS Obrowiec</td>
                    <td>12</td>
                    <td>12</td>
                </tr>
                <tr class="">
                    <td>4</td>
                    <td>LKS Obrowiec</td>
                    <td>12</td>
                    <td>12</td>
                </tr>
                <tr class="">
                    <td>4</td>
                    <td>LKS Obrowiec</td>
                    <td>12</td>
                    <td>12</td>
                </tr>
                <tr class="">
                    <td>4</td>
                    <td>LKS Obrowiec</td>
                    <td>12</td>
                    <td>12</td>
                </tr>
                <tr class="">
                    <td>4</td>
                    <td>LKS Obrowiec</td>
                    <td>12</td>
                    <td>12</td>
                </tr>
                <tr class="">
                    <td>4</td>
                    <td>LKS Obrowiec</td>
                    <td>12</td>
                    <td>12</td>
                </tr>
                <tr class="">
                    <td>4</td>
                    <td>LKS Obrowiec</td>
                    <td>12</td>
                    <td>12</td>
                </tr>
                <tr class="">
                    <td>4</td>
                    <td>LKS Obrowiec</td>
                    <td>12</td>
                    <td>12</td>
                </tr>
                <tr class="">
                    <td>4</td>
                    <td>LKS Obrowiec</td>
                    <td>12</td>
                    <td>12</td>
                </tr>
                <tr class="">
                    <td>4</td>
                    <td>LKS Obrowiec</td>
                    <td>12</td>
                    <td>12</td>
                </tr>
                <tr class="">
                    <td>4</td>
                    <td>LKS Obrowiec</td>
                    <td>12</td>
                    <td>12</td>
                </tr>
                <tr class="">
                    <td>4</td>
                    <td>LKS Obrowiec</td>
                    <td>12</td>
                    <td>12</td>
                </tr>
            </tbody>
        </table>
        
        <div class="h-[30rem] w-2/3 grid grid-rows-2 justify-center justify-self-center gap-8">
            <a class="h-full" href="#">
                <div class="buttonTimetable h-full min-[2000px]:w-72 w-60 flex justify-center items-center rounded-xl big-shadow" style="background-image: url({{asset('storage/terminarz.jpg')}})">
                    <p class="text-4xl text-white font-bold uppercase text-shadow">
                        Terminarz
                    </p>
                </div>
            </a>
            <a class="h-full" href="#">
                <div class="h-full min-[2000px]:w-72 w-60 flex justify-center items-center bg-black rounded-xl hover:bg-blue-800 transition-long big-shadow">
                    <i class="fa-brands fa-facebook-f text-white text-6xl"></i>
                </div>
            </a>
            <a class="h-full col-span-2" href="#">
                <div class="buttonGallery h-full w-full flex justify-center items-center rounded-xl big-shadow" style="background-image: url({{asset('storage/daniel-norin-lBhhnhndpE0-unsplash.jpg')}})">
                    <p class="text-6xl text-white font-bold uppercase text-shadow">
                        Galeria
                    </p>
                </div>
            </a>
        </div>
    </div>
    <!-- bg2 -->
    <img class="w-full absolute z-[-2] left-0 top-[1540px] select-none" src="{{asset('storage/bg_auto_x2_cut.jpg')}}"/>
    <!-- Sponsorzy i mecze -->
    <div class="w-full mt-48 grid grid-cols-2 justify-items-center items-center justify-center text-center gap-4">
        <div class="h-[500px] w-84 grid grid-rows-2 justify-center items-center justify-items-center rounded-xl big-shadow bg-white">
            <img class="w-1/2" src="{{asset('storage/beno.jpg')}}" />
            <img class="w-1/2" src="{{asset('storage/interget.png')}}" />
        </div>

        <div class="grid grid-cols-1 gap-24">
            <div class="min-[2000px]:w-9/12 w-full rounded-xl big-shadow uppercase bg-white">
                <div class="w-full py-2 pl-4 bg-gray-200 rounded-t-xl font-bold text-left text-2xl">
                    Nadchodzący mecz
                </div>
                <div class="w-56 relative m-auto top-12 font-bold text-md">
                    Sobota, <span class="text-green-500">28.02.2023</span> 15:00
                </div>
                <div class="w-full px-4 grid grid-cols-3 justify-center items-center justify-items-center">
                    <div class="w-full text-center">
                        <img class="w-28 m-auto" src="{{asset('storage/obrowiec.png')}}" />
                    </div>
                    <div class="text-sky-400 font-bold text-4xl row-span-2">
                        VS
                    </div>
                    <div class="w-full text-center">
                        <img class="w-28 m-auto" src="{{asset('storage/obrowiec.png')}}" />
                    </div>
                    <p class="py-4 text-xl font-bold">LKS Obrowiec</p>
                    <!-- <p class="py-4 text-xl font-bold">Pogoda:<br> <i class="fa-solid fa-cloud-sun"></i></p> -->
                    <p class="py-4 text-xl font-bold">KS CHRZĄSZCZ CHRZĄSZCZYCE</p>
                </div>
                <div class="w-full py-2 px-4 flex justify-between bg-gray-800 rounded-b-xl font-bold text-left text-2xl">
                    <p class="text-white">Pozostało</p>
                    <p class="text-white">1D <span class="text-sky-400">2H</span> 13M</p>
                </div>
            </div>

            <div class="min-[2000px]:w-9/12 w-full rounded-xl big-shadow uppercase bg-white">
                <div class="w-full py-2 pl-4 bg-gray-200 rounded-t-xl font-bold text-left text-2xl">
                    Ostatni mecz
                </div>
                <div class="w-56 relative m-auto top-12 font-bold text-md">
                    Sobota, <span class="text-green-500">28.02.2023</span> 15:00
                </div>
                <div class="w-full px-4 grid grid-cols-3 justify-center items-center justify-items-center">
                    <div class="w-full text-center">
                        <img class="w-28 m-auto" src="{{asset('storage/obrowiec.png')}}" />
                    </div>
                    <div class="text-sky-400 font-bold text-4xl self-end">
                        3:2
                    </div>
                    <div class="w-full text-center">
                        <img class="w-28 m-auto" src="{{asset('storage/obrowiec.png')}}" />
                    </div>
                    <p class="py-4 text-xl font-bold">LKS Obrowiec</p>
                    <p class="text-xl font-bold text-green-500">Wygrana</p>
                    <p class="py-4 text-xl font-bold">KS CHRZĄSZCZ CHRZĄSZCZYCE</p>
                </div>
                <div class="w-full py-2 px-4 flex justify-between bg-gray-800 rounded-b-xl font-bold text-left text-2xl">
                    <p class="text-white">&nbsp;</p>
                    <!-- <p class="text-white">1D <span class="text-sky-400">2H</span> 13M</p> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Strzelcy -->
    <div class="swiper mySwiper min-[2000px]:w-9/12 w-11/12 h-[400px] mt-48 py-4 px-12">
        <div class="swiper-wrapper flex fustify-center">
            <div class="swiper-slide text-center bg-white big-shadow rounded-xl">
                <div class="w-full h-3/5 bg-gray-200 rounded-t-xl">
                    <img class="w-ful h-full" src="{{asset('storage/profile.png')}}" />                    
                </div>
                <div class="w-full h-2/5 py-6 rounded-b-xl grid grid-cols-1 font-bold">
                    <p class="text-4xl uppercase text-sky-500 border-">20 <i class="relative bottom-1 text-2xl fa-solid fa-futbol"></i></p>
                    <p class="text-3xl">Michał Derda</p>
                </div>
            </div>
            <div class="swiper-slide text-center bg-white big-shadow rounded-xl">
                <div class="w-full h-3/5 bg-gray-200 rounded-t-xl">
                    <img class="w-ful h-full" src="{{asset('storage/profile.png')}}" />                    
                </div>
                <div class="w-full h-2/5 py-6 rounded-b-xl grid grid-cols-1 font-bold">
                    <p class="text-4xl uppercase text-sky-500 border-">18 <i class="relative bottom-1 text-2xl fa-solid fa-futbol"></i></p>
                    <p class="text-3xl">Maciej Chromiński</p>
                </div>
            </div>
            <div class="swiper-slide text-center bg-white big-shadow rounded-xl">
                <div class="w-full h-3/5 bg-gray-200 rounded-t-xl">
                    <img class="w-ful h-full" src="{{asset('storage/profile.png')}}" />                    
                </div>
                <div class="w-full h-2/5 py-6 rounded-b-xl grid grid-cols-1 font-bold">
                    <p class="text-4xl uppercase text-sky-500 border-">10 <i class="relative bottom-1 text-2xl fa-solid fa-futbol"></i></p>
                    <p class="text-3xl">Wiktor Gebauer</p>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
    <!-- Footer -->
    <div class="footer absolute left-0 h-[400px] w-full mt-24 bg-zinc-900">
        <!-- <img class="absolute left-0 w-full" src="footer.jpg" /> -->
        <!-- <a href="">
            <img class="h-[8vw] m-auto" src="obrowiec.png" />
        </a> -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
          slidesPerView: 1,
          spaceBetween: 100,
          pagination: {
            el: ".swiper-pagination",
            clickable: true,
          },
          breakpoints: {
            // when window width is >= 320px
            // 1200: {
            // slidesPerView: 2,
            // spaceBetween: 100
            // },
            1400: {
            slidesPerView: 3,
            spaceBetween: 120
            }
        },
        });
      </script>
</body>
</html>