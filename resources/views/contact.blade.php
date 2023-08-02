@extends('layouts.main')

{{-- @section('style')
    <style>
        #lastMatchGoals::-webkit-scrollbar {
            width: 0.5rem;
        }

        /* Handle */
        #lastMatchGoals::-webkit-scrollbar-thumb {
            background: #38bdf8;
            border-radius: 1rem;
        }
    </style>
@endsection --}}
@section('bg1')
    <img class="w-full absolute z-[-1] left-0 top-[10vw] overflow-x-hidden select-none" src="{{asset('storage/bg4.png')}}"/>
@endsection

@section('content')
    <div class="w-full px-24 mt-28 grid grid-cols-[5fr_4fr] justify-center text-center">
        <div class="w-3/4 h-[30rem] justify-self-end  bg-white border-2 border-gray-500">
            <iframe class="w-full h-full" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5079.590666661969!2d18.018371462474253!3d50.463535788333814!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471107c9186df88f%3A0xb0e2865a7f0a6626!2sKrapkowicka%2051a%2C%2047-320%20Obrowiec!5e0!3m2!1spl!2spl!4v1690836246576!5m2!1spl!2spl" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <div class="pl-8 text-left" style="background-image: linear-gradient(to top left, rgba(255,0,0,0) 1%, rgba(255,255,255,0.9) 50%);">
            <h1 class="text-3xl font-bold">LKS OBROWIEC</h1>
            <p class="text-3xl mt-12 font-bold"><i class="text-4xl pr-4 fa-solid fa-envelope"></i> LKSOBROWIEC@GMAIL.COM</p>
            <p class="text-3xl mt-2 font-bold"><i class="text-4xl pr-4 fa-solid fa-phone"></i> 123 456 789</p>
            <div class="flex mt-12 gap-6 font-bold">
                <div>
                    <i class="text-5xl fa-solid fa-location-dot"></i>
                </div>
                <div>
                    47-320 Obrowiec<br/>
                    Krapkowicka 51a
                </div>
            </div>
        </div>
    </div>
@endsection