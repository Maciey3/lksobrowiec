@extends('layouts.main')

@section('content')
    {{-- <div class="m-auto flex w-2/3 h-20 rounded-xl border-2 border-black">
        <div class="flex items-center h-full w-1/5 px-4 text-green-500 font-bold text-xl">W</div>
        <div class="flex items-center h-full w-3/5 m-auto text-xl font-bold">
            <img class="w-12" src="{{asset('storage/obrowiec.png')}}" />
            <div>LKS OBROWIEC</div>
            <div class="px-4">4:3</div>
            <div>KS CHRZĄSZCZ<br>CHRZĄSZCZYCE</div>
        </div>
        <div class="flex items-center justify-end h-full w-1/5 px-4 font-bold text-xl text-center">
            01.01.2023<br> 17:00
        </div>
    </div> --}}
    <div class="w-full grid grid-cols-2 gap-y-8 items-center justify-items-center text-center">
        @foreach($matches as $match)
            <div class="min-[2000px]:w-9/12 w-full rounded-xl big-shadow uppercase bg-white">
                <div class="w-full py-2 pl-4 bg-gray-200 rounded-t-xl font-bold text-left text-2xl">
                    {{$match->id}} Kolejka
                </div>
                <div class="w-56 relative m-auto top-12 font-bold text-md">
                    Sobota, 
                    <span @class([
                        'text-green-500' => $match->state == 'WYGRANA',
                        'text-red-500' => $match->state == 'PRZEGRANA',
                        'text-yellow-500' => $match->state == 'REMIS',
                    ])>
                        28.02.2023
                    </span> 
                    15:00
                </div>
                <div class="w-full min-h-[200px] px-4 grid grid-cols-3 justify-center items-center justify-items-center">
                    <div class="w-full text-center">
                        <img class="w-28 m-auto" src="{{asset('storage/' . $match->homeTeam->image)}}" />
                    </div>
                    <div class="text-sky-400 font-bold text-4xl self-end">
                        @if($match->homeGoals !== NULL && $match->awayGoals !== NULL)
                            {{$match->homeGoals}}:{{$match->awayGoals}}
                        @else
                            VS
                        @endif
                    </div>
                    <div class="w-full text-center">
                        <img class="w-28 m-auto" src="{{asset('storage/' . $match->awayTeam->image)}}" />
                    </div>
                    <p class="py-4 text-xl font-bold">{{$match->homeTeam->name}}</p>
                    {{-- <p class="text-xl font-bold text-green-500"> --}}
                    <p @class([
                        'text-xl font-bold',
                        'text-green-500' => $match->state == 'WYGRANA',
                        'text-red-500' => $match->state == 'PRZEGRANA',
                        'text-yellow-500' => $match->state == 'REMIS',
                    ])>
                        {{$match->state}}
                    </p>
                    <p class="py-4 text-xl font-bold">{{$match->awayTeam->name}}</p>
                </div>
                <div class="w-full py-2 px-4 flex justify-between bg-gray-800 rounded-b-xl font-bold text-left text-2xl">
                    <p class="text-white">&nbsp;</p>
                    <!-- <p class="text-white">1D <span class="text-sky-400">2H</span> 13M</p> -->
                </div>
            </div>
        @endforeach
    </div>
@endsection