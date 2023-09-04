@extends('layouts.main')

@section('bg1')
    <img class="w-full absolute z-[-1] left-0 top-[10vw] overflow-x-hidden select-none" src="{{asset('storage/bg4.png')}}"/>
@endsection

@section('bg2')
    <img class="w-full absolute z-[-2] left-0 top-[1540px] select-none" src="{{asset('storage/bg_auto_x2_cut.jpg')}}"/>
@endsection

@section('content')
    <div class="w-full mt-24 mb-6 grid grid-cols-2 items-center justify-items-center text-center">
        <h1 class="small-shadow rounded-xl bg-white text-center font-bold px-8 py-2">Runda jesienna</h1>
        <h1 class="small-shadow rounded-xl bg-white text-center font-bold px-8 py-2">Runda wiosenna</h1>
    </div>

    <div class="relative w-full grid grid-cols-2 gap-y-8 items-center justify-items-center text-center">
        <div class="w-[1.6px] absolute h-full bg-gray-600"></div>
        @forelse ($matches as $match)
            <div>
                <h6 class="pb-1 text-xl font-bold text-left uppercase">> x. KOLEJKA</h6>
                <div class="flex w-[30rem] h-40 border-2 border-black bg-white rounded-3xl small-shadow uppercase">
                    <div class="flex relative items-center justify-center w-2/5">
                        <img class="absolute w-28 h-28 z-0 opacity-[15%]" src="{{asset('storage/teams/' . $match->homeTeam->image)}}" />
                        <p class="px-2 text-xl font-bold">{{$match->homeTeam->name}}</p>
                    </div>
                    <div class="grid grid-cols-1 items-center w-1/5">
                        <p class="relative font-bold tracking-wider">{{$match->date}}<br/><span class="absolute w-full left-0 text-sm font-medium">{{$match->time}}</span></p>
                        <p class="text-3xl font-bold">{{$match->homeGoals}}:{{$match->awayGoals}}</p>
                        <p 
                        @class([
                            'font-bold',
                            'text-green-500' => $match->state == 'WYGRANA',
                            'text-yellow-500' => $match->state == 'REMIS',
                            'text-red-500' => $match->state == 'PRZEGRANA'
                        ])
                        >{{$match->state}}</p>
                    </div>
                    <div class="flex relative items-center justify-center w-2/5">
                        <img class="absolute w-28 h-28 z-0 opacity-[15%]" src="{{asset('storage/teams/' . $match->awayTeam->image)}}" />
                        <p class="px-2 text-xl font-bold">{{$match->awayTeam->name}}</p>
                    </div>
                </div>
            </div>
        @empty
            Brak meczy
        @endforelse
    </div>
@endsection