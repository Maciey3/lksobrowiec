@extends('layouts.main')

@section('content')
    <div class="w-full grid grid-cols-2 gap-y-8 items-center justify-items-center text-center">
        <div>
            <h6 class="pb-1 text-xl font-bold text-left">> 1. KOLEJKA<h6>
            <div class="flex w-[30rem] h-40 border-2 border-black rounded-3xl small-shadow uppercase">
                {{-- <div class="flex items-center justify-center w-2/5" style="background-image: url({{asset('storage/obrowiec.png')}})"> --}}
                <div class="flex relative items-center justify-center w-2/5">
                    <img class="absolute w-28 h-28 -z-50 opacity-[15%]" src="{{asset('storage/obrowiec.png')}}" />
                    <p class="text-xl font-bold">LKS Obrowiec</p>
                </div>
                <div class="grid grid-cols-1 items-center w-1/5">
                    <p class="font-bold tracking-wider">11.11.2011</p>
                    <p class="text-3xl font-bold">3:0</p>
                    <p class="font-bold">Wygrana</p>
                </div>
                <div class="flex relative items-center justify-center w-2/5">
                    <img class="absolute w-28 h-28 -z-50 opacity-[15%]" src="{{asset('storage/default-team.png')}}" />
                    <p class="text-xl font-bold">LZS Żywocice</p>
                </div>
            </div>
        </div>
    </div>
@endsection